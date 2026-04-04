param(
    [string]$ServerHost = "147.93.109.245",
    [int]$Port = 65002,
    [string]$User = "u829359133",
    [string]$RemotePath = "domains/trezajewels.com/public_html",
    [string]$ArchivePath = ".deploy/live-release.zip",
    [string]$RemoteArchive = "live-release.zip",
    [string]$HostKey = "ssh-ed25519 255 SHA256:m4PPvMNWUGdq4ZNM7TLMoLoJebRpAKJjz5vfETgrTeQ",
    [switch]$SkipOptimize
)

$ErrorActionPreference = "Stop"

if (-not $env:LIVE_SERVER_PASSWORD) {
    throw "Set LIVE_SERVER_PASSWORD before running this script."
}

$projectRoot = Split-Path -Parent $PSScriptRoot
$archiveFullPath = Join-Path $projectRoot $ArchivePath
$archiveDir = Split-Path -Parent $archiveFullPath

New-Item -ItemType Directory -Force -Path $archiveDir | Out-Null

Push-Location $projectRoot
try {
    git status --short | Out-Host
    git archive --format=zip --output="$archiveFullPath" HEAD

    & pscp `
        -batch `
        -hostkey $HostKey `
        -P $Port `
        -pw $env:LIVE_SERVER_PASSWORD `
        $archiveFullPath `
        "${User}@${ServerHost}:$RemoteArchive"

    $remoteSteps = @(
        "set -e",
        "cd '$RemotePath'",
        "unzip -oq ~/'$RemoteArchive' -d .",
        "rm -f ~/'$RemoteArchive'"
    )

    if (-not $SkipOptimize) {
        $remoteSteps += "php artisan optimize:clear"
        $remoteSteps += "php artisan optimize"
    }

    $remoteCommand = $remoteSteps -join "; "

    & plink `
        -batch `
        -hostkey $HostKey `
        -ssh $ServerHost `
        -P $Port `
        -l $User `
        -pw $env:LIVE_SERVER_PASSWORD `
        $remoteCommand
}
finally {
    Pop-Location
}

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedTinyInteger('type')->default(User::TYPE_USER)->after('email');
            });

            return;
        }

        DB::table('users')
            ->whereIn('type', ['admin', '1'])
            ->update(['type' => (string) User::TYPE_ADMIN]);

        DB::table('users')
            ->whereNull('type')
            ->orWhereIn('type', ['user', '0', ''])
            ->update(['type' => (string) User::TYPE_USER]);

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY type TINYINT UNSIGNED NOT NULL DEFAULT " . User::TYPE_USER);
        } elseif ($driver === 'pgsql') {
            DB::statement(
                "ALTER TABLE users ALTER COLUMN type TYPE SMALLINT USING CASE WHEN type::text IN ('admin', '1') THEN 1 ELSE 0 END"
            );
            DB::statement("ALTER TABLE users ALTER COLUMN type SET DEFAULT " . User::TYPE_USER);
            DB::statement("ALTER TABLE users ALTER COLUMN type SET NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('users', 'type')) {
            return;
        }

        DB::table('users')
            ->where('type', User::TYPE_ADMIN)
            ->update(['type' => 'admin']);

        DB::table('users')
            ->where('type', User::TYPE_USER)
            ->update(['type' => 'user']);

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY type VARCHAR(255) NOT NULL DEFAULT 'user'");
        } elseif ($driver === 'pgsql') {
            DB::statement(
                "ALTER TABLE users ALTER COLUMN type TYPE VARCHAR(255) USING CASE WHEN type = 1 THEN 'admin' ELSE 'user' END"
            );
            DB::statement("ALTER TABLE users ALTER COLUMN type SET DEFAULT 'user'");
        }
    }
};

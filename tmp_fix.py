import re
import os

file_path = r'd:\laragon\www\trezajewels\resources\views\frontend\home.blade.php'

# Open file with utf-8
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace src="assets/images/..." with src="{{ asset('assets/images/...') }}"
# Also handles single quotes
def replace_src(match):
    q = match.group(1)
    path = match.group(2)
    if '{{' in match.group(0):
        return match.group(0)
    return f'src={q}{{{{ asset(\'{path}\') }}}}{q}'

content = re.sub(r'src=(["\'])(assets/images/[^"\']+)\1', replace_src, content)

# Also for data-bgimg
def replace_bgimg(match):
    q = match.group(1)
    path = match.group(2)
    if '{{' in match.group(0):
        return match.group(0)
    return f'data-bgimg={q}{{{{ asset(\'{path}\') }}}}{q}'

content = re.sub(r'data-bgimg=(["\'])(assets/images/[^"\']+)\1', replace_bgimg, content)

# Write back
with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

import re
import os

file_path = r'd:\laragon\www\trezajewels\resources\views\frontend\home.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Remove d-none from cat-link
content = content.replace('d-none cat-link', 'cat-link')

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

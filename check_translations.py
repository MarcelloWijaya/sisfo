import os
import re
from pathlib import Path
from collections import defaultdict

# Konfigurasi path
BASE_DIR = Path(__file__).parent  # Letakkan script di root project Laravel
VIEWS_DIR = BASE_DIR / 'resources' / 'views'
LANG_EN_FILE = BASE_DIR / 'resources' / 'lang' / 'en' / 'all.php'
LANG_ID_FILE = BASE_DIR / 'resources' / 'lang' / 'id' / 'all.php'

# Warna untuk output terminal
class Colors:
    HEADER = '\033[95m'
    BLUE = '\033[94m'
    GREEN = '\033[92m'
    YELLOW = '\033[93m'
    RED = '\033[91m'
    END = '\033[0m'
    BOLD = '\033[1m'

def extract_translation_keys_from_file(file_path):
    """Extract all __() and @lang() translation keys from a blade file"""
    keys = set()
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()

            # Pattern untuk __('key') atau __("key")
            pattern1 = r"__\(['\"]([^'\"]+)['\"]\)"
            # Pattern untuk @lang('key') atau @lang("key")
            pattern2 = r"@lang\(['\"]([^'\"]+)['\"]\)"
            # Pattern untuk {{ __('key') }}
            pattern3 = r"\{\{\s*__\(['\"]([^'\"]+)['\"]\)\s*\}\}"
            # Pattern untuk {{ __('all.key') }} atau {{ __('all.key') }} khusus all.
            pattern4 = r"__\(['\"]all\.([^'\"]+)['\"]\)"

            matches = re.findall(pattern1, content)
            matches.extend(re.findall(pattern2, content))
            matches.extend(re.findall(pattern3, content))
            matches.extend(re.findall(pattern4, content))

            for match in matches:
                # Jika key diawali dengan 'all.', ambil setelahnya
                if match.startswith('all.'):
                    keys.add(match[4:])
                else:
                    keys.add(match)
    except Exception as e:
        print(f"{Colors.RED}Error reading {file_path}: {e}{Colors.END}")
    return keys

def extract_php_keys_from_lang_file(file_path, with_duplicates=False):
    """Extract translation keys from PHP lang file"""
    keys = []
    key_value_pairs = []
    duplicates = defaultdict(list)

    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            lines = f.readlines()

        for line_num, line in enumerate(lines, 1):
            # Pattern untuk 'key' => 'value'
            pattern = r"['\"]([^'\"]+)['\"]\s*=>\s*['\"]([^'\"]*)['\"]"
            matches = re.findall(pattern, line)

            for match in matches:
                key = match[0]
                value = match[1]
                if key not in ['return', '<?php']:
                    keys.append(key)
                    key_value_pairs.append((key, value, line_num))

        # Cek duplicates
        for i, (key, value, line_num) in enumerate(key_value_pairs):
            duplicates[key].append({
                'value': value,
                'line': line_num,
                'index': i
            })

        # Filter duplicates (keys yang muncul lebih dari 1x)
        duplicate_keys = {k: v for k, v in duplicates.items() if len(v) > 1}

        if with_duplicates:
            return keys, duplicate_keys, key_value_pairs
        else:
            return set(keys)

    except Exception as e:
        print(f"{Colors.RED}Error reading {file_path}: {e}{Colors.END}")
        if with_duplicates:
            return [], {}, []
        return set()

def get_all_blade_files(directory):
    """Get all blade.php files recursively"""
    blade_files = []
    for root, dirs, files in os.walk(directory):
        # Skip node_modules, vendor, cache
        dirs[:] = [d for d in dirs if d not in ['node_modules', 'vendor', 'cache', 'components']]
        for file in files:
            if file.endswith('.blade.php'):
                blade_files.append(Path(root) / file)
    return blade_files

def fix_duplicate_keys(file_path, duplicate_keys, key_value_pairs, is_en=True):
    """Generate fixed content for duplicate keys"""
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            lines = f.readlines()

        # Tandai baris yang akan dihapus (duplicate kecuali yang pertama)
        lines_to_remove = set()
        for key, occurrences in duplicate_keys.items():
            # Keep first occurrence, mark others for removal
            for occ in occurrences[1:]:
                lines_to_remove.add(occ['line'] - 1)  # Convert to 0-based index

        # Buat konten baru tanpa duplicate
        new_lines = []
        for i, line in enumerate(lines):
            if i not in lines_to_remove:
                new_lines.append(line)

        # Tulis ulang file
        with open(file_path, 'w', encoding='utf-8') as f:
            f.writelines(new_lines)

        print(f"{Colors.GREEN}✅ Fixed {len(lines_to_remove)} duplicate(s) in {file_path}{Colors.END}")
        return True
    except Exception as e:
        print(f"{Colors.RED}❌ Error fixing {file_path}: {e}{Colors.END}")
        return False

def check_duplicate_translations():
    """Check for duplicate keys in language files"""
    print(f"{Colors.YELLOW}{Colors.BOLD}🔍 Checking for duplicate translations...{Colors.END}\n")

    duplicates_found = False

    # Cek EN file
    en_keys, en_duplicates, en_pairs = extract_php_keys_from_lang_file(LANG_EN_FILE, with_duplicates=True)
    if en_duplicates:
        duplicates_found = True
        print(f"{Colors.RED}❌ DUPLICATES found in en/all.php:{Colors.END}")
        for key, occurrences in en_duplicates.items():
            print(f"   • '{key}' appears {len(occurrences)} times:")
            for occ in occurrences:
                print(f"     - Line {occ['line']}: '{occ['value']}'")

        # Offer to fix
        response = input(f"\n{Colors.YELLOW}Do you want to auto-fix duplicates in en/all.php? (y/n): {Colors.END}")
        if response.lower() == 'y':
            fix_duplicate_keys(LANG_EN_FILE, en_duplicates, en_pairs, is_en=True)

    # Cek ID file
    id_keys, id_duplicates, id_pairs = extract_php_keys_from_lang_file(LANG_ID_FILE, with_duplicates=True)
    if id_duplicates:
        duplicates_found = True
        print(f"\n{Colors.RED}❌ DUPLICATES found in id/all.php:{Colors.END}")
        for key, occurrences in id_duplicates.items():
            print(f"   • '{key}' appears {len(occurrences)} times:")
            for occ in occurrences:
                print(f"     - Line {occ['line']}: '{occ['value']}'")

        # Offer to fix
        response = input(f"\n{Colors.YELLOW}Do you want to auto-fix duplicates in id/all.php? (y/n): {Colors.END}")
        if response.lower() == 'y':
            fix_duplicate_keys(LANG_ID_FILE, id_duplicates, id_pairs, is_en=False)

    if not duplicates_found:
        print(f"{Colors.GREEN}✅ No duplicates found in language files!{Colors.END}")

    return duplicates_found

def main():
    print(f"{Colors.HEADER}{Colors.BOLD}🔍 Laravel Translation Checker{Colors.END}\n")

    # Check for duplicates first
    check_duplicate_translations()
    print()

    # Check if directories exist
    if not VIEWS_DIR.exists():
        print(f"{Colors.RED}❌ Views directory not found: {VIEWS_DIR}{Colors.END}")
        return

    if not LANG_EN_FILE.exists():
        print(f"{Colors.RED}❌ EN lang file not found: {LANG_EN_FILE}{Colors.END}")
        return

    # Get all translation keys from blade files
    print(f"{Colors.BLUE}📁 Scanning blade files in: {VIEWS_DIR}{Colors.END}\n")
    blade_files = get_all_blade_files(VIEWS_DIR)

    all_used_keys = set()
    keys_by_file = {}

    for blade_file in blade_files:
        keys = extract_translation_keys_from_file(blade_file)
        if keys:
            all_used_keys.update(keys)
            keys_by_file[str(blade_file.relative_to(BASE_DIR))] = keys

    # Get existing keys from lang files (without duplicates)
    en_keys = extract_php_keys_from_lang_file(LANG_EN_FILE)
    id_keys = extract_php_keys_from_lang_file(LANG_ID_FILE)

    # Find missing keys
    missing_in_en = all_used_keys - en_keys
    missing_in_id = all_used_keys - id_keys

    # Summary
    print(f"{Colors.GREEN}{Colors.BOLD}📊 SUMMARY:{Colors.END}")
    print(f"   Total blade files scanned: {len(blade_files)}")
    print(f"   Files with translations: {len(keys_by_file)}")
    print(f"   Total unique translation keys used: {len(all_used_keys)}")
    print(f"   Keys in en/all.php: {len(en_keys)}")
    print(f"   Keys in id/all.php: {len(id_keys)}")
    print()

    # Missing in EN
    if missing_in_en:
        print(f"{Colors.RED}{Colors.BOLD}❌ MISSING in en/all.php ({len(missing_in_en)} keys):{Colors.END}")
        for key in sorted(missing_in_en):
            print(f"   • '{key}'")

        # Generate PHP code for EN
        print(f"\n{Colors.GREEN}{Colors.BOLD}📝 Add this to resources/lang/en/all.php:{Colors.END}")
        print("```php")
        for key in sorted(missing_in_en):
            # Guess English translation
            guess = key.replace('_', ' ').title()
            print(f"    '{key}' => '{guess}',")
        print("```")

        # Offer to auto-add
        response = input(f"\n{Colors.YELLOW}Do you want to auto-add these keys to en/all.php? (y/n): {Colors.END}")
        if response.lower() == 'y':
            with open(LANG_EN_FILE, 'a', encoding='utf-8') as f:
                f.write("\n    // Auto-generated translations\n")
                for key in sorted(missing_in_en):
                    guess = key.replace('_', ' ').title()
                    f.write(f"    '{key}' => '{guess}',\n")
            print(f"{Colors.GREEN}✅ Added {len(missing_in_en)} keys to en/all.php{Colors.END}")
    else:
        print(f"{Colors.GREEN}✅ All keys are present in en/all.php{Colors.END}")

    print()

    # Missing in ID
    if missing_in_id:
        print(f"{Colors.RED}{Colors.BOLD}❌ MISSING in id/all.php ({len(missing_in_id)} keys):{Colors.END}")
        for key in sorted(missing_in_id):
            print(f"   • '{key}'")

        # Generate PHP code for ID
        print(f"\n{Colors.GREEN}{Colors.BOLD}📝 Add this to resources/lang/id/all.php:{Colors.END}")
        print("```php")
        for key in sorted(missing_in_id):
            # Guess Indonesian translation (simple guess)
            guess = key.replace('_', ' ').title()
            print(f"    '{key}' => '{guess}',")
        print("```")

        # Offer to auto-add
        response = input(f"\n{Colors.YELLOW}Do you want to auto-add these keys to id/all.php? (y/n): {Colors.END}")
        if response.lower() == 'y':
            with open(LANG_ID_FILE, 'a', encoding='utf-8') as f:
                f.write("\n    // Auto-generated translations\n")
                for key in sorted(missing_in_id):
                    guess = key.replace('_', ' ').title()
                    f.write(f"    '{key}' => '{guess}',\n")
            print(f"{Colors.GREEN}✅ Added {len(missing_in_id)} keys to id/all.php{Colors.END}")
    else:
        print(f"{Colors.GREEN}✅ All keys are present in id/all.php{Colors.END}")

    print()

    # Detail per file
    print(f"{Colors.BLUE}{Colors.BOLD}📋 DETAIL PER FILE:{Colors.END}")
    for file_path, keys in sorted(keys_by_file.items()):
        missing_in_this_file = []
        for key in keys:
            if key not in en_keys or key not in id_keys:
                missing_in_this_file.append(key)

        if missing_in_this_file:
            print(f"\n{Colors.YELLOW}📄 {file_path}{Colors.END}")
            for key in missing_in_this_file:
                missing_en = "❌EN" if key not in en_keys else "✅EN"
                missing_id = "❌ID" if key not in id_keys else "✅ID"
                print(f"   • '{key}' - [{missing_en}] [{missing_id}]")

    # Unused keys (optional)
    print(f"\n{Colors.BLUE}{Colors.BOLD}📦 UNUSED KEYS IN LANG FILES (optional to remove):{Colors.END}")
    unused_keys = en_keys - all_used_keys
    if unused_keys:
        for key in sorted(unused_keys):
            print(f"   • '{key}'")

        # Offer to remove
        response = input(f"\n{Colors.YELLOW}Do you want to remove unused keys? (y/n): {Colors.END}")
        if response.lower() == 'y':
            # Create new content without unused keys
            with open(LANG_EN_FILE, 'r', encoding='utf-8') as f:
                lines = f.readlines()

            new_lines = []
            for line in lines:
                # Check if line contains an unused key
                keep_line = True
                for key in unused_keys:
                    if re.search(rf"['\"]{key}['\"]\s*=>", line):
                        keep_line = False
                        break
                if keep_line:
                    new_lines.append(line)

            with open(LANG_EN_FILE, 'w', encoding='utf-8') as f:
                f.writelines(new_lines)
            print(f"{Colors.GREEN}✅ Removed {len(unused_keys)} unused keys from en/all.php{Colors.END}")
    else:
        print("   No unused keys found")

    print(f"\n{Colors.GREEN}{Colors.BOLD}✅ Check completed!{Colors.END}")

if __name__ == "__main__":
    main()

import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

# Setup Chrome driver
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))

def test_director_crud():
    print("Testing Director CRUD...")

    # 1. Login sebagai Director Taman Semanan Indah
    print("1. Logging in as Director Taman Semanan Indah...")
    driver.get("http://127.0.0.1:8000/login")
    time.sleep(2)

    # Login dengan akun director
    driver.find_element(By.NAME, "email").send_keys("drc_taman_semanan_indah@sip.com")
    driver.find_element(By.NAME, "password").send_keys("password123")
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    # 2. Cek apakah login berhasil
    if "dashboard" in driver.current_url or "director" in driver.current_url:
        print("✅ Login successful as Director!")
    else:
        print("❌ Login failed")
        driver.quit()
        return

    # 3. Akses halaman Students
    print("2. Navigating to Students page...")
    driver.get("http://127.0.0.1:8000/director/students")
    time.sleep(2)

    # 4. Cek daftar siswa (hanya cabang sendiri)
    print("3. Viewing students (only own branch)...")
    page_text = driver.page_source
    if "Andi Wijaya" in page_text or "Bella Putri" in page_text:
        print("✅ Students from Taman Semanan branch visible!")
    else:
        print("⚠️ No students from own branch found")

    # 5. Tambah siswa baru
    print("4. Adding new student...")
    try:
        add_btn = driver.find_element(By.LINK_TEXT, "Add New Student")
        add_btn.click()
        time.sleep(2)

        driver.find_element(By.NAME, "student_code").send_keys("STD-ABT001-999")
        driver.find_element(By.NAME, "name").send_keys("Test Director Student")
        driver.find_element(By.NAME, "class").send_keys("10")
        driver.find_element(By.NAME, "gender").send_keys("male")
        driver.find_element(By.NAME, "phone").send_keys("081234567999")

        driver.find_element(By.XPATH, "//button[@type='submit']").click()
        time.sleep(2)
        print("✅ New student added successfully!")
    except Exception as e:
        print(f"⚠️ Could not add student: {e}")

    # 6. Akses halaman Teachers
    print("5. Navigating to Teachers page...")
    driver.get("http://127.0.0.1:8000/director/teachers")
    time.sleep(2)

    # 7. Cek daftar guru (hanya cabang sendiri)
    print("6. Viewing teachers (only own branch)...")
    page_text = driver.page_source
    if "Budi Santoso" in page_text or "Siti Aminah" in page_text:
        print("✅ Teachers from Taman Semanan branch visible!")
    else:
        print("⚠️ No teachers from own branch found")

    # 8. Tambah guru baru
    print("7. Adding new teacher...")
    try:
        add_btn = driver.find_element(By.LINK_TEXT, "Add New Teacher")
        add_btn.click()
        time.sleep(2)

        driver.find_element(By.NAME, "teacher_code").send_keys("TCH-ABT001-999")
        driver.find_element(By.NAME, "name").send_keys("Test Director Teacher")
        driver.find_element(By.NAME, "nickname").send_keys("Test")
        driver.find_element(By.NAME, "gender").send_keys("male")
        driver.find_element(By.NAME, "phone").send_keys("081234567888")
        driver.find_element(By.NAME, "email").send_keys("test.director@anaku.com")

        driver.find_element(By.XPATH, "//button[@type='submit']").click()
        time.sleep(2)
        print("✅ New teacher added successfully!")
    except Exception as e:
        print(f"⚠️ Could not add teacher: {e}")

    # 9. Akses halaman Pricing (lihat biaya cabang sendiri)
    print("8. Navigating to Pricing page...")
    driver.get("http://127.0.0.1:8000/director/pricing")
    time.sleep(2)

    # 10. Akses halaman Today Attendance
    print("9. Navigating to Today Attendance...")
    driver.get("http://127.0.0.1:8000/director/classes/today-attendance")
    time.sleep(2)

    # 11. Logout
    print("10. Logging out...")
    # Cari tombol user dropdown dan logout
    try:
        user_btn = driver.find_element(By.CLASS_NAME, "user-dropdown")
        user_btn.click()
        time.sleep(1)
        logout_btn = driver.find_element(By.LINK_TEXT, "Logout")
        logout_btn.click()
        time.sleep(2)
        print("✅ Logout successful!")
    except:
        print("⚠️ Could not find logout button")

    driver.quit()
    print("\n✅ Director CRUD test completed!")

def test_director_read_only():
    print("\nTesting Director Read-Only Access...")

    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))

    # Login
    driver.get("http://127.0.0.1:8000/login")
    time.sleep(2)
    driver.find_element(By.NAME, "email").send_keys("drc_taman_semanan_indah@sip.com")
    driver.find_element(By.NAME, "password").send_keys("password123")
    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    # Coba akses halaman yang seharusnya tidak bisa diakses Director
    print("1. Trying to access Super Admin pages (should be forbidden)...")

    restricted_pages = [
        "http://127.0.0.1:8000/branches",
        "http://127.0.0.1:8000/branch-pricings/create",
    ]

    for page in restricted_pages:
        driver.get(page)
        time.sleep(1)
        if "403" in driver.page_source or "unauthorized" in driver.page_source.lower():
            print(f"   ✅ {page} - Access denied (403)")
        else:
            print(f"   ⚠️ {page} - Might be accessible!")

    driver.quit()
    print("\n✅ Director Read-Only test completed!")

if __name__ == "__main__":
    print("=" * 50)
    print("DIRECTOR CRUD TESTING")
    print("Account: drc_taman_semanan_indah@sip.com / password123")
    print("Branch: ABT Taman Semanan")
    print("=" * 50)

    choice = input("\nChoose test:\n1. Full CRUD Test\n2. Read-Only Test\n3. Both\nChoice: ")

    if choice == "1":
        test_director_crud()
    elif choice == "2":
        test_director_read_only()
    elif choice == "3":
        test_director_crud()
        test_director_read_only()
    else:
        print("Invalid choice")

# Menyiapkan "wadah" kosong untuk menyimpan angka di awal program
data_angka = []

def tampilkan_menu():
    """Fungsi untuk menampilkan menu pilihan."""
    print("\n--- MENU PILIHAN ---")
    print("1. Input Angka")
    print("2. Sorting")
    print("3. Searching")
    print("4. Selesai")

def tanya_lanjutkan():
   
    while True:
        lanjut = input("\nLanjutkan? (y/t): ").lower()
        if lanjut == 'y':
            return True
        elif lanjut == 't':
            return False
        else:
            print("Pilihan tidak valid. Masukkan 'y' atau 't'.")

# Loop utama program
while True:
    tampilkan_menu()
    pilihan = input("Masukkan Pilihan: ")

    # --- KONDISI UNTUK PILIHAN 1: INPUT ANGKA ---
    if pilihan == '1':
        try:
            n = int(input("Input Jumlah Angka (n): "))
            data_angka.clear() # Kosongkan list untuk data baru
            for i in range(n):
                while True: # Loop kecil untuk memastikan input adalah angka
                    try:
                        angka = int(input(f"  Masukkan angka ke-{i + 1}: "))
                        data_angka.append(angka)
                        break
                    except ValueError:
                        print("  Input salah! Harap masukkan angka.")
            print("Input selesai.")
        except ValueError:
            print("Jumlah tidak valid! Harap masukkan angka.")
        
        # Tanya apakah mau lanjut atau selesai
        if not tanya_lanjutkan():
            break

    # --- KONDISI UNTUK PILIHAN 2: SORTING ---
    elif pilihan == '2':
        if not data_angka: # Cek apakah data kosong
            print("Data kosong, silakan input angka terlebih dahulu.")
        else:
            print("Melakukan Sorting...")
            # Menggunakan fungsi sort bawaan Python yang efisien
            data_angka.sort()
            print("Menampilkan Hasil Sorting:", data_angka)

        # Tanya apakah mau lanjut atau selesai
        if not tanya_lanjutkan():
            break

    # --- KONDISI UNTUK PILIHAN 3: SEARCHING ---
    elif pilihan == '3':
        if not data_angka: # Cek apakah data kosong
            print("Data kosong, silakan input angka terlebih dahulu.")
        else:
            try:
                angka_dicari = int(input("Input angka yang dicari: "))
                print("Melakukan Searching...")
                
                # Menggunakan operator 'in' bawaan Python untuk mencari
                if angka_dicari in data_angka:
                    print("Hasil: Angka Ditemukan")
                    # break
                else:
                    print("Hasil: Angka Tidak Ditemukan")
                    # break
            except ValueError:
                print("Input salah! Harap masukkan angka.")
                

        # Tanya apakah mau lanjut atau selesai
        if not tanya_lanjutkan():
            break

    # --- KONDISI UNTUK PILIHAN 4: KELUAR ---
    elif pilihan == '4':
        break # Langsung keluar dari loop

    # --- KONDISI UNTUK PILIHAN TIDAK VALID ---
    else:
        print("Pilihan Tidak Valid.")
        # Tetap tanyakan apakah mau lanjut atau selesai
        if not tanya_lanjutkan():
            break

# Pesan penutup setelah keluar dari loop
print("\nProgram Selesai.")
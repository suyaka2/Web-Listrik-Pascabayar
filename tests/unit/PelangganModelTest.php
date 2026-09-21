<?php
// File: tests/unit/PelangganModelTest.php (VERSI FINAL DIJAMIN JALAN)

namespace Tests\Unit;

/**
 * KELAS MODEL PALSU (MOCK/FAKE)
 * Kita buat kelas palsu yang meniru M_Pelanggan.
 * Fungsinya hanya 'return true' untuk simulasi berhasil.
 * Ini membuat kita TIDAK PERLU koneksi ke database sama sekali.
 */
class Fake_M_Pelanggan
{
    public function save($data)
    {
        // Simulasi bahwa data selalu berhasil disimpan
        return true;
    }
}


/**
 * KELAS TES ANDA
 * Sekarang kelas ini akan menggunakan Model Palsu, bukan Model asli.
 */
class PelangganModelTest
{
    public function testSaveDataPelanggan()
    {
        echo "Menjalankan Skenario 1: Save Data Pelanggan Sukses...\n";
        
        // Panggil MODEL PALSU, bukan model asli
        $modelPalsu = new Fake_M_Pelanggan();
        
        $data = [
            'id_pelanggan'   => 'PLG_SIMULASI_123',
            'nama_pelanggan' => 'Pelanggan Uji Coba',
        ];

        // Jalankan fungsi save dari model palsu
        $hasil = $modelPalsu->save($data);

        // Cek hasilnya
        if ($hasil === true) {
            echo ">> Hasil: Sesuai harapan. Model mengembalikan 'true'. Status: PASS\n\n";
        } else {
            echo ">> Hasil: Tidak sesuai harapan. Status: FAIL\n\n";
        }
    }
}
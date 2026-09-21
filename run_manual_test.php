<?php
// File: run_manual_test.php (VERSI PERBAIKAN)

define('FCPATH', __DIR__ . '/public/');
chdir(__DIR__);

require __DIR__ . '/vendor/autoload.php';

// Panggil file Test yang sudah Anda perbaiki
require __DIR__ . '/tests/unit/PelangganModelTest.php';

echo "========================================\n";
echo "MEMULAI SIMULASI UNIT TESTING MANUAL\n";
echo "========================================\n\n";

// Buat objek dari kelas Test Anda yang BENAR
$pengujian = new \Tests\Unit\PelangganModelTest();

// Jalankan method test Anda
$pengujian->testSaveDataPelanggan();

echo "========================================\n";
echo "SIMULASI SELESAI\n";
echo "========================================\n";
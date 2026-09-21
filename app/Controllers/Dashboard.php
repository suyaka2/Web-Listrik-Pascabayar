<?php

namespace App\Controllers;
use App\Models\M_Tagihan;
use App\Models\M_Pembayaran;
use App\Models\M_Pelanggan;
use App\Models\M_User;
class Dashboard extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    // public function dashboard_admin(){
    //      if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "" or session()->get('ses_nama_level') == "") {
    //     session()->setFlashdata('error', "Silahkan login terlebih dahulu");
    //     
    //     }else{

    //         $uri = service('uri');
    //         $halaman = $uri->getSegment(2);
    //         $data['halaman'] = $halaman;
    //         $title['title'] = "Dashboard";
    //         echo view('Template/sidebar', $data);
    //         echo view('Template/header', $title);
    //         echo view('dashboard', $data);
    //         echo view('Template/footer', $data);
    //     }
    // }


    public function dashboard_admin()
{
    // Pengecekan session dengan format yang Anda berikan
    if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "" or session()->get('ses_nama_level') == "") {
        session()->setFlashdata('error', "Silakan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
    } else {
        // --- PENGAMBILAN DATA UNTUK WIDGET ---
        $modelPelanggan  = new M_Pelanggan();
        $modelTagihan    = new M_Tagihan();
        $modelPembayaran = new M_Pembayaran();
        $modelUser       = new M_User();

        // 1. Hitung total pelanggan
        $data['total_pelanggan'] = $modelPelanggan->countAllResults();

        // 2. Hitung tagihan yang belum lunas
        $data['tagihan_belum_lunas'] = $modelTagihan->where('status', 'Belum Lunas')->countAllResults();
        $data['tagihan_sudah_lunas'] = $modelTagihan->where('status', 'Lunas')->countAllResults();

        // 3. Hitung total pendapatan dari semua pembayaran
        $total_pendapatan_query = $modelPembayaran->selectSum('total_bayar', 'total')->get()->getRow();
        $data['total_pendapatan'] = $total_pendapatan_query->total ?? 0;

        // 4. Hitung total admin (asumsi level admin adalah 'LV001')
        $data['total_admin'] = $modelUser->where('id_level', 'LV001')->countAllResults();
        // --- AKHIR PENGAMBILAN DATA ---

        $uri = service('uri');
        $halaman = $uri->getSegment(2);
        $data['halaman'] = $halaman;
        $title['title'] = "Dashboard";

        echo view('Template/sidebar', $data);
        echo view('Template/header', $title);
        echo view('dashboard', $data); // Kirim $data yang sudah lengkap ke view
        echo view('Template/footer', $data);
    }
}
    public function dashboard_pelanggan2(){
         if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', "Silahkan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-pelanggan'); ?>";
        </script>
        <?php
        }else{

            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $data['title'] = "Dashboard";
            echo view('Template/sidebar', $data);
            echo view('Template/header', $data);
            echo view('dashboard-pelanggan', $data);
            echo view('Template/footer', $data);
        }
        
        
    }

    public function dashboard_pelanggan()
{
    // Cek session login pelanggan
    $id_pelanggan_login = session()->get('ses_id_pelanggan'); 

    if (empty($id_pelanggan_login) || session()->get('ses_level') != 'LV002' || session()->get('ses_nama_level') != 'Pelanggan') {
        session()->setFlashdata('error', "Silakan login sebagai pelanggan terlebih dahulu!");
        return redirect()->to('/login-pelanggan');
    } else {
        // Inisiasi model yang dibutuhkan
        $modelTagihan = new M_Tagihan();
        $modelPelanggan = new M_Pelanggan();
        $modelPembayaran = new M_Pembayaran();

        // --- KUMPULKAN DATA UNTUK WIDGET ---

        // 1. Ambil info tagihan yang belum lunas
        $where_tagihan = ['tagihan.id_pelanggan' => $id_pelanggan_login, 'status' => 'Belum Lunas'];
        $data['tagihan_aktif'] = $modelTagihan->getDataTagihanJoin($where_tagihan)->getRowArray();
        if ($data['tagihan_aktif']) {
            $biaya_admin = 2500; // Tentukan biaya admin di sini
            // Buat key baru untuk total keseluruhan
            $data['tagihan_aktif']['total_plus_admin'] = $data['tagihan_aktif']['total_tagihan_calculated'] + $biaya_admin;
        }

        // 2. Ambil info detail pelanggan (untuk nomor KWH dan daya)
        $data['info_pelanggan'] = $modelPelanggan->getDataPelangganJoin(['pelanggan.id_pelanggan' => $id_pelanggan_login])->getRowArray();
        
        // 3. Hitung total riwayat pembayaran
        $data['total_pembayaran'] = $modelPembayaran->where('id_pelanggan', $id_pelanggan_login)->countAllResults();


        // --- PERSIAPAN UNTUK VIEW ---
        $uri = service('uri');
        $data['halaman'] = $uri->getSegment(1); // Ambil 'pelanggan' atau segmen pertama
        $title['title'] = "Dashboard";

        echo view('Template/sidebar', $data);
        echo view('Template/header', $title);
        echo view('dashboard-pelanggan', $data); // Pastikan nama file view adalah dashboard.php
        echo view('Template/footer', $data);
    }
}

}

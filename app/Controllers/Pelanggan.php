<?php

namespace App\Controllers;
use App\Models\M_Tagihan;
use App\Models\M_Pembayaran;


class Pelanggan extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function master_data_tagihan(){
         if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', "Silahkan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
        }else{
            $uri = service('uri');
            $modelPelanggan = new M_Pelanggan();
            $modelTagihan = new M_Tagihan();
            $modelPenggunaan = new M_Penggunaan();
       
            $idEdit = $uri->getSegment(3);
            $dataTagihan = $modelTagihan->getDataTagihanJoin()->getResultArray();
            $data['data_pelanggan'] = $modelPelanggan->findAll();
            $data['data_penggunaan'] = $modelPenggunaan->findAll();
            $data['data_tagihan'] = $dataTagihan;
            $data['edit_tagihan']=$dataTagihan;
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            echo view('Template/sidebar', $data);
            echo view('Template/header', $data);
            echo view('Pelanggan/data-tagihan', $data);
            echo view('Template/footer', $data);
        }
        
    }

    // Sesuaikan nama fungsi ini jika ini untuk controller Pelanggan
public function tagihan() 
{
    // Cek session login pelanggan
    // 'ses_id_pelanggan' adalah session yang kita buat saat pelanggan berhasil login
    $id_pelanggan_login = session()->get('ses_id_pelanggan'); 

    if (empty($id_pelanggan_login) || session()->get('ses_level') != 'LV002') {
        session()->setFlashdata('error', "Silakan login sebagai pelanggan terlebih dahulu!");
        return redirect()->to('/login-pelanggan');
    } else {
        $modelTagihan = new M_Tagihan();

        // Siapkan filter berdasarkan id_pelanggan yang login
        $where = ['tagihan.id_pelanggan' => $id_pelanggan_login];
        
        // Panggil fungsi JOIN dengan filter 'where'
        $data['data_tagihan'] = $modelTagihan->getDataTagihanJoin($where)->getResultArray();

        // Anda tidak perlu mengambil data lain secara terpisah
        // $data['data_pelanggan'] = ... (HAPUS)
        // $data['data_penggunaan'] = ... (HAPUS)

        $uri = service('uri');
        $data['halaman'] = $uri->getSegment(2);
        $title['title'] = "Data Tagihan Anda";

        // Kirim data ke view
        echo view('Template/sidebar', $data);
        echo view('Template/header', $title);
        echo view('Pelanggan/data-tagihan', $data);
        echo view('Template/footer', $data);
    }
}
public function pembayaran() 
{
    // Cek session login pelanggan
    // 'ses_id_pelanggan' adalah session yang kita buat saat pelanggan berhasil login
    //  dd(session()->get()); 
    $id_pelanggan_login = session()->get('ses_id_pelanggan'); 

    if (empty($id_pelanggan_login) || session()->get('ses_level') != 'LV002') {
        session()->setFlashdata('error', "Silakan login sebagai pelanggan terlebih dahulu!");
        return redirect()->to('/login-pelanggan');
    } else {
        $modelPembayaran = new M_Pembayaran();

        // Siapkan filter berdasarkan id_pelanggan yang login
        $where = ['pembayaran.id_pelanggan' => $id_pelanggan_login];
        
        // Panggil fungsi JOIN dengan filter 'where'
        $data['data_pembayaran'] = $modelPembayaran->getDataPembayaranJoin($where)->getResultArray();

        // Anda tidak perlu mengambil data lain secara terpisah
        // $data['data_pelanggan'] = ... (HAPUS)
        // $data['data_penggunaan'] = ... (HAPUS)

        $uri = service('uri');
        $data['halaman'] = $uri->getSegment(2);
        $title['title'] = "History Pembayaran";

        // Kirim data ke view
        echo view('Template/sidebar', $data);
        echo view('Template/header', $title);
        echo view('Pelanggan/data-pembayaran', $data);
        echo view('Template/footer', $data);
    }
}


public function simpan_pembayaran_pelanggan()
{
    // ... (kode untuk cek session dan ambil data POST lainnya) ...
    $id_pelanggan_login = session()->get('ses_id_pelanggan'); 
    if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
        return redirect()->to('/login-admin')->with('error', 'Silakan login terlebih dahulu!');
    }

    // 2. Inisiasi model
    $modelPembayaran = new M_Pembayaran();
    $modelTagihan = new M_Tagihan();

     // 3. Ambil data dari form
    $id_tagihan         = $this->request->getPost('id_tagihan');
    $id_pelanggan       = $this->request->getPost('id_pelanggan');
    $tanggal_pembayaran = $this->request->getPost('tanggal_pembayaran');
    $biaya_admin        = $this->request->getPost('biaya_admin');
    $total_bayar        = $this->request->getPost('total_bayar');
    $nominal_input      = $this->request->getPost('nominal_bayar');
    
    list($tahun, $bulan) = explode('-', $tanggal_pembayaran);
    $id_pelanggan_login = session()->get('ses_id');
    // ... dst ...

    if ($nominal_input != $total_bayar) {
        // Jika tidak sama, kembalikan ke halaman sebelumnya dengan pesan error
        session()->setFlashdata('error', 'Pembayaran Gagal! Nominal yang Anda masukkan tidak sesuai dengan total tagihan.');
        return redirect()->back()->withInput();
    }
    

    // AMBIL ID ADMIN YANG LOGIN DARI SESSION
    // Sesuaikan 'ses_id' dengan nama key session yang Anda gunakan saat login

   // 4. Siapkan dan INSERT data ke tabel pembayaran

    //    $id_pelanggan = $id_pelanggan_login; 

    
    $hasil = $modelPembayaran->autoNumber()->getRowArray();
    if(!$hasil){
        $id = "PMB001";
    }
    else{
        $kode = $hasil['id_pembayaran'];
        $noUrut = (int) substr($kode, -3);
        $noUrut++;
        $id = "PMB".sprintf("%03s", $noUrut);
    }


    $dataPembayaran = [
        'id_tagihan'         => $id_tagihan,
        'id_pembayaran'      => $id,
        'id_pelanggan'       => $id_pelanggan,
        'tanggal_pembayaran' => $tanggal_pembayaran,
        'bulan_bayar'        => $bulan,
        'biaya_admin'        => $biaya_admin,
        'total_bayar'        => $total_bayar,
        'id_user'            => $id_pelanggan_login
    ];

    $dataTagihan = [
        'status' => 'Lunas'
    ];

    // 2. Update status di tabel 'tagihan' menjadi "Lunas"
    $dataUpdateTagihan = ['status' => 'Lunas'];
    $where = ['id_tagihan' => $id_tagihan];
    $modelTagihan->updateDataTagihan($dataUpdateTagihan, $where); // Ini adalah UPDATE


    // Lanjutkan dengan proses insert ke database
    // $modelPembayaran = new M_Pembayaran();
    $modelPembayaran->saveDataPembayaran($dataPembayaran);

    // ... (update status tagihan, redirect, dll) ...
    // 6. Beri notifikasi dan redirect
    session()->setFlashdata('success', 'Pembayaran berhasil dikonfirmasi.');
    return redirect()->to('/pelanggan/data-tagihan');
}


   
}

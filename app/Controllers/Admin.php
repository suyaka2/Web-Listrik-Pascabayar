<?php

namespace App\Controllers;
use App\Models\M_Tarif;
use App\Models\M_Pelanggan;
use App\Models\M_User;
use App\Models\M_Penggunaan;
use App\Models\M_Tagihan;
use App\Models\M_Pembayaran;


class Admin extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function master_data_pelanggan(){
         if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "" or session()->get('ses_nama_level') == "") {
        session()->setFlashdata('error', "Silahkan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
        }else{
            $uri = service('uri');
            $modelPelanggan = new M_Pelanggan();
            $modelTarif = new M_Tarif();
            $idEdit = $uri->getSegment(3);
            $dataPelanggan = $modelPelanggan->getDataPelangganJoin()->getResultArray();
            $data['data_daya'] = $modelTarif->getDataTarif()->getResultArray();
            // $data['data_daya'] = $modelTarif->findAll();
            $data['data_pelanggan'] = $dataPelanggan;
            $data['edit_pelanggan']=$dataPelanggan;
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $title['title'] = "Data Pelanggan";
            echo view('Template/sidebar', $data);
            echo view('Template/header', $title);
            echo view('Admin/data-pelanggan', $data);
            echo view('Template/footer', $data);
        }
        
    }

     public function simpan_data_pelanggan(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelPelanggan = new M_Pelanggan; // inisiasi
            $modelTarif = new M_Tarif; // inisiasi
            $modelUser = new M_User; // inisiasi

            $nama = $this->request->getPost('nama');
            
            $alamat = $this->request->getPost('alamat');
            $nolistrik = $this->request->getPost('nolistrik');
            $daya = $this->request->getPost('daya');
            $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

            $cekUsername = $modelPelanggan->getDataPelanggan(['username' => $username])->getNumRows();
            $cekNolistrik = $modelPelanggan->getDataPelanggan(['nomor_kwh' => $nolistrik])->getNumRows();
            if($cekUsername > 0){
                session()->setFlashdata('error','Username sudah digunakan!!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            } else{
                if($cekNolistrik > 0){
                    session()->setFlashdata('error','Nomor Listrik sudah digunakan!!');
                    ?>
                    <script>
                        history.go(-1);
                    </script>
                    <?php
            }
            else{

                $hasil = $modelPelanggan->autoNumber()->getRowArray();
                if(!$hasil){
                    $id = "PLG001";
                }
                else{
                    $kode = $hasil['id_pelanggan'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "PLG".sprintf("%03s", $noUrut);
                }

            $hasilUser = $modelUser->autoNumber()->getRowArray();
            if (!$hasilUser) {
                $idUser = "USR001";
            } else {
                $kode = $hasilUser['id_user'];
                $noUrut = (int) substr($kode, -3);
                $noUrut++;
                $idUser = "USR" . sprintf("%03s", $noUrut);
            }

            $dataUser = [
                'id_user' => $idUser,
                
                'username' => $username,
                
                'password' => password_hash($password, PASSWORD_DEFAULT), // Enkripsi password
                'id_level' => 'LV002',
                
            ];
            $modelUser->saveDataUser($dataUser);

            
            $dataSimpan = [
                'id_pelanggan' => $id,
                'nama_pelanggan' => $nama,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                
                'alamat' => $alamat,
                
                'nomor_kwh' => $nolistrik,
                'id_tarif' => $daya,
               
                
                
            ];
            $modelPelanggan->saveDataPelanggan($dataSimpan);
            session()->setFlashdata('success', "Data Pelanggan Berhasil Ditambahkan!");
            ?>
            <script>
                document.location = "<?= base_url('admin/data-pelanggan');?>";
            </script>
            <?php 
            }      
        }
    }
    }
    public function update_data_pelanggan(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelPelanggan = new M_Pelanggan; // inisiasi
            $modelTarif = new M_Tarif; // inisiasi
            $modelUser = new M_User; // inisiasi

            $idUpdate = $this->request->getPost('id_pelanggan');

            // Kode baru yang sudah diperbaiki
            // $pelangganLama = $modelPelanggan->where('id_pelanggan', $idUpdate)->first();
            $pelangganLama = $modelPelanggan->where('id_pelanggan', $idUpdate)->get()->getRowArray();
            if (!$pelangganLama) {
                session()->setFlashdata('error', 'Data pelanggan tidak ditemukan!');
                return redirect()->to(base_url('admin/data-pelanggan'));
            }
            // Cari user berdasarkan username LAMA untuk mendapatkan ID User-nya
            // $userLama = $modelUser->where('username', $pelangganLama['username'])->first();
            $userLama = $modelUser->where('username', $pelangganLama['username'])->get()->getRowArray();
            if (!$userLama) {
                session()->setFlashdata('error', 'Data user tidak ditemukan!');
                return redirect()->to(base_url('admin/data-pelanggan'));
            }
            $id_user_update = $userLama['id_user']; //


            $nama = $this->request->getPost('edit_nama');
            
            $alamat = $this->request->getPost('edit_alamat');
            $nolistrik = $this->request->getPost('edit_nomor_kwh');
            $daya = $this->request->getPost('edit_id_tarif');
            $username = $this->request->getPost('edit_username');
            $password = $this->request->getPost('edit_password');

            $cekUsername = $modelPelanggan->where('username', $username)
                                      ->where('id_pelanggan !=', $idUpdate) // Kecualikan data yg sedang diedit
                                      ->get()
                                      ->getNumRows();
            // $cekNolistrik = $query->getNumRows();

            $cekNolistrik = $modelPelanggan->where('nomor_kwh', $nolistrik)
                                       ->where('id_pelanggan !=', $idUpdate) // Kecualikan data yg sedang diedit
                                       ->get()
                                       ->getNumRows();

            if($cekUsername > 0){
                session()->setFlashdata('error','Username sudah digunakan!!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            }
            else 
                if($cekNolistrik > 0){
                    session()->setFlashdata('error','Nomor Listrik sudah digunakan!!');
                    ?>
                    <script>
                        history.go(-1);
                    </script>
                    <?php
            }
            else{

                

            $dataUser = [
                // 'id_user' => $idUser,
                
                'username' => $username,
                
                 // Enkripsi password
                // 'id_level' => 'LVL002',
                
            ];
            //  if (!empty($password)) {
            // $dataUser['password'] = password_hash($password, PASSWORD_DEFAULT);
            // }
            
            
            $dataSimpan = [
                // 'id_pelanggan' => $id,
                'nama_pelanggan' => $nama,
                'username' => $username,
                // 'passowrd' => $dataUpdate,
                
                
                'alamat' => $alamat,
                
                'nomor_kwh' => $nolistrik,
                'id_tarif' => $daya,
               
                
                
                
            ];
            // if (!empty($password)) {
            //     $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
            // }

            // 2. Jika password diisi, hash password sekali saja, lalu tambahkan ke kedua array
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $dataUser['password'] = $hashedPassword;
                $dataSimpan['password'] = $hashedPassword;
            }
            $modelUser->updateDataUser($dataUser, ['id_user' => $id_user_update]);
            $modelPelanggan->updateDataPelanggan($dataSimpan, ['id_pelanggan' => $idUpdate]);
            session()->remove('idUpdate');
            session()->setFlashdata('success', "Data Pelanggan Berhasil Diperbarui!");
            ?>
            <script>
                document.location = "<?= base_url('admin/data-pelanggan');?>";
            </script>
            <?php 
            }      
        }
    }
    

    public function update_data_pelanggan2()
{
    if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
    <?php
    } else {
        $modelPelanggan = new M_Pelanggan; // inisiasi
        $modelUser = new M_User; // inisiasi

        $idUpdate = $this->request->getPost('id_pelanggan');

        // Mengambil data lama untuk mendapatkan username (digunakan untuk mencari id_user)
        $pelangganLama = $modelPelanggan->where('id_pelanggan', $idUpdate)->first();
        if (!$pelangganLama) {
            session()->setFlashdata('error', 'Data pelanggan tidak ditemukan!');
            return redirect()->to(base_url('admin/data-pelanggan'));
        }
        
        $userLama = $modelUser->where('username', $pelangganLama['username'])->first();
        if (!$userLama) {
            session()->setFlashdata('error', 'Data user terkait tidak ditemukan!');
            return redirect()->to(base_url('admin/data-pelanggan'));
        }
        $id_user_update = $userLama['id_user'];


        // Mengambil data dari form edit
        $nama = $this->request->getPost('edit_nama');
        $alamat = $this->request->getPost('edit_alamat');
        $nolistrik = $this->request->getPost('edit_nomor_kwh');
        $daya = $this->request->getPost('edit_id_tarif');
        $username = $this->request->getPost('edit_username');
        $password = $this->request->getPost('edit_password');

        // Cek Username: Apakah username baru sudah dipakai oleh PELANGGAN LAIN?
        $cekUsername = $modelPelanggan->where('username', $username)
            ->where('id_pelanggan !=', $idUpdate) // Kecualikan data yg sedang diedit
            ->get()
            ->getNumRows();

        // Cek No Listrik: Apakah no listrik baru sudah dipakai oleh PELANGGAN LAIN?
        $cekNolistrik = $modelPelanggan->where('nomor_kwh', $nolistrik)
            ->where('id_pelanggan !=', $idUpdate) // Kecualikan data yg sedang diedit
            ->get()
            ->getNumRows(); // <-- KESALAHAN UTAMA DI SINI, LUPA TITIK KOMA (;)

        // --- STRUKTUR VALIDASI YANG DIPERBAIKI ---
        if ($cekUsername > 0) {
            session()->setFlashdata('error', 'Username sudah digunakan oleh pelanggan lain!');
?>
            <script>
                history.go(-1);
            </script>
        <?php
        } else if ($cekNolistrik > 0) { // Menggunakan 'else if' agar lebih rapi
            session()->setFlashdata('error', 'Nomor Listrik sudah digunakan oleh pelanggan lain!');
?>
            <script>
                history.go(-1);
            </script>
        <?php
        } else {
            // --- JIKA LOLOS VALIDASI, LANJUTKAN PROSES UPDATE ---

            $dataUser = [
                'username' => $username,
            ];
            // Hanya update password jika field password diisi
            if (!empty($password)) {
                $dataUser['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $dataSimpan = [
                'nama_pelanggan' => $nama,
                'username' => $username,
                'alamat' => $alamat,
                'nomor_kwh' => $nolistrik,
                'id_tarif' => $daya,
            ];
            // PERBAIKAN LOGIKA: Hanya update password di tabel pelanggan jika diisi
            if (!empty($password)) {
                $dataSimpan['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Jalankan proses update
            $modelUser->updateDataUser($dataUser, ['id_user' => $id_user_update]);
            $modelPelanggan->updateDataPelanggan($dataSimpan, ['id_pelanggan' => $idUpdate]);

            session()->setFlashdata('success', "Data Pelanggan Berhasil Diperbarui!");
?>
            <script>
                document.location = "<?= base_url('admin/data-pelanggan'); ?>";
            </script>
<?php
        }
    }
}
    


     public function hapus_data_pelanggan($id_pelanggan = null)
    {
        // Cek session jika perlu
        if (session()->get('ses_id') == "") {
            return redirect()->to('/login-admin');
        }

        // Cek apakah ID pelanggan ada
        if (empty($id_pelanggan)) {
            return redirect()->to('/admin/data-pelanggan')->with('error', 'ID Pelanggan tidak valid.');
        }

        // Inisiasi kedua model yang dibutuhkan
        $modelPelanggan = new M_Pelanggan();
        $modelUser = new M_User(); // Pastikan Anda juga punya M_User

        // 1. Cari data pelanggan untuk mendapatkan username-nya
        $pelanggan = $modelPelanggan->where('id_pelanggan', $id_pelanggan)->first();

        // Jika data pelanggan ditemukan, lanjutkan untuk menghapus user
        if ($pelanggan) {
            $username_pelanggan = $pelanggan['username'];
            
            // 2. Hapus data dari tabel 'user' berdasarkan username
            // Asumsi di M_User ada fungsi deleteDataUser atau kita bisa langsung
            $modelUser->where('username', $username_pelanggan)->delete();
            
            // 3. Hapus data dari tabel 'pelanggan' berdasarkan id_pelanggan
            // Menggunakan where()->delete() agar tidak bergantung pada primaryKey di model
            $modelPelanggan->where('id_pelanggan', $id_pelanggan)->delete();

            session()->setFlashdata('success', 'Data Pelanggan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data Pelanggan tidak ditemukan untuk dihapus.');
        }

        return redirect()->to('admin/data-pelanggan');
    }


    public function master_data_tarif(){
         if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', "Silahkan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
        }else{
            $uri = service('uri');
            $modelTarif = new M_Tarif;
            $idEdit = $uri->getSegment(3);
            $data['data_tarif'] = $modelTarif->findAll();
            $dataTarif = $modelTarif->getDataTarif(['id_tarif' => $idEdit])->getRowArray();
            $data['edit_tarif']=$dataTarif;

            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $title['title'] = "Data Daya & Tarif Listrik";
            echo view('Template/sidebar',$data);
            echo view('Template/header',$title);
            echo view('Admin/data-tarif',$data);
            echo view('Template/footer',$data);
        }
        
    }

     public function simpan_data_tarif(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelTarif = new M_Tarif; // inisiasi
            

            $daya = $this->request->getPost('daya');
            $tarif = $this->request->getPost('tarif');
            

            

                $hasil = $modelTarif->autoNumber()->getRowArray();
                if(!$hasil){
                    $id = "TRF001";
                }
                else{
                    $kode = $hasil['id_tarif'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "TRF".sprintf("%03s", $noUrut);
                }

              
            $dataSimpan = [
                'id_tarif' => $id,
                'daya' => $daya,
                'tarifperkwh' => $tarif,
                
                
                
            ];
            $modelTarif->saveDataTarif($dataSimpan);
            session()->setFlashdata('success', "Data Tarif Berhasil Ditambahkan!");
            ?>
            <script>
                document.location = "<?= base_url('admin/data-tarif');?>";
            </script>
            <?php 
            }      
        
    }


    public function update_data_tarif(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelTarif = new M_Tarif; // inisiasi
            $daya = $this->request->getPost('edit_daya');
            $tarif = $this->request->getPost('edit_tarif');
            $idUpdate = $this->request->getPost('id_tarif');


            $dataSimpan = [
                'daya' => $daya,
                'tarifperkwh' => $tarif,
                // 'updated_at' => date('Y-m-d H:i:s')
            ];
            $modelTarif->updateDataTarif($dataSimpan, ['id_tarif' => $idUpdate]);
            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Daya Dan Tarif Listrik Berhasil Diperbarui!!');
            ?>
            <script>
                document.location = "<?= base_url('admin/data-tarif');?>";
            </script>
            <?php
        }
    }

  
    public function hapus_data_tarif($id_tarif = null)
    {
        // Cek session jika perlu
        if (session()->get('ses_id') == "") {
            return redirect()->to('/login-admin');
        }

        // Cek apakah ID ada
        if (empty($id_tarif)) {
            return redirect()->to('/admin/data-tarif')->with('error', 'ID Tarif tidak valid.');
        }

        $modelTarif = new M_Tarif();
        // Langsung gunakan ID dari parameter URL
        $modelTarif->deleteDataTarif($id_tarif);

        session()->setFlashdata('success', 'Data Tarif berhasil dihapus.');
        return redirect()->to('/admin/data-tarif');
    }


    public function master_data_penggunaan(){
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
            $modelPenggunaan = new M_Penggunaan();
            $idEdit = $uri->getSegment(3);
            $dataPenggunaan = $modelPenggunaan->getDataPenggunaanJoin()->getResultArray();
            $data['data_pelanggan'] = $modelPelanggan->findAll();
            $data['data_penggunaan'] = $dataPenggunaan;
            $data['edit_penggunaan']=$dataPenggunaan;
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $title['title'] = "Data Penggunaan Listrik Pelanggan";

            // $dataPenggunaan = $modelDataPenggunaan->getDataPenggunaanJoin()->getResultArray();
            // $data['data_pelanggan'] = $modelDataPelanggan->findAll();

            echo view('Template/sidebar', $data);
            echo view('Template/header', $title);
            echo view('Admin/data-penggunaan', $data);
            echo view('Template/footer', $data);
        }
        
    }

    public function simpan_data_penggunaan(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelPelanggan = new M_Pelanggan; // inisiasi
            $modelPenggunaan = new M_Penggunaan; // inisiasi
            $modelTagihan = new M_Tagihan;
            $modelTarif = new M_Tarif;
          
            $nama = $this->request->getPost('nama');
            
            $periode = $this->request->getPost('periode');
            $meter_awal = $this->request->getPost('meter_awal');
            $meter_akhir = $this->request->getPost('meter_akhir');
        // $password = $this->request->getPost('password');
        // dd($this->request->getPost());

        $periodeFull = $periode . '-01'; // Tambahkan '-01' untuk membuat format tanggal lengkap
        
        //  list($tahun, $bulan) = explode('-', '.', $periode);
         // --- BAGIAN PENTING: PROSES PERHITUNGAN ---

        // 3. Hitung jumlah meter yang digunakan
        $jumlah_meter = $meter_akhir - $meter_awal;

        // 4. Dapatkan detail pelanggan untuk mengambil id_tarifnya
         $dataPelanggan = $modelPelanggan->where('id_pelanggan', $nama)->first();
        $id_tarif = $dataPelanggan['id_tarif'];

        // 5. Dapatkan tarif per kWh dari tabel tarif
        $dataTarif = $modelTarif->where('id_tarif', $id_tarif)->first();
        $tarif_per_kwh = $dataTarif['tarifperkwh'];

        // 6. Hitung total tagihan
        $total_tagihan = $jumlah_meter * $tarif_per_kwh;

                $hasil = $modelPenggunaan->autoNumber()->getRowArray();
                if(!$hasil){
                    $id = "PNG001";
                }
                else{
                    $kode = $hasil['id_penggunaan'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "PNG".sprintf("%03s", $noUrut);
                }

                
                $tagihan = $modelTagihan->autoNumber()->getRowArray();
                if(!$tagihan){
                    $id_tagihan = "TGH001";
                }
                else{
                    $kode = $tagihan['id_tagihan'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id_tagihan = "TGH".sprintf("%03s", $noUrut);
                }
            $dataSimpan = [
                'id_penggunaan' => $id,
                'id_pelanggan' => $nama,
                'bulan' => $periodeFull,
                'tahun' => $periodeFull,
                'meter_awal' => $meter_awal,
                'meter_akhir' => $meter_akhir,
            ];

            $dataSimpan_Tagihan = [
                'id_tagihan' => $id_tagihan,
                'id_penggunaan' => $id,
                'id_pelanggan' => $nama,
                'bulan' => $periodeFull,
                'tahun' => $periodeFull,
                'jumlah_meter' => $jumlah_meter,
                'status' => 'Belum Lunas',
            ];
             
    

            $modelPenggunaan->saveDataPenggunaan($dataSimpan);
            $modelTagihan->saveDataTagihan($dataSimpan_Tagihan);
            session()->setFlashdata('success', "Data Penggunaan & Tagihan Berhasil Ditambahkan!");
            ?>
            <script>
                document.location = "<?= base_url('admin/data-penggunaan');?>";
            </script>
            <?php 
            }      
        
    }

            // Di dalam controller Admin.php
    public function get_meter_terakhir()
    {
        if ($this->request->isAJAX()) {
            $modelPenggunaan = new M_Penggunaan();
            
            $id_pelanggan = $this->request->getPost('id_pelanggan');
            $periodeInput = $this->request->getPost('periode');

            if (empty($id_pelanggan) || empty($periodeInput)) {
                return $this->response->setJSON(['meter_awal' => 0]);
            }

            $tanggal = new \DateTime($periodeInput . '-01');
            $tanggal->modify('-1 month');
            $tahun_sebelumnya = $tanggal->format('Y');
            
            // --- PERBAIKAN DI SINI ---
            // Ubah 'n' menjadi 'm' agar menghasilkan bulan dengan nol di depan (01-12)
            $bulan_sebelumnya = $tanggal->format('m'); 

            // Cari data penggunaan di bulan sebelumnya
            $dataPenggunaanLalu = $modelPenggunaan->where([
                'id_pelanggan' => $id_pelanggan,
                'bulan'        => $bulan_sebelumnya,
                'tahun'        => $tahun_sebelumnya
            ])->first();

            if ($dataPenggunaanLalu) {
                // Jika data bulan lalu ditemukan
                return $this->response->setJSON(['meter_awal' => $dataPenggunaanLalu['meter_akhir']]);
            } else {
                // Jika tidak ditemukan
                return $this->response->setJSON(['meter_awal' => 0]);
            }
        }
    }
        public function update_data_penggunaan2(){
            if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
                session()->setFlashdata('error','Silakan login terlebih dahulu!');
                ?>
                <script>
                    document.location = "<?= base_url('/login-admin');?>";
                </script>
                <?php
            }
            else{
                $modelTagihan = new M_Tagihan; // inisiasi
                $modelPenggunaan = new M_Penggunaan; // inisiasi
            
                $nama = $this->request->getPost('edit_id_pelanggan');

                $idUpdate = $this->request->getPost('id_penggunaan');
                $idUpdate2 = $this->request->getPost('id_tagihan');
                
                $periode = $this->request->getPost('edit_periode');
                $meter_awal = $this->request->getPost('edit_meter_awal');
                $meter_akhir = $this->request->getPost('edit_meter_akhir');
            // $password = $this->request->getPost('password');

            list($tahun, $bulan) = explode('-', $periode);
 
            $dataSimpan = [
                
                // 'id_pelanggan' => $nama,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'meter_awal' => $meter_awal,
                'meter_akhir' => $meter_akhir,
            ];
            $dataTagihan = [
                
                // 'id_pelanggan' => $nama,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'meter_awal' => $meter_awal,
                'meter_akhir' => $meter_akhir,
            ];



            
            $modelPenggunaan->updateDataPenggunaan($dataSimpan, ['id_penggunaan' => $idUpdate]);
            $modelTagihan->updateDataTagihan($dataTagihan, ['id_tagihan' => $idUpdate2]);
            session()->setFlashdata('success', "Data Penggunaan Berhasil Diperbarui!");
            ?>
            <script>
                document.location = "<?= base_url('admin/data-penggunaan');?>";
            </script>
            <?php 
            }      
        }

    
    public function update_data_penggunaan()
{
    if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
    } else {
        $modelTagihan = new M_Tagihan;
        $modelPenggunaan = new M_Penggunaan;
        
        // Ambil semua data dari form
        $idUpdate = $this->request->getPost('id_penggunaan');
        $idUpdate2 = $this->request->getPost('id_tagihan');
        // dd($idUpdate2, $dataTagihan); 
        $periode = $this->request->getPost('edit_periode');
        $meter_awal = $this->request->getPost('edit_meter_awal');
        $meter_akhir = $this->request->getPost('edit_meter_akhir');

        // =========================================================
        //                      PERBAIKAN LOGIKA
        // =========================================================

        // 1. HITUNG ULANG JUMLAH METER (INI KUNCINYA)
        // Pastikan ini dihitung pertama kali dari data form yang baru.

        $jumlah_meter_baru = $meter_akhir - $meter_awal;

        // 2. Siapkan data HANYA untuk tabel 'penggunaan'
        $dataPenggunaan = [
            
             
            'meter_awal'  => $meter_awal, 
            'meter_akhir' => $meter_akhir,
        ];
        
        // 3. Siapkan data HANYA untuk tabel 'tagihan'
        $dataTagihan = [
            
            
            'jumlah_meter' => $jumlah_meter_baru,
        ];

        // Cek jika admin juga mengubah periode
        if (!empty($periode)) {
            list($tahun, $bulan) = explode('-', $periode);
            $dataPenggunaan['bulan'] = $bulan;
            $dataPenggunaan['tahun'] = $tahun;
            $dataTagihan['bulan'] = $bulan;
            $dataTagihan['tahun'] = $tahun;
        }


        // 4. JALANKAN UPDATE KE KEDUA TABEL
        $modelPenggunaan->updateDataPenggunaan($dataPenggunaan, ['id_penggunaan' => $idUpdate]);
        $modelTagihan->updateDataTagihan($dataTagihan, ['id_tagihan' => $idUpdate2]);
        
        // =========================================================

        session()->setFlashdata('success', "Data Penggunaan Berhasil Diperbarui!");
        ?>
        <script>
            document.location = "<?= base_url('admin/data-penggunaan'); ?>";
        </script>
        <?php
    }
}

    public function hapus_data_penggunaan($id_penggunaan = null)
    {
        // Cek session jika perlu
        if (session()->get('ses_id') == "") {
            return redirect()->to('/login-admin');
        }

        // Cek apakah ID pelanggan ada
        if (empty($id_penggunaan)) {
            return redirect()->to('/admin/data-penggunaan')->with('error', 'ID Pelanggan tidak valid.');
        }

        // Inisiasi kedua model yang dibutuhkan
        $modelPenggunaan = new M_Penggunaan();
         // Pastikan Anda juga punya M_User

        // 1. Cari data pelanggan untuk mendapatkan username-nya
        $penggunaan = $modelPenggunaan->where('id_penggunaan', $id_penggunaan)->first();

        // Jika data pelanggan ditemukan, lanjutkan untuk menghapus user
        if ($modelPenggunaan) {
            
            
            // 2. Hapus data dari tabel 'user' berdasarkan username
            // Asumsi di M_User ada fungsi deleteDataUser atau kita bisa langsung
            
            
            // 3. Hapus data dari tabel 'pelanggan' berdasarkan id_pelanggan
            // Menggunakan where()->delete() agar tidak bergantung pada primaryKey di model
            $modelPenggunaan->where('id_penggunaan', $id_penggunaan)->delete();

            session()->setFlashdata('success', 'Data Penggunaan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data Penggunaan tidak ditemukan untuk dihapus.');
        }

        return redirect()->to('admin/data-penggunaan');
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
        //     // ===================================================================
        // //           BLOK SINKRONISASI (HANYA UNTUK DIJALANKAN SEKALI)
        // // ===================================================================
        // $semuaPenggunaan = $modelPenggunaan->findAll();
        // foreach ($semuaPenggunaan as $penggunaan) {
        //     $tagihanAda = $modelTagihan->where('id_penggunaan', $penggunaan['id_penggunaan'])->first();
        //     if (!$tagihanAda) {
        //         $jumlah_meter = $penggunaan['meter_akhir'] - $penggunaan['meter_awal'];
        //         $dataPelanggan = $modelPelanggan->where('id_pelanggan', $penggunaan['id_pelanggan'])->first();
        //         // $dataTarif = $modelTarif->where('id_tarif', $id_tarif)->first();
        //         // $total_tagihan = $jumlah_meter * $dataTarif['tarifperkwh'];

        //         $hasilTagihan = $modelTagihan->autoNumber()->getRowArray();
        //         $idTagihan = !$hasilTagihan ? "TGH001" : "TGH" . sprintf("%03s", ((int) substr($hasilTagihan['id_tagihan'], -3)) + 1);

        //         $dataTagihanBaru = [
        //             'id_tagihan'    => $idTagihan,
        //             'id_penggunaan' => $penggunaan['id_penggunaan'],
        //             'id_pelanggan'  => $penggunaan['id_pelanggan'],
        //             'bulan'         => $penggunaan['bulan'],
        //             'tahun'         => $penggunaan['tahun'],
        //             'jumlah_meter'  => $jumlah_meter,
        //             // 'total_tagihan' => $total_tagihan,
        //             'status'        => 'Belum Lunas'
        //         ];
        //         $modelTagihan->saveDataTagihan($dataTagihanBaru);
        //     }
        // }
        // // ===================================================================
        // //                      AKHIR BLOK SINKRONISASI
        // // ===================================================================
            $idEdit = $uri->getSegment(3);
            $data['data_tagihan']= $modelTagihan->getDataTagihanJoin()->getResultArray();
            $data['data_pelanggan'] = $modelPelanggan->findAll();
            $data['data_penggunaan'] = $modelPenggunaan->findAll();
            // $data['data_tagihan'] = $dataTagihan;
            $data['edit_tagihan']=$data;
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $title['title'] = "Data Tagihan Listrik";
            // dd($data['data_tagihan']);

            echo view('Template/sidebar', $data);
            echo view('Template/header', $title);
            echo view('Admin/data-tagihan', $data);
            echo view('Template/footer', $data);
        }
        
    }
    public function master_data_pembayaran(){
         if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
        session()->setFlashdata('error', "Silahkan login terlebih dahulu");
        ?>
        <script>
            document.location = "<?= base_url('/login-admin'); ?>";
        </script>
        <?php
        }else{
            $uri = service('uri');
            $modelPembayaran = new M_Pembayaran();
            $modelTagihan = new M_Tagihan();
            $modelPelanggan = new M_Pelanggan();
        
            $idEdit = $uri->getSegment(3);
            $dataPembayaran = $modelPembayaran->getDataPembayaranJoin()->getResultArray();
            $data['data_pelanggan'] = $modelPelanggan->findAll();
            $data['data_tagihan'] = $modelTagihan->findAll();
            $data['data_pembayaran'] = $dataPembayaran;
            // $data['edit_tagihan']=$dataTagihan;
            $halaman = $uri->getSegment(2);
            $data['halaman'] = $halaman;
            $title['title'] = "Data Pembayaran Listrik";

            echo view('Template/sidebar', $data);
            echo view('Template/header', $title);
            echo view('Admin/data-pembayaran', $data);
            echo view('Template/footer', $data);
        }
        
    }


    // Di dalam controller Admin.php
    public function simpan_data_pembayaran2()
    {
        // ... (kode untuk cek session dan ambil data POST lainnya) ...
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
        
        list($tahun, $bulan) = explode('-', $tanggal_pembayaran);
        $id_admin_yang_login = session()->get('ses_id');
        // ... dst ...

        // AMBIL ID ADMIN YANG LOGIN DARI SESSION
        // Sesuaikan 'ses_id' dengan nama key session yang Anda gunakan saat login

        // 4. Siapkan dan INSERT data ke tabel pembayaran

        
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
            'id_user'            => $id_admin_yang_login
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
        return redirect()->to('/admin/data-tagihan');
    }

    public function simpan_data_pembayaran()
{
    // 1. Validasi & Keamanan: Cek session
    if (empty(session()->get('ses_id'))) {
        return redirect()->to('/login-admin')->with('error', 'Silakan login terlebih dahulu!');
    }

    // 2. Inisiasi model yang dibutuhkan
    $modelPembayaran = new M_Pembayaran();
    $modelTagihan = new M_Tagihan(); // Pastikan M_Tagihan sudah di-use

    // 3. Ambil data PENTING dari form
    $id_tagihan         = $this->request->getPost('id_tagihan');
    $tanggal_pembayaran = $this->request->getPost('tanggal_pembayaran');
    $biaya_admin        = (int) $this->request->getPost('biaya_admin');
    $total_bayar        = (int) $this->request->getPost('total_bayar');

    // 4. Ambil detail tagihan dari database untuk mendapatkan data yang valid
    // Ini cara paling aman untuk mendapatkan id_pelanggan, bulan, dan tahun
    // $tagihan = $modelTagihan->find($id_tagihan); 
    // if (!$tagihan) {
    //     return redirect()->back()->with('error', 'Data tagihan tidak ditemukan!');
    // }

    $tagihan = $modelTagihan->getDataTagihan(['id_tagihan' => $id_tagihan])->getRowArray(); 
    $where = ['id_tagihan' => $id_tagihan];

    // 5. Generate ID Pembayaran baru menggunakan fungsi autoNumber dari model Anda
    $hasil = $modelPembayaran->autoNumber()->getRowArray();
    if (!$hasil) {
        $id_pembayaran_baru = "PMB001";
    } else {
        $kode = $hasil['id_pembayaran'];
        $noUrut = (int) substr($kode, -3);
        $noUrut++;
        $id_pembayaran_baru = "PMB" . sprintf("%03s", $noUrut);
    }

    // 6. Siapkan data untuk disimpan ke tabel 'pembayaran'
    $dataPembayaran = [
        'id_pembayaran'      => $id_pembayaran_baru,
        'id_tagihan'         => $id_tagihan,
        'id_pelanggan'       => $tagihan['id_pelanggan'], // Diambil dari data tagihan yang valid
        'tanggal_pembayaran' => $tanggal_pembayaran,
        'bulan_bayar'        => $tagihan['bulan'], // Diambil dari data tagihan yang valid, BUKAN dari tanggal bayar
        'biaya_admin'        => $biaya_admin,
        'total_bayar'        => $total_bayar,
        'id_user'            => session()->get('ses_id') // ID admin yang sedang login
    ];

    // 7. Lakukan transaksi database
    // Simpan data pembayaran baru menggunakan fungsi dari model Anda
    $modelPembayaran->saveDataPembayaran($dataPembayaran);

    // Update status tagihan menjadi 'Lunas'
    // Menggunakan metode update standar CodeIgniter 4 yang lebih ringkas
    $dataUpdate = ['status' => 'Lunas'];
    $modelTagihan->updateDataTagihan($dataUpdate, $where);

    // 8. Beri notifikasi dan redirect
    session()->setFlashdata('success', 'Pembayaran berhasil dikonfirmasi.');
    return redirect()->to('/admin/data-tagihan');
}



    

}

<?php

namespace App\Controllers;
use App\Models\M_Pelanggan;
use App\Models\M_User;
class Login extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }


    public function form_login(){
        // $title = "Login Pelanggan";
        return view('/Login/login-pelanggan');
    }
    public function login_admin(){
        // $title = "Login Pelanggan";
        return view('/Login/login-admin');
    }

    public function logout(){
        session()->remove('ses_id');
        session()->remove('ses_user');
        session()->remove('ses_level');
        session()->setFlashdata('info', "Anda Telah Logout");
        ?>
            <script>
                document.location = "<?= base_url('/login-admin');?>";
            </script>
            <?php
    }

    public function logout_pelanggan(){
        session()->remove('ses_id');
        session()->remove('ses_user');
        session()->remove('ses_level');
        session()->remove('ses_nama_level');
        session()->setFlashdata('info', "Anda Telah Logout");
        ?>
            <script>
                document.location = "<?= base_url('/login-pelanggan');?>";
            </script>
            <?php
    }

     public function autentikasi_pelanggan2(){ 
        $modelPelanggan = new M_Pelanggan;
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $cekUsername = $modelPelanggan->getDataPelanggan(['username' => $username])->getNumRows();
        if($cekUsername == 0){
            session()->setFlashData('error', 'Username Tidak Ditemukan');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }
        else {
            $dataUser = $modelPelanggan->getDataPelanggan(['username' => $username])->getRowArray();
            $passwordUser = $dataUser['password'];
    
            $verifikasiPassword = password_verify($password, $passwordUser);
            if(!$verifikasiPassword){
                session()->setFlashData('error', 'Password Tidak Sesuai!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            }
            else{
                $modelUser = new M_User;
                $dataLogin = $modelUser->getDataUserJoin(['user.username' => $username])->getRowArray();
                
                // Simpan data session
                $dataSession = [
                    'ses_id' => $dataUser['id_pelanggan'],
                    'ses_user' => $dataUser['nama_pelanggan'],
                    'ses_level' => $dataLogin['id_level'],
                    
                ];
                session()->set($dataSession);
                session()->setFlashData('success', 'Login Berhasil!');
                ?>
                <script>
                    document.location = "<?= base_url('/dashboard');?>";
                </script>
                <?php
            }
        }
    }

   public function autentikasi_pelanggan() //ori
{
    $modelPelanggan = new M_Pelanggan();
    $modelUser = new M_User(); // Model user diperlukan
    
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Langkah 1: Cek di tabel 'user' terlebih dahulu, bukan 'pelanggan'
    $where = ['user.username' => $username];
    $dataUser = $modelUser->getDataUserJoin( $where)->getRowArray();

    // Jika username tidak ada di tabel user sama sekali
    if (!$dataUser) {
        session()->setFlashdata('error', 'Username Tidak Ditemukan');
        return redirect()->back()->withInput();
    }

    // Langkah 2: Verifikasi Password
    // Password yang benar ada di tabel 'user'
    if (password_verify($password, $dataUser['password'])) {
        
        // Langkah 3: Verifikasi Level
        // Pastikan yang login adalah level pelanggan
        if ($dataUser['id_level'] == 'LV002') {
            
            // Langkah 4: Ambil data detail dari tabel 'pelanggan'
            // Asumsi: 'username' juga disimpan di tabel pelanggan untuk jadi penghubung
            $dataPelanggan = $modelPelanggan->where('username', $where)->first();

            if ($dataPelanggan) {
                // Langkah 5: Buat Session dari data gabungan
                $dataSession = [
                    'ses_id'         => $dataUser['id_user'],
                    'ses_id_pelanggan' => $dataPelanggan['id_pelanggan'],
                    'ses_user'       => $dataPelanggan['nama_pelanggan'],
                    'ses_level'      => $dataUser['id_level'],
                    'ses_nama_level'      => $dataUser['nama_level'],
                    // 'is_login'       => true,
                ];
                session()->set($dataSession);

                return redirect()->to('/dashboard-pelanggan')->with('success',  ' Selamat datang, ' . $dataPelanggan['nama_pelanggan']);
            } else {
                // Ditemukan di tabel user, tapi tidak di tabel pelanggan
                return redirect()->back()->with('error', 'Profil pelanggan untuk akun ini tidak ditemukan.');
            }

        } else {
            // Jika yang login bukan pelanggan
            return redirect()->back()->with('error', 'Akun ini bukan akun pelanggan.');
        }

    } else {
        // Jika password salah
        return redirect()->back()->with('error', 'Password tidak sesuai!');
    }
}
     public function autentikasi_admin2(){ // ori
        $modelUser = new M_User;
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $cekUsername = $modelUser->getDataUser(['username' => $username])->getNumRows();
        if($cekUsername == 0){
            session()->setFlashData('error', 'Username Tidak Ditemukan');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }
        else {
            $dataUser = $modelUser->getDataUser(['username' => $username])->getRowArray();
            $passwordUser = $dataUser['password'];
    
            $verifikasiPassword = password_verify($password, $passwordUser);
            if(!$verifikasiPassword){
                session()->setFlashData('error', 'Password Tidak Sesuai!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            }
            else{
                
                // Simpan data session
                $dataSession = [
                    'ses_id' => $dataUser['id_user'],
                    'ses_user' => $dataUser['nama_admin'],
                    'ses_level' => $dataUser['id_level'],
                    'ses_nama_level' => $dataUser['nama_level'],
                    
                ];
                session()->set($dataSession);
                session()->setFlashData('success', 'Login Berhasil!');
                ?>
                <script>
                    document.location = "<?= base_url('/dashboard');?>";
                </script>
                <?php
            }
        }
    }

    public function autentikasi_admin3()
{
    $modelUser = new M_User;
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Gunakan klausa 'where' yang sama untuk semua query
    $where = ['user.username' => $username];
    
    // 1. Ambil data user LENGKAP dengan JOIN, CUKUP SATU KALI
    $dataUser = $modelUser->getDataUserJoin($where)->getRowArray();
    // dd($dataUser);

    // 2. Cek apakah user ditemukan
    if (!$dataUser) {
        session()->setFlashData('error', 'Username Tidak Ditemukan');
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
        exit; // Hentikan script
    }

    // 3. Jika user ada, verifikasi passwordnya
    if (password_verify($password, $dataUser['password'])) {
        
        // Cek apakah levelnya adalah Admin
        if ($dataUser['id_level'] == 'LV001') {
            
            // Simpan data session
            // Sekarang $dataUser['nama_level'] sudah ada isinya ("Admin")
            $dataSession = [
                'ses_id'         => $dataUser['id_user'],
                'ses_user'       => $dataUser['nama_admin'],
                'ses_level'      => $dataUser['id_level'],
                'ses_nama_level' => $dataUser['nama_level'], // INI AKAN MUNCUL DENGAN BENAR
            ];
            session()->set($dataSession);
            // dd($dataSession); 
            session()->setFlashData('success', 'Login Berhasil!');
            ?>
            <script>
                document.location = "<?= base_url('/dashboard'); ?>";
            </script>
            <?php
            exit; // Hentikan script

        } else {
            // Jika yang login bukan level Admin
            session()->setFlashData('error', 'Hanya akun Admin yang diizinkan.');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
            exit; // Hentikan script
        }
    } else {
        // Jika password salah
        session()->setFlashData('error', 'Password Tidak Sesuai!');
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
        exit; // Hentikan script
    }
}


    public function autentikasi_admin()
{
    // Ambil input dari form
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Validasi dasar agar tidak kosong
    if (empty($username) || empty($password)) {
        return redirect()->back()->with('error', 'Username dan Password wajib diisi.');
    }

    // Ambil data user dari database
    $modelUser = new \App\Models\M_User(); // Pastikan namespace model benar
    $dataUser = $modelUser->getDataUserJoin(['user.username' => $username])->getRowArray();

    // 1. Cek jika username tidak ada
    if (!$dataUser) {
        return redirect()->back()->with('error', 'Username tidak ditemukan.');
    }

    // 2. Verifikasi password
    if (!password_verify($password, $dataUser['password'])) {
        return redirect()->back()->with('error', 'Password tidak sesuai!');
    }

    // 3. Cek jika level bukan Admin
    if ($dataUser['id_level'] !== 'LV001') {
        return redirect()->back()->with('error', 'Hanya akun level Admin yang diizinkan.');
    }

    // 4. Jika semua berhasil, buat session dan redirect ke dashboard
    $dataSession = [
        'ses_id'         => $dataUser['id_user'],
        'ses_user'       => $dataUser['nama_admin'],
        'ses_level'      => $dataUser['id_level'],
        'ses_nama_level' => $dataUser['nama_level'],
        // 'isLoggedIn'     => true // Penanda login yang jelas
    ];

    session()->set($dataSession);

    // Set flashdata untuk notifikasi sukses di dashboard
    session()->setFlashdata('success', ' Selamat Datang, ' . $dataUser['nama_admin']);
    
    // Redirect ke dashboard
    return redirect()->to('/dashboard');
}


// public function autentikasi_admin()
// {
//     // Menggunakan model dan mengambil data POST sesuai format awal Anda
//     $modelUser = new M_User(); // Pastikan namespace model sudah benar
//     $username = $this->request->getPost('username');
//     $password = $this->request->getPost('password');

//     // 1. Validasi dasar agar tidak kosong (Logika dari versi baru)
//     if (empty($username) || empty($password)) {
//         session()->setFlashdata('error', 'Username dan Password wajib diisi.');
//         p
//         exit; // Hentikan script
//     }

//     // 2. Ambil data user LENGKAP dengan JOIN, CUKUP SATU KALI (Lebih efisien)
//     $dataUser = $modelUser->getDataUserJoin(['user.username' => $username])->getRowArray();

//     // 3. Cek jika username tidak ditemukan (Struktur if/else seperti format Anda)
//     if (!$dataUser) {
//         session()->setFlashData('error', 'Username tidak ditemukan.');
//        
//         exit; // Hentikan script
//     }

//     // 4. Verifikasi password (Struktur if/else seperti format Anda)
//     if (!password_verify($password, $dataUser['password'])) {
//         session()->setFlashData('error', 'Password tidak sesuai!');
//         
//         exit; // Hentikan script
//     }

//     // 5. Cek jika level bukan Admin (Logika penting dari versi baru)
//     if ($dataUser['id_level'] !== 'LV001') {
//         session()->setFlashData('error', 'Hanya akun level Admin yang diizinkan.');
//        
//         exit; // Hentikan script
//     }

//     // 6. Jika semua berhasil, buat session dan redirect ke dashboard
//     // Tidak perlu 'else' lagi, karena jika ada error, script sudah berhenti di atas
//     $dataSession = [
//         'ses_id'         => $dataUser['id_user'],
//         'ses_user'       => $dataUser['nama_admin'],
//         'ses_level'      => $dataUser['id_level'],
//         'ses_nama_level' => $dataUser['nama_level'],
//     ];
//     session()->set($dataSession);

//     // Set flashdata untuk notifikasi sukses di dashboard
//     session()->setFlashdata('success', 'Login Berhasil! Selamat Datang, ' . $dataUser['nama_admin']);
    
//     // Redirect ke dashboard menggunakan format Anda
//    
//     exit; // Hentikan script sebagai praktik yang baik
// }

    
}

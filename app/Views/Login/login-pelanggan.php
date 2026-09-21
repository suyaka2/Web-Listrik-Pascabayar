<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Pelanggan - PLN</title>
    
    <link rel="stylesheet" href="/assets-login/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets-login/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets-login/css/style.css">
    <link rel="stylesheet" href="/assets-login/css/sweetalert2.min.css">
    <link rel="shortcut icon" href="https://web.pln.co.id/statics/uploads/2022/08/logo-pln-new.png" />

    <style>
      /* --- STYLE YANG SUDAH DIRAPIKAN --- */
      :root {
        --electric-blue: #00A9FF;
        --deep-blue: #005A8D;
        --light-text: rgba(255, 255, 255, 0.9);
      }

      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      /* 1. Latar belakang disesuaikan dengan gambar Anda */
      .login-bg-electric {
        background-image: linear-gradient(rgba(0, 25, 55, 0.75), rgba(0, 15, 35, 0.9)), url("/BGLISTRIK.jpg");
        background-position: center;
        background-size: cover;
      }

      /* 2. Kartu login dengan efek kaca yang konsisten */
      .auth .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        color: white;
      }

      .brand-logo img {
        width: 80px;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
      }

      .auth-heading {
        color: #ffffff;
        font-weight: 600;
        letter-spacing: 0.5px;
      }

      .auth-subheading {
        color: var(--light-text);
      }

      .form-group label {
        color: var(--light-text);
        font-weight: 500;
      }
      
      /* 3. Input form dengan ikon */
      .input-group .form-control {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
        border-radius: 0 8px 8px 0 !important;
        transition: all 0.3s ease;
      }
      
      .form-control:focus {
        background: rgba(0, 0, 0, 0.4) !important;
        border-color: var(--electric-blue) !important;
        box-shadow: 0 0 10px rgba(0, 169, 255, 0.5) !important;
      }

      .input-group-text {
        background: rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-right: none;
        color: var(--electric-blue);
        border-radius: 8px 0 0 8px;
        font-size: 20px;
      }

      /* 4. Tombol disesuaikan dengan tema */
      .btn-electric-login {
        background: var(--electric-blue) !important;
        border: none;
        color: #ffffff !important;
        padding: 12px;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 169, 255, 0.3);
      }

      .btn-electric-login:hover {
        background-color: var(--deep-blue) !important;
        box-shadow: 0 6px 20px rgba(0, 90, 141, 0.5);
        transform: translateY(-2px);
      }
      
      /* 5. Link pendaftaran dibuat terlihat */
      .sign-up-link {
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: var(--light-text);
      }
      .sign-up-link a {
        color: var(--electric-blue);
        font-weight: 600;
        text-decoration: none;
      }
      .sign-up-link a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg-electric">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                
                <div class="brand-logo text-center mb-4">
                  <img src="<?= base_url ('/logopln.png')?>" alt="logo">
                </div>

                <h4 class="auth-heading text-center">Selamat Datang, Silahkan Login!</h4>
                <p class="auth-subheading text-center mb-4">Sistem Informasi Pembayaran Listrik Pasca Bayar</p>

                <form action="<?= base_url('login/autentikasi-pelanggan'); ?>" method="POST">
                  
                  <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                      </div>
                      <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                       <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                      </div>
                      <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                    </div>
                  </div>

                  <div class="text-center mt-4">
                    <button type="submit" class="btn btn-electric-login btn-block enter-btn">Login</button>
                  </div>
                  <!-- <p class="sign-up-link text-center">Belum punya akun? <a href="#">Daftar di sini</a></p> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="/assets-login/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets-login/js/off-canvas.js"></script>
    <script src="/assets-login/js/hoverable-collapse.js"></script>
    <script src="/assets-login/js/misc.js"></script>
    <script src="/assets-login/js/settings.js"></script>
    <script src="/assets-login/js/todolist.js"></script>
    <script src="/assets-login/js/sweetalert2.min.js"></script> 
 
    <?php if (session()->getFlashdata('success')) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          swal("Success!", "<?= session()->getFlashdata('success') ?>", "success");
        });
      </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          swal("Sorry!", "<?= session()->getFlashdata('error') ?>", "error");
        });
      </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          swal("Warning!", "<?= session()->getFlashdata('warning') ?>", "warning");
        });
      </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          swal("Info!", "<?= session()->getFlashdata('info') ?>", "info");
        });
      </script>
    <?php endif; ?>
  </body>
</html>
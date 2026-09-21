<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Admin</title>
    <link rel="stylesheet" href="/assets-login/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets-login/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets-login/css/style.css">
    <link rel="stylesheet" href="/assets-login/css/sweetalert2.min.css">
    <link rel="shortcut icon" href="https://web.pln.co.id/statics/uploads/2022/08/logo-pln-new.png" />

    <style>
      :root {
        --electric-blue: #00A9FF; /* Biru cerah seperti percikan listrik */
        --deep-blue: #005A8D;     /* Biru tua untuk kontras */
        --energy-yellow: #FFD700; /* Kuning sebagai aksen energi */
        --light-gray: #f8f9fa;
        --dark-text: #2c3e50;
      }

      body, .page-body-wrapper {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .login-bg-electric {
        /* Ganti dengan path ke gambar Anda */
        background-image: linear-gradient(rgba(0, 40, 85, 0.7), rgba(0, 20, 45, 0.85)), url("BGLISTRIK.jpg");
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
      }

      .auth .card {
        background: rgba(255, 255, 255, 0.1); /* Efek kaca transparan */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        color: white;
      }

      .card-title {
        color: #ffffff;
        letter-spacing: 1px;
      }

      .text-muted {
          color: rgba(255, 255, 255, 0.8) !important;
      }

      .form-group label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
      }
      
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

      .btn-electric-login {
        background: var(--electric-blue) !important;
        border: none;
        color: #ffffff !important;
        padding: 14px;
        border-radius: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 169, 255, 0.4);
      }

      .btn-electric-login:hover {
        background-color: var(--deep-blue) !important;
        box-shadow: 0 6px 20px rgba(0, 90, 141, 0.6);
        transform: translateY(-2px);
      }
      
      .logo-container img {
        width: 90px;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
      }

    </style>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg-electric">
          <div class="card col-lg-4 col-md-6 col-sm-10 mx-auto">
            <div class="card-body px-5 py-5">
              
              <div class="logo-container text-center mb-4">
                <img src="/logopln.png" alt="Logo PLN">
              </div>

              <h4 class="card-title text-center font-weight-bold mb-2">LOGIN ADMIN</h4><?= password_hash('developer', PASSWORD_BCRYPT);?>
              <p class="text-muted text-center mb-5">Sistem Informasi Pembayaran Listrik Pasca Bayar</p>
              
              <form action="<?= base_url('login/autentikasi-admin'); ?>" method="POST">
                
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control"  placeholder="Masukkan username Anda">
                  </div>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control"  placeholder="Masukkan password Anda">
                  </div>
                </div>
                
                <div class="text-center mt-4 pt-2">
                  <button type="submit" class="btn btn-electric-login btn-block enter-btn">LOGIN</button>
                </div>

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
        // Menggunakan sintaks swal() yang Anda inginkan
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
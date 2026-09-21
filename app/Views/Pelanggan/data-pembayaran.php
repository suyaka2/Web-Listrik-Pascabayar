<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php
    $title
    ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Basic Bootstrap Table -->
      <div class="layout-page">

   <!-- Content wrapper -->
            <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Content -->
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">History Pembayaran <?= session()->get('ses_user');?></h5>
                  </div>
                  <div class=" text-nowrap">
                  <table id="example" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Jumlah Penggunaan </th>
                        <th>Tanggal Pembayaran</th>
                        <th>Total Pembayaran</th>
                        
                      </tr>
                    </thead>
                   <tbody class="table-border-bottom-0">
    <?php
    $no = 0;
    foreach($data_pembayaran as $data) {
    ?>
    <tr>
        <td><?= $no=$no+1; ?></td>
        <td>
            <?php
                // Gunakan nama kolom alias yang baru
                $tanggalObj = new DateTime($data['tahun_tagihan'] . '-' . $data['bulan_tagihan'] . '-01');
                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMMM');
                echo $formatter->format($tanggalObj) . ' ' . $data['tahun_tagihan'];
            ?>
        </td>
        <td><?= $data['jumlah_meter']; ?> kWh</td>
        <td><?= date('d F Y', strtotime($data['tanggal_pembayaran'])); ?></td>
        <td><?= "Rp " . number_format($data['total_bayar'], 0, ',', '.'); ?></td>
    </tr>
    <?php } ?>
</tbody>
                  </table>
                </div>
              </div>
</div>
            </div>
</div>
</form>







<script>
   const bayarModal = document.getElementById('bayarModal');
bayarModal.addEventListener('show.bs.modal', event => {
    // Tombol pemicu
    const button = event.relatedTarget;

    // Ambil data dari tombol
    const id_tagihan = button.getAttribute('data-id_tagihan');
    const id_pelanggan = button.getAttribute('data-id_pelanggan');
    const nama = button.getAttribute('data-nama_pelanggan');
    const periode = button.getAttribute('data-periode');
    const total_tagihan = button.getAttribute('data-total_tagihan');
    
    // Temukan elemen di modal
    const modalIdTagihan = bayarModal.querySelector('#bayar_id_tagihan');
    const modalIdPelanggan = bayarModal.querySelector('#bayar_id_pelanggan');
    const modalNama = bayarModal.querySelector('#bayar_nama_pelanggan');
    const modalPeriode = bayarModal.querySelector('#bayar_periode');
    const modalTotalTagihan = bayarModal.querySelector('#bayar_total_tagihan');
    const modalTotalTagihanRaw = bayarModal.querySelector('#bayar_total_tagihan_raw');
    const modalBiayaAdmin = bayarModal.querySelector('#bayar_biaya_admin');
    const modalTanggal = bayarModal.querySelector('#bayar_tanggal');
    const displayTotalBayar = bayarModal.querySelector('#total_bayar_display');
    const hiddenTotalBayar = bayarModal.querySelector('#total_bayar_hidden');

    // Fungsi untuk menghitung dan update total
    function updateTotal() {
        const tagihan = parseFloat(modalTotalTagihanRaw.value) || 0;
        const admin = parseFloat(modalBiayaAdmin.value) || 0;
        const total = tagihan + admin;
        
        displayTotalBayar.textContent = 'Rp ' + total.toLocaleString('id-ID');
        hiddenTotalBayar.value = total;
    }

    // Isi form dengan data
    modalIdTagihan.value = id_tagihan;
    modalIdPelanggan.value = id_pelanggan;
    modalNama.value = nama;
    modalPeriode.value = periode;
    modalTotalTagihan.value = 'Rp ' + parseFloat(total_tagihan).toLocaleString('id-ID');
    modalTotalTagihanRaw.value = total_tagihan;
    modalTanggal.valueAsDate = new Date(); // Set tanggal hari ini

    // Hitung total awal
    updateTotal();

    // Tambahkan event listener untuk biaya admin agar total otomatis terupdate
    modalBiayaAdmin.addEventListener('keyup', updateTotal);
    modalBiayaAdmin.addEventListener('change', updateTotal);
});

      function doDelete(idDelete){
			swal({
				title : "Hapus Data Pelanggan?",
				text : "YAKIN MAU HAPUS NIH??!!!",
				icon : "warning",
				buttons : true,
				dangerMode : false,
			})
			.then(ok => {
				if(ok){
					window.location.href = '<?= base_url();?>/hapus-data-pelanggan/' + idDelete;
				}
				else{
					$(this).removeAttr('disabled')
				}
			})
		}
</script>
              <!--/ Basic Bootstrap Table -->


             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
     <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script> 
     <!-- <script>
                const editModal = document.getElementById('editModal');

              // Tambahkan "event listener" yang akan berjalan setiap kali modal AKAN DITAMPILKAN
              editModal.addEventListener('show.bs.modal', event => {
                  // Dapatkan tombol mana yang diklik untuk memicu modal ini
                  const button = event.relatedTarget;

                  // Ambil data dari atribut `data-bs-*` pada tombol tersebut
                  const id = button.getAttribute('data-bs-id');
                  const nama = button.getAttribute('data-bs-nama');
                  const username = button.getAttribute('data-bs-username');
                  const password = button.getAttribute('data-bs-password');
                  const alamat = button.getAttribute('data-bs-alamat');
                  const no_listrik = button.getAttribute('data-bs-nomor_kwh');
                  const id_tarif = button.getAttribute('data-bs-id_tarif');

                  // Cari elemen input di dalam modal
                  const modalInputIdTarif = editModal.querySelector('#edit_id_tarif');
                  const modalInputNama = editModal.querySelector('#edit_nama');
                  const modalInputUsername = editModal.querySelector('#edit_username');
                  const modalInputPassword = editModal.querySelector('#edit_password');
                  const modalInputAlamat = editModal.querySelector('#edit_alamat');
                  const modalInputNoListrik = editModal.querySelector('#edit_no_listrik');
                  const modalInputId = editModal.querySelector('#edit_id_pelanggan');
                  

                  // Isi nilai input di dalam modal dengan data yang kita dapatkan
                  modalInputIdTarif.value = id_tarif;
                  modalInputNama.value = nama;
                  modalInputUsername.value = username;
                  modalInputPassword.value = password;
                  modalInputAlamat.value = alamat;
                  modalInputNoListrik.value = no_listrik;
                  modalInputId.value = id;
              });
                  
             
              </script> -->
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
     <script src="/assets/js/main.js"></script> 

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

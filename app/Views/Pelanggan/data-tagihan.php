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

    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
                    <h5 class="mb-0">Data Tagihan <?= session()->get('ses_user');?></h5>
                  </div>
                  <div class=" text-nowrap">
                  <table id="example" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <!-- <th>Nama</th> -->
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Jumlah Penggunaan </th>
                        <th>Status</th>
                        
                        <th>Actions</th>
                      </tr>
                    </thead>
                   <tbody class="table-border-bottom-0">
    <?php
    $no = 0;
    foreach($data_tagihan as $data) {
      // --- LAKUKAN PROSES PENERJEMAHAN DI SINI ---
   if (empty($data['bulan'])) {
    
    // 1. Kalau kosong, JANGAN jalankan DateTime. 
    // Langsung aja kasih nilai default.
    $periode_teks = "Belum ada periode";

} else {

    // 2. Kalau bulannya ADA ISINYA, baru jalankan kodingan asli lu di sini
    $tanggalObj = new DateTime($data['bulan']);
    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMMM');
    $periode_teks = $formatter->format($tanggalObj) . ' ' . $data['tahun'];

}
      
    ?>
    
    <tr>
        <td><?= $no=$no+1;?></td>
        <!-- <td><?= $data['nama_pelanggan'];?></td> -->
         <td><?= $periode_teks; ?></td>
         <td><?= $data['meter_awal'];?> kWh</td>
         <td><?= $data['meter_akhir'];?> kWh</td>
        <td><?= $data['jumlah_meter'];?> kWh</td>
        
            
        <td>
          <?php if ($data['status'] == 'Lunas'): ?>
                <span class="badge bg-label-success">Lunas</span>
            <?php else: ?>
                <span class="badge bg-label-warning">Belum Lunas</span>
                
            <?php endif; ?>
        </td>
        
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <?php if ($data['status'] == 'Belum Lunas'): ?>
    <a class="btn btn-sm btn-primary" href="#" 
    data-bs-toggle="modal" 
    data-bs-target="#bayarModalPelanggan"
    data-id_tagihan="<?= $data['id_tagihan'] ?>"
    data-id_pelanggan="<?= $data['id_pelanggan'] ?>" data-jumlah_meter="<?= $data['jumlah_meter'] ?>"
    data-total_tagihan="<?= $data['total_tagihan_calculated'] ?>"
    data-periode="<?= $periode_teks ?>">
    <i class="bx bx-money me-1"></i> Bayar
</a>
<?php endif; ?>
                    <!-- <a class="dropdown-item" href="#">
                        <i class="bx bx-detail me-1"></i> Detail
                    </a> -->
                </div>
            </div>
        </td>
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

<div class="modal fade" id="bayarModalPelanggan" tabindex="-1" aria-labelledby="bayarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bayarModalLabel">Formulir Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('/pelanggan/simpan-pembayaran'); ?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id_tagihan" id="bayar_id_tagihan">
            <input type="hidden" name="id_pelanggan" id="bayar_id_pelanggan">
            <input type="hidden" id="bayar_total_tagihan_raw"> <hr>
            
            <p>
              Bayar Untuk Periode :  <br>
              <strong id="bayar_periode" class="fs-5"></strong>
            </p>
            <p class="text-muted small">
              Total Pemakaian: <strong id="bayar_jumlah_meter"></strong>
            </p>
            <hr>
            <p>
              Total Tagihan: <br>
              <strong id="bayar_total_tagihan" class="fs-4 text-primary"></strong>
            </p>
            <input type="hidden" id="bayar_total_tagihan_raw">

            <p>
              Biaya Admin: <br>
              <strong class="fs-4 text-primary">Rp 2.500</strong>
            </p>
            <input type="hidden" name="biaya_admin" value="2500">

            <hr>
            <h5 class="text-left">Total yang Harus Dibayar: <span id="display_total_keseluruhan" class="fw-bold text-primary"></span></h5>
            <input type="hidden" name="total_bayar" id="hidden_total_keseluruhan">
            <hr>
            <div class="mb-3">
              <label for="bayar_tanggal" class="col-form-label">Tanggal Pembayaran</label>
              <input type="date" class="form-control" id="bayar_tanggal" name="tanggal_pembayaran" required>
            </div>

            <div class="mb-3 ">
              <label for="nominal_bayar" class="col-form-label">Masukkan Nominal Pembayaran Anda:</label>
              <input type="number" class="form-control" id="nominal_bayar" name="nominal_bayar" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script>
//    const bayarModal = document.getElementById('bayarModal');
// bayarModal.addEventListener('show.bs.modal', event => {
//     // Tombol pemicu
//     const button = event.relatedTarget;

//     // Ambil data dari tombol
//     const id_tagihan = button.getAttribute('data-id_tagihan');
//     const id_pelanggan = button.getAttribute('data-id_pelanggan');
//     const nama = button.getAttribute('data-nama_pelanggan');
//     const periode = button.getAttribute('data-periode');
//     const total_tagihan = button.getAttribute('data-total_tagihan');
    
//     // Temukan elemen di modal
//     const modalIdTagihan = bayarModal.querySelector('#bayar_id_tagihan');
//     const modalIdPelanggan = bayarModal.querySelector('#bayar_id_pelanggan');
//     const modalNama = bayarModal.querySelector('#bayar_nama_pelanggan');
//     const modalPeriode = bayarModal.querySelector('#bayar_periode');
//     const modalTotalTagihan = bayarModal.querySelector('#bayar_total_tagihan');
//     const modalTotalTagihanRaw = bayarModal.querySelector('#bayar_total_tagihan_raw');
//     const modalBiayaAdmin = bayarModal.querySelector('#bayar_biaya_admin');
//     const modalTanggal = bayarModal.querySelector('#bayar_tanggal');
//     const displayTotalBayar = bayarModal.querySelector('#total_bayar_display');
//     const hiddenTotalBayar = bayarModal.querySelector('#total_bayar_hidden');

//     // Fungsi untuk menghitung dan update total
//     function updateTotal() {
//         const tagihan = parseFloat(modalTotalTagihanRaw.value) || 0;
//         const admin = parseFloat(modalBiayaAdmin.value) || 0;
//         const total = tagihan + admin;
        
//         displayTotalBayar.textContent = 'Rp ' + total.toLocaleString('id-ID');
//         hiddenTotalBayar.value = total;
//     }

//     // Isi form dengan data
//     modalIdTagihan.value = id_tagihan;
//     modalIdPelanggan.value = id_pelanggan;
//     modalNama.value = nama;
//     modalPeriode.value = periode;
//     modalTotalTagihan.value = 'Rp ' + parseFloat(total_tagihan).toLocaleString('id-ID');
//     modalTotalTagihanRaw.value = total_tagihan;
//     modalTanggal.valueAsDate = new Date(); // Set tanggal hari ini

//     // Hitung total awal
//     updateTotal();

//     // Tambahkan event listener untuk biaya admin agar total otomatis terupdate
//     modalBiayaAdmin.addEventListener('keyup', updateTotal);
//     modalBiayaAdmin.addEventListener('change', updateTotal);
// });

const bayarModalPelanggan = document.getElementById('bayarModalPelanggan');

bayarModalPelanggan.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    
    // Ambil semua data dari tombol
    const id_tagihan = button.getAttribute('data-id_tagihan');
    const id_pelanggan = button.getAttribute('data-id_pelanggan'); // Ambil id_pelanggan
    const jumlah_meter = button.getAttribute('data-jumlah_meter');
    const total_tagihan = parseFloat(button.getAttribute('data-total_tagihan')) || 0;
    const periode = button.getAttribute('data-periode');
    
    // Biaya admin bisa kita tentukan di sini
    const biaya_admin = 2500;
    
    // Hitung total keseluruhan
    const total_keseluruhan = total_tagihan + biaya_admin;

    // Format angka untuk ditampilkan
    const tagihanFormatted = 'Rp ' + total_tagihan.toLocaleString('id-ID');
    const pemakaianFormatted = jumlah_meter + ' kWh';
    const totalKeseluruhanFormatted = 'Rp ' + total_keseluruhan.toLocaleString('id-ID');

    // Cari elemen di modal
    const inputIdTagihan = bayarModalPelanggan.querySelector('#bayar_id_tagihan');
    const inputIdPelanggan = bayarModalPelanggan.querySelector('#bayar_id_pelanggan');
    const displayPeriode = bayarModalPelanggan.querySelector('#bayar_periode');
    const displayTotalTagihan = bayarModalPelanggan.querySelector('#bayar_total_tagihan');
    const displayJumlahMeter = bayarModalPelanggan.querySelector('#bayar_jumlah_meter');
    const displayTotalKeseluruhan = bayarModalPelanggan.querySelector('#display_total_keseluruhan');
    const hiddenTotalKeseluruhan = bayarModalPelanggan.querySelector('#hidden_total_keseluruhan');
    const inputNominal = bayarModalPelanggan.querySelector('#nominal_bayar');
    const modalTanggal = bayarModalPelanggan.querySelector('#bayar_tanggal');

    const submitButton = bayarModalPelanggan.querySelector('button[type="submit"]');

    // Isi semua nilainya
    inputIdTagihan.value = id_tagihan;
    inputIdPelanggan.value = id_pelanggan;
    displayPeriode.textContent = periode;
    displayTotalTagihan.textContent = tagihanFormatted;
    displayJumlahMeter.textContent = pemakaianFormatted;
    displayTotalKeseluruhan.textContent = totalKeseluruhanFormatted;
    hiddenTotalKeseluruhan.value = total_keseluruhan;

    modalTanggal.valueAsDate = new Date();

    // inputNominal.value = total_keseluruhan;

    const validateNominal = () => {
        // Bandingkan nilai input dengan total seharusnya (ubah ke number untuk perbandingan)
        if (Number(inputNominal.value) === total_keseluruhan) {
            submitButton.disabled = false; // Aktifkan tombol bayar
            inputNominal.classList.remove('is-invalid'); // Hapus class error
        } else {
            submitButton.disabled = true; // Nonaktifkan tombol bayar
            inputNominal.classList.add('is-invalid'); // Tambah class error
        }
    };

    inputNominal.addEventListener('input', validateNominal);

    validateNominal();
    // Set nilai default di input nominal pembayaran
    // inputNominal.value = total_keseluruhan;
    // inputNominal.placeholder = total_keseluruhan;
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

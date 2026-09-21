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
                    <h5 class="mb-0">Data Penggunaan </h5>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal"
                      data-bs-whatever="@mdo"
                    >
                      <i class="bx bx-plus me-1"></i> Tambah Penggunaan Pelanggan
                    </button>
                   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penggunaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="<?= base_url('/simpan-data-penggunaan'); ?>" method="POST">
        <div class="modal-body">
            
            <div class="mb-3">
              <label for="tambah_nama_pelanggan">Nama Pelanggan</label>
              <select name="nama" id="tambah_nama_pelanggan" class="form-control" required>
                  <option value="">Pilih Pelanggan</option>
                  <?php foreach($data_pelanggan as $pelanggan){ ?>
                      <option value="<?= $pelanggan['id_pelanggan'];?>"> <?= $pelanggan['nama_pelanggan'] ?></option>
                  <?php } ?>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="tambah_periode" class="col-form-label">Periode (Bulan & Tahun)</label>
              <input type="month" class="form-control" id="tambah_periode" name="periode" required>
            </div>
            
            <div class="mb-3">
              <label for="tambah_meter_awal" class="col-form-label">Meter Awal</label>
              <input type="number" class="form-control" id="tambah_meter_awal" name="meter_awal" placeholder="Otomatis / Isi manual jika data pertama" required>
            </div>
            
            <div class="mb-3">
              <label for="tambah_meter_akhir" class="col-form-label">Meter Akhir</label>
              <input type="number" class="form-control" id="tambah_meter_akhir" name="meter_akhir" required>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form> </div>
  </div>
</div>
                  </div>
                  <div class=" text-nowrap">
                  <table id="example" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                            $no = 0;
                            foreach($data_penggunaan as $data) {
                            ?>
                      <tr>
                        <td><?= $no=$no+1;?></td>
                        <td><?= $data['nama_pelanggan'];?></td>
                        <td>
    <?php
        // 1. Membuat objek tanggal dari angka bulan dan tahun yang Anda miliki
        $tanggalObj = new DateTime($data['tahun'] . '-' . $data['bulan'] . '-01');

        // 2. Membuat formatter untuk mengubahnya ke format Bahasa Indonesia
        $formatter = new IntlDateFormatter(
            'id_ID', // Set lokal ke Indonesia
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            'Asia/Jakarta', // Zona Waktu
            IntlDateFormatter::GREGORIAN,
            'MMMM' // Pola untuk mendapatkan nama bulan lengkap (misal: "Juli")
        );

        // 3. Tampilkan nama bulan, diikuti dengan tahun
        echo $formatter->format($tanggalObj) . ' ' . $data['tahun'];
    ?>
</td>
                        <td>
                            <?= $data['meter_awal']?>
                        </td>
                        <td>
                            <?= $data['meter_akhir']?>
                        </td>
                        
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             <a class="dropdown-item btn-edit-penggunaan" href="#" 
    data-bs-toggle="modal" 
    data-bs-target="#editModal" 
    data-bs-id="<?= $data['id_penggunaan'] ?>"
    data-bs-id_tagihan="<?= $data['id_tagihan'] ?>"
    data-bs-bulan="<?= $data['bulan'] ?>"
    data-bs-tahun="<?= $data['tahun'] ?>"
    data-bs-meter_awal="<?= $data['meter_awal'] ?>"
    data-bs-meter_akhir="<?= $data['meter_akhir'] ?>"
    data-bs-id_pelanggan="<?= $data['id_pelanggan'] ?>">
    <i class="bx bx-edit-alt me-1"></i> Edit
</a>
                                
                              
                               <a class="dropdown-item" href="#" onclick="doDelete('<?= $data['id_penggunaan']; ?>')"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
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

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Penggunaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('/update-data-penggunaan'); ?>" method="POST">
        <div class="modal-body">
            
            <input type="hidden" name="id_penggunaan" id="edit_id_penggunaan">
            <input type="hidden" name="id_tagihan" id="edit_id_tagihan">
            
            <div class="col-md-6 mb-3">
                                  <label for="edit_id_pelanggan">Nama Pelanggan </label>
                                  <select name="edit_id_pelanggan" id="edit_id_pelanggan" class="form-control" >
                                    <option value="" disabled>Pilih Pelanggan</option>
                                    <?php
                                    foreach($data_pelanggan as $pelanggan){                    
                                    ?>
                                    <option value="<?= $pelanggan['id_pelanggan'];?>"> <?= $pelanggan['nama_pelanggan'] ?></option>
                                    <?php } ?>
                                </select>
                                  <!-- <div class="valid-feedback"> Looks good! </div> -->
                                </div>
            
            <div class="mb-3">
    <label for="edit_periode" class="col-form-label">Periode (Bulan & Tahun)</label>
    <input type="month" class="form-control" id="edit_periode" name="edit_periode">
</div>

            <div class="mb-3">
              <label for="edit_meter_awal" class="col-form-label">Meter Awal</label>
              <input type="number" class="form-control" id="edit_meter_awal" name="edit_meter_awal">
            </div>
            <div class="mb-3">
              <label for="edit_meter_akhir" class="col-form-label">Meter Akhir</label>
              <input type="number" class="form-control" id="edit_meter_akhir" name="edit_meter_akhir">
            </div>
          

        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Event listener ini akan berjalan HANYA setelah seluruh halaman HTML selesai dimuat
document.addEventListener('DOMContentLoaded', function () {

    // --- LOGIKA UNTUK MODAL EDIT PENGGUNAAN ---
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-bs-id');
            const id_tagihan = button.getAttribute('data-bs-id_tagihan');
            const bulan = button.getAttribute('data-bs-bulan');
            const tahun = button.getAttribute('data-bs-tahun');
            const meter_awal = button.getAttribute('data-bs-meter_awal');
            const meter_akhir = button.getAttribute('data-bs-meter_akhir');
            const id_pelanggan = button.getAttribute('data-bs-id_pelanggan');

            const bulanFormatted = bulan.toString().padStart(2, '0');
            const periode = `${tahun}-${bulanFormatted}`;

            editModal.querySelector('#edit_id_penggunaan').value = id;
            editModal.querySelector('#edit_id_tagihan').value = id_tagihan;
            editModal.querySelector('#edit_periode').value = periode;
            editModal.querySelector('#edit_meter_awal').value = meter_awal;
            editModal.querySelector('#edit_meter_akhir').value = meter_akhir;
            editModal.querySelector('#edit_id_pelanggan').value = id_pelanggan;
        });
    }


    // --- LOGIKA UNTUK AUTO-FILL DI MODAL TAMBAH ---
    const tambahSelectPelanggan = document.getElementById('tambah_nama_pelanggan');
    const tambahInputPeriode = document.getElementById('tambah_periode');
    const tambahInputMeterAwal = document.getElementById('tambah_meter_awal');

    // Pastikan elemen-elemen untuk form tambah ada
    if (tambahSelectPelanggan && tambahInputPeriode && tambahInputMeterAwal) {
        
        async function fetchMeterAwal() {
            const id_pelanggan = tambahSelectPelanggan.value;
            const periode = tambahInputPeriode.value;

            if (!id_pelanggan || !periode) {
                tambahInputMeterAwal.value = '';
                // Biarkan bisa diedit jika salah satu kosong
                tambahInputMeterAwal.readOnly = false; 
                tambahInputMeterAwal.placeholder = 'Otomatis / Isi manual jika data pertama';
                return;
            }
            
            try {
                const formData = new FormData();
                formData.append('id_pelanggan', id_pelanggan);
                formData.append('periode', periode);

                const response = await fetch('<?= base_url('/admin/get-meter-terakhir') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                });
                
                const data = await response.json();
                
                if (data && data.meter_awal && parseFloat(data.meter_awal) > 0) {
                    tambahInputMeterAwal.value = data.meter_awal;
                    tambahInputMeterAwal.readOnly = true;
                    tambahInputMeterAwal.placeholder = '';
                } else {
                    tambahInputMeterAwal.value = '';
                    tambahInputMeterAwal.placeholder = 'Input manual meter awal';
                    tambahInputMeterAwal.readOnly = false; 
                }
                
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // PERBAIKAN: Pindahkan event listener ke dalam DOMContentLoaded
        tambahSelectPelanggan.addEventListener('change', fetchMeterAwal);
        tambahInputPeriode.addEventListener('change', fetchMeterAwal);
    }

    // Pindahkan juga fungsi doDelete ke sini agar konsisten
    window.doDelete = function(idDelete) {
        swal({
            title: "Hapus Data Penggunaan?",
            text: "YAKIN MAU HAPUS NIH??!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((ok) => {
            if (ok) {
                window.location.href = '<?= base_url() ?>/admin/hapus-data-penggunaan/' + idDelete;
            }
        });
    }
});
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

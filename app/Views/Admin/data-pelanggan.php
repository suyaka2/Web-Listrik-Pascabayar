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
                    <h5 class="mb-0">Data Pelanggan</h5>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal"
                      data-bs-whatever="@mdo"
                    >
                      <i class="bx bx-plus me-1"></i> Tambah Pelanggan
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Silahkan Input</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form id="formTambahPelanggan" action="<?= base_url('/simpan-data-pelanggan'); ?>" method="POST">
                              <div class="mb-3">
                                <label for="nama" class="col-form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                              </div>
                              <div class="mb-3">
                                <label for="alamat" class="col-form-label">Alamat</label>
                               <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                              </div>
                              <div class="mb-3">
                                <label for="nolistrik" class="col-form-label">No Listrik</label>
                                <input type="number" class="form-control" id="nolistrik" name="nolistrik" maxlength="11">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label for="daya">Daya Listrik & Tarif </label>
                                  <select name="daya"  class="form-control">
                                    <option value="">Pilih Daya</option>
                                    <?php
                                    foreach($data_daya as $data){                    
                                    ?>
                                    <option value="<?= $data['id_tarif'];?>"> <?= $data['daya'] . " VA - Rp " . number_format($data['tarifperkwh'], 0, ',', '.') ?></option>
                                    <?php } ?>
                                </select>
                                  <!-- <div class="valid-feedback"> Looks good! </div> -->
                              </div>
                               <div class="mb-3">
                                                    <label for="username">Username Pelanggan</label>
                                                    <input type="text" class="form-control" id="username" name="username" required>
                                                </div>
                                  <div class="mb-3">
                                    <label for="password">Password Pelanggan</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>               
                              
                            
                          </div>
                          <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" text-nowrap">
                  <table id="example" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor Listrik</th>
                        <th>Alamat </th>
                        <th>Daya Listrik Rumah</th>
                        
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                            $no = 0;
                            foreach($data_pelanggan as $data) {
                            ?>
                      <tr>
                        <td><?= $no=$no+1;?></td>
                        <td><?= $data['nama_pelanggan'];?></td>
                        <td><?= $data['nomor_kwh'];?></td>
                        <td><?= $data['alamat'];?></td>
                        <td>
    <?= $data['daya'] . " VA - Rp " . number_format($data['tarifperkwh'], 0, ',', '.') ?>
</td>
                        
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             <a class="dropdown-item btn-edit-pelanggan" href="#" 
    data-bs-toggle="modal" 
    data-bs-target="#editModal" 
    data-bs-id="<?= $data['id_pelanggan'] ?>"
    data-bs-nama="<?= $data['nama_pelanggan'] ?>"
    data-bs-username="<?= $data['username'] ?>"
    data-bs-alamat="<?= $data['alamat'] ?>"
    data-bs-nomor_kwh="<?= $data['nomor_kwh'] ?>" data-bs-id_tarif="<?= $data['id_tarif'] ?>">
    <i class="bx bx-edit-alt me-1"></i> Edit
</a>
                                
                              
                               <a class="dropdown-item" href="#" onclick="doDelete('<?= $data['id_pelanggan']; ?>')"
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
        <h5 class="modal-title" id="editModalLabel">Edit Data Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditPelanggan" action="<?= base_url('/update-data-pelanggan'); ?>" method="POST">
        <div class="modal-body">
            
            <input type="hidden" name="id_pelanggan" id="edit_id_pelanggan">
            
            <div class="mb-3">
              <label for="edit_nama" class="col-form-label">Nama Pelanggan</label>
              <input type="text" class="form-control" id="edit_nama" name="edit_nama">
            </div>
            <div class="mb-3">
              <label for="edit_alamat" class="col-form-label">Alamat</label>
              <textarea class="form-control" id="edit_alamat" name="edit_alamat"></textarea>
            </div>
            <div class="mb-3">
              <label for="edit_nomor_kwh" class="col-form-label">Nomor Listrik</label>
              <input type="number" class="form-control" id="edit_nomor_kwh" name="edit_nomor_kwh" maxlength="11">
            </div>
            <div class="mb-3">
              <label for="edit_id_tarif">Daya Listrik & Tarif</label>
              <select name="edit_id_tarif" id="edit_id_tarif" class="form-control">
                  <option value="">Pilih Daya</option>
                  <?php foreach($data_daya as $data){ ?>
                      <option value="<?= $data['id_tarif'];?>"> <?= $data['daya'] . " VA - Rp " . number_format($data['tarifperkwh'], 0, ',', '.') ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="edit_username" class="col-form-label">Username Pelanggan</label>
              <input type="text" class="form-control" id="edit_username" name="edit_username">
            </div>
            <div class="mb-3">
                <label for="edit_password" class="col-form-label">Password Baru (Kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control" id="edit_password" name="edit_password">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    const editModal = document.getElementById('editModal');

    editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;

        // Ambil data dengan nama atribut yang sudah konsisten
        const id = button.getAttribute('data-bs-id');
        const nama = button.getAttribute('data-bs-nama');
        const username = button.getAttribute('data-bs-username');
        const alamat = button.getAttribute('data-bs-alamat');
        const nomor_kwh = button.getAttribute('data-bs-nomor_kwh'); // Perbaiki di sini
        const id_tarif = button.getAttribute('data-bs-id_tarif');

        // Cari elemen input dengan ID yang sudah kita perbaiki
        const modalInputId = editModal.querySelector('#edit_id_pelanggan');
        const modalInputNama = editModal.querySelector('#edit_nama');
        const modalInputUsername = editModal.querySelector('#edit_username'); // Perbaiki di sini
        const modalInputPassword = editModal.querySelector('#edit_password'); // Perbaiki di sini
        const modalInputAlamat = editModal.querySelector('#edit_alamat');
        const modalInputNoListrik = editModal.querySelector('#edit_nomor_kwh'); // Perbaiki di sini
        const modalSelectTarif = editModal.querySelector('#edit_id_tarif'); // Perbaiki di sini
        
        // Isi nilai ke dalam form
        modalInputId.value = id;
        modalInputNama.value = nama;
        modalInputUsername.value = username;
        modalInputAlamat.value = alamat; // Menggunakan .value untuk textarea sudah benar
        modalInputNoListrik.value = nomor_kwh;
        modalSelectTarif.value = id_tarif; // Mengisi dropdown/select
        
        // Kosongkan field password setiap kali modal dibuka
        modalInputPassword.value = '';
    });

    // Validasi untuk Form Tambah Pelanggan
document.getElementById('formTambahPelanggan').addEventListener('submit', function(event) {
    const noListrikInput = document.getElementById('nolistrik');
    const noListrikValue = noListrikInput.value;

    // Cek jika panjangnya bukan 11 atau jika berisi selain angka
    if (noListrikValue.length !== 11 || !/^\d+$/.test(noListrikValue)) {
        // Mencegah form dikirim
        event.preventDefault();

        // Tampilkan notifikasi SweetAlert
        swal({
            title: "Input Tidak Valid!",
            text: "Nomor listrik harus terdiri dari 11 digit angka.",
            icon: "warning",
            button: "Mengerti",
        });
    }
});

// Validasi untuk Form Edit Pelanggan
document.getElementById('formEditPelanggan').addEventListener('submit', function(event) {
    const noListrikEditInput = document.getElementById('edit_nomor_kwh');
    const noListrikEditValue = noListrikEditInput.value;

    // Cek jika panjangnya bukan 11 atau jika berisi selain angka
    if (noListrikEditValue.length !== 11 || !/^\d+$/.test(noListrikEditValue)) {
        // Mencegah form dikirim
        event.preventDefault();

        // Tampilkan notifikasi SweetAlert
        swal({
            title: "Input Tidak Valid!",
            text: "Nomor listrik harus terdiri dari 11 digit angka.",
            icon: "warning",
            button: "Mengerti",
        });
    }
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

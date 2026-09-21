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
                    <h5 class="mb-0">Data Daya & Tarif Listrik</h5>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal"
                      data-bs-whatever="@mdo"
                    >
                      <i class="bx bx-plus me-1"></i> Tambah Daya & Tarif
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Silahkan Input</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="<?= base_url('/simpan-data-tarif'); ?>" method="POST">
                              <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Daya Listrik</label>
                                <input type="text" class="form-control" id="daya" name="daya">
                              </div>
                              <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tarif Listrik</label>
                             <input type="number" class="form-control" id="tarif" name="tarif">
                              </div>
                                       
                              
                            
                          </div>
                          <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <th>Daya</th>
                                <th>Tarif Perkwh</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 0;
                            foreach($data_tarif as $data) {
                            ?>
                            <tr>
                                  <td><?= $no=$no+1;?></td>
                        <td><?= $data['daya'];?> VA </td>
                        <td>
    <?= "Rp " . number_format($data['tarifperkwh'], 0, ',', '.') ?>
</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 " data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             <a class="dropdown-item btn-edit-tarif" href="#" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal" 
                                data-bs-id="<?= $data['id_tarif'] ?>"
                                data-bs-daya="<?= $data['daya'] ?>"
                                data-bs-tarif="<?= $data['tarifperkwh'] ?>">
                                  <i class="bx bx-edit-alt me-1"></i> Edit
                              </a>
                              <a class="dropdown-item" href="#" onclick="doDelete('<?= $data['id_tarif']; ?>')"
                                ><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Daya</th>
                                <th>Tarif Perkwh</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table
                 >
                </div>
              </div>
</div>
            </div>
</div>
</form>
<!-- <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#editModal"
                      data-bs-whatever=""
                    >
                      <i class="bx bx-plus me-1"></i> Tambah Daya & Tarif
                    </button> -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Daya & Tarif</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="<?= base_url('/update-data-tarif'); ?>" method="POST">
                            <div class="modal-body">
                                
                                <input type="hidden" name="id_tarif" id="edit_id_tarif">

                                <div class="mb-3">
                                  <label for="edit_daya" class="col-form-label">Daya Listrik</label>
                                  <input type="text" class="form-control" id="edit_daya" name="edit_daya">
                                </div>
                                <div class="mb-3">
                                  <label for="edit_tarif" class="col-form-label">Tarif Listrik</label>
                                  <input type="number" class="form-control" id="edit_tarif" name="edit_tarif">
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
              <!--/ Basic Bootstrap Table -->
              <!-- Modal -->

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>           -->

    <script>

      //  $(document).ready(function() {
      //           // Inisialisasi DataTables pada tabel dengan ID 'example'
      //           $('#example').DataTable();
      //       });
    // Ambil elemen modal edit berdasarkan ID-nya
    const editModal = document.getElementById('editModal');

    // Tambahkan "event listener" yang akan berjalan setiap kali modal AKAN DITAMPILKAN
    editModal.addEventListener('show.bs.modal', event => {
        // Dapatkan tombol mana yang diklik untuk memicu modal ini
        const button = event.relatedTarget;

        // Ambil data dari atribut `data-bs-*` pada tombol tersebut
        const id = button.getAttribute('data-bs-id');
        const daya = button.getAttribute('data-bs-daya');
        const tarif = button.getAttribute('data-bs-tarif');

        // Cari elemen input di dalam modal
        const modalInputId = editModal.querySelector('#edit_id_tarif');
        const modalInputDaya = editModal.querySelector('#edit_daya');
        const modalInputTarif = editModal.querySelector('#edit_tarif');

        // Isi nilai input di dalam modal dengan data yang kita dapatkan
        modalInputId.value = id;
        modalInputDaya.value = daya;
        modalInputTarif.value = tarif;
    });


     function doDelete(idDelete){
			swal({
				title : "Hapus Data Tarif?",
				text : "YAKIN MAU HAPUS NIH??!!!",
				icon : "warning",
				buttons : true,
				dangerMode : false,
			})
			.then(ok => {
				if(ok){
					window.location.href = '<?= base_url();?>/hapus-data-tarif/' + idDelete;
				}
				else{
					$(this).removeAttr('disabled')
				}
			})
		}
</script>
    <!-- Core JS


     build:js assets/vendor/js/core.js  -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
     <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script> 
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>



<div class="layout-page">
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Kartu Selamat Datang -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Selamat Datang, <?= esc(session()->get('ses_user')); ?>! 🎉</h5>
                                    <p class="mb-4">
                                         Selamat bekerja dan semoga harimu menyenangkan!
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img
                                        src="/assets/img/illustrations/man-with-laptop-light.png"
                                        height="140"
                                        alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Kartu Selamat Datang -->

                <!-- Grup Widget Statistik -->
                <div class="col-12">
                    <div class="row">
                        <!-- Widget Total Pelanggan -->
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Pelanggan</span>
                                    <h3 class="card-title mb-2"><?= esc($total_pelanggan); ?></h3>
                                    <!-- <small class="text-muted fw-semibold">Pelanggan terdaftar</small> -->
                                </div>
                            </div>
                        </div>

                        <!-- Widget Tagihan Belum Lunas -->
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-receipt"></i></span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Tagihan Belum Lunas</span>
                                    <h3 class="card-title mb-2"><?= esc($tagihan_belum_lunas); ?></h3>
                                    <!-- <small class="text-muted fw-semibold">Perlu dikonfirmasi</small> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-receipt"></i></span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Tagihan Sudah Lunas</span>
                                    <h3 class="card-title mb-2"><?= esc($tagihan_sudah_lunas); ?></h3>
                                    <!-- <small class="text-muted fw-semibold">Perlu dikonfirmasi</small> -->
                                </div>
                            </div>
                        </div>

                        <!-- Widget Total Pendapatan -->
                        <!-- <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-dollar-circle"></i></span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Pendapatan</span>
                                    <small class="text-muted fw-semibold">Dari semua pembayaran</small>
                                </div>
                            </div>
                        </div> -->

                        <!-- Widget Jumlah Admin -->
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-user-check"></i></span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Jumlah Admin</span>
                                    <h3 class="card-title mb-2"><?= esc($total_admin); ?></h3>
                                    <!-- <small class="text-muted fw-semibold">Admin yang bertugas</small> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Grup Widget Statistik -->

            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
</div>
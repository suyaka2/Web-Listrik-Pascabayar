<div class="layout-page">
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col-lg-8 order-0">
                    <div class="card mb-4">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Selamat Datang, <?= esc(session()->get('ses_user')); ?>! 🎉</h5>
                                    
                                    <?php if ($tagihan_aktif ): ?>
                                        <p class="mb-4">
                                            Tagihan Anda Di Periode ini,
                                            <strong>
                                                <?php
                                                    $tanggalObj = new DateTime($tagihan_aktif ['tahun'] . '-' . $tagihan_aktif ['bulan'] . '-01');
                                                    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMMM');
                                                    echo $formatter->format($tanggalObj) . ' ' . $tagihan_aktif ['tahun'];
                                                ?>
                                            </strong>
                                            
                                            <span class="fw-bold">Rp <?= number_format($tagihan_aktif['total_plus_admin'], 0, ',', '.') ?></span>.
                                        </p>
                                        <a href="<?= base_url('/pelanggan/data-tagihan') ?>" class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                    <?php else: ?>
                                        <p class="mb-4">
                                            Terima kasih! Saat ini Anda tidak memiliki tagihan aktif. Semua tagihan Anda sudah lunas.
                                        </p>
                                        <a href="<?= base_url('/pelanggan/data-tagihan') ?>" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img
                                        src="/assets/img/illustrations/man-with-laptop-light.png"
                                        height="140"
                                        alt="Selamat Datang"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                                </div>
                                <div class="me-2">
                                    <small class="text-muted d-block">Alamat Rumah</small>
                                    <h5 class="mb-0" style="white-space: normal;"><?= esc($info_pelanggan['alamat'] ?? 'N/A'); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">

                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="/assets/img/icons/unicons/wallet-info.png" alt="Nomor KWH" class="rounded"/>
                                        </div>
                                        <div class="me-2">
                                            <small class="text-muted d-block">Nomor KWH</small>
                                            <h6 class="mb-0"><?= esc($info_pelanggan['nomor_kwh'] ?? 'N/A'); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-bolt-circle"></i></span>
                                        </div>
                                        <div class="me-2">
                                            <small class="text-muted d-block">Daya Listrik</small>
                                            <h6 class="mb-0"><?= esc($info_pelanggan['daya'] ?? 'N/A'); ?> VA</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar flex-shrink-0 me-3">
                                           <span class="avatar-initial rounded bg-label-success"><i class="bx bx-receipt"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Riwayat Transaksi</h6>
                                                <small class="text-muted">Total Pembayaran Berhasil</small>
                                            </div>
                                            <div class="user-progress">
                                                <h5 class="mb-0 fw-bold"><?= $total_pembayaran; ?> Kali</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
   
</div>
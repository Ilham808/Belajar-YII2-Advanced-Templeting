<?php

$this->title = 'Dashboard';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dashboard</h4>
                <!-- <h6 class="card-subtitle">Average sales</h6> -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="py-3 d-flex d-flex align-items-center">
                            <span class="btn btn-primary btn-circle d-flex align-items-center">
                                <i class="mdi mdi-domain fs-4" ></i>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-0 fw-bold">Kelas</h5>
                                <!-- <span class="text-muted fs-6">Johnathan Doe</span> -->
                            </div>
                            <div class="ms-auto">
                                <span class="badge bg-light text-muted"><?= $countKelas ?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="py-3 d-flex align-items-center">
                            <span class="btn btn-warning btn-circle d-flex align-items-center">
                                <i class="mdi mdi-account-multiple fs-4" ></i>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-0 fw-bold">Guru</h5>
                                <!-- <span class="text-muted fs-6">MaterialPro Admin</span> -->
                            </div>
                            <div class="ms-auto">
                                <span class="badge bg-light text-muted"><?= $countGuru ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="py-3 d-flex align-items-center">
                            <span class="btn btn-success btn-circle d-flex align-items-center">
                                <i class="mdi mdi-account-multiple text-white fs-4" ></i>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-0 fw-bold">Siswa</h5>
                                <!-- <span class="text-muted fs-6">Ample Admin</span> -->
                            </div>
                            <div class="ms-auto">
                                <span class="badge bg-light text-muted"><?= $countSiswa ?></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $this->include('simta/simta_partial/dashboard/header'); ?>
<?php echo $this->include('simta/simta_partial/dashboard/top_menu'); ?>
<?php if (has_permission('admin')): ?>
<?php echo $this->include('master_partial/dashboard/side_menu') ?>
<?php else: ?>
<?php echo $this->include('simta/simta_partial/dashboard/side_menu') ?>
<?php endif;?>

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Halaman <?=$title?></h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col">
                        <div class="card shadow mb-4">
                        <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <!-- table -->
                                <form method="POST" action="<?= base_url('simta/penilaianakhir/update/' . $penilaianakhir->id_hasilakhir); ?>"
                                    enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <?php if(has_permission('admin')) : ?>
                                    <div class="form-group mb-3">
                                        <label for="simple-select1">Nama Mahasiswa</label>
                                        <select name="id_mhs"
                                            class="form-control select2 <?= ($validation->hasError('id_mhs')) ? 'is-invalid' : ''; ?>">
                                            <option>Pilih Mahasiswa</option>
                                            <?php foreach ($mahasiswa as $m) : ?>
                                            <option value="<?= $m->id_mhs ?>"
                                                <?= ($penilaianakhir->id_mhs) == $m->id_mhs ? 'selected' : '' ?>><?= $m->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php else: ?>
                                    <input class="form-control" type="hidden" class="form-control" name="id_mhs"
                                        value="<?= $mhs[0]->id_mhs ?>">
                                    <?php endif; ?>
                                    <div class="form-group mb-3">
                                        <label for="example-select">Nama Dosen Pembimbing</label>
                                        <select name="id_staf"
                                            class="form-control select2 <?= ($validation->hasError('id_staf')) ? 'is-invalid' : ''; ?>">
                                            <option>Pilih Dosen Pembimbing</option>
                                            <?php foreach ($staf as $s) : ?>
                                            <option value="<?= $s->id_staf ?>"
                                                <?= ($penilaianakhir->id_staf) == $s->id_staf ? 'selected' : '' ?>><?= $s->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_staf'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nilai Ujian Proposal</label>
                                        <input type="text" id="address-wpalaceholder" name="nilai_ujianproposal"
                                            class="form-control" placeholder="Contoh : 10%"
                                            value="<?= $penilaianakhir->nilai_ujianproposal ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('nilai_ujianproposal')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('nilai_ujianproposal'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nilai Seminar Hasil</label>
                                        <input type="text" id="address-wpalaceholder" name="nilai_seminarhasil"
                                            class="form-control" placeholder="Contoh : 10%"
                                            value="<?= $penilaianakhir->nilai_seminarhasil ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('nilai_seminarhasil')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('nilai_seminarhasil'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nilai Penilaian Ujian Tugas Akhir</label>
                                        <input type="text" id="address-wpalaceholder" name="nilai_ujianta"
                                            class="form-control" placeholder="Contoh : 10%"
                                            value="<?= $penilaianakhir->nilai_ujianta ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('nilai_ujianta')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('nilai_ujianta'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nilai Akhir Tugas Akhir</label>
                                        <input type="text" id="address-wpalaceholder" name="hasilakhir"
                                            class="form-control" placeholder="Contoh : 10%"
                                            value="<?= $penilaianakhir->hasilakhir ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('hasilakhir')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('hasilakhir'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                    <a href="<?=base_url('simta/penilaianakhir');?>" class="btn btn-warning">Kembali</a>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- end section -->
            </div>
            <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container-fluid -->
</main>
<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
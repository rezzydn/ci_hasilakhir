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
                                <form method="POST" action="<?= base_url('simta/ujianta/updatepenguji/' . $ujianta->id_ujianta); ?>"
                                    enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    
                                    <div class="form-group mb-3">
                                        <label for="simple-select2">Rekomendasi Dosen</label>
                                        <select class="form-control select2" name="nama_rekomendasi"
                                            id="simple-select2">
                                            <option value="">Pilih Nama</option>
                                            <option value="REKOMENDASI 1"
                                                <?= $ujianta->nama_rekomendasi == 'REKOMENDASI 1' ? 'selected' : ''?>>
                                                REKOMENDASI 1</option>
                                            <option value="REKOMENDASI 2"
                                                <?= $ujianta->nama_rekomendasi == 'REKOMENDASI 2' ? 'selected' : ''?>>
                                                REKOMENDASI 2</option>
                                        </select>
                                        <!-- Error Validation -->

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="example-select">Nama Dosen Penguji</label>
                                        <select name="id_staf"
                                            class="form-control select2 <?= ($validation->hasError('id_staf')) ? 'is-invalid' : ''; ?>">
                                            <option>Pilih Dosen Penguji</option>
                                            <?php foreach ($staf as $s) : ?>
                                            <option value="<?= $s->id_staf ?>"><?= $s->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_staf'); ?>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                    <a href="<?=base_url('simta/ujianta');?>" class="btn btn-warning">Kembali</a>
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
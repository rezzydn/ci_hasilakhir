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
                                <form method="POST" action="<?= base_url('simta/ujianproposal/updatestatus/' . $ujianproposal->id_ujianproposal); ?>"
                                    enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nilai Total</label>
                                        <input type="text" id="address-wpalaceholder" name="nilai_up"
                                            class="form-control" placeholder="Masukkan Nilai"
                                            value="<?= $ujianproposal->nilai_up ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('nilai_up')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('nilai_up'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="simple-select2">Status</label>
                                        <select class="form-control select2" name="status_up"
                                            id="simple-select2">
                                            <option value="">Pilih Status</option>
                                            <option value="LULUS"
                                                <?= $ujianproposal->status_up == 'LULUS' ? 'selected' : ''?>>
                                                LULUS</option>
                                            <option value="LULUS DENGAN REVISI"
                                                <?= $ujianproposal->status_up == 'LULUS DENGAN REVISI' ? 'selected' : ''?>>
                                                LULUS DENGAN REVISI</option>
                                            <option value="GAGAL"
                                                <?= $ujianproposal->status_up == 'GAGAL' ? 'selected' : ''?>>
                                                GAGAL</option>
                                        </select>
                                        <!-- Error Validation -->

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Catatan</label>
                                        <input type="text" id="address-wpalaceholder" name="catatan"
                                            class="form-control" placeholder="Masukkan Catatan"
                                            value="<?= $ujianproposal->catatan ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('catatan')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('catatan'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                    <a href="<?=base_url('simta/ujianproposal');?>" class="btn btn-warning">Kembali</a>
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
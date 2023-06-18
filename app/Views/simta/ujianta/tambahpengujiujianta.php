<?php echo $this->include('simta/simta_partial/dashboard/header');?>
<?php echo $this->include('simta/simta_partial/dashboard/top_menu');?>
<?php if(has_permission('admin')) : ?>
<?php echo $this->include('master_partial/dashboard/side_menu') ?>
<?php else : ?>
<?php echo $this->include('simta/simta_partial/dashboard/side_menu') ?>
<?php endif; ?>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Form Tambah Data Ujian Proposal</h2>
                <div class="row my-4">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title"></strong>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data"
                                    action="<?=base_url('simta/ujianta/storepengujiujianta/' . $ujianta->id_ujianta);?>"> 
                                    <?=csrf_field();?>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Ujian ta</label>
                                        <input type="text" id="address-wpalaceholder" name="id_ujianta"
                                            class="form-control" placeholder="Masukkan Ujian ta"
                                            value="<?= $ujianta->id_ujianta ?>" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('id_ujianta')) { ?>
                                        <div class='alert alert-danger mt-2'>
                                            <?= $error = $validation->getError('id_ujianta'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="example-select">Nama Dosen</label>
                                        <select name="id_staf"
                                            class="form-control select2 <?= ($validation->hasError('id_staf')) ? 'is-invalid' : ''; ?>">
                                            <option>Pilih Rekomendasi Dosen Pembimbing</option>
                                            <?php foreach ($staf as $s) : ?>
                                            <option value="<?= $s->id_staf ?>"><?= $s->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_staf'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address-wpalaceholder">Nama Penguji</label>
                                        <input type="text" id="address-wpalaceholder" name="nama_penguji"
                                            class="form-control" placeholder="Masukkan Nama Penguji" />
                                        <!-- Error Validation -->
                                        <?php if ($validation->getError('nama_penguji')) {?>
                                        <div class='alert alert-danger mt-2'>
                                            <?=$error = $validation->getError('nama_penguji');?>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Tambah
                                    </button>
                                    <a href="<?=base_url('simta/ujianta/detail');?>" class="btn btn-warning">Kembali</a>
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
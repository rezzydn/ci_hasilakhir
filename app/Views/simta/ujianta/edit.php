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
                                <?php $validation = \Config\Services::validation();?>
                                <form method="POST" enctype="multipart/form-data" 
                                action="<?=base_url("simta/ujianta/update/" . $ujianta->id_ujianta)?>">
                                <?=csrf_field(); ?>
                                <div class="form-group mb-3">
                                        <label for="simple-select1">Nama Mahasiswa</label>
                                        <select
                                            class="form-control <?= ($validation->hasError('id_mhs')) ? 'is-invalid' : ''; ?>"
                                            name="id_mhs">
                                            <option value="">Pilih Mahasiswa</option>
                                            <?php foreach ($mahasiswa as $mhs) : ?>
                                            <option value="<?= $mhs->id_mhs ?>"
                                                <?= ($ujianta->id_mhs == $mhs->id_mhs) ? 'selected' : '' ?>>
                                                <?= $mhs->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_mhs'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="example-select">Nama Dosen Pembimbing</label>
                                        <select name="id_staf"
                                            class="form-control <?= ($validation->hasError('id_staf')) ? 'is-invalid' : ''; ?>">
                                            <option>Pilih Dosen Pembimbing</option>
                                            <?php foreach ($staf as $s) : ?>
                                            <option value="<?= $s->id_staf ?>"
                                                <?= ($ujianta->id_staf) == $s->id_staf ? 'selected' : '' ?>>
                                                <?= $s->nama ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_staf'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama_judul">Judul Tugas Akhir</label>
                                        <input type="text" id="nama_judul" name="nama_judul" class="form-control <?=($validation->hasError('nama_judul')) ? 'is-invalid' : ''?>" value="<?=$ujianta->nama_judul?>" placeholder="Masukkan Judul Tugas Akhir" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('nama_judul');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="abstrak">Abstrak</label>
                                        <input type="text" id="abstrak" name="abstrak" class="form-control <?=($validation->hasError('abstrak')) ? 'is-invalid' : ''?>" value="<?=$ujianta->abstrak?>" placeholder="Masukkan Judul Tugas Akhir" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('abstrak');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ruangan">Ruangan Ujian</label>
                                        <input type="text" id="ruangan" name="ruangan" class="form-control <?=($validation->hasError('ruangan')) ? 'is-invalid' : ''?>" value="<?=$ujianta->ruangan?>" placeholder="Masukkan Judul Tugas Akhir" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('ruangan');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" id="tanggal" name="tanggal" class="form-control <?=($validation->hasError('tanggal')) ? 'is-invalid' : ''?>" value="<?=$ujianta->tanggal?>" placeholder="Masukkan Judul Tugas Akhir" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('tanggal');?>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Edit
                                    </button>
                                    <a href="<?=base_url('simta/ujianta');?>" class="btn btn-warning">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>

<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
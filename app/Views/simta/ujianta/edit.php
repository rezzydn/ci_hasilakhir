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
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="mt-2 page-title">Halaman Edit Ujian Tugas Akhir</h2>
                    </div>
                <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Edit Ujian Tugas Akhir</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Edit Ujian Tugas Akhir</li>
                        </ol>
                    </div>
                    <?php endif; ?>
                </div>
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
                                        <label for="ruangan">Ruangan Ujian Tugas Akhir<span class="text-danger">*</span></label>
                                        <input type="text" id="ruangan" name="ruangan" class="form-control <?=($validation->hasError('ruangan')) ? 'is-invalid' : ''?>" value="<?=$ujianta->ruangan?>" placeholder="Masukkan Judul Tugas Akhir" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('ruangan');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal Ujian<span class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" name="tanggal"
                                            class="form-control <?=($validation->hasError('tanggal')) ? 'is-invalid' : ''?>"
                                            value="<?=date('Y-m-d',round($ujianta->tanggal/1000))?>" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('tanggal');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="jam_mulai">Jam Mulai<span class="text-danger">*</span></label>
                                        <input type="time" id="jam_mulai" name="jam_mulai"
                                            class="form-control <?=($validation->hasError('jam_mulai')) ? 'is-invalid' : ''?>"
                                            value="<?=date('H:i', round($ujianta->jam_mulai/1000))?>" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('jam_mulai');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="jam_selesai">Jam Selesai<span class="text-danger">*</span></label>
                                        <input type="time" id="jam_selesai" name="jam_selesai"
                                            class="form-control <?=($validation->hasError('jam_selesai')) ? 'is-invalid' : ''?>"
                                            value="<?=date('H:i', round($ujianta->jam_selesai/1000))?>" />
                                        <!-- Error Validation -->
                                        <div class="invalid-feedback">
                                            <?=$validation->getError('jam_selesai');?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simple-select2">Hasil<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="status_ajuan"
                                            id="simple-select2">
                                            <option value="">Pilih Hasil</option>
                                            <option value="diterima"
                                                <?= $ujianta->status_ajuan == 'diterima' ? 'selected' : ''?>>
                                                DITERIMA</option>
                                            <option value="pending"
                                                <?= $ujianta->status_ajuan == 'pending' ? 'selected' : ''?>>
                                                PENDING</option>
                                            <option value="ditolak"
                                                <?= $ujianta->status_ajuan == 'ditolak' ? 'selected' : ''?>>
                                                DITOLAK</option>
                                        </select>
                                        <!-- Error Validation -->

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
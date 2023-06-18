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
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                            if(has_permission('admin') || has_permission('dosen')) {
                                echo '<h2 class="mt-2 page-title">Halaman Pengelolaan Seminar Hasil</h2>';
                            } else {
                                echo '<h2 class="mt-2 page-title">Halaman Pendaftaran Seminar Hasil</h2>';
                            }
                        ?>
                    </div>
                    <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Pengelolaan Seminar Hasil</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Pendaftaran Seminar Hasil</li>
                        </ol>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row my-3">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <?php if(has_permission('mahasiswa')) : ?>
                                <a href="<?=base_url('simta/seminarhasil/tambah');?>" class="btn btn-primary mb-3">Tambah</a>
                                <?php endif; ?>
                                <table class="table datatables" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <?php if(has_permission('admin') || has_permission('dosen')) : ?>
                                                <th>Nama Mahasiswa</th>
                                            <?php endif; ?>
                                            <?php if(has_permission('admin') || has_permission('mahasiswa')) : ?>
                                                <th>Nama Dosen Pembimbing</th>
                                            <?php endif; ?>
                                            <?php if(has_permission('admin') || has_permission('dosen')) : ?>
                                            <th>NIM</th>
                                            <?php endif; ?>
                                            <?php if(has_permission('admin') || has_permission('dosen')) : ?>
                                            <th>Kelas</th>
                                            <?php endif; ?>
                                            <th>Nama Judul</th>
                                            <th>Hasil</th>
                                            <th>Status Pengajuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            if (has_permission('admin')):
                                            $no = 1;
                                            foreach ($seminarhasil as $sh1) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh1->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($sh1->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh1->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh1->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                                </td>

                                                <td><?=$sh1->nama_judul?></td>
                                                <td>
                                                    <?php if ($sh1->status_sh == 'DIAJUKAN'): ?>
                                                    <span class="badge badge-warning">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($sh1->status_sh == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$sh1->status_sh?></span>
                                                    <?php } else if ($sh1->status_sh == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-info"><?=$sh1->status_sh?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($sh1->status_sh == 'ULANG') {?>
                                                    <span class="badge badge-danger"><?=$sh1->status_sh?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($sh1->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$sh1->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($sh1->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$sh1->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($sh1->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$sh1->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopsh="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/edit/$sh1->id_seminarhasil");?>">
                                                            Pengaturan Jadwal</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/editstatus/$sh1->id_seminarhasil");?>">
                                                            Penilaian</a>
                                                            <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/detail/$sh1->id_seminarhasil");?>">Detail</a>
                                                        <?php if(has_permission('admin')) : ?> <form method="POST"
                                                            action="<?=base_url("simta/seminarhasil/delete/$sh1->id_seminarhasil");?>">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="dropdown-item remove-item-btn"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; elseif (has_permission('mahasiswa')):
                                            $no = 1;
                                            foreach ($seminarhasil2 as $sh2) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($sh2->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                                </td>
                                                <td><?=$sh2->nama_judul?></td>
                                                <td>
                                                    <?php if ($sh2->status_sh == ''): ?>
                                                    <span class="badge badge-info">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($sh2->status_sh == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$sh2->status_sh?></span>
                                                    <?php } else if ($sh2->status_sh == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-warning"><?=$sh2->status_sh?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($sh2->status_sh == 'ULANG') {?>
                                                    <span class="badge badge-danger"><?=$sh2->status_sh?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($sh2->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$sh2->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($sh2->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$sh2->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($sh2->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$sh2->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopsh="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/revisi/$sh2->id_seminarhasil");?>">Revisi</a>
                                                            <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/detail/$sh2->id_seminarhasil");?>">Detail</a>

                                                    </div>
                                                </td>

                                            </tr>
                                            <?php endforeach; elseif (has_permission('dosen')):
                                            $no = 1;
                                            foreach ($seminarhasil3 as $sh3) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh3->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh3->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($sh3->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                                </td>
                                                <td><?=$sh3->nama_judul?></td>
                                                <td>
                                                    <?php if ($sh3->status_sh == 'DIAJUKAN'): ?>
                                                    <span class="badge badge-info">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($sh3->status_sh == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$sh3->status_sh?></span>
                                                    <?php } else if ($sh3->status_sh == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-warning"><?=$sh3->status_sh?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($sh3->status_sh == 'ULANG') {?>
                                                    <span class="badge badge-danger"><?=$sh3->status_sh?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($sh3->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$sh3->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($sh3->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$sh3->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($sh3->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$sh3->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopsh="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/editstatus/$sh3->id_seminarhasil");?>">Penilaian</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/seminarhasil/detail/$sh3->id_seminarhasil");?>">Detail</a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php endforeach; else :
                                            $no = 1;
                                            foreach ($seminarhasil4 as $k) {
                                        ?>
                                            <tr>

                                            </tr>
                                            <?php } endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- simple table -->
                </div>
                <!-- end section -->
            </div>
            <!-- .col-12 -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container-fluid -->
</main>
<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
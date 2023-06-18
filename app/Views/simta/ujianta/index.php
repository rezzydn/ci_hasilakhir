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
                                echo '<h2 class="mt-2 page-title">Halaman Pengelolaan Ujian Tugas Akhir</h2>';
                            } else {
                                echo '<h2 class="mt-2 page-title">Halaman Pendaftaran Ujian Tugas Akhir</h2>';
                            }
                        ?>
                    </div>
                    <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Pengelolaan Ujian Tugas Akhir</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Pendaftaran Ujian Tugas Akhir</li>
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
                                <a href="<?=base_url('simta/ujianta/tambah');?>" class="btn btn-primary mb-3">Tambah</a>
                                <?php endif; ?>
                                <table class="table datatables" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <?php if(has_permission('admin') || has_permission('dosen')) : ?>
                                                <th>Nama Mahasiswa</th>
                                            <?php endif; ?>
                                            <?php if(has_permission('admin') || has_permission('mahasiswa')) : ?>
                                                <th>Nama Dosen Penguji</th>
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
                                            foreach ($ujianta as $ut1) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut1->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($ut1->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut1->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut1->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                                </td>
                                                <td><?=$ut1->nama_judul?></td>
                                                <td>
                                                    <?php if ($ut1->status_ut == 'DIAJUKAN'): ?>
                                                    <span class="badge badge-info">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($ut1->status_ut == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$ut1->status_ut?></span>
                                                    <?php } else if ($ut1->status_ut == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-warning"><?=$ut1->status_ut?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($ut1->status_ut == 'GAGAL') {?>
                                                    <span class="badge badge-danger"><?=$ut1->status_ut?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($ut1->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$ut1->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($ut1->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$ut1->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($ut1->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$ut1->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/edit/$ut1->id_ujianta");?>">
                                                            Pengaturan Jadwal</a>
                                                            <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/tambahpengujiujianta/$ut1->id_ujianta");?>">
                                                            Tambah Dosen Penguji
                                                            <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/editstatus/$ut1->id_ujianta");?>">
                                                            Penilaian</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/detail/$ut1->id_ujianta");?>">Detail</a>
                                                        <?php if(has_permission('admin')) : ?> <form method="POST"
                                                            action="<?=base_url("simta/ujianta/delete/$ut1->id_ujianta");?>">
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
                                            foreach ($ujianta2 as $ut2) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($ut2->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                                </td>
                                                <td><?=$ut2->nama_judul?></td>
                                                <td>
                                                    <?php if ($ut2->status_ut == ''): ?>
                                                    <span class="badge badge-info">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($ut2->status_ut == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$ut2->status_ut?></span>
                                                    <?php } else if ($ut2->status_ut == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-warning"><?=$ut2->status_ut?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($ut2->status_ut == 'GAGAL') {?>
                                                    <span class="badge badge-danger"><?=$ut2->status_ut?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($ut2->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$ut2->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($ut2->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$ut2->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($ut2->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$ut2->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/revisi/$ut2->id_ujianta");?>">Revisi</a>
                                                            <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/detail/$ut2->id_ujianta");?>">Detail</a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php endforeach; elseif (has_permission('dosen')):
                                            $no = 1;
                                            foreach ($ujianta3 as $ut3) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut3->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut3->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                                </td>
                                                <td>
                                                    <?php foreach($mahasiswa as $mhs) {
                                                    echo ($ut3->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                                </td>
                                                <td><?=$ut3->nama_judul?></td>
                                                <td>
                                                    <?php if ($ut3->status_ut == ''): ?>
                                                    <span class="badge badge-info">DIAJUKAN</span>
                                                    <?php else: ?>
                                                    <?php if ($ut3->status_ut == 'LULUS') {?>
                                                    <span class="badge badge-success"><?=$ut3->status_ut?></span>
                                                    <?php } else if ($ut3->status_ut == 'LULUS DENGAN REVISI') {?>
                                                    <span class="badge badge-warning"><?=$ut3->status_ut?></span> 
                                                    <?php } else {?>
                                                    <?php } if ($ut3->status_ut == 'GAGAL') {?>
                                                    <span class="badge badge-danger"><?=$ut3->status_ut?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($ut3->status_ajuan == 'pending'): ?>
                                                    <span class="badge badge-warning"><?=$ut3->status_ajuan?></span>
                                                    <?php else: ?>
                                                    <?php if ($ut3->status_ajuan == 'diterima') {?>
                                                    <span class="badge badge-success"><?=$ut3->status_ajuan?></span>
                                                    <?php } else {?>
                                                    <?php } if ($ut3->status_ajuan == 'ditolak') {?>
                                                    <span class="badge badge-danger"><?=$ut3->status_ajuan?></span>
                                                    <?php }?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/editstatus/$ut3->id_ujianta");?>">Penilaian</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/detail/$ut3->id_ujianta");?>">Detail</a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php endforeach; else :
                                            $no = 1;
                                            foreach ($ujianproposal4 as $k) {
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
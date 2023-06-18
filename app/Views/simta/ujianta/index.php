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
                <h2 class="mb-2 page-title">Halaman Pengelolaan Data Ujian Tugas Akhir</h2>
                <p class="card-text">
                    Halaman Pendaftaran Ujian Tugas Akhir
                </p>
                <?php
                    if(session()->getFlashData('status')){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('status') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    }
                    ?>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <?php if(has_permission('admin') || has_permission('mahasiswa')) : ?>
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
                                            <th>Status</th>
                                            <th>File</th>
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
                                                <td><?=$ut1->nama_judul?></td>
                                                <td>
                                                    <?php if ($ut1->status_ut == ''): ?>
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
                                                <td>
                                                    <?php if ($ut1->proposalakhir == ''): ?>
                                                    <span class="badge badge-danger">Belum upload</span>
                                                    <?php else: ?>
                                                    <a class="mx-1 my-1 btn btn-sm btn-outline-primary"
                                                        href="<?=base_url("simta/ujianta/download_proposalakhir/$ut1->id_ujianta");?>">
                                                        <span class="fe fe-download-cloud fe-16 align-middle"></span>
                                                    </a>
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
                                                            href="<?=base_url("simta/ujianta/editstatus/$ut1->id_ujianta");?>">Edit
                                                            Status</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/edit/$ut1->id_ujianta");?>">Edit
                                                            Pendaftaran</a>
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianta/tambahpengujiujianta/$ut1->id_ujianta");?>">
                                                            Tambah Dosen Penguji
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
                                                    <?php if ($ut2->proposalakhir == ''): ?>
                                                    <span class="badge badge-danger">Belum upload</span>
                                                    <?php else: ?>
                                                    <a class="mx-1 my-1 btn btn-sm btn-outline-primary"
                                                        href="<?=base_url("simta/ujianta/download_proposalakhir/$ut2->id_ujianta");?>">
                                                        <span class="fe fe-download-cloud fe-16 align-middle"></span>
                                                    </a>
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
                                                    <?php if ($ut3->proposalakhir == ''): ?>
                                                    <span class="badge badge-danger">Belum upload</span>
                                                    <?php else: ?>
                                                    <a class="mx-1 my-1 btn btn-sm btn-outline-primary"
                                                        href="<?=base_url("simta/ujianta/download_proposalakhir/$ut3->id_ujianta");?>">
                                                        <span class="fe fe-download-cloud fe-16 align-middle"></span>
                                                    </a>
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
                                                            href="<?=base_url("simta/ujianta/editstatus/$ut3->id_ujianta");?>">Edit
                                                        Status</a>
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
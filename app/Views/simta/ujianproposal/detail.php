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
                        <h2 class="mt-2 page-title">Halaman Detail Ujian Proposal</h2>
                    </div>
                <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Ujian Proposal</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Ujian Proposal</li>
                        </ol>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                        <tbody>
                        <table class="table">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianproposal->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianproposal->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianproposal->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                </td>
                            </tr>
                            <tr>    
                                <th>Nama Dosen Pembimbing</th>
                                <td><?php foreach($staf as $s) {
                                    echo ($ujianproposal->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                </td>
                            </tr> 
                                <th>Nama Judul Tugas Akhir</th>
                                <td><?=$ujianproposal->nama_judul?></td>
                            </tr>
                            <tr>
                                <th>Abstrak</th>
                                <td><?=$ujianproposal->abstrak?></td>
                            </tr>
                            <tr>
                                <th>Jadwal Ujian</th>
                                <td><?=date('d M Y', round($ujianproposal->tanggal/1000))?></td>
                            </tr>
                            <tr>
                                <th>Ruangan Ujian</th>
                                <td><?=$ujianproposal->ruang_sempro?></td>
                            </tr>
                            <tr>
                                <th>Waktu Ujian</th>
                                <td><?=date('H:i', round($ujianproposal->jam_mulai/1000))?> WIB</td>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <td><?=date('H:i', round($ujianproposal->jam_selesai/1000))?> WIB</td></td>
                            </tr>
                            <tr>
                                <th>Status Ajuan</th>
                                <td><?=$ujianproposal->status_ajuan?></td>
                            </tr>
                            <tr>
                                <th>Status Hasil</th>
                                <td><?=$ujianproposal->status_up?></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td><?=$ujianproposal->catatan?></td>
                            </tr>
                        </table>
                        <tbody>
                        </div>
                        </div>
                    </div>
                    <!-- Small table -->
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatables" id="dataTable-1">
                                    <!-- konten tabel -->
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Nama Dosen</th>
                                                <?php if(has_permission('admin')) : ?>
                                                <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengujiujianproposal as $pup) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?=$pup->nama_penguji?></td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($pup->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                                </td>
                                                <?php if(has_permission('admin')) : ?>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="<?=base_url("simta/ujianproposal/editpengujiujianproposal/$pup->id_penguji_ujianproposal");?>">Edit</a>
                                                        <?php if(has_permission('admin')) : ?> <form method="POST"
                                                            action="<?=base_url("simta/ujianproposal/deletepengujiujianproposal/$pup->id_penguji_ujianproposal");?>">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="dropdown-item remove-item-btn"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach?>
                                        </tbody>
                                        <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Proposal Tugas Akhir</h5>
                                <p>
                                    <?php if($ujianproposal->proposalawal == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a href="<?= base_url('simta/ujianproposal/download_proposalawal/' . $ujianproposal->id_ujianproposal); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <h5>Transkrip Nilai</h5>
                                <p>
                                    <?php if($ujianproposal->transkrip_nilai == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a
                                        href="<?= base_url('simta/ujianproposal/download_transkripnilai/' . $ujianproposal->id_ujianproposal); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <h5>Revisi Proposal</h5>
                                <p>
                                    <?php if($ujianproposal->revisi_proposal == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a
                                        href="<?= base_url('simta/ujianproposal/download_revisi_proposal/' . $ujianproposal->id_ujianproposal); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </table>
                    </div>
                                <a href="<?=base_url('simta/ujianproposal');?>" class="btn btn-warning">Kembali</a>
                            </div> <!-- end section -->
                        </div> <!-- .col-12 -->
                    </div>
                    
                </div>
            </div>
            
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>

<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
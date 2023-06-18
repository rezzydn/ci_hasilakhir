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
                        <h2 class="mt-2 page-title">Halaman Detail Ujian Tugas Akhir</h2>
                    </div>
                <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Ujian Tugas Akhir</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Ujian Tugas Akhir</li>
                        </ol>
                    </div>
                    <?php endif; ?>
                </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Halaman <?=$title?></h2>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                        <tbody>
                        <table class="table">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianta->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianta->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($ujianta->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                </td>
                            </tr>
                            <tr>    
                                <th>Nama Dosen Pembimbing</th>
                                <td><?php foreach($staf as $s) {
                                    echo ($ujianta->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                </td>
                            </tr> 
                                <th>Nama Judul Tugas Akhir</th>
                                <td><?=$ujianta->nama_judul?></td>
                            </tr>
                            </tr>
                                <th>Abstrak</th>
                                <td><?=$ujianta->abstrak?></td>
                            </tr>
                            <tr>
                                <th>Jadwal Ujian</th>
                                <td><?=date('d M Y', round($ujianta->tanggal/1000))?></td>
                            </tr>
                            <tr>
                                <th>Ruangan Ujian</th>
                                <td><?=$ujianta->ruangan?></td>
                            </tr>
                            <tr>
                                <th>Waktu Ujian</th>
                                <td><?=date('H:i', round($ujianta->jam_mulai/1000))?> WIB</td>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <td><?=date('H:i', round($ujianta->jam_selesai/1000))?> WIB</td></td>
                            </tr>
                            <tr>
                                <th>Status Ajuan</th>
                                <td><?=$ujianta->status_ajuan?></td>
                            </tr>
                            <tr>
                                <th>Status Hasil</th>
                                <td><?=$ujianta->status_ut?></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td><?=$ujianta->catatan?></td>
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
                                            foreach ($pengujiujianta as $put) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?=$put->nama_penguji?></td>
                                                <td>
                                                    <?php foreach($staf as $s) {
                                                    echo ($put->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
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
                                                            href="<?=base_url("simta/ujianta/editpengujiujianta/$put->id_penguji_ujianta");?>">Edit</a>
                                                        <?php if(has_permission('admin')) : ?> <form method="POST"
                                                            action="<?=base_url("simta/ujianta/deletepengujiujianta/$put->id_penguji_ujianta");?>">
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
                                                        <?php if($ujianta->proposalakhir == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_proposalakhir/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                    <h5>Berita Acara KMM</h5>
                                                    <p>
                                                        <?php if($ujianta->berita_acarakmm == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_berita_acarakmm/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                    <h5>KRS</h5>
                                                    <p>
                                                        <?php if($ujianta->krs == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_krs/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                    <h5>Transkrip Nilai</h5>
                                                    <p>
                                                        <?php if($ujianta->transkrip_nilai == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_transkrip_nilai/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                    <h5>Rekomendasi Dosen</h5>
                                                    <p>
                                                        <?php if($ujianta->rekomendasi_dospem == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_rekomendasi_dospem/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                    <h5>Revisi Proposal</h5>
                                                    <p>
                                                        <?php if($ujianta->revisi_proposal == null) : ?>
                                                            <span class="badge badge-primary text-uppercase">belum diupload</span>
                                                            <?php else : ?>
                                                                <a href="<?= base_url('simta/ujianta/download_revisi_proposal/' . $ujianta->id_ujianta); ?>">Download</a>
                                                            <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                                <a href="<?=base_url('simta/ujianta');?>" class="btn btn-warning">Kembali</a>
                            </div> <!-- end section -->
                        </div> <!-- .col-12 -->
                    </div>
                    
                </div>
            </div>
            
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>

<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
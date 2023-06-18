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
                        <h2 class="mt-2 page-title">Halaman Detail Seminar Hasil</h2>
                    </div>
                <?php if(has_permission('admin') || has_permission('dosen')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Seminar Hasil</li>
                        </ol>
                    </div>
                    <?php elseif(has_permission('mahasiswa')): ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('simta') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIMTA</a></li>
                            <li class="breadcrumb-item active">Detail Seminar Hasil</li>
                        </ol>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                        <tbody>
                        <table class="table">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($seminarhasil->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($seminarhasil->id_mhs == $mhs->id_mhs) ? $mhs->nim : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                    echo ($seminarhasil->id_mhs == $mhs->id_mhs) ? $mhs->kelas : ''; } ?>
                                </td>
                            </tr>
                            <tr>    
                                <th>Nama Dosen Pembimbing</th>
                                <td><?php foreach($staf as $s) {
                                    echo ($seminarhasil->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                </td>
                            </tr> 
                                <th>Nama Judul Tugas Akhir</th>
                                <td><?=$seminarhasil->nama_judul?></td>
                            </tr>
                            </tr>
                                <th>Abstrak</th>
                                <td><?=$seminarhasil->abstrak?></td>
                            </tr>
                            <tr>
                                <th>Jadwal Ujian</th>
                                <td><?=date('d M Y', round($seminarhasil->jadwal_semhas/1000))?></td>
                            </tr>
                            <tr>
                                <th>Ruangan Ujian</th>
                                <td><?=$seminarhasil->ruang_semhas?></td>
                            </tr>
                            <tr>
                                <th>Waktu Ujian</th>
                                <td><?=date('H:i', round($seminarhasil->jam_mulai/1000))?> WIB</td>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <td><?=date('H:i', round($seminarhasil->jam_selesai/1000))?> WIB</td></td>
                            </tr>
                            <tr>
                                <th>Status Ajuan</th>
                                <td><?=$seminarhasil->status_ajuan?></td>
                            </tr>
                            <tr>
                                <th>Status Hasil</th>
                                <td><?=$seminarhasil->status_sh?></td>
                            </tr>
                            </tr>
                                <th>Catatan</th>
                                <td><?=$seminarhasil->catatan?></td>
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
                                <h5>Proposal Tugas Akhir</h5>
                                <p>
                                    <?php if($seminarhasil->proposal_seminarhasil == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a href="<?= base_url('simta/seminarhasil/download_proposal_seminarhasil/' . $seminarhasil->id_seminarhasil); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <h5>Persetujuan Dosen Pembimbing</h5>
                                <p>
                                    <?php if($seminarhasil->persetujuan_dosen == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a
                                        href="<?= base_url('simta/seminarhasil/download_persetujuan_dosen/' . $seminarhasil->id_seminarhasil); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <h5>Berita Acara</h5>
                                <p>
                                    <?php if($seminarhasil->berita_acara == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a
                                        href="<?= base_url('simta/seminarhasil/download_berita_acara/' . $seminarhasil->id_seminarhasil); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <h5>Revisi Proposal</h5>
                                <p>
                                    <?php if($seminarhasil->revisi_proposal == null) : ?>
                                    <span class="badge badge-primary text-uppercase">belum diupload</span>
                                    <?php else : ?>
                                    <a
                                        href="<?= base_url('simta/seminarhasil/download_revisi_proposal/' . $seminarhasil->id_seminarhasil); ?>">Download</a>
                                    <?php endif; ?>
                                </p>
                                <a href="<?=base_url('simta/seminarhasil');?>" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </div>
                    </table>
                    </div>
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div>
    </div>
</div> 
</div> <!-- end section -->
</div> <!-- .col-12 -->
</div> <!-- .row -->
</div> <!-- .container-fluid -->
</main>

<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
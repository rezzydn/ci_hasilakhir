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
                        <tbody>
                        <table class="table">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td><?php foreach($mahasiswa as $mhs) {
                                echo ($seminarhasil->id_mhs == $mhs->id_mhs) ? $mhs->nama : ''; } ?></td>
                            </tr>
                            <tr>    
                                <th>Nama Dosen Pembimbing</th>
                                <td><?php foreach($staf as $s) {
                                    echo ($seminarhasil->id_staf == $s->id_staf) ? $s->nama : ''; } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>NIM</th>
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
                                <th>Nama Judul Tugas Akhir</th>
                                <td><?=$seminarhasil->nama_judul?></td>
                            </tr>
                            </tr>
                                <th>Abstrak</th>
                                <td><?=$seminarhasil->abstrak?></td>
                            </tr>
                            </tr>
                                <th>Ruang Ujian</th>
                                <td><?=$seminarhasil->ruang_semhas?></td>
                            </tr>
                            </tr>
                                <th>Jadwal Ujian</th>
                                <td><?=$seminarhasil->jadwal_semhas?></td>
                            </tr>
                        </table>
                        <a href="<?=base_url('simta/seminarhasil');?>" class="btn btn-warning">Kembali</a>    
                        </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>

<?php echo $this->include('simta/simta_partial/dashboard/footer'); ?>
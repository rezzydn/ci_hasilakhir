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
                            </tr>
                                <th>Abstrak</th>
                                <td><?=$ujianproposal->abstrak?></td>
                            </tr>
                            </tr>
                                <th>Jadwal Ujian</th>
                                <td><?=$ujianproposal->tanggal?></td>
                            </tr>
                            </tr>
                                <th>Ruangan Ujian</th>
                                <td><?=$ujianproposal->ruang_sempro?></td>
                            </tr>
                            </tr>
                                <th>Status Ajuan</th>
                                <td><?=$ujianproposal->status_ajuan?></td>
                            </tr>
                            </tr>
                                <th>Status Hasil</th>
                                <td><?=$ujianproposal->status_up?></td>
                            </tr>
                            </tr>
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
                                                <th>Action</th>
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
                                            </tr>
                                            <?php endforeach?>
                                        </tbody>
                                </table>
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
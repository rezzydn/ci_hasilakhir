<!-- app/Views/simta_hasilakhir/index.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Simta Hasilakhir - Index</title>
</head>
<body>
    <h1>Simta Hasilakhir - Index</h1>

    <a href="/simta_hasilakhir/create">Create New</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ujian Proposal</th>
                <th>Seminar Hasil</th>
                <th>Ujian TA</th>
                <th>Mahasiswa</th>
                <th>Staf</th>
                <th>Hasil Akhir</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasilakhirs as $hasilakhir): ?>
                <tr>
                    <td><?= $hasilakhir['id_hasilakhir'] ?></td>
                    <td><?= $hasilakhir['id_ujianproposal'] ?></td>
                    <td><?= $hasilakhir['id_seminarhasil'] ?></td>
                    <td><?= $hasilakhir['id_ujianta'] ?></td>
                    <td><?= $hasilakhir['id_mhs'] ?></td>
                    <td><?= $hasilakhir['id_staf'] ?></td>
                    <td><?= $hasilakhir['hasil_akhir'] ?></td>
                    <td><?= $hasilakhir['created_at'] ?></td>
                    <td><?= $hasilakhir['updated_at'] ?></td>
                    <td>
                        <a href="/hasilakhir/edit/<?= $hasilakhir['id_hasilakhir'] ?>">Edit</a>
                        <a href="/hasilakhir/delete/<?= $hasilakhir['id_hasilakhir'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

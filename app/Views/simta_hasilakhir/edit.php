<!-- app/Views/simta_hasilakhir/edit.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Simta Hasilakhir - Edit</title>
</head>
<body>
    <h1>Simta Hasilakhir - Edit</h1>

    <form action="/simta_hasilakhir/update/<?= $hasilakhir['id_hasilakhir']; ?>" method="post">
        <label for="id_ujianproposal">ID Ujian Proposal:</label>
        <input type="text" name="id_ujianproposal" id="id_ujianproposal" value="<?= $hasilakhir['id_ujianproposal']; ?>" required><br>

        <label for="id_seminarhasil">ID Seminar Hasil:</label>
        <input type="text" name="id_seminarhasil" id="id_seminarhasil" value="<?= $hasilakhir['id_seminarhasil']; ?>" required><br>

        <label for="id_ujianta">ID Ujian TA:</label>
        <input type="text" name="id_ujianta" id="id_ujianta" value="<?= $hasilakhir['id_ujianta']; ?>" required><br>

        <label for="id_mhs">ID Mahasiswa:</label>
        <input type="text" name="id_mhs" id="id_mhs" value="<?= $hasilakhir['id_mhs']; ?>" required><br>

        <label for="id_staf">ID Staf:</label>
        <input type="text" name="id_staf" id="id_staf" value="<?= $hasilakhir['id_staf']; ?>" required><br>

        <label for="hasil_akhir">Hasil Akhir:</label>
        <input type="text" name="hasil_akhir" id="hasil_akhir" value="<?= $hasilakhir['hasil_akhir']; ?>" required><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

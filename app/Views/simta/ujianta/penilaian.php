<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Abstrak</th>
            <th>Ruangan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        foreach ($ujianta as $values) {
        ?>
            <tr> 
                <td><?php echo $nomor ?></td>
                <td><?php echo $values['nama_judul'] ?></td>
                <td><?php echo $values['abstrak'] ?></td>
                <td><?php echo $values['nama_judul'] ?></td>
                <td><?php echo $values['abstrak'] ?></td>
        }
    </tbody>
</table>
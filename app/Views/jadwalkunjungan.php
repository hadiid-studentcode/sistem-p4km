<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2></h2>

    <h1>Jadwal Kunjungan</h1>

    <h2>Buat Jadwal Baru</h2>

    <form action="<?= base_url('/jadwalkunjungan') ?>" method="post">
        <?= csrf_field() ?>
        <label for="tanggalKunjungan">Tanggal Kunjungan:</label>
        <input type="date" name="tanggalKunjungan" id="tanggalKunjungan" required> <br>

        <label for="lokasiKunjungan">Lokasi Kunjungan:</label>
        <input type="text" name="lokasiKunjungan" id="lokasiKunjungan" placeholder="Contoh: SMP Harapan Bangsa" required> <br>

        <label for="p4km">Staf P4KM Ditugaskan</label>
        <select name="p4km_id" id="p4km_id">

            <option value="">Pilih Staf P4KM</option>

            <?php foreach ($user_p4km as $p4km) : ?>
                <option value="<?= $p4km['id'] ?>"><?= $p4km['nama_lengkap'] ?></option>
            <?php endforeach; ?>

        </select> <br>

        <label for="agenda">Agenda Kunjungan:</label>
        <textarea name="agenda" id="agenda" placeholder="Jelaskan agenda atau tujuan kunjungan"></textarea> <br>

        <button type="submit">Buat Jadwal</button>
    </form>


    <h2>Daftar Jadwal Kunjungan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi Kunjungan</th>
                <th>Tanggal Kunjungan</th>
                <th>Staf P4KM Ditugaskan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($jadwalKunjungan as $jk) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $jk['lokasi_kunjungan'] ?></td>
                    <td><?= $jk['tanggal_kunjungan'] ?></td>
                    <td><?= $jk['nama_p4km'] ?></td>
                    <td><?= $jk['status'] ?></td>
                    <td>
                        <a href="detail">Detail</a>
                        <a href="edit/<?= $jk['id'] ?>">Edit</a>
                        <form action="<?= base_url('/jadwalkunjungan/' . $jk['id']) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>


            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>
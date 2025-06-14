    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>Laporan Pembinaan</h1>

        <h2>Data Laporan</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi Pembinaan</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Status Kunjungan</th>
                    <th>Status Laporan</th>
                    <th>Aksi</th>
                   
                </tr>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($laporanPembinaanByP4km as $laporan): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $laporan['lokasi_kunjungan'] ?></td>
                    <td><?= $laporan['tanggal_kunjungan'] ?></td>
                    <td><?= $laporan['status'] ?></td>
                    <td><?= $laporan['status_laporan'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
            </thead>
        </table>
    </body>

    </html>
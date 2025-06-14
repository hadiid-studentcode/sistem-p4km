<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Halaman Dashboard</h1>

    <p>Selamat datang, <?= session()->get('username') ?></p>
    <p>role = <?= session()->get('role') ?></p>

    <a href="<?= base_url('logout') ?>">Logout</a>
</body>

</html>
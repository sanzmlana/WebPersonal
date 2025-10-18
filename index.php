<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href ="style.css">
    <script src="interaksi.js" defer></script>
</head>

<body>
    <div class="container">
        <h1>Form Data Mahasiswa</h1>

        <?php
        // tampilkan pesan status dari proses.php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status === 'success') {
                echo '<div class="alert success">Data berhasil disimpan.</div>';
            } elseif ($status === 'missing') {
                echo '<div class="alert error">Form belum lengkap. Semua field wajib diisi.</div>';
            } elseif ($status === 'invalid_email') {
                echo '<div class="alert error">Format email tidak valid.</div>';
            } elseif ($status === 'error') {
                $msg = isset($_GET['message']) ? urldecode($_GET['message']) : 'Terjadi kesalahan.';
                echo '<div class="alert error">Error: ' . htmlspecialchars($msg) . '</div>';
            }
        }
        ?>

        <form action="proses.php" method="POST" autocomplete="off">
            <div class="row">
                <div>
                    <label for="npm">NPM</label>
                    <input id="npm" type="text" name="npm" required>
                </div>
                <div>
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" name="nama" required>
                </div>
            </div>

            <label for="jurusan">Jurusan</label>
            <input id="jurusan" type="text" name="jurusan" required>

            <div class="row">
                <div>
                    <label for="angkatan">Angkatan</label>
                    <input id="angkatan" type="text" name="angkatan" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
            </div>

            <input type="submit" value="Kirim">
            <p class="small">Pastikan semua data terisi dengan benar sebelum mengirim.</p>
        </form>
    </div>
</body>
</html>
<?php
// koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mahasiswa";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
	die("Koneksi gagal: " . mysqli_connect_error());
}

// Hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: index.php');
	exit;
}

$npm = isset($_POST['npm']) ? trim($_POST['npm']) : '';
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$jurusan = isset($_POST['jurusan']) ? trim($_POST['jurusan']) : '';
$angkatan = isset($_POST['angkatan']) ? trim($_POST['angkatan']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// validasi sederhana
if ($npm === '' || $nama === '' || $jurusan === '' || $angkatan === '' || $email === '') {
	header('Location: index.php?status=missing');
	exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header('Location: index.php?status=invalid_email');
	exit;
}

// prepared statement untuk mencegah SQL injection
$sql = "INSERT INTO tb_mahasiswa (npm, nama, jurusan, angkatan, email) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
	mysqli_stmt_bind_param($stmt, 'sssss', $npm, $nama, $jurusan, $angkatan, $email);
	if (mysqli_stmt_execute($stmt)) {
		mysqli_stmt_close($stmt);
		header('Location: index.php?status=success');
		exit;
	} else {
		$err = mysqli_stmt_error($stmt);
		mysqli_stmt_close($stmt);
		header('Location: index.php?status=error&message=' . urlencode($err));
		exit;
	}
} else {
	$err = mysqli_error($conn);
	header('Location: index.php?status=error&message=' . urlencode($err));
	exit;
}

mysqli_close($conn);
?>

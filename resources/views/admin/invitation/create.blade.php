<!DOCTYPE html>
<html>
<head>
    <title>Form Undangan</title>
</head>
<body>

<h2>Form Tambah Undangan</h2>

<form action="/invite" method="POST">
    @csrf

    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Jumlah Hadir:</label><br>
    <input type="number" name="jml_hadir" required><br><br>

    <label>Pesan:</label><br>
    <textarea name="message"></textarea><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>


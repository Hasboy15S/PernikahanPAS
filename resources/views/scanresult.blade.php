<!DOCTYPE html>
<html>
<head>
    <title>Presensi Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            text-align: center;
        }
        .box {
            padding: 30px;
            border-radius: 15px;
            background: #f3f3f3;
            display: inline-block;
        }
        h2 { color: green; }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #333;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>{{ $title }}</h2>
    <p>{{ $message }}</p>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Bergabung!</title>
</head>
<body>
    <h1>Selamat Bergabung di Aplikasi Kami, {{ $user->name }}!</h1>
    <p>Terima kasih telah mendaftar di aplikasi kami. Berikut adalah informasi akun Anda:</p>
    <table>
        <tr>
            <th>Nama:</th>
            <td>{{ $user->name }} {{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Tanggal Pendaftaran:</th>
            <td>{{ $user->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>
    <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
</body>
</html>

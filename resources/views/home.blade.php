<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }}</title>
</head>
<body>
    <h1>Selamat Datang di {{ $siteName }}</h1>
    <h2>Kursus Pilihan</h2>

    @foreach ($featured as $course)
        <div>
            <h3>{{ $course['name'] }}</h3>
            <p>Kode: {{ $course['code'] }}</p>
            <p>{{ $course['description'] }}</p>
        </div>
        <hr>
    @endforeach
</body>
</html>
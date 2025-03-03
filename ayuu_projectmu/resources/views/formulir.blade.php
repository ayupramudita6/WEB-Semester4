<!DOCTYPE html>
<html>
<head>
    <title>Request dengan Input Laravel</title>
</head>
<body>

    <form action="/formulir/proses" method="post">
        @csrf

        Nama : <input type="text" name="nama"><br/>
        Alamat : <input type="text" name="alamat"><br/>
        <input type="submit" value="Simpan">

    </form>

</body>
</html>

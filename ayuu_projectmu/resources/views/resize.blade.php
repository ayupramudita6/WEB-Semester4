<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload File Dengan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-5">Upload File Dengan Laravel</h2>

        <div class="col-lg-8 mx-auto my-5">
            {{-- Pesan Jika Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Peringatan Jika Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validasi Error --}}
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                    @endforeach
                </div>
            @endif

            {{-- Form Upload --}}
            <form action="{{ route('upload.resize') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <b>File Gambar</b><br/>
                    <input type="file" name="file" class="form-control">
                </div>

                <div class="form-group">
                    <b>Keterangan</b>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>

                <input type="submit" value="Upload" class="btn btn-primary">
            </form>
        </div>
    </div>

    <script>
        // Auto-hide alert setelah beberapa detik
        $(document).ready(function(){
            setTimeout(function(){
                $(".alert").fadeOut("slow");
            }, 5000); // 5 detik
        });
    </script>

</body>
</html>

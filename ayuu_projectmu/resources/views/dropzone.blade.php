<!DOCTYPE html>
<html>
<head>
    <title>Dropzone Image Upload in Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-center">Dropzone Image Upload in Laravel</h1>
                <br>

                <!-- Form Dropzone -->
                <form action="{{ route('dropzone.store') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="image-upload">
                    @csrf
                </form>

                <!-- Tombol untuk mulai upload -->
                <button type="button" id="submit-all" class="btn btn-primary btn-block" style="margin-top: 20px;">Upload Semua Gambar</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Konfigurasi Dropzone
        Dropzone.options.imageUpload = {
            maxFilesize: 2, // Maksimum ukuran file 2MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            autoProcessQueue: false, // Tidak langsung upload saat pilih file
            parallelUploads: 10, // Maksimal upload bersamaan
            dictDefaultMessage: "Seret gambar ke sini untuk mengunggah atau klik untuk memilih.",

            init: function () {
                var myDropzone = this;

                // Event tombol upload diklik
                document.getElementById("submit-all").addEventListener("click", function (e) {
                    e.preventDefault();
                    myDropzone.processQueue(); // Mulai upload semua file
                });

                // Event tambahan saat mengirim
                this.on("sending", function (file, xhr, formData) {
                    // Ambil semua data form dan tambahkan ke formData
                    var data = $('#image-upload').serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                // Jika sukses upload
                this.on("success", function (file, response) {
                    console.log('Sukses upload: ', response);
                });

                // Jika terjadi error
                this.on("error", function (file, response) {
                    console.error('Error upload: ', response);
                });
            }
        };
    </script>

</body>
</html>
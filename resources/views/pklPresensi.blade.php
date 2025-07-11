<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Presensi {{ App\Models\Setting::first()->schoolName }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/ion-rangeslider/css/ion.rangeSlider.min.css">

    <style>
        .form-check-input {
            background-color: var(--bs-warning)
        }

        .form-check-input:checked {
            background-color: var(--bs-success)
        }
    </style>
    @livewireStyles
</head>

<body class="bg-dark">
    <div class="container-fluid !align !spacing p-5">
        <div class="card my-3">
            <div class="card-header" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">

            </div>
            <div class="card-body">
                <h1>E-Presensi Praktik Kerja Lapangan <br> {{ App\Models\Setting::first()->schoolName }}</h1>
                Apliksi Absensi Online Yang di Buat Untuk Tim Tata Tatip
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('sudah'))
            <div class="card my-3">
                <div class="card-header" style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);">

                </div>
                <div class="card-body text-success">
                    <h1>Selamat</h1>
                    Presensi PKL Berhasil Di Simpan
                </div>
            </div>
        @else
            <form action="{{ route('PKL.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <livewire:presensi-p-k-l />

            </form>
        @endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tiny.cloud/1/ygg32mq7me0155xy215vzjww4ioexiryi4vw8vdnai1ptqyb/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ url('/') }}/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImg');
            const previewContainer = document.getElementById('imagePreview');
            const errorDiv = document.getElementById('fileError');
            if (file) {
                if (!file.type.startsWith('image/')) {
                    errorDiv.textContent = 'Hanya file gambar yang diperbolehkan.';
                    errorDiv.style.display = 'block';
                    previewContainer.style.display = 'none';
                    preview.src = '#';
                    event.target.value = '';
                    return;
                }
                errorDiv.style.display = 'none';
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                errorDiv.style.display = 'none';
                preview.src = '#';
            }
        }
    </script>
    <script>
        function set() {
            tinymce.init({
                selector: 'textarea#tugasGuru',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                menubar: false,
                image_title: true,
                /* enable automatic uploads of images represented by blob or data URIs*/
                automatic_uploads: true,
                /*
                URL of our upload handler (for more details check:
                https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                images_upload_url: 'postAcceptor.php',
                here we add custom filepicker only to Image dialog
                */
                file_picker_types: 'image',
                /* and here's our custom image picker*/
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    /*
                    Note: In modern browsers input[type="file"] is functional without
                    even adding it to the DOM, but that might not be the case in some older
                    or quirky browsers like IE, so you might want to add it to the DOM
                    just in case, and visually hide it. And do not forget do remove it
                    once you do not need it anymore.
                    */

                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function() {
                            /*
                            Note: Now we need to register the blob in TinyMCEs image blob
                            registry. In the next release this part hopefully won't be
                            necessary, as we are looking to handle it internally.
                            */
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            /* call the callback and populate the Title field with the file name */
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
            });
        }
        $("#range_jam").ionRangeSlider({
            type: "double",
            skin: "round",
            min: 1,
            max: 10,
            from: 1,
            to: 2,
            grid: true,
            grid_num: 10,
            onStart: (data) => {
                $("#JamKe1").prop("checked", true);
                $("#JamKe2").prop("checked", true);
            },
            onChange: function(data) {
                // Called every time handle position is changed
                $(".cb-jam").prop("checked", false)
                for (let i = 0; i <= data.to; i++) {
                    if (i >= data.from) {
                        $("#JamKe" + i).prop("checked", true);
                    }
                }

            },
        });

        let my_range = $("#range_jam").data("ionRangeSlider");
        let startRange = 0;
        let lastRange = [];
        let finisRange = 0;
        $(".cb-jam").click(() => {
            lastRange = [];
            $(".cb-jam").each((index, element) => {
                if (element.checked) {
                    lastRange.push(element.value)
                }

            });
            startRange = Math.min(...lastRange);
            finisRange = Math.max(...lastRange);
            my_range.update({
                from: startRange,
                to: finisRange,
            })
        });
    </script>
    @livewireScripts
</body>

</html>

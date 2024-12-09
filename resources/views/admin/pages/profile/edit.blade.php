@extends('admin.layouts.app')
@section('content')
@push('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        a {
            color: inherit;
            text-decoration: inherit;
        }
        .h1 {
            letter-spacing: -0.02em;
        }

        h2{
            font-size: inherit;
        }
        .dropzone {
            overflow-y: auto;
            border: 0;
            background: transparent;
        }
        .dz-preview {
            width: 100%;
            margin: 0 !important;
            height: 100%;
            padding: 15px;
            position: absolute !important;
            top: 0;
        }
        .dz-photo {
            height: 100%;
            width: 100%;
            overflow: hidden;
            border-radius: 12px;
            background: #eae7e2;
        }
        .dz-drag-hover .dropzone-drag-area {
            border-style: solid;
            border-color: #86b7fe;;
        }
        .dz-thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .dz-image {
            width: 90px !important;
            height: 90px !important;
            border-radius: 6px !important;
        }
        .dz-remove {
            display: none !important;
        }
        .dz-delete {
            width: 24px;
            height: 24px;
            background: rgba(0, 0, 0, 0.57);
            position: absolute;
            opacity: 0;
            transition: all 0.2s ease;
            top: 30px;
            right: 30px;
            border-radius: 100px;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dz-delete > svg {
            transform: scale(0.75);
            cursor: pointer;
        }
        .dz-preview:hover .dz-delete, 
        .dz-preview:hover .dz-remove-image {
            opacity: 1;
        }
        .dz-message {
            height: 100%;
            margin: 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dropzone-drag-area {
            height: 300px;
            position: relative;
            padding: 0 !important;
            border-radius: 10px;
            border: 3px dashed #dbdeea;
        }
        .was-validated .form-control:valid {
            border-color: #dee2e6 !important;
            background-image: none;
        }
    </style>
@endpush

<div class="panel">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light">Information</h5>
    </div>
    <div class="mb-5">
        <form class="space-y-5 flex flex-col" action="{{ route('admin.profile.update') }}" id="formDropzone" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" placeholder="Enter Name" class="form-input" />
                </div>
                <div>
                    <label for="job_position">Pekerjaan</label>
                    <input id="job_position" name="job_position" type="text" value="{{ auth()->user()->job_position }}" placeholder="Masukan Pekerjaan" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" placeholder="Enter Email" class="form-input" />
                </div>
                <div>
                    <label for="born_date">Tanggal Lahir</label>
                    <input id="born_date" name="born_date" type="datetime-local" value="{{ auth()->user()->born_date }}" placeholder="Masukan Tanggal" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="Phone">Phone</label>
                    <input id="Phone" name="phone" type="text" placeholder="08xxxxxx" value="{{ auth()->user()->phone }}" class="form-input" />
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <input
                        id="alamat"
                        name="address"
                        type="text"
                        placeholder="Enter Address"
                        class="form-input"
                        value="{{ auth()->user()->address }}"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="form-group mb-4">
                    <label class="form-label text-muted opacity-75 fw-medium" for="formImage">Image</label>
                    <div class="dropzone-drag-area form-control" id="previews">
                        <div class="dz-message text-muted opacity-50" data-dz-message>
                            <span>Drag file here to upload</span>
                        </div>    
                        <div class="d-none" id="dzPreviewContainer">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-photo">
                                    <img class="dz-thumbnail" data-dz-thumbnail>
                                </div>
                                <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="invalid-feedback fw-bold">Please upload an image.</div>
                </div>
                <div>
                    <label class="form-label text-muted opacity-75 fw-medium" for="formImage">Gambar Lama</label>
                    <div style="border-radius: 2%; height: 300px; overflow: hidden; border: 3px dashed #dbdeea;">
                        <img src="{{ auth()->user()->photo }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                </div>
            </div>
            <button type="submit" id="formSubmit" class="btn btn-primary !mt-6" style="max-width: fit-content;">
                
                <span class="spinner-border spinner-border-sm d-none me-2" aria-hidden="true"></span>Submit</button>
        </form>
    </div>
</div>

<div class="panel mt-5">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light">Security</h5>
    </div>
    <div class="mb-5">
        <form class="space-y-5" method="post" action="{{ route('admin.profile.reset') }}" id="reset-password">
            @csrf
            <div>
                <label for="Password">Password Lama</label>
                <input id="Password" required name="password" type="password" placeholder="Masukan Password" class="form-input" />
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="password_new">Password Baru</label>
                    <input id="password_new" required name="password_new" type="password" placeholder="Masukan Password Baru" class="form-input" />
                </div>
                <div>
                    <label for="password_new_conf">Konfirmasi Password Baru</label>
                    <input id="password_new_conf" required name="password_new_conf" type="password" placeholder="Masukan Konfirmasi Password" class="form-input" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary !mt-6">Submit</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')
     <!-- Scripts -->
     <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
     <script>
         Dropzone.autoDiscover = false;

         /**
          * Setup dropzone
          */
         $('#formDropzone').dropzone({
             previewTemplate: $('#dzPreviewContainer').html(),
             url: "{{ route('admin.profile.update') }}",
             addRemoveLinks: false,
             autoProcessQueue: false,       
             uploadMultiple: false,
             parallelUploads: 1,
             maxFiles: 1,
             acceptedFiles: '.jpeg, .jpg, .png, .gif',
             thumbnailWidth: 900,
             thumbnailHeight: 600,
             previewsContainer: "#previews",
             timeout: 0,
             init: function() 
             {
                myDropzone = this;

                var mockFile = { name: "{{ auth()->user()->name }}", size: 12345 };
                 this.on('addedfile', function(file) { 
                     $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
                 });

             },
             success: function(file, response) 
             {
                 $('.spinner-border').addClass('d-none');
                new window.Swal({
                    title: 'Data Berhasil disimpan',
                    padding: '2em',
                }).then(value => {
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                });

             }, 
             error: function(file, response){
        
                new window.Swal({
                    icon: 'question',
                    title: 'Terjadi kesalahan',
                    text: 'Silahkan check form yang belum diisi',
                    padding: '2em',
                });
             },

         });

         /**
          * Form on submit
          */
         $('#formSubmit').on('click', function(event) {
             event.preventDefault();
             var $this = $(this);
             // show submit button spinner
             $this.children('.spinner-border').removeClass('d-none');

             if ($('#formDropzone')[0].checkValidity() === true && !myDropzone.getQueuedFiles().length) {
                $('#formDropzone').submit()
            }

             if ($('#formDropzone')[0].checkValidity() === false) {
                 event.stopPropagation(); 
                 $('#formDropzone').addClass('was-validated'); 
                 $this.children('.spinner-border').addClass('d-none');
            } else {
                myDropzone.processQueue();
            }
         });
  
         
         document.addEventListener('DOMContentLoaded', function(){
            var success = '{{ session("success") }}';
            var error = '{{ session("error") }}';
            if(success){
                var el = document.getElementById('reset-password');
                el.scrollIntoView();
                setTimeout(() => {
                    new window.Swal({
                        title: success,
                        padding: '2em',
                    });
                }, 500)
            }

            if(error){
                var el = document.getElementById('reset-password');
                el.scrollIntoView();
                setTimeout(() => {
                    new window.Swal({
                        icon: 'question',
                        title: 'Terjadi kesalahan',
                        text: error,
                        padding: '2em',
                    });
                }, 500)
                    
            }
         });
     </script>

@endpush
@extends('admin.layouts.app')

@push('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/quill.snow.css')}}" />
@endpush

@section('content')
<div class="panel">
    <form action="{{ route('service.update') }}" method="POST" id="add-service">
        @csrf
        <input type="hidden" name="id" value="{{ $service->id }}">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-xl font-semibold dark:text-white-light">Edit Service</h5>
        </div>
        <div class="mb-5">
            <div class="mb-5">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ $service->title }}" placeholder="Enter title" class="form-input" required/>
            </div>
            <div class="mb-5">
                <label for="title">Description</label>
                <textarea rows="3" class="form-input" name="description" required>{{ $service->description }}</textarea>
            </div>
            <button type="submit"class="btn btn-primary !mt-6" style="max-width: fit-content;">    
            <span class="spinner-border spinner-border-sm d-none me-2" aria-hidden="true"></span>Submit</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets-admin/js/quill.js')}}"></script>
<script>

    document.addEventListener('DOMContentLoaded', function(){
        const quillEditorAre = document.getElementById('quill-editor-area');
        if (quillEditorAre) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });
    
            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });

            editor.root.innerHTML = '{!! $service->description !!}'
        }
    });

    document.addEventListener('DOMContentLoaded', function(){
        var success = '{{ session("success") }}';
        var error = '{{ session("error") }}';
        if(success){ 
            new window.Swal({
                title: success,
                padding: '2em',
            }); 
        }

        if(error){   
            new window.Swal({
                icon: 'question',
                title: 'Terjadi kesalahan',
                text: error,
                padding: '2em',
            });
        }
    });

</script>
@endpush
@extends('admin.layouts.app')

@push('stylesheet')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush

@section('content')
    @if (session('success'))
        <div class="flex items-center p-3.5 mb-5 rounded text-success bg-success-light dark:bg-success-dark-light">
            <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>{{ session('success') }}</span>

        </div>
    @endif
    @if (session('error'))
        <div class="flex items-center p-3.5 mb-5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
            <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Danger!</strong>{{ session('error') }}</span>

        </div>
    @endif
    <div class="grid grid-cols-1 gap-6">
        <div class="mb-3 flex items-center justify-between">
            <div class="mb-3 flex items-center justify-between">
                <a href="{{ url('/company-detail') }}">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
        </div>
        <div class="panel">

            <form class="space-y-5" action="{{url('/company-detail')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vision">Vision</label>
                    <input id="vision" type="text" id="vision" name="vision" placeholder="Enter Vision" class="form-input" required />
                </div>
                <div class="mb-5">
                    <label for="mision">Mission</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                    <textarea  name="mission" rows="3" class="form-textarea hidden" id="quill-editor-area" placeholder="Enter Mission" required></textarea>
                </div>
                <div class="mt-5">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" class="form-textarea" placeholder="Enter Description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary !mt-6">Submit</button>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log(document.getElementById('quill-editor-area'));
            if (document.getElementById('quill-editor-area')) {
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
            }
        });
    </script>
@endpush

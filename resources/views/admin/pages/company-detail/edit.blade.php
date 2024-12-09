@extends('admin.layouts.app')

@push('stylesheet')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush
@section('content')
    @if (session('success'))
        <div class="text-success bg-success-light dark:bg-success-dark-light mb-5 flex items-center rounded p-3.5">
            <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>{{ session('success') }}</span>

        </div>
    @endif
    @if (session('error'))
        <div class="text-danger bg-danger-light dark:bg-danger-dark-light mb-5 flex items-center rounded p-3.5">
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

            <form class="space-y-5" action="{{ url('/company-detail', $getDetailCompany->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div>
                    <label for="vision">Vision</label>
                    <input id="vision" type="text" name="vision" value="{{ $getDetailCompany->vision }}"
                        placeholder="Enter Vision" class="form-input" />
                </div>
                <div>
                    <label for="mision">Mision</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                    <textarea name="mission" rows="3" class="form-textarea hidden" id="quill-editor-area" placeholder="Enter Mission"
                        required>
                        {!! $getDetailCompany->mission !!}
                    </textarea>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" class="form-textarea" placeholder="Enter Description">{{ $getDetailCompany->description }}
                    </textarea>
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

                editor.root.innerHTML = quillEditor.value;

            }
        });
    </script>
@endpush

@extends('admin.layouts.app')
@section('page')
    Categories
@endsection
@section('content')
    <button onclick="openCategoryModal()" class="btn btn-primary mb-5">Add Category</button>
    @include('admin.components.category.modal')
    <div class="panel" style="max-width: 1000px;">
        @if (session('success'))
            <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light mb-5">
                <span class="ltr:pr-2 rtl:pl-2"><strong
                        class="ltr:mr-1 rtl:ml-1">Success!</strong>{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light mb-5">
                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{ session('error') }}</span>
            </div>
        @endif
        <div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="w-10">No.</th>
                            <th>Name</th>
                            <th class="text-center flex justify-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                <td class="whitespace-nowrap">{{ $category->name }}</td>
                                <td class="p-3 text-center justify-center flex gap-2">
                                    <button onclick="openCategoryModal('{{ $category->slug }}')" type="button"
                                        x-tooltip="Edit" class="btn btn-warning">
                                        Edit
                                    </button>
                                    <button onclick="deleteCategory('{{ $category->name }}', '{{ $category->slug }}')"
                                        type="button" x-tooltip="Delete" class="btn btn-danger">
                                        Delete
                                    </button>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $categories->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>

    @php
        $jsonData = $categories->toArray();
    @endphp

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function openCategoryModal(slug) {
            const form = document.querySelector('#categoryModal form');
            const title = document.getElementById('categoryModalTitle');
            if (slug) {
                form.action = "{{ route('categories.update', ['slug' => ':slug']) }}".replace(':slug', slug);
                form.innerHTML += '@method('put')'
                title.innerText = 'Edit Category'

                const categories = @json($jsonData);
                const category = categories.data.find(function(category) {
                    return category.slug === slug;
                });

                document.getElementById('category_name').value = category.name;
            } else {
                title.innerText = 'Add Category'
                form.action = "{{ route('categories.store') }}";
                const inputMethod = document.querySelector('[name="_method"]');
                if(inputMethod){
                    inputMethod.remove();
                }
            }
            const modal = document.getElementById('categoryModal');
            modal.classList.add('!block');
        }

        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            modal.classList.remove('!block');
            document.getElementById('category_name').value = '';
        }

        window.onclick = function(event) {
            const categoryModal = document.getElementById('categoryModal');
            const closeCategoryModal = document.getElementById('closeCategoryModal');
            if (event.target == closeCategoryModal) {
                categoryModal.classList.remove('!block');
                document.getElementById('category_name').value = '';
            }
        }

        function deleteCategory(name, slug) {
            swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete ' + name + '?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: `
                <span>NO</span>
                `,
                confirmButtonText: 'YES',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    console.log(token)
                    $.ajax({
                        url: "{{ route('categories.destroy', ['slug' => ':slug']) }}".replace(':slug',
                            slug),
                        type: "delete",
                        data: {
                            _token: token
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            location.reload()
                        },
                        error: function(xhr, status, error) {
                            location.reload()
                        }
                    });
                }
            });
        }
    </script>
@endsection

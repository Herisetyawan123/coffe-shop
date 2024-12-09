@extends('admin.layouts.app')
@section('page')
    Products
@endsection
@section('content')
    <section class="mx-auto w-full py-8 sm:px-4 lg:px-6">
        <div class="rounded-md bg-[#000] p-4">
            {{-- Start Modal ADD product --}}
            <div x-data="modal" id="addProductModal">
                <!-- button -->
                <button class="btn btn-primary mb-4 gap-2" @click="toggle"><svg width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5"
                            d="M2.5 6.5C2.5 4.29086 4.29086 2.5 6.5 2.5C8.70914 2.5 10.5 4.29086 10.5 6.5V9.16667C10.5 9.47666 10.5 9.63165 10.4659 9.75882C10.3735 10.1039 10.1039 10.3735 9.75882 10.4659C9.63165 10.5 9.47666 10.5 9.16667 10.5H6.5C4.29086 10.5 2.5 8.70914 2.5 6.5Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path opacity="0.5"
                            d="M13.5 14.8333C13.5 14.5233 13.5 14.3683 13.5341 14.2412C13.6265 13.8961 13.8961 13.6265 14.2412 13.5341C14.3683 13.5 14.5233 13.5 14.8333 13.5H17.5C19.7091 13.5 21.5 15.2909 21.5 17.5C21.5 19.7091 19.7091 21.5 17.5 21.5C15.2909 21.5 13.5 19.7091 13.5 17.5V14.8333Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M2.5 17.5C2.5 15.2909 4.29086 13.5 6.5 13.5H8.9C9.46005 13.5 9.74008 13.5 9.95399 13.609C10.1422 13.7049 10.2951 13.8578 10.391 14.046C10.5 14.2599 10.5 14.5399 10.5 15.1V17.5C10.5 19.7091 8.70914 21.5 6.5 21.5C4.29086 21.5 2.5 19.7091 2.5 17.5Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M13.5 6.5C13.5 4.29086 15.2909 2.5 17.5 2.5C19.7091 2.5 21.5 4.29086 21.5 6.5C21.5 8.70914 19.7091 10.5 17.5 10.5H14.6429C14.5102 10.5 14.4438 10.5 14.388 10.4937C13.9244 10.4415 13.5585 10.0756 13.5063 9.61196C13.5 9.55616 13.5 9.48982 13.5 9.35714V6.5Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>Add Product</button>
                <!-- modal -->
                <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                    <div class="flex min-h-screen items-start justify-center px-4" @click.self="open = false">
                        <div x-show="open" x-transition x-transition.duration.300
                            class="panel my-8 w-full max-w-xl overflow-hidden rounded-lg border-0 px-4 py-1">
                            <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                <div class="text-lg font-bold">Add Product form</div>
                                <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-5">
                                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="relative mb-4">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" placeholder="Name" class="form-input" />
                                    </div>
                                    <div class="relative mb-4">
                                        <label for="description">Description</label>
                                        <textarea rows="4" name="description" class="form-textarea"></textarea>
                                    </div>
                                    <div class="relative mb-4">
                                        <label for="price">Price</label>
                                        <input type="number" placeholder="Price" name="price" class="form-input" />
                                    </div>
                                    <div class="relative mb-4">
                                        <label for="name">Category</label>
                                        <!-- placeholder -->
                                        <select class="selectize form-select" placeholder="Choose Category"
                                            name="category_id">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="relative mb-4">
                                        <label for="name">Image</label>
                                        <!-- placeholder -->
                                        <input type="file" name="thumbnail">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-full">Tambah Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal ADD product --}}
        </div>
    </section>
    {{-- Start Section card product --}}
    <div class="panel">
        <div class="my-5 grid w-full grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-4">
            @foreach ($products as $product)
                <div class="relative overflow-hidden rounded-md bg-white text-center shadow dark:bg-[#1c232f]">
                    <div
                        class="rounded-t-md bg-white/40 bg-[url('../images/notification-bg.png')] bg-cover bg-center p-6 pb-0">
                        <img class="mx-auto h-36 w-4/5 object-cover" src="{{ $product->thumbnail }}" />
                    </div>
                    <div class="relative px-6 pb-24">
                        <div class="rounded-md bg-white px-2 py-4 shadow-md dark:bg-gray-900">
                            <div class="text-xl">{{ $product->name }}</div>
                            <div class="text-white-dark">{{ $product->category->name }}</div>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-4 ltr:text-left rtl:text-right">
                            <div class="flex items-center">
                                <div class="text-white-dark">
                                    {{ $product->description }}</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">Harga :</div>
                                <div class="text-white-dark">Rp. {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 mt-6 flex w-full justify-center gap-4 p-6 ltr:left-0 rtl:right-0">
                        <x-product.modal.formedit :action="route('product.update', $product->slug)" :name="$product->name" :description="$product->description" :price="$product->price"
                            :categories=$categories :thumbnail="$product->thumbnail" :products=$product />
                        <x-product.buttons.delete :action="route('product.destroy', $product->id)" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- End Card Product --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sessionSuccess = '{{ session('success') }}'
            if (sessionSuccess) {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    animation: false,
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: `color-success`
                    },
                });
                toast.fire({
                    title: sessionSuccess,
                });
            }

            const sessionError = '{{ session('error') }}'
            if (sessionError) {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    animation: false,
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: `color-danger`
                    },
                });
                toast.fire({
                    title: sessionError,
                });
            }
        })
    </script>
@endpush

@extends('admin.layouts.app')
@section('page')
    Transactions
@endsection
@section('content')
    <script src="//cdn.jsdelivr.net/npm/alpinejs" defer></script>
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
                                <div class="text-white-dark">{{ $product->description }}</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-none ltr:mr-2 rtl:ml-2">Harga :</div>
                                <div class="text-white-dark">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 mt-6 flex w-full justify-center gap-4 p-6 ltr:left-0 rtl:right-0">
                        <!-- Button Beli -->
                        <button class="btn btn-primary"
                            onclick="openModal('{{ $product->name }}', '{{ $product->price }}')">
                            Beli
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- End Card Product --}}

    <!-- Modal -->
    <div id="buyModal" class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-xl font-bold mb-4">Form Pembelian</h2>
            <form id="buyForm" method="POST" action="{{ route('transaction.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="productName" class="block">Nama Produk</label>
                    <input type="text" id="productName" name="product_name" class="form-input w-full" readonly />
                </div>
                <div class="mb-4">
                    <label for="buyerName" class="block">Nama Pemesan</label>
                    <input type="text" id="buyerName" name="buyer_name" class="form-input w-full"
                        placeholder="Nama Pemesan" />
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block">Jumlah</label>
                    <input type="number" id="quantity" name="quantity" class="form-input w-full" value="1"
                        min="1" oninput="updateTotal()" />
                </div>
                <div class="mb-4">
                    <label for="total" class="block">Total Harga</label>
                    <input type="text" id="total" name="total" class="form-input w-full" readonly />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Fungsi untuk membuka modal dan mengisi data produk
        function openModal(productName, productPrice) {
            const modal = document.getElementById('buyModal');
            modal.classList.remove('hidden');

            // Isi data ke form
            document.getElementById('productName').value = productName;
            document.getElementById('quantity').value = 1;
            document.getElementById('total').value = productPrice;

            // Simpan harga produk ke atribut elemen
            document.getElementById('quantity').setAttribute('data-price', productPrice);
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('buyModal');
            modal.classList.add('hidden');
        }

        // Fungsi untuk memperbarui total harga berdasarkan jumlah
        function updateTotal() {
            const quantity = document.getElementById('quantity').value;
            const price = document.getElementById('quantity').getAttribute('data-price');
            const total = document.getElementById('total');

            total.value = quantity * price;
        }
    </script>
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

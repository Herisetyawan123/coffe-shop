@props([
    'action',
    'name',
    'description',
    'price',
    'categories',
    'thumbnail',
    'buttonText',
    'products' => __('Update'),
])

<div x-data="{ initial: true, open: false }" class="">
    <button x-on:click.prevent="open = true; initial = true" x-show="initial" x-on:open.window="$el.disabled = true"
        x-transition:enter="transition duration-150" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" class="btn btn-warning rounded">
        Update
    </button>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300
                class="panel my-8 w-full max-w-xl overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-1 dark:bg-[#121c2c]">
                    <div class="text-lg font-bold">Update Product Form</div>
                    <button x-on:click.prevent="open = false; setTimeout(() => { initial = true }, 150)"
                        x-on:open.window="$el.disabled = true" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="px-5 py-2">
                    <div class="px-5 py-2">
                        <form method="POST" action="{{ $action }}" enctype="multipart/form-data"
                            class="text-left">
                            @csrf
                            @method('PUT')

                            <div class="relative mb-4">
                                <label for="name" Product> Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-input"
                                    value="{{ $name }}" />
                            </div>
                            <div class="relative mb-4">
                                <label for="description">Description</label>
                                <textarea rows="4" name="description" class="form-textarea">{{ $description }}</textarea>
                            </div>
                            <div class="relative mb-4">
                                <label for="price">Price</label>
                                <input type="number" placeholder="Price" name="price" class="form-input"
                                    value="{{ $price }}" />
                            </div>
                            <div class="relative mb-4">
                                <label for="name">Category</label>
                                <!-- placeholder -->
                                <select class="selectize form-select" placeholder="Choose Category" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $products->category->id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="relative mb-4">
                                <label for="name">Image</label>
                                <!-- placeholder -->
                                <input type="file" name="thumbnail" id="imgInput" value="{{ $thumbnail }}">
                            </div>
                            <div class="relative mb-4">
                                <img id="imgPreview" class="max-h-10 w-[50%] object-cover" src="{{ $thumbnail }}"
                                    height="170px" width="100" />
                            </div>
                            <button x-on:click="$el.form.submit()" x-on:open.window="$el.disabled = true" type="submit"
                                class="btn btn-primary mb-3 w-full">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgPreview').src = e.target.result
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Menangani peristiwa ketika file dipilih
    document.getElementById('imgInput').addEventListener('change', function() {
        previewImage(this);
    });
</script>

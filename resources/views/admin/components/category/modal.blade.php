<div id="categoryModal" class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto">
    <div id="closeCategoryModal" class="flex items-start justify-center min-h-screen px-4">
        <div class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg">
            <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                <div id="categoryModalTitle" class="font-bold text-lg">...</div>
                <button onclick="closeCategoryModal()" type="button" class="text-white-dark hover:text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="h-6 w-6">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="p-5">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        <label for="category_name" class="form-label">Name</label>
                        <input type="text" name="name" id="category_name" class="form-input" required>
                    </div>
                    <div class="flex justify-end items-center mt-8">
                        <button onclick="closeCategoryModal()" type="button"
                            class="btn btn-outline-danger">Discard</button>
                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

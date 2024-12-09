@props(['action', 'phone_number', 'Phone' => __('Update')])

<div x-data="{ initial: true, open: false }" class="">
    <button x-on:click.prevent="open = true; initial = true" x-show="initial" x-on:open.window="$el.disabled = true"
        x-transition:enter="transition duration-150" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" class="btn btn-warning rounded">
        {{ $Phone }}
    </button>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300
                class="panel my-8 w-full max-w-xl overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                    <div class="text-lg font-bold">Update Phone Number Form</div>
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
                        <form method="POST" action="{{ $action }}" class="text-left">
                            @csrf
                            @method('PUT')

                            <div class="relative mb-4">
                                <label for="name" Product> Name</label>
                                <input type="text" name="phone" placeholder="+628123" class="form-input"
                                    value="{{ $phone_number }}" />
                            </div>
                            <button x-on:click="$el.form.submit()" x-on:open.window="$el.disabled = true" type="submit"
                                class="btn btn-primary mb-3 w-full">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

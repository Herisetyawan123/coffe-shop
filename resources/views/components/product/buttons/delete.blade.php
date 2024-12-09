@props(['action', 'buttonText' => __('Delete')])

<div x-data="{ initial: true, open: false }" class="">
    <button x-on:click.prevent="open = true; initial = true" x-show="initial" x-on:open.window="$el.disabled = true"
        x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" class="btn btn-danger rounded">
        Delete
    </button>

    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300
                class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">

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
                <div class="p-5">
                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        <h5 class="text-lg font-bold">Are you sure to delete this product?</h5>
                    </div>
                    <form x-on:submit="$dispatch('open')" method="post" action="{{ $action }}">
                        <div class="mt-8 flex items-center justify-end gap-3">
                            @csrf
                            @method('delete')

                            <button x-on:click.prevent="open = false; setTimeout(() => { initial = true }, 150)"
                                x-on:open.window="$el.disabled = true" class="btn btn-outline-primary rounded">
                                @lang('No')
                            </button>
                            <button x-on:click="$el.form.submit()" x-on:open.window="$el.disabled = true" type="submit"
                                class="btn btn-danger rounded">
                                @lang('Yes')
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

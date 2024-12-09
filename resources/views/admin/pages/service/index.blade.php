@extends('admin.layouts.app')

@section('content')

<a href="{{ route('service.add') }}" style="display: inline-block;" class="btn btn-primary">Add Service</a>
<div class="panel mt-5" x-data="modal">
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
                @foreach ($services as $service)
                    <tr>
                        <td>{{ ($services->currentPage() - 1) * $services->perPage() + $loop->iteration }}</td>
                        <td class="whitespace-nowrap">{{ $service->title }}</td>
                        <td class="p-3 text-center justify-center flex gap-2">
                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('service.delete', $service->id) }}" method="post" x-on:submit="handleSubmit(event)">
                                @csrf
                                @method("DELETE")
                                <button
                                    type="submit" x-tooltip="Delete" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5">
            {{ $services->onEachSide(1)->links() }}
        </div>
    </div>
    <!-- vertically centered -->
    <div class="mb-5">
        <!-- modal -->
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg">
                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                        <div class="font-bold text-lg">Warning</div>
                        <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5">
                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                            <p>Apakah anda yakin menghapus data ini ?</p>
                        </div>
                        <div class="flex justify-end items-center mt-8">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">Cancel</button>
                            <button type="button" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="nextSubmit">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("modal", (initialOpenState = false) => ({
            open: initialOpenState,
            e: null,

            toggle() {
                this.open = !this.open;
            },

            handleSubmit(event){
                event.preventDefault()
                this.open = true;
                this.e = event;
            },

            nextSubmit(){
                this.open = false;
                console.log(this.e);
                this.e.target.submit();
            }
        }));
    });
</script>

<script>
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
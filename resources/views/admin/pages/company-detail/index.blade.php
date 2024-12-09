@extends('admin.layouts.app')
@section('page')
    Company Detail
@endsection
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
        <div class="mb-3 flex gap-4">
            @if ($getCompanyDetail->count() == 0)
                <a href="{{ url('/company-detail/create') }}">
                    <button class="btn btn-primary">Add Detail Company</button>
                </a>
            @endif
            @if ($getCompanyDetail->count() != 0)
                <div class="rounded-md bg-[#000] p-4">
                    {{-- Start Modal ADD phone --}}
                    <div x-data="modal">
                        <!-- button -->
                        <button class="btn btn-primary mb-4 gap-2" @click="toggle">Add Number Phone</button>
                        <!-- modal -->
                        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                            <div class="flex min-h-screen items-start justify-center px-4" @click.self="open = false">
                                <div x-show="open" x-transition x-transition.duration.300
                                    class="panel my-8 w-full max-w-xl overflow-hidden rounded-lg border-0 px-4 py-1">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                        <div class="text-lg font-bold" id="numberPhoneModalTitle">Add Number Phone form
                                        </div>
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
                                        <form method="POST" action="{{ route('phone.store') }}">
                                            @csrf

                                            <div class="relative mb-4">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" name="phone" placeholder="+628123..."
                                                    class="form-input" />
                                                <p class="text-secondary text-xs">Masukkan nomor anda tidak boleh berisi
                                                    huruf</p>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-full">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal ADD phone --}}
                </div>
            @endif

        </div>
        @if ($getCompanyDetail->isEmpty())
            <div class="panel">
                <div class="text-info bg-info-light dark:bg-info-dark-light mb-5 flex items-center rounded p-3.5">
                    <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Info!</strong>Please add data detail
                        company</span>
                </div>
            </div>
        @else
            @foreach ($getCompanyDetail as $item)
                <div class="panel mb-5">
                    <div class="mb-5" x-data="{ active: 0 }">
                        <div class="space-y-2 font-semibold">
                            <div class="rounded border border-[#d3d3d3] dark:border-[#1b2e4b]">
                                <button type="button"
                                    class="text-white-dark flex w-full items-center p-4 dark:bg-[#1b2e4b]"
                                    :class="{ '!text-primary': active === 2 }"
                                    x-on:click="active === 2 ? active = null : active = 2">
                                    Vision
                                    <div class="ltr:ml-auto rtl:mr-auto" :class="{ 'rotate-180': active === 2 }">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                                            <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-cloak x-show="active === 2" x-collapse>
                                    <div
                                        class="text-white-dark space-y-2 border-t border-[#d3d3d3] p-4 text-[13px] dark:border-[#1b2e4b]">
                                        <p>
                                            {{ $item->vision }}
                                        </p>
                                        @if ($item->vision)
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-warning mt-4">Edit
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5 ml-2 ltr:mr-2 rtl:ml-2">
                                                        <path
                                                            d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                        <path opacity="0.5"
                                                            d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-primary mt-4">Add Vision
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="h-5 w-5">
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19">
                                                        </line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="rounded border border-[#d3d3d3] dark:border-[#1b2e4b]">
                                <button type="button"
                                    class="text-white-dark flex w-full items-center p-4 dark:bg-[#1b2e4b]"
                                    :class="{ '!text-primary': active === 3 }"
                                    x-on:click="active === 3 ? active = null : active = 3">
                                    Mision
                                    <div class="ltr:ml-auto rtl:mr-auto" :class="{ 'rotate-180': active === 3 }">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                                            <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-cloak x-show="active === 3" x-collapse>
                                    <div
                                        class="text-white-dark space-y-2 border-t border-[#d3d3d3] p-4 text-[13px] dark:border-[#1b2e4b]">
                                        <div>
                                            {!! $item->mission !!}
                                        </div>
                                        @if ($item->mission)
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-warning mt-4">Edit
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5 ml-2 ltr:mr-2 rtl:ml-2">
                                                        <path
                                                            d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                        <path opacity="0.5"
                                                            d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-primary mt-4">Add Vision
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="h-5 w-5">
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19">
                                                        </line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="rounded border border-[#d3d3d3] dark:border-[#1b2e4b]">
                                <button type="button"
                                    class="text-white-dark flex w-full items-center p-4 dark:bg-[#1b2e4b]"
                                    :class="{ '!text-primary': active === 1 }"
                                    x-on:click="active === 1 ? active = null : active = 1">
                                    Description
                                    <div class="ltr:ml-auto rtl:mr-auto" :class="{ 'rotate-180': active === 1 }">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                                            <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-cloak x-show="active === 1" x-collapse>
                                    <div
                                        class="text-white-dark space-y-2 border-t border-[#d3d3d3] p-4 text-[13px] dark:border-[#1b2e4b]">
                                        <p>
                                            {{ $item->description }}
                                        </p>
                                        @if ($item->description)
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-warning mt-4">Edit
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5 ml-2 ltr:mr-2 rtl:ml-2">
                                                        <path
                                                            d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                        <path opacity="0.5"
                                                            d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                            stroke="currentColor" stroke-width="1.5"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ url('/company-detail', $item->id) }}" class="flex">
                                                <button class="btn btn-primary mt-4">Add Vision
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="h-5 w-5">
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19"></line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12"></line>
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/company-detail/delete', $item->id) }}" class="flex">
                        <button class="btn btn-danger mt-4">Delete
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="m-auto h-5 w-5">
                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                </path>
                                <path
                                    d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round"></path>
                                <path opacity="0.5"
                                    d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            @endforeach
        @endif


    </div>

    @if ($getCompanyDetail->isEmpty() == false)
        <h1 class="text-lg font-bold">Number Phone</h1>
        <div class="panel">
            <div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10">No.</th>
                                <th>Phone Number</th>
                                <th class="flex justify-center text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phoneNumber as $phone)
                                <tr>
                                    <td>{{ $loop->iteration }}
                                    </td>
                                    <td class="whitespace-nowrap">{{ $phone->phone_number }}</td>
                                    <td class="flex justify-center gap-2 p-3 text-center">
                                        <x-company.modal.phone :action="route('phone.number.update', $phone->id)" :phone_number="$phone->phone_number" />
                                        <button onclick="deletePhoneNumber('{{ $phone->id }}')" type="button"
                                            x-tooltip="Delete" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function deletePhoneNumber(id) {
            swal.fire({
                icon: 'warning',
                title: 'Confirm',
                text: "Are your sure to delete this number phone?",
                showCancelButton: true,
                cancelButtonText: `NO`,
                confirmButtonText: 'Yes',
                padding: '2em',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('phone.number.destroy', ['id' => ':id']) }}".replace(':id', id),
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

@extends('admin.layouts.master')
@push('title')
    User Management
@endpush
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <!-- start main content section -->
    <div x-data="basic">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl">User Management</h2>
            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                <div class="flex gap-3">
                    <div>
                        <a href="{{ route('admin.user.management.create') }}" class="btn btn-primary">
                            <svg  width="24"  height="24"  viewBox="0 0 24 24" fill="none"  xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                <circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path  opacity="0.5" d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z" stroke="currentColor" stroke-width="1.5" />
                                <path  d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"  />
                            </svg>
                            Add User
                        </a>
                    </div>
                    {{-- <div>
                        <button
                            type="button"
                            class="btn btn-outline-primary p-2"
                            :class="{ 'bg-primary text-white': displayType === 'list' }"
                            @click="setDisplayType('list')"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <path
                                    d="M2 5.5L3.21429 7L7.5 3"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    opacity="0.5"
                                    d="M2 12.5L3.21429 14L7.5 10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M2 19.5L3.21429 21L7.5 17"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path d="M22 19L12 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5" d="M22 12L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M22 5L12 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div> --}}
                   {{--  <div>
                        <button
                            type="button"
                            class="btn btn-outline-primary p-2"
                            :class="{ 'bg-primary text-white': displayType === 'grid' }"
                            @click="setDisplayType('grid')"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <path
                                    opacity="0.5"
                                    d="M2.5 6.5C2.5 4.61438 2.5 3.67157 3.08579 3.08579C3.67157 2.5 4.61438 2.5 6.5 2.5C8.38562 2.5 9.32843 2.5 9.91421 3.08579C10.5 3.67157 10.5 4.61438 10.5 6.5C10.5 8.38562 10.5 9.32843 9.91421 9.91421C9.32843 10.5 8.38562 10.5 6.5 10.5C4.61438 10.5 3.67157 10.5 3.08579 9.91421C2.5 9.32843 2.5 8.38562 2.5 6.5Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                                <path
                                    opacity="0.5"
                                    d="M13.5 17.5C13.5 15.6144 13.5 14.6716 14.0858 14.0858C14.6716 13.5 15.6144 13.5 17.5 13.5C19.3856 13.5 20.3284 13.5 20.9142 14.0858C21.5 14.6716 21.5 15.6144 21.5 17.5C21.5 19.3856 21.5 20.3284 20.9142 20.9142C20.3284 21.5 19.3856 21.5 17.5 21.5C15.6144 21.5 14.6716 21.5 14.0858 20.9142C13.5 20.3284 13.5 19.3856 13.5 17.5Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                                <path
                                    d="M2.5 17.5C2.5 15.6144 2.5 14.6716 3.08579 14.0858C3.67157 13.5 4.61438 13.5 6.5 13.5C8.38562 13.5 9.32843 13.5 9.91421 14.0858C10.5 14.6716 10.5 15.6144 10.5 17.5C10.5 19.3856 10.5 20.3284 9.91421 20.9142C9.32843 21.5 8.38562 21.5 6.5 21.5C4.61438 21.5 3.67157 21.5 3.08579 20.9142C2.5 20.3284 2.5 19.3856 2.5 17.5Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                                <path
                                    d="M13.5 6.5C13.5 4.61438 13.5 3.67157 14.0858 3.08579C14.6716 2.5 15.6144 2.5 17.5 2.5C19.3856 2.5 20.3284 2.5 20.9142 3.08579C21.5 3.67157 21.5 4.61438 21.5 6.5C21.5 8.38562 21.5 9.32843 20.9142 9.91421C20.3284 10.5 19.3856 10.5 17.5 10.5C15.6144 10.5 14.6716 10.5 14.0858 9.91421C13.5 9.32843 13.5 8.38562 13.5 6.5Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                />
                            </svg>
                        </button>
                    </div> --}}
                </div>

                {{-- <div class="relative">
                    <input
                        type="text"
                        placeholder="Search Contacts"
                        class="peer form-input py-2 ltr:pr-11 rtl:pl-11"
                        x-model="searchUser"
                        @keyup="searchContacts"
                    />
                    <div class="absolute top-1/2 -translate-y-1/2 peer-focus:text-primary ltr:right-[11px] rtl:left-[11px]">
                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="panel mt-6">
            <table id="myTable" class="table-hover whitespace-nowrap">
                
            </table>
        </div>
    </div>
    <!-- end main content section -->
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/simple-datatables.js') }}"></script>
    <script defer src="{{ asset('assets/js/apexcharts.js') }}"></script>
    <script>
       document.addEventListener('alpine:init', () => {
            Alpine.data('basic', () => ({
                datatable: null,
                users: [], // Will hold the current page of users
                currentPage: 1,
                lastPage: 1,
                perPage: 10,
                total: 0,

                async fetchData(page = 1,perPage=10) {
                    try {
                        const response = await fetch(`{{ route('admin.user.management.get.users') }}?page=${page}&per_page=${perPage}`);
                        const result = await response.json();

                        this.users = result.data; // Users on the current page
                        if (this.datatable) {
                            this.initializeDataTable();
                        } else {
                            this.initializeDataTable();
                        }
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                },

                initializeDataTable() {
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ['ID', 'Name', 'Profile Picture', 'Mobile No', 'Email', 'Designation', 'Department', 'Status', 'Action'],
                            data: this.getRowsData(),
                        },
                        perPage: this.perPage,
                        perPageSelect: [10, 20, 30, 50, 100],
                        firstLast: true,
                        firstText:
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                            lastText:
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                            prevText:
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                            nextText:
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                            labels: {
                                perPage: '{select}',
                            },
                            layout: {
                                top: '{search}',
                                bottom: '{info}{select}{pager}',
                            },
                        columns: [
                            {
                                select: 0,
                                render: (data) => `<strong class="text-info">#${data}</strong>`,
                            },
                            {
                                select: 1,
                                render: (data) => `<div class="font-semibold">${data}</div>`,
                            },
                            {
                                select: 2,
                                render: (data) => `<img src="${data}" class="w-9 h-9 rounded-full max-w-none" alt="user-profile" />`,
                            },
                            {
                                select: 7,
                                render: () => `
                                    <label class="relative h-6 w-12">
                                        <input type="checkbox" class="custom_switch peer absolute z-10 h-full w-full cursor-pointer opacity-0">
                                        <span class="block h-full rounded-full bg-[#ebedf2] before:absolute before:left-1 before:bottom-1 before:h-4 before:w-4 before:rounded-full before:bg-white before:transition-all before:duration-300 peer-checked:bg-primary peer-checked:before:left-7 dark:bg-dark dark:before:bg-white-dark dark:peer-checked:before:bg-white"></span>
                                    </label>`,
                            },
                            {
                                select: 8,
                                render: (data) => `
                                    <div class="flex items-center justify-center gap-4">
                                        <a href="{{ route('admin.user.management.edit.users') }}/${data}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>`,
                            },
                        ],
                    });

                    this.datatable.on('datatable.page', (page) => {
                        this.fetchData(page);
                    });

                    this.datatable.on('datatable.perpage', (perPage) => {
                        this.perPage = perPage;
                        this.fetchData(1, this.perPage);
                    });
                },

                updateDataTable() {                    
                    this.datatable.update({
                        data: {
                            headings: ['ID', 'Name', 'Profile Picture', 'Mobile No', 'Email', 'Designation', 'Department', 'Status', 'Action'],
                            data: this.getRowsData(),
                        }
                    });
                },

                getRowsData() {
                    return this.users.map((user, index) => [
                        index + 1 + (this.currentPage - 1) * this.perPage,
                        `${user.name} ${user.last_name}`,
                        user.profile_picture,
                        user.mobile_no,
                        user.email,
                        user.designation.name,
                        user.department.name,
                        user.status,
                        user.id,
                    ]);
                },

                init() {
                    this.fetchData(); // Fetch initial data
                },

            }));
        });


    </script>
@endpush
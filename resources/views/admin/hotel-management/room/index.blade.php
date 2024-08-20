@extends('admin.layouts.master')
@push('title')
    Room  List
@endpush
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <!-- start main content section -->
    <div x-data="roomList">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl">Room List</h2>
            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                <div class="flex gap-3">
                    <div>
                        <a href="{{route('admin.room.management.create')}}" class="btn btn-primary gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"  fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"class="h-5 w-5">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New Room
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel border-[#e0e6ed] px-0 dark:border-[#1b2e4b] mt-6">
            <div class="invoice-table">
                <table id="myTable" class="whitespace-nowrap"></table>
            </div>
        </div>
    </div>
    
    <!-- end main content section -->
    
</div>
@endsection
@push('script')
    <script src="{{asset('assets/js/simple-datatables.js')}}"></script>
    <script>
        document.addEventListener('alpine:init', () => {
             //invoice list
             Alpine.data('roomList', () => ({
                    selectedRows: [],
                    isDeleteHotelModal: false,
                    items: [],
                    searchText: '',
                    datatable: null,
                    dataArr: [],
                    currentPage: 1,
                    lastPage: 1,
                    perPage: 10,
                    total: 0,
                    deletedHotel: null,
                   
                    init() {
            
                        this.fetchData();
                      /*   this.setTableData();
                        this.initializeTable(); */
                       /*  this.$watch('items', (value) => {
                            this.datatable.destroy();
                            this.setTableData();
                            this.initializeTable();
                        });
                        this.$watch('selectedRows', (value) => {
                            this.datatable.destroy();
                            this.setTableData();
                            this.initializeTable();
                        }); */
                    },

                    initializeTable() {
                        this.datatable = new simpleDatatables.DataTable('#myTable', {
                            data: {
                                headings: [
                                    '#',
                                    'Id',
                                    'Title',
                                    'Sub Title',
                                    'Hotel',
                                    'Max Pepole',
                                    'Home',
                                    'Status',
                                    'Action',
                                ],
                                // data: this.getRowsData(),
                            },
                            currentPage: 1,
                            lastPage: 1,
                            perPage: 10,
                            total: 0,
                            perPageSelect: [10, 20, 30, 50, 100],
                            columns: [
                                {
                                    select: 0,
                                    sortable: false,
                                    render: function (data, cell, row) {
                                        return data;
                                    },
                                },
                                {
                                    select: 1,
                                    render: function (data, cell, row) {
                                        return (
                                            '<a href="javascript:void()" class="text-primary underline font-semibold hover:no-underline">#' +
                                            data +
                                            '</a>'
                                        );
                                    },
                                },
                                {
                                    select: 3,
                                    render: function (data, cell, row) {
                                        let sub_title = data =='null'?"NA":data;
                                        return sub_title;
                                    },
                                   /*  let class = ""; */
                                },
                                {
                                    select: 2,
                                    render: function (data, cell, row) {
                                        return data;
                                    },
                                },
                                {
                                    select: 4,
                                    render: function (data, cell, row) {
                                        let hotelType = "None";
                                        if(data=='1'){
                                            hotelType=`<div class="inline-flex"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 group-hover:fill-warning fill-warning"><path d="M9.05306 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path></svg></div>`;;
                                        }
                                        if(data=='2'){
                                            hotelType ="";
                                            for(let i=0;i<data;i++){
                                                hotelType +=`<div class="inline-flex"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 group-hover:fill-warning fill-warning"><path d="M9.05306 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path></svg></div>`;
                                            }
                                            
                                        }
                                        if(data=='3'){
                                            hotelType ="";
                                            for(let i=0;i<data;i++){
                                                hotelType +=`<div class="inline-flex"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 group-hover:fill-warning fill-warning"><path d="M9.05306 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path></svg></div>`;;
                                            }
                                        }
                                        if(data=='4'){
                                            hotelType ="";
                                            for(let i=0;i<data;i++){
                                                hotelType +=`<div class="inline-flex"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 group-hover:fill-warning fill-warning"><path d="M9.05306 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path></svg></div>`;;
                                            }
                                        }
                                        if(data=='5'){
                                            hotelType ="";
                                            for(let i=0;i<data;i++){
                                                hotelType +=`<div class="inline-flex"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 group-hover:fill-warning fill-warning"><path d="M9.05306 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path></svg></div>`;;
                                            }
                                        }
                                        return hotelType;
                                    },
                                },
                                {
                                    select: 5,
                                    render: function (data, cell, row) {
                                        return '<div class="font-semibold">' + data + '</div>';
                                    },
                                },
                                {
                                    select: 6,
                                    render: function (data, cell, row) {
                                        let styleClass = data == '1' ? 'badge-outline-success' : 'badge-outline-danger';
                                        let text = data == '1' ? 'Yes' : 'No';
                                        return '<span class="badge ' + styleClass + '">' + text + '</span>';
                                    },
                                },
                                {
                                    select:7,
                                    render: function (data, cell, row) {
                                        let styleClass;
                                        let text;
                                        if(data=='1'){
                                            styleClass ="badge-outline-success";
                                            text = "Published"
                                        }
                                        if(data=='2'){
                                            styleClass ="badge-outline-danger";
                                            text = "Not Published"
                                        }
                                        if(data=='3'){
                                            styleClass ="badge-outline-warning";
                                            text = "Awating"
                                        }
                                        if(data=='4'){
                                            styleClass ="badge-outline-secondary";
                                            text = "Archived"
                                        }
                                       
                                        return '<span class="badge ' + styleClass + '">' + text + '</span>';
                                    },
                                },
                                {
                                    select: 8,
                                    sortable: false,
                                    render: function (data, cell, row) {
                                        return `<div class="flex gap-4 items-center">
                                            <a href="{{route('admin.hotel.management.edit')}}/${btoa(data)}" class="hover:text-info">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                                                    <path
                                                        opacity="0.5"
                                                        d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                    ></path>
                                                    <path
                                                        d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    ></path>
                                                    <path
                                                        opacity="0.5"
                                                        d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    ></path>
                                                </svg>
                                            </a>
                                            <button type="button" class="hover:text-danger" @click="deleteRow(${data})">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                    <path
                                                        d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                    ></path>
                                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                    <path
                                                        opacity="0.5"
                                                        d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </div>`;
                                    },
                                },
                            ],
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
                                perPage: "<span class='ml-2'>{select}</span>",
                                noRows: 'No data available',
                            },
                            layout: {
                                top: '{search}',
                                bottom: '{info}{select}{pager}',
                            },
                        });
                    },

                    checkAllCheckbox() {
                        if (this.items.length && this.selectedRows.length === this.items.length) {
                            return true;
                        } else {
                            return false;
                        }
                    },

                    checkAll(isChecked) {
                        if (isChecked) {
                            this.selectedRows = this.items.map((d) => {
                                return d.id;
                            });
                        } else {
                            this.selectedRows = [];
                        }
                    },

                    setTableData() {
                        this.dataArr = [];
                        for (let i = 0; i < this.items.length; i++) {
                            this.dataArr[i] = [];
                            for (let p in this.items[i]) {
                                if (this.items[i].hasOwnProperty(p)) {
                                    this.dataArr[i].push(this.items[i][p]);
                                }
                            }
                        }
                    },

                    searchInvoice() {
                        return this.items.filter(
                            (d) =>
                                (d.invoice && d.invoice.toLowerCase().includes(this.searchText)) ||
                                (d.name && d.name.toLowerCase().includes(this.searchText)) ||
                                (d.email && d.email.toLowerCase().includes(this.searchText)) ||
                                (d.date && d.date.toLowerCase().includes(this.searchText)) ||
                                (d.amount && d.amount.toLowerCase().includes(this.searchText)) ||
                                (d.status && d.status.toLowerCase().includes(this.searchText))
                        );
                    },

                    deleteRow(item) {
                        const swalWithBootstrapButtons = window.Swal.mixin({
                            confirmButtonClass: 'btn btn-secondary',
                            cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true,
                            padding: '2em',
                        })
                        .then(async (result) => {
                            if (result.value) {
                                try {
                                    showloader()
                                    const response = await fetch ("{{ route('admin.hotel.management.delete') }}",{
                                        headers: {
                                            "X-CSRF-Token": "{{ csrf_token() }}",
                                            "Content-Type": "application/json"
                                        },
                                        method:"POST",
                                        body:JSON.stringify({id:item})
                                    });
                                    hideLoader();
                                    const res = await response.json()
                                    if(res.status){
                                        swalWithBootstrapButtons.fire('Deleted!',  res.message, 'success').then((result)=>{
                                            if (result.value){
                                                window.location.reload();
                                            }else{
                                                window.location.reload();
                                            }
                                            
                                        });
                                        this.fetchData();
                                    }else{
                                        swalWithBootstrapButtons.fire('Cancelled', res.message, 'error');
                                    }
                                    
                                } catch (error) {
                                    hideLoader();   
                                    toastr.error(error.message);
                                }
                            
                            } else if (result.dismiss === window.Swal.DismissReason.cancel) {
                                swalWithBootstrapButtons.fire('Cancelled', 'Your imaginary file is safe :)', 'error');
                            }
                        });
                    },

                    async fetchData(page = 1,perPage=10) {
                        try {
                            const response = await fetch(`{{ route('admin.hotel.management.get.hotel') }}?page=${page}&per_page=${perPage}`);
                            const result = await response.json();
                            if(result.data.length > 0){
                                this.items = result.data; // Users on the current page
                            }else{
                                this.items = [];
                            }
                            
                            if (this.datatable) {
                                this.initializeTable();
                            } else {
                                this.initializeTable();
                            }
                        } catch (error) {
                            console.error('Error fetching data:', error);
                        }
                    },
                    getRowsData() {
                        return this.items.map((item, index) => [
                            index + 1 + (this.currentPage - 1) * this.perPage,
                            item.id,
                            `${item.title}`,
                            `${item.sub_title}`,
                            item.class,
                            this.capitalizeFirstLetter(item.destination.name),
                            item.home_page,
                            item.release,
                          /*   item.department.name,
                            item.status, */
                            item.id,
                        ]);
                    },
                    capitalizeFirstLetter(str) {
                         return str.replace(/\b\w/g, char => char.toUpperCase());
                    }

                }));
        })
    </script>
@endpush
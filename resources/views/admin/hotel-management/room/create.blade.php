@extends('admin.layouts.master')
@push('title')
    Room Create
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/quill.snow.css') }}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/nice-select2.css')}}" />
@endpush

@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <!-- start main content section -->
    <div x-data="basic">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl">User Create</h2>
            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                <div class="flex gap-3">
                    <div>
                        <a href="{{ route('admin.hotel.management.index') }}" class="btn btn-primary">
                            <svg  width="24"  height="24"  viewBox="0 0 24 24" fill="none"  xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                                <circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path  opacity="0.5" d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z" stroke="currentColor" stroke-width="1.5" />
                                <path  d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"  />
                            </svg>
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel mt-6">
            <form class="space-y-5" id ="createHotel"  @submit.prevent="craeteHotel">
                @csrf
                <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
                    <div class="hotel">
                        <label for="hotel">Hotel</label>
                        <select class="selectize" id="hotel" name="hotel" placeholder="Select hotel ....">
                            <option value=""></option>
                            @foreach ($hotels as $item)
                                <option value="{{$item->id}}">{{ucwords($item->title)}}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    <div class="title">
                        <label for="title">Title</label>
                        <input id="title" type="text" placeholder="Enter Title" class="form-input" name="title">
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    <div class="sub_title">
                        <label for="sub_title">Sub Title</label>
                        <input id="sub_title" type="text" placeholder="Enter Sub title" class="form-input" name="sub_title">
                        <p class="mt-1 text-danger sub_title-error"></p>
                    </div>
                    <div class="alias">
                        <label for="alias">Alias</label>
                        <input id="alias" type="text" placeholder="Enter Alias" class="form-input" name="alias">
                        <p class="mt-1 text-danger alias-error"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
                    <div class="max_children">
                        <label for="max_children">Max Children</label>
                        <select class="selectize" id="max_children" name="max_children" placeholder="Select Max Children ....">
                            <option value=""></option>
                            @for ($i = 1; $i <=20; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    <div class="max_adults">
                        <label for="max_adults">Max Adults</label>
                        <select class="selectize" id="max_adults" name="max_adults" placeholder="Select Max Adults ....">
                            <option value=""></option>
                            @for ($i = 1; $i <=20; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    <div class="max_people">
                        <label for="max_people">Max People</label>
                        <select class="selectize" id="max_people" name="max_people" placeholder="Select Max People ....">
                            <option value=""></option>
                            @for ($i = 1; $i <=20; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <p class="mt-1 text-danger max_people-error"></p>
                    </div>
                    <div class="min_people">
                        <label for="min_people">Min People</label>
                        <select class="selectize" id="min_people" name="min_people" placeholder="Select min People ....">
                            <option value=""></option>
                            @for ($i = 1; $i <=20; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-1">
                    <div class="description mb-20">
                        <label for="description">Description</label>
                        <div x-ref="editor"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="facilities">
                        <label for="facilities">Facilities</label>
                        <select class="selectize" id="facilities" name="facilities" placeholder="Select Facilities ....">
                            <option value=""></option>
                            @foreach ($facilities as $item)
                                <option value="{{$item->id}}">{{ucwords($item->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="number_of_rooms">
                        <label for="number_of_rooms">Number Of Rooms</label>
                        <input id="number_of_rooms" type="text" placeholder="Enter Number Of Rooms" class="form-input" name="number_of_rooms">
                        <p class="mt-1 text-danger number_of_rooms-error"></p>
                    </div>
                    <div class="price_per_night">
                        <label for="price_per_night">Price Per Night</label>
                        <input id="price_per_night" type="text" placeholder="Enter Price Per Night" class="form-input" name="price_per_night">
                        <p class="mt-1 text-danger price_per_night-error"></p>
                    </div>
                </div>
                <div class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">Closing Dates</div>
                <div class="mt-8">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    {{-- <th class="w-1">Id</th> --}}
                                    <th class="w-3">Start Date </th>
                                    <th class="w-3">End Date</th>
                                    <th class="w-2">Number Of Rooms</th>
                                    <th class="w-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="items.length <= 0">
                                    <tr>
                                        <td colspan="5" class="!text-center font-semibold">No Item Available</td>
                                    </tr>
                                </template>
                                <template x-for="(item, i) in items" :key="i">
                                    <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                        <td><input type="date" class="form-input w-32" placeholder="Start Date" x-model="item.start_date"></td>
                                        <td><input type="date" class="form-input w-32" placeholder="End Date" x-model="item.end_date"></td>
                                        <td><input type="text" class="form-input w-32" placeholder="Number Rooms" x-model="item.number_rooms"></td>
                                      {{--   <td x-text="`$${item.amount * item.quantity}`"></td> --}}
                                        <td>
                                            <button type="button" @click="removeItem(item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex flex-col justify-between px-4 sm:flex-row">
                        <div class="mb-6 sm:mb-0">
                            <button type="button" class="btn btn-primary" @click="addItem()">Add Item</button>
                        </div>
                    </div>
                </div>
                <div class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">External ICal Calender</div>
                <div class="mt-8">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    {{-- <th class="w-1">Id</th> --}}
                                    <th class="w-3">Title </th>
                                    <th class="w-3">End Date</th>
                                    <th class="w-2">Number Of Rooms</th>
                                    <th class="w-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="items.length <= 0">
                                    <tr>
                                        <td colspan="5" class="!text-center font-semibold">No Item Available</td>
                                    </tr>
                                </template>
                                <template x-for="(item, i) in items" :key="i">
                                    <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                        <td><input type="date" class="form-input w-32" placeholder="Start Date" x-model="item.start_date"></td>
                                        <td><input type="date" class="form-input w-32" placeholder="End Date" x-model="item.end_date"></td>
                                        <td><input type="text" class="form-input w-32" placeholder="Number Rooms" x-model="item.number_rooms"></td>
                                      {{--   <td x-text="`$${item.amount * item.quantity}`"></td> --}}
                                        <td>
                                            <button type="button" @click="removeItem(item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex flex-col justify-between px-4 sm:flex-row">
                        <div class="mb-6 sm:mb-0">
                            <button type="button" class="btn btn-primary" @click="addItem()">Add Item</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary !mt-6">Save</button>
            </form>
        </div>
    </div>
    <!-- end main content section -->
</div>
@endsection
@push('script')
    <script src="{{asset('assets/js/nice-select2.js')}}"></script>
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            // default
            var els = document.querySelectorAll(".selectize");
            els.forEach(function(select) {
                NiceSelect.bind(select);
            });
        });
        document.addEventListener('alpine:init', () => {
            Alpine.data('basic', () => ({
                quillEditor: null,
                items: [],
                init() {
                // this.searchTasks();
                    this.items.push({
                        start_date:"",
                        end_date: "",
                        number_rooms:0,
                    });
                    this.initEditor();
                },
                initEditor() {
                    this.quillEditor = new Quill(this.$refs.editor, {
                        theme: 'snow',
                    });
                },
                async craeteHotel() {
                    var data = new FormData(document.getElementById("createHotel"));
                    console.log("Created FormData, " + [...data.keys()].length + " keys in data");
                    data.append("description", this.quillEditor.root.innerHTML);
                    makeWithPostCustomFormRequest("{{ route('admin.hotel.management.store') }}",data,'createHotel')
                },
                addItem() {
                        let maxId = 0;
                        if (this.items && this.items.length) {
                            maxId = this.items.reduce((max, character) => (character.id > max ? character.id : max), this.items[0].id);
                        }
                        this.items.push({
                            id: maxId + 1,
                            title: '',
                            description: '',
                            rate: 0,
                            quantity: 0,
                            amount: 0,
                        });
                    },

                removeItem(item) {
                    this.items = this.items.filter((d) => d.id != item.id);
                },
            }));
            Alpine.data("form", () => ({
                currentDate: new Date(),
                init() {
                    flatpickr(document.getElementById('date_of_birth'), {
                        dateFormat: 'd-m-Y',
                        defaultDate:String(this.currentDate.getDate()).padStart(2, '0')+"-"+String(this.currentDate.getMonth() + 1).padStart(2, '0')+"-"+this.currentDate.getFullYear(),
                        maxDate:new Date(this.currentDate.getFullYear() - 18, this.currentDate.getMonth(), this.currentDate.getDate()),

                    })
                }
            }));
       })
    </script>
@endpush
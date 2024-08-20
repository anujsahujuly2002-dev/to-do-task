@extends('admin.layouts.master')
@push('title')
    Hotel Create
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
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
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
                <div class="grid grid-cols-1 gap-5 md:grid-cols-1">
                    <div class="description mb-20">
                        <label for="description">Description</label>
                        <div x-ref="editor"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="alias">
                        <label for="facilities">Facilities</label>
                        <select class="selectize" id="facilities" name="facilities" placeholder="Select Facilities ....">
                            <option value=""></option>
                            @foreach ($facilities as $item)
                                <option value="{{$item->id}}">{{ucwords($item->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="tags">
                        <label for="tags">Tags</label>
                        <select class="selectize" id="tags" name="tags" placeholder="Select Tags ...">
                            <option value=""></option>
                            @foreach ($tags as $item)
                                <option value="{{$item->id}}">{{ucwords($item->name)}}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-danger tags-error"></p>
                    </div>
                    <div class="destination">
                        <label for="destination">Destination</label>
                        <select class="selectize" id="destination" name="destination" placeholder="Select Destination ...">
                            <option value=""></option>
                           @foreach ($destinations as $item)
                                <option value="{{$item->id}}">{{ucwords($item->name)}}</option>
                           @endforeach
                        </select>
                        <p class="mt-1 text-danger destination-error"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 class">
                    <div class="class">
                        <label for="class">Class</label>
                        <!-- radio -->
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" checked  value="0"/>
                            <span>None</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" value="1"/>
                            <span>1 Star</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" value="2"/>
                            <span>2 Star</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" value="3"/>
                            <span>3 Star</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" value="4"/>
                            <span>4 Star</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="class" class="form-radio" value="5"/>
                            <span>5 Star</span>
                        </label>
                    </div>
                    <div class="phone">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" placeholder="Enter Phone" class="form-input" name="phone">
                        <p class="mt-1 text-danger phone-error"></p>
                    </div>
                    <div class="email">
                        <label for="email">Email</label>
                        <input id="email" type="text" placeholder="Enter Email" class="form-input" name="email">
                        <p class="mt-1 text-danger email-error"></p>
                    </div>
                    <div class="website">
                        <label for="website">Website</label>
                        <input id="website" type="text" placeholder="Enter website" class="form-input" name="website">
                        <p class="mt-1 text-danger website-error"></p>
                    </div>
                    <div class="address">
                        <label for="address">Address</label>
                        <input id="address" type="text" placeholder="Enter address" class="form-input" name="address">
                        <p class="mt-1 text-danger address-error"></p>
                    </div>
                    <div class="latitude">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="text" placeholder="Enter latitude" class="form-input" name="latitude">
                        <p class="mt-1 text-danger latitude-error"></p>
                    </div>
                    <div class="longitude">
                        <label for="longitude">Longitude</label>
                        <input id="longitude" type="text" placeholder="Enter longitude" class="form-input" name="longitude">
                        <p class="mt-1 text-danger longitude-error"></p>
                    </div>
                    <div class="paypal_email">
                        <label for="paypal_email">Paypal Email</label>
                        <input id="paypal_email" type="text" placeholder="Enter Paypal Email" class="form-input" name="paypal_email">
                        <p class="mt-1 text-danger paypal_email-error"></p>
                    </div>
                    <div class="release">
                        <label for="release">Release</label>
                        <label class="inline-flex">
                            <input type="radio" name="release" class="form-radio" value="1"/>
                            <span>Published</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="release" class="form-radio" value="2"/>
                            <span>Not Published</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="release" class="form-radio" value="3"/>
                            <span>Awaiting</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="release" class="form-radio" value="4"/>
                            <span>Archived</span>
                        </label>
                        <p class="mt-1 text-danger paypal_email-error"></p>
                    </div>
                    <div class="homepage">
                        <label for="homepage">Home Page</label>
                        <label class="inline-flex">
                            <input type="radio" name="home_page" class="form-radio" value="0"/>
                            <span>Yes</span>
                        </label>
                        <label class="inline-flex">
                            <input type="radio" name="home_page" class="form-radio" value="1"/>
                            <span>No</span>
                        </label>
                        <p class="mt-1 text-danger homepage-error"></p>
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
                init() {
                // this.searchTasks();
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
                }
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
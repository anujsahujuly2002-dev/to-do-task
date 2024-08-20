@extends('admin.layouts.master')
@push('title')
    User Create
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
                        <a href="{{ route('admin.user.management.index') }}" class="btn btn-primary">
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
            <form class="space-y-5" id ="userCreateForm">
                @csrf
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="title">
                        <label for="title">Title</label>
                        <select name="title" id="title" class="form-input">
                            <option value="">Select Title</option>
                            <option value="Mr">Mr.</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                        <p class="mt-1 text-danger title-error"></p>
                    </div>
                    <div class="first_name">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" placeholder="Enter First Name" class="form-input" name="first_name">
                        <p class="mt-1 text-danger first_name-error"></p>
                    </div>
                    <div class="last_name">
                        <label for="last_name">Last name</label>
                        <input id="last_name" type="text" placeholder="Enter Last name" class="form-input" name="last_name">
                        <p class="mt-1 text-danger last_name-error"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-4 date_of_birth">
                    <div x-data="form">
                        <label for="date_of_birth">Date Of Birth</label>
                        <input id="date_of_birth" type="text" placeholder="Date Of Birth" class="form-input" name="date_of_birth" >
                        <p class="mt-1 text-danger date_of_birth-error"></p>
                    </div>
                    <div class="profile_picture">
                        <label for="profile_picture">Profile Picture </label>
                        <input id="profile_picture" type="file"  class="form-input" name="profile_picture">
                        <p class="mt-1 text-danger profile_picture-error"></p>
                    </div>
                    <div class="md:col-span-2 email">
                        <label for="email">Email</label>
                        <input id="email" type="text" placeholder="Enter Email" class="form-input" name="email">
                        <p class="mt-1 text-danger email-error"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-4 mobile_no">
                    <div>
                        <label for="mobile_no">Mobile No</label>
                        <input id="mobile_no" type="text" placeholder="Enter Mobile No" class="form-input" name="mobile_no">
                        <p class="mt-1 text-danger mobile_no-error"></p>
                    </div>
                    <div class="role">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-input">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                             @endforeach
                        </select>
                        <p class="mt-1 text-danger role-error"></p>
                    </div>
                    <div class="department">
                        <label for="department">Departmant</label>
                        <select name="department" id="department" class="form-input">
                            <option value="">Select Departmant</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-danger department-error"></p>
                    </div>
                    <div class="designation">
                        <label for="designation">Designation</label>
                        <select name="designation" id="" class="form-input">
                            <option value="">Select Designation</option>
                            @foreach ($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-danger designation-error"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary !mt-6">Submit Form</button>
            </form>
        </div>
    </div>
    <!-- end main content section -->
</div>
@endsection
@push('script')
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('basic', () => ({
                countryList: [
                    {
                        code: 'AE',
                        name: 'United Arab Emirates',
                    },
                    {
                        code: 'AR',
                        name: 'Argentina',
                    },
                    {
                        code: 'AT',
                        name: 'Austria',
                    },
                    {
                        code: 'AU',
                        name: 'Australia',
                    },
                    {
                        code: 'BE',
                        name: 'Belgium',
                    },
                    {
                        code: 'BG',
                        name: 'Bulgaria',
                    },
                    {
                        code: 'BN',
                        name: 'Brunei',
                    },
                    {
                        code: 'BR',
                        name: 'Brazil',
                    },
                    {
                        code: 'BY',
                        name: 'Belarus',
                    },
                    {
                        code: 'CA',
                        name: 'Canada',
                    },
                    {
                        code: 'CH',
                        name: 'Switzerland',
                    },
                    {
                        code: 'CL',
                        name: 'Chile',
                    },
                    {
                        code: 'CN',
                        name: 'China',
                    },
                    {
                        code: 'CO',
                        name: 'Colombia',
                    },
                    {
                        code: 'CZ',
                        name: 'Czech Republic',
                    },
                    {
                        code: 'DE',
                        name: 'Germany',
                    },
                    {
                        code: 'DK',
                        name: 'Denmark',
                    },
                    {
                        code: 'DZ',
                        name: 'Algeria',
                    },
                    {
                        code: 'EC',
                        name: 'Ecuador',
                    },
                    {
                        code: 'EG',
                        name: 'Egypt',
                    },
                    {
                        code: 'ES',
                        name: 'Spain',
                    },
                    {
                        code: 'FI',
                        name: 'Finland',
                    },
                    {
                        code: 'FR',
                        name: 'France',
                    },
                    {
                        code: 'GB',
                        name: 'United Kingdom',
                    },
                    {
                        code: 'GR',
                        name: 'Greece',
                    },
                    {
                        code: 'HK',
                        name: 'Hong Kong',
                    },
                    {
                        code: 'HR',
                        name: 'Croatia',
                    },
                    {
                        code: 'HU',
                        name: 'Hungary',
                    },
                    {
                        code: 'ID',
                        name: 'Indonesia',
                    },
                    {
                        code: 'IE',
                        name: 'Ireland',
                    },
                    {
                        code: 'IL',
                        name: 'Israel',
                    },
                    {
                        code: 'IN',
                        name: 'India',
                    },
                    {
                        code: 'IT',
                        name: 'Italy',
                    },
                    {
                        code: 'JO',
                        name: 'Jordan',
                    },
                    {
                        code: 'JP',
                        name: 'Japan',
                    },
                    {
                        code: 'KE',
                        name: 'Kenya',
                    },
                    {
                        code: 'KH',
                        name: 'Cambodia',
                    },
                    {
                        code: 'KR',
                        name: 'South Korea',
                    },
                    {
                        code: 'KZ',
                        name: 'Kazakhstan',
                    },
                    {
                        code: 'LA',
                        name: 'Laos',
                    },
                    {
                        code: 'LK',
                        name: 'Sri Lanka',
                    },
                    {
                        code: 'MA',
                        name: 'Morocco',
                    },
                    {
                        code: 'MM',
                        name: 'Myanmar',
                    },
                    {
                        code: 'MO',
                        name: 'Macau',
                    },
                    {
                        code: 'MX',
                        name: 'Mexico',
                    },
                    {
                        code: 'MY',
                        name: 'Malaysia',
                    },
                    {
                        code: 'NG',
                        name: 'Nigeria',
                    },
                    {
                        code: 'NL',
                        name: 'Netherlands',
                    },
                    {
                        code: 'NO',
                        name: 'Norway',
                    },
                    {
                        code: 'NZ',
                        name: 'New Zealand',
                    },
                    {
                        code: 'PE',
                        name: 'Peru',
                    },
                    {
                        code: 'PH',
                        name: 'Philippines',
                    },
                    {
                        code: 'PK',
                        name: 'Pakistan',
                    },
                    {
                        code: 'PL',
                        name: 'Poland',
                    },
                    {
                        code: 'PT',
                        name: 'Portugal',
                    },
                    {
                        code: 'QA',
                        name: 'Qatar',
                    },
                    {
                        code: 'RO',
                        name: 'Romania',
                    },
                    {
                        code: 'RS',
                        name: 'Serbia',
                    },
                    {
                        code: 'RU',
                        name: 'Russia',
                    },
                    {
                        code: 'SA',
                        name: 'Saudi Arabia',
                    },
                    {
                        code: 'SE',
                        name: 'Sweden',
                    },
                    {
                        code: 'SG',
                        name: 'Singapore',
                    },
                    {
                        code: 'SK',
                        name: 'Slovakia',
                    },
                    {
                        code: 'TH',
                        name: 'Thailand',
                    },
                    {
                        code: 'TN',
                        name: 'Tunisia',
                    },
                    {
                        code: 'TR',
                        name: 'Turkey',
                    },
                    {
                        code: 'TW',
                        name: 'Taiwan',
                    },
                    {
                        code: 'UK',
                        name: 'Ukraine',
                    },
                    {
                        code: 'UG',
                        name: 'Uganda',
                    },
                    {
                        code: 'US',
                        name: 'United States',
                    },
                    {
                        code: 'VN',
                        name: 'Vietnam',
                    },
                    {
                        code: 'ZA',
                        name: 'South Africa',
                    },
                    {
                        code: 'BA',
                        name: 'Bosnia and Herzegovina',
                    },
                    {
                        code: 'BD',
                        name: 'Bangladesh',
                    },
                    {
                        code: 'EE',
                        name: 'Estonia',
                    },
                    {
                        code: 'IQ',
                        name: 'Iraq',
                    },
                    {
                        code: 'LU',
                        name: 'Luxembourg',
                    },
                    {
                        code: 'LV',
                        name: 'Latvia',
                    },
                    {
                        code: 'MK',
                        name: 'North Macedonia',
                    },
                    {
                        code: 'SI',
                        name: 'Slovenia',
                    },
                    {
                        code: 'PA',
                        name: 'Panama',
                    },
                ],
                randomColor() {
                    const color = ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f', '#2196f3'];
                    const random = Math.floor(Math.random() * color.length);
                    return color[random];
                },
                getCountry() {
                    const random = Math.floor(Math.random() * this.countryList.length);
                    return this.countryList[random];
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

       userCreateForm.onsubmit = async (e)=>{
            e.preventDefault();
            makeWithPostRequest("{{ route('admin.user.management.store') }}",userCreateForm)
        }
    </script>
@endpush
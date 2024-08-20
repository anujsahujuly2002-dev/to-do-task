<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserManagement\StoreRequest;

class UserManagementController extends Controller
{
    public function index() {
        return view('admin.user-management.index');
    }

    public function getUsers(Request $request) {
        $pageNo = (!empty($request->input('page_no'))) ? $request->input('page_no') : 1;
        $perPage = (!empty($request->input('per_page'))) ? $request->input('per_page') : 10;
        $users = User::whereHas('roles',function($q){
            $q->whereNot('name','Admin');
        })->with('department','designation')->latest()->get();
        // paginate($perPage, ['*'], 'page', $pageNo);
        return response()->json([
            'status'=>true,
            'data'=>$users
        ],200);
    }

    public function create() {
        $departments = Department::where('status','1')->get();
        $designations = Designation::where('status','1')->get();
        $roles = Role::get();
        return view('admin.user-management.create',compact('departments','designations','roles'));
    }

    public function store(StoreRequest $request) {
        try{
            $ext = 'webp';
            $convertImage = Image::make($request->file('profile_picture'))->encode($ext, 100);
            $fileName = uniqid().'.'.$ext;
            Storage::put('public/users/'.$fileName, $convertImage);
            $user = User::create([
                'title'=>$request->input('title'),
                'name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'date_of_birth'=>$request->input('date_of_birth'),
                'profile_picture'=>$fileName,
                'email'=>$request->input('email'),
                'mobile_no'=>$request->input('mobile_no'),
                'password'=>Hash::make('12345678'),
                'department_id'=>$request->input('department'),
                'designation_id'=>$request->input('designation'),
            ]);
            $user->assignRole($request->input('role'));
            return response()->json([
               'status'=>true,
                "message"=>"User Create successfully,Please wait redirecting....",
                'url'=>route('admin.user.management.index'),
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                "message"=>$e->getMessage()
            ],500);
        }
    }

    public function edit($id){
        $user  = User::find($id);
        $departments = Department::where('status','1')->get();
        $designations = Designation::where('status','1')->get();
        $roles = Role::get();
        return view('admin.user-management.edit',compact('departments','designations','roles','user'));
    }
}

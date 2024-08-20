<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Facilitiy;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HotelManagement\StoreRequest;
use App\Models\Hotel;
use Exception;

class HotelManagementController extends Controller
{
    public function index() {
        return view('admin.hotel-management.hotel.index');
    }

    public function create(){
        $tags = Tag::where('status','1')->get();
        $facilities = Facilitiy::where('status','1')->get();
        $destinations = Destination::where('status','1')->get();
        return view('admin.hotel-management.hotel.create',compact('tags','facilities','destinations'));
    }

    public function store(StoreRequest $request) {
        try {
            $hotel = Hotel::create([
                'title'=>$request->input('title'),
                'sub_title'=>$request->input('sub_title'),
                'alias'=>$request->input('alias'),
                'facilities_id'=>$request->input('facilities'),
                'tag_id'=>$request->input('tags'),
                'destination_id'=>$request->input('destination'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'website'=>$request->input('website'),
                'address'=>$request->input('address'),
                'latitude'=>$request->input('latitude'),
                'longitude'=>$request->input('longitude'),
                'longitude'=>$request->input('longitude'),
                'description'=>$request->input('description'),
                'home_page'=>$request->input('home_page'),
                'release'=>$request->input('release'),
                'class'=>$request->input('class'),
            ]);

            if($hotel):
                return response()->json([
                    'status'=>true,
                    "message"=>"Hotel Create Successfully, Please Wait redirecting....",
                    "url"=>route('admin.hotel.management.index')
                ],200);
            else:
                return response()->json([
                    'status'=>false,
                    "message"=>"Hotel Not Create, Please try again !"
                ],500);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status'=>false,
                "message"=>$e->getMessage()
            ],500);
        }
        
    }

    public function getHotel() {
        $hotel = Hotel::with('destination')->latest()->get();
        // paginate($perPage, ['*'], 'page', $pageNo);
        return response()->json([
            'status'=>true,
            'data'=>$hotel
        ],200);
    }


    public function delete(Request $request) {
        try {
            $hotel = Hotel::find($request->input('id'))->delete();
            if($hotel):
                return response()->json([
                    'status'=>true,
                    "message"=>"Hotel delete Successfully",
                ],200);
            else:
                return response()->json([
                    'status'=>false,
                    "message"=>"Hotel Not Delete, Please try again !"
                ],500);
            endif;
        }
        catch(Exception $e) {
            return response()->json([
                'status'=>false,
                "message"=>$e->getMessage()
            ],500);
        }
    }

    public function edit($id) {
        $tags = Tag::where('status','1')->get();
        $facilities = Facilitiy::where('status','1')->get();
        $destinations = Destination::where('status','1')->get();
        $hotel = Hotel::find(base64_decode($id));
        return view('admin.hotel-management.hotel.edit',compact('tags','facilities','destinations','hotel'));
    }

    public function update(StoreRequest $request) {
        try {
            $hotel = Hotel::find($request->input('id'))->update([
                'title'=>$request->input('title'),
                'sub_title'=>$request->input('sub_title'),
                'alias'=>$request->input('alias'),
                'facilities_id'=>$request->input('facilities'),
                'tag_id'=>$request->input('tags'),
                'destination_id'=>$request->input('destination'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'website'=>$request->input('website'),
                'address'=>$request->input('address'),
                'latitude'=>$request->input('latitude'),
                'longitude'=>$request->input('longitude'),
                'longitude'=>$request->input('longitude'),
                'description'=>$request->input('description'),
                'home_page'=>$request->input('home_page'),
                'release'=>$request->input('release'),
                'class'=>$request->input('class'),
            ]);

            if($hotel):
                return response()->json([
                    'status'=>true,
                    "message"=>"Hotel Create Successfully, Please Wait redirecting....",
                    "url"=>route('admin.hotel.management.index')
                ],200);
            else:
                return response()->json([
                    'status'=>false,
                    "message"=>"Hotel Not Create, Please try again !"
                ],500);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status'=>false,
                "message"=>$e->getMessage()
            ],500);
        }
    }
}

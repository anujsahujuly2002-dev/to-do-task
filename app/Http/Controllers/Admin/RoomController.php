<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facilitiy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;

class RoomController extends Controller
{
    public function index() {
        return view('admin.hotel-management.room.index');
    }

    public function create() {
        $hotels = Hotel::orderBy('id','desc')->get();
        $facilities = Facilitiy::where('status','1')->get();
        return view('admin.hotel-management.room.create',compact('facilities','hotels'));
    }
}

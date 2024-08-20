<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ToDoListNotification;

class ToDoController extends Controller
{
    public function index(){
        $users = User::take(20)->orderBy('name','ASC')->get();
        $categories = Category::where('status','1')->orderBy('name','ASC')->get();
        $statuses = Status::where('status','1')->get();
        return view('admin.to-do-list.index',compact('users','categories','statuses'));
    }

    public function store(Request $request) {
        // $user->notify(New ToDoListNotification());
        $toDoList = ToDoList::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'description_text'=>$request->input('descriptionText'),
            'due_date'=>Carbon::parse($request->input('due_date'))->format('Y-m-d'),
            'assginee_id'=>$request->input('assginee_id'),
            'category_id'=>$request->input('category_id'),
            'priority'=>$request->input('priority'),
            'tag'=>$request->input('tag'),
            'status_id'=>$request->input('status_id')
        ]);


        $user = User::find($toDoList->assginee_id);
        $user->notify(New ToDoListNotification($user->name.$user->last_name));
        if($toDoList):
            return response()->json([
                'status'=>true,
                'message'=>"Task has been saved successfully."
            ]);
        else:
            return response()->json([
                'status'=>false,
                'message'=>"Task has been not saved. Please try again"
            ]);
        endif;
    }

    public function getToDo() {
        $toDoLists = ToDoList::latest()->with('status')->get();
        return response()->json([
            'status'=>false,
            'data'=>$toDoLists
        ]);
    }

    public function edit(Request $request) {
        $toDoList = ToDoList::find($request->input('id'))->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'description_text'=>$request->input('descriptionText'),
            'due_date'=>Carbon::parse($request->input('due_date'))->format('Y-m-d'),
            'assginee_id'=>$request->input('assginee_id'),
            'category_id'=>$request->input('category_id'),
            'priority'=>$request->input('priority'),
            'tag'=>$request->input('tag'),
            'status_id'=>$request->input('status_id')
        ]);
        if($toDoList):
            return response()->json([
                'status'=>true,
                'message'=>"Task has been update successfully."
            ]);
        else:
            return response()->json([
                'status'=>false,
                'message'=>"Task has been not update. Please try again"
            ]);
        endif;

    }

    public function delete(Request $request) {
        try {
            $hotel = ToDoList::find($request->input('id'))->delete();
            if($hotel):
                return response()->json([
                    'status'=>true,
                    "message"=>"To do delete Successfully",
                ],200);
            else:
                return response()->json([
                    'status'=>false,
                    "message"=>"To Do Not Delete, Please try again !"
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
}

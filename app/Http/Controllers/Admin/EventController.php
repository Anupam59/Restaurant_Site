<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class EventController extends Controller
{
    public function EventIndex(){
        $Event = EventModel::join('users as creator_by', 'creator_by.id', '=', 'event.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'event.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'event.*'
            )
            ->orderBy('event_id','asc')->paginate(10);
        return view('Admin/Pages/Event/EventIndex',compact('Event'));
    }

    public function EventCreate(){
        return view('Admin/Pages/Event/EventCreate');
    }

    public function EventEntry(Request $request){
        $validation = $request->validate([
            'event_title' => 'required|unique:event',
        ]);

        $data =  array();
        $data['event_title'] = $request->event_title;
        $data['event_description'] = $request->event_description;
        $data['event_price'] = $request->event_price;

        $event_image =  $request->file('event_image');
        if ($event_image){
            $ImageName =time().".".$event_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($event_image)->resize(600,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['event_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = EventModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function EventEdit($id){
        $Event = EventModel::where('event_id',$id)->first();
        return view('Admin/Pages/Event/EventUpdate',compact('Event'));
    }

    public function EventUpdate(Request $request, $id){
        $request->validate([
            'event_title' => 'required|unique:event,event_title,'. $id .',event_id'
        ]);
        $data =  array();
        $data['event_title'] = $request->event_title;
        $data['event_description'] = $request->event_description;
        $data['event_price'] = $request->event_price;

        $event_image =  $request->file('event_image');
        if ($event_image){
            $ImageName =time().'.'.$event_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($event_image)->resize(600,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = EventModel::where('event_id','=',$id)->select('event_image')->first();
            $OldImage = $OldData->event_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['event_image'] = $url_database;
                }else{
                    $data['event_image'] = $url_database;
                }
            }else{
                $data['event_image'] = $url_database;
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = EventModel::where('event_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Event Update Successfully!');
        }else{
            return back()->with('error_message','Event Update Fail!');
        }
    }
}

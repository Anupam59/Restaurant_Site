<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatterModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class PlatterController extends Controller
{
    public function PlatterIndex(){
        $Platter = PlatterModel::join('users as creator_by', 'creator_by.id', '=', 'platter.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'platter.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'platter.*'
            )
            ->orderBy('platter_id','desc')->paginate(10);
        return view('Admin/Pages/Platter/PlatterIndex',compact('Platter'));
    }

    public function PlatterCreate(){
        return view('Admin/Pages/Platter/PlatterCreate');
    }

    public function PlatterEntry(Request $request){
        $validation = $request->validate([
            'platter_title' => 'required|unique:platter',
        ]);

        $data =  array();
        $data['platter_title'] = $request->platter_title;
        $data['platter_short_title'] = $request->platter_short_title;
        $data['platter_description'] = $request->platter_description;
        $data['platter_price'] = $request->platter_price;

        $platter_image =  $request->file('platter_image');
        if ($platter_image){
            $ImageName =time().".".$platter_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($platter_image)->resize(400,411);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['platter_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PlatterModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function PlatterEdit($id){
        $Platter = PlatterModel::where('platter_id',$id)->first();
        return view('Admin/Pages/Platter/PlatterUpdate',compact('Platter'));
    }

    public function PlatterUpdate(Request $request, $id){
        $request->validate([
            'platter_title' => 'required|unique:platter,platter_title,'. $id .',platter_id'
        ]);
        $data =  array();
        $data['platter_title'] = $request->platter_title;
        $data['platter_short_title'] = $request->platter_short_title;
        $data['platter_description'] = $request->platter_description;
        $data['platter_price'] = $request->platter_price;

        $platter_image =  $request->file('platter_image');
        if ($platter_image){
            $ImageName =time().'.'.$platter_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($platter_image)->resize(400,411);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = PlatterModel::where('platter_id','=',$id)->select('platter_image')->first();
            $OldImage = $OldData->platter_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['platter_image'] = $url_database;
                }else{
                    $data['platter_image'] = $url_database;
                }
            }else{
                $data['platter_image'] = $url_database;
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PlatterModel::where('platter_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Platter Update Successfully!');
        }else{
            return back()->with('error_message','Platter Update Fail!');
        }
    }
}

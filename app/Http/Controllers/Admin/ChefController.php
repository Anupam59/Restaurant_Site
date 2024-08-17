<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChefModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ChefController extends Controller
{
    public function ChefIndex(){
        $Chef = ChefModel::join('users as creator_by', 'creator_by.id', '=', 'chef.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'chef.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'chef.*'
            )
            ->orderBy('chef_id','asc')->paginate(10);
        return view('Admin/Pages/Chef/ChefIndex',compact('Chef'));
    }

    public function ChefCreate(){
        return view('Admin/Pages/Chef/ChefCreate');
    }

    public function ChefEntry(Request $request){
        $validation = $request->validate([
            'chef_name' => 'required|unique:chef',
        ]);

        $data =  array();
        $data['chef_name'] = $request->chef_name;
        $data['chef_designation'] = $request->chef_designation;
        $data['chef_description'] = $request->chef_description;

        $chef_image =  $request->file('chef_image');
        if ($chef_image){
            $ImageName =time().".".$chef_image->getClientOriginalExtension();
            $Path = "Images/chef/";
            $ResizeImage = Image::read($chef_image)->resize(600,600);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['chef_image'] = $url_database;
        }

        $data['twitter_link'] = $request->twitter_link;
        $data['facebook_link'] = $request->facebook_link;
        $data['instagram_link'] = $request->instagram_link;
        $data['linkedin_link'] = $request->linkedin_link;

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = ChefModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function ChefEdit($id){
        $Chef = ChefModel::where('chef_id',$id)->first();
        return view('Admin/Pages/Chef/ChefUpdate',compact('Chef'));
    }

    public function ChefUpdate(Request $request, $id){
        $request->validate([
            'chef_name' => 'required|unique:chef,chef_name,'. $id .',chef_id'
        ]);
        $data =  array();

        $data['chef_name'] = $request->chef_name;
        $data['chef_designation'] = $request->chef_designation;
        $data['chef_description'] = $request->chef_description;

        $chef_image =  $request->file('chef_image');
        if ($chef_image){
            $ImageName =time().'.'.$chef_image->getClientOriginalExtension();
            $Path = "Images/chef/";
            $ResizeImage = Image::read($chef_image)->resize(600,600);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = ChefModel::where('chef_id','=',$id)->select('chef_image')->first();
            $OldImage = $OldData->chef_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['chef_image'] = $url_database;
                }else{
                    $data['chef_image'] = $url_database;
                }
            }else{
                $data['chef_image'] = $url_database;
            }
        }

        $data['twitter_link'] = $request->twitter_link;
        $data['facebook_link'] = $request->facebook_link;
        $data['instagram_link'] = $request->instagram_link;
        $data['linkedin_link'] = $request->linkedin_link;

        $data['position'] = $request->position;
        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = ChefModel::where('chef_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Chef Update Successfully!');
        }else{
            return back()->with('error_message','Chef Update Fail!');
        }
    }
}

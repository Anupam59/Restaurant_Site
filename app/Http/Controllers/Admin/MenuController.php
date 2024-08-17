<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class MenuController extends Controller
{
    public function MenuIndex(){
        $Menu = MenuModel::join('users as creator_by', 'creator_by.id', '=', 'menu.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'menu.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'menu.*'
            )
            ->orderBy('menu_id','asc')->paginate(10);
        return view('Admin/Pages/Menu/MenuIndex',compact('Menu'));
    }

    public function MenuCreate(){
        return view('Admin/Pages/Menu/MenuCreate');
    }

    public function MenuEntry(Request $request){
        $validation = $request->validate([
            'menu_title' => 'required|unique:menu',
        ]);

        $data =  array();
        $data['menu_title'] = $request->menu_title;

        $menu_image =  $request->file('menu_image');
        if ($menu_image){
            $ImageName =time().".".$menu_image->getClientOriginalExtension();
            $Path = "Images/menu/";
            $ResizeImage = Image::read($menu_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['menu_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MenuModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function MenuEdit($id){
        $Menu = MenuModel::where('menu_id',$id)->first();
        return view('Admin/Pages/Menu/MenuUpdate',compact('Menu'));
    }

    public function MenuUpdate(Request $request, $id){
        $request->validate([
            'menu_title' => 'required|unique:menu,menu_title,'. $id .',menu_id'
        ]);
        $data =  array();
        $data['menu_title'] = $request->menu_title;

        $menu_image =  $request->file('menu_image');
        if ($menu_image){
            $ImageName =time().'.'.$menu_image->getClientOriginalExtension();
            $Path = "Images/menu/";
            $ResizeImage = Image::read($menu_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = MenuModel::where('menu_id','=',$id)->select('menu_image')->first();
            $OldImage = $OldData->menu_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['menu_image'] = $url_database;
                }else{
                    $data['menu_image'] = $url_database;
                }
            }else{
                $data['menu_image'] = $url_database;
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MenuModel::where('menu_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Menu Update Successfully!');
        }else{
            return back()->with('error_message','Menu Update Fail!');
        }
    }
}

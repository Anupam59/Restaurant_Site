<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItemModel;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class MenuItemController extends Controller
{
    public function MenuItemIndex(){
        $MenuItem = MenuItemModel::join('users as creator_by', 'creator_by.id', '=', 'menu_item.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'menu_item.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'menu_item.*'
            )
            ->orderBy('menu_item_id','asc')->paginate(10);
        return view('Admin/Pages/MenuItem/MenuItemIndex',compact('MenuItem'));
    }

    public function MenuItemCreate(){
        $Menu = MenuModel::where('status',1)->get();
        return view('Admin/Pages/MenuItem/MenuItemCreate',compact('Menu'));
    }

    public function MenuItemEntry(Request $request){
        $validation = $request->validate([
            'menu_item_title' => 'required|unique:menu_item',
        ]);

        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_title'] = $request->menu_item_title;
        $data['menu_item_description'] = $request->menu_item_description;
        $data['menu_item_price'] = $request->menu_item_price;

        $menu_item_image =  $request->file('menu_item_image');
        if ($menu_item_image){
            $ImageName =time().".".$menu_item_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($menu_item_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['menu_item_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MenuItemModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function MenuItemEdit($id){
        $Menu = MenuModel::where('status',1)->get();
        $MenuItem = MenuItemModel::where('menu_item_id',$id)->first();
        return view('Admin/Pages/MenuItem/MenuItemUpdate',compact('Menu','MenuItem'));
    }

    public function MenuItemUpdate(Request $request, $id){
        $request->validate([
            'menu_item_title' => 'required|unique:menu_item,menu_item_title,'. $id .',menu_item_id'
        ]);
        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_title'] = $request->menu_item_title;
        $data['menu_item_description'] = $request->menu_item_description;
        $data['menu_item_price'] = $request->menu_item_price;

        $menu_item_image =  $request->file('menu_item_image');
        if ($menu_item_image){
            $ImageName =time().'.'.$menu_item_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::read($menu_item_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = MenuItemModel::where('menu_item_id','=',$id)->select('menu_item_image')->first();
            $OldImage = $OldData->menu_item_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['menu_item_image'] = $url_database;
                }else{
                    $data['menu_item_image'] = $url_database;
                }
            }else{
                $data['menu_item_image'] = $url_database;
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MenuItemModel::where('menu_item_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','MenuItem Update Successfully!');
        }else{
            return back()->with('error_message','MenuItem Update Fail!');
        }
    }

}

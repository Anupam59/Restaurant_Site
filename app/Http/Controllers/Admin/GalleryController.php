<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class GalleryController extends Controller
{
    public function GalleryIndex(){
        $Gallery = GalleryModel::join('users as creator_by', 'creator_by.id', '=', 'gallery.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'gallery.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'gallery.*'
            )
            ->orderBy('gallery_id','asc')->paginate(10);
        return view('Admin/Pages/Gallery/GalleryIndex',compact('Gallery'));
    }

    public function GalleryCreate(){
        return view('Admin/Pages/Gallery/GalleryCreate');
    }

    public function GalleryEntry(Request $request){
        $validation = $request->validate([
            'gallery_title' => 'required|unique:gallery',
        ]);

        $data =  array();
        $data['gallery_title'] = $request->gallery_title;

        $gallery_image =  $request->file('gallery_image');
        if ($gallery_image){
            $ImageName =time().".".$gallery_image->getClientOriginalExtension();
            $Path = "Images/gallery/";
            $ResizeImage = Image::read($gallery_image)->resize(640,427);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['gallery_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = GalleryModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function GalleryEdit($id){
        $Gallery = GalleryModel::where('gallery_id',$id)->first();
        return view('Admin/Pages/Gallery/GalleryUpdate',compact('Gallery'));
    }

    public function GalleryUpdate(Request $request, $id){
        $request->validate([
            'gallery_title' => 'required|unique:gallery,gallery_title,'. $id .',gallery_id'
        ]);
        $data =  array();
        $data['gallery_title'] = $request->gallery_title;

        $gallery_image =  $request->file('gallery_image');
        if ($gallery_image){
            $ImageName =time().'.'.$gallery_image->getClientOriginalExtension();
            $Path = "Images/gallery/";
            $ResizeImage = Image::read($gallery_image)->resize(640,427);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = GalleryModel::where('gallery_id','=',$id)->select('gallery_image')->first();
            $OldImage = $OldData->gallery_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['gallery_image'] = $url_database;
                }else{
                    $data['gallery_image'] = $url_database;
                }
            }else{
                $data['gallery_image'] = $url_database;
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = GalleryModel::where('gallery_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Gallery Update Successfully!');
        }else{
            return back()->with('error_message','Gallery Update Fail!');
        }
    }
}

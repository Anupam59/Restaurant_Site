<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonPageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CommonPageController extends Controller
{
    public function CommonPageIndex(){
        $CommonPage = CommonPageModel::join('users as creator_by', 'creator_by.id', '=', 'common_page.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'common_page.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'common_page.*'
            )
            ->orderBy('page_id','asc')->paginate(10);
        return view('Admin/Pages/CommonPage/CommonPageIndex',compact('CommonPage'));
    }

    public function CommonPageCreate(){
        return view('Admin/Pages/CommonPage/CommonPageCreate');
    }

    public function CommonPageEntry(Request $request){
        $validation = $request->validate([
            'page_title' => 'required|unique:common_page',
        ]);

        $data =  array();
        $data['page_title'] = $request->page_title;
        $data['page_slug'] = Str::slug($request->page_title, '-');
        $data['page_description'] = $request->page_description;
        $data['page_link'] = $request->page_link;

        $page_image =  $request->file('page_image');
        if ($page_image){
            $ImageName =time().".".$page_image->getClientOriginalExtension();
            $Path = "Images/common/";
            $ResizeImage = Image::read($page_image)->resize(640,427);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['page_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = CommonPageModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function CommonPageEdit($id){
        $CommonPage = CommonPageModel::where('page_id',$id)->first();
        return view('Admin/Pages/CommonPage/CommonPageUpdate',compact('CommonPage'));
    }

    public function CommonPageUpdate(Request $request, $id){
        $request->validate([
            'page_title' => 'required|unique:common_page,page_title,'. $id .',page_id'
        ]);
        $data =  array();

        $data['page_title'] = $request->page_title;
        $data['page_slug'] = Str::slug($request->page_title, '-');
        $data['page_description'] = $request->page_description;
        $data['page_link'] = $request->page_link;

        $page_image =  $request->file('page_image');
        if ($page_image){
            $ImageName =time().'.'.$page_image->getClientOriginalExtension();
            $Path = "Images/common/";
            $ResizeImage = Image::read($page_image)->resize(640,427);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = CommonPageModel::where('page_id','=',$id)->select('page_image')->first();
            $OldImage = $OldData->page_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['page_image'] = $url_database;
                }else{
                    $data['page_image'] = $url_database;
                }
            }else{
                $data['page_image'] = $url_database;
            }
        }


        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = CommonPageModel::where('page_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','CommonPage Update Successfully!');
        }else{
            return back()->with('error_message','CommonPage Update Fail!');
        }
    }
}

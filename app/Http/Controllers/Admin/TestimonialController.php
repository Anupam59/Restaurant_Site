<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class TestimonialController extends Controller
{
    public function TestimonialIndex(){
        $Testimonial = TestimonialModel::join('users as creator_by', 'creator_by.id', '=', 'testimonial.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'testimonial.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'testimonial.*'
            )
            ->orderBy('testimonial_id','asc')->paginate(10);
        return view('Admin/Pages/Testimonial/TestimonialIndex',compact('Testimonial'));
    }

    public function TestimonialCreate(){
        return view('Admin/Pages/Testimonial/TestimonialCreate');
    }

    public function TestimonialEntry(Request $request){
        $validation = $request->validate([
            'testimonial_name' => 'required|unique:testimonial',
        ]);

        $data =  array();
        $data['testimonial_name'] = $request->testimonial_name;
        $data['testimonial_designation'] = $request->testimonial_designation;
        $data['testimonial_description'] = $request->testimonial_description;

        $testimonial_image =  $request->file('testimonial_image');
        if ($testimonial_image){
            $ImageName =time().".".$testimonial_image->getClientOriginalExtension();
            $Path = "Images/testimonial/";
            $ResizeImage = Image::read($testimonial_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['testimonial_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TestimonialModel::insert($data);
        if ($res){
            return back()->with('success_message','Common Page Add Successfully!');
        }else{
            return back()->with('error_message','Common Page Add Fail!');
        }
    }

    public function TestimonialEdit($id){
        $Testimonial = TestimonialModel::where('testimonial_id',$id)->first();
        return view('Admin/Pages/Testimonial/TestimonialUpdate',compact('Testimonial'));
    }

    public function TestimonialUpdate(Request $request, $id){
        $request->validate([
            'testimonial_name' => 'required|unique:testimonial,testimonial_name,'. $id .',testimonial_id'
        ]);
        $data =  array();

        $data['testimonial_name'] = $request->testimonial_name;
        $data['testimonial_designation'] = $request->testimonial_designation;
        $data['testimonial_description'] = $request->testimonial_description;

        $testimonial_image =  $request->file('testimonial_image');
        if ($testimonial_image){
            $ImageName =time().'.'.$testimonial_image->getClientOriginalExtension();
            $Path = "Images/testimonial/";
            $ResizeImage = Image::read($testimonial_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = TestimonialModel::where('testimonial_id','=',$id)->select('testimonial_image')->first();
            $OldImage = $OldData->testimonial_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['testimonial_image'] = $url_database;
                }else{
                    $data['testimonial_image'] = $url_database;
                }
            }else{
                $data['testimonial_image'] = $url_database;
            }
        }


        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TestimonialModel::where('testimonial_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Testimonial Update Successfully!');
        }else{
            return back()->with('error_message','Testimonial Update Fail!');
        }
    }
}

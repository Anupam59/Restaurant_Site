<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChefModel;
use App\Models\SiteCommonModel;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class SiteCommonController extends Controller
{
    public function SiteInfo(){
        $SiteCommon = SiteCommonModel::select(
            'site_common.time_zone',
            'site_common.site_name',
            'site_common.site_email',
            'site_common.site_contact',
            'site_common.site_title',
            'site_common.site_keyword',
            'site_common.site_description',
            'site_common.site_time',
            'site_common.site_link',
            'site_common.site_address'
        )->where('site_common_id',1)->first();
        return view('Admin/Pages/SiteCommon/SiteInfo',compact('SiteCommon'));
    }

    public function SiteInfoUpdate(Request $request){
        $data =  array();
        $data['time_zone'] = $request->time_zone;
        $data['site_name'] = $request->site_name;
        $data['site_email'] = $request->site_email;
        $data['site_contact'] = $request->site_contact;
        $data['site_title'] = $request->site_title;
        $data['site_keyword'] = $request->site_keyword;
        $data['site_description'] = $request->site_description;
        $data['site_time'] = $request->site_time;
        $data['site_link'] = $request->site_link;
        $data['site_address'] = $request->site_address;

        $res = SiteCommonModel::where('site_common_id','=',1)->update($data);
        if ($res){
            return back()->with('success_message','Site Info Update Successfully!');
        }else{
            return back()->with('error_message','Site Info Update Fail!');
        }
    }



    public function SiteSocialMedia(){
        $SiteCommon = SiteCommonModel::select(
            'site_common.site_fb_link',
            'site_common.site_tw_link',
            'site_common.site_yt_link',
            'site_common.site_ig_link',
            'site_common.site_sp_link',
            'site_common.site_ln_link'
        )->where('site_common_id',1)->first();
        return view('Admin/Pages/SiteCommon/SiteSocialMedia',compact('SiteCommon'));
    }

    public function SiteSocialMediaUpdate(Request $request){
        $data =  array();
        $data['site_fb_link'] = $request->site_fb_link;
        $data['site_tw_link'] = $request->site_tw_link;
        $data['site_yt_link'] = $request->site_yt_link;
        $data['site_ig_link'] = $request->site_ig_link;
        $data['site_sp_link'] = $request->site_sp_link;
        $data['site_ln_link'] = $request->site_ln_link;
        $res = SiteCommonModel::where('site_common_id','=',1)->update($data);
        if ($res){
            return back()->with('success_message','Site Info Update Successfully!');
        }else{
            return back()->with('error_message','Site Info Update Fail!');
        }
    }


    public function SiteData(){
        $SiteCommon = SiteCommonModel::select(
            'site_common.site_about_title',
            'site_common.site_about_description',
            'site_common.site_about_img',
            'site_common.site_welcome_title',
            'site_common.site_welcome_description',
            'site_common.site_welcome_video',
            'site_common.site_map'
        )->where('site_common_id',1)->first();
        return view('Admin/Pages/SiteCommon/SiteData',compact('SiteCommon'));
    }

    public function SiteDataUpdate(Request $request){
        $data =  array();
        $data['site_about_title'] = $request->site_about_title;
        $data['site_about_description'] = $request->site_about_description;
        $data['site_welcome_title'] = $request->site_welcome_title;
        $data['site_welcome_description'] = $request->site_welcome_description;
        $data['site_welcome_video'] = $request->site_welcome_video;
        $data['site_map'] = $request->site_map;

        $site_about_img =  $request->file('site_about_img');
        if ($site_about_img){
            $ImageName =time().'.'.$site_about_img->getClientOriginalExtension();
            $Path = "Images/site/";
            $ResizeImage = Image::read($site_about_img)->resize(600,446);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = SiteCommonModel::where('site_common_id','=',1)->select('site_about_img')->first();
            $OldImage = $OldData->site_about_img;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['site_about_img'] = $url_database;
                }else{
                    $data['site_about_img'] = $url_database;
                }
            }else{
                $data['site_about_img'] = $url_database;
            }
        }

        $res = SiteCommonModel::where('site_common_id','=',1)->update($data);
        if ($res){
            return back()->with('success_message','Site Data Update Successfully!');
        }else{
            return back()->with('error_message','Site Data Update Fail!');
        }
    }

}

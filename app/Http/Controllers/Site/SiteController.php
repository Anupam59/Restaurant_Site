<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ChefModel;
use App\Models\EventModel;
use App\Models\GalleryModel;
use App\Models\MenuItemModel;
use App\Models\MenuModel;
use App\Models\PlatterModel;
use App\Models\TestimonialModel;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function HomePage(){
        $Menu = MenuModel::where('status','=',1)->orderBy('menu_id','desc')->get();
        $MenuItem = MenuItemModel::where('status','=',1)->orderBy('menu_item_id','desc')->get();
        $Platter = PlatterModel::where('status','=',1)->orderBy('platter_id','desc')->get();
        $Event = EventModel::where('status','=',1)->orderBy('event_id','desc')->get();
        $Gallery = GalleryModel::where('status','=',1)->orderBy('gallery_id','desc')->get();
        $Testimonial = TestimonialModel::where('status','=',1)->orderBy('testimonial_id','desc')->get();
        $Chef = ChefModel::where('status','=',1)->orderBy('chef_id','desc')->get();
        return view('Site/Pages/HomePage',compact('Menu','MenuItem','Platter','Event','Gallery','Testimonial','Chef'));

    }
}

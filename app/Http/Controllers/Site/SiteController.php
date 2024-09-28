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
        $Menu = MenuModel::where('status','=',1)->orderBy('menu_id','asc')->get();
        $MenuItem = MenuItemModel::where('status','=',1)->orderBy('menu_item_id','desc')->limit(10)->get();
        $Platter = PlatterModel::where('status','=',1)->orderBy('platter_id','desc')->limit(5)->get();
        $Event = EventModel::where('status','=',1)->inRandomOrder()->limit(3)->get();
        $Testimonial = TestimonialModel::where('status','=',1)->inRandomOrder()->limit(5)->get();
        $Gallery = GalleryModel::where('status','=',1)->orderBy('gallery_id','desc')->get();
        $Chef = ChefModel::where('status','=',1)->inRandomOrder()->limit(3)->get();

        return view('Site/Pages/HomePage',compact('Menu','MenuItem','Platter','Event','Gallery','Testimonial','Chef'));

    }
}

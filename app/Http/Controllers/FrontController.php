<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class FrontController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->get('category')){
            $category_id = Category::where('name', $request->get('category'))->value('id');
            $events = Event::where('category_id', $category_id)->get();
        }else if($request->get('community')){
            $events = Event::where('community', $request->get('community'))->get();
        }else{
            $events = Event::get();
        }
        $categories = Category::all();

        return view('front.index', compact('events', 'categories'));
    }


    public function getViewSubscription(){
        return view('front.subscription');
    }
}

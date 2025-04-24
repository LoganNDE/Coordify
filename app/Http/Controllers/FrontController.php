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
        if($request->all()){
            $query = Event::query();

            foreach ($request->all() as $field => $value) {
                if (!empty($value)) {
                    if ($field == 'category'){
                        $category = Category::where('name', $value)->first();
                        if ($category){
                            $query->where('category_id', $category->id);
                        }
                    }else{
                        $query->where($field, $value);
                    }
                }
            }
            
            $events = $query->get();          
        }else{
            $events = Event::orderBy('promoted', 'desc')->orderBy('created_at', 'desc')->get();            
        }
        $categories = Category::all();

        return view('front.index', compact('events', 'categories'));
    }


    public function getViewSubscription(){
        return view('front.subscription');
    }
}

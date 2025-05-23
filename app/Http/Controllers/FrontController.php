<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,admin')->except(['__invoke', 'getViewSubscription', 'getLegalNotice', 'getPrivacyPolicy']);
    }
 
    public function __invoke(Request $request)
    {
        if (isset(auth('admin')->user()->user_id)) {
            return view('front.admin');
        }
    
        $allowedFilters = ['search', 'category', 'community'];
        $filters = $request->only($allowedFilters);
    
        $query = Event::query()->where('archived', false);
    
        // Filtro por búsqueda en nombre
        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }
    
        // Filtro por nombre de la categoría
        if (!empty($filters['category'])) {
            $categoryName = $filters['category'];
        
            $query->whereHas('category', function ($subQuery) use ($categoryName) {
                $subQuery->where('name', $categoryName);
            });
        }
    
        // Filtro por comunidad
        if (!empty($filters['community'])) {
            $query->where('community', $filters['community']);
        }
    
        // Orden si no hay filtros activos
        if (empty(array_filter($filters))) {
            $query->orderBy('promoted', 'desc')->orderBy('created_at', 'desc');
        }
    
        $events = $query->paginate(10);
        $categories = Category::all();
    
        return view('front.index', compact('events', 'categories'));
    }

    public function getViewSubscription(){
        if (isset(auth('admin')->user()->user_id)){
            return view('front.admin');
        }

        return view('front.subscription');
    }

    public function getViewTickets(){
        if (isset(auth('admin')->user()->user_id)){
            return view('front.admin');
        }

        if (count(auth()->user()->participants) > 0){
            $tickets = auth()->user()->participants;

            foreach ($tickets as $ticket){
                $eventGroups = $tickets->flatMap->events->groupBy('id');
            }
            return view('front.tickets', compact('eventGroups'));
        }else{
            return view('front.tickets');
        }
    }
 
    public function getQRCode($idEvent){
        if (isset(auth('admin')->user()->user_id)){
            return view('front.admin');
        }

        $participants = auth()->user()->participants()->whereHas('events', function($query) use ($idEvent) {$query->where('events.id', $idEvent);})->get();
        
        if (!$participants){
            return redirect()->route('front.tickets')->with('error', 'No entradas para este evento');
        }

        $data = [];

        foreach ($participants as $participant){
            $ticket['name'] = $participant->name;
            $ticket['qrCode'] = Storage::url($participant->qr_code);
            $data[] = $ticket;
        }

        if (count($data) == 0){
            return redirect()->route('front.tickets')->with('error', 'No entradas para este evento');
        }
        
        return view('front.qr-code', compact('data'));
    }

    public function getLegalNotice(){
        return view('front.legal-notice');
    }

    public function getPrivacyPolicy(){
        return view('front.privacy-policy');
    }

    public function getCookiePolice(){
        return view('front.cookie-police');
    }


}

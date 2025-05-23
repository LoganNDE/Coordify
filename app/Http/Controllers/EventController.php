<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\UserController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewEvent;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin')->except(['login', 'getPublicEvents', 'publicShow']);
    }

    private function getMainAdminId()
    {
        return auth()->user()->user_id ?? auth()->user()->id;
    }

    private function findOwnedEventOrFail($id)
    {
        return Event::where('id', $id)
            ->where('user_id', $this->getMainAdminId())
            ->firstOrFail();
    }

    public function getPromotedEvents($mainAdmin_id)
    {
        return Event::where('user_id', $mainAdmin_id)->where('promoted', true)->count();
    }

    public function index(Request $request)
    {
        $mainAdmin_id = $this->getMainAdminId();
        $promotedEvents = $this->getPromotedEvents($mainAdmin_id);

        if ($request->input('search')) {
            $search = $request->input('search');
            $events = User::findOrFail($mainAdmin_id)->events()->where('archived', false)->where('name', 'like', "%$search%")->get();
        } else {
            $events = User::findOrFail($mainAdmin_id)->events()->where('archived', false)->get();
        }

        $totalEvents = Event::where('user_id', $mainAdmin_id)->count();
        $activeEvents = Event::where('user_id', $mainAdmin_id)->where('archived', false)->count();
        $totalArchives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->count();
        $maxEvents = User::findOrFail($mainAdmin_id)->subscription->event_limit;
        $maxPromotedEvents = User::findOrFail($mainAdmin_id)->subscription->event_promotion;

        $administrators = AdministratorController::getAdministrators($mainAdmin_id);
        $mainAdmin = UserController::getMainAdmin($mainAdmin_id);

        return view('back.index', compact('events', 'totalEvents', 'totalArchives', 'administrators', 'mainAdmin', 'promotedEvents', 'maxEvents', 'activeEvents', 'maxPromotedEvents'));
    }

    public function archives()
    {
        $mainAdmin_id = $this->getMainAdminId();
        $promotedEvents = $this->getPromotedEvents($mainAdmin_id);

        $archives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->get();
        $totalEvents = Event::where('user_id', $mainAdmin_id)->count();
        $totalArchives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->count();
        $activeEvents = Event::where('user_id', $mainAdmin_id)->where('archived', false)->count();
        $maxEvents = User::findOrFail($mainAdmin_id)->subscription->event_limit;
        $maxPromotedEvents = User::findOrFail($mainAdmin_id)->subscription->event_promotion;
        
        $administrators = AdministratorController::getAdministrators($mainAdmin_id);
        $mainAdmin = UserController::getMainAdmin($mainAdmin_id);

        return view('back.index', compact('archives', 'totalEvents', 'totalArchives', 'administrators', 'mainAdmin', 'maxEvents', 'activeEvents', 'promotedEvents', 'maxPromotedEvents'));
    }

    public function create()
    {
        $mainAdmin_id = $this->getMainAdminId();
        $mainAdmin = User::findOrFail($mainAdmin_id);
    
        $totalEvents = Event::where('user_id', $mainAdmin_id)->count();
        $eventLimit = $mainAdmin->subscription->event_limit;
    
        if ($eventLimit === null || $totalEvents < $eventLimit) {
            return view('back.create');
        }
    
        return redirect()->route('events.index')->with('error', 'Has alcanzado el número de eventos máximos. Aumenta el límite en suscripciones');
    }

    public function store(Request $request)
    {
        if ($request->input('price') == null) {
            $request->merge(['price' => 0]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'startDate' => 'required|date',
            'startTime' => 'required|date_format:H:i',
            'endDate' => 'required|date',
            'endTime' => 'required|date_format:H:i',
            'paymentType' => 'required|in:free,paid',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'categories' => 'required|in:ocio,arte,deportes,negocios,entretenimiento,gastronomía,naturaleza,bienestar,educación,gaming,tecnología',
            'community' => 'required|in:La Rioja,Castilla y León,Ciudad Autónoma de Melilla,Comunidad de Madrid,Andalucía,Illes Balears,Aragón,Galicia,Principado de Asturias,Castilla-La Mancha,Cantabria,Ciudad Autónoma de Ceuta,País Vasco,Comunidad Foral de Navarra,Región de Murcia,Cataluña,Comunitat Valenciana,Canarias,Extremadura',
        ]);

        $validatedData['user_id'] = $this->getMainAdminId();
        $mainAdmin = User::findOrFail($validatedData['user_id']);

        $category_id = Category::where('name', $request->input('categories'))->value('id');
        $validatedData['category_id'] = $category_id;

        if ($request->input('paymentType') == 'free' && $request->input('price') > 0) {
            return redirect()->route('events.create')->with('error', 'Los eventos gratuitos no pueden tener precio');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $filePath;
        }

        $event = Event::create($validatedData);

        Mail::to($mainAdmin->email)->send(new NewEvent($event));
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito');
    }

    public function publicShow(string $id)
    {
        $event = Event::findOrFail($id);
        return view('front.show', compact('event'));
    }

    public function show(string $id)
    {
        $event = $this->findOwnedEventOrFail($id);
        return view('back.view', compact('event'));
    }

    public function showReader()
    {
        return view('back.qr-reader');
    }

    public function edit(string $id)
    {
        $event = $this->findOwnedEventOrFail($id);
        return view('back.update', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'startDate' => 'required|date',
            'startTime' => 'required|date_format:H:i:s',
            'endDate' => 'required|date',
            'endTime' => 'required|date_format:H:i:s',
            'paymentType' => 'required|in:free,paid',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'categories' => 'required|in:ocio,arte,deportes,negocios,entretenimiento,gastronomía,naturaleza,bienestar,educación,gaming,tecnología',
            'community' => 'required|in:La Rioja,Castilla y León,Ciudad Autónoma de Melilla,Comunidad de Madrid,Andalucía,Illes Balears,Aragón,Galicia,Principado de Asturias,Castilla-La Mancha,Cantabria,Ciudad Autónoma de Ceuta,País Vasco,Comunidad Foral de Navarra,Región de Murcia,Cataluña,Comunitat Valenciana,Canarias,Extremadura',
        ]);

        $validatedData['user_id'] = $this->getMainAdminId();

        $category_id = Category::where('name', $request->input('categories'))->value('id');
        $validatedData['category_id'] = $category_id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $filePath;
        }

        $event = $this->findOwnedEventOrFail($id);
        $event->update($validatedData);

        if ($event->archived) {
            return redirect()->route('events.archives')->with('success', 'Evento actualizado con éxito');
        } else {
            return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
        }
    }

    public function destroy(string $id)
    {
        $this->findOwnedEventOrFail($id)->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito');
    }

    public function archive(string $id)
    {
        $event = $this->findOwnedEventOrFail($id);
        $event->archived = true;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento archivado con éxito');
    }

    public function unarchive(string $id)
    {
        $event = $this->findOwnedEventOrFail($id);
        $event->archived = false;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento desarchivado con éxito');
    }

    public function promote(string $id)
    {
        $mainAdmin_id = $this->getMainAdminId();
        $user = User::findOrFail($mainAdmin_id);
        $event = $this->findOwnedEventOrFail($id);

        if ($event->promoted) {
            return redirect()->route('events.index')->with('error', 'El evento ya está promocionado');
        }

        if ($user->subscription->event_promotion > 0) {
            if ($user->subscription->event_promotion > $this->getPromotedEvents($mainAdmin_id)) {
                $event->promoted = true;
                $event->save();
                return redirect()->route('events.index')->with('success', 'Evento promocionado con éxito');
            } else {
                return redirect()->route('events.index')->with('error', 'Has alcanzado el límite de eventos promocionados');
            }
        } else {
            return redirect()->route('events.index')->with('error', 'No tienes permisos para promocionar eventos');
        }
    }

    public function importEvent(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            $path = $request->file('file')->getRealPath();
            $file = fopen($path, 'r');

            $firstLine = true;


            while (($line = fgetcsv($file, 1000, ",")) !== false) {
                if ($firstLine) {
                    $firstLine = false;
                    continue;
                }
            
                Event::create([
                    'name' => $line[0],
                    'description' => $line[1],
                    'community' => $line[2],
                    'address' => $line[3],
                    'startDate' => $line[4],
                    'startTime' => $line[5],
                    'endDate' => $line[6],
                    'endTime' => $line[7],
                    'paymentType' => $line[8],
                    'image' => $line[9] ?? null,
                    'price' => is_numeric($line[10] ?? null) ? (int) $line[10] : 0,
                    'user_id' => $this->getMainAdminId(),
                    'category_id' => Category::where('name', $line[11] ?? 'ocio')->value('id'),
                ]);
            }

            fclose($file);

            return response()->json([
                'status' => 'ok',
                'response' => 'Archivo importado correctamente',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al procesar el archivo: ' . $e->getMessage(),
            ]);
        }
    }
}

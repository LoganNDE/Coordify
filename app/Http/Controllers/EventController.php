<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{

    public function __construct()
    {
    $this->middleware('auth:web,admin')->except(['login', 'getPublicEvents', 'publicShow']);
    }

    public function index(Request $request)
    {
        
        $mainAdmin_id = isset(auth()->user()->user_id) ? auth()->user()->user_id : auth()->user()->id;

        if ($request->input('search')){
            $search = $request->input('search');
            $events = User::findOrFail($mainAdmin_id)->events()->where('archived', false)->where('name', 'like', '%' . $search . '%')->get();
        }else{
            $events = User::findOrFail($mainAdmin_id)->events()->where('archived', false)->get();
        }

        $totalEvents = Event::where('user_id', $mainAdmin_id)->count();
        $totalArchives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->count();

        $administrators = Administrator::where('user_id',$mainAdmin_id)->get();
        $mainAdmin = User::findOrFail($mainAdmin_id);

        return view('back.index', compact('events', 'totalEvents', 'totalArchives', 'administrators', 'mainAdmin'));
    }

    public function archives(){
        $mainAdmin_id = isset(auth()->user()->user_id) ? auth()->user()->user_id : auth()->user()->id;
        $archives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->get();


        $totalEvents = Event::where('user_id', $mainAdmin_id)->count();
        $totalArchives = Event::where('user_id', $mainAdmin_id)->where('archived', true)->count();
        

        $administrators = Administrator::where('user_id',$mainAdmin_id)->get();
        $mainAdmin = User::findOrFail($mainAdmin_id);


        return view('back.index', compact('archives', 'totalEvents', 'totalArchives' ,'administrators', 'mainAdmin'));
    }

    public function create()
    {
        if(auth()->user()->events->count() < auth()->user()->subscription->event_limit){
            return view('back.create');
        }else{
            return redirect()->route('events.index')->with('error', "Has alcanzado el número de eventos máximos. Aumenta el límite en suscripciones");
        }
    }

    public function store(Request $request)
    {

        if($request->input('price') == null){
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
            'user_id' =>    'required'
        ]);

        $category_id = Category::where('name', $request->input('categories'))->value('id');
        $validatedData['category_id'] = $category_id;



        if ($request->input('paymentType') == 'free' && $request->input('price') > 0){
            return redirect()->route('events.create')->with('error', 'Los evetos gratuitos no pueden tener precio');
        }

        // Consultar si hemos obtenido la imagen y si es valida
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Guardaremos la imagen en la ruta personalizada a partir de la carpeta public
            $filePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $filePath;
        }


        Event::create($validatedData);
        //Mail::to(auth()->user()->email)->send(new PostMail());
        return redirect()->route('events.index');
    }

    public function publicShow(string $id)
    {
        $event = Event::findOrFail($id);
        return view('front.show', compact('event'));
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('back.view', compact('event'));
    }

    public function showReader(){
        return view('back.qr-reader');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('back.update', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'startDate' => 'required|date',
            'startTime' => 'required|date_format:H:i:s',
            'endDate' => 'nullable|date',
            'endTime' => 'required |date_format:H:i:s',
            'paymentType' => 'required|in:free,paid',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Consultar si hemos obtenido la imagen y si es valida
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Guardaremos la imagen en la ruta personalizada a partir de la carpeta public
            $filePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $filePath;
        }

        // Buscar el evento por su ID
        $event = Event::findOrFail($id);  // Usa findOrFail para obtener el evento o devolver un error 404 si no se encuentra

        // Actualizar el evento con los datos validados
        $event->update($validatedData);

        if ($event->archived){
            return redirect()->route('events.archives')->with('success', 'Evento actualizado con éxito');
        }else{
            return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
        }
    }

    public function destroy(string $id)
    {
        Event::findOrFail($id)->delete();
        return redirect()->route('events.index');
    }

    public function archive(string $id){
        $event = Event::findOrFail($id);
        $event->archived = true;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento archivado con éxito');
    }

    public function unarchive(string $id){
        $event = Event::findOrFail($id);
        $event->archived = false;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento desarchivado con éxito');
    }

    public function importEvent(Request $request)
    {   

        //VALIDAR REQUEST, COMPROBAR SI HACE EL RESPONSE EN JSON EN CASO QUE LA VALIDACION SEA ERRONEA        
        
        try{
            dd($request->file);
            $event = new Event();
            while ( ($line= fgetcsv($request->input('file'), 1000, ",")) !==FALSE )
            {
                $event->name = $line[0];
                $event->description = $line[1];
                $event->province = $line[2];
                $event->adress = $line[3];
                $event->startDate = $line[4];
                $event->startTime = $line[5];
                $event->endDate = $line[6];
                $event->endTime = $line[7];
                $event->paymentType = $line[8];
                $event->image = $line[9];
                $event->user_id = 1;
            }
            $event->save();
        }catch(Exception $e){
            return response()->json([
                'status' => 'error'
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'response' => 'archivo subido correctamente',
        ]);
    }
}

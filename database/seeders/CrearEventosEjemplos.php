<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class CrearEventosEjemplos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Evento 1: Espectáculo callejero
        $event = new Event();
        $event->name = 'Fuego y Calle: Espectáculo de Artistas Urbanos';
        $event->description = "Un show único de artistas callejeros con malabares de fuego, acrobacias y música en vivo. Disfruta de un ambiente vibrante al aire libre en el corazón de Bilbao. Ideal para familias, grupos de amigos y amantes del arte urbano.";
        $event->address = 'Plaza Nueva, Bilbao';
        $event->startDate = '2025-06-21';
        $event->startTime = '20:00:00';
        $event->endDate = '2025-06-21';
        $event->endTime = '23:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/people.jpg';
        $event->community = 'País Vasco';
        $event->category_id = 4; // ocio
        $event->user_id = 2;
        $event->save();

        // Evento 2: Cena gastronómica
        $event = new Event();
        $event->name = 'Cena de Gala: Sabores del Mediterráneo';
        $event->description = "Una experiencia culinaria de lujo en un entorno elegante. Menú degustación de cinco tiempos maridados con vinos selectos de la región. Un evento ideal para parejas, amantes de la gastronomía y networking de negocios.";
        $event->address = 'Finca El Olivar, San Sebastián de los Reyes, Madrid';
        $event->startDate = '2025-07-05';
        $event->startTime = '21:00:00';
        $event->endDate = '2025-07-06';
        $event->endTime = '00:30:00';
        $event->paymentType = 'paid';
        $event->price = 95.00;
        $event->image = 'events/restaurant.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 5; // gastronomía
        $event->user_id = 2;
        $event->save();

        // Evento 3: Fiesta flúor
        $event = new Event();
        $event->name = 'Glow Party: Fiesta Flúor con DJ en Vivo';
        $event->description = "Una noche de diversión con luces de neón, maquillaje flúor, globos, fotomatón y sets de DJ en directo. Dress code: blanco o flúor. Ideal para grupos de amigos y cumpleaños.";
        $event->address = 'Discoteca Fabrik, Humanes de Madrid';
        $event->startDate = '2025-08-16';
        $event->startTime = '23:30:00';
        $event->endDate = '2025-08-17';
        $event->endTime = '06:00:00';
        $event->paymentType = 'paid';
        $event->price = 25.00;
        $event->image = 'events/food.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 4; // ocio
        $event->user_id = 2;
        $event->save();

        // Evento 4: Festival NXNE
        $event = new Event();
        $event->name = 'NXNE Experience: Cultura, Música y Tecnología';
        $event->description = "Festival multidisciplinar con charlas de innovación, conciertos, cine alternativo y exposiciones de arte digital. NXNE es un punto de encuentro para mentes creativas de toda España.";
        $event->address = 'Fira de Barcelona, Montjuïc';
        $event->startDate = '2025-09-12';
        $event->startTime = '10:00:00';
        $event->endDate = '2025-09-14';
        $event->endTime = '22:00:00';
        $event->paymentType = 'paid';
        $event->price = 60.00;
        $event->image = 'events/hobby.jpg';
        $event->community = 'Cataluña';
        $event->category_id = 10; // tecnología
        $event->user_id = 2;
        $event->save();


        // Evento 1: Bar Talent Nights
        $event = new Event();
        $event->name = 'Bar Talent Nights: Concurso de Coctelería';
        $event->description = "Una noche dedicada al arte de la mixología. Bartenders de toda España compiten en un torneo de coctelería creativa, con catas en vivo y jurado profesional. Público bienvenido para disfrutar, votar y descubrir nuevas tendencias.";
        $event->address = 'The Green Door, Calle Ponzano 52, Madrid';
        $event->startDate = '2025-06-28';
        $event->startTime = '20:00:00';
        $event->endDate = '2025-06-29';
        $event->endTime = '01:00:00';
        $event->paymentType = 'paid';
        $event->price = 15.00;
        $event->image = 'events/bartender.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 5; // gastronomía
        $event->user_id = 2;
        $event->save();

        // Evento 2: Ruta en Barco
        $event = new Event();
        $event->name = 'Ruta en Barco por la Costa de Valencia';
        $event->description = "Explora la costa valenciana en una ruta guiada a bordo de un barco pirata. Incluye animación para todas las edades, bebidas, música y vistas inolvidables. Ideal para familias, turistas y escapadas románticas.";
        $event->address = 'Puerto de Valencia, Muelle de Poniente';
        $event->startDate = '2025-07-14';
        $event->startTime = '18:00:00';
        $event->endDate = '2025-07-14';
        $event->endTime = '21:00:00';
        $event->paymentType = 'paid';
        $event->price = 35.00;
        $event->image = 'events/boatrute.jpg';
        $event->community = 'Comunitat Valenciana';
        $event->category_id = 8; // naturaleza
        $event->user_id = 2;
        $event->save();

        // Evento 3: Torneo Ajedrez
        $event = new Event();
        $event->name = 'Torneo Nacional de Ajedrez Juvenil';
        $event->description = "Participa o asiste al torneo más esperado del año. Reúne a jóvenes talentos del ajedrez de todo el país. Habrá premios, clases magistrales, y partidas en vivo proyectadas. Entrada gratuita para el público.";
        $event->address = 'Casa de la Juventud, Zaragoza';
        $event->startDate = '2025-08-10';
        $event->startTime = '09:30:00';
        $event->endDate = '2025-08-10';
        $event->endTime = '18:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/chest.jpg';
        $event->community = 'Aragón';
        $event->category_id = 3; // educación
        $event->user_id = 2;
        $event->save();

        // Evento 4: Circo Alex Kaiser
        $event = new Event();
        $event->name = 'Gran Circo Alex Kaiser: Edición de Verano';
        $event->description = "El mítico circo Alex Kaiser llega a Sevilla con una edición renovada: artistas internacionales, actos acrobáticos, clowns, y un espectáculo de luces único. Apto para todos los públicos.";
        $event->address = 'Recinto Ferial de Sevilla, Av. Alfredo Kraus';
        $event->startDate = '2025-07-20';
        $event->startTime = '19:00:00';
        $event->endDate = '2025-07-20';
        $event->endTime = '21:30:00';
        $event->paymentType = 'paid';
        $event->price = 20.00;
        $event->image = 'events/circus.jpg';
        $event->community = 'Andalucía';
        $event->category_id = 4; // ocio
        $event->user_id = 2;
        $event->save();

        // Evento 6: Taller Cocina Nikkei
        $event = new Event();
        $event->name = 'Taller de Cocina Nikkei: Perú y Japón en tu Paladar';
        $event->description = "Clase práctica con un chef profesional para aprender técnicas de la cocina fusión Nikkei. Incluye ingredientes, degustación y certificado. Cupos limitados.";
        $event->address = 'Aula de Cocina Market Chef, Murcia';
        $event->startDate = '2025-08-25';
        $event->startTime = '17:00:00';
        $event->endDate = '2025-08-25';
        $event->endTime = '20:30:00';
        $event->paymentType = 'paid';
        $event->price = 48.00;
        $event->image = 'events/cookingclass.jpg';
        $event->community = 'Región de Murcia';
        $event->category_id = 5; // gastronomía
        $event->user_id = 2;
        $event->save();

        // Evento 7: Carrera Ciclista Femenina
        $event = new Event();
        $event->name = 'Carrera Ciclista Femenina - Gran Premio Ciudad de León';
        $event->description = "La élite del ciclismo femenino se da cita en León para recorrer 70 km de resistencia, velocidad y estrategia. Evento deportivo con animación y actividades para familias.";
        $event->address = 'Avenida de los Reyes Leoneses, León';
        $event->startDate = '2025-09-01';
        $event->startTime = '10:00:00';
        $event->endDate = '2025-09-01';
        $event->endTime = '14:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/cycling.jpg';
        $event->community = 'Castilla y León';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();

        // Evento 8: Pasarela Creativa - Desfile de Moda Sostenible
        $event = new Event();
        $event->name = 'Pasarela Creativa: Moda Sostenible y Diseño Emergente';
        $event->description = "Desfile con propuestas de diseñadores emergentes centrados en la moda ética y ecológica. Networking con marcas, showrooms, DJs y pop-up stores.";
        $event->address = 'Centro de Diseño de La Rioja, Logroño';
        $event->startDate = '2025-10-03';
        $event->startTime = '19:00:00';
        $event->endDate = '2025-10-03';
        $event->endTime = '22:30:00';
        $event->paymentType = 'paid';
        $event->price = 18.00;
        $event->image = 'events/designmodel.jpg';
        $event->community = 'La Rioja';
        $event->category_id = 1; // arte
        $event->user_id = 2;
        $event->save();


                // Evento 1: Golf & Wellness Retreat
        $event = new Event();
        $event->name = 'Golf & Wellness Retreat';
        $event->description = "Un día de desconexión total con golf al aire libre, sesiones de estiramiento funcional, zumoterapia y networking slow. Para amantes del bienestar y la naturaleza. Acceso limitado con reserva anticipada.";
        $event->address = 'Real Club de Golf El Prat, Terrassa';
        $event->startDate = '2025-09-21';
        $event->startTime = '10:00:00';
        $event->endDate = '2025-09-21';
        $event->endTime = '18:00:00';
        $event->paymentType = 'paid';
        $event->price = 55.00;
        $event->image = 'events/golf.jpg';
        $event->community = 'Cataluña';
        $event->category_id = 7; // bienestar
        $event->user_id = 2;
        $event->save();

        // Evento 2: Digital Arena: Torneo Gaming + DJ Set
        $event = new Event();
        $event->name = 'Digital Arena: Torneo Gaming + DJ Set';
        $event->description = "Combina la emoción de los e-sports con la energía de una fiesta electrónica. Torneos de League of Legends, Valorant y FIFA, junto a sets de DJ en directo. Premios, sorteos y zona de realidad virtual.";
        $event->address = 'FYCMA Málaga, Auditorio Principal';
        $event->startDate = '2025-11-01';
        $event->startTime = '12:00:00';
        $event->endDate = '2025-11-01';
        $event->endTime = '23:30:00';
        $event->paymentType = 'paid';
        $event->price = 20.00;
        $event->image = 'events/hand-1850120_640.jpg';
        $event->community = 'Andalucía';
        $event->category_id = 6; // gaming
        $event->user_id = 2;
        $event->save();

        // Evento 3: Cumbre Empresarial de Innovación y Networking
        $event = new Event();
        $event->name = 'Cumbre Empresarial de Innovación y Networking';
        $event->description = "Una jornada de conferencias, exhibiciones tecnológicas y networking en un ambiente relajado. Con ponentes internacionales y una zona chill out con vuelo de globos aerostáticos. Ideal para emprendedores y empresas emergentes.";
        $event->address = 'IFEMA Feria de Madrid, Pabellón 7';
        $event->startDate = '2025-10-15';
        $event->startTime = '09:00:00';
        $event->endDate = '2025-10-15';
        $event->endTime = '19:00:00';
        $event->paymentType = 'paid';
        $event->price = 70.00;
        $event->image = 'events/hotairballon.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 2; // negocios
        $event->user_id = 2;
        $event->save();

        // Evento 4: Arte Clásico y Escultura - Recorrido Guiado
        $event = new Event();
        $event->name = 'Arte Clásico y Escultura - Recorrido Guiado';
        $event->description = "Descubre la belleza de la escultura grecorromana con una visita guiada por piezas únicas del museo. Incluye charla histórica, proyección multimedia y copa de vino al finalizar.";
        $event->address = 'Museo de Bellas Artes de Córdoba';
        $event->startDate = '2025-09-30';
        $event->startTime = '17:30:00';
        $event->endDate = '2025-09-30';
        $event->endTime = '19:30:00';
        $event->paymentType = 'paid';
        $event->price = 12.00;
        $event->image = 'events/museum.jpg';
        $event->community = 'Andalucía';
        $event->category_id = 1; // arte
        $event->user_id = 2;
        $event->save();

        // Evento 5: Taller de Producción Musical Digital
        $event = new Event();
        $event->name = 'Taller de Producción Musical Digital';
        $event->description = "Un workshop inmersivo para aprender a crear bases, mezclar y masterizar desde cero. Impartido por productores reconocidos del panorama electrónico. Incluye materiales y certificado.";
        $event->address = 'Espacio Sonido Valencia, Ruzafa';
        $event->startDate = '2025-10-19';
        $event->startTime = '10:00:00';
        $event->endDate = '2025-10-19';
        $event->endTime = '17:00:00';
        $event->paymentType = 'paid';
        $event->price = 45.00;
        $event->image = 'events/music-9297613_640.jpg';
        $event->community = 'Comunitat Valenciana';
        $event->category_id = 3; // educación
        $event->user_id = 2;
        $event->save();

        // Evento 6: Noche de Ópera: Carmen en el Teatro Real
        $event = new Event();
        $event->name = 'Noche de Ópera: Carmen en el Teatro Real';
        $event->description = "Una de las óperas más emblemáticas llega con una escenografía y dirección musical de primer nivel. Función única con acceso a ensayo general para entradas premium.";
        $event->address = 'Teatro Real de Madrid';
        $event->startDate = '2025-11-12';
        $event->startTime = '20:00:00';
        $event->endDate = '2025-11-12';
        $event->endTime = '23:00:00';
        $event->paymentType = 'paid';
        $event->price = 75.00;
        $event->image = 'events/opera.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 4; // ocio
        $event->user_id = 2;
        $event->save();

        // Evento 7: Torneo Nacional de Pádel por Equipos
        $event = new Event();
        $event->name = 'Torneo Nacional de Pádel por Equipos';
        $event->description = "Competencia de alto nivel con equipos de toda España. Eliminatorias, finales y premios. Zona de espectadores con animación y food trucks. Entrada libre con inscripción anticipada.";
        $event->address = 'Club de Pádel La Moraleja, Madrid';
        $event->startDate = '2025-09-28';
        $event->startTime = '09:00:00';
        $event->endDate = '2025-09-28';
        $event->endTime = '18:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/padel.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();

        // Evento 8: Paddle Surf al Atardecer
        $event = new Event();
        $event->name = 'Paddle Surf al Atardecer';
        $event->description = "Actividad guiada en la costa alicantina con paddle surf, relajación y cierre con zumos naturales y snacks saludables. Incluye tabla, monitor y seguro.";
        $event->address = 'Playa de San Juan, Alicante';
        $event->startDate = '2025-08-22';
        $event->startTime = '19:00:00';
        $event->endDate = '2025-08-22';
        $event->endTime = '21:30:00';
        $event->paymentType = 'paid';
        $event->price = 25.00;
        $event->image = 'events/padelsurf-2764674_640.jpg';
        $event->community = 'Comunitat Valenciana';
        $event->category_id = 7; // bienestar
        $event->user_id = 2;
        $event->save();

        // Evento 9: Visita al Museo de Paleontología Natural
        $event = new Event();
        $event->name = 'Visita al Museo de Paleontología Natural';
        $event->description = "Descubre esqueletos originales y fósiles de especies milenarias. Actividades interactivas para todas las edades y charlas con expertos en biodiversidad extinta.";
        $event->address = 'Museo de Ciencias Naturales, Valencia';
        $event->startDate = '2025-10-10';
        $event->startTime = '11:00:00';
        $event->endDate = '2025-10-10';
        $event->endTime = '14:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/paleontologymuseum.jpg';
        $event->community = 'Comunitat Valenciana';
        $event->category_id = 3; // educación
        $event->user_id = 2;
        $event->save();

        // Evento 10: GP España - Carrera Turismo ADAC
        $event = new Event();
        $event->name = 'GP España - Carrera Turismo ADAC';
        $event->description = "Vive la adrenalina del circuito con esta competencia de turismos. Zona paddock, acceso a boxes y experiencia VR para los asistentes. Evento familiar y apasionante.";
        $event->address = 'Circuito del Jarama, Madrid';
        $event->startDate = '2025-11-09';
        $event->startTime = '08:30:00';
        $event->endDate = '2025-11-09';
        $event->endTime = '17:00:00';
        $event->paymentType = 'paid';
        $event->price = 40.00;
        $event->image = 'events/racecar.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();


        // Evento 1: Banquete Floral de Invierno
        $event = new Event();
        $event->name = 'Banquete Floral de Invierno';
        $event->description = "Una cena temática en un entorno romántico con decoración floral, música instrumental y menú gourmet maridado con vinos de autor. Solo con reserva anticipada.";
        $event->address = 'Finca La Encantada, Toledo';
        $event->startDate = '2025-11-15';
        $event->startTime = '20:00:00';
        $event->endDate = '2025-11-15';
        $event->endTime = '23:30:00';
        $event->paymentType = 'paid';
        $event->price = 85.00;
        $event->image = 'events/restaurant.jpg';
        $event->community = 'Castilla-La Mancha';
        $event->category_id = 5; // gastronomía
        $event->user_id = 2;
        $event->save();

        // Evento 2: Maratón Popular de Zaragoza
        $event = new Event();
        $event->name = 'Maratón Popular de Zaragoza';
        $event->description = "Corre por las principales calles de Zaragoza en esta edición abierta del maratón. Tres modalidades: 10K, 21K y 42K. Zona de avituallamiento, música y premios.";
        $event->address = 'Plaza del Pilar, Zaragoza';
        $event->startDate = '2025-11-18';
        $event->startTime = '08:30:00';
        $event->endDate = '2025-11-18';
        $event->endTime = '14:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/running.jpg';
        $event->community = 'Aragón';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();

        // Evento 3: Inmersión Guiada - Bajo el Mediterráneo
        $event = new Event();
        $event->name = 'Inmersión Guiada - Bajo el Mediterráneo';
        $event->description = "Descubre la biodiversidad marina con esta experiencia de buceo para principiantes y nivel medio. Monitor profesional, equipo incluido y fotografías submarinas.";
        $event->address = 'Centro de Buceo Cabo de Palos, Cartagena';
        $event->startDate = '2025-11-21';
        $event->startTime = '10:00:00';
        $event->endDate = '2025-11-21';
        $event->endTime = '13:00:00';
        $event->paymentType = 'paid';
        $event->price = 45.00;
        $event->image = 'events/scubadiving.jpg';
        $event->community = 'Región de Murcia';
        $event->category_id = 8; // naturaleza
        $event->user_id = 2;
        $event->save();

        // Evento 4: Curso de Costura Creativa
        $event = new Event();
        $event->name = 'Curso de Costura Creativa';
        $event->description = "Aprende a confeccionar tus propios diseños con técnicas básicas y patrones. Materiales incluidos. Grupos reducidos y asesoría personalizada.";
        $event->address = 'Espacio Textil La Aguja, Valencia';
        $event->startDate = '2025-11-24';
        $event->startTime = '17:00:00';
        $event->endDate = '2025-11-24';
        $event->endTime = '20:00:00';
        $event->paymentType = 'paid';
        $event->price = 30.00;
        $event->image = 'events/sewingclas.jpg';
        $event->community = 'Comunitat Valenciana';
        $event->category_id = 3; // educación
        $event->user_id = 2;
        $event->save();

        // Evento 5: Taller de Lengua de Signos para Principiantes
        $event = new Event();
        $event->name = 'Taller de Lengua de Signos para Principiantes';
        $event->description = "Iniciación a la lengua de signos española. Ideal para profesores, familiares de personas sordas o cualquier persona interesada en comunicarse de forma inclusiva.";
        $event->address = 'Centro Cívico Fuensanta, Córdoba';
        $event->startDate = '2025-11-27';
        $event->startTime = '18:00:00';
        $event->endDate = '2025-11-27';
        $event->endTime = '20:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/signclass.jpg';
        $event->community = 'Andalucía';
        $event->category_id = 3; // educación
        $event->user_id = 2;
        $event->save();

        // Evento 6: Vóley Sunset - Torneo Playero
        $event = new Event();
        $event->name = 'Vóley Sunset - Torneo Playero';
        $event->description = "Competición mixta en pistas exteriores junto al mar. Música en vivo al atardecer, foodtrucks y premios para los mejores equipos. Ambiente chill y deportivo.";
        $event->address = 'Playa de la Barceloneta, Barcelona';
        $event->startDate = '2025-11-30';
        $event->startTime = '16:00:00';
        $event->endDate = '2025-11-30';
        $event->endTime = '21:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/sunset-5383040_640.jpg';
        $event->community = 'Cataluña';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();

        // Evento 7: Surf Urbano en Piscina de Olas
        $event = new Event();
        $event->name = 'Surf Urbano en Piscina de Olas';
        $event->description = "Si siempre quisiste surfear, esta es tu oportunidad. Clases en piscina con olas artificiales para todos los niveles. Tablas incluidas.";
        $event->address = 'Citywave Madrid, Centro Comercial X-Madrid';
        $event->startDate = '2025-12-03';
        $event->startTime = '11:00:00';
        $event->endDate = '2025-12-03';
        $event->endTime = '14:00:00';
        $event->paymentType = 'paid';
        $event->price = 20.00;
        $event->image = 'events/surfing-817967_640.jpg';
        $event->community = 'Comunidad de Madrid';
        $event->category_id = 9; // deportes
        $event->user_id = 2;
        $event->save();

        // Evento 8: Teatro en Silencio: Experiencia Sensorial
        $event = new Event();
        $event->name = 'Teatro en Silencio: Experiencia Sensorial';
        $event->description = "Una obra sin palabras que mezcla expresión corporal, música y luz para estimular emociones sin lenguaje verbal. Experiencia inclusiva y artística.";
        $event->address = 'Teatre Grec, Barcelona';
        $event->startDate = '2025-12-06';
        $event->startTime = '19:30:00';
        $event->endDate = '2025-12-06';
        $event->endTime = '21:00:00';
        $event->paymentType = 'paid';
        $event->price = 16.00;
        $event->image = 'events/theater.jpg';
        $event->community = 'Cataluña';
        $event->category_id = 1; // arte
        $event->user_id = 2;
        $event->save();

        // Evento 9: Teatro Clásico en Ruinas Romanas
        $event = new Event();
        $event->name = 'Teatro Clásico en Ruinas Romanas';
        $event->description = "Representación de una tragedia griega bajo las estrellas. Disfruta de teatro al aire libre en uno de los yacimientos romanos mejor conservados del país.";
        $event->address = 'Teatro Romano de Mérida';
        $event->startDate = '2025-12-09';
        $event->startTime = '21:00:00';
        $event->endDate = '2025-12-09';
        $event->endTime = '23:00:00';
        $event->paymentType = 'paid';
        $event->price = 22.00;
        $event->image = 'events/theatreancient.jpg';
        $event->community = 'Extremadura';
        $event->category_id = 1; // arte
        $event->user_id = 2;
        $event->save();

        // Evento 10: Trenecito Turístico de Navidad
        $event = new Event();
        $event->name = 'Trenecito Turístico de Navidad';
        $event->description = "Disfruta de un recorrido navideño por el centro histórico de la ciudad con paradas en los principales mercadillos y decoración iluminada. Para toda la familia.";
        $event->address = 'Plaza Mayor, Salamanca';
        $event->startDate = '2025-12-12';
        $event->startTime = '17:00:00';
        $event->endDate = '2025-12-12';
        $event->endTime = '20:00:00';
        $event->paymentType = 'free';
        $event->price = 0;
        $event->image = 'events/traincitytour.jpg';
        $event->community = 'Castilla y León';
        $event->category_id = 4; // ocio
        $event->user_id = 2;
        $event->save();




    }
}

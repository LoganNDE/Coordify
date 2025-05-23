<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Routing\Controller;

class QRCodeController extends Controller
{
    public static function generate($data)
    {
        $qr = QrCode::format('png')
            ->size(300)
            ->backgroundColor(55, 54, 67)
            ->color(24, 203, 150)
            ->margin(2)
            ->style('round')
            ->eye('circle')
            ->errorCorrection('H')
            ->format('png')
            ->merge(public_path('img/default.png'), 0.3, true)
            ->generate($data);
        return $qr;
    }

    public function QRValidate(Request $request){
        
        $receivedQR = $request->input('hash');
        if (isset($receivedQR)){
            $participant =  Participant::where('qr_decode', $receivedQR)->first();

            if ($participant){

                if ($participant->status == "pending"){
                    
                    $participant->status = "accepted";
                    $participant->qr_scanned_at = now();
                    $participant->save();
    
                    return response()->json([
                        'status' => 'ok',
                        'data' => $participant,
                    ]);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'data' => "scanned",
                    ], 404);
                }

            }else{
                return response()->json([
                    'status' => 'error',
                    'data' => "Participante no encotnrado o QR inválido",
                ], 404);
            }
    
        }

    }
}

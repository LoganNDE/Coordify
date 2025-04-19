<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public static function generate($data)
    {
        $qr = QrCode::format('png')
            ->size(300)
            ->backgroundColor(255, 255, 0)
            ->color(0, 0, 255)
            ->margin(2)
            ->style('round')
            ->eye('circle')
            ->errorCorrection('H')
            ->format('png')
            ->merge(public_path('img/default.png'), 0.3, true)
            ->generate('https://google.com');
        return $qr;
    }
}

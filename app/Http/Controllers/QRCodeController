<?php

namespace App\Http\Controllers;

use App\QRCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QRCodeController extends Controller
{
    public function rastreio($codigo)
    {
        $qrcode = QRCode::where('ds_hash_qrc',$hash)->first();
        $qrcode->nu_acessos_qrc = $qrcode->nu_acessos_qrc + 1;
        $qrcode->save();        

        return redirect($qrcode->ds_link_qrc); 
    }
}
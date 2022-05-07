<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('firebase');
    }

    function sendNotification(){
        $token = "f0dBCTJw_uA:APA91bEviGi8NQETNg9n1fKqyAgmdGyYleyMv_oeXaesOXJUMmMebOTcCM5l-Kg2onyU0N0JfaQuZFkEy57svsIEEvMCMEuU7QuM_J2ciQjNPF04rLNWh72m0H5woDx65ghFF4nXmtLJ";
        $from = "AAAAJ4f0eC4:APA91bGvQwxJK2z5vw19KdFcikcWfk0trwtc-7O6R1CFy6_rAxAEmdV7dFpNt2vViuuR9YnWsCmhxznTKpIEfIJEWiQkIS15BHBVKEniaIve2Wt1uOsdaRw_YALxx9wH30EBKp2xu0GN";
        $msg = array
        (
            'body'  => "Notification body",
            'title' => "Notification title",
            'receiver' => 'erw',
            'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'        => $token,
            'notification'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $from,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    }

}

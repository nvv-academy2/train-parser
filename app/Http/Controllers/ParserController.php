<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function parse()
    {
        $cities = City::all()->toArray();
        return view("main", ['cities' => $cities]);
    }

    public function search(Request $request) {

        $ch = curl_init();

        $data = [
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'date' =>  $request->input('date'),
            'time' => '00:00'
        ];

        curl_setopt($ch, CURLOPT_URL,"https://booking.uz.gov.ua/ru/train_search/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        return response($server_output, 200, ['Content-Type' => 'application/json']);

    }
}

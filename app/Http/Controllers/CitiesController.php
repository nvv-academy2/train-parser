<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 19.09.2018
 * Time: 19:41
 */

namespace App\Http\Controllers;


use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{

    public function get(Request $request)
    {
        $search = urlencode(urldecode($request->input('search')));
        $url = "https://booking.uz.gov.ua/ru/train_search/station/?term=$search";
        $res = file_get_contents($url);
        return response($res, 200, ['Content-Type' => 'application/json']);
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        $model = new City();
        $model->name = $request->input('name');
        $model->code = $request->input('code');
        $model->save();
        return redirect('/parser');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
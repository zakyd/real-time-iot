<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Value;

class ValueController extends Controller
{
    public function add(Request $request)
    {
        if ($request->has('temperature') && $request->has('humidity') && $request->temperature!="nan" && $request->humidity!="nan") {
            $value = new Value();

            $value->temperature = floatval($request->temperature);
            $value->humidity = floatval($request->humidity);
            $value->save();
            echo "success";
        }
        else {
            echo "failure";
        }
    }

    public function view()
    {
        $data['values'] = Value::orderBy('created_at', 'desc')->take(10)->get();
        $data['last'] = $data['values']->first();
        foreach ($data['values'] as $v) {
            $xdate[] = $v['created_at']->toDateTimeString(); 
            $xtemperature[] = $v['temperature'];
            $xhumidity[] = $v['humidity'];
        }
        for ($i=sizeof($xdate)-1; $i >= 0; $i--) { 
            $date[] = $xdate[$i];
            $temperature[] = $xtemperature[$i];
            $humidity[] = $xhumidity[$i];
        }
        
        $data['date'] = $date;
        $data['temperature'] = $temperature;
        $data['humidity'] = $humidity;
        
        return view('viewvalues',$data);
    }

    public function request(Request $request)
    {
        header("Content-type: text/json");
        $value = Value::all();
        foreach ($value as $v) {
            if($request->lasttime<$v['created_at']){
                echo json_encode($v);
                return;
            }
        }
        return;
    }
}

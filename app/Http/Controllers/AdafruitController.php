<?php

namespace App\Http\Controllers;

use App\Models\humedad;
use App\Models\temperatura;
use App\Models\ultrasonico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AdafruitController extends Controller
{
    //Inserts
    public function RegistrarTemp(Request $request)
    {
      $response=Http::withHeaders([
        'X-AIO-KEY'=>'aio_keAb05CNmGH52i1e2fz4q3MJsGjV'
      ])->get('https://io.adafruit.com/api/v2/GuarU345/feeds/temperatura');
        
   $valor=json_decode($response,true);
  $valor2=json_decode($response,true);
  DB::insert('insert into datostemp(valorTemp,fecha) values(?,?)',[$valor['last_value'],$valor2['created_at']]);
  $resultado=$valor['last_value'];
  $resultado1=$valor2['created_at'];
  
  return array($resultado,$resultado1);          
    }
    public function RegistrarHum(Request $request)
    {
      $response=Http::withHeaders([
        'X-AIO-KEY'=>'aio_keAb05CNmGH52i1e2fz4q3MJsGjV'
      ])->get('https://io.adafruit.com/api/v2/GuarU345/feeds/humedad');
   
   $valor=json_decode($response,true);
  $valor2=json_decode($response,true);
  DB::insert('insert into datoshum(valorHum,fecha) values(?,?)',[$valor['last_value'],$valor2['created_at']]);
  $resultado=$valor['last_value'];
  $resultado1=$valor2['created_at'];
  return array($resultado,$resultado1);
  }
  public function RegistrarUltra(Request $request)
    {
      $response=Http::withHeaders([
        'X-AIO-KEY'=>'aio_keAb05CNmGH52i1e2fz4q3MJsGjV'
      ])->get('https://io.adafruit.com/api/v2/GuarU345/feeds/ultrasonico');
   
   $valor=json_decode($response,true);
  $valor2=json_decode($response,true);
  DB::insert('insert into datosultra(valorUltra,fecha) values(?,?)',[$valor['last_value'],$valor2['created_at']]);
  $resultado=$valor['last_value'];
  $resultado1=$valor2['created_at'];
  return array($resultado,$resultado1);
  }
  public function RegistrarLed(Request $request)
  {
    $response=Http::withHeaders([
      'X-AIO-KEY'=>'aio_keAb05CNmGH52i1e2fz4q3MJsGjV'
    ])->get('https://io.adafruit.com/api/v2/GuarU345/feeds/led');
 
 $valor=json_decode($response,true);
$valor2=json_decode($response,true);
DB::insert('insert into datosled(valorLed,fecha) values(?,?)',[$valor['last_value'],$valor2['created_at']]);
$resultado=$valor['last_value'];
$resultado1=$valor2['created_at'];
return array($resultado,$resultado1);
    }
//Consultas
public function consulta1()
  {
    return temperatura::Select('valorTemp','fecha')->orderBy('id', 'DESC')->first();
  }
  public function consulta2()
  {
    return humedad::Select('valorHum','fecha')->orderBy('id', 'DESC')->first();
  }
  public function consulta3()
  {
    return ultrasonico::Select('valorUltra','fecha')->orderBy('id', 'DESC')->first();
  }
public function ConsultaTemp(){
    $temperatura = DB::table('datostemp')->min('datostemp.valorTemp');
        return response()->json(["valor"=>$temperatura]);   
}
public function ConsultaTemp2(){
    $temperatura = DB::table('datostemp')->max('datostemp.valorTemp');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaTemp3(){
    $temperatura = DB::table('datostemp')->avg('datostemp.valorTemp');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaHum(){
    $temperatura = DB::table('datoshum')->max('datoshum.valorHum');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaHum2(){
    $temperatura = DB::table('datoshum')->min('datoshum.valorHum');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaUltra(){
    $temperatura = DB::table('datosultra')->max('datosultra.valorUltra');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaUltra2(){
    $temperatura = DB::table('datosultra')->avg('datosultra.valorUltra');
        return response()->json(["valor"=>$temperatura]);
    
}
public function ConsultaLed(){
    $temperatura = DB::table('datosled')->count('datosled.valorLed');
        return response()->json(["valor"=>$temperatura]);
    
}
}

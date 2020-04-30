<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\{Business};
use App\Http\Resources\BusinessResource;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function store()
    {
        
        $validator = Validator::make(request()->all(), [
            'file' =>'required|mimes:jpg,jpeg,png,bmp|max:20000',
            'business_name' => 'required',
            'address' => 'required',
            'short_name' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'verifica la informacióna',
                'errors'=> $validator->messages()
            ], 422);
        }

        if (request()->hasFile('file')){

            $file = request()->file('file');
            $name_short = str_replace(' ', '', request()->short_name);
            $business = Business::create([
                'business_name' => request()->business_name,
                'address' => request()->address,
                'short_name' => $name_short,
                'file' => 'temp'
            ]);
            $id_business = $business->fresh()->id;
            $name_file = str_replace(' ', '_', $file->getClientOriginalName());
            $name_file =  preg_replace("/[^a-zA-Z0-9.]/", "", $name_file);
            $path = 'logo_negocio/'. $id_business . '/' .$name_file;
            \Storage::disk('local')->put($path,  \File::get($file));
            $business->file = $path;
            $business->save();

        }

        return response()->json([
            'message'=>'Negocio agregado',
            'errors'=> '',
            'business' => $business
        ], 200);

    }

    public function show()
    {

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $order = (request()->has('sort') && request()->sort != null) ? explode("|", request()->sort) : null;
        $nombre = $order != null ? $order[0] : 'created_at';
        $orderBy = $order != null ? $order[1] : 'DESC';

        $business = Business::orderBy($nombre, $orderBy)
                            ->paginate($perPage);

        return BusinessResource::collection($business);

    }

    public function update(Business $busines)
    {

        $validator = Validator::make(request()->all(), [
            'business_name' => 'required',
            'address' => 'required',
            'short_name' => 'required|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'verifica la información',
                'errors'=> $validator->messages()
            ], 422);
        }

        $busines->update(request()->all());

        return response()->json([
            'message'=>'Se Actualizo corretamente',
            'errors'=> '',
            'business' => $busines
        ], 200);

    }

    public function destroy(Business $busines)
    {
        
        $busines->delete();
        $business = Business::all();
        return response()->json([
            'business' => $business,
            'errors'=> ''
        ], 200);

    }

    public function ejercicio_one()
    {

        $cadena = camel_case(request()->cadena);

        return response()->json([
            'message'=>'',
            'errors'=> '',
            'cadena' => $cadena
        ], 200);        

    }

    public function ejercicio_three()
    {

        $datos = [
            "apple",
            ["banana", "strawberry", "apple"],
            ["banana", ["apple"]]
        ];

        $array_three = substr_count($datos, request()->array_three);

        return response()->json([
            'message'=>'',
            'errors'=> '',
            'array_three' => $array_three
        ], 200);        

    }

}

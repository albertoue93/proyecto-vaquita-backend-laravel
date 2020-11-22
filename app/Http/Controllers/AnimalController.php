<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Animal;
use DB;

class AnimalController extends Controller
{
    private $status = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $animales = DB::select('SELECT a.*, f.nombreFinca FROM animales AS a 
        INNER JOIN fincas AS f ON a.finca_id = f.id');
        
        if(count($animales) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($animales), "data" => $animales]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animales = DB::select('SELECT a.numeroAnimal, a.raza,a.peso,a.foto,a.updated_at FROM animales AS a 
        where a.estado="vendido"');
        
        if(count($animales) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($animales), "data" => $animales]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),
        [
            "numeroAnimal"  => "required",
            "raza"  => "required",
            "peso"  => "required",
            "edad"  => "required",
            "foto"  => "required",
            "finca_id"  => "required"
        ]
    );

    // if validation fails
    if($validator->fails()) {
        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
    }

    $animal_id = $request->id;
     $animalArray = array(
        "numeroAnimal"  => $request->numeroAnimal,
        "raza"  => $request->raza,
        "peso"  => $request->peso,
        "edad"  => $request->edad,
        "foto"  => $request->foto,
        "finca_id"  => $request->finca_id
    );

    if($animal_id !="") {           
        $animal = Animal::find($animal_id);
        if(!is_null($animal)){
            $updated_status = Animal::where("id", $animal_id)->update($animalArray);
            if($updated_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "animal detail updated successfully"]);
            }
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! failed to update, try again."]);
            }               
        }                   
    }

    else {
        $animal = Animal::create($animalArray);
        if(!is_null($animal)) {            
            return response()->json(["status" => $this->status, "success" => true, "message" => "animal record created successfully", "data" => $animal]);
        }    
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $animal = Animal::find($id);
        if(!is_null($animal)) {
            return response()->json(["status" => $this->status, "success" => true, "data" => $animal]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! animal not found"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $animal = Animal::find($id);
        if(!is_null($animal)) {
            $delete_status = Animal::where("id", $id)->delete();
            if($delete_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "animal record deleted successfully"]);
            }
            else{
                return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
            }
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! animal not found with this id"]);
        }
    }

    public function destroy2(Request $request)
    {
        //
        $ids = $request->ids;
        foreach($ids as $id){
            $delete_status = Animal::where('id',$id)->delete();
        }
        
        return response()->json(["message" => "animal record deleted successfully"],200);

    }

    public function updateStatus(Request $request)
    {
        //
        $ids = $request->ids;
        foreach($ids as $id){
            $delete_status = Animal::find($id)->update(['estado' => 'vendido']);
        }
        
        return response()->json(["message" => "animal record updateted successfully"],200);

    }
}

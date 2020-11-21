<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Finca;
use JWTAuth;

class FincaController extends Controller
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
        //return Finca::all();
        $fincas = Finca::all();
        if(count($fincas) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($fincas), "data" => $fincas]);
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
        //
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
        // validate inputs
        $validator = Validator::make($request->all(),
            [
                "nombreFinca" => "required"
            ]
        );

        // if validation fails
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $finca_id = $request->id;
         $fincaArray = array(
            "nombreFinca" => $request->nombreFinca
        );

        if($finca_id !="") {           
            $finca = Finca::find($finca_id);
            if(!is_null($finca)){
                $updated_status = Finca::where("id", $finca_id)->update($fincaArray);
                if($updated_status == 1) {
                    return response()->json(["status" => $this->status, "success" => true, "message" => "finca detail updated successfully"]);
                }
                else {
                    return response()->json(["status" => "failed", "message" => "Whoops! failed to update, try again."]);
                }               
            }                   
        }

        else {
            $finca = Finca::create($fincaArray);
            if(!is_null($finca)) {            
                return response()->json(["status" => $this->status, "success" => true, "message" => "finca record created successfully", "data" => $finca]);
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
        $finca = Finca::find($id);
        if(!is_null($finca)) {
            return response()->json(["status" => $this->status, "success" => true, "data" => $finca]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! finca not found"]);
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
        $finca = Finca::find($id);
        if(!is_null($finca)) {
            $delete_status = Finca::where("id", $id)->delete();
            if($delete_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "finca record deleted successfully"]);
            }
            else{
                return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
            }
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! finca not found with this id"]);
        }
    }

    public function destroy2(Request $request)
    {
        //
        $ids = $request->ids;
        foreach($ids as $id){
            $delete_status = Finca::where('id',$id)->delete();
        }
       
        return response()->json(["message" => "finca record updateted successfully"],200);

    }
}

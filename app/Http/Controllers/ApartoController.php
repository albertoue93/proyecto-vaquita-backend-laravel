<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Aparto;

class ApartoController extends Controller
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
        $apartos = Aparto::all();
        if(count($apartos) > 0) {
            return response()->json(["status" => $this->status, "success" => true, "count" => count($apartos), "data" => $apartos]);
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
        $validator = Validator::make($request->all(),
            [
                "numeroAparto" => "required",
                "mts2" => "required",
                "finca_id" => "required"
            ]
        );

        // if validation fails
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $aparto_id = $request->id;
         $apartoArray = array(
            "numeroAparto" => $request->numeroAparto,
            "mts2" => $request->mts2,
            "finca_id" => $request->finca_id
        );

        if($aparto_id !="") {           
            $aparto = Aparto::find($aparto_id);
            if(!is_null($aparto)){
                $updated_status = Aparto::where("id", $aparto_id)->update($apartoArray);
                if($updated_status == 1) {
                    return response()->json(["status" => $this->status, "success" => true, "message" => "aparto detail updated successfully"]);
                }
                else {
                    return response()->json(["status" => "failed", "message" => "Whoops! failed to update, try again."]);
                }               
            }                   
        }

        else {
            $aparto = Aparto::create($apartoArray);
            if(!is_null($aparto)) {            
                return response()->json(["status" => $this->status, "success" => true, "message" => "aparto record created successfully", "data" => $aparto]);
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
        $aparto = Aparto::find($id);
        if(!is_null($aparto)) {
            return response()->json(["status" => $this->status, "success" => true, "data" => $aparto]);
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
        $aparto = Aparto::find($id);
        if(!is_null($aparto)) {
            $delete_status = Aparto::where("id", $id)->delete();
            if($delete_status == 1) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "aparto record deleted successfully"]);
            }
            else{
                return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
            }
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! finca not found with this id"]);
        }
    }
}

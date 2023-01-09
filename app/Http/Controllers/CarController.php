<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use DataTables;

class CarController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        if ($request->ajax()) {
  
            $data = Car::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn fw-bold btn-warning btn-md editCar">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn fw-bold btn-danger btn-md deleteCar">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])

                    ->editColumn('created_at', function ($data) {
                        return $data->created_at;
                    })

                    ->editColumn('updated_at', function ($data) {
                        return $data->updated_at;
                    })
                    ->make(true);

        }
        
        return view('car');
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Car::updateOrCreate([
                    'id' => $request->car_id
                ],
                [
                    'brand' => $request->brand, 
                    'model' => $request->model,
                    'color' => $request->color,
                    'type' => $request->type,
                    'quantity' => $request->quantity,

                ]);        
     
        return response()->json(['success'=>'Car saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return response()->json($car);
    } 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::find($id)->delete();
      
        return response()->json(['success'=>'Car deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class calculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
return view('calculator');


    }



    public function calculate(Request $request){
        $datarequest=$request->all(); 

        $data = [];
        
        $validator=Validator::make($datarequest,[

'p_price' => 'required|integer',
'd_price' => 'required|integer',
'r_time' => 'required|integer',
'i_rate' => 'required|numeric|between:0,9999.9999',
        ]); 

if($validator->passes()){
// formula for calculating EMI E = P x R x (1+r)^n/((1+r)^N – 1

// R is 7.2% = 7.2/12/100 = 0.006

// EMI = Rs 10,00,000 * 0.006 * (1 + 0.006)120 / ((1 + 0.006)120 – 1) = Rs 11,714.

$loan_amount = ($request->p_price) - ($request->d_price);
$months = ($request->r_time) * 12;

$rate_of_intrest = ($request->i_rate/(12*100));

//  emi = (p * r * pow(1 + r, t)) / (pow(1 + r, t) - 1);


$EMI = ($loan_amount * $rate_of_intrest * POW(1 + $rate_of_intrest, $months)) / (POW(1 + $rate_of_intrest, $months) - 1);

    $data['status']='success';
    $data['loan_amount']=$loan_amount;
    $data['EMI']=round($EMI);

    return response()->json($data);
}

else{
    return response()->json(['error' => $validator->errors()]);
}

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

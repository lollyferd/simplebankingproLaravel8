<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\loantype;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\customer_detail;


class LoanController extends Controller
{
public function addloantype(Request $request){

    $field = $request->validate([
            'loantype' => 'required|string|max:255',
    ]);

    $row = DB::table('loantypes')
            ->where('loantype', '=', $request->loantype)
            ->count();

            if($row >= 1){
                $out ="<p style='color:red'>Loan type already exit</p>";
            
            }else{

   $output = DB::table('loantypes')->insert([
                'loantype' => $field['loantype'],
                'user' => Auth::user()->name,
                // 'created_at' => Carbon::now()->addHours(1),
                'created_at' => Carbon::now(),
                'updated_at' => now()
               
    ]);

    if($output==true){

        $out = 'Loan type successfully added';
       
    }else{

        $out = 'Loan type Failed';

    }
 
}

  
return response()->json([
                                
    'result1' => $out,

]); 
  

}


public function loan(){
    $output = loantype::all();
    return view('admin.flatrateloan', compact('output'));
}



public function loandisplay(Request $request){
    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->acctnubanloan)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->acctnubanloan)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

   $out= DB::table('customer_details')
        ->where('nuban', '=', $request->acctnubanloan)
        ->update(['bal' => $bal]);
   
    $result = customer_detail::where('nuban', '=', $request->acctnubanloan)
                            ->where('status', '=', 'Active')
                            ->get();

   
    return response()->json([
        'myout' =>  $result,
    ]);
}


}

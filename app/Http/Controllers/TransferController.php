<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function transfer(){
        return view('admin.intratransfer');
    }

public function transferreceiver(Request $request){

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->receivernuban)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->receivernuban)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

 DB::table('customer_details')
        ->where('nuban','=',$request->receivernuban)
        ->update([
            'bal' => $bal,
            
        ]);

$output = DB::table('customer_details')
        ->where('nuban', '=', $request->receivernuban)
        ->get();

        return response()->json([
            'output' => $output
        ]);

}

public function transfersender(Request $request){

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->sendernuban)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->sendernuban)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

 DB::table('customer_details')
        ->where('nuban','=',$request->sendernuban)
        ->update([
            'bal' => $bal,
            
        ]);

$output = DB::table('customer_details')
        ->where('nuban', '=', $request->sendernuban)
        ->get();

    

        return response()->json([
            'output' => $output
        ]);

}

public function transferfunction(Request $request){

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->sendernuban)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->sendernuban)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

    if($bal > $request->senderamount){

        $Id = DB::table('transfers')
                    ->insertGetId([
                        'sendernuban' => $request->sendernuban,
                        'sendername' => $request->sendername,
                        'senderaccttype' => $request->senderaccttype,
                        'sentamt' => $request->senderamount,
                        'receivernuban' => $request->receivernuban,
                        'receivername' => $request->receivername,
                        'receiveraccttype' => $request->receiveraccttype,
                        'status' => 'successful',
                        'created_at' => Carbon::now(),
                        'updated_at' => now()
                    ]);

        //  $receiverId = DB::table('transfers')
        //             ->insertGetId([
        //                 'type' => 'RECEIVER',
        //                 'customerid' => $request->receivernuban,
        //                 'acctname' => $request->receivername,
        //                 'accttype' => $request->receiveraccttype,
        //                 'receivedamt' => $request->senderamount,
        //                 'status' => 'successful',
        //                 'created_at' => Carbon::now(),
        //                 'updated_at' => now() 
        //             ]);

    $transferId = 'TFR'.$Id;

    $trf = DB::table('transfers')
                    ->where('id','=', $Id )           
                    ->update([
                        'ref' =>$transferId
                    ]);
        if($trf==true){
            return redirect()->back()->with('message', 'Transfer Successful');
        }else{
            return redirect()->back()->with('message_failed', 'Transfer Failed');
        }


    }else{
        return redirect()->back()->with('message_warning', 'Insufficient account Balance');
    }


}

public function transferapproval(){
    $output = DB::table('transfers')
    ->where('status', '=', 'successful')
    ->get();

    return view('admin.transferapproval',compact('output'));
}


public function transferapprovaldisplay(Request $request){
        $output = DB::table('transfers')
                ->where('status', '=', 'successful')
                ->where('ref', '=', $request->reft)
                ->get();
 

        return response()->json([
            'out' => $output
         
        ]);
}



public function trfapproval(Request $request){
    $output = DB::table('transfers')
            ->where('ref','=',$request->reftrf)
            ->where('status','=','successful')
            ->get();

//  $outputreceiver = DB::table('transfers')
//             ->where('ref','=',$request->reftrf)
//             ->where('type','=','RECEIVER')
//             ->get();
   $balcredit = DB::table('ledgers')
            ->where('nuban', '=', $output[0]->sendernuban)
            ->where('deleted', '=', 'N')
            ->sum('credit');
        
  $baldebit = DB::table('ledgers')
            ->where('nuban', '=', $output[0]->sendernuban)
            ->where('deleted', '=', 'N')
            ->sum('debit');
        
            $bal =  $balcredit - $baldebit;
        
         DB::table('customer_details')
                ->where('nuban','=',$output[0]->sendernuban)
                ->update([
                    'bal' => $bal,
                    
                ]);
    $senderdetails = DB::table('customer_details')
                    ->where('nuban','=',$output[0]->sendernuban)
                    ->get();
    $receiverdetails = DB::table('customer_details')
                    ->where('nuban','=',$output[0]->receivernuban)
                    ->get();

if($bal >= $output[0]->sentamt && $request->status=='Approved'){
    $narration1='Transfer to '.$output[0]->receivername.'('.$request->reftrf.')';

	$narration2='Transfer from '.$output[0]->sendername.'('.$request->reftrf.')';

    DB::table('ledgers')->insert([
        'refno' => $output[0]->ref,
        'customerid' => $senderdetails[0]->customerid,
        'nuban' => $output[0]->sendernuban,
        'narration' => $narration1,
        'debit' => $output[0]->sentamt,
        'user' =>  Auth::user()->name,
        'status' => 'cash_tr',
        'created_at' => Carbon::now(),
        'updated_at' => now(),
       
  
    ]);

    DB::table('ledgers')->insert([
        'refno' => $output[0]->ref,
        'customerid' => $receiverdetails[0]->customerid,
        'nuban' => $output[0]->receivernuban,
        'narration' => $narration2,
        'credit' => $output[0]->sentamt,
        'user' =>  Auth::user()->name,
        'status' => 'cash_tr',
        'created_at' => Carbon::now(),
        'updated_at' => now(),
       
  
    ]);

$result = DB::table('transfers')
        ->where('ref','=',$output[0]->ref)
        ->update([
            'status' => $request->status,
             'updated_at' => now()
        ]);
if($result==true){
    return redirect()->back()->with('message', 'Transaction successfully Approved');
}else{
    return redirect()->back()->with('message_failed', 'Transaction Failed');
}

}else{
    $result = DB::table('transfers')
        ->where('ref','=',$output[0]->ref)
        ->update([
            'status' => $request->status,
             'updated_at' => now()
        ]);

        return redirect()->back()->with('message_warning', 'Transaction Rejected');
}
    
}

public function transferreversal(){
    return view('admin.transferreversal');
}



public function transferreversalf(Request $request){

    $result = DB::table("transfers")
            ->where('ref', '=', $request->reft)
            ->where('status', '=', 'Approved')
            ->get();
            

            return response()->json([
                "output" => $result,
            ]);

}


public function trfreversalfunction(Request $request){

    $result = DB::table('transfers')
    ->where('ref', '=', $request->reft)
    ->where('status', '=', 'Approved')
    ->count();
if($result > 0){
   

    $out = DB::table('transfers')
        ->where('ref','=', $request->reft)
        ->where('status','=', 'Approved')
        ->get();
 $ref=$out[0]->ref.'(RVD)';
	
$narration ='Transfer Reversed('.$out[0]->ref.')';
 
   


     $balcredit = DB::table('ledgers')
                ->where('nuban', '=', $out[0]->receivernuban)
                ->where('deleted', '=', 'N')
                ->sum('credit');
            
                $baldebit = DB::table('ledgers')
                ->where('nuban', '=', $out[0]->receivernuban)
                ->where('deleted', '=', 'N')
                ->sum('debit');
            
                $bal =  $balcredit - $baldebit;
            
             DB::table('customer_details')
                    ->where('nuban','=',$out[0]->receivernuban)
                    ->update([
                        'bal' => $bal,
                        
                    ]);
if($bal >= $out[0]->sentamt){

          $senderdetail = DB::table('customer_details')
                    ->where('nuban','=', $out[0]->sendernuban)
                    ->get();
       
    DB::table('ledgers')
        ->insert([
            'customerid' => $senderdetail[0]->customerid,
            'Refno' => $ref,
            'nuban' => $out[0]->sendernuban,
            'narration' => $narration,
            'credit' => $out[0]->sentamt,
            'user' => Auth::user()->name,
            'status' =>  'Reversed',
            'created_at' => Carbon::now(),
            'updated_at' => now()
        ]);
      
       
        $receiverdetail = DB::table('customer_details')
        ->where('nuban','=', $out[0]->receivernuban)
        ->get();

        
DB::table('ledgers')
->insert([
    'customerid' => $receiverdetail[0]->customerid,
    'Refno' => $ref,
    'nuban' => $out[0]->receivernuban,
    'narration' => $narration,
    'debit' => $out[0]->sentamt,
    'user' => Auth::user()->name,
    'status' =>  'Reversed',
    'created_at' => Carbon::now(),
    'updated_at' => now()
]);
    
$msg = DB::table('transfers')
->where('ref','=', $request->reft)
->update([
    'status' =>'Reversed'
]);

if($msg ==true){
    return redirect()->back()->with('message', 'Transfer reversal successful');
}else{
    return redirect()->back()->with('message_failed', 'Failed');
}
}else{
    return redirect()->back()->with('message_warning', 'Insufficient balance in account '.$out[0]->receivernuban);
}        

}else{
    return redirect()->back()->with('message_failed', 'Invalid Reference ID');
}
}

//***end of class transfer */

}

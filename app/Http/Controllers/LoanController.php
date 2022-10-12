<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\loantype;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\customer_detail;
use App\Models\loanbooking;
use App\Models\loanrepayment;

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
    //first deduction date
             $date = date_create($request->applydate); 
  
                            // Use date_add() function to add date object 
             date_add($date, date_interval_create_from_date_string('30 days')); 
                              
                            // Display the added date 
              $NewDate=date_format($date, "Y-m-d");

   
    return response()->json([
        'myout' =>  $result,
        'date' => $NewDate,
    ]);
}


public function loansubmitflat(Request $request){
    $request->validate([
        'loanrequest' => 'required',
]);
      //first deduction date
      $date = date_create($request->applydate); 
  
      // Use date_add() function to add date object 
date_add($date, date_interval_create_from_date_string('30 days')); 
        
      // Display the added date 
$NewDate=date_format($date, "Y-m-d");

//loan expiry date cal
$no=$request->period*30;


// Declare a date 
$date = date_create($request->applydate); 
  
// Use date_add() function to add date object 
date_add($date, date_interval_create_from_date_string($no.'days')); 
  
// Display the added date 
$loanexpdate=date_format($date, "Y-m-d");
		
//monthly int and principal cal


$intM=$request->loanrate/100*$request->loanrequest;

$intT=$intM*$request->period;


$mP=$request->loanrequest/$request->period;

if ($intT!='') {
    $totalrepay=$request->loanrequest*1+$intT;
  
  }

  $ending_bal=$request->loanrequest-$mP;

  $totalrepaydeduction = $mP + $intM;

    $id = DB::table('loanbookings')->insertGetId([
        'customerid' => $request->customerid,
        'nuban' => $request->acctnubanloan,
        'acctname' => $request->acctnameloan,
        'loantype' => $request->loantype,
        'method' => 'str_rate',
        'mid' => $intM,
        'mpd' => $mP,
        'tp' => $request->loanrequest,
        'totalint' => $intT,
        'totalmonth' => $request->period,
        'applicationdate' => $request->applydate,
        'firstdeductiondate' => $NewDate,
        'nextdeductiondate' => $NewDate,
        'deductionmain' => $NewDate,
        'loanexpdate' => $loanexpdate,
        'loanrate' => $request->loanrate,
        'totalrepayment' => $totalrepay,
        'loanpurpose' => $request->loanpurpose,
        'collateral' => $request->loancollateral,
        'status' => 'successful',
        

    ]);
    $ref="LBR/".$id;
	// $narration='Loan Booking [/'.$request->loanrate.'%/ '.$request->period.'month(s)]';

    DB::table('loanbookings')->where('id', '=', $id)
                                        ->update([
                                            'ref' => $ref,
                                            'status' => 'successful2',
                                        ]);

$deductionid = DB::table('loanrepayments')->insertGetId([
                                'loanid' => $id,
                                'customerid' => $request->customerid,
                                'nuban' => $request->acctnubanloan,
                                'repaydate' => $NewDate,
                                'deductionbal' => $request->loanrequest,
                                'principal' => $mP,
                                'int' => $intM,
                                'endingbal' => $ending_bal,
                                'cummulativeint' => $intM,
                                'totalrepay' => $totalrepaydeduction,
                                'method' => 'str_rate',
                                'rdstatus' => 'successful',
                                'created_at' => Carbon::now(),
                                 'updated_at' => now(),
                            ]);
                DB::table('loanrepayments')->where('id', '=', $deductionid)
                                            ->update([
                                                'ref' => $ref.'/ '.$deductionid,
                                            ]);

                  $a=1;

                 $times=$request->period-1;
                while ($a<=$times) {

                    $result = DB::table('loanrepayments') ->orderBy('id', 'desc')
                    ->get();

                    $repaydate2 = $result[0]->repaydate;

                    $loanamt2=$result[0]->deductionbal-$mP;

		//$intsingle2=$rate/100*$loanamt2;

		$ending_bal2=$result[0]->endingbal-$mP;

		$cummulative_int2=$result[0]->cummulativeint+$intM;

		$total_repay2=$mP+$intM;


	// Declare a date 
$date = date_create($repaydate2); 
  
// Use date_add() function to add date object 
date_add($date, date_interval_create_from_date_string('30 days')); 
  
// Display the added date 
$loanexpdate=date_format($date, "Y-m-d");

$deductionid2= DB::table('loanrepayments')->insertGetId([
    'loanid' => $id,
    'customerid' => $request->customerid,
    'nuban' => $request->acctnubanloan,
    'repaydate' => $loanexpdate,
    'deductionbal' => $loanamt2,
    'principal' => $mP,
    'int' => $intM,
    'endingbal' => $ending_bal2,
    'cummulativeint' => $cummulative_int2,
    'totalrepay' => $total_repay2,
    'method' => 'str_rate',
    'rdstatus' => 'successful',
    'created_at' => Carbon::now(),
    'updated_at' => now(),
]);
 $resultrow = DB::table('loanrepayments')->where('id', '=', $deductionid2)
                ->update([
                    'ref' => $ref.'/ '.$deductionid2,
                ]);


                    $a++;
                 }

    if( $deductionid ==true){
        return redirect()->back()->with('message', 'Loan record saved successfully with Ref No:'. $ref); 
    }else{
        return redirect()->back()->with('message_failed', 'Loan Failed'); 
    }
            
  
}


public function reducingloan(){
    $output = loantype::all();
       return view('admin.reducingballoan', compact('output'));
}

public function loansubmitreduce(Request $request){

   
    $request->validate([
        'loanrequest' => 'required',
        'loanrate' => 'required',
]);



          //first deduction date
          $date = date_create($request->applydate); 
  
          // Use date_add() function to add date object 
    date_add($date, date_interval_create_from_date_string('30 days')); 
            
          // Display the added date 
    $NewDate=date_format($date, "Y-m-d");
    
    //loan expiry date cal
    $no=$request->period*30;
    
    
    // Declare a date 
    $date = date_create($request->applydate); 
      
    // Use date_add() function to add date object 
    date_add($date, date_interval_create_from_date_string($no.'days')); 
      
    // Display the added date 
    $loanexpdate=date_format($date, "Y-m-d");
            
    //monthly int and principal cal
    
    
    $intM=$request->loanrate/100*$request->loanrequest;
    
    $intT=$intM*$request->period;
    
    
    $mP=$request->loanrequest/$request->period;
    
    if ($intT!='') {
        $totalrepay=$request->loanrequest*1+$intT;
      
      }
    
      $ending_bal=$request->loanrequest-$mP;
    
      $totalrepaydeduction = $mP + $intM;
    
        $id = DB::table('loanbookings')->insertGetId([
            'customerid' => $request->customerid,
            'nuban' => $request->acctnubanloan,
            'acctname' => $request->acctnameloan,
            'loantype' => $request->loantype,
            'method' => 'rdc_rate',
            'mid' => $intM,
            'mpd' => $mP,
            'tp' => $request->loanrequest,
            'totalmonth' => $request->period,
            'applicationdate' => $request->applydate,
            'firstdeductiondate' => $NewDate,
            'nextdeductiondate' => $NewDate,
            'deductionmain' => $NewDate,
            'loanexpdate' => $loanexpdate,
            'loanrate' => $request->loanrate,
            'totalrepayment' => $totalrepay,
            'loanpurpose' => $request->loanpurpose,
            'collateral' => $request->loancollateral,
            'status' => 'successful',
            
    
        ]);
        $ref="LBR_RD/".$id;
    
        DB::table('loanbookings')->where('id', '=', $id)
                                            ->update([
                                                'ref' => $ref,
                                                'status' => 'successful2',
                                                ]);



                                                $deductionid = DB::table('loanrepayments')->insertGetId([
                                                    'loanid' => $id,
                                                    'customerid' => $request->customerid,
                                                    'nuban' => $request->acctnubanloan,
                                                    'repaydate' => $NewDate,
                                                    'deductionbal' => $request->loanrequest,
                                                    'principal' => $mP,
                                                    'int' => $intM,
                                                    'endingbal' => $ending_bal,
                                                    'cummulativeint' => $intM,
                                                    'totalrepay' => $totalrepaydeduction,
                                                    'method' => 'rdc_rate',
                                                    'rdstatus' => 'successful',
                                                    'created_at' => Carbon::now(),
                                                    'updated_at' => now(),
                                                ]);
                                    DB::table('loanrepayments')->where('id', '=', $deductionid)
                                                                ->update([
                                                                    'ref' => $ref.'/ '.$deductionid,
                                                                ]);
                    
                                    $a=1;
                    


                                               
                                    $times=$request->period-1;
                                    while ($a<=$times) {
                    
                                        $result = DB::table('loanrepayments') ->orderBy('id', 'desc')
                                        ->get();
                    
                                        $repaydate2 = $result[0]->repaydate;
                    
                                        $loanamt2=$result[0]->deductionbal-$mP;
                    
                            $intsingle2=$request->loanrate/100*$loanamt2;
                    
                            $ending_bal2=$result[0]->endingbal-$mP;
                    
                            $cummulative_int2=$result[0]->cummulativeint+$intsingle2;
                    
                            $total_repay2=$mP+$intsingle2;
                    
                    
                        // Declare a date 
                    $date = date_create($repaydate2); 
                    
                    // Use date_add() function to add date object 
                    date_add($date, date_interval_create_from_date_string('30 days')); 
                    
                    // Display the added date 
                    $loanexpdate=date_format($date, "Y-m-d");
                    
                    $deductionid2= DB::table('loanrepayments')->insertGetId([
                        'loanid' => $id,
                        'customerid' => $request->customerid,
                        'nuban' => $request->acctnubanloan,
                        'repaydate' => $loanexpdate,
                        'deductionbal' => $loanamt2,
                        'principal' => $mP,
                        'int' => $intsingle2,
                        'endingbal' => $ending_bal2,
                        'cummulativeint' => $cummulative_int2,
                        'totalrepay' => $total_repay2,
                        'method' => 'rdc_rate',
                        'rdstatus' => 'successful',
                        'created_at' => Carbon::now(),
                        'updated_at' => now(),
                    ]);
                    DB::table('loanrepayments')->where('id', '=', $deductionid2)
                                    ->update([
                                        'ref' => $ref.'/ '.$deductionid2,
                                    ]);
                    
                    
                                        $a++;
                                    
                                }

                            $getinttotal = DB::table('loanrepayments')
                                            ->where('loanid', '=',$id)
                                            ->orderBy('id', 'desc')
                                            ->get();
                                    $totalpay = $getinttotal[0]->cummulativeint + $request->loanrequest;
                                DB::table('loanbookings')
                                    ->where('id','=', $id)
                                    ->update([
                                        'totalint' => $getinttotal[0]->cummulativeint,
                                        'totalrepayment' => $totalpay,
                                    ]);
                    
                        if( $deductionid ==true){
                            return redirect()->back()->with('message', 'Loan record saved successfully with Ref No:'.$ref); 
                        }else{
                            return redirect()->back()->with('message_failed', 'Loan Failed'.$php_errormsg); 
                        }
                                
                    
                    }
                    
                    public function loanapprovaldisplay(){
                    
                        $output = DB::table('loanbookings')
                                ->where('status', '=', 'successful2')
                                ->get();

                        return view('admin.loan_approval', compact('output'));
                    }

               


                    public function loanapprovaldisplaydetail(Request $req){
                        $result = DB::table('loanbookings')
                                ->where('ref', '=', $req->refloan)->get();
                    
                                return response()->json([
                                                    
                                    'myout' => $result,
                            
                               
                                    
                                ]);     
                    }




        public function loanapproval(Request $request){

            $result1 = DB::table('loanbookings')
                        ->where('ref', '=',$request->refaploan)
                        ->get();
        if($request->status == 'Rejected'){
            DB::table('loanbookings')
            ->where('ref', '=',$request->refaploan)
            ->update(['status' => $request->status]);
         return redirect()->back()->with('message_warning', 'Rejected successful with Ref: '.$request->refaploan);
         }if($request->status == 'Approved'){
           
         $narration='Loan Booking [/'.$result1[0]->loanrate.'%/ '.$result1[0]->totalmonth.'month(s)]';

         $nuban = $result1[0]->nuban;

         $customerid = $result1[0]->customerid;

         $loanamt = $result1[0]->tp;
         $loanid = $result1[0]->id;

         $user = Auth::user()->name;

         DB::table('ledgers')
            ->insert([
                'refno' => $request->refaploan,
                'customerid' => $customerid,
                'nuban' => $nuban,
                'narration' => $narration,
                'credit' => $loanamt,
                'status' => 'cash_tr',
                'user' => $user,
                'loanref' => $request->refaploan,
                'created_at' => Carbon::now(),
                'updated_at' => now(),

            ]);

           $result2 = DB::table('customer_details')
                ->where('nuban', '=', $nuban)
                ->get();

                $loanbal = $result2[0]->loanbal;

                $bal = $result2[0]->bal;

                $loanbalupdated = $loanbal + $result1[0]->totalrepayment;

                $balupdated = $bal + $result1[0]->totalrepayment;

                DB::table('customer_details')
                    ->where('nuban', '=', $nuban )
                    ->update([
                         'loanbal' =>  $loanbalupdated,
                        'bal' => $balupdated,
                    ]);

                DB::table('loanbookings')
                  ->where('ref', '=',$request->refaploan)
                  ->update(['status' => $request->status]);

                DB::table('loanrepayments')
                    ->where('loanid', '=', $loanid)
                    ->where('nuban', '=',$nuban )
                    ->update(['rdstatus' => $request->status]);

                    $glcode = DB::table('gl_creates')
                    ->where('glname', '=', 'Customer-Loan')
                    ->get();

                  DB::table('gl_ledgers')->insert([
                        'class_id' => $glcode[0]->classid,
                        'sub_class_id' => $glcode[0]->subclassid,
                        'gl_code' => $glcode[0]->gl_code,
                        'gl_name' => $glcode[0]->glname,
                        'narration' => $narration,
                        'debit' => $loanamt,
                        'status' => 'cash_tr',
                        'user' => Auth::user()->name,
                        'refno' =>  $request->refaploan,
                       
                    ]);

                    // $getinttotal = DB::table('loanrepayments')
                    // ->where('loanid', '=',$loanid)
                    // ->orderBy('id', 'desc')
                    // ->get();
            // $totalpay = $getinttotal[0]->cummulativeint + $request->loanrequest;

                    $glcode2 = DB::table('gl_creates')
                    ->where('glname', '=', 'Interest-In-Suspense')
                    ->get();

             DB::table('gl_ledgers')->insert([
                        'class_id' => $glcode2[0]->classid,
                        'sub_class_id' => $glcode2[0]->subclassid,
                        'gl_code' => $glcode2[0]->gl_code,
                        'gl_name' => $glcode2[0]->glname,
                        'narration' => $narration,
                        'debit' => $result1[0]->totalint,
                        'status' => 'cash_tr',
                        'user' => Auth::user()->name,
                        'refno' =>  $request->refaploan,
                       
                    ]);
            
                    return redirect()->back()->with('message', 'Approved successful with Ref: '.$request->refaploan);
                
                }else{
                    return redirect()->back()->with('message_failed', 'Loan Failed');
                }

        }
//PAST DUE REDUCING BALANACE........................

public function pastdueloan(){

    $result = DB::table('loanrepayments')
                    ->where('rdstatus', '!=', 'Approved')
                    ->where('rdstatus', '!=', 'successful')
                    ->where('rdstatus', '!=', '2')
                    ->where('rdstatus', '!=', '1')
                    ->get();
            foreach($result as $item){
             $int=$item->int;
			$principal=$item->principal;
			$nuban=$item->nuban;
			$ref=$item->ref;
			$rd_status=$item->rdstatus;
			$loanid=$item->loanid;
			$customerid=$item->customerid;


            $customerdetails = DB::table('customer_details')
            ->where('nuban', '=', $nuban)
            ->get();

            $loanbal = $customerdetails[0]->loanbal;
            $bal = $customerdetails[0]->bal;

            $loanbooking = DB::table('loanbookings')
            ->where('id', '=', $loanid)
            ->get();

            if ($bal >= $int && $loanbal!=0 && $item->rdstatus='I_Past_due' && $item->rdstatus!='P_Past_due') {

                $narrationint='Loan interest deduction Pastdue';

                  //loan interest past due is deducted from the customers acct ones the above conditions are met
                  $intid = DB::table('ledgers')->insertGetId([
                    'customerid' => $customerid,
                    'nuban' => $nuban,
                    'narration' => $narrationint,
                    'debit' => $int,
                    'user' => 'Auto_Tr',
                    'loanref' => $loanbooking[0]->ref,
                    'status' => 'cash_tr',
                    'created_at' => Carbon::now(),
                    'updated_at' => now(),

                ]);

                $refr="LD00/".$intid;

                DB::table('ledgers')
                  ->where('id', '=', $intid)
                  ->update([
                      'refno' => $refr,
                  ]);  


             //update loan bal on customer details table

             $updatedloanbal = $loanbal - $int;

             DB::table('customer_details')
                 ->where('nuban', '=', $nuban)
                 ->update([
                     'loanbal' =>  $updatedloanbal,
                 ]);
 
                 $narrationx='Loan interest Past Due deduction'.$intid;

                 $customer = DB::table('gl_creates')
                 ->where('glname', '=', 'Loan-Interest')
                 ->get();
         
                  DB::table('gl_ledgers')->insert([
                     'class_id' => $customer[0]->classid,
                     'sub_class_id' => $customer[0]->subclassid,
                     'gl_code' => $customer[0]->gl_code,
                     'gl_name' => $customer[0]->glname,
                     'narration' => $narrationx,
                     'credit' => $int,
                     'status' => 'Auto_Tr',
                     'user' => Auth::user()->name,
                     'refno' =>  $refr,
                    
                 ]);

                         ///here i will update the loan_booking table with the interest paid
       $IP = $loanbooking[0]->intpaid + $int;

       $iRm = $loanbooking[0]->totalint - $IP;

       DB::table('loanbookings')
           ->where('id', '=', $loanid)
           ->update([
               'intpaid' => $IP,
               'intremaining' => $iRm,
           ]);

           $balcredit = DB::table('ledgers')
           ->where('nuban', '=', $nuban)
           ->where('deleted', '=', 'N')
           ->sum('credit');

           $baldebit = DB::table('ledgers')
           ->where('nuban', '=', $nuban)
           ->where('deleted', '=', 'N')
           ->sum('debit');

   $bal =  $balcredit - $baldebit;

   DB::table('customer_details')
   ->where('nuban', '=', $nuban)
   ->update([
       'bal' =>  $bal,
   ]);

   DB::table('loanrepayments')
       ->where('id','=',$item->id)
       ->update([
           'rdstatus'=> 'P_Past_due',
       ]);

            }else{

            }
            $customerdetails2 = DB::table('customer_details')
            ->where('nuban', '=', $nuban)
            ->get();
      if ($customerdetails2[0]->bal >= $principal && $customerdetails2[0]->loanbal!=0 && $item->rdstatus='P_Past_due') {
              $narrationp='Loan principal Past Due deduction';
               //loan principal past due is deducted from the customers acct ones the above conditions are met

               $idp = DB::table('ledgers')->insertGetId([
                'customerid' => $item->customerid,
                'nuban' => $item->nuban,
                'narration' => $narrationp,
                'debit' => $item->principal,
                'user' => 'Auto_Tr',
                'loanref' => $loanbooking[0]->ref,
                'status' => 'cash_tr',
                'created_at' => Carbon::now(),
                'updated_at' => now(),

            ]);

            $refp="LD00/".$idp;

            DB::table('ledgers')
            ->where('id', '=', $idp)
            ->update([
                'refno' => $refp,
            ]);  

            $updatedloanbal2 = $customerdetails2[0]->loanbal - $item->principal;

            DB::table('customer_details')
            ->where('nuban', '=', $item->nuban)
            ->update([
                'loanbal' =>  $updatedloanbal2,
            ]);

            $narrationy='Loan principal past due deduction'.$idp;

            $customer = DB::table('gl_creates')
            ->where('glname', '=', 'Customer-Loan')
            ->get();
    
             DB::table('gl_ledgers')->insert([
                'class_id' => $customer[0]->classid,
                'sub_class_id' => $customer[0]->subclassid,
                'gl_code' => $customer[0]->gl_code,
                'gl_name' => $customer[0]->glname,
                'narration' => $narrationy,
                'credit' => $item->principal,
                'status' => 'Auto_Tr',
                'user' => Auth::user()->name,
                'refno' =>  $refp,
               
            ]);

            $dmonth=$loanbooking[0]->deductedmonth+1;
	

            ///here i will update the loan_booking table with the principal paid
        
            $pP=$loanbooking[0]->pp + $item->principal;
        
            $pRm=$loanbooking[0]->tp - $item->principal;
    
            DB::table('loanbookings')
            ->where('id', '=', $item->loanid)
            ->update([
                'pp' => $pP,
                'pr' => $pRm,
                'deductedmonth' => $dmonth,
            ]);
    
            $m = date_create($loanbooking[0]->deductionmain); 
      
    // Use date_add() function to add date object 
    date_add($m, date_interval_create_from_date_string('30 days')); 
      
    // Display the added date 
        $mx=date_format($m, "Y-m-d");
    
    
        DB::table('loanbookings')
        ->where('id', '=', $item->loanid)
        ->update([
            'deductionmain' => $mx,
            'nextdeductiondate' => $mx,
           
        ]);
    
        $balcredit = DB::table('ledgers')
        ->where('nuban', '=', $item->nuban)
        ->where('deleted', '=', 'N')
        ->sum('credit');
    
        $baldebit = DB::table('ledgers')
        ->where('nuban', '=', $item->nuban)
        ->where('deleted', '=', 'N')
        ->sum('debit');
    
    $bal =  $balcredit - $baldebit;
    
    DB::table('customer_details')
    ->where('nuban', '=', $item->nuban)
    ->update([
    'bal' =>  $bal,
    ]);
    
    DB::table('loanrepayments')
    ->where('id','=',$item->id)
    ->update([
        'rdstatus'=> 2,
    ]);


   
      }else{

      }
             

            }

}





















//loan deduction........................................................................
        public function loandeduction(){
            $currentdate = Carbon::now();

            // $currentdate  = DATE_FORMAT($currentdate , 'Y-m-d');

            $result = DB::table('loanrepayments')
                    // ->where("created_at", '=', $currentdate)
                    ->whereRaw("DATE_FORMAT(repaydate,'%Y-%m-%d') = DATE_FORMAT('$currentdate','%Y-%m-%d')")
                    ->where('rdstatus', '=', 'Approved')
                    ->get();

                    //return $result;

                    foreach($result as $item){

                    //  print_r( $item->id);
                $customerdetails = DB::table('customer_details')
                                    ->where('nuban', '=', $item->nuban)
                                    ->get();
                $loanbooking = DB::table('loanbookings')
                                ->where('id', '=', $item->loanid)
                                ->get();
             if ($customerdetails[0]->bal >= $item->int && $customerdetails[0]->loanbal!=0 && $item->rdstatus='Approved') {

                $narrationint='Loan interest deduction';
                //loan interest is deducted from the customers acct ones the above conditions are met
                $intid = DB::table('ledgers')->insertGetId([
                    'customerid' => $item->customerid,
                    'nuban' => $item->nuban,
                    'narration' => $narrationint,
                    'debit' => $item->int,
                    'user' => 'Auto_Tr',
                    'loanref' => $loanbooking[0]->ref,
                    'status' => 'cash_tr',
                    'created_at' => Carbon::now(),
                    'updated_at' => now(),

                ]);

                $refr="LD00/".$intid;

              DB::table('ledgers')
                ->where('id', '=', $intid)
                ->update([
                    'refno' => $refr,
                ]);  

            //update loan bal on customer details table

            $updatedloanbal = $customerdetails[0]->loanbal - $item->int;

            DB::table('customer_details')
                ->where('nuban', '=', $item->nuban)
                ->update([
                    'loanbal' =>  $updatedloanbal,
                ]);

                $narrationx='Loan interest deduction'.$intid;

                
                $customer = DB::table('gl_creates')
        ->where('glname', '=', 'Loan-Interest')
        ->get();

         DB::table('gl_ledgers')->insert([
            'class_id' => $customer[0]->classid,
            'sub_class_id' => $customer[0]->subclassid,
            'gl_code' => $customer[0]->gl_code,
            'gl_name' => $customer[0]->glname,
            'narration' => $narrationx,
            'credit' => $item->int,
            'status' => 'Auto_Tr',
            'user' => Auth::user()->name,
            'refno' =>  $refr,
           
        ]);

        ///here i will update the loan_booking table with the interest paid
       $IP = $loanbooking[0]->intpaid + $item->int;

        $iRm = $loanbooking[0]->totalint - $IP;

        DB::table('loanbookings')
            ->where('id', '=', $item->loanid)
            ->update([
                'intpaid' => $IP,
                'intremaining' => $iRm,
            ]);

            $balcredit = DB::table('ledgers')
            ->where('nuban', '=', $item->nuban)
            ->where('deleted', '=', 'N')
            ->sum('credit');

            $baldebit = DB::table('ledgers')
            ->where('nuban', '=', $item->nuban)
            ->where('deleted', '=', 'N')
            ->sum('debit');

    $bal =  $balcredit - $baldebit;

    DB::table('customer_details')
    ->where('nuban', '=', $item->nuban)
    ->update([
        'bal' =>  $bal,
    ]);

    DB::table('loanrepayments')
        ->where('id','=',$item->id)
        ->update([
            'rdstatus'=> 1,
        ]);
         }else{
            DB::table('loanrepayments')
            ->where('id', '=', $item->id)
            ->where('rdstatus', '!=', '1')
            ->whereRaw("DATE_FORMAT(repaydate,'%Y-%m-%d') = DATE_FORMAT('$currentdate','%Y-%m-%d')")
            ->where('rdstatus', '!=', 'I_Past_due')
            ->update([
                'rdstatus' => 'I_Past_due',
            ]);
         }

         $customerdetails2 = DB::table('customer_details')
         ->where('nuban', '=', $item->nuban)
         ->get();

         if ($customerdetails2[0]->bal >= $item->principal && $customerdetails2[0]->loanbal!=0 && $item->rdstatus=1) {
            $narrationp='Loan principal deduction';
            //loan principal is deducted from the customers acct ones the above conditions are met

            $idp = DB::table('ledgers')->insertGetId([
                'customerid' => $item->customerid,
                'nuban' => $item->nuban,
                'narration' => $narrationp,
                'debit' => $item->principal,
                'user' => 'Auto_Tr',
                'loanref' => $loanbooking[0]->ref,
                'status' => 'cash_tr',
                'created_at' => Carbon::now(),
                'updated_at' => now(),

            ]);

            $refp="LD00/".$idp;

            DB::table('ledgers')
                ->where('id', '=', $idp)
                ->update([
                    'refno' => $refp,
                ]);  

                $updatedloanbal2 = $customerdetails2[0]->loanbal - $item->principal;

                DB::table('customer_details')
                ->where('nuban', '=', $item->nuban)
                ->update([
                    'loanbal' =>  $updatedloanbal2,
                ]);

                $narrationy='Loan principal deduction'.$idp;

                $customer = DB::table('gl_creates')
                ->where('glname', '=', 'Customer-Loan')
                ->get();
        
                 DB::table('gl_ledgers')->insert([
                    'class_id' => $customer[0]->classid,
                    'sub_class_id' => $customer[0]->subclassid,
                    'gl_code' => $customer[0]->gl_code,
                    'gl_name' => $customer[0]->glname,
                    'narration' => $narrationy,
                    'credit' => $item->principal,
                    'status' => 'Auto_Tr',
                    'user' => Auth::user()->name,
                    'refno' =>  $refp,
                   
                ]);

                
		$dmonth=$loanbooking[0]->deductedmonth+1;
	

        ///here i will update the loan_booking table with the principal paid
    
        $pP=$loanbooking[0]->pp + $item->principal;
    
        $pRm=$loanbooking[0]->tp - $item->principal;

        DB::table('loanbookings')
        ->where('id', '=', $item->loanid)
        ->update([
            'pp' => $pP,
            'pr' => $pRm,
            'deductedmonth' => $dmonth,
        ]);

        $m = date_create($loanbooking[0]->deductionmain); 
  
// Use date_add() function to add date object 
date_add($m, date_interval_create_from_date_string('30 days')); 
  
// Display the added date 
	$mx=date_format($m, "Y-m-d");


    DB::table('loanbookings')
    ->where('id', '=', $item->loanid)
    ->update([
        'deductionmain' => $mx,
        'nextdeductiondate' => $mx,
       
    ]);

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $item->nuban)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $item->nuban)
    ->where('deleted', '=', 'N')
    ->sum('debit');

$bal =  $balcredit - $baldebit;

DB::table('customer_details')
->where('nuban', '=', $item->nuban)
->update([
'bal' =>  $bal,
]);

DB::table('loanrepayments')
->where('id','=',$item->id)
->update([
    'rdstatus'=> 2,
]);

   

         }else{

            DB::table('loanrepayments')
            ->where('id', '=', $item->id)
            ->where('rdstatus', '!=', '2')
            ->whereRaw("DATE_FORMAT(repaydate,'%Y-%m-%d') = DATE_FORMAT('$currentdate','%Y-%m-%d')")
            ->where('rdstatus', '!=', 'I_Past_due')
            ->where('rdstatus', '!=', 'P_Past_due')
            ->update([
                'rdstatus' => 'P_Past_due',
            ]);

            // Declare a date 
$dated = date_create($loanbooking[0]->nextdeductiondate); 
  
// Use date_add() function to add date object 
date_add($dated, date_interval_create_from_date_string('1 days')); 
  
// Display the added date 
	$nextdeduction=date_format($dated, "Y-m-d");

    DB::table('loanbookings')
    ->where('id', '=', $item->loanid)
    ->update([
        'nextdeductiondate' => $nextdeduction,
       
    ]);


         }
                        
        }
        }

        //..............end of loan deduction............................


public function loanstatusupdate(){
 $result = DB::table('loanbookings')
            ->where('status','=','Approved')
            ->get();

   //print_r($result);

foreach($result as $item){
    // print_r($item->nuban);

if($item->totalmonth == $item->deductedmonth){
    DB::table('loanbookings')
        ->where('id','=', $item->id)
        ->update([
            'status' => 'Expired',
        ]);
}
if($item->tp == $item->pp && $item->totalint == $item->intpaid){
    DB::table('loanbookings')
    ->where('id','=', $item->id)
    ->update([
        'status' => 'Paid-Up',
    ]);

}
    
}
}

public function loanreversal(){
    return view('admin.loan_reversal');
}


public function loanreversalf(Request $request){

    $result = DB::table("loanbookings")
            ->where('ref', '=', $request->ref)
            ->where('pp', '=', 0)
            ->whereNull('intpaid')
           ->whereNull('deductedmonth')
            ->where('status', '=', 'Approved')
            ->get();
            

            return response()->json([
                "output" => $result,
            ]);

}

public function loanreversalfunction(Request $request){
    $result = DB::table('loanbookings')
            ->where('ref', '=', $request->refrevloan)
            ->where('status', '=', 'Approved')
            ->count();
    if($result > 0){
        $statusL='LBR_Reversed';

            DB::table('loanbookings')
            ->where('ref', '=', $request->refrevloan)
          ->update([
            'status' => $statusL
          ]);

          $narration2="Loan Booking Reversed ".$request->refrevloan;

          DB::table('ledgers')
            ->insert([
                'customerid' => $request->acctidloan,
                'Refno' => $request->refrevloan,
                'nuban' => $request->nubanrevloan,
                'narration' => $narration2,
                'debit' => $request->creditrevloan,
                'user' => Auth::user()->name,
                'status' =>  $statusL,
                'created_at' => Carbon::now(),
                'updated_at' => now()

            ]);
        // DB::table('ledgers')
        //     ->where('Refno','=', $request->refrevloan)
        //     ->update([
        //       'status' => $statusL  
        //     ]);

//dont forget to reverse transactions in gl*****
$narrationgl ='Loan reversal';

$glcode2 = DB::table('gl_creates')
->where('glname', '=', 'Interest-In-Suspense')
->get();

DB::table('gl_ledgers')->insert([
    'class_id' => $glcode2[0]->classid,
    'sub_class_id' => $glcode2[0]->subclassid,
    'gl_code' => $glcode2[0]->gl_code,
    'gl_name' => $glcode2[0]->glname,
    'narration' => $narrationgl,
    'debit' => $request->int,
    'status' => $statusL,
    'user' => Auth::user()->name,
    'refno' =>  $request->refrevloan,
   
]);

$glcode = DB::table('gl_creates')
->where('glname', '=', 'Customer-Loan')
->get();

DB::table('gl_ledgers')->insert([
    'class_id' => $glcode[0]->classid,
    'sub_class_id' => $glcode[0]->subclassid,
    'gl_code' => $glcode[0]->gl_code,
    'gl_name' => $glcode[0]->glname,
    'narration' => $narrationgl,
    'credit' => $request->creditrevloan,
    'status' => $statusL,
    'user' => Auth::user()->name,
    'refno' =>  $request->refrevloan,
   
]);




//**** */

            DB::table('loanrepayments')
            ->where('loanid','=', $request->loanid)
            ->update([
              'rdstatus' => $statusL  
            ]);
        
        DB::table('reversals')->insert([
                'ref' => $request->refrevloan,
                'customerid' => $request->acctidloan, 
                'nuban' => $request->nubanrevloan,
                'credit' => $request->creditrevloan,
                'accttype' => $request->accttype,
                'status' => $statusL 
        ]);

        $out = DB::table('customer_details')
                ->where('nuban', '=', $request->nubanrevloan)
                ->get();

                $loanbal = $out[0]->loanbal - $request->totalrepay;

                $balcredit = DB::table('ledgers')
                ->where('nuban', '=', $request->nubanrevloan)
                ->where('deleted', '=', 'N')
                ->sum('credit');

                $baldebit = DB::table('ledgers')
                ->where('nuban', '=', $request->nubanrevloan)
                ->where('deleted', '=', 'N')
                ->sum('debit');

                $bal =  $balcredit - $baldebit;

             $finalresposense =   DB::table('customer_details')
                    ->where('nuban','=',$request->nubanrevloan)
                    ->update([
                        'bal' => $bal,
                        'loanbal' => $loanbal
                    ]);
            if($finalresposense==true){
            return redirect()->back()->with('message', 'Loan reversal successful'); 
            } else{
            return redirect()->back()->with('message_warning', 'Loan reversal Failed'); 
        }
    } else{
        return redirect()->back()->with('message_failed', 'Invalid Reference ID'); 
    }       
}





}

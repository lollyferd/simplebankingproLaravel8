<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\view;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class TellerController extends Controller
{

  

//** teller till bal check on main menu */  
    public function tillbalmain(){
        $tellercode = Auth::user()->tellercode; 
       $balcredit = DB::table('gl_ledgers')
       ->where('gl_code', '=', $tellercode)
       ->where('deleted', '=', 'N')
       ->sum('credit');
   
       $baldebit = DB::table('gl_ledgers')
       ->where('gl_code', '=', $tellercode)
       ->where('deleted', '=', 'N')
       ->sum('debit');

$tillbal = $baldebit - $balcredit;

$till = number_format($tillbal,2);

return response()->json([
   'myout' =>  $till,
]);
    }

    //**end of teller till bal check on main menu */  

    //** adding tillercode to user */  
    public function addteller(){
        $output = DB::table('users')
        ->where('accesstype', '!=', 1)
        ->where('active', '!=', 0)
        ->get();
        return view('admin.addteller', compact('output'));
    }
    //main function/
public function addtellerf(Request $request){
    $checkifexist = DB::table('gl_creates')
            ->where('gl_code','=',$request->tellercode)
            ->where('subclassid','=',1)
            ->count();

      $checkifused = DB::table('users')
            ->where('tellercode','=',$request->tellercode)
            ->count();
        $tcode = user::find($request->id);

        if($tcode->tellercode!=Null){
            return redirect()->back()->with('message_warning', 'Teller code already added for User :'.$tcode->tellercode); 
        }else{
  
    if($checkifexist ==0){
        return redirect()->back()->with('message_warning', 'Teller code does not exist'); 
    }else{

        if($checkifused >=1){
            return redirect()->back()->with('message_warning', 'Teller code already used'); 
        }else{
            $out =DB::table('users')
            ->where('id','=',$request->id)
            ->update([
                'tellercode' => $request->tellercode
            ]);
               
    if($out==true){
        return redirect()->back()->with('message', 'Teller code added successfully');
    }else{
        return redirect()->back()->with('message_failed', 'Failed');
    }
        }
   
    }

        }
   
}
 //**end of adding tillercode to user */ 
 
 
 //**check individual till bal */
    public function tillbal(){
        $out = DB::table('users')
            ->where('tellercode','!=', NULL)
            ->get();
        return view("admin.tillbal",compact('out'));
    }

    public function tillbalcheck(Request $request){
        $balcredit = DB::table('gl_ledgers')
        ->where('gl_code', '=', $request->tellercode)
        ->where('deleted', '=', 'N')
        ->sum('credit');
    
        $baldebit = DB::table('gl_ledgers')
        ->where('gl_code', '=', $request->tellercode)
        ->where('deleted', '=', 'N')
        ->sum('debit');
 
 $tillbal = $baldebit - $balcredit;
 
 $till = number_format($tillbal,2);
 
 return response()->json([
    'myout' =>  $till,
 ]);

    }
     //**end of check individual till bal */

     //**tellers transactions  */

public function tellertransaction(){
    $output = DB::table('users')
    ->where('accesstype', '!=', 1)
    ->where('active', '!=', 0)
    ->get();
    
    return view('admin.tellertransaction',compact('output'));
}

public function tellertransactioncheck(Request $request){
    $output = DB::table('users')
    ->where('accesstype', '!=', 1)
    ->where('active', '!=', 0)
    ->get();
    
    $out = DB::table('ledgers')
    ->whereBetween(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), [$request->from, $request->to])
        ->where('user','=',$request->user)
        ->where('deleted','=','N')
        ->orderBy('id', 'DESC')
        ->get();
    $username = $request->user;
    return view('admin.tellertransaction',compact('out','output','username'));
}

     //**end of tellers transactions  */

     
//**check daily teller transaction*/
public function dailytill(){
    $date = Strtotime(now());
    $result = date('m-d-Y', $date);
    $out = DB::table('ledgers')
    ->rightJoin('customer_details', 'customer_details.id', '=', 'ledgers.customerid')
       ->where(DB::raw("(DATE_FORMAT(ledgers.created_at, '%m-%d-%Y'))"),'=', $result)
        ->where('ledgers.user','=',Auth::user()->name)
        ->where('ledgers.deleted','=','N')
       
        ->orderBy('ledgers.id', 'DESC')
        ->get();
 
    return view("admin.dailytill",compact('out'));
}
     

}

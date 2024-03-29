<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\state;
use App\Models\ledger;

use App\Models\investment;
use App\Models\account_type;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Models\account_officer;
use App\Models\customer_detail;
use App\Models\accesstype;
//use Illuminate\Contracts\Session\Session;

//use App\Models\loantype;
use App\Models\organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    
    public function __construct()
{
    $this->middleware('auth');
}



    public function redirect(Request $req){
        // $customer= customer_detail::all();
        
        if(Auth::id()){
            if(Auth::user()->active=='1'){
                if(Auth::user()->accesstype=='0'){
                    return view('admin.viewhome');
                }else{
                    
                    return view('admin.home');
                }
            }else{
                return view('auth.login');
            }
        }else{
             return redirect()->back()->with('message', 'access denied'); 
        }
    }
  

    public function createuser(){
        return view("admin.createuser");
    }

    // public function registeruser(Request $request){
    //     $newusers = New User;
    //     $newusers->name = $request->input('name');
    //     $newusers->fullname = $request->input('fullname');
    //     $newusers->phone = $request->input('phone');
    //     $newusers->email = $request->input('email');
    //     $newusers->password =  Hash::make($request->password);
    //     $newusers->save();
    //     return redirect()->back();

    // }




public function registeruser(Request $req)
{
    $req->validate([
        'name' => ['required', 'string', 'max:255'],
        'fullname' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    User::create([
        'name' => $req->name,
        'fullname' => $req->name,
        'phone' => $req->name,
        'email' => $req->email,
        'password' => Hash::make($req->password),
    ]);
    return redirect()->back()->with('message', 'User added successfully');
}


public function addacctofficer(){
    return view("admin.add_account_officer");
}


public function addaccttype(){
    return view("admin.add_account_type");
}


public function uploadacctofficer(Request $req){
    $req->validate([
        'acctofficername' => ['required','string', 'max:255', 'unique:account_officers'],
        
        
       
    ]);
    $newofficer = New account_officer;

    $newofficer->acctofficername = $req->acctofficername;

    $newofficer->user = Auth::user()->id;

    $newofficer->save();

    return redirect()->back()->with('message', 'Account Officer added successfully');
  
}
 

public function uploadaccttype(Request $req){



    $req->validate([
        'accttype' => ['required', 'string', 'max:255', 'unique:account_types'],
        
    ]);

     $newaccttype = New account_type;

       $newaccttype->accttype = $req->accttype;
    
       $newaccttype->user = Auth::user()->id;
    
         $newaccttype->save();
    return redirect()->back()->with('message', 'Account Type added successfully');  
  
}

public function create_account(){
     $data= account_type::all();
    $data2= account_officer::all();
    $state= state::all();
    return view("admin.create_account",compact('data','data2','state'));
}
 

public function uploadcustomer(Request $request){

    $newcustomer = New customer_detail;
// formatting photo for upload

    $image=$request->photo;

    if($image!=null){

        $extensions = array('png', 'jpg', 'jpeg', 'gif');
        $file_ext=$image->getClientoriginalExtension();
			
		if(in_array($file_ext, $extensions)===false){
				$error[] = "extension not allowed!";

				}

     if(empty($error)==true){
    $imagename=time().'.'.$image->getClientoriginalExtension();

    $request->photo->move('uploads', $imagename);

    $newcustomer->photo=$imagename;
     }
    }

    // $newcustomer->customerid = '1';
    // $newcustomer->nuban = '000001';
    $newcustomer->surname = $request->surname;
    $newcustomer->othername = $request->othername;
    $newcustomer->bvn = $request->bvn;
    $newcustomer->gender = $request->gender;
    $newcustomer->dob = $request->dob;
    $newcustomer->email = $request->email;
    $newcustomer->tel = $request->tel;
    $newcustomer->occupation = $request->occupation;
    $newcustomer->country = $request->country;
    $newcustomer->state = $request->state;
    $newcustomer->city = $request->city;
    $newcustomer->homeaddress = $request->homeaddress;
    $newcustomer->officeaddress = $request->officeaddress;
    $newcustomer->typeofacct = $request->typeofacct;
    $newcustomer->classofacct = $request->classofacct;
    $newcustomer->nextofkin = $request->nextofkin;
    $newcustomer->nextofkinaddress = $request->nextofkinaddress;
    $newcustomer->accountofficer = $request->accountofficer;
    $newcustomer->status = 'Active';

    $newcustomer->save();

    //get acct type id........
    $acctid = DB::table('account_types')
            ->where('accttype', '=', $request->typeofacct)
            ->get();

    // $acctid= account_type::find($request->typeofacct);
    
    //formatting nuban 

    
			if (strlen($newcustomer->id)==1) {
				$nubanformatted='102'.$acctid[0]->id.'00000'.$newcustomer->id;
                // $customernuban='00000'.$newcustomer->id;
			}
			if (strlen($newcustomer->id)==2) {
				$nubanformatted='102'.$acctid[0]->id.'0000'.$newcustomer->id;
                // $customernuban='0000'.$newcustomer->id;
			}
			if (strlen($newcustomer->id)==3) {
				$nubanformatted='102'.$acctid[0]->id.'000'.$newcustomer->id;
                // $customernuban='000'.$newcustomer->id;
			}

			if (strlen($newcustomer->id)==4) {
				$nubanformatted='102'.$acctid[0]->id.'00'.$newcustomer->id;
                // $customernuban='00'.$newcustomer->id;
			}

			if (strlen($newcustomer->id)==5) {
				$nubanformatted='102'.$acctid[0]->id.'0'.$newcustomer->id;
                // $customernuban='0'.$newcustomer->id;
			}
			if (strlen($newcustomer->id)==6) {
				$nubanformatted='102'.$acctid[0]->id.$newcustomer->id;
                // $customernuban=$newcustomer->id;
			}
    
            $updatenuban= customer_detail::find($newcustomer->id);
            
            $updatenuban->customerid = $newcustomer->id;
            $updatenuban->nuban = $nubanformatted;

            $updatenuban->save();

            ///sms sending ..............................  
            $owneremail="lollypee4god@gmail.com";
            $subacct="METRO";
            $subacctpwd="better";
            $sendto=$request->tel; /* destination number */
            $sender="MetroLend"; /* sender id */
            $message='Dear '.strtoupper($request->surname) .' '. strtoupper($request->othername).' '. 'Welcome to SIMPLE BANKING. Your new Acc No is '. $nubanformatted.'. Happy Banking.'; /* message to be sent */
            /* create the required URL */
            $url = "http://www.smslive247.com/http/index.aspx?"
            . "cmd=sendquickmsg"
            . "&owneremail=" . UrlEncode($owneremail)
            . "&subacct=" . UrlEncode($subacct)
            . "&subacctpwd=" . UrlEncode($subacctpwd)
            . "&message=" . UrlEncode($message)
            . "&sender=" . UrlEncode($sender)
            .  "&sendto=" . UrlEncode($sendto);
            /* call the URL */
            if ($f = @fopen($url, "r"))
            {
            $answer = fgets($f, 255);
            if (substr($answer, 0, 1) == "+")
            {
           // echo "SMS to $dnr was successful.";
            } 
            }


   
 
    return redirect()->back()->with('message', $nubanformatted); 


    
    
}

public function fetchcustomers(Request $req){
$customersfetch = customer_detail::find($req->nuban);

$balcredit = DB::table('ledgers')
->where('nuban', '=', $req->nuban)
->where('deleted', '=', 'N')
->sum('credit');

$baldebit = DB::table('ledgers')
->where('nuban', '=', $req->nuban)
->where('deleted', '=', 'N')
->sum('debit');

$bal =  $balcredit - $baldebit;

$out= DB::table('customer_details')
    ->where('nuban', '=', $req->nuban)
    ->update(['bal' => $bal]);

   

   return response()->json([
       'data' =>  $customersfetch,
   ]);
}

public function fetchall(Request $req){
        $customerall= customer_detail::all();
        
    return response()->json([
        'dataall' =>  $customerall,
        
    ]);
}

//search customer on dashboard.............................

public function searchdata(Request $request){
    
    $output = customer_detail::where('surname', 'like', '%' . $request->get('query') . '%' )->get();

    return response()->json([
        'mysearch' =>  $output,
    ]);
}

public function searchnuban(Request $request){
    
    $output = customer_detail::where('nuban', 'like', '%' . $request->get('out') . '%' )->get();

    $balcredit = DB::table('ledgers')
->where('nuban', '=', $request->get('out'))
->where('deleted', '=', 'N')
->sum('credit');

$baldebit = DB::table('ledgers')
->where('nuban', '=', $request->get('out'))
->where('deleted', '=', 'N')
->sum('debit');

$bal =  $balcredit - $baldebit;

$out= DB::table('customer_details')
    ->where('nuban', '=', $request->get('out'))
    ->update(['bal' => $bal]);

    return response()->json([
        'mysearchnuban' =>  $output,
    ]);
}
//customer details display with bal
public function detailsdisplay(Request $request){

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->get('output'))
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->get('output'))
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

   $out= DB::table('customer_details')
        ->where('nuban', '=', $request->get('output'))
        ->update(['bal' => $bal]);
   
    $result = customer_detail::where('nuban', '=', $request->get('output'))
                            ->where('status', '=', 'Active')
                            ->get();

   
    return response()->json([
        'myout' =>  $result,
    ]);
}

//deposit veiw....................
public function depositposting(){
    return view('admin.deposit_posting');
}

//search cutomer on deposit portal....................

public function searchcustomerdeposit(Request $req){
  
    
        $customersfetch1 = customer_detail::where('nuban', '=', $req->get('output'))->get();
         
        return response()->json([
            'myout' =>  $customersfetch1,
        ]);
        
     }

     
public function wdrposting(){
    return view('admin.wdr_posting');
}


//deposit function........................................
public function depositfunction(Request $request){
    $request->validate([
        'credit' => ['required'],
        'customerid' => ['required'],

        
    ]);

    if(Auth::user()->tellercode!=''){
$checking = customer_detail::where('nuban', '=', $request->input('nuban11'))->count();
      if($checking > 0){  


    $deposit = new ledger;

    $deposit->customerid = $request->input('customerid');
    $deposit->nuban = $request->input('nuban11');
    $deposit->narration = $request->input('narration');
    // $deposit->customerid = $request->input('customerid');
    $deposit->credit = $request->input('credit');
    $deposit->user = Auth::user()->name;
    $deposit->save();

    $newid = $deposit->id;

    $deposit2 = ledger::find($newid);

    $deposit2->refno = 'DEP-00'.$newid;
    $deposit2->status = 'cash_tr';
    $deposit2->save();
    $nubancustomer =  $request->input('nuban11');

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $nubancustomer)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $nubancustomer)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

   $out= DB::table('customer_details')
        ->where('nuban', '=', $nubancustomer)
        ->update(['bal' => $bal]);

        $tellercode = Auth::user()->tellercode; 
        $narration = $request->input('narration');

        $gl = DB::table('gl_creates')
        ->where('gl_code', '=',$tellercode)
        ->get();

      $output =  DB::table('gl_ledgers')->insert([
            'class_id' => $gl[0]->classid,
            'sub_class_id' => $gl[0]->subclassid,
            'gl_code' => $gl[0]->gl_code,
            'gl_name' => $gl[0]->glname,
            'narration' => $narration.'/'.$nubancustomer,
            'debit' => $request->input('credit'),
            'status' => 'cash_tr',
            'user' => Auth::user()->name,
            'refno' =>  $deposit2->refno,
            'created_at' => Carbon::now(),
            'updated_at' => now()
           
        ]);

        $customer = DB::table('gl_creates')
        ->where('glname', '=', 'Customer-Deposit')
        ->get();

      $output2 =  DB::table('gl_ledgers')->insert([
            'class_id' => $customer[0]->classid,
            'sub_class_id' => $customer[0]->subclassid,
            'gl_code' => $customer[0]->gl_code,
            'gl_name' => $customer[0]->glname,
            'narration' => $narration.'/'.$nubancustomer,
            'credit' => $request->input('credit'),
            'status' => 'cash_tr',
            'user' => Auth::user()->name,
            'refno' =>  $deposit2->refno,
            'created_at' => Carbon::now(),
            'updated_at' => now()
           
        ]);


    if($output2==true){
        return redirect()->back()->with('message', 'Depost Transaction Successful'); 
    }else{
        return redirect()->back()->with('message_failed', 'Depost Transaction Failed'); 
    }

      }else{
        return redirect()->back()->with('message_warning', 'Failed! Incorrect Account Number'); 
    }

}else{
    return redirect()->back()->with('message_warning', 'Teller Access Code Not Found...Please contact your Head Of Operation'); 
}
    
}     

//wdr function........................................
public function wdrf(Request $request){
    $request->validate([
        'debit' => ['required'],
        
    ]);

    $mbal = DB::table('customer_details')
    ->where('nuban', '=', $request->input('nuban11'))
    ->get();

    //getting teller bal...................
    $tillbalC = DB::table('gl_ledgers')
    ->where('gl_code', '=', Auth::user()->tellercode)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $tillbalD = DB::table('gl_ledgers')
    ->where('gl_code', '=', Auth::user()->tellercode)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $tillbal =  $tillbalD - $tillbalC;


if($mbal[0]->bal >= $request->input('debit') && $tillbal >=$request->input('debit') ){

    if(Auth::user()->tellercode!=''){
$checking = customer_detail::where('nuban', '=', $request->input('nuban11'))->count();
      if($checking > 0){  


    $wdr = new ledger;

    $wdr->customerid = $request->input('customerid');
    $wdr->nuban = $request->input('nuban11');
    $wdr->narration = $request->input('narration');
    // $wdr->customerid = $request->input('customerid');
    $wdr->debit = $request->input('debit');
    $wdr->user = Auth::user()->name;
    $wdr->save();

    $newid = $wdr->id;

    $wdr2 = ledger::find($newid);

    $wdr2->refno = 'WDR-00'.$newid;
    $wdr2->status = 'cash_tr';
    $wdr2->save();
    $nubancustomer =  $request->input('nuban11');

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $nubancustomer)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $nubancustomer)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

   $out= DB::table('customer_details')
        ->where('nuban', '=', $nubancustomer)
        ->update(['bal' => $bal]);

        $tellercode = Auth::user()->tellercode; 
        $narration = $request->input('narration');

        $gl = DB::table('gl_creates')
        ->where('gl_code', '=',$tellercode)
        ->get();

      $output =  DB::table('gl_ledgers')->insert([
            'class_id' => $gl[0]->classid,
            'sub_class_id' => $gl[0]->subclassid,
            'gl_code' => $gl[0]->gl_code,
            'gl_name' => $gl[0]->glname,
            'narration' => $narration.'/'.$nubancustomer,
            'credit' => $request->input('debit'),
            'status' => 'cash_tr',
            'user' => Auth::user()->name,
            'refno' =>  $wdr2->refno,
            'created_at' => Carbon::now(),
            'updated_at' => now()
           
        ]);

        $customer = DB::table('gl_creates')
        ->where('glname', '=', 'Customer-Deposit')
        ->get();

      $output2 =  DB::table('gl_ledgers')->insert([
            'class_id' => $customer[0]->classid,
            'sub_class_id' => $customer[0]->subclassid,
            'gl_code' => $customer[0]->gl_code,
            'gl_name' => $customer[0]->glname,
            'narration' => $narration.'/'.$nubancustomer,
            'debit' => $request->input('debit'),
            'status' => 'cash_tr',
            'user' => Auth::user()->name,
            'refno' =>  $wdr2->refno,
            'created_at' => Carbon::now(),
            'updated_at' => now()
           
        ]);


    if($output2==true){
        return redirect()->back()->with('message', 'Withdrawal Transaction Successful'); 
    }else{
        return redirect()->back()->with('message_failed', 'Withdrawal Transaction Failed'); 
    }

      }else{
        return redirect()->back()->with('message_warning', 'Failed! Incorrect Account Number'); 
    }

}else{
    return redirect()->back()->with('message_warning', 'Teller Access Code Not Found...Please contact your Head Of Operation'); 
 }}else{
    return redirect()->back()->with('message_warning', 'Insufficient account Balance or Till Balance'); 
}
    
}     

  







     public function customerledger(){

         return view('admin.customer_ledger');
     }


public function customerLFS(Request $req){

    $nuban = $req->customerid;

     //get customer real bal.............start
     $balcredit = DB::table('ledgers')
     ->where('nuban', '=', $nuban)
     ->where('deleted', '=', 'N')
     ->sum('credit');
     
     $baldebit = DB::table('ledgers')
     ->where('nuban', '=', $nuban)
     ->where('deleted', '=', 'N')
     ->sum('debit');
     
     $bal =  $balcredit - $baldebit;
     
     $out= DB::table('customer_details')
         ->where('nuban', '=', $nuban)
         ->update(['bal' => $bal]);
 
         //get customer real bal.............end

     $customeroutput = customer_detail::find($req->nuban);

    // $typeofacct = $customeroutput->typeofacct;

   
    $ledger2 = DB::table('ledgers')
    ->where('nuban', '=',$nuban)
    ->where('deleted', '=','N')
    // ->where('status', '=','cash_tr')
    // ->orwhere('status', '=','Special-D')
    // ->orwhere('status', '=','Reversed')
    ->get();
     $ledger2 = json_encode($ledger2);


    return view('admin.customer_ledger', compact('customeroutput','ledger2','bal'));

}

//account update signature and passport....................

public function accountupdate(){
    return view('admin.account_update');
}

public function accountupdated(Request $request){

        
    $newcustomer = New customer_detail;
    // formatting photo for upload
    
        $image=$request->photo;
    
        if($image!=null){
    
            $extensions = array('png', 'jpg', 'jpeg', 'gif');
            $file_ext=$image->getClientoriginalExtension();
                
            if(in_array($file_ext, $extensions)===false){
                    $error[] = "extension not allowed!";
    
                    }
    
         if(empty($error)==true){
        $imagename=time().'.'.$image->getClientoriginalExtension();
    
        $request->photo->move('uploads', $imagename);
        if($request->options =='Signature'){

        DB::table('customer_details')
        ->where('nuban', '=', $request->nubanupdate)
        ->update(['sign' => $imagename]);
        return redirect()->back()->with('message', 'Customer Signature Updated Successful'); 
        }
        
        
        if($request->options =='passport'){
            DB::table('customer_details')
            ->where('nuban', '=', $request->nubanupdate)
            ->update(['photo' => $imagename]);
            return redirect()->back()->with('message', 'Customer Passport Updated Successful'); 
            } else{
            return redirect()->back()->with('message_warning', 'Choose a valid Update option'); 
        }
    
         }
        }
   
}




public function customerupdate(){
    $data= account_officer::all();
    return view('admin.customer_edit', compact('data'));
}

public function customeredit(Request $request){

 $output =   DB::table('customer_details')
    ->where('nuban', '=', $request->nubanedit2)
    ->update(['surname' => $request->surname, 'bvn' => $request->bvn, 'othername' => $request->othername,'gender' => $request->gender, 'dob' => $request->dob, 'email' => $request->email, 'tel' => $request->tel, 'occupation' => $request->occupation, 'state' => $request->state, 'city' => $request->city, 'homeaddress' =>$request->contactaddress, 'officeaddress' => $request->officeaddress, 'nextofkin' => $request->nextofkin,  'nextofkinaddress' => $request->nextofkinaddr, 'accountofficer' => $request->accountofficer]);
    if($output==true){
        return redirect()->back()->with('message', 'Customer details updated Successfully'); 
    }
}

//bank deposit view function..........

public function bankdeposit(){

    $result = DB::table('gl_creates')
            ->where('subclassid', '=', '2')
            ->get();
    return view('admin.bank_deposit',compact('result'));
}


//bank wdr view function..........

public function bankwdr(){

    $result = DB::table('gl_creates')
            ->where('subclassid', '=', '2')
            ->get();
    return view('admin.bank_wdr',compact('result'));
}

//bank deposit function................................

public function bankD(Request $request){
    $request->validate([
        'credit' => ['required'],
        'customerid' => ['required'],
        // 'gl_code' => ['required'],
        // 'nuban' => ['required'],
    ]);

    if(Auth::user()->tellercode!=''){
        $checking = customer_detail::where('nuban', '=', $request->input('nuban11'))->count();
              if($checking > 0){  
        
        
            $deposit = new ledger;
        
            $deposit->customerid = $request->input('customerid');
            $deposit->nuban = $request->input('nuban11');
            $deposit->narration = $request->input('narration');
            $deposit->customerid = $request->input('customerid');
            $deposit->credit = $request->input('credit');
            $deposit->user = Auth::user()->name;
            $deposit->save();
        
            $newid = $deposit->id;
        
            $deposit2 = ledger::find($newid);
        
            $deposit2->refno = 'DEPBank-00'.$newid;
            $deposit2->status = 'cash_tr';
            $deposit2->save();
            $nubancustomer =  $request->input('nuban11');
        
            $balcredit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('credit');
        
            $baldebit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('debit');
        
            $bal =  $balcredit - $baldebit;
        
           $out= DB::table('customer_details')
                ->where('nuban', '=', $nubancustomer)
                ->update(['bal' => $bal]);
        
                $bankcode = $request->input('bankcode'); 
                $narration = $request->input('narration');
        
                $gl = DB::table('gl_creates')
                ->where('gl_code', '=',$bankcode)
                ->get();
        
              $output =  DB::table('gl_ledgers')->insert([
                    'class_id' => $gl[0]->classid,
                    'sub_class_id' => $gl[0]->subclassid,
                    'gl_code' => $gl[0]->gl_code,
                    'gl_name' => $gl[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'debit' => $request->input('credit'),
                    'status' => 'cash_tr',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
                   
                ]);
        
                $customer = DB::table('gl_creates')
                ->where('glname', '=', 'Customer-Deposit')
                ->get();
        
              $output2 =  DB::table('gl_ledgers')->insert([
                    'class_id' => $customer[0]->classid,
                    'sub_class_id' => $customer[0]->subclassid,
                    'gl_code' => $customer[0]->gl_code,
                    'gl_name' => $customer[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'credit' => $request->input('credit'),
                    'status' => 'cash_tr',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
                   
                ]);
        
        
            if($output2==true){
                return redirect()->back()->with('message', 'Bank Depost Transaction Successful'); 
            }else{
                return redirect()->back()->with('message_failed', 'Bank Depost Transaction Failed'); 
            }
        
              }else{
                return redirect()->back()->with('message_warning', 'Failed! Incorrect Account Number'); 
            }
        
        }else{
            return redirect()->back()->with('message_warning', 'Teller Access Code Not Found...Please contact your Head Of Operation'); 
        }
        
}


//bank deposit function................................

public function bankW(Request $request){
    $mbal = DB::table('customer_details')
            ->where('nuban', '=', $request->input('nuban11'))
            ->get();

 //getting teller bal...................
    $tillbalC = DB::table('gl_ledgers')
    ->where('gl_code', '=', $request->input('bankcode'))
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $tillbalD = DB::table('gl_ledgers')
    ->where('gl_code', '=', $request->input('bankcode'))
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $tillbal =  $tillbalD - $tillbalC;

    if($mbal[0]->bal >= $request->input('debit') &&  $tillbal >= $request->input('debit')){
    $request->validate([
        'debit' => ['required'],
        'customerid' => ['required'],
        // 'gl_code' => ['required'],
        // 'nuban' => ['required'],
    ]);

    if(Auth::user()->tellercode!=''){
        $checking = customer_detail::where('nuban', '=', $request->input('nuban11'))->count();
              if($checking > 0){  
        
        
            $deposit = new ledger;
        
            $deposit->customerid = $request->input('customerid');
            $deposit->nuban = $request->input('nuban11');
            $deposit->narration = $request->input('narration');
            $deposit->customerid = $request->input('customerid');
            $deposit->debit = $request->input('debit');
            $deposit->user = Auth::user()->name;
            $deposit->save();
        
            $newid = $deposit->id;
        
            $deposit2 = ledger::find($newid);
        
            $deposit2->refno = 'WDRBank-00'.$newid;
            $deposit2->status = 'cash_tr';
            $deposit2->save();
            $nubancustomer =  $request->input('nuban11');
        
            $balcredit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('credit');
        
            $baldebit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('debit');
        
            $bal =  $balcredit - $baldebit;
        
           $out= DB::table('customer_details')
                ->where('nuban', '=', $nubancustomer)
                ->update(['bal' => $bal]);
        
                $bankcode = $request->input('bankcode'); 
                $narration = $request->input('narration');
        
                $gl = DB::table('gl_creates')
                ->where('gl_code', '=',$bankcode)
                ->get();
        
              $output =  DB::table('gl_ledgers')->insert([
                    'class_id' => $gl[0]->classid,
                    'sub_class_id' => $gl[0]->subclassid,
                    'gl_code' => $gl[0]->gl_code,
                    'gl_name' => $gl[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'credit' => $request->input('debit'),
                    'status' => 'cash_tr',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
                   
                ]);
        
                $customer = DB::table('gl_creates')
                ->where('glname', '=', 'Customer-Deposit')
                ->get();
        
              $output2 =  DB::table('gl_ledgers')->insert([
                    'class_id' => $customer[0]->classid,
                    'sub_class_id' => $customer[0]->subclassid,
                    'gl_code' => $customer[0]->gl_code,
                    'gl_name' => $customer[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'debit' => $request->input('debit'),
                    'status' => 'cash_tr',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
                   
                ]);
        
        
            if($output2==true){
                return redirect()->back()->with('message', 'Bank Withdrawal Transaction Successful'); 
            }else{
                return redirect()->back()->with('message_failed', 'Bank Withdrawal Transaction Failed'); 
            }
        
              }else{
                return redirect()->back()->with('message_warning', 'Failed! Incorrect Account Number'); 
            }
        
        }else{
            return redirect()->back()->with('message_warning', 'Teller Access Code Not Found...Please contact your Head Of Operation'); 
        }}else{
            return redirect()->back()->with('message_warning', 'Insufficient account Balance or withdrawal Bank'); 
        }
        
}



public function specialdeduction(){
    $result = DB::table('gl_creates')
    ->where('classid', '=', '40')
    ->get();
    return view('admin.special_deduction', compact('result'));
}

public function specialdebit(Request $request){

    $mbal = DB::table('customer_details')
            ->where('nuban', '=', $request->input('nuban11'))
            ->get();
    if($mbal[0]->bal >= $request->input('debit')){
    $request->validate([
        'debit' => ['required'],
        'customerid' => ['required'],
        // 'gl_code' => ['required'],
        // 'nuban' => ['required'],
    ]);

    if(Auth::user()->tellercode!=''){
        $checking = customer_detail::where('nuban', '=', $request->input('nuban11'))->count();
              if($checking > 0){  
        
        
            $deposit = new ledger;
        
            $deposit->customerid = $request->input('customerid');
            $deposit->nuban = $request->input('nuban11');
            $deposit->narration = $request->input('narration');
            $deposit->customerid = $request->input('customerid');
            $deposit->debit = $request->input('debit');
            $deposit->user = Auth::user()->name;
            $deposit->save();
        
            $newid = $deposit->id;
        
            $deposit2 = ledger::find($newid);
        
            $deposit2->refno = 'SD-00'.$newid;
            $deposit2->status = 'Special-D';
            $deposit2->save();
            $nubancustomer =  $request->input('nuban11');
        
            $balcredit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('credit');
        
            $baldebit = DB::table('ledgers')
            ->where('nuban', '=', $nubancustomer)
            ->where('deleted', '=', 'N')
            ->sum('debit');
        
            $bal =  $balcredit - $baldebit;
        
           $out= DB::table('customer_details')
                ->where('nuban', '=', $nubancustomer)
                ->update(['bal' => $bal]);
        
                $glkcode = $request->input('glkcode'); 
                $narration = $request->input('narration');
        
                $gl = DB::table('gl_creates')
                ->where('gl_code', '=',$glkcode)
                ->get();
        
              $output =  DB::table('gl_ledgers')->insert([
                    'class_id' => $gl[0]->classid,
                    'sub_class_id' => $gl[0]->subclassid,
                    'gl_code' => $gl[0]->gl_code,
                    'gl_name' => $gl[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'credit' => $request->input('debit'),
                    'status' => 'Special-D',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
                   
                ]);
        
                $customer = DB::table('gl_creates')
                ->where('glname', '=', 'Customer-Deposit')
                ->get();
        
              $output2 =  DB::table('gl_ledgers')->insert([
                    'class_id' => $customer[0]->classid,
                    'sub_class_id' => $customer[0]->subclassid,
                    'gl_code' => $customer[0]->gl_code,
                    'gl_name' => $customer[0]->glname,
                    'narration' => $narration.'/'.$nubancustomer,
                    'debit' => $request->input('debit'),
                    'status' => 'Special-D',
                    'user' => Auth::user()->name,
                    'refno' =>  $deposit2->refno,
                    'created_at' => Carbon::now(),
                    'updated_at' => now()
              
                ]);
        
        
            if($output2==true){
                return redirect()->back()->with('message', 'Special Deduction Transaction Successful'); 
            }else{
                return redirect()->back()->with('message_failed', 'Special Deduction Withdrawal Transaction Failed'); 
            }
        
              }else{
                return redirect()->back()->with('message_warning', 'Failed! Incorrect Account Number'); 
            }
        
        }else{
            return redirect()->back()->with('message_warning', 'Teller Access Code Not Found...Please contact your Head Of Operation'); 
        }}else{
            return redirect()->back()->with('message_warning', 'Insufficient account Balance'); 
        }
    
}

public function blockaccount(Request $req){

    $data = $req->get('out');

   $result= DB::table('customer_details')
    ->where('nuban', '=',$data)
    ->get();

    if($result[0]->bal != 0){
        $output = "account with balance can't be blocked";
     }

     if($result[0]->bal == 0){

        DB::table('customer_details')
        ->where('nuban', '=', $data)
        ->update(['status' => 'Blocked']);

        $output = 'Customer Blocked successfully';
     }

    

                return response()->json([
                  
                    'myout' => $output,
                    
                ]);     

                

}

public function unblockaccount(Request $req){

    $data = $req->get('out');

     DB::table('customer_details')
                ->where('nuban', '=',$data)
                ->update(['status' => 'Active']);

                return response()->json([
                    'myout' =>  'Customer UnBlocked successfully',
                ]);     

                

}
//disable account.................

public function disableaccount(Request $req){

    $data = $req->get('out');

    $output= DB::table('customer_details')
        ->where('nuban', '=',$data)
        ->update(['status' => 'Disabled']);

        if($output==true){
            $result ='Account Disabled successfully';
        }else{$result='Failed';}
     
          return response()->json([
                  
                    'myout' => $result,
                    
                ]);     
    }

    //enable account..............

    public function enableaccount(Request $req){

        $data = $req->get('out');
    
        $output= DB::table('customer_details')
            ->where('nuban', '=',$data)
            ->update(['status' => 'Active']);
    
            if($output==true){
                $result ='Account Enabled successfully';
            }else{$result='Failed';}
         
              return response()->json([
                      
                        'myout' => $result,
                        
                    ]);     
        }

          
    

            public function investmentview(){
                return view("admin.investmentbooking");
            }
        
        
            public function investmentcalc(Request $request){

            $result = DB::table('customer_details')
                    ->where('nuban','=', $request->nubanfd)
                    ->get();

        $date = date_create($request->predate); 
  
        // Use date_add() function to add date object 
        date_add($date, date_interval_create_from_date_string(+ $request->durationfd.'days')); 
  
        // Display the added date 
        $NewDate=date_format($date, "Y-m-d");

                    // $NewDate=Date('Y-m-d', strtotime(+ $request->durationfd. "days"));

                    return response()->json([
                                
                        'myout' => $result,
                        'myout2' => $NewDate,
                        
                    ]);     
            }


public function FDPosting(Request $request){
    $request->validate([
        'totaldue' => ['required'],
        'customerid' => ['required'],
        'predate' => ['required'],
       
    ]);

    $balcredit = DB::table('ledgers')
    ->where('nuban', '=', $request->nubanfd)
    ->where('deleted', '=', 'N')
    ->sum('credit');

    $baldebit = DB::table('ledgers')
    ->where('nuban', '=', $request->nubanfd)
    ->where('deleted', '=', 'N')
    ->sum('debit');

    $bal =  $balcredit - $baldebit;

    if($bal >= $request->amtfd){

    

    $result = new investment();

    $result->customerid = $request->customerid;
    $result->nuban = $request->nubanfd;
    $result->acctname = $request->accountnamefd;
    $result->fdamt = $request->amtfd;
    $result->paidback = 0;
    $result->fdint = $request->intfd;
    $result->duration = $request->durationfd;
    $result->totalint = $request->totalintfd;
    $result->wht = $request->wht;
    $result->intdue = $request->totaldue;
    $result->maturity = $request->maturitydate;
    $result->predate = $request->predate;

    $result->save();

    $id = $result->id;
    $ref = 'FDB00-'.$id;

    $output = DB::table('investments')
            ->where('id', '=', $id)
            ->update(['ref' => $ref]);


            if($output == true){
                return redirect()->back()->with('message', 'Investment Booking pending Approval'); 
            }else{
                return redirect()->back()->with('message_failed', 'Investment Booking Failed'); 
            }}else{
                return redirect()->back()->with('message_warning', 'Insufficient account Balance'); 
            }

            
}
               
               


public function FDapproval(){
$pendingfd = DB::table('investments')
        ->where('status', '=', 'pending')->get();

    return view('/admin.fdapproval', compact('pendingfd'));
}


public function investmentapprovalcheckf(Request $req){
    $result = DB::table('investments')
            ->where('ref', '=', $req->refi)->get();

            return response()->json([
                                
                'myout' => $result,
        
           
                
            ]);     
}

public function investmentapproval(Request $request){

    if($request->status == 'Approved'){

    $checking = DB::table('customer_details')
            ->where('nuban', '=', $request->nubani)
            ->where('status', '=', 'Active')
            ->count();
      if($checking > 0){ 
        $balcredit = DB::table('ledgers')
        ->where('nuban', '=', $request->nubani)
        ->where('deleted', '=', 'N')
        ->sum('credit');
    
        $baldebit = DB::table('ledgers')
        ->where('nuban', '=', $request->nubani)
        ->where('deleted', '=', 'N')
        ->sum('debit');
    
        $bal =  $balcredit - $baldebit;

        if($bal >= $request->fdamt){

            $narration="Investment Booking(FDB/".$request->duration.'days/'.$request->fdint.'%)';

            DB::table('ledgers')->insert([
                'refno' => $request->reffd,
                'customerid' => $request->acctno,
                'nuban' => $request->nubani,
                'narration' => $narration,
                'debit' => $request->fdamt,
                'user' =>  Auth::user()->name,
                'status' => 'cash_tr',
                'created_at' => Carbon::now(),
                'updated_at' => now(),
               
          
            ]);
            $bal2 = $bal - $request->fdamt;

            DB::table('customer_details')
                ->where('nuban', '=', $request->nubani )
                ->update(['bal' => $bal2]);


                $customer = DB::table('gl_creates')
        ->where('glname', '=', 'Longterm-Deposit')
        ->get();

         DB::table('gl_ledgers')->insert([
            'class_id' => $customer[0]->classid,
            'sub_class_id' => $customer[0]->subclassid,
            'gl_code' => $customer[0]->gl_code,
            'gl_name' => $customer[0]->glname,
            'narration' => $narration,
            'credit' => $request->fdamt,
            'status' => 'cash_tr',
            'user' => Auth::user()->name,
            'refno' =>  $request->reffd,
            'created_at' => Carbon::now(),
            'updated_at' => now()
           
        ]);

        $endresult = DB::table('investments')
                ->where('ref', '=', $request->reffd)
                ->update(['status' => $request->status]);
         if($endresult == true) {
            return redirect()->back()->with('message', 'Investment Approval successful.');
         } else{
            return redirect()->back()->with('message_failed', 'Investment approval failed'); 
         }     
     
 
}else{
    return redirect()->back()->with('message_warning', 'Insufficient account Balance');
}
      }else{
        return redirect()->back()->with('message_warning', 'Investment Account is not Active'); 
      }

    }else{
        DB::table('investments')
        ->where('ref', '=', $request->reffd)
        ->update(['status' => $request->status]);
        return redirect()->back()->with('message_warning', 'Rejected successfully'); 
    }
}


public function investmentmatured(){
    $date= date('Y-m-d', strtotime(now())); 
    $output = DB::table('investments')
           ->where('status','=', 'Approved')
           ->where('maturity','=', $date)
           ->get();

    foreach($output as $item){
        $narration="Investment capital Matured(" .$item->ref .")";

$outcapital = DB::table('ledgers')->insert([
    'customerid' => $item->customerid,
    'refno' => $item->ref,
    'nuban' => $item->nuban,
    'narration' => $narration,
    'credit' => $item->fdamt,
    'user' => 'Auto_Tr',
    'status' => 'cash_tr',
    'created_at' => Carbon::now(),
    'updated_at' => now(),

]);

$customer = DB::table('gl_creates')
->where('glname', '=', 'Longterm-Deposit')
->get();

    DB::table('gl_ledgers')->insert([
    'class_id' => $customer[0]->classid,
    'sub_class_id' => $customer[0]->subclassid,
    'gl_code' => $customer[0]->gl_code,
    'gl_name' => $customer[0]->glname,
    'narration' => $narration,
    'debit' => $item->fdamt,
    'status' => 'cash_tr',
    'user' => Auth::user()->name,
    'refno' =>  $item->ref,
    'created_at' => Carbon::now(),
    'updated_at' => now()
   
]);


            
$narration2= "Interest on Investment Matured(".$item->ref.")"; 

$outint = DB::table('ledgers')->insert([
    'customerid' => $item->customerid,
    'refno' => $item->ref,
    'nuban' => $item->nuban,
    'narration' => $narration2,
    'credit' => $item->intdue,
    'user' => 'Auto_Tr',
    'status' => 'cash_tr',
    'created_at' => Carbon::now(),
    'updated_at' => now(),

]);

$customer2 = DB::table('gl_creates')
->where('glname', '=', 'Interest-Expense')
->get();

    DB::table('gl_ledgers')->insert([
    'class_id' => $customer2[0]->classid,
    'sub_class_id' => $customer2[0]->subclassid,
    'gl_code' => $customer2[0]->gl_code,
    'gl_name' => $customer2[0]->glname,
    'narration' => $narration2,
    'debit' => $item->intdue,
    'status' => 'cash_tr',
    'user' => Auth::user()->name,
    'refno' =>  $item->ref,
    'created_at' => Carbon::now(),
    'updated_at' => now()
   
]);
            
$narration3= "WHT(".$item->ref.")";

$outwht = DB::table('ledgers')->insert([
    'customerid' => $item->customerid,
    'refno' => $item->ref,
    'nuban' => $item->nuban,
    'narration' => $narration3,
    'debit' => $item->wht,
    'user' => 'Auto_Tr',
    'status' => 'cash_tr',
    'created_at' => Carbon::now(),
    'updated_at' => now(),

]);

$customer3 = DB::table('gl_creates')
->where('glname', '=', 'WHT')
->get();

    DB::table('gl_ledgers')->insert([
    'class_id' => $customer3[0]->classid,
    'sub_class_id' => $customer3[0]->subclassid,
    'gl_code' => $customer3[0]->gl_code,
    'gl_name' => $customer3[0]->glname,
    'narration' => $narration3,
    'credit' => $item->wht,
    'status' => 'cash_tr',
    'user' => Auth::user()->name,
    'refno' =>  $item->ref,
    'created_at' => Carbon::now(),
    'updated_at' => now()
   
]);

 if($outcapital==true && $outint==true && $outwht==true){

DB::table('investments')
        ->where('ref', '=', $item->ref)
        ->update([
            
            'paidback' => $item->fdamt,
            'status' => 'Matured',
    
    
                ]);

}               
                
}
}


public function certgenerate(){
    $cert = DB::table('investments')
            ->where('status', '=', 'Approved')
            ->get();
    return view('/admin.cert_generate', compact('cert'));
}
    

public function certificate(Request $request){
    $out = DB::table('investments')
            ->where('ref', '=', $request->ref)
            ->get();

    $company = organization::all();

    $details = DB::table('customer_details')
            ->where('nuban','=', $out[0]->nuban)
            ->get();
    return view('/admin.certificate', compact('out', 'company', 'details'));
}

//loan reversal function .....***


public function investmentreversaldetails(){
    return view('admin.investment_reversal');
}

public function investmentreversalf(Request $request){

    $result = DB::table("investments")
            ->where('ref', '=', $request->ref)
            ->where('status', '=', 'Approved')
            ->get();
            

            return response()->json([
                "output" => $result,
            ]);

}

public function investmentReverse(Request $request){
    $result = DB::table('investments')
    ->where('ref', '=', $request->refrev)
    ->where('status', '=', 'Approved')
    ->count();
if($result > 0){

    $statusL='FDB_Reversed';

    DB::table('investments')
    ->where('ref', '=', $request->refrev)
  ->update([
    'status' => $statusL
  ]);

  $narration2='FD Transaction reversed('.$request->nubanrev.')';

  DB::table('ledgers')
  ->insert([
      'customerid' => $request->acctid,
      'Refno' => $request->refrev,
      'nuban' => $request->nubanrev,
      'narration' => $narration2,
      'credit' => $request->creditrev,
      'user' => Auth::user()->name,
      'status' =>  $statusL,
      'created_at' => Carbon::now(),
      'updated_at' => now()

  ]);

  $narrationfd='FDB/'.$request->nubanrev;

  $glcode2 = DB::table('gl_creates')
->where('glname', '=', 'Longterm-Deposit')
->get();

DB::table('gl_ledgers')->insert([
    'class_id' => $glcode2[0]->classid,
    'sub_class_id' => $glcode2[0]->subclassid,
    'gl_code' => $glcode2[0]->gl_code,
    'gl_name' => $glcode2[0]->glname,
    'narration' => $narrationfd,
    'debit' => $request->creditrev,
    'status' => $statusL,
    'user' => Auth::user()->name,
    'refno' =>  $request->refrev,
    'created_at' => Carbon::now(),
    'updated_at' => now()
   
]);

DB::table('reversals')->insert([
    'ref' => $request->refrev,
    'customerid' => $request->acctid, 
    'nuban' => $request->nubanrev,
    'credit' => $request->creditrev,
    'accttype' => $request->accttype,
    'status' => $statusL,
    'created_at' => Carbon::now(),
    'updated_at' => now()
]);

// $out = DB::table('customer_details')
//                 ->where('nuban', '=', $request->nubanrev)
//                 ->get();

//                 $bal = $out[0]->bal - $request->creditrev;

                $balcredit = DB::table('ledgers')
                ->where('nuban', '=', $request->nubanre)
                ->where('deleted', '=', 'N')
                ->sum('credit');

                $baldebit = DB::table('ledgers')
                ->where('nuban', '=', $request->nubanre)
                ->where('deleted', '=', 'N')
                ->sum('debit');

                $bal =  $balcredit - $baldebit;

             $finalresposense =   DB::table('customer_details')
                    ->where('nuban','=',$request->nubanrev)
                    ->update([
                        'bal' => $bal,
                    ]);

                    if($finalresposense==true){
                        return redirect()->back()->with('message', 'Investment reversal successful'); 
                        } else{
                        return redirect()->back()->with('message_warning', 'Investment reversal Failed'); 
                    }


}else{
    return redirect()->back()->with('message_failed', 'Invalid Reference ID'); 
}
}

public function createaccesstype(){
    $output = DB::table('accesstypes')
    ->where('access','!=', 1)
    ->get();
    return view('admin.createaccesstype', compact("output"));
}



public function insertaccess(Request $req){
    $req->validate([
        'code' => ['required'],
        'access' => ['required'],
        
    ]);


    $check0=DB::table('accesstypes')
        ->where('code','=',$req->code)
        ->orwhere('access','=',$req->access)
        ->count();
   if($check0 >= 1){
    return redirect()->back()->with('message_warning', 'Access type or access code already exist'); 
   }  else{
    $check1=DB::table('accesstypes')
    ->insert([
        'code' => $req->code,
        'access' => $req->access,
        'postingM' =>$req->postingM,
        'userM' =>$req->userM,
        'tellerM' =>$req->tellerM,
        'accountM' =>$req->accountM,
        'glM' =>$req->glM,
        'investmentM' =>$req->investmentM,
        'loanM' =>$req->loanM,
        'transferM' =>$req->intraT,
        'approvalM' =>$req->approvalM,
        'reversalM' =>$req->reversalM,
        'reportM' =>$req->reportM,
        'created_at' => Carbon::now(),
      'updated_at' => now()
    ]);
if($check1==true){
    return redirect()->back()->with('message', 'Access type created Successfully'); 
}else{
    return redirect()->back()->with('message_failed', 'Failed'); 
}
   }
   

}

public function accesstype(){
    $output = DB::table('users')
    ->where('accesstype', '!=', 1)
    ->where('active', '!=', 0)
    ->get();
    $access = DB::table('accesstypes')
    ->where('access','!=', 1)
    ->get();
    return view('admin.accesstype', compact('output','access'));
}

public function addaccesstouser(Request $req){
    $result = DB::table('users')
        ->where('id','=',$req->id)
        ->update([
            'accesstype' => $req->code
        ]);
    if($result==true){
        return redirect()->back()->with('message', 'Access type added Successfully'); 
    }else{
        return redirect()->back()->with('message_failed', 'Failed: You are either updating user with the same access type'); 
    }
}


public function birthday(){
    $date = Strtotime(now());
    $result = date('m-d', $date);
    $out = DB::table('customer_details')
             ->where(DB::raw("(DATE_FORMAT(dob, '%m-%d'))"),'=', $result)
            ->get();

            foreach($out as $item){
                $tel=$item->tel;
                ///sms sending .................................
    
    $owneremail="lollypee4god@gmail.com";
                    $subacct="METRO";
                    $subacctpwd="better";
                    $sendto=$tel; /* destination number */
                    $sender="MetroLend"; /* sender id */
                    $message='Happy birthday to one of our most important clients of all time.Metro Lending celebrates with you.'; /* message to be sent */
                    /* create the required URL */
                    $url = "http://www.smslive247.com/http/index.aspx?"
                    . "cmd=sendquickmsg"
                    . "&owneremail=" . UrlEncode($owneremail)
                    . "&subacct=" . UrlEncode($subacct)
                    . "&subacctpwd=" . UrlEncode($subacctpwd)
                    . "&message=" . UrlEncode($message)
                    . "&sender=" . UrlEncode($sender)
                    .  "&sendto=" . UrlEncode($sendto);
                    /* call the URL */
                    if ($f = @fopen($url, "r"))
                    {
                    $answer = fgets($f, 255);
                    if (substr($answer, 0, 1) == "+")
                    {
                   // echo "SMS to $dnr was successful.";
                    } 
                            
                            
                        }
            }
}
        
//testing code for checkview.................

// public function testdb(){
  

    
// }


// public function testdb3(){


    // return view('admin.checkview3'//);

// }
//end of testing code for checkview.......................





}



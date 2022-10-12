<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\gl_create;
use Illuminate\Http\Request;
use App\Models\account_class;
use App\Models\account_subclass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GlController extends Controller
{
    
public function view_sub_class(){
    $output = account_class::all();
    return view('admin.create_sub_class', compact('output'));
}

//inpute sub class.................

public function subclass(Request $req){


    $req->validate([
        'subclass' => ['required', 'string', 'max:255','unique:account_subclasses'],
        'classid' => ['string', 'max:255'],
        
        
    ]);

    account_subclass::create([
        'subclass' => $req->subclass,
        'classid' => $req->classid,
       
    ]);

    
    
        return redirect()->back()->with('message', 'GL Sub Account created Successful'); 

}

//to display list of sub class......................
public function displaysubfunction(Request $req){
        $customersfetch1 = account_subclass::where('classid', '=', $req->get('out'))->get();
         
        return response()->json([
            'myout' =>  $customersfetch1,
        ]);
        
     }

     public function createglfunction(){
        $output = account_class::all();
        return view('admin.create_gl', compact('output'));
        
     }

     public function glcreatefunction(Request $req){
        $req->validate([
         'glname' => ['required', 'string', 'max:255','unique:gl_creates'],
         'subclassid' => ['required'],
         'classid' => ['required'],
        ]);

         $item = new gl_create();
        
         $item->classid = $req->input('classid');
         $item->subclassid = $req->input('subclassid');
         $item->glname = $req->input('glname');
         $item->save();
         $newid=$item->id;

         $item2 = gl_create::find($item->id);
      /// $glcode= $item2->class_id.$item2->subclass_id.$newid;
         
       if (strlen($newid)==1) {
        $formattedglcode=$item2->classid.$item2->subclassid.'000'.$newid;
       
    }

    if (strlen($newid)==2) {
        $formattedglcode=$item2->classid.$item2->subclassid.'00'.$newid;
       
    }

    if (strlen($newid)==3) {
        $formattedglcode=$item2->classid.$item2->subclassid.'0'.$newid;
       
    }

    if (strlen($newid)==4) {
        $formattedglcode=$item2->classid.$item2->subclassid.$newid;
       
    }
         $item2->gl_code = $formattedglcode;
         $item2->save();

         return redirect()->back()->with('message', 'GL  Account created Successful'); 
   
     }
public function gltogl(){
    $output = gl_create::all();
    return view('admin.gltogl', compact('output'));
}

public function glposting(Request $request){
    //credit ID
    $result = DB::table('gl_creates')
            ->where('id','=',$request->id1)
            ->get();
         $id = DB::table('gl_ledgers')->insertGetId([
                'class_id' => $result[0]->classid,
                'sub_class_id' => $result[0]->subclassid,
                'gl_code' => $result[0]->gl_code,
                'gl_name' => $result[0]->glname,
                'narration' => $request->narration1,
                'credit' => $request->credit,
                'status' => 'successful',
                'user' => Auth::user()->name,
                'refno' =>  'default',
                'created_at' => Carbon::now(),
                'updated_at' => now()
                
            ]);
    $ref = 'GLP/'.$id;
    DB::table('gl_ledgers')
        ->where('id','=',$id)
        ->update([
            'refno' =>  $ref,
        ]);



           //debit ID
    $result2 = DB::table('gl_creates')
    ->where('id','=',$request->id2)
    ->get();
 $idtwo = DB::table('gl_ledgers')->insertGetId([
        'class_id' => $result2[0]->classid,
        'sub_class_id' => $result2[0]->subclassid,
        'gl_code' => $result2[0]->gl_code,
        'gl_name' => $result2[0]->glname,
        'narration' => $request->narration2,
        'debit' => $request->debit,
        'status' => 'successful',
        'user' => Auth::user()->name,
        'refno' =>  'default',
        'created_at' => Carbon::now(),
        'updated_at' => now()
        
    ]);
$reftwo = 'GLP/'.$idtwo;
$out = DB::table('gl_ledgers')
->where('id','=',$idtwo)
->update([
    'refno' =>  $reftwo,
]);

if($out==true){
    return redirect()->back()->with('message', 'GL Posting Successful');
}else{
    return redirect()->back()->with('message_failed', 'GL posting Failed');
}


}


//gl to account

public function gltoacc(){
    $output = gl_create::all();
    return view('admin.gltoacc',compact('output'));
}


public function gltoacctposting(Request $request){
    if(empty($request->nuban1)){

    $result = DB::table('gl_creates')
    ->where('id','=',$request->glcode1)
    ->get();

    $id = DB::table('gl_ledgers')->insertGetId([
        'class_id' => $result[0]->classid,
        'sub_class_id' => $result[0]->subclassid,
        'gl_code' => $result[0]->gl_code,
        'gl_name' => $result[0]->glname,
        'narration' => $request->narration1,
        'credit' => $request->credit,
        'status' => 'successful',
        'user' => Auth::user()->name,
        'refno' =>  'default',
        'created_at' => Carbon::now(),
        'updated_at' => now()
        
    ]);
    $ref = 'GL-Acct/'.$id;
    DB::table('gl_ledgers')
        ->where('id','=',$id)
        ->update([
            'refno' =>  $ref,
        ]);

//second leg 

$customer = DB::table('customer_details')
            ->where('nuban','=', $request->nuban2)
            ->get();

$output = DB::table('ledgers')
->insert([
    'customerid' => $customer[0]->customerid,
    'Refno' => $ref,
    'nuban' => $request->nuban2,
    'narration' => $request->narration2,
    'debit' => $request->debit,
    'user' => Auth::user()->name,
    'status' =>  'successful',
    'created_at' => Carbon::now(),
    'updated_at' => now()
]);

if($output==true){
    return redirect()->back()->with('message', 'GL transaction Successful');
}else{
    return redirect()->back()->with('message_failed', 'GL transaction Failed');
}
    }
    if(empty($request->nuban2)){
        $result2 = DB::table('gl_creates')
        ->where('id','=',$request->glcode2)
        ->get();
    
        $id2 = DB::table('gl_ledgers')->insertGetId([
            'class_id' => $result2[0]->classid,
            'sub_class_id' => $result2[0]->subclassid,
            'gl_code' => $result2[0]->gl_code,
            'gl_name' => $result2[0]->glname,
            'narration' => $request->narration2,
            'debit' => $request->debit,
            'status' => 'successful',
            'user' => Auth::user()->name,
            'refno' =>  'default',
            'created_at' => Carbon::now(),
            'updated_at' => now()
            
        ]);
        $ref2 = 'GL-Acct/'.$id2;
        DB::table('gl_ledgers')
            ->where('id','=',$id2)
            ->update([
                'refno' =>  $ref2,
            ]);
    
    //second leg 
    
    $customer1 = DB::table('customer_details')
                ->where('nuban','=', $request->nuban1)
                ->get();
    
  $output2 =  DB::table('ledgers')
    ->insert([
        'customerid' => $customer1[0]->customerid,
        'Refno' => $ref2,
        'nuban' => $request->nuban1,
        'narration' => $request->narration2,
        'credit' => $request->credit,
        'user' => Auth::user()->name,
        'status' =>  'successful',
        'created_at' => Carbon::now(),
        'updated_at' => now()
    ]);
    if($output2==true){
        return redirect()->back()->with('message', 'GL transaction Successful');
    }else{
        return redirect()->back()->with('message_failed', 'GL transaction Failed');
    }
    }
}




}

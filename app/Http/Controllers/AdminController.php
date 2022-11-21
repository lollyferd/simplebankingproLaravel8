<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function orgreg(){
        return view('/admin.organization');
    }
    
    public function orgsubmit(Request $request){
        $field = $request->validate([
            'company_name' => 'required|string',
            'email' => 'required|string',
            'caddress' => 'required|string',
            'phone' => 'required|string',
            'rc' => 'required|string',
      
           
        ]);
    
        $image=$request->logo;
    
        if($image!=null){
    
            $extensions = array('png', 'jpg', 'jpeg', 'gif');
            $file_ext=$image->getClientoriginalExtension();
                
            if(in_array($file_ext, $extensions)===false){
                    $error[] = "extension not allowed!";
    
                    }
    
         if(empty($error)==true){
        $imagename=time().'.'.$image->getClientoriginalExtension();
    
        $request->logo->move('uploads', $imagename);
    
        
         }
        }
    
        $org = organization::create([
            'company_name' => $field['company_name'],
            'email' => $field['email'],
            'address' => $field['caddress'],
            'phone' => $field['phone'],
            'rc_no' => $field['rc'],
            'logo' => $imagename
            
        ]);
    
        return redirect()->back()->with('message', 'Company Registration successfully'); 
    }
    


    public function deactivate_org(){
      $output = DB::table('users')
            ->where('accesstype', '!=', 1)
            ->where('active', '!=', 0)
            ->get();
        return view('admin.deactivateAllUser', compact('output'));
    }

    public function deactivate_org2(Request $request){
      $out =  DB::table('users')
            ->where('accesstype','!=', 1)
            ->update([
                'active' => $request->deactivate
            ]);

    if($out==true){
        return redirect()->back()->with('message_failed', 'All users successfuly deactivated'); 
    }else{
        return redirect()->back()->with('message_failed', 'no user available');
    }

    }

    public function activate_users(){
        $output = DB::table('users')
        ->where('accesstype', '!=', 1)
        ->where('active', '=', 0)
        ->get();
        return view('admin.activateallusers', compact('output'));
    }

    public function activate_org2(Request $request){
        $out =  DB::table('users')
              ->where('accesstype','!=', 1)
              ->update([
                  'active' => $request->activate
              ]);
  
      if($out==true){
          return redirect()->back()->with('message', 'All users successfuly activated'); 
      }else{
        return redirect()->back()->with('message', 'no user available');
    }
  
      }
}

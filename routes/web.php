<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\GlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/home',[HomeController::class,'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/createuser',[HomeController::class,'createuser']);

Route::post('/registeruser',[HomeController::class,'registeruser']);

Route::get('/add_account_officer',[HomeController::class,'addacctofficer']);

Route::get('/add_account_type',[HomeController::class,'addaccttype']);

Route::post('/uploadacctofficer',[HomeController::class,'uploadacctofficer']);

Route::post('/uploadaccttype',[HomeController::class,'uploadaccttype']);

Route::get('/create_account',[HomeController::class,'create_account']);

Route::post('/getcity',[HomeController::class,'getcity']);

Route::post('/uploadcustomer',[HomeController::class,'uploadcustomer']);

Route::GET('/fetch-customers',[HomeController::class,'fetchcustomers']);

Route::get('/fetch-all-customer',[HomeController::class,'fetchall']);

Route::post('/searchcustomer',[HomeController::class,'searchdata']);

Route::post('/searchcustomerbynuban',[HomeController::class,'searchnuban']);

Route::get('/customer-deposit',[HomeController::class,'depositposting']);

Route::get('/depositfc',[HomeController::class,'searchcustomerdeposit']);

Route::get('/customer-wdr',[HomeController::class,'wdrposting']);

Route::POST('/deposit',[HomeController::class,'depositfunction']);

Route::POST('/wdr',[HomeController::class,'wdrf']);

//** GL management */
Route::get('/sub-class',[GlController::class,'view_sub_class']);

Route::POST('/subclass',[GlController::class,'subclass']);

Route::get('/displaysub',[GlController::class,'displaysubfunction']);

Route::get('/create-GL',[GlController::class,'createglfunction']);

Route::POST('/glcreate',[GlController::class,'glcreatefunction']);

Route::get('/GL-to-GL',[GlController::class,'gltogl']);

Route::POST('/glposting',[GlController::class,'glposting']);

Route::get('/GL-to-Account',[GlController::class,'gltoacc']);
Route::POST('/gltoacctposting',[GlController::class,'gltoacctposting']);

//** GL management end */



//code testing view...........
// Route::get('/check',[HomeController::class,'testdb']);

// Route::get('/checkview3',[HomeController::class,'testdb']);
//code testing view ................

//till balance display...............
    Route::get('/navbar',[HomeController::class,'tillbal']);

//customer ledger display..................
Route::get('/customer-ledger',[HomeController::class,'customerledger']);

//check customer ledger................

Route::POST('/customerL',[HomeController::class,'customerLFS']);

//photo ans signature update view................

Route::get('/account-update',[HomeController::class,'accountupdate']);

//photo and sign update function................

Route::POST('/accountupdated',[HomeController::class,'accountupdated']);

//customer account details update view...............

Route::get('/Edit-Customer-details',[HomeController::class,'customerupdate']);

//customer edit submit.................

Route::POST('/customeredit',[HomeController::class,'customeredit']);

//bank deposit posting view..............
Route::get('/Bank-Deposit',[HomeController::class,'bankdeposit']);

//bank deposit posting view..............
Route::get('/Bank-wdr',[HomeController::class,'bankwdr']);


///working better display of customer details 
Route::get('/detailsdisplay',[HomeController::class,'detailsdisplay']);

//submitting bank posting....................
Route::POST('/bankD',[HomeController::class,'bankD']);


//submitting bank wdr....................
Route::POST('/bankW',[HomeController::class,'bankW']);

//special deduction view....................
Route::get('/Special-Deduction',[HomeController::class,'specialdeduction']);

// get glname for special deduction...........
 Route::POST('/specialdebit',[HomeController::class,'specialdebit']);

 // accoutn status update block...........
 Route::POST('/blockaccount',[HomeController::class,'blockaccount']);

  // accoutn status update unblock...........
  Route::POST('/unblockaccount',[HomeController::class,'unblockaccount']);

  // accoutn status update disable...........
 Route::POST('/disableaccount',[HomeController::class,'disableaccount']);

   // accoutn status update enable...........
   Route::POST('/enableaccount',[HomeController::class,'enableaccount']);

    // FD view...........
    Route::get('/Investment-booking',[HomeController::class,'investmentview']);

     // FD view display calc...........
     Route::post('/investmentcalc',[HomeController::class,'investmentcalc']);

        // FD maturity date calc...........
        Route::post('/fddate',[HomeController::class,'fddate']);

          // FD posting...........
          Route::post('/FD-Posting',[HomeController::class,'FDPosting']);

           // FD approval...........
           Route::GET('/FD-Approval',[HomeController::class,'FDapproval']);

             // display pending investment ...........
     Route::post('/investmentapprovalcheckf',[HomeController::class,'investmentapprovalcheckf']);

      // approval investment method ...........
      Route::post('/investmentapproval',[HomeController::class,'investmentapproval']);

      //investment reversal.............****
      Route::get('/investmentreversaldetails',[HomeController::class,'investmentreversaldetails']);

      Route::POST('/investmentreversalf',[HomeController::class,'investmentreversalf']);

      Route::POST('/investmentReverse',[HomeController::class,'investmentReverse']);


      //................****

         // investment matured method ...........
           //auto run method using crone..............*******
         Route::get('/investmentmatured',[HomeController::class,'investmentmatured']);
         //.............................end auto run method******

            // organization reg ...........
            Route::get('/Organization-Reg',[HomeController::class,'orgreg']);

            Route::POST('/orgsubmit',[HomeController::class,'orgsubmit']);

            //cert generate system
            Route::get('/cert_generate',[HomeController::class,'certgenerate']);

            Route::post('/certificate',[HomeController::class,'certificate']);

            //loan management
            //add loan type

            Route::POST('/addloantype', [LoanController::class, 'addloantype']);
            Route::get('/Flat-Rate-LoanBooking', [LoanController::class, 'loan']);

            Route::POST('/loandisplay', [LoanController::class, 'loandisplay']);

            Route::POST('/loansubmitflat',[LoanController::class, 'loansubmitflat']);

            Route::get('/ReducingBalance-LoanBooking', [LoanController::class, 'reducingloan']);

            Route::POST('/loansubmitreduce',[LoanController::class, 'loansubmitreduce']);

            Route::get('/Loan-Approval', [LoanController::class, 'loanapprovaldisplay']);

            Route::POST('/loanapprovaldisplay',[LoanController::class, 'loanapprovaldisplaydetail']);

            Route::POST('/loanapproval',[LoanController::class, 'loanapproval']);

            //auto run method using crone..............*****

            Route::get('/loandeduction',[LoanController::class, 'loandeduction']);

            Route::get('/loanstatusupdate',[LoanController::class, 'loanstatusupdate']);

            Route::get('/pastdueloan',[LoanController::class, 'pastdueloan']);
           //.............................end auto run method******

           //.............................loan reversal management..............
           //loan reversal page display
           Route::get('/loanreversal',[LoanController::class, 'loanreversal']);

            //loan reversal details display
           Route::POST('/loanreversalf',[LoanController::class, 'loanreversalf']);
          //loan reversal function
           Route::POST('/loanreversalfunction',[LoanController::class, 'loanreversalfunction']);

         
//**** */Transfer Modul

Route::get('/Intra-Transfer',[TransferController::class, 'transfer']);

Route::Post('/transferreceiver',[TransferController::class, 'transferreceiver']);
Route::Post('/transfersender',[TransferController::class, 'transfersender']);

Route::Post('/transferfunction',[TransferController::class, 'transferfunction']);


Route::get('/Intra-Transfer-Approval',[TransferController::class, 'transferapproval']);

Route::Post('/transferapprovaldisplay',[TransferController::class, 'transferapprovaldisplay']);

Route::Post('/trfapproval',[TransferController::class, 'trfapproval']);

//**transfer reversal */

Route::get('/Transfer-Reversal',[TransferController::class, 'transferreversal']);

Route::POST('/transferreversalf',[TransferController::class, 'transferreversalf']);

Route::POST('/trfreversalfunction',[TransferController::class, 'trfreversalfunction']);


//**end transfer reversal */


//*** */
      



          

     

     




















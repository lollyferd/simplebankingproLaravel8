
    @include('admin.apphead')
    
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
        <div class="container-fluid">
          <!-- Body here -->

<div class="card">

    <div class="card-body" onmouseover="trfsenders()" style="background-color: #0A043E">

      <h5 class="card-title text-center wht">Special Account Deduction</h5><br>

     
     <div class="row">
      <div class="col-md-4"></div>
    
      
      <div class="col-md-4">
       {{-- begining of success message  --}}
       @if (session()->has('message'))

       <div class="alert alert-success text-center">
           <button type="button" class="close" data-dismiss="alert">x</button>
       {{ session()->get('message') }}
       </div>
       @endif

       @if (session()->has('message_failed'))
       <div class="alert alert-danger text-center">
          <button type="button" class="close" data-dismiss="alert">x</button>
      {{ session()->get('message_failed') }}
      </div>
           
       @endif

       @if (session()->has('message_warning'))
       <div class="alert alert-warning text-center">
          <button type="button" class="close" data-dismiss="alert">x</button>
      {{ session()->get('message_warning') }}
      </div>
           
       @endif
       
       {{-- End of success message  --}}
       <x-jet-validation-errors class="mb-4" />
      </div>
   
      <div class="col-md-4"></div>
       
     </div>



    
      

      <form method="POST" id="trf" action="{{ url('specialdebit') }}" autocomplete="off">
          @csrf
        <div class="row">
        <div class="col-md-6 wht">
          <h1>Customer Account</h1>
        </div>

        <div class="col-md-6"></div>
        
      </div>
        <div class="row form-group">
      <input type="text" name="nuban11" id="nuban11" class="form-control col-md-3 font-weight-bold" placeholder=" Enter Account Number" onchange="trfsenders()" onmouseout="trfsenders()" onkeyup="trfsenders()" style="color: green">
      <div class="col-md-1"><span id="status" style="color:yellow"></span></div>
      <input type="text" name="displayname" id="displayname" class="form-control col-md-4 font-weight-bold" placeholder="Account Name" readonly="readonly" style="color: green">
      <div class="col-md-1"></div>

      <input type="text" name="accttype" id="accttype" class="form-control col-md-3 font-weight-bold" placeholder="Account type" readonly="readonly" style="color: green">

           </div>

           <div class="row form-group">
      <textarea name="displaybal" id="displaybal" class="col-md-2 form-control font-weight-bold" placeholder="Balance" style="color: green" readonly></textarea>

<div class="col-md-2"></div>
        <textarea name="narration" id="narration" class="col-md-4 form-control font-weight-bold" placeholder="narration" style="color: green">Special deduction:-</textarea>
        <div class="col-md-2"></div>

      <textarea name="debit" id="debit" class="col-md-2 form-control font-weight-bold" placeholder="Amount" style="color: green" onkeyup="trfsenders()"></textarea>
        <input type="hidden" name="customerid" id="customerid">
        

           </div>

           <hr class="tf">

           <div class="row">
        <div class="col-md-4 wht">

     <!--      GL details for special deductions  -->

    
          <h1>Receiver GL</h1>
        </div>

        <div class="col-md-8"></div>
        
      </div>
        <div class="row form-group">
            <div class="col-md-3">
                   
                <select class="form-control" name="glkcode" id="glkcode">
              
				@foreach ($result as $item )
                <option value="{{  $item->gl_code}}">{{ $item->glname }}</option>
                 @endforeach
                 </select>

                </div>
      {{-- <input type="text" name="glcodesp" id="glcodesp" class="form-control col-md-3 font-weight-bold" placeholder="Enter GL Code" onchange="special_deduction_auto()" onmouseout="special_deduction_auto()" onkeyup="special_deduction_auto()" style="color: green"> --}}
      <div class="col-md-1"></div>


      <input type="text" name="glname" id="glname" class="form-control col-md-4 font-weight-bold" placeholder="GL Code" readonly="readonly" style="color: green">
      <div class="col-md-1"></div>

      <input type="text" name="deductionamt" id="deductionamt" class="form-control col-md-3 font-weight-bold" placeholder="Deduction Amount" readonly="readonly" style="color: green">

       
        

           </div>

           

           <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" name="send" class="btn btn-secondary btn-block button button1">Deduct</button>
            </div>
            <div class="col-md-4"></div>
            
           </div>

      </form>
















</div>
  </div>

    {{-- end of body         --}}
</div>       
</div> 
@include('admin.appfooter');
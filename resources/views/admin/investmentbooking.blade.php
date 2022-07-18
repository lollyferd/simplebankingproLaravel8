
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
            <div class="card-body" style="background-color: #0A043E">
        
                
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center wht">
        <h3>Investment Booking</h3>
        </div>
        <div class="col-md-4"></div>
        </div><br>


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
	   
                        <x-jet-validation-errors class="mb-4"/>
	   
						
						{{-- End of success message  --}}
						
        
        
        
        
        
        <form action="{{ url('FD-Posting') }} " id="fdform" method="POST" autocomplete="off" onmouseover="fdbooking()" >
            @csrf
            <div class="form-group row">
                
                    <label for="accountnofd" class="col-form-label col-md-2 wht font-weight-bold">Account Number</label>
                    <div class="col-md-4">
                    <input type="text" name="nubanfd" id="nubanfd" class="form-control myedit" onkeyup="fdbooking()" onclick="fdbooking()" onchange="fdbooking()">
                    <input type="hidden" name="customerid" id="customerid">
                </div>
        
        
                <label for="accountnamefd" class="col-form-label col-md-2 wht font-weight-bold">Account Name</label>
                    <div class="col-md-4">
                    <input type="text" name="accountnamefd" id="accountnamefd" class="form-control font-weight-bold" readonly>
                </div>
        
            </div><br><br>
        
            <div class="form-group row">
                <label for="balfd" class="col-form-label col-md-2 wht font-weight-bold">Balance</label>
        
                <div class="col-md-4">
                    <textarea name="balfd" id="balfd"  class="form-control  font-weight-bold" readonly></textarea>
                </div>
                <label for="amtfd" class="col-form-label col-md-2 wht font-weight-bold">Investment Amount</label>
        
                <div class="col-md-4">
                    <textarea name="amtfd" id="amtfd" class="form-control  font-weight-bold" onkeyup="fdbooking()"></textarea>
                </div>
        
            </div>
        
        
        <div class="form-group row">
                <label for="intfd" class="col-form-label col-md-2 wht font-weight-bold">Interest(&#37)</label>
        
                <div class="col-md-2">
                    <input type="text" name="intfd" id="intfd" class="form-control myedit" onkeyup="fdbooking()" >
                </div>

                <div class="col-md-4">
                     <label for="totalintfd" class=" wht font-weight-bold">Expected Interest</label>
                </div>
                <label for="durationfd" class="col-form-label col-md-2 wht font-weight-bold">Duration(days)</label>
        
                <div class="col-md-2">
                    <input type="text" name="durationfd" id="durationfd" class="form-control myedit"  onkeyup="fdbooking()" >
                    
                </div>
        
        
            </div><br>
        <hr class="thick-fd"><br><br>
        
        <div class="form-group row">
        
        <label for="totalintfd" class="col-md-2 wht font-weight-bold">Expected Interest</label> 
        <div class="col-md-3">
            <textarea class="form-control" name="totaldue" id="totaldue" readonly="readonly"></textarea>
            <input type="hidden" name="totalintfd" id="totalintfd">
            <input type="hidden" name="typeofacct" id="typeofacct">
        </div>
        
        <label for="maturitydate" class="col-md-2 wht font-weight-bold">maturity date</label>
        <input type="text" name="maturitydate" id="maturitydate" class="form-control col-md-2" readonly="readonly">
        <input type="hidden" id="wht" name="wht">
        <label for="predate" class="col-md-1 wht">Start-Date</label>
        <input type="date" name="predate" id="predate" class="col-md-2 form-control" onchange="fdbooking()">
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
        <input type="submit" name="fd" id="fd" class="btn btn-secondary btn-block button button1">
        </div>
        <div class="col-md-2"></div>
        </div>
        
        </form>
            </div>
          </div>
              

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
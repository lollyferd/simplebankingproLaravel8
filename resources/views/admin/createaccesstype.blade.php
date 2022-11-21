
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
            <div class="card-body mgbg31 ">
             
        
          
              
        
                    <div class="row">
        
                <div class="col-md-3"></div>
                <div class="col-md-6">
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
                <div class="col-md-3"></div>
                        
                    </div>

        
        <form method="POST" action="{{ url('insertaccess') }}" autocomplete="off">
            @csrf
            <div class="form-group row">
            <label class="col-md-2" for="user">Access type list</label>
            <select class="col-md-4 form-control" id="id" >
             @foreach ($output as $item )
             <option value=""><?php echo $item->access.' [code: '.$item->code.']' ?></option> 
             @endforeach
        
                
        
            
            </select>
            <label class="col-md-2" for="Status">Access type</label>
            <input type="text" class="form-control col-md-2" id="access" name="access"><br>
            <label class="col-md-1"> code</label>

            <input type="text" class="form-control col-md-1" id="code" name="code">
            
        </div>

        <div class="row">
<div class="col-md-4">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="YES" id="postingM" name="postingM">
        <label class="form-check-label" for="postingM" style=" color:white">
        Posting Management
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="YES" id="userM" name="userM">
        <label class="form-check-label" for="userM" style=" color:white">
          User management
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="YES" id="tellerM" name="tellerM">
        <label class="form-check-label" for="tellerM" style=" color:white">
        Teller Management
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="YES" id="accountM" name="accountM">
        <label class="form-check-label" for="accountM" style=" color:white">
          Account Management
        </label>
      </div>
</div>
      <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="glM" name="glM">
            <label class="form-check-label" for="glM" style=" color:white">
            GL Management
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="investmentM" name="investmentM">
            <label class="form-check-label" for="investmentM" style=" color:white">
            Investment management
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="loanM" name="loanM">
            <label class="form-check-label" for="loanM" style=" color:white">
            Loan Management
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="intraT" name="intraT">
            <label class="form-check-label" for="intraT" style=" color:white">
              Intra Bank Transfer
            </label>
          </div>
      </div>
      <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="approvalM" name="approvalM">
            <label class="form-check-label" for="approvalM" style=" color:white">
            Approval Management
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="reversalM" name="reversalM">
            <label class="form-check-label" for="reversalM" style=" color:white">
            Reversal management
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="YES" id="reportM" name="reportM">
            <label class="form-check-label" for="reportM" style=" color:white">
            Report management
            </label>
          </div>
   
      
      </div>
</div>
 
        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
        <button type="submit" class="btn btn-secondary btn-block button button1" id="update">Update</button>
        </div>
        
            <div class="col-md-4"></div>
            
        </div>
        
        </form>
        
     
        
        </div></div>        

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
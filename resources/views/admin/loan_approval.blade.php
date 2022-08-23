
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
            <div class="col-md-6"></div>
            <div class="col-md-3 tex-center wht">
                <h4>Loan Approval</h4>
            </div>
            <div class="col-md-3"></div>
        </div><br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 tex-center wht">
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
            </div>
            <div class="col-md-3"></div>
        </div>
          
        
        
        
        <form method="POST" action="" class="ignor-print" id="loandisplay">
            @csrf
            <div class="form-group row">
             <div class="col-md-2"></div>
            <label class="col-md-2 wht" for="user" >Select Pending loans</label>
            <div class="col-md-6">
            <select class="form-control" name="refloan" id="refloan" onchange="loanapprovalcheck()">
            <option selected="selected">Choose</option>
                
            <?php
            foreach($output as $item){
                ?>

            <option value="<?php echo $item->ref; ?>"><?php echo $item->acctname.' - '. $item->nuban.' ('. $item->ref.')'; ?></option>



           <?php } ?>

               
        
        
               
        
 
            </select><br>
            <small id="noteap"></small>
        </div>
        <div class="col-md-2"></div>
        </div>
        
        
        
        
        
        
        </form><br><br>
        
        
        
        </div>
        </div><br>
        
        
        
        
        <!-- approval display -->
        
        <form id="loanapp" method="POST" action="{{ url('loanapproval') }}">
            @csrf
        <div class="container">
        <div class="row">
        
            <!-- <div class="col-md-1"></div> -->
            
        
            <div class="col-md-10" >
                <div class="row">
                    <div class="col-md-3 form-group">
        
                        <label class="labelapprove">RefNo:</label>
                        <input type="text" name="refaploan" id="refaploan" class="form-control myeditapprova" readonly="readonly" >
                        
                    </div>
        
                    <div class="col-md-3">
                        <label class="labelapprove">Acct No:</label>
                        <input type="text" name="nubanap" id="nubanap" class="form-control myeditapprova" readonly="readonly">
                        <input type="hidden" name="acctno" id="acctno">
                        
                    </div>
        
                    <div class="col-md-6">
                        <label class="labelapprove">Acct Name:</label>
                        <input type="text" name="acctnameloan" id="acctnameloan" class="form-control myeditapprova" readonly="readonly">
        
                    
                        
                    </div>
                    
                </div><br>
        
        <!-- ........................................ -->
        
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="labelapprove">loan Amt:</label>
                        <input type="text" name="loanamtap" id="loanamtap" class="form-control myeditapprova" readonly="readonly">
        
                        
                    </div>
        
                    <div class="col-md-2">
                        <label class="labelapprove">Rate %:</label>
                        <input type="text" name="rateap" id="rateap" class="form-control myeditapprova" readonly="readonly">
        
                        
                    </div>
        
                    <div class="col-md-2">
                        <label class="labelapprove">Duration:</label>
                        <input type="text" name="pap" id="pap" class="form-control myeditapprova" readonly="readonly">
        
                        
                    </div>
        
                    <div class="col-md-4">
                        <label class="labelapprove">Monthly deductn:</label>
                        <input type="text" name="mdeductionap" id="mdeductionap" class="form-control myeditapprova" readonly="readonly">
        
                        
                    </div>
                    
                </div>
        <!-- .......................................... -->
        
        
        
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="labelapprove">Total repaymt:</label>
                        <input type="text" name="totalrepayap" id="totalrepayap" class="form-control myeditapprova" readonly="readonly">
                        
                    </div>
        
                    <div class="col-md-4">
        
                        <label class="labelapprove">first deductn date:</label>
                        <input type="text" name="fdeductionap" id="fdeductionap" class="form-control myeditapprova" readonly="readonly">
                        
                    </div>
        
                    
        
                    <div class="col-md-4">
                        <label class="labelapprove">loan date:</label>
                        <input type="text" name="loandateap" id="loandateap" class="form-control myeditapprova" readonly="readonly">
                        
                    </div>
                    
                </div>
        
                <!-- ........................................ -->
        
            </div>
        
        
            <div class="col-md-2">
        
        <select class="form-control" name="status">
            <option value="Approved">Approve</option>
            <option value="Rejected">Reject</option>
        </select><br><br>
        
                <button type="submit" class="btn btn-info button button1">Submit</button><br><br><br>
        
        
                
            </div>
            
        </div>
        </div>
        
        </form>
                  

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
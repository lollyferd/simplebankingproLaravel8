
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
                <h4>Investment Approval</h4>
            </div>
            <div class="col-md-3"></div>
        </div><br>
        
        
        
        <form method="POST" action="" class="ignor-print" id="fddisplay">
            @csrf
            <div class="form-group row">
             <div class="col-md-2"></div>
            <label class="col-md-2 wht" for="user" >Select Pending Investment for Approval</label>
            <div class="col-md-6">
            <select class="form-control" name="refi" id="refi" onchange="investmentapprovalcheck()">
            <option selected="selected">Choose</option>
          
               @foreach  ($pendingfd as $item)
                        <option value="{{ $item->ref }}">{{ $item->nuban.' ('.$item->ref.')' }}</option>
                        @endforeach
            
              
     
              
              
          
                 
            </select><br>
            <small id="notefd"></small>
        </div>
        <div class="col-md-2">
       
          
           
        
        </div>
        </div>
        
        
        
        
        
        
        </form><br><br>
        
      
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

        
        </div>
        
        
        </div><br>
        
        
        
        
        <!-- approval display -->
        
        <form method="POST" action="{{ url('investmentapproval') }}">
            @csrf
        <div class="container">
        <div class="row">
        
            <!-- <div class="col-md-1"></div> -->
            
        
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 form-group">
        
                        <label class="labelapprove">RefNo:</label>
                        <input type="text" name="reffd" id="reffd" class="form-control myeditapprova" readonly="readonly" >
                        
                    </div>
        
                    <div class="col-md-3">
                        <label class="labelapprove">Acct No:</label>
                        <input type="text" name="nubani" id="nubani" class="form-control myeditapprova" readonly="readonly">
                        <input type="hidden" name="acctno" id="acctno">
                        
                    </div>
        
                    <div class="col-md-6">
                        <label class="labelapprove">Acct Name:</label>
                        <input type="text" name="acctnamei" id="acctnamei" class="form-control myeditapprova" readonly="readonly">
        
                    
                        
                    </div>
                    
                </div><br>
        
        <!-- ........................................ -->
        
                <div class="row form-group">
                    <div class="col-md-5">
                        <label class="labelapprove">Investment Amount:</label>
                        <input type="text" name="fdamt" id="fdamt" class="form-control myeditapprova" readonly="readonly">
        
                    </div>
        
                    <div class="col-md-2"></div> 
        
                    <div class="col-md-5">
                        <label class="labelapprove">Investment Int %</label>
                        <input type="text" name="fdint" id="fdint" class="form-control myeditapprova" readonly="readonly">
        
                        
                    </div>
        
                
                    
                    
                </div>
        <!-- .......................................... -->
        
        
        
                <div class="row form-group">
                    <div class="col-md-5">
                        
                        <label class="labelapprove">Total Int:</label>
                        <input type="text" name="totalint" id="totalint" class="form-control myeditapprova" readonly="readonly">
                    </div>
        
                    <div class="col-md-2"></div> 
        
                    <div class="col-md-5">
                        <label class="labelapprove">maturity:</label>
                        <input type="text" name="maturity" id="maturity" class="form-control myeditapprova" readonly="readonly">
                        <input type="hidden" name="duration" id="duration">
                        {{-- <input type="hidden" name="acctbali" id="acctbali"> --}}
                        
                    </div>
        
                    
        
                    
                    
                </div>
        
                <!-- ........................................ -->
        
            </div>
        
        
            <div class="col-md-2">
        
        <select class="form-control" name="status">
            <option value="Approved">Approve</option>
            <option value="Rejected">Reject</option>
        </select><br><br>
        
                <button type="submit" class="btn btn-info btn-block button button1"  name="Approved">Confirm</button><br><br><br>
        
        
                
            </div>
            
        </div>
        </div>
        
        </form>
        
        
        
        
        
        
        
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
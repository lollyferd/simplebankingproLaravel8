
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
        
        
                <h5 class="card-title text-center wht">Intra Bank Transfer Approval</h5><br>
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
                
        
        
        
        <form method="POST" action="" class="ignor-print" id="tfdisplay">
            @csrf
            <div class="form-group row">
             <div class="col-md-2"></div>
            <label class="col-md-2 wht" for="user" >Select Pending Intra Bank Transfer</label>
            <div class="col-md-8">
            <select class="form-control" name="reft" id="reft" onclick="transferapprovalcheck()" onchange="transferapprovalcheck()">
                <option selected="selected">Choose</option>
                <?php
                foreach($output as $item){
                    ?>
    
                <option value="<?php echo $item->ref; ?>"><?php echo 'FROM: '.$item->sendername.' - '. $item->sendernuban.' TO: '.$item->receivername.'-'.$item->receivernuban.' ('. $item->ref.')'; ?></option>
    
    
    
               <?php } ?>
    


            </select><br>
            <small id="notetf"></small>
        </div>
        {{-- <div class="col-md-2"> </div> --}}
        </div>
        

        </form><br><br>
        
   
        </div>
        
        
        </div><br>
        
        <div id="trfdp">
            
        </div>
        
        
        <!-- approval display -->
        
        <form id="trfff" method="POST" action="{{ url('trfapproval') }}">
            @csrf
        <div class="container">
        <div class="row">
        
            <!-- <div class="col-md-1"></div> -->
            
        
            <div class="col-md-10">
        
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><h4 style="color: orange">SENDER</h4></div>
                    <div class="col-md-7"><span style="color: orange">Transfer Initiated on: </span><span id="trfdate" style="color: white"></span></div>
                </div>
        
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label class="labelapprove">Acct No:</label>
                        <input type="text" name="trfnuban" id="trfnuban" class="form-control myeditapprova" readonly="readonly">
                        
                    </div>
        
                    <div class="col-md-3">
                        <label class="labelapprove">Acct name:</label>
                        <input type="text" name="trfname" id="trfname" class="form-control myeditapprova" readonly="readonly">
                        <input type="hidden" name="trfacctno" id="trfacctno">
                        <input type="hidden" name="reftrf" id="reftrf">
                        
                    </div>
        
                    <div class="col-md-3">
                        <label class="labelapprove">Acct type:</label>
                        <input type="text" name="trftype" id="trftype" class="form-control myeditapprova" readonly="readonly">
                    </div>
        
                    <div class="col-md-3">
                        <label class="labelapprove">Amount:</label>
                        <input type="text" name="trfamt" id="trfamt" class="form-control myeditapprova" readonly="readonly">
                    </div>
                    
                </div><br>
        
        <!-- ........................................ -->
        <hr class="ledger">
        
        <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><h4 style="color: orange">RECEIVER</h4></div>
                    <div class="col-md-4"></div>
                </div>
        
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="labelapprove">Acct No:</label>
                        <input type="text" name="nubantrfr" id="nubantrfr" class="form-control myeditapprova" readonly="readonly">
                        <input type="hidden" name="acctnotrfr" id="acctnotrfr">
                    </div>
        
                    <div class="col-md-4">
                        <label class="labelapprove">Acct Name:</label>
                        <input type="text" name="nametrfr" id="nametrfr" class="form-control myeditapprova" readonly="readonly">
                    </div>
        
                        <div class="col-md-4">
                        <label class="labelapprove">Acct Type</label>
                        <input type="text" name="typetrfr" id="typetrfr" class="form-control myeditapprova" readonly="readonly">
                    </div>
        
                    <!-- <div class="col-md-3">
                        <label class="labelapprove">Amount</label>
                        <input type="text" name="amttrfr" id="amttrfr" class="form-control myeditapprova" readonly="readonly">
                    </div> -->
        
        
                
                    
                    
                </div>
        <!-- .......................................... -->
        
        
            </div>
        
        
            <div class="col-md-2">
        
        <select class="form-control" name="status">
            <option value="Approved">Approve</option>
            <option value="Rejected">Reject</option>
        </select><br><br>
        
                <button type="submit" class="btn btn-info"  name="Approved" onclick="trfnow()">Approve</button><br><br><br>
        
        
                
            </div>
            
        </div>
        </div>
        
        </form>
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
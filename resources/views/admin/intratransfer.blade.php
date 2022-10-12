
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
        
                <h5 class="card-title text-center wht">Intra Bank Transfer</h5><br>
        
  
        
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
                
        
                <form method="POST" id="trf" autocomplete="off" action="{{ url('transferfunction') }}">
                    @csrf
                    <div class="row">
                    <div class="col-md-4 wht">
                        <h1>Sender</h1>
                    </div>
        
                    <div class="col-md-8"></div>
                    
                </div>
                    <div class="row form-group">
                <input type="text" name="sendernuban" id="sendernuban" class="form-control col-md-3 font-weight-bold" placeholder=" Enter Account Number" onchange="trfsenders()" onmouseout="trfsenders()" onkeyup="trfsenders()" style="color: green">
                <div class="col-md-1"></div>
                <input type="text" name="sendername" id="sendername" class="form-control col-md-4 font-weight-bold" placeholder="Account Name" readonly="readonly" style="color: green">
                <div class="col-md-1"></div>
        
                <input type="text" name="senderaccttype" id="senderaccttype" class="form-control col-md-3 font-weight-bold" placeholder="Account type" readonly="readonly" style="color: green">
        
                   </div>
        
                   <div class="row form-group">
                <textarea name="senderbal" id="senderbal" class="col-md-4 form-control font-weight-bold" placeholder="Balance" style="color: green"></textarea>
        
        
                <div class="col-md-4"></div>
        
                <textarea name="senderamount" id="senderamount" class="col-md-4 form-control font-weight-bold" placeholder="Amount" style="color: green" onkeyup="trfsenders()"></textarea>
                {{-- <input type="hidden" name="senderacctid" id="senderacctid"> --}}
                
        
                   </div>
        
                   <hr class="tf">
        
                   <div class="row">
                    <div class="col-md-4 wht">
                        <h1>Receiver</h1>
                    </div>
        
                    <div class="col-md-8"></div>
                    
                </div>
                    <div class="row form-group">
                <input type="text" name="receivernuban" id="receivernuban" class="form-control col-md-3 font-weight-bold" placeholder="Enter Account Number" onchange="trfreceiver()" onmouseout="trfreceiver()" onkeyup="trfreceiver()" style="color: green">
                <div class="col-md-1"></div>
        
        
                <input type="text" name="receivername" id="receivername" class="form-control col-md-4 font-weight-bold" placeholder="Account Name" readonly="readonly" style="color: green">
                <div class="col-md-1"></div>
        
                <input type="text" name="receiveraccttype" id="receiveraccttype" class="form-control col-md-3 font-weight-bold" placeholder="Account type" readonly="readonly" style="color: green">
        
               {{-- <input type="hidden" name="receiveracctid" id="receiveracctid"> --}}
                
        
                   </div>
        
                   
        
                   <div class="row">
                       <div class="col-md-4"></div>
                       <div class="col-md-4">
                           <button type="submit" name="send" class="btn btn-secondary btn-block button button1">SEND</button>
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

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
        
          <div class="col-md-12">
            <div class="card">
              <div class="card-body" style="background-color: #0A043E">
          
                  <h3 class="text-center wht">WITHDRAWAL</h3>
          
          
          

          
           
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
          
                  <form method="POST" id="mydepositform" action="{{ url('wdr') }}" autocomplete="off">
                      @csrf
                      <div class="form-group row">
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                          <input type="text" name="nuban11" id="nuban11" placeholder="Account Number" class="form-control myedit">
                          <input type="hidden" name="customerid" id="customerid">
                           <input type='hidden' id='tel' name='tel'>
                      </div>
                          <div class="col-md-2">
                            <span id="status" style="color:yellow"></span>
                          </div>
                          <div class="col-md-2"></div>
                      </div>
          
          
                      <div class="form-group row">
                          <div class="col-md-6" >
                          <input type="text"  id="displayname" placeholder="Customer Name" class="form-control myedit" readonly="readonly">
                      </div>
          
                      <div class="col-md-6" >
                          <input type="text" id="displaybal" name="displaybal" placeholder="Balance" readonly="readonly" class="form-control myedit" >
                      </div>
                          
                      </div>
          
          
                      <div class="form-group row">
                          <div class="col-md-4">
                              
                              <textarea class="form-control" cols="5" rows="3" name="narration" id="narration">Cash withdrawal by </textarea>
                              <small class="wht">Transaction Narration</small>
          
                          </div>
                          <div class="col-md-4">
                          <input type="text" name="debit" id="debit" placeholder="Enter Withdrawal Amount" class="form-control font-weight-bold">
                      </div>
                          <div class="col-md-4">
                              <button type="submit" class="btn btn-secondary btn-block button button1" id="validwdr">Withdrawal</button>
                          </div>
                      </div>
          
                  </form>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          </div>
          </div>
          </div>
       

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
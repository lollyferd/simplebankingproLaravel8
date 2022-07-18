
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
          
                  <h3 class="text-center wht">DEPOSIT</h3>
                   
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
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
            <div class="col-md-2"></div>
            
        </div> 

    <form method="POST" id="mydepositform" action="{{ url('deposit') }}" autocomplete="off">
        @csrf
        <div class="form-group row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <input type="text" name="nuban11" id="nuban11" placeholder="Account Number" class="form-control myedit" >
        </div>
            <div class="col-md-2">
                <span id="status" style="color:yellow"></span>
            </div>
            <div class="col-md-2"></div>
        </div>


        <div class="form-group row">
            <div class="col-md-6" >
                 <input type='hidden' id='tel' name='tel'>
            <input type="text" name="displayname" id="displayname" placeholder="Customer Name" class="form-control myedit" readonly="readonly" >
            <input type="hidden" name="customerid" id="customerid">
            <input type='hidden' id='tel' name='tel'>
        </div>

        <div class="col-md-6" >
            <input type="text" id="displaybal" name="displaybal" placeholder="Balance" readonly="readonly" class="form-control myedit" >
        </div>
            
        </div>


        <div class="form-group row">
            <div class="col-md-4">
                
                <textarea class="form-control" cols="5" rows="3" name="narration" id="narration">Cash deposit by </textarea>
                <small class="wht">Transaction Narration</small>

            </div>
            <div class="col-md-4">
            <input type="text" name="credit" placeholder="Enter Deposit Amount" class="form-control font-weight-bold" id="credit">
        </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary btn-block button button1" id="validdp">Deposit</button>
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
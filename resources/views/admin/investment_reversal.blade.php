
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
            <div class="col-md-2"></div>
            <div  class="col-md-6">
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
                
        <form id="investmentreversalform" method="POST" action="{{ url('investmentReverse') }} " autocomplete="off">
            @csrf
        
            <div class="form-group row">
                <div class="col-md-6">
                <input type="text" name="ref" id="ref" placeholder="Enter transaction ID" class="form-control" onchange="investmentreversal()" onmouseout="investmentreversal()">
                <input type="hidden" name="nubanrev" id="nubanrev">
                <input type="hidden" name="refrev" id="refrev">
                <input type="hidden" name="acctid" id="acctid">
                <input type="hidden" name="creditrev" id="creditrev">
                <input type="hidden" name="acctnamerev" id="acctnamerev">
                <input type="hidden" name="accttype" id="accttype" value="Investment Booking">
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger btn-block" type="submit" id="reversalinv">Investment Reversal</button>
            </div>
            </div>
        
            <textarea id="notifyinfoinvestment" style="color" cols="50" rows="4" readonly="readonly"></textarea>
        
        </div>
        </form>
        
        </div>
        
            <div class="col-md-4"></div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div></div>       

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
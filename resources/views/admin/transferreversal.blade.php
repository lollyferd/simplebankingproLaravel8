
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
                
           
        <form id="trfreversal" method="POST" action="{{ url('trfreversalfunction') }} " autocomplete="off">
            @csrf
        
            <div class="form-group row">
                <div class="col-md-6">
                <input type="text" name="reft" id="reft" placeholder="Enter transaction ID" class="form-control"  onmouseout="transferreversalview()" onchange="transferreversalview()">
                <input type="hidden" name="nubantrfrev" id="nubantrfrev">
                <input type="hidden" name="acctidrev" id="acctidrev">
                <input type="hidden" name="amtrev" id="amtrev">
                <input type="hidden" name="nubantrfrev2" id="nubantrfrev2">
                <input type="hidden" name="acctidrev2" id="acctidrev2">
                
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger btn-block" type="submit">Transfer Reversal</button>
            </div>
            </div>
        
            <textarea id="notifyinfotransfer" cols="50" rows="4" readonly="readonly" style="color: black"></textarea>
        
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
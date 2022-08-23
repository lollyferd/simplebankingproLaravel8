
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
            <?php echo @$outputreverse; ?>
        <form id="loanreversalform" method="POST" action=" " autocomplete="off">
            @csrf
        
            <div class="form-group row">
                <div class="col-md-6">
                <input type="text" name="ref" id="ref" placeholder="Enter transaction ID" class="form-control" onchange="loanreversal()" onmouseout="loanreversal()">
                <input type="hidden" name="nubanrevloan" id="nubanrevloan">
                <input type="hidden" name="refrevloan" id="refrevloan">
                <input type="hidden" name="acctidloan" id="acctidloan">
                <input type="hidden" name="creditrevloan" id="creditrevloan">
                <input type="hidden" name="acctnamerevloan" id="acctnamerevloan">
                <input type="hidden" name="accttype" id="accttype" value="LOAN ACCOUNT">
                <input type="hidden" name="totalrepay" id="totalrepay">
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger btn-block" type="submit" id="reversalinv">Loan Reversal</button>
            </div>
            </div>
        
            <textarea id="notifyinfoinvestment" cols="50" rows="4" readonly="readonly" style="color: black"></textarea>
        
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
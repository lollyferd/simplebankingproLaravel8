
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

            <div class="card-body wht" style="background-color: #0A043E" onmouseover="loandisplay()"  >
        
                <h5 class="card-title text-center">Loan Booking</h5><br>
        
      
        
                         <div class="row">
              <div class="col-md-4"></div>
             
              <div class="col-md-4">
          
              </div>
          
              <div class="col-md-4"></div>
               
             </div>
                
        
                <form id="loanbookingform" method="POST" action="" autocomplete="off">
                    @csrf
                <div class="row form-group" >
                    <label class="col-md-2 font-weight-bold wht" for="acctnubanloan">Account number</label>
                    <input type="text" name="acctnubanloan" id="acctnubanloan" class="form-control col-md-4 font-weight-bold" onchange="loandisplay()" onkeyup="loandisplay()">
                    <input type="hidden" name="customerid" id="customerid" >
                <div class="col-md-2"></div>
                    
                    <label class="col-md-2 font-weight-bold wht" for="acctbal">Current Balance</label>
                    <input type="text" name="acctbal" id="acctbal" class="form-control col-md-2 font-weight-bold" readonly="readonly">
                    
                    
                </div>
        
                <div class="row form-group" >
                    <label class="col-md-2 font-weight-bold wht" for="acctnameloan">Customer Name</label>
                    <input type="text" name="acctnameloan" id="acctnameloan" class="form-control col-md font-weight-bold">
                    
                </div>
        
                <div class="row form-group" >
                    <label class="col-md-2 font-weight-bold wht" for="loantype">Loan Type</label>
                    <select name="loantype" id="loantype" class="form-control col-md font-weight-bold">
                        
                            <?php
                                foreach ($output as $item) {        
                            ?>
                     <option value=""> <?php echo $item->loantype; ?> </option>
                      <?php }; ?>
                        
                    </select>
        
                
                    
                    
                </div>
        
                <div class="row form-group" >
                    <label class="col-md-2 font-weight-bold wht" for="loanrequest">Loan Request</label>
                    <input type="text" name="loanrequest" id="loanrequest" class="form-control col-md-2 font-weight-bold">
                    <input type="hidden" name="mPrincipal" id="mPrincipal">
                    
                    <label class="col-md-2 font-weight-bold wht" for="period">Period(Months)</label>
                    <select name="period" id="period" class="form-control col-md-1 font-weight-bold">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
        
                    </select>
                    
        
                    <label class="col-md-2 font-weight-bold wht" for="applydate">Application date</label>
        
                    <!-- <input type="checkbox" class="col-md-1" id="check_id" name="check_id"> -->
                    <input type="date" name="applydate" id="applydate" class="form-control col-md-3 font-weight-bold" onchange="loandate()">
        
                    
                    
                </div>
        
        
                <div class="row form-group" >
                    <label class="col-md-2 font-weight-bold wht" for="totalrepay">Total repayment</label>
                    <input type="text" name="totalrepay" id="totalrepay" class="form-control col-md-2 font-weight-bold" readonly="readonly">
        
                    <label class="col-md-2 font-weight-bold wht" for="loanrate">Loan Rate(%)</label>
                    <input type="text" name="loanrate" id="loanrate" class="form-control col-md-2 font-weight-bold">
                    
                    <label class="col-md-2 font-weight-bold wht" for="totalint">Total Interest</label>
                    <input type="text" name="totalint" id="totalint" class="form-control col-md-2 font-weight-bold" readonly="readonly">
                    <input type="hidden" name="mInterest" id="mInterest">
                    
                </div>
        
            <div class="row form-group" >
                    <label class="col-md-3 font-weight-bold wht" for="loanpurpose">Loan Purpose(s)</label>
                    <textarea name="loanpurpose" id="loanpurpose" rows="5" class="form-control col-md-9 font-weight-bold"></textarea>
                    
                    
                </div>
        
         <div class="row form-group" >
                    <label class="col-md-3 font-weight-bold wht" for="loanpurpose">Collateral/Security</label>
                    <textarea name="loancollateral" id="loancollateral" rows="5" class="form-control col-md-9 font-weight-bold"></textarea>
                    
                    
                </div>
        
                <div class="row form-group" >
                    <label class="col-md-3 font-weight-bold wht" for="firstdate">First Deduction Date</label>
                    <input type="text" name="firstdate" id="firstdate" class="form-control col-md-2 font-weight-bold" readonly="readonly">
                    <div class="col-md-7">
                    
                    <button type="submit" class="btn btn-secondary btn-block button button1">SAVE LOAN RECORDS</button>
                </div>
                </div>
        
        
        
        </form>
        
        
        
                </div>
          </div>
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');

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
              <div class="card-body">
  
          
          
          
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6 tex-center alert-info">
                  <h4>Check Tellers transactions</h4>
              </div>
              <div class="col-md-3"></div>
          </div><br>
          
          
          
          <form method="POST" action="{{ url('TellerTransaction') }}" class="ignor-print">
            @csrf
              <div class="form-group row">
               <div class="col-md-2"></div>
              <label class="col-md-2" for="user" style="color: blue">Select User</label>
              <div class="col-md-6">
              <select class="form-control" name="user">
              <option selected="selected">Choose</option>
               
          <?php
           if(!empty($output)){
          foreach($output as $item){
            ?>
                  <option value="{{ $item->name}}">{{ $item->name }}</option>
         <?php }}?>
          
              </select>
          </div>
          <div class="col-md-2"></div>
          </div>
          
          
          <div class="row form-group">
            <div class="col-md-2"></div>
          <label class="col-md-1" for="from" style="color: blue">From</label>
          <div class="col-md-3">
          <input type="date" name="from" id="from" class="form-control">	
          </div>
          <label class="col-md-" for="to" style="color: blue">To</label>
          <div class="col-md-3">
          <input type="date" name="to" id="to" class="form-control">  
          </div>
          <div class="col-md-2"></div>
          </div>
          
          <div class="row">
          
          <div class="col-md-2"></div>
          <div class="col-md-8">
          <button type="submit" class="btn btn-secondary btn-block button button1">Check</button>
          </div>
          <div class="col-md-2"></div>
          </div>
          
          
          </form><br><br>
          
          <table class="table">
            <caption style="color: white">Tellers Transaction by: ( <?php echo @$username; ?> )</caption>
            <caption><a href="javascript:window.print()" id="print-button"><i>Print this page</i></a></caption>
          
            <thead>
              <tr>
                <th style="color: white" scope="col">Transaction Ref-No</th>
                <th style="color: white" scope="col">Account Number</th>
                {{-- <th scope="col">Account Name</th> --}}
                <th  style="color: white" scope="col">Narration</th>
                 <th style="color: white" scope="col">Deposit</th>
                  <th style="color: white" scope="col">Withdrawal</th>
                 
                   <th style="color: white" scope="col">Transaction Date</th>
              </tr>
            </thead>
            <tbody>
          
        <?php 
          
          if(!empty($out)){
          foreach($out as $item){  
            if(!empty($item)){
          ?>
          
          
              <tr style="color: white">
                <th scope="row">{{ $item->refno }}</th>
                <td>{{ $item->nuban }}</td>
                {{-- <td></td> --}}
                <td>{{ $item->narration }}</td>
                 <td style="color: blue">
                  @php
                if(!empty($item->credit)){
                  echo number_format($item->credit,2) ;
                }else{ echo '--'; }
                @endphp
                </td>
                  <td style="color: red">
                    @php
                if(!empty($item->debit)){
                  echo number_format($item->debit,2) ;
                }else{ echo '--'; }
                @endphp
                  
                  </td>
                 
                   <td><?php echo $item->created_at; ?></td>
                    
              </tr>
   
          
         
          
       <?php
      
  @$sumd+= $item->credit;
	@$sumw+= $item->debit;
  @$user=$item->user;
      
      
      }}};   ?>
          
              <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col"></th>
              <th scope="col" style="padding-left: 80px"></th>
                {{-- <th scope="col" style="color: green;"><h5><u></u></h5></th> --}}
                <th scope="col"><span style="color: white">Total credit: </span><span style="color: blue">&#8358;<?php echo  number_format(@$sumd,2); ?></span></th>
                <th scope="col" ><span style="color: white">Total Debit: </span><span style="color: red">&#8358;<?php echo  number_format(@$sumw, 2); ?></span></th>
                   <th scope="col"></th>
              </tr>
            </thead>
          
          <tr>
                  <th scope="row"></th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="2">
                     
                  </td>
          
              </tr>
          
          </tbody>
          </table>
           
          
          
          </div></div>
      
              
          
          
          
          
          
          
          
          
          
          
    
          
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
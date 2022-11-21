
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
            <div class="col-md-4"></div>
            <div class="col-md-4 tex-center alert-info">
                <h4>Daily Transaction Check</h4>
            </div>
            <div class="col-md-4"></div>
        </div><br>
        <?php
        // print_r($out[0]->id);
        ?>
        <form method="POST" action="" class="ignor-print">
           
     
        
        <div class="row">
        
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <button type="submit" class="btn btn-secondary btn-block button button1">Check</button>
        </div>
        <div class="col-md-2"></div>
        </div>
        
        
        </form><br><br>
        
        <table class="table">
          <caption>Tellers Transaction: (<?php echo @$_POST['user']; ?>) </caption>
          <caption><a href="javascript:window.print()" id="print-button"><i>Print this page</i></a></caption>
        
          <thead>
            <tr>
              <th style="color: white" scope="col">Transaction Ref-No</th>
              <th style="color: white" scope="col">Account Number</th>
              <th style="color: white" scope="col">Account Name</th>
              <th style="color: white" scope="col">Narration</th>
               <th style="color: white" scope="col">Deposit</th>
                <th style="color: white" scope="col">Withdrawal</th>
                <!--<th scope="col">Reversed</th>-->
                 <th style="color: white" scope="col">Transaction Date</th>
            </tr>
          </thead>
          <tbody>
        
        <?php 
         if (!empty($out)) {
        //     # code...
        
        
        foreach ($out as $item) {
         if (!empty($item)) {
               // # code...
           //  print_r($item->id)   
         ?>
        
        
        <tr>
            <th scope="row" style="color: white"><?php echo $item->refno; ?></th>
            <td style="color: white"><?php echo $item->nuban; ?></td>
            <td style="color: white"><?php echo $item->surname.'  '.$item->othername; ?></td>
            <td style="color: white"><?php echo $item->narration; ?></td>
             <td style="color: blue"><?php if (!empty($item->credit)) {
               echo $item->credit; 
             }else{ echo "--";} ?></td>
              <td style="color: red"><?php if (!empty($item->debit)) {
                 echo $item->debit;
              }else{ echo "--";} ?></td>
              
               <td style="color: white"><?php echo $item->created_at; ?></td>
                
          </tr>
      
      <?php 
      
          @$sumd+= $item->credit;
          @$sumw+= $item->debit;
        @$user=$item->user;
      
      
      
        ?>
      
      
          <?php }} }?>
      

        
            <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col"></th>
            <th scope="col" style="padding-left: 80px"></th>
              <th scope="col" style="color: green;"><h5></h5></th>
               <th scope="col" style="color: blue">&#8358;<?php echo  number_format(@$sumd,2); ?></th>
                <th scope="col" style="color: red">&#8358;<?php echo  number_format(@$sumw, 2); ?></th>
                 <th scope="col"></th>
            </tr>
          </thead>
        
        <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">
                    <div class="text-center">
                        <hr class="light">
                        <!--<span>TILL BAL:</span>-->
                        <h3 id="balsum" style="color: green">&#8358; <?php echo number_format(@$sumd-@$sumw,2); ?></h3>
                        <hr class="light">
                    </div>
                </td>
        
            </tr>
        
        </tbody>
        </table>
         
        
        
        </div></div>         

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
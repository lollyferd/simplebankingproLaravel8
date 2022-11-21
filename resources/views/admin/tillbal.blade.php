
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
            <div class="col-md-6 tex-center">
                <h4 style=" color:white">Check Tellers transactions</h4>
            </div>
            <div class="col-md-3"></div>
        </div><br>
        
        
        
        <form method="POST" action="" class="ignor-print" id="tillcheckid">
          @csrf
            <div class="form-group row">
             <div class="col-md-2"></div>
            <label class="col-md-2" for="user" style="color: yellow">Select User</label>
            <div class="col-md-6">
            <select class="form-control" name="tellercode" onchange="tillcheck()">
            <option selected="selected">Choose</option>
               
        <?php
            foreach($out as $item){
                ?>
             <option value="{{ $item->tellercode }}">{{ $item->name.' code: '.$item->accesstype }}</option>
           <?php }?>
        
              
        
              
        
        
            
        
        
            </select>
        </div>
        <div class="col-md-2"></div>
        </div>
        
        
       
        
        <div class="row">
        
        <div class="col-md-2"></div>
        <div class="col-md-8">
        {{-- <button type="button" class="btn btn-secondary btn-block button button1" onclick="tillcheck()">Check</button> --}}
        </div>
        <div class="col-md-2"></div>
        </div>
        
        
        </form><br><br>
        
        <div class="row">
        
          <div class="col-md-4">
          <h5>Till Balance</h5>  
          </div>
        
          <div class="col-md-4">
           <h4 ><span>&#8358; </span><span id="displaycheckbal"></span> </h4> 
          </div>
          <div class="col-md-4"></div>
          
        </div>
         
        
        </div></div>
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
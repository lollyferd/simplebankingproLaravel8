
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
        
        
        <form method="POST" action="{{ url('certificate') }}" class="ignor-print" id="loandisplaypay">
          @csrf
            <div class="form-group row">
             <div class="col-md-2"></div>
            <label class="col-md-2 wht" for="user" >Select Investment</label>
            <div class="col-md-6">
        
            <select class="form-control" name="ref" id="ref">
            <option selected="selected">Choose</option>
            
        <?php
            foreach($cert as $item){
              ?>
              <option value="{{ $item->ref }}">{{ $item->nuban .' ('. $item->ref.') '.$item->acctname }}</option>

              <?php }?>
            
            </select><br>
            <small id="noteap"></small>
        </div>
        <div class="col-md-2"> 
        <button type="submit" class="btn btn-primary">generate</button>
        </div>
        </div>
        
        
        
        
        
        
        </form><br><br>

       
        
        </div></div>
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
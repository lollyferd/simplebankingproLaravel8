    @include('admin.apphead')
    
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')

     
        <!-- partial -->
        <div class="main-panel">
        <div class="container-fluid" >
          <!-- Body here -->
          <span></span>
                   
          
              {{-- <div class="card-body  " style="background-color: #0A043E"> --}}
          
        
          
                <form method="POST" id="userform" action="{{ url('customerL') }}" autocomplete="off">

                  @csrf
                  
                  <div class="form-group row">
                    <div class="col-md-6" >
                    <input type="search" name="search" id="search" placeholder="Search Customer" class="form-control search font-weight-bold">
                  </div>
          
                  <div class="col-md-6" >
                    <input type="text" name="nuban" id="nuban" placeholder="Account Number" class="form-control font-weight-bold" style="color: green; font-size: 25px" >
                    <input type="hidden" name="customerid" id="customerid" >
                  </div>
                    
                  </div>
          
                   <div class="form-group row">
                     <div class="col-md-5" id="searchcont">
                  
                    <select multiple class="form-control  font-weight-bold getcustomer" id="nuban" name="nuban" size="8" onchange="fetchcustomer()">
          

                    </select>
                  </div>
          
                  <div class="col-md-3">
                    <input type="text" name="" id="tel" class="form-control" readonly="readonly">
                    <div style="margin-top: 30px;"><img  id="load" ></div>
          
                  </div>
          
                 
          
                  <div class="col-md-4">
          
                    <img  style="border: 1px solid white; height: 200px; width: 200px; margin-bottom: 50px" id="pix">
          
                    
                    <div class="row">
                      <div class="col-md-2" style="font-size: 40px"><i class="fas fa-hand-pointer wht"></i></div>
                      <div class="col-md-8 wht">Passport Photograph of Selected Customer</div>
          
                    </div>
          
          
                    
          
                  </div>
                </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      
                      <button type="submit" class="btn btn-primary btn-block enter-btn button button1" >Search</button>
                    </div>
                    <div class="col-md-4">
                       
                    </div>
                    
                  </div>
                   
          
                </form>
          
          
  
          
      
          {{-- </div> --}}
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
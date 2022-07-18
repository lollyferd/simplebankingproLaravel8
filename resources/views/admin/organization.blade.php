
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
        
                 <small id="display" class="text-center btn-block"></small>
                <div class="row">
                    <div class="col-md">
                        <h4 class="topic_color text-center">Register New Organization</h4><br>
                    </div>
                    
                </div>
        
                <form method="POST" action=" {{ url('orgsubmit') }}"  enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="col-md">
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name">
                        </div>
                        
                        <div class="col-md">
                            <input type="text" name="rc" id="rc" class="form-control" placeholder="RC No:">
                        </div>
                    </div><br><br>
        
        
                    <div class="form-group">
                        <input type="text" name="caddress" id="caddress" placeholder="Company Address" class="form-control">
                    </div>
        
                    <div class="form-row">
                        <div class="col-md">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Contact Number">
                        </div>
                        
                        <div class="col-md">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Company Email">
                        </div>
                    </div><br>
        
                        <div class="form-group">
                            <input type="file" name="logo" id="logo">
                        </div>
        
                     <button type="submit" class="btn btn-primary btn-block button button1" id="reg" name="reg">Register</button>
                </form>
        
            
        </div>
        
        </div>         

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
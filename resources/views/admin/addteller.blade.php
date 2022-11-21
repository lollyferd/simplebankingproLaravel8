
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
            <div class="card-body mgbg31 ">
             
        
          
              
        
                    <div class="row">
        
                <div class="col-md-3"></div>
                <div class="col-md-6">
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
	   
					   
	   
						
						{{-- End of success message  --}}
						<x-jet-validation-errors class="mb-4" />
                </div>
                <div class="col-md-3"></div>
                        
                    </div>

        
        <form method="POST" action="{{ url('addtellerf') }}" >
            @csrf
            <div class="form-group row">
            <label class="col-md-2" for="user">Select User</label>
            <select class="col-md-4 form-control" id="id" name="id"  >
             @foreach ($output as $item )
             <option value="{{ $item->id }}">{{ $item->name }}</option> 
             @endforeach
        
                
        
            
            </select>
        
            <label class="col-md-2" for="Status">Teller Code</label>
            <input type="text" name="tellercode" class="form-control col-md-4" id="tellercode">
        </div>
        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
        <button type="submit" class="btn btn-secondary btn-block button button1" id="update">Update</button>
        </div>
        
            <div class="col-md-4"></div>
            
        </div>
        
        </form>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div></div>
                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
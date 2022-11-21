
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
	   
					
						
						{{-- End of success message  --}}
                <table class="table" style="color: white">
                    <thead>
                      <tr >
                        <th scope="col" style="color: orangered">S/N</th>
                        <th scope="col"style="color: orangered">Username</th>
                        <th scope="col"style="color: orangered">Email</th>
                        <th scope="col"style="color: orangered">User status</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach ($output as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{ $item->active }}</td>
                          </tr>
                      @endforeach 
                     
               
                     
                    </tbody>
                  </table><br>
        
        <form method="POST" action="{{ url('activate_users2') }} " autocomplete="off">
            @csrf
            
        <input type="hidden" name="activate" id="activate" value="1">
        <div class="row">
        
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-danger">activate all Users</button>
            </div>
            <div class="col-md-4"></div>
            
        </div>
        
        
        
        
        </form>
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div>
        </div>   

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
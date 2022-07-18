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




<div class="col-md-12">
    <div class="card">
      <div class="card-body">
  
  <h5 class="text-center" style="color:white"><b>Create GL</b></h5><br>
    
  
  <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
             {{-- begining of success message  --}}
             @if (session()->has('message'))

             <div class="alert alert-success text-center">
                 <button type="button" class="close" data-dismiss="alert">x</button>
             {{ session()->get('message') }}
             </div>
             @endif
             {{-- End of success message  --}}
             <x-jet-validation-errors class="mb-4" />
             <span id="notify" class=""></span>
      </div>
      <div class="col-md-4"></div>
      
  
  </div>
 
  <form method="POST" action="{{ url('glcreate') }}">
    @csrf
      <div class="row form-group">
          <label class="col-md-2" for="classid" style="color: white">Account Class</label>
          <select class="col-md-4 form-control" name="classid" id="classid">
  @foreach ($output as $item)
      <option value="{{ $item->classid }}">{{ $item->classname }}</option>
  @endforeach
        
  
          </select>
          
  
  <label class="col-md-2" for="glname" style="color:white">GL Name</label>
  
<textarea class="col-md-4 form-control" rows="2" cols="2" name="glname" id="glname" placeholder="Enter the Sub-Account Name" required></textarea>

 
  

 
  
      </div>



      <div class="row form-group">
        <label class="col-md-2" for="glname" style="color:white">List of Sub-class</label>
  
  {{-- <textarea class="col-md-4 form-control" rows="10" cols="20" id="subclassdisplay" readonly></textarea> --}}

  <select  class="form-control col-md-6  font-weight-bold " id="subclassid" name="subclassid" required>
<option value=" ">Choose Subclass</option>

</select>
        <div class="col-md-4">
            <button type="submit" class="btn btn-secondary btn-block button button1" style="margin-top: 10px" name="create" id="validategl">Create</button>

        </div>
        
        
    </div>
      
  
  <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
      </div>
      <div class="col-md-2"></div>
      
      
  </div>
  
  
  </form>
  
  
  
  </div></div>
  </div>
         {{-- end of body         --}}
        </div>       
    </div> 
@include('admin.appfooter');
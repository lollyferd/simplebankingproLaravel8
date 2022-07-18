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
               
      <div class="row">
        <div class="col-md-6"><h1 class="h3 mb-4 text-gray-800 text-center" style="color: white">Add Account Officer</h1></div>
          <div class="col-md-6" id="success_msg"></div>
      </div>
                <div>
                <ul id="saveform_error_list"></ul>
                </div>

                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                          {{-- begining of success message  --}}
                @if (session()->has('message'))

                <div class="alert alert-success text-center">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
                </div>
                @endif
                {{-- End of success message  --}}
                <x-jet-validation-errors class="mb-4" />
               <form  method="POST" action="{{ url('uploadacctofficer') }} ">
                @csrf
               
                <div class="form-group row">
                <label for="phone" class="col-form-label"><span style="color: red">*</span>Account Officer Name:</label>
                
                <input type="text" name="acctofficername" id="acctofficername" class="form-control tabstyle">
                
                </div>
                
    
                
                <div class="form-group row">
                <button class="btn btn-primary button button1" type="submit">Submit</button>
                </div>
               </form>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                 
   {{-- end of body          --}}
    </div>       
     </div> 
@include('admin.appfooter');
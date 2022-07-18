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
        <div class="col-md-6"><h1 class="h3 mb-4 text-gray-800 text-center" style="color: white">CREATE ACCOUNT TYPE</h1></div>
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
               <form  method="POST" action="{{ url('uploadaccttype') }} ">
                @csrf
                
                <div class="form-group row">
                <label for="phone" class="col-form-label"><span style="color: red">*</span>Account type:</label>
                
                <input type="text" name="accttype" id="accttype" class="form-control tabstyle" required>

                <input type="hidden" name="user" value="{{ Auth::user()->id }}">
              
                </div>
                
    
                
                <div class="form-group row">
                <button class="btn btn-primary buy_airtime button button1" type="submit">Submit</button>
                </div>
               </form>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                 
                 
            
    </div>       
     </div> 
@include('admin.appfooter');
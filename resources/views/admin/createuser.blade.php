<x-base-layout>
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
               
      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
              <div class="card col-lg-6 mx-auto">
            
                <div class="card-body px-5 py-5">
                          {{-- begining of success message  --}}
                @if (session()->has('message'))

                <div class="alert alert-success text-center">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
                </div>
                @endif
                {{-- End of success message  --}}
                  <h3 class="card-title text-left mb-3 text-center">Add New User</h3>
                  <x-jet-validation-errors class="mb-4" />
  
                 <form method="POST" action="{{ url('registeruser') }}">
                  @csrf
                    <div class="form-group">
                      <label for="name" style="color: white" value="{{ __('name') }}">Username</label>
                      <input type="text" name="name" id="name" class="form-control p_input tabstyle" :value="old('name')" required autofocus autocomplete="name">
                    </div>
                    <div class="form-group">
                      <label for="fullname" style="color: white" value="{{ __('fullname') }}">Fullname</label>
                      <input type="text" name="fullname" id="fullname" class="form-control p_input tabstyle" :value="old('fullname')" required autofocus autocomplete="fullname">
                    </div>
                    <div class="form-group">
                      <label for="phone" style="color: white" value="{{ __('Phone') }}">Phone</label>
                      <input type="text" name="phone" id="phone" class="form-control p_input tabstyle" :value="old('phone')" required autofocus autocomplete="phone" >
                    </div>
                    <div class="form-group">
                      <label style="color: white" for="email" value="{{ __('Email') }}" >Email</label>
                      <input type="email" name="email" id="email" class="form-control p_input tabstyle" :value="old('email')" required >
                    </div>
                    <div class="form-group">
                      <label style="color: white" for="password" value="{{ __('Password') }}">Password</label>
                      <input type="password" id="password" name="password" required autocomplete="new-password" class="form-control p_input tabstyle">
                    </div>
  
                    <div class="form-group">
                      <label for="password_confirmation" value="password_confirmation" style="color: white">Password Confirmation</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required class="form-control p_input tabstyle">
                    </div>
                   
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block enter-btn">Sign Up</button>
                    </div>
                  
                  </form>
                </div>
              </div>
            </div>
            <!-- content-wrapper ends -->
          </div>
          <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
                 
    {{-- end body         --}}
    </div>       
     </div> 
     <script src="../../admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../admin/assets/js/off-canvas.js"></script>
    <script src="../../admin/assets/js/hoverable-collapse.js"></script>
    <script src="../../admin/assets/js/misc.js"></script>
    <script src="../../admin/assets/js/settings.js"></script>
    <script src="../../admin/assets/js/todolist.js"></script>
    <!-- endinject -->
@include('admin.appfooter');
</x-base-layout>
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
      <div class="col-md">
        <div class="card">
          <div class="card-body" style="background-color: #0A043E">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                     {{-- begining of success message  --}}
                     @if (session()->has('message'))
    
                     <div class="alert alert-success text-center">
                         <button type="button" class="close" data-dismiss="alert">x</button>
                     {{ session()->get('message') }}
                     </div>
                     @endif

                     @if (session()->has('message_warning'))
                     <div class="alert alert-warning text-center">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    {{ session()->get('message_warning') }}
                    </div>
                         
                     @endif
    
                 
                     {{-- End of success message  --}}
                     
                </div>
                <div class="col-md-2"></div>
                
            </div> 

<form  method="POST" action="{{ url('accountupdated') }}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="form-group row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <input type="text" style="color: green; font-size: 25px" name="nubanupdate" id="nubanupdate" class="form-control text-center font-weight-bold" placeholder="Enter Account Number">
        </div>
        
        <div class="col-md-3"></div>
        
    </div><br>


    

<div class="form-group row">

    <label for="surnameupdate" class="col-form-label col-md-2">Customer Name:</label>
        <div class="col-md-1"></div>
    <div class="col-md-6">
    <input type="text" readonly="readonly"  id="surnameupdate" class="form-control text-center font-weight-bold">
</div>

<div class="col-md-3"></div>


</div><br><br>



<div class="form-group row">

{{-- <input type="hidden" name="userid" value=""> --}}

<label for="sign" class="col-form-label col-md-4"> Update Signature/Passport</label>
<div class="col-md-4">
<input type="file" name="photo" id="photo" class="form-control">
</div>

<div class="col-md-4">

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="options" id="option1" value="Signature">
<label class="form-check-label" for="option1" style="color: white">Signature</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="options" id="option2" value="passport">
<label class="form-check-label" for="option2" style="color: white">passport</label>
</div>


</div>
</div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <button type="Submit" class="btn btn-secondary btn-block button1 button">Update</button>
    </div>
    <div class="col-md-4"></div>

</div>




</form>
          </div></div></div>
  {{-- end of body         --}}
</div>       
</div> 
@include('admin.appfooter');
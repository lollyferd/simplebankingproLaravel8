
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
            <div class="col-md-4"><h3 class="text-center wht">Edit Exiting account</h3></div>
            <div class="col-md-4">
                <form id="nubansearch" method="POST" autocomplete="off">

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
            
                             {{-- @if (session()->has('message_failed'))
                             <div class="alert alert-danger text-center">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session()->get('message_failed') }}
                            </div>
                                 
                             @endif --}}
            
                             {{-- @if (session()->has('message_warning'))
                             <div class="alert alert-warning text-center">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session()->get('message_warning') }}
                            </div>
                                 
                             @endif --}}
            
                            
            
                             
                             {{-- End of success message  --}}
                             <x-jet-validation-errors class="mb-4" />
                        </div>
                        <div class="col-md-2"></div>
                        
                    </div> 
        
        <input type="text" style="color: green; font-size: 25px" class="form-control font-weight-bold" name="nubanedit" id="nubanedit">
        </form>
        </div>
        <div class="col-md-4"></div>
        </div><br>
        
        <form  method="POST" action="{{ url('customeredit') }}"  autocomplete="off">
            @csrf
            <div class="form-group row">
                
                    <label for="surname" class="col-form-label col-md-2"><span style="color: red">*</span>Surname:</label>
                    <div class="col-md-6">
                    <input type="text" name="surname" id="surname" class="form-control" required="required">
                    <input type="hidden" name="nubanedit2" id="nubanedit2" class="form-control">
                </div>
        
        
                <label for="bvn" class="col-form-label col-md-1">BVN:</label>
                    <div class="col-md-3">
                    <input type="text" name="bvn" id="bvn" class="form-control">
                </div>
        
            </div>
        
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="othername"><span style="color: red">*</span>Other Names:</label>
            <div class="col-md-10">
                <input type="text" name="othername" id="othername" class="form-control" required="required">
                
            </div>	
        </div>
        
        
        
        <div class="form-group row">
                
                    <label for="Gender" class="col-form-label col-md-2">Gender:</label>
                    <div class="col-md-2">
        
                        <input type="text" name="gender" id="gender" class="form-control">
                </div>
        
        
                <label for="dob" class="col-form-label col-md-1">D.O.B:</label>
                    <div class="col-md-2">
                    <input type="text" name="dob" id="dob" class="form-control">
                </div>
        
                <label for="email" class="col-form-label col-md-1">Email:</label>
                    <div class="col-md-4">
                    <input type="email" name="email" id="email" class="form-control">
                </div>
        
            </div>
        
        
        
        <div class="form-group row">
                
                    <label for="tel" class="col-form-label col-md-2"><span style="color: red">*</span>Tel: </label>
                    <div class="col-md-4">
                    <input type="text" name="tel" id="tel" class="form-control" required="required">
                </div>
        
        
                <label for="occupation" class="col-form-label col-md-2">Occupation:</label>
                    <div class="col-md-4">
                    <input type="text" name="occupation" id="occupation" class="form-control">
                </div>
        
            </div>
        
        
        
        <div class="form-group row">
                
                    <label for="country" class="col-form-label col-md-2">Nationality:</label>
                    <div class="col-md-3">
        
                        <input type="text" readonly="readonly" name="country" id="country" class="form-control" value="Nigeria">
                </div>
        
        
           
        
                <label for="state" class="col-form-label col-md-1">State:</label>
                    <div class="col-md-2">
                    
                        
                    <input type="text" name="state" id="state" class="form-control">
                    
        
                </div>
        
                <label for="city" class="col-form-label col-md-1">City:</label>
                    <div class="col-md-2">
                        <input type="text" name="city" id="city" class="form-control" >
                        
                </div>
        
            </div>
        
        
            <div class="form-group row">
        
                <label for="contactaddress" class="col-form-label col-md-2"><span style="color: red">*</span>Contact Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="contactaddress" id="contactaddress" class="form-control" required="required">
                </div>
                
            </div>
        
            <div class="form-group row">
        
                <label for="officeaddress" class="col-form-label col-md-2">Office Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="officeaddress" id="officeaddress" class="form-control">
                </div>
                
            </div>
        
        
        
        <div class="form-group row">
        
                <label for="nextofkin" class="col-form-label col-md-2">Next Of Kin: </label>
                    <div class="col-md-10">
                    <input type="text" name="nextofkin" id="nextofkin" class="form-control">
                </div>
                
            </div>
        
            <div class="form-group row">
        
                <label for="nextofkinaddr" class="col-form-label col-md-2">Next Of Kin Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="nextofkinaddr" id="nextofkinaddr" class="form-control">
                </div>
                
            </div>
        
        
            <!-- <div class="form-group row">
                <label for="photo" class="col-form-label col-md-2"><span style="color: red">*</span>Photo</label>
                <div class="col-md-4">
                <input type="file" name="photo" id="photo" class="form-control" required="required">
            </div>
        
            
            </div> -->
        
        
            <div class="form-group row">
                <label for="accountofficer" class="col-form-label col-md-2"><span style="color: red">*</span>Account Officer</label>
                
                <div class="col-md-4">
                    <select name="accountofficer" id="accountofficer" class="form-control" required="required">
                        @foreach  ($data as $item2)
                        <option value="{{ $item2->acctofficername }}">{{ $item2->acctofficername }}</option>
                        @endforeach
                    
        
                    </select>
        
                 
            </div>
        
        
        
        
        
        
                <div class="col-md-4">
                <button type="Submit" class="btn btn-secondary btn-block button button1">Submit</button>
            </div>
        
            <div class="col-md-2">
                <?php 
                date_default_timezone_set('Africa/Lagos');
                   ?>
                <input type="text" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d'); ?>">
            </div>
            </div>
        
        
        
        </form>

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
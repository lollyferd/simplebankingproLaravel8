
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
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @if (session()->has('message'))
        
        
         <input type="text" style="color: green !important; font-size: 25px;" value="{{ session()->get('message')  }}" class="form-control text-center font-weight-bold">
          @endif
        
            <h3 class="text-center wht">CREATE CUSTOMER ACCOUNT</h3>
     
        
        </div>
        <div class="col-md-4">

        </div>
        </div><br>
        
        
        
       
        
        <form id="myform" method="POST" action="{{ url('uploadcustomer') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                
                    <label for="surname" class="col-form-label col-md-2"><span style="color: red">*</span>Surname:</label>
                    <div class="col-md-6">
                    <input type="text" name="surname" id="surname" class="form-control tabstyle" required="required">
                </div>
        
        
                <label for="bvn" class="col-form-label col-md-1">BVN:</label>
                    <div class="col-md-3">
                    <input type="text" name="bvn" id="bvn" class="form-control tabstyle">
                </div>
        
            </div>
        
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="othername"><span style="color: red">*</span>Other Names:</label>
            <div class="col-md-10">
                <input type="text" name="othername" id="othername" class="form-control tabstyle" required="required">
                
            </div>	
        </div>
        
        
        
        <div class="form-group row">
                
                    <label for="Gender" class="col-form-label col-md-2">Gender:</label>
                    <div class="col-md-2">
        
                        <select name="gender" id="gender" class="form-control tabstyle">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
        
                        </select>
                </div>
        
        
                <label for="dob" class="col-form-label col-md-1">D.O.B:</label>
                    <div class="col-md-2">
                    <input type="date" name="dob" id="dob" class="form-control tabstyle">
                </div>
        
                <label for="email" class="col-form-label col-md-1">Email:</label>
                    <div class="col-md-4">
                    <input type="email" name="email" id="email" class="form-control tabstyle">
                </div>
        
            </div>
        
        
        
        <div class="form-group row">
                
                    <label for="tel" class="col-form-label col-md-2"><span style="color: red">*</span>Tel: </label>
                    <div class="col-md-4">
                    <input type="text" name="tel" id="tel" class="form-control tabstyle" required="required">
                </div>
        
        
                <label for="occupation" class="col-form-label col-md-2">Occupation:</label>
                    <div class="col-md-4">
                    <input type="text" name="occupation" id="occupation" class="form-control tabstyle">
                </div>
        
            </div>
        
        
        
        <div class="form-group row">
                
                    <label for="country" class="col-form-label col-md-2">Nationality:</label>
                    <div class="col-md-3">
        
                        <input type="text" readonly="readonly" name="country" id="country" class="form-control tabstyle" value="Nigeria">
                </div>
        
        
           
        
                <label for="state" class="col-form-label col-md-1"><span style="color: red">*</span>State:</label>
                    <div class="col-md-2">
                    
                        <select class="form-control tabstyle" name="state" id="state" required='required' >
                            
                            @foreach ($state as $states)
                            <option value="{{ $states->name }}">{{ $states->name }}</option>
                            @endforeach
                               
                            
                        </select>
        
                </div>
        
                <label for="city" class="col-form-label col-md-1"><span style="color: red">*</span>City:</label>
                    <div class="col-md-2">
                        <input type="text" name="city" id="city" class="form-control tabstyle" required='required'>
                        
                </div>
        
            </div>
        
        
            <div class="form-group row">
        
                <label for="contactaddress" class="col-form-label col-md-2"><span style="color: red">*</span>Contact Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="homeaddress" id="homeaddress" class="form-control tabstyle" required="required">
                </div>
                
            </div>
        
            <div class="form-group row">
        
                <label for="officeaddress" class="col-form-label col-md-2">Office Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="officeaddress" id="officeaddress" class="form-control tabstyle">
                </div>
                
            </div>
        
        <div class="form-group row">
                
                    <label for="typeofacct" class="col-form-label col-md-2"><span style="color: red">*</span>Type Of Account: </label>
                    <div class="col-md-4">
        
                        <select name="typeofacct" id="typeofacct" class="form-control tabstyle" required="required">
                             @foreach ($data as $item)
                            <option value="{{$item->accttype }}">{{ $item->accttype }}</option>
                            @endforeach 
        
                            
                            
                                    
                            
                        </select>
        
                </div>
        
        
                <label for="classofacct" class="col-form-label col-md-2"><span style="color: red">*</span>Class Of Account:</label>
                    <div class="col-md-4">
        
                        <select name="classofacct" id="classofacct" class="form-control tabstyle" required="required">
                            
                            <option value="INDIVIDUAL">INDIVIDUAL</option>
                            <option value="CORPERATE">CORPORATE</option>
                            
                        </select>
        
                </div>
        
            </div>
        
        
        
        <div class="form-group row">
        
                <label for="nextofkin" class="col-form-label col-md-2">Next Of Kin: </label>
                    <div class="col-md-10">
                    <input type="text" name="nextofkin" id="nextofkin" class="form-control tabstyle">
                </div>
                
            </div>
        
            <div class="form-group row">
        
                <label for="nextofkinaddr" class="col-form-label col-md-2">Next Of Kin Address: </label>
                    <div class="col-md-10">
                    <input type="text" name="nextofkinaddress" id="nextofkinaddress" class="form-control tabstyle">
                </div>
                
            </div>
        
        
            <div class="form-group row">
                <label for="photo" class="col-form-label col-md-2"><span style="color: red">*</span>Photo</label>
                <div class="col-md-4">
                <input type="file" name="photo" id="photo" class="form-control tabstyle">
            </div>
        
            <!-- <label for="sign" class="col-form-label col-md-2">Signature</label>
                <div class="col-md-4">
                <input type="file" name="sign" id="sign" class="form-control">
            </div> -->
            </div>
        
        
            <div class="form-group row">
                <label for="accountofficer" class="col-form-label col-md-2"><span style="color: red">*</span>Account Officer</label>
                
                <div class="col-md-4">
                    <select name="accountofficer" id="accountofficer" class="form-control tabstyle" required="required">
        
                        
        
                        @foreach  ($data2 as $item2)
                        <option value="{{ $item2->acctofficername }}">{{ $item2->acctofficername }}</option>
                        @endforeach
        
        
                        
                        
        
                    </select>
        
              
          
        
        
                    
            </div>
        
        
        
        
        
        
                <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-block button button1 ">Submit</button>
            </div>
        
            <div class="col-md-2">
                
                <input type="text" class="form-control tabstyle" readonly="readonly" value="{{ Carbon\carbon::now()->format('d-m-Y'); }}">
            </div>
            </div>
        
        
        
        </form>
        
        
        
        </div>
        </div>
        
        
        </div>
            
        
        
        
        
        <!-- Modal for account officer-->
      
        </form>      

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
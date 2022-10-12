
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
            <div class="card-body mgbg3 ">
        
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
                    </div>
                    <div class="col-md-4"></div>
                </div>

        <form method="POST"  action="{{ url('gltoacctposting') }} " autocomplete="off" >
        @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <p class="text-center" style="color: blue;"><b>Credit</b></p>
                            </div>
                            <div class="col-md-2"></div>
        
                            <div class="col-md-5">
                                <p class="text-center" style="color: red"><b>Debit</b></p>
                            </div>
                        </div>
        
                        <div class="row form-group">
                            <div class="col-md-5">
                                <input type="text" name="credit" id="credit" class="form-control" placeholder='Credit Amount' onkeyup="amount()" onchange="amount()">
                            </div>
        
                            <div class="col-md-2"></div>
        
                            <div class="col-md-5">
                                <input type="text" name="debit" id="debit" class="form-control" readonly="readonly" placeholder="Debit Amount">
                            </div>
        
                        </div>
        
        
                        <div class="row form-group">
                            <div class="col-md-5">
                                <textarea placeholder="narration" name="narration1" id="narration1" class="form-control" onkeyup="narrations()" onchange="narrations()"></textarea>
                            </div>
        
                            <div class="col-md-2"></div>
        
                            <div class="col-md-5">
                                <textarea placeholder="narration" name="narration2" id="narration2" class="form-control"></textarea>
                            </div>
        
                        </div>
        
        
        
                            
        
                        <div class="row form-group">
                            <div class="col-md-5">
                                
                            <label for="exampleFormControlSelect1" style="color: rgb(248, 240, 240)">Select Account to Credit</label>
                            <input type="text" name="nuban1" placeholder="Enter Customer Acctount Number" class="form-control gltoacct1" id="nubangltoacct">
                            <input type="text"  id="displayname1" placeholder="Customer Name" class="form-control myedit gltoaccedit1" readonly="readonly" style="display: none;">
                            <input type="text" id="displaybal1" name="displaybal" placeholder="Balance" readonly="readonly" class="form-control myedit gltoaccedit1" style="display: none;" >
        
                            <select multiple class="form-control mcredit" id="exampleFormControlSelect1" size="10" name="glcode1" style="display: none;" >
                                @foreach ($output as $item)
                                <option value="{{ $item->id }}"> {{ $item->glname .' '.' - '. $item->gl_code }}</option>
                            @endforeach  
                            </select>
                               
                                
                            </div>
        
                            <div class="col-md-2"></div>
        
                            <div class="col-md-5">
                          <label for="exampleFormControlSelect2" style="color: rgb(247, 243, 243)">Select Account to Debit</label>
                       <input type="text" name="nuban2" placeholder="Enter Customer Acctount Number" class="form-control gltoacct2" id="nuban11">
                       <input type="text"  id="displayname" placeholder="Customer Name" class="form-control myedit gltoaccedit2" readonly="readonly" style="display: none;">
                       <input type="text" id="displaybal" name="displaybal" placeholder="Balance" readonly="readonly" class="form-control myedit gltoaccedit2" style="display: none;" >
   
                           <select multiple class="form-control mdebit" id="exampleFormControlSelect2" size="10"  name="glcode2" style="display: none;">
                            
                            @foreach ($output as $item)
                            <option value="{{ $item->id }}"> {{ $item->glname .' '.' - '. $item->gl_code }}</option>
                          @endforeach  
  
                            </select>
        
        
         
                            </div>
        
                        </div>
        
                        <div class="row">
        
                            <div class="col-md-5"></div>
        
                                <div class="col-md-2">
                                    
                                    <button type="submit" class="btn btn-success btn-block" name="post">POST</button>
        
        
                                </div>
        
                                    <div class="col-md-5"></div>
                            
                        </div>
                        
                    </div>
                    
        
        
                </form>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div></div>        

                     
        {{-- end of body         --}}
        </div>       
         </div> 
  @include('admin.appfooter');
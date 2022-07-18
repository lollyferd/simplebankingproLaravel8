






@php
use App\Http\Controllers\HomeController;
$mysearch = $_REQUEST['mysearch'];
@endphp




<div class="form-group row">
    		 	<div class="col-md" id="searchcont">
			  
			    <select multiple class="form-control font-weight-bold" id="nuban" name="nuban" size="8" onchange="fetchcustomer()">

			    	@php
                        
                    $records = customer_details::searchUser($mysearch);
			    	

					

					@foreach
                        
                     ($records as $item) {
						if (!empty($item)) {
							# code...
					
			    	@endphp
                  
			       <option value="{{ $item->nuban }}" style="padding-bottom: 9px; border-bottom: 1px solid green; font-size: 20px ">{{ $item->surname }}</option> 
			     



			     }}
                 @endforeach 
			    </select>
			  </div>
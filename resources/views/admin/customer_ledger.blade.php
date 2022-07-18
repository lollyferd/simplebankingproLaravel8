
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

<div class="row">
	<div class="col-md-3">
<a href="javascript:window.print()" id="print-button" class="remove2"><i>Print this page</i></a>
	</div>

	<div class="col-md-6 text-center alert-info"><h4>Customer Account Ledger</h4></div>
	<div class="col-md-3"></div>
	
</div>
<hr style="background-color: yellow"><br>

<div class="row">



	<div class="col-md-3 font-weight-bold">
		<u><p>Customer Name: </p></u><br>

		<u><p>Account Number: </p></u><br>

		<u><p>Account Type </p></u><br>

        <u> <p>Available Balance: </p></u><br>

	    <u><p>Loan Balance: </p></u><br>

	    
		
	</div>

	
	


    <div class="col-md-3 font-weight-bold">
		<u><p>{{ $customeroutput->surname.' '.$customeroutput->othername }}</p></u><br>

		<u><p>{{ $customeroutput->nuban }}</p></u><br>


		<u><p>{{ $customeroutput->typeofacct  }}</p></u><br>


        <p id="sumdisplay" style="color: green">&#8358;{{number_format($bal,2) }}</p><br>

        <p style="color: red">&#8358;{{ number_format($customeroutput->loanbal,2) }}</p><br>
			
	</div>


<div class="col-md-3 hidephoto">
	<img src="uploads/{{ $customeroutput->photo }}" style="border: 1px solid black; height: 200px; width: 200px" ><br>
	<small>Customers Photo</small>
</div>



	<div class="col-md-3 hidephoto">

		<div class="row">
			<p><b>Interest Bal:</b><b><a href="drop_savings_int.php"><span style="color: blue">&#8358;{{ number_format($customeroutput->intbal,2) }}</span></a></b> </p>
    
		</div><br>

  
@if ($customeroutput->status == 'Active')
<form method="POST">
  @csrf
  <div class="row">
    <div class="col-md-4"><b><span>Status: </span><p style="color: green">{{ $customeroutput->status }}</p></b></div>
  
<div class="col-md-4"><button type="button" class="btn btn-warning disable" value="{{ $customeroutput->nuban }}">Disable</button></div>
<div class="col-md-4"><button type="button" class="btn btn-danger block" value="{{ $customeroutput->nuban }}">Block</button></div>
</div>
</form>
@endif
@if ($customeroutput->status != 'Active' && $customeroutput->status =='Disabled' )
<form method="POST">
  @csrf
  <div class="row">
    <div class="col-md-4"><b><span>Status: </span><p style="color: red">{{ $customeroutput->status }}</p></b></div>
<div class="col-md-4"><button type="button" class="btn btn-primary enable" value="{{ $customeroutput->nuban }}">Enable</button></div>
<div class="col-md-4"><button type="button" class="btn btn-danger block" value="{{ $customeroutput->nuban }}">Block</button></div>
  </div>
</form>
@endif



@if ($customeroutput->status != 'Active' && $customeroutput->status =='Blocked' )
<form method="POST">
  @csrf
  <div class="row">
    <div class="col-md-4"><b><span>Status: </span><p style="color: red">{{ $customeroutput->status }}</p></b></div>
{{-- <div class="col-md-4"><button type="button" class="btn btn-primary enable" value="{{ $customeroutput->nuban }}">Enable</button></div> --}}
<div class="col-md-4"><button type="button" class="btn btn-danger unblock" value="{{ $customeroutput->nuban }}">UnBlock</button></div> 
  </div>
</form>
@endif


    

		<div class="row">



			<img src="uploads/{{ $customeroutput->sign }}" style="border: 1px solid black; height: 70px; width: 200px; margin-top: 120px ; background-color:white" >

		<small>Customers Signature</small>
			

		</div>
		
	</div>

</div>




<div class="row">
	<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Ref-No</th>
      <th scope="col">Narration</th>
      <th scope="col">Debit</th>
      <th scope="col">Credit</th>
       <th scope="col">Balance</th>
        <th scope="col">Transaction date</th>
      <th scope="col">Teller</th>
    </tr>
  </thead>

   
@php
$leg = json_decode($ledger2);
// echo '<pre>';
//     print_r($leg);
//   echo   '</pre>';
  
   
@endphp

{{-- @foreach ($leg as $item )
{{ $item->id }} 
@endforeach --}}




<?php
    


$arrlength = count($leg);

//echo $arrlength;

$x=0;

for ($x=0; $x < $arrlength ; $x++) { 
if (!empty($leg[$x])) {

    if (!empty($leg[$x]->credit)) {
	@$out+= $leg[$x]->credit;
}else{
	@$out-= $leg[$x]->debit;
}

?>
 <tbody class="zip">
    <tr>
      <th scope="row" style="color: white"><?php echo $leg[$x]->refno; ?></th>
      <td style="color: white"><?php echo $leg[$x]->narration; ?></td>
     <b> <td style="color: red"><?php if (!empty($leg[$x]->debit)) {
      	echo number_format($leg[$x]->debit,2);
      }else{ echo "--";}  ?></td></b>
     <b><td style="color: white"><?php if (!empty($leg[$x]->credit)) {
     	echo number_format($leg[$x]->credit,2);
     } else{ echo "--";}  ?></td></b>
     <b></b> <td style="color: green"><?php 
      	echo number_format(@$out,2) ;

      	 
      ?></td></b>
      <td style="color: white"><?php echo date('d-m-Y',strtotime($leg[$x]->created_at)) ?></td>
     <td style="color: white"><?php echo $leg[$x]->user ; ?></td>
    </tr>

    <?php 
	
@$sumdebit+=$leg[$x]->debit;

@$sumcredit+=$leg[$x]->credit;
 ?>
 













<?php
}}

@$mybal = $sumcredit - $sumdebit;

?>

















<tr>
    <th scope="row"></th>
    <td></td>
    <td style="color: white"><p style="color: yellow">Total Debit</p><h5>&#8358; <?php echo number_format(@$sumdebit,2); ?></h5></td>
    <td style="color: white"><p style="color: yellow">Total Credit</p><h5>&#8358; <?php echo number_format(@$sumcredit,2); ?></h5></td>


	</tr>

	<tr>
		<th scope="row"></th>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">
			<div class="text-center">
				<hr class="light">
				<span style="color: yellow">TOTAL BALANCE</span>
				<h3 id="balsum" style="color: white">&#8358; <?php echo  number_format(@$sumcredit - @$sumdebit,2) ; ?></h3>
				<hr class="light">
			</div>
		</td>

	</tr>

  </tbody>
</table>

</div>


</div></div>

                
        {{-- end of body         --}}
    </div>       
</div> 
@include('admin.appfooter');




































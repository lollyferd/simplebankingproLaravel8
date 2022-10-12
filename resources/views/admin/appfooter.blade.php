
 
 
 {{-- jquery cdn.... i copied it.... --}}
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 

   <script>
   


//$(document).ready(function(){

  function fetchcustomer(){
  
   formated_data = $('#userform').serialize();

    $.ajax({
  
  type: 'GET',
      url: "/fetch-customers",
      dataType:'json',
     data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.data);
//alert(rsp.data.id);

$('#customerid').val(rsp.data.nuban);

//$('.search').val(rsp.data.surname + ' ' + rsp.data.othername);

$("#nuban").val(rsp.data.nuban);

if(rsp.data.tel==''){
  $('#tel').val("No Phone Number");
}else{

$("#tel").val(rsp.data.tel);

}

$('#pix').attr('src','uploads/'+rsp.data.photo);
 $("#pix").attr("title","Customer Passport");


$("#load").css("height",100);
  $("#load").css("width",100);
   $("#load").css("margin-left",50);


 $('#load').attr('src','images/completed1.png');

  },

  error:function(err){
    console.log(err);
    //err is the response from the server if there is an error
  },
  beforeSend:function(){
    
  }
});
  }
    

     //});






  $(document).ready(function(){

    fetchalldata();

  function fetchalldata(){
  
  formated_data = $('#userform').serialize();

   $.ajax({
 
 type: 'GET',
     url: "/fetch-all-customer",
     dataType:'json',
    data: formated_data,
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.searchdata);


$.each(rsp.dataall,function (key, item){
   $(".getcustomer").append('<option value="'+item.id+'" style="padding-bottom: 9px; border-bottom: 1px solid green; font-size: 20px ">'+item.surname+' '+ item.othername+'</option>');
    
  //alert(item.id);

})

 

 },

 error:function(err){
  // console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});
 }
 
    });

    //search with SURNAME.......................................

 $(document).on('keyup change keypress', '#search', function(){
  var query = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'POST',
     url: "/searchcustomer",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      query: query,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
// console.log(rsp.mysearch);

var data = '';

$('.getcustomer').html('');

$.each(rsp.mysearch,function (key, item){

  data = '<option value="'+item.id+'" style="padding-bottom: 9px; border-bottom: 1px solid green; font-size: 20px ">'+item.surname+' '+ item.othername+'</option>';
   $(".getcustomer").append(data);
    
  //alert(item.id);

})

 },

 error:function(err){
  // console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});

//search with NUBAN.......................................

$(document).on('keyup change click keypress', '#nuban', function(){
  var out = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'POST',
     url: "/searchcustomerbynuban",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
// console.log(rsp.mysearch);

var data = '';

$('.getcustomer').html('');

$.each(rsp.mysearchnuban,function (key, item){

  data = '<option value="'+item.id+'" style="padding-bottom: 9px; border-bottom: 1px solid green; font-size: 20px ">'+item.surname+' '+ item.othername+'</option>';
   $(".getcustomer").append(data);
    
  //alert(item.id);

})

 },

 error:function(err){
  // console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});


    //Deposit customer details.........................

$(document).on('keyup change click mouseover', '#nuban11', function(){
  var output = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'get',
     url: "/detailsdisplay",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      output: output,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.myout[0].nuban);


$("#displayname").val(rsp.myout[0].surname+' '+rsp.myout[0].othername);
var num = rsp.myout[0].bal;

$("#displaybal").val(num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))

$("#customerid").val(rsp.myout[0].customerid)
$("#status").text(rsp.myout[0].status)
$("#tel").text(rsp.myout[0].tel)
$("#accttype").val(rsp.myout[0].typeofacct)

 },

 error:function(err){
  console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});



//search sub class.......................................

$(document).on('change click',  '#classid', function(){
  var out = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'get',
     url: "/displaysub",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.myout[0]);

var data = '';

$('#subclassid').html('');



$.each(rsp.myout,function (key, item){

   data = '<option value="'+item.id+'" style=" ">'+item.subclass+'</option>';
   $("#subclassid").append(data);
    //console.log(item.subclass);
  //alert(item);

})

 },

 error:function(err){
  // console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});


//tillbalace .......................................

$(".navbar").ready(function(){
 
  $.ajax({
    
    type: 'get',
        url: "/navbar",
        dataType:'json',
       // data: formated_data,
    success:function(rsp){ 
      console.log(rsp.myout);

      $('#displaytillbal').text(rsp.myout);
  
  
  
     
  
    },
  
    error:function(err){
      console.log(err)
      
    },
    beforeSend:function(){
      
    }
  });
});

//signature and passport update.................
$(document).on('keyup change click mouseover', '#nubanupdate', function(){
  var output = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'get',
     url: "/detailsdisplay",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      output: output,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.myout[0].nuban);


$("#surnameupdate").val(rsp.myout[0].surname+' '+rsp.myout[0].othername);



 },

 error:function(err){
  console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});


 //Deposit customer details.........................

 $(document).on('keyup change click mouseover', '#nubanedit', function(){
  var output = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'get',
     url: "/depositfc",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      output: output,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.myout[0].nuban);


$("#surname").val(rsp.myout[0].surname);
$("#bvn").val(rsp.myout[0].bvn);
$("#othername").val(rsp.myout[0].othername);
$("#nubanedit2").val(rsp.myout[0].nuban);
$("#gender").val(rsp.myout[0].gender);
$("#dob").val(rsp.myout[0].dob);
$("#email").val(rsp.myout[0].email);
$("#tel").val(rsp.myout[0].tel);
$("#city").val(rsp.myout[0].city);
$("#occupation").val(rsp.myout[0].occupation);
$("#state").val(rsp.myout[0].state);
$("#contactaddress").val(rsp.myout[0].homeaddress);
$("#officeaddress").val(rsp.myout[0].officeaddress);
$("#nextofkin").val(rsp.myout[0].nextofkin);
$("#nextofkinaddr").val(rsp.myout[0].nextofkinaddr);


 },

 error:function(err){
  console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});


// display of debit amount for special deduction................
$(document).on('change keyup click mouseover', '#debit', function(){
  var out = $(this).val();
  //console.log(out); 

  
$('#deductionamt').val(out);

});

//display gl name for special deduction................

$(document).on('change click mouseover', '#glkcode', function(){
  var out = $(this).val();
  //console.log(out); 

  
$('#glname').val(out);

});



//account status update block.................
$(document).on('click', '.block', function(){
  var out = $(this).val();

  //alert(out);
if( confirm('are you sure you want to block this account')==true){


  $.ajax({
 
 type: 'post',
     url: "/blockaccount",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ 

   //console.log(rsp.myout);

   

  //alert(rsp.myout);

  confirm(rsp.myout);

  location.reload();


 },

 error:function(err){
  console.log(err);
   
 },
 beforeSend:function(){
   
 }
});

}

});




//account status update unblock.................
$(document).on('click', '.unblock', function(){
  var out = $(this).val();

  //alert(out);

  if(confirm('are you sure you want to unblock this account?')==true){


  $.ajax({
 
 type: 'post',
     url: "/unblockaccount",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ 

  //console.log(rsp);

 alert(rsp.myout);



 location.reload();


 },

 error:function(err){
  console.log(err);
   
 },
 beforeSend:function(){
   
 }
});

  }

});



//account status update disabled.................
$(document).on('click', '.disable', function(){
  var out = $(this).val();

  //alert(out);

  if(confirm('are you sure you want to disable this account?')==true){


  $.ajax({
 
 type: 'post',
     url: "/disableaccount",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ 

  //console.log(rsp);

 alert(rsp.myout);



 location.reload();


 },

 error:function(err){
  console.log(err);
   
 },
 beforeSend:function(){
   
 }
});

  }

});

//account status update enabled.................
$(document).on('click', '.enable', function(){
  var out = $(this).val();

  //alert(out);

  if(confirm('are you sure you want to enable this account?')==true){


  $.ajax({
 
 type: 'post',
     url: "/enableaccount",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      out: out,

    },
 success:function(rsp){ 

  //console.log(rsp);

 alert(rsp.myout);



 location.reload();


 },

 error:function(err){
  console.log(err);
   
 },
 beforeSend:function(){
   
 }
});

  }

});

//investment calc................
function fdbooking(){
  formated_data = $('#fdform').serialize();

$.ajax({
  
  type: 'POST',
      url: "/investmentcalc",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ 

   // console.log(rsp.myout[0].nuban)

 $amtfd=$('#amtfd').val();

   $('#accountnamefd').val(rsp.myout[0].surname + ' ' + rsp.myout[0].othername);

   

  $('#balfd').val(rsp.myout[0].bal - $amtfd);

   $("#customerid").val(rsp.myout[0].customerid);

  
 $("#typeofacct").val(rsp.myout[0].typeofacct);
   

    $intfd=$('#intfd').val();
      $durationfd=$('#durationfd').val();


$x=$intfd/100 * $amtfd;

$y=$x/365;

$z=$y* $durationfd;

$tc=$z*10/100;

$('#totalintfd').val($z);
$tj = $z-$tc;
$("#totaldue").val($tj.toFixed(2));


$("#wht").val($tc);

// $x=x.toFixed(2)
$("#maturitydate").val(rsp.myout2);

  

  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){
    
  }
});

};




//display pending investment 

function investmentapprovalcheck(){
  formated_data = $('#fddisplay').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "/investmentapprovalcheckf",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}


//alert(rsp.ref);

$('#reffd').val(rsp.myout[0].ref);

 $('#nubani').val(rsp.myout[0].nuban);

 $('#acctno').val(rsp.myout[0].customerid);

 $('#acctnamei').val(rsp.myout[0].acctname);

$('#fdamt').val(rsp.myout[0].fdamt);

 $('#fdint').val(rsp.myout[0].fdint);

 $('#dint').val(rsp.myout[0].duration);

$('#totalint').val(rsp.myout[0].totalint);

$('#maturity').val(rsp.myout[0].maturity);
$('#durationint').val(rsp.myout[0].duration);
//$('#acctbali').val(rsp.bal);



$('#fdapp').css("display",'block');


  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){




  }
});

};

$(document).ready(function(){
     $('#saveloantype').click(function(){


   formated_data = $('#loanform').serialize();
  
  // alert(formated_data);
  $.ajax({
    
    type: 'POST',
        url: "/addloantype",
        dataType:'json',
        data: formated_data,
    success:function(rsp){ 
  
  //alert(rsp);
  
  $('#infoloan').html(rsp.result1);
  $('#loantype').val('');
  
    },
  
    error:function(err){
      console.log(err)

    },
    beforeSend:function(){
      
    }
  });



 });

     });


     //loan form display

     function loandisplay() {
  formated_data = $('#loanbookingform').serialize();
  
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "/loandisplay",
      dataType:'json',
      data: formated_data,
  success:function(rsp){

//alert(rsp);
$("#acctnameloan").val(rsp.myout[0].surname+' '+rsp.myout[0].othername);
var num = rsp.myout[0].bal;

$("#acctbal").val(num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))

  //  $('#acctnameloan').val(rsp.surname+' '+rsp.othername);

  //  $('#acctbal').val(rsp.bal);

   $rate=$("#loanrate").val();

    $period=$("#period").val();

     $request=$("#loanrequest").val();
   
$intM=$rate/100*$request;

$intT=$intM*$period;

$("#totalint").val($intT.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

$('#mInterest').val($intM);

mP=$request/$period;

$('#mPrincipal').val(mP);

if ($intT!='') {
  $totalrepay=$request*1+$intT;

}



$("#totalrepay").val($totalrepay.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

$('#customerid').val(rsp.myout[0].customerid);

$('#firstdate').val(rsp.date);

  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){
    
  }
});

};



function loandisplayR() {
  formated_data = $('#loanbookingformR').serialize();
  
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "/loandisplay",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}

//alert(rsp);


   $('#acctnameloan').val(rsp.myout[0].surname+' '+rsp.myout[0].othername);

   $('#acctbal').val(rsp.myout[0].bal);


$('#customerid').val(rsp.myout[0].customerid);


$('#firstdate').val(rsp.date);
  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){
    
  }
});

};
   

function loanapprovalcheck(){
  formated_data = $('#loandisplay').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "/loanapprovaldisplay",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}

 //console.log(rsp.myout[0].ref);
//alert(rsp.myout[0].ref);

$('#refaploan').val(rsp.myout[0].ref);

$('#nubanap').val(rsp.myout[0].nuban);

$('#acctnameloan').val(rsp.myout[0].acctname);

$('#loanamtap').val(rsp.myout[0].tp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

$('#rateap').val(rsp.myout[0].loanrate);

$totalmdeduct= +rsp.myout[0].mpd + +rsp.myout[0].mid;

$('#mdeductionap').val($totalmdeduct.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

$('#fdeductionap').val(rsp.myout[0].firstdeductiondate);

$("#totalrepayap").val(rsp.myout[0].totalrepayment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

// $('#totalrepayap').val(rsp.myout[0].totalrepayment);

$('#loandateap').val(rsp.myout[0].applicationdate);

$('#pap').val(rsp.myout[0]. totalmonth);
$('#acctno').val(rsp.myout[0].customerid);

$('#loanapp').css("display",'block');




  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){




  }
});

};


function loanreversal(){
  formated_data = $('#loanreversalform').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "loanreversalf",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}


if(rsp.output!=''){


  $('#notifyinfoinvestment').html('Transaction Reversal &#8358; ' + rsp.output[0].tp+' with Ref_No:'+ rsp.output[0].ref +' Account Number: '+ rsp.output[0].nuban+'  Account Name: ' + rsp.output[0].acctname);
  $('#notifyinfoinvestment').css("color",'black');
  $('#nubanrevloan').val(rsp.output[0].nuban);
  $('#refrevloan').val(rsp.output[0].ref);
  $('#acctidloan').val(rsp.output[0].customerid);
$('#creditrevloan').val(rsp.output[0].tp);
$('#acctnamerevloan').val(rsp.output[0].acctname);
$('#totalrepay').val(rsp.output[0].totalrepayment);
$('#loanid').val(rsp.output[0].id);
$('#int').val(rsp.output[0].totalint);
}else{


  $('#notifyinfoinvestment').html("This loan booked can not be reversed");
  $('#notifyinfoinvestment').css("color",'red');






}


  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){



    
  }
});

};





function investmentreversal(){
  formated_data = $('#investmentreversalform').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "investmentreversalf",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ 

//alert('hello');
if(rsp.output!=''){


 $('#notifyinfoinvestment').html('Transaction Reversal &#8358; ' + rsp.output[0].fdamt+' with Ref_No:'+ rsp.output[0].ref +' Account Number: '+ rsp.output[0].nuban+'  Account Name: ' + rsp.output[0].acctname);
  $('#notifyinfoinvestment').css("color",'black');
   $('#nubanrev').val(rsp.output[0].nuban);
  $('#refrev').val(rsp.output[0].ref);
  $('#acctid').val(rsp.output[0].customerid);
 $('#creditrev').val(rsp.output[0].fdamt);
 $('#acctnamerev').val(rsp.output[0].acctname);
// // $('#totalrepay').val(rsp.output[0].totalrepayment);
// // $('#loanid').val(rsp.output[0].id);
// // $('#int').val(rsp.output[0].totalint);
}else{


  $('#notifyinfoinvestment').html("This Investment can not be reversed");
  $('#notifyinfoinvestment').css("color",'red');






}


  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){



    
  }
});

};


function trfreceiver() {
  formated_data = $('#trf').serialize();


//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "transferreceiver",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}



     $('#receivername').val(rsp.output[0].surname+' '+rsp.output[0].othername);

     $('#receiveraccttype').val(rsp.output[0].typeofacct);

    //  $("#receiveracctid").val(rsp.output[0].customerid);

 

  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){
   


    
  }
});

};

function trfsenders() {
  formated_data = $('#trf').serialize();

$.ajax({
  
  type: 'POST',
      url: "transfersender",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ 



     $('#sendername').val(rsp.output[0].surname+' '+rsp.output[0].othername);

     $('#senderaccttype').val(rsp.output[0].typeofacct);

    

     $x=$('#senderamount').val();


     $y=rsp.output[0].bal-$x;

    
 $("#senderbal").val($y);

//  $("#senderacctid").val(rsp.output[0].customerid);


   

  },

 
});

};


function transferapprovalcheck(){
  formated_data = $('#tfdisplay').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "transferapprovaldisplay",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}

  var date = new Date(rsp.out[0].created_at);

$('#trfdate').text(((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());


$('#trfnuban').val(rsp.out[0].sendernuban);
$('#trfname').val(rsp.out[0].sendername);
$('#trftype').val(rsp.out[0].senderaccttype);
$('#trfamt').val(rsp.out[0].sentamt);
// $('#trfacctno').val(rsp.out[0].acctno);
$('#reftrf').val(rsp.out[0].ref);

$('#trfff').css("display",'block');


$('#nubantrfr').val(rsp.out[0].receivernuban);
$('#nametrfr').val(rsp.out[0].receivername);
$('#typetrfr').val(rsp.out[0].receiveraccttype);
// $('#acctnotrfr').val(rsp.out[0].acctno);


  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){




  }
});

};


function transferreversalview(){
  formated_data = $('#trfreversal').serialize();
 
//alert(formated_data);
$.ajax({
  
  type: 'POST',
      url: "transferreversalf",
      dataType:'json',
      data: formated_data,
  success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}

 
// alert(rsp.output);

console.log(rsp.output[0].sendername);

 $('#notifyinfotransfer').html('Transaction Reversal of &#8358; ' + rsp.output[0].sentamt+' From Account Name: '+ rsp.output[0].sendername +' With Account Number: '+ rsp.output[0].sendernuban);
 $("#acctidrev").val(rsp.output[0].acctno);
 $("#nubantrfrev").val(rsp.output[0].nuban);
 $("#amtrev").val(rsp.output[0].sentamt);

  },

  error:function(err){
    console.log(err)
    //err is the response from the server if there is an error
  },
  beforeSend:function(){




  }
});

};


function narrations(){
      
  $("#narration2").text($('#narration1').val());

}


function amount(){
      
      $debit=$('#credit').val();
      
      
      
      $("#debit").val($debit);
      
      }


      $(document).ready(function(){
  $('.gltoacct1').click(function(){

$('#exampleFormControlSelect2').css('display','block');
$('.gltoaccedit1').css('display','block');



$('.gltoacct2').attr("disabled","disabled");



    
  // alert('hello');
   
  });


   $('.gltoacct2').click(function(){


$('#exampleFormControlSelect1').css('display','block');
 $('.gltoaccedit2').css('display','block');



 $('.gltoacct1').attr("disabled","disabled");
    
  // alert('hello');
   
  });
  });

  $(document).on('keyup change click mouseover', '#nubangltoacct', function(){
  var output = $(this).val();
  //console.log(query); 

  $.ajax({
 
 type: 'get',
     url: "/detailsdisplay",
     dataType:'json',
    data: {
      '_token':'{{ csrf_token() }}',
      output: output,

    },
 success:function(rsp){ //response will come in this format {'msg':'',msgclass:'',}
//console.log(rsp.myout[0].nuban);


$("#displayname1").val(rsp.myout[0].surname+' '+rsp.myout[0].othername);
var num = rsp.myout[0].bal;

$("#displaybal1").val(num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))

// $("#customerid").val(rsp.myout[0].customerid)
// $("#status").text(rsp.myout[0].status)
// $("#tel").text(rsp.myout[0].tel)
// $("#accttype").val(rsp.myout[0].typeofacct)

 },

 error:function(err){
  console.log(err);
   //err is the response from the server if there is an error
 },
 beforeSend:function(){
   
 }
});


});





  </script>
  
  
  <!-- plugins:js -->

  <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
  <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="admin/assets/js/off-canvas.js"></script>
  <script src="admin/assets/js/hoverable-collapse.js"></script>
  <script src="admin/assets/js/misc.js"></script>
  <script src="admin/assets/js/settings.js"></script>
  <script src="admin/assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="admin/assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
 
</body>
</html>

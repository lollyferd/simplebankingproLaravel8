<div  style="width:800px; height:600px; padding:20px;  border: 20px solid green; margin: auto;">
    <div style="width:750px; height:550px; padding:20px;  border: 5px solid #787878; margin: auto;">
    
           <div style="text-align:center;"><span style="text-transform: uppercase; color: tan; font-size: 30px; "><?php echo strtoupper( $company[0]->company_name) ?></span></div><br>
            <div style="text-align:center;"><span style="font-size: 20px;"><?php echo $company[0]->address ?></span></div>
            <br><br><br>
          <div style="text-align:center;"> <span style="font-size:50px; font-weight:bold; color: tan;"> Certificate of Investment</span></div>
           <br><br>
           <div style="text-align:center;"><span style="font-size:25px;"><i>This is to certify that</i></span></div>
           <br><br>
          <div style="text-align:center;"> <span style="font-size:30px; font-style: italic;"><b><?php echo strtoupper( $out[0]->acctname) ?></b></span></div><br/><br/>
    
            
                  <b style="font-size:15px; margin:20px;"> <span>Of: </span><span><?php echo $details[0]->homeaddress  ?></span></b><br><br>
                   
    
    
                   <span style="font-size: 15px; margin:20px;">Investment Amount: </span><span style="font-size: 20px;"><b>&#8358; <?php echo number_format($out[0]->fdamt,2) ?></span></b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="font-size: 15px">Period of: </span><b><i><span><?php echo $out[0]->duration ?></span><span> days</span></i></b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <span style="font-size: 15px">At: </span><b><i><span><?php echo $out[0]->fdint ?></span><span>% P.a</span></i></b><br>
                 
                    <p><b style="font-size:15px; margin:20px;"><span>Date of Issue: <?php echo  date("jS, F Y", strtotime($out[0]->predate)) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Maturity Date: <?php echo date("jS, F Y", strtotime($out[0]->maturity)); ?></span></b></p>    
    
                    <div>This is to certify that Mr/Mrs/Miss <span><?php echo strtoupper( $out[0]->acctname)  ?></span><span> has an investment with us which is subject to our rules applicable thereto.</span></div><br><br>
    
    
                    <div style="border-top: 5px solid black; width: 300px;"></div>
    
                    <div>Authorization Signature</div>  
    
    
    
           <!-- <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
           <span style="font-size:30px">$course.getName()</span> <br/><br/>
           <span style="font-size:20px">with score of <b>$grade.getPoints()%</b></span> <br/><br/><br/><br/>
           <span style="font-size:25px"><i>dated</i></span><br>
          #set ($dt = $DateFormatter.getFormattedDate($grade.getAwardDate(), "MMMM dd, yyyy"))
          <span style="font-size:30px">$dt</span> -->
    </div>
    </div>
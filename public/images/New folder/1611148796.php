<?php 
ob_start(); 
// database connection class live host
class DatabaseConfig{
		// member variables
		public $conn;

		// member functions
		public function __construct(){
			// create connection
			$this->conn=new mysqli('localhost','hallmar1_user','@hallmark2019','hallmar1_bankingdb');
			// check connection
			if($this->conn->connect_error){
				die("Connection Failed ".$this->conn->connect_error);
			}else{
				//echo "connection successful";
			}
		}
	}








//database connection class for local host
// 	class DatabaseConfig{
// 		// member variables
// 		public $conn;

// 		// member functions
// 		public function __construct(){
// 			// create connection
// 			$this->conn = new mysqli("localhost", "root", "", "simple_banking_db");
// 			// check connection
// 			if($this->conn->connect_error){
// 				die("Connection Failed ".$this->conn->connect_error);
// 			}else{
// 				//echo "connection successful";
// 			}
// 		}
// 	}




class simple{
		// member variables
			public $dbobj;
			// member functions
		public function __construct(){
			// create instance/object of DatabaseConfig
			$this->dbobj = new DatabaseConfig;
		}

	





public function register_new_org($company_name,$rc,$caddress,$phone,$email){

if($_FILES['logo']['error'] == 0){

				// specify the destination folder to upload files to
				$folder = "uploads/";
				$filesize = $_FILES['logo']['size'];
				$filename = $_FILES['logo']['name'];
				$filetype = $_FILES['logo']['type'];
				$tempfolder = $_FILES['logo']['tmp_name'];

				// get the file extension
				$file_ext = explode('.',$filename);
				$file_ext = end($file_ext);
				$file_ext = strtolower($file_ext);

				// specify extensions allowed
				$extensions = array('png', 'jpg', 'jpeg', 'gif');

				// check for valid extension
				if(in_array($file_ext, $extensions)===false){
					$error[] = "extension not allowed!";
				}

				// check the file size
				if($filesize > 2097152){
					$error[] = "File size must be exactly or less than 2 mb!";
				}

				$filename = time();
				$destination = $folder.$filename.".$file_ext";

				if(empty($error)==true){
					move_uploaded_file($tempfolder, $destination);





	$cname=mysqli_real_escape_string($this->dbobj->conn, $_POST['company_name']);
	$rc=mysqli_real_escape_string($this->dbobj->conn, $_POST['rc']);
	$caddress=mysqli_real_escape_string($this->dbobj->conn, $_POST['caddress']);
	$phone=mysqli_real_escape_string($this->dbobj->conn, $_POST['phone']);
	$email=mysqli_real_escape_string($this->dbobj->conn, $_POST['email']);


$sql="INSERT into organization set company_name='$cname',rc_no='$rc',address='$caddress',phone='$phone',email='$email',logo='$destination'";
         if($this->dbobj->conn->query($sql)===true){
						$result="<div class='alert alert-success text-center'>Registration successful</div>";
					}else{
						$result = "Error ".$this->dbobj->conn->error;
					}

				}else{
					//var_dump($error);
				}



			}else{
				$result="<div class='alert alert-warning text-center'>Registration Failed</div>";
			}


			return $result;



		
		}



		public function orgselect(){
			$sql="SELECT * from organization order by organization_id Desc";

			$result= $this->dbobj->conn->query($sql);

			$row = $result->fetch_assoc();

			return $row;
		}





public function register_user($fname,$username,$email,$phone,$access,$password,$passwordretype){

		$fnamei=mysqli_real_escape_string($this->dbobj->conn, $_POST['fname']);
		$usernamei=mysqli_real_escape_string($this->dbobj->conn, $_POST['username']);
		$emaili=mysqli_real_escape_string($this->dbobj->conn, $_POST['email']);
		$phonei=mysqli_real_escape_string($this->dbobj->conn, $_POST['phone']);
		$accessi=mysqli_real_escape_string($this->dbobj->conn, $_POST['access']);
		$passwordi=mysqli_real_escape_string($this->dbobj->conn, $_POST['password']);
		$passwordretypei=mysqli_real_escape_string($this->dbobj->conn, $_POST['passwordretype']);

		$pass1=md5(strrev(trim($passwordi)));
		$pass2=md5(strrev(trim($passwordretypei)));

		if (strlen($pass1>8 && $pass1<9)) {
			$result="<div class='alert alert-danger text-center'>Registration Failed: Password can not be less than 8 Characters Please try again</div>";
		}else{

		$sql="INSERT into user set fname='$fnamei',username='$usernamei',email='$emaili',phone='$phonei',access='$accessi',password='$pass1',passwordretype='$pass2'"; 

		if ($this->dbobj->conn->query($sql)==true) {
			$result="<div class='alert alert-success text-center'>Registration successful</div>";
		}
		else{
			$result="<div class='alert alert-warning text-center'>Registration Failed</div>";
		}}

		return $result;
}




public function searchemail($username){
	$result=$this->dbobj->conn->query("SELECT * from user where username='$username'");

return	$result->num_rows;
}




public function login($username, $pass){
	$usernamei=mysqli_real_escape_string($this->dbobj->conn, $_POST['username']);
	$passwordi=mysqli_real_escape_string($this->dbobj->conn, $_POST['pass']);
	$pass1=md5(strrev(trim($passwordi)));

	$sql="SELECT * from user where username='$usernamei' and Password='$pass1' and active='Yes'";

	$row=$this->dbobj->conn->query($sql);

	return $row->num_rows;


}



public function userdetails($user){
	$result=$this->dbobj->conn->query("SELECT * from user where username='$user'");

	$row= $result->fetch_assoc();

	return $row;
}



public function states(){
	$sql = "SELECT * from states";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		
	}
	return $row;
}


public function local($id){
	$sql = "SELECT name from local_governments where state_id='$id'";

	$result=$this->dbobj->conn->query($sql);

	
while ( $row[] = $result->fetch_assoc()) {
	
 }

return $result;
		}


public function create($surname,$bvn,$othername,$gender,$dob,$email,$tel,$occupation,$country,$state,$city,$contactaddress,$officeaddress,$typeofacct,$classofacct,$nextofkin,$nextofkinaddr,$accountofficer,$user){

			if($_FILES['photo']['error'] == 0){

				// specify the destination folder to upload files to
				$folder = "uploads/";
				$filesize = $_FILES['photo']['size'];
				$filename = $_FILES['photo']['name'];
				$filetype = $_FILES['photo']['type'];
				$tempfolder = $_FILES['photo']['tmp_name'];

				// get the file extension
				$file_ext = explode('.',$filename);
				$file_ext = end($file_ext);
				$file_ext = strtolower($file_ext);

				// specify extensions allowed
				$extensions = array('png', 'jpg', 'jpeg', 'gif');

				// check for valid extension
				if(in_array($file_ext, $extensions)===false){
					$error[] = "extension not allowed!";
				}

				// check the file size
				if($filesize > 2097152){
					$error[] = "File size must be exactly or less than 2 mb!";
				}

				$filename = time();
				$destination = $folder.$filename.".$file_ext";

				if(empty($error)==true){
					move_uploaded_file($tempfolder, $destination);
	
	
				$sql = "INSERT into customer_details set surname='$surname',bvn='$bvn',othername='$othername',gender='$gender',dob='$dob',email='$email',tel='$tel',occupation='$occupation',country='$country',state='$state',city='$city',contactaddress='$contactaddress',officeaddress='$officeaddress',typeofacct='$typeofacct',classofacct='$classofacct',nextofkin='$nextofkin',nextofkinaddr='$nextofkinaddr',photo='$destination',accountofficer='$accountofficer',usercode='$user'";

 				      $this->dbobj->conn->query($sql);

				}


			}
			$nuban=$this->dbobj->conn->insert_id;

			$accttype=$this->dbobj->conn->query("SELECT * from accttype where account_type='$typeofacct'");
			$accttype1=$accttype->fetch_assoc();

			if (strlen($nuban)==1) {
				$nubanformatted='101'.$accttype1['acct_id'].'00000'.$nuban;
			}
			if (strlen($nuban)==2) {
				$nubanformatted='101'.$accttype1['acct_id'].'0000'.$nuban;
			}
			if (strlen($nuban)==3) {
				$nubanformatted='101'.$accttype1['acct_id'].'000'.$nuban;
			}

			if (strlen($nuban)==4) {
				$nubanformatted='101'.$accttype1['acct_id'].'00'.$nuban;
			}

			if (strlen($nuban)==5) {
				$nubanformatted='101'.$accttype1['acct_id'].'0'.$nuban;
			}
			if (strlen($nuban)==6) {
				$nubanformatted='101'.$accttype1['acct_id'].$nuban;
			}
			//$nubanformatted='101'.$accttype1['acct_id'].'00000'.$nuban;

			$this->dbobj->conn->query("UPDATE customer_details set NUBAN='$nubanformatted' where account_no='$nuban'");

			///sms sending ..............................

				$owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message='Dear '.$surname .' '. $othername.' '. 'your Hallmark capital Limited account has been created with Account Number: '. $nubanformatted; /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r")){
                    $answer = fgets($f, 255);
                    if (substr($answer, 0, 1) == "+"){
                   // echo "SMS to $dnr was successful.";
                    } 
                }
                
                
		return $nubanformatted;	
		}

public function customerselect($nuban){
	$sql = "SELECT * from customer_details where NUBAN='$nuban' and status!='deleted'";

	$result=$this->dbobj->conn->query($sql);

	
 $row = $result->fetch_assoc();
	
 

return $row;
		}    




//Edit existing customer account.............................

	public function customeredit($surname,$bvn,$othername,$gender,$dob,$email,$tel,$occupation,$country,$state,$city,$contactaddress,$officeaddress,$nextofkin,$nextofkinaddr,$accountofficer,$user,$nuban){
		$sql="UPDATE customer_details set surname='$surname',bvn='$bvn',othername='$othername',gender='$gender',dob='$dob',email='$email',tel='$tel',occupation='$occupation',country='$country',state='$state',city='$city',contactaddress='$contactaddress',officeaddress='$officeaddress',nextofkin='$nextofkin',nextofkinaddr='$nextofkinaddr',accountofficer='$accountofficer',usercode='$user',status='Updated' where NUBAN='$nuban'";
		$out=$this->dbobj->conn->query($sql);

		if($this->dbobj->conn->query($sql)==true){
			
			$result="<div class='alert alert-info text-center'>Account Updated successful</div>";
		}else{
			$result="<div class='alert alert-danger text-center'>Update Failed</div>";
		}
 		
 		return $result;		      
	}	

//update customer account status............................

	public function updatestatus($nuban,$status){
		$sql="SELECT * from customer_details where NUBAN='$nuban'";

		$out=$this->dbobj->conn->query($sql);

		$row=$out->fetch_assoc();

		$loanbal=$row['loanbal'];
		$bal=$row['bal'];


		if ($loanbal!=0) {
			$result="<div class='alert alert-warning text-center'>customer Account status can not be changed</div>";
		}elseif ($bal!=0) {
			$result="<div class='alert alert-warning text-center'>customer Account status can not be changed</div>";
		}
		else{

			$sql2="UPDATE customer_details set status='$status' where NUBAN='$nuban'";

			if ($this->dbobj->conn->query($sql2)==True) {
				$result="<div class='alert alert-info text-center'>Account status Updated successful</div>";
			}else{
				$result="<div class='alert alert-danger text-center'>Account Update Failed</div>";
			}

		}

		return $result;
	}


//update signature ...................................

public function updatesign($nuban){

		if($_FILES['sign']['error'] == 0){

				// specify the destination folder to upload files to
				$folder = "uploads/";
				$filesize = $_FILES['sign']['size'];
				$filename = $_FILES['sign']['name'];
				$filetype = $_FILES['sign']['type'];
				$tempfolder = $_FILES['sign']['tmp_name'];

				// get the file extension
				$file_ext = explode('.',$filename);
				$file_ext = end($file_ext);
				$file_ext = strtolower($file_ext);

				// specify extensions allowed
				$extensions = array('png', 'jpg', 'jpeg', 'gif');

				// check for valid extension
				if(in_array($file_ext, $extensions)===false){
					$error[] = "extension not allowed!";
				}

				// check the file size
				if($filesize > 2097152){
					$error[] = "File size must be exactly or less than 2 mb!";
				}

				$filename = time();
				$destination = $folder.$filename.".$file_ext";

				if(empty($error)==true){
					move_uploaded_file($tempfolder, $destination);


$sql="UPDATE customer_details set sign='$destination' where NUBAN='$nuban'";

if($this->dbobj->conn->query($sql)===true){
						$result="<div class='alert alert-success text-center'>Customers Signature Updated successfully</div>";
					}else{
						$result = "Error ".$this->dbobj->conn->error;
					}

				}else{
					//var_dump($error);
				}



			}else{
				$result="<div class='alert alert-warning text-center'>Update Failed</div>";
			}


			return $result;

}





public function updatepass($nuban){

		if($_FILES['sign']['error'] == 0){

				// specify the destination folder to upload files to
				$folder = "uploads/";
				$filesize = $_FILES['sign']['size'];
				$filename = $_FILES['sign']['name'];
				$filetype = $_FILES['sign']['type'];
				$tempfolder = $_FILES['sign']['tmp_name'];

				// get the file extension
				$file_ext = explode('.',$filename);
				$file_ext = end($file_ext);
				$file_ext = strtolower($file_ext);

				// specify extensions allowed
				$extensions = array('png', 'jpg', 'jpeg', 'gif');

				// check for valid extension
				if(in_array($file_ext, $extensions)===false){
					$error[] = "extension not allowed!";
				}

				// check the file size
				if($filesize > 2097152){
					$error[] = "File size must be exactly or less than 2 mb!";
				}

				$filename = time();
				$destination = $folder.$filename.".$file_ext";

				if(empty($error)==true){
					move_uploaded_file($tempfolder, $destination);


$sql="UPDATE customer_details set photo='$destination' where NUBAN='$nuban'";

if($this->dbobj->conn->query($sql)===true){
						$result="<div class='alert alert-success text-center'>Customers Passport Updated successfully</div>";
					}else{
						$result = "Error ".$this->dbobj->conn->error;
					}

				}else{
					//var_dump($error);
				}



			}else{
				$result="<div class='alert alert-warning text-center'>Update Failed</div>";
			}


			return $result;

}













public function users(){
	$sql = "SELECT * from customer_details where status!='deleted' order by surname";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		
	}
	return $row;
}


public function userformselect($nuban){


$sql1="SELECT SUM(credit) from ledger where NUBAN='$nuban' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where NUBAN='$nuban'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where NUBAN='$nuban'";

		$this->dbobj->conn->query($sql2);

	$sql = "SELECT * from customer_details where NUBAN='$nuban' and status!='deleted' ";

	$result=$this->dbobj->conn->query($sql);

	
 $row = $result->fetch_assoc();
	
 

return $row;
		}       


public function deposit($acctno,$nuban,$narration,$credit,$user,$tellercode,$tel){
	 if (!isset($_SESSION['tellercode'])) {
		$result="<div class='alert alert-warning text-center'>You dont have a teller Access to Post...Please contact the Software admininstrator </div>";

		
	}else{

$sqltest=$this->dbobj->conn->query("SELECT * from customer_details where NUBAN='$nuban'");
	if ($sqltest->num_rows > 0) {
	    $status='cash_tr';


	$sql="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narration',credit='$credit',user='$user',status='$status'";

		$this->dbobj->conn->query($sql);

		$id=$this->dbobj->conn->insert_id;

	      $refnoformated='DEP/00'.$id;

		$update=$this->dbobj->conn->query("UPDATE ledger set Refno='$refnoformated' where id='$id'");

		$sql1="SELECT SUM(credit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where account_no='$acctno'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where account_no='$acctno'";

		$this->dbobj->conn->query($sql2);

///..............................second leg of transaction....................



$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$tellercode'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$formattednarration=$narration.'/'.$nuban;

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$formattednarration',debit='$credit',user='$user', gl_code='$tellercode',gl_name='$formattedname',status='$status'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);


		$result="<div class='alert alert-success text-center'>Cash Transaction successful</div>";
	
	}
else{
	$result="<div class='alert alert-danger text-center'>Failed! Incorrect Account Number</div>";
} 

///sms sending .................................

// $message='Txn: Credit Acct No:'.$nuban.  'Amt:NGN'. $credit .'Desc:'. $narration. 'Date:' .date('Y-m-d H:i:s'). 'Bal:NGN' .$totalsum;

// $url = 'http://www.smslive247.com/http/index.aspx?';
// $data = array('cmd' => 'sendquickmsg', 'owneremail' => 'ikenna4capitalplan@gmail.com','subacct' => 'SUB2','subacctpwd' => 'better','$message' => '$message','sender' => 'Hallmark', 'sendto' => '08032934439','msgtype' =>0);

// 					// use key 'http' even if you send the request to https://...
// 					$options = array(
// 					    'http' => array(
// 					        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
// 					        'method'  => 'POST',
// 					        'content' => http_build_query($data)
// 					    )
// 							);
// 							$context  = stream_context_create($options);
// 							file_get_contents($url, false, $context);

$sqltry="SELECT bal from customer_details where account_no='$acctno'";

$resulttry=$this->dbobj->conn->query($sqltry);

$rowtry=$resulttry->fetch_assoc();

$baltry=$rowtry['bal'];



	$owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message='Txn: Credit Acct Number:'.$nuban .' Amt:NGN '. $credit.' '. ' Desc:'. $narration.' Date: '.date("Y-m-d H:i:s").' Bal:NGN '.number_format($baltry,2); /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r")){
                    $answer = fgets($f, 255);
                    if (substr($answer, 0, 1) == "+"){
                    // echo "SMS to $dnr was successful.";
                    } 
                }


 
}


return $result;
}



public function wdr($acctno,$nuban,$narration,$debit,$user,$tellercode,$tel){
    if (!isset($_SESSION['tellercode'])) {
    	$result="<div class='alert alert-warning text-center'>You dont have a teller Access to Post...Please contact the Software admininstrator </div>";
    	
    }else{

	$sqltest=$this->dbobj->conn->query("SELECT * from customer_details where NUBAN='$nuban'");
	$outwdr=$sqltest->fetch_assoc();
	$xbal=$outwdr['bal'];
	if ($xbal >= $debit) {
		
	if ($sqltest->num_rows > 0) {
		$status='cash_tr';
	
	$sql="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narration',debit='$debit',user='$user', status='$status'";

		$this->dbobj->conn->query($sql);

			


		$id=$this->dbobj->conn->insert_id;
		 $refnoformated='WDR/00'.$id;

		$update=$this->dbobj->conn->query("UPDATE ledger set Refno='$refnoformated' where id='$id'");

		$sql1="SELECT SUM(debit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			


		$sql1="SELECT SUM(credit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}


		$totalsumwdr=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsumwdr' where account_no='$acctno'";

		$this->dbobj->conn->query($sql2);

		///........................second leg of the transaction....................



		$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$tellercode'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$formattednarration=$narration.'/'.$nuban;

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$formattednarration',credit='$debit',user='$user', gl_code='$tellercode',gl_name='$formattedname',status='$status'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	//$refnoformated='GL-Acct/'.$refno;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);

		$result="<div class='alert alert-success text-center'>Withdrawal Transaction successful</div>";
	} 
else{
	$result="<div class='alert alert-danger text-center'>Failed! Incorrect NUBAN</div>";
} }
else{

$result="<div class='alert alert-warning text-center'>Insufficient account Balance</div>";	
}

//sms sending .................................

 	   $owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message='Txn: Debit Acct Number: '.$nuban .' Amt:NGN '. $debit.' '. ' Desc:'. $narration.' Date: '.date("Y-m-d H:i:s").' Bal:NGN '.number_format($totalsumwdr,2); /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r")){
                    $answer = fgets($f, 255);
                    if (substr($answer, 0, 1) == "+"){
                        // echo "SMS to $dnr was successful.";
                    } 
                }

        
    }


return $result;
}


public function ledger($nuban){
	$sql="SELECT * from ledger where NUBAN='$nuban' and deleted='N' order by createdat";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		
	}


	return $row;
}



public function selectuser(){
	$sql="SELECT * from user";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		
	}
	return $row;
}




public function ledgeruser($tellername,$date,$dateb){
// $tellernameget=$this->dbobj->conn->query("SELECT * from user where teller_code='$tellercode'");
// @$X=$tellernameget->fetch_assoc();
// @$y=@$x['username'];

	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where  DATE_FORMAT(createdat, '%Y-%m-%d') BETWEEN '$date' and '$dateb' and ledger.user='$tellername' and deleted='N' order by id desc";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}

///.....Daily Transaction check...............

public function checktill($tellername){
 	$sql="SELECT * from ledger RIGHT join customer_details ON customer_details.account_no=ledger.account_no where DATE_FORMAT(createdat, '%Y-%m-%d')=DATE_FORMAT(CURDATE(), '%Y-%m-%d') AND ledger.user='$tellername' AND deleted='N' order by id desc";


	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}

public function tillbalfile($tellercode){
$sql="SELECT * from gl_ledger  where gl_code='$tellercode' and deleted='N'";

$result=$this->dbobj->conn->query($sql);
while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}

public function pReset($user,$cpass,$npass){

if ($_SERVER['REQUEST_METHOD']=='POST') {
	$user=mysqli_real_escape_string($this->dbobj->conn, $_SESSION['username']);
	$passwordc=mysqli_real_escape_string($this->dbobj->conn, $_POST['cpass']);
	$pass1=md5(strrev(trim($passwordc)));
	$passwordn=mysqli_real_escape_string($this->dbobj->conn, $_POST['npass']);
	$pass2=md5(strrev(trim($passwordn)));
}


			$dashquery="SELECT * FROM user WHERE username='$user' AND password='$pass1'";
			

			$result = $this->dbobj->conn->query($dashquery);
			$k=$result->num_rows;

			if ($k > 0) {
				

				$this->dbobj->conn->query("UPDATE user SET password='$pass2',passwordretype='$pass2' WHERE username='$user'");

				$result="<div class='alert alert-success'>Password Reset successful</div>";
			}
			else{
				$result="<div class='alert alert-danger'>Incorrect current password</div>";
			}

			return $result;

		}


public function account_type($user,$accttype){
	$sql="INSERT into accttype set user='$user',account_type='$accttype'";

	if ($this->dbobj->conn->query($sql)==true) {
		
		$result="<div class='alert alert-success'>Account type successfully added</div>";
	}
	else{
		$result="<div class='alert alert-success'>Account type Failed</div>";
	}

	return $result;
}


public function display_typeofaccount(){

$sql="SELECT * from accttype";

$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}


public function account_officer($user,$adata){
	$out=$this->dbobj->conn->query("SELECT * from accttofficer where account_officer='$adata'");
	if ($out->num_rows > 0) {
	$result="<div class='alert alert-warning'>Account Officer '$adata' already exist </div>";
	}else{
	$sql="INSERT into accttofficer set user='$user',account_officer='$adata'";

	if ($this->dbobj->conn->query($sql)==true) {
		
		$result="<div class='alert alert-success'>Account Officer successfully added</div>";
	}
	else{
		$result="<div class='alert alert-danger'>Transaction Failed</div>";
	} }

	return $result;
}




public function display_accountofficer(){

$sql="SELECT * from accttofficer where active='Y'";

$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}




//search employee for profile edit method
public function searchUser($search){

			$sql = "SELECT * FROM customer_details WHERE surname LIKE '%$search%' ORDER BY account_no";
			$result = $this->dbobj->conn->query($sql);
			//$row = $result->fetch_all(MYSQLI_BOTH);

			while($row = $result->fetch_assoc()){
				$rowdata[] = $row;
			}

			return $rowdata;
		}


public function passret($email,$token,$newpass,$rtpass){

$email = mysqli_real_escape_string($this->dbobj->conn, $_GET['email']);
		$token = mysqli_real_escape_string($this->dbobj->conn, $_GET['token']);

		$sql = "SELECT userid FROM user WHERE email = '$email' AND token = '$token'";
		$result = $this->dbobj->conn->query($sql);

		if($result->num_rows > 0){

			if(isset($_POST['reset'])){

				$np = mysqli_real_escape_string($this->dbobj->conn, $_POST['rtpass']);
				$rp = mysqli_real_escape_string($this->dbobj->conn, $_POST['rtpass']);

				$sql = "SELECT * FROM user WHERE email = '$email'";
				$result = $this->dbobj->conn->query($sql);			

				if($np == $rp){

					$hash = md5(strrev(trim($np))); ;

					$sql = "UPDATE user SET password = '$hash', passwordretype='$hash', token = '' WHERE email = '$email'";
					if ($this->dbobj->conn->query($sql)==true) {
						$out = "<div class='alert alert-success'>Password reset was successful! <a href='index.php'>Back to Login page</a></div>" ;
					}
					

				} else {

					$out="<div class='alert alert-warning'>Password does not match!</div>";
				}
			}

		} else {

			$out= "<div class='alert alert-danger'>Please, check your link!</div>";
		}

return $out;


}



public function forgetpass($email){



	$email = mysqli_real_escape_string($this->dbobj->conn, $_POST['email']);

		$sql = "SELECT userid FROM user WHERE email = '$email'";
		$result = $this->dbobj->conn->query($sql);

		if($result->num_rows > 0){

			$str = "0123456789AabBcCdDeEFfgGhiIjJkLmMnNoPQrSTuVwxYZ";
			$str = str_shuffle($str);
			$str = substr($str, 0, 15);

require 'PHPMailerAutoload.php';
				require 'access.php';

			$mail = new PHPMailer(true);


  $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
     //$mail->SMTPDebug = 2; 
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = EMAIL;                     // SMTP username
    $mail->Password   = PASS;                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('simpletech.notify@gmail.com', 'notification');
    $mail->addAddress($_POST['email']);     // Add a recipient
                  // Name is optional
    $mail->addReplyTo('info@simpletech.com.ng');
   
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Password Reset Notification';
  $mail->Body    = "Please click the link below to reset your password to your Simple banking Software...If you did not attempt to change your Password please quickly notify the Software admininstrator.  http://hallmarkbanking.com/resetPass.php?token=".$str.'&email='.$email;   


if (!$mail->send()) {
	
} else{
	// $outemail= 'Message has been sent: ';
		 }


// $to = $_POST['email'];
// $subject = "Password Reset Notification";

// $message ="Please click the link below to reset your password to your Simple banking Software...If you did not attempt to change your Password please quickly notify the Software admininstrator.<br><br> To reset your password please visit: https://metrobanking.ng/resetPass.php?token=".$str.'&email='.$email; 
// // Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From:info@simpletech.com.ng' . "\r\n";
// //$headers .= 'Cc: myboss@example.com' . "\r\n";

// mail($to,$subject,$message,$headers);







			$sql = "UPDATE user SET token = '$str' WHERE email = '$email'";
			$result = $this->dbobj->conn->query($sql);

			$out= "Please check your Registered mail inbox and follow the instructions to reset password";

		} else {

			$out= "Invalid input. Please check the email.";
		}


return @$outemail . ' ' . $out .' ' ."<a href='index.php'>Back to Login page</a>";

	}


public function deletedisplay($trid){
	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where Refno='$trid' and deleted='N' ";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}

//delete deposit or wdr transaction function

// public function deletetransaction($trid,$status,$narration){

// $check=$this->dbobj->conn->query("SELECT createdat from ledger where  DATE_FORMAT(createdat, '%Y-%m-%d')=DATE_FORMAT(CURDATE(), '%Y-%m-%d') and Refno='$trid' ");

// if ($check->num_rows > 0) {

// 	$sqll="UPDATE gl_ledger set deleted='$status' where refno='$trid'";

// 		$this->dbobj->conn->query($sqll);
	
// 	$sql="UPDATE ledger set deleted='$status',narration='$narration' where Refno='$trid'";

// if ($this->dbobj->conn->query($sql)==true) {
// 		$result="<div class='alert alert-info'>Transaction deleted successfully!</div>";
// 	} }
// 	else{
// 		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again! Note you can not delete Transactions with later date...</div>";
// 	}

// 	return $result;
// }



public function deletetransaction($trid,$status,$narration){

$check=$this->dbobj->conn->query("SELECT createdat from ledger where  DATE_FORMAT(createdat, '%Y-%m-%d')=DATE_FORMAT(CURDATE(), '%Y-%m-%d') and Refno='$trid' and status='cash_tr'");

if ($check->num_rows > 0) {

	@$statusupdate='deleted';

	$sqll="UPDATE gl_ledger set deleted='$status', status='$statusupdate' where refno='$trid'";

		$this->dbobj->conn->query($sqll);

		@$statusupdate='deleted';
	
	$sql="UPDATE ledger set deleted='$status',narration='$narration',status='$statusupdate' where Refno='$trid'";

if ($this->dbobj->conn->query($sql)==true) {
		$result="<div class='alert alert-info'>Transaction deleted successfully!</div>";
	} 
	else{
		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again! Note you can not delete Transactions with later date...</div>";
	}
}else{
	$result="<div class='alert alert-danger'>No record of this transaction found for delete.</div>";

}

	return $result;
}

//user teller function




public function usertellercode(){
	$sql="SELECT * from user where teller_code is not null";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		}
		return $row;
}



public function dltdreport($date,$datei,$userreport){
	//$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where DATE_FORMAT(createdat, '%Y-%m-%d') ='$date' and deleted='Y' order by id desc";

	

	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where DATE_FORMAT(createdat, '%Y-%m-%d')  BETWEEN '$date' AND '$datei' and deleted='Y'  and user='$userreport' order by id desc";

	



	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		# code...
	}

	return $row;

}


public function statususer(){
	$result=$this->dbobj->conn->query("SELECT * from user where access!='ADMIN'");

while ($row[] = $result->fetch_assoc()) {
	
}

return $row;

}


public function updateuser($status,$user){

	$sql="UPDATE user set active='$status' where username='$user' ";

	if ($this->dbobj->conn->query($sql)==true) {

		if ($_POST['status']=='Yes') {

			$result="<div class='alert alert-success'>User Activated successfully!</div>";
		}

		if ($_POST['status']=='No') {

			$result="<div class='alert alert-success'>User Deactivated successfully!</div>";
		}
		
	}

	else{ 
		$result="<div class='alert alert-danger'>Failed: Try again</div>";
}

	return $result;
}

///...........add teller to user function.......................

public function addteller($tellercode,$id){

	$sql="UPDATE user set teller_code='$tellercode' where userid='$id' ";

	if ($this->dbobj->conn->query($sql)==true) {

		$result="<div class='alert alert-success'>Transaction successful</div>";
		
	}

	else{ 
		$result="<div class='alert alert-danger'>Failed: Try again</div>";
}

	return $result;
}













//new functions for gl accounts 


public function accountclass(){
	$result=$this->dbobj->conn->query("SELECT * from account_class");

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}

public function creategl($classid,$glname){
	$sql="INSERT into gl_create set class_id='$classid',gl_name='$glname'";

	$this->dbobj->conn->query($sql);

	$id=$this->dbobj->conn->insert_id;

	$glcode=$classid.'0'.$id;

	$sql2="UPDATE gl_create set gl_code='$glcode' where id='$id'";

	if ($this->dbobj->conn->query($sql2)==true) {
		$result="<div class='alert alert-success'>GL Created successfully!</div>";
	}

	else{
		$result="<div class='alert alert-danger'>GL Creation Failed!</div>";
	}
	return $result;
 }



public function ledgergl(){
	$result=$this->dbobj->conn->query("SELECT * from gl_create order by gl_name desc");

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}



public function gl_ledgerinsert($credit,$debit,$narration1,$narration2,$id1,$id2,$user){

	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$id1'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$narration1',credit='$credit',user='$user', gl_code='$id1',gl_name='$formattedname'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	$refnoformated='GLP/00'.$refno;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);

	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$id2'");

	$select1=$sqlselect->fetch_assoc();

	$formatted2=$select1['class_id'];
	$formattedname2=$select1['gl_name'];

	$sql2="INSERT into gl_ledger set class_id='$formatted2',refno='$refnoformated',narration='$narration2',debit='$debit',user='$user',gl_code='$id2', gl_name='$formattedname2'";

		if ($this->dbobj->conn->query($sql2)==true) {
			$result="<div class='alert alert-success alert-dismissible fade show' role='alert'>GL Posting successful
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}
		else{
			$result="<div class='alert alert-danger alert-dismissible fade show' role='alert'>GL Posting Failed
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}
		return $result;
}

public function transactionview($glcode,$date1,$date2){
	$sql="SELECT * from gl_ledger where DATE_FORMAT(createdate, '%Y-%m-%d') BETWEEN '$date1' AND '$date2' and gl_code='$glcode' and deleted='N'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}

//bal brought forward ..............................

public function transactionviewbal2f($glcode,$date1){



	$sql1="SELECT SUM(debit) from gl_ledger where DATE_FORMAT(createdate, '%Y-%m-%d') < '$date1' and gl_code='$glcode' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			


		$sql1="SELECT SUM(credit) from gl_ledger where DATE_FORMAT(createdate, '%Y-%m-%d') < '$date1' and gl_code='$glcode' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}


		$totalsumwdr=$sumwdr-$sumdp;

	

	

	return $totalsumwdr;
}


public function deletedisplaygl($ref){
	$sql="SELECT * from gl_ledger where refno='$ref' and deleted='N' ";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	

	return $row;
}





public function gltransactiondelete($ref,$status){

$check=$this->dbobj->conn->query("SELECT  createdate from gl_ledger where  DATE_FORMAT(createdate, '%Y-%m-%d')=DATE_FORMAT(CURDATE(), '%Y-%m-%d') and refno='$ref' ");

// while ($row[]=$check->fetch_assoc()) {
// 		# code...
// 	}

if ($check->num_rows > 0) {
	
	$sql="UPDATE gl_ledger set deleted='$status' where refno='$ref'";

if ($this->dbobj->conn->query($sql)==true) {

	$sql1="UPDATE ledger set deleted='$status' where Refno='$ref'";

	$this->dbobj->conn->query($sql1);
		$result="<div class='alert alert-info'>Transaction deleted successfully!</div>";
	} }
	else{
		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again! Note you can not delete Transactions with later date... </div>";
	}

	return $result;
}





public function gltoacct_ledgerinsert($credit,$debit,$narration1,$narration2,$glcode1,$glcode2,$nuban1,$nuban2,$user){

	if (empty($nuban1)) {
	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$glcode1'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$narration1',credit='$credit',user='$user', gl_code='$glcode1',gl_name='$formattedname'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	$refnoformated='GL-Acct/'.$refno;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);



	//second leg of the transaction.....................

	$x=$this->dbobj->conn->query("SELECT * from ledger where NUBAN='$nuban2'");
	$y=$x->fetch_assoc();
	$yformatted=$y['account_no'];
	$sql="INSERT into ledger set account_no='$yformatted',Refno='$refnoformated',NUBAN='$nuban2',narration='$narration2',debit='$debit',user='$user'";

	     $this->dbobj->conn->query($sql);


		$sql1="SELECT SUM(debit) from ledger where account_no='$yformatted' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			


		$sql1="SELECT SUM(credit) from ledger where account_no='$yformatted' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}


		$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where account_no='$yformatted'";

		if ($this->dbobj->conn->query($sql2)==true) {
			$result="<div class='alert alert-success alert-dismissible fade show' role='alert'>GL Posting successful
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}else{
			$result="<div class='alert alert-danger alert-dismissible fade show' role='alert'>GL Posting Failed
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";

		}

		
	
	

	
}
else{



$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$glcode2'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$narration2',debit='$debit',user='$user', gl_code='$glcode2',gl_name='$formattedname'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	$refnoformated='GL-Acct/'.$refno;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);






//second leg of the transaction.....................


$x=$this->dbobj->conn->query("SELECT account_no from ledger where NUBAN='$nuban1'");

	$y=$x->fetch_assoc();
	$yformatted=$y['account_no'];

	$sql="INSERT into ledger set account_no='$yformatted',Refno='$refnoformated',NUBAN='$nuban1',narration='$narration1',credit='$credit',user='$user'";

	$this->dbobj->conn->query($sql);

		//$id=$this->dbobj->conn->insert_id;

		$sql1="SELECT SUM(credit) from ledger where account_no='$yformatted' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where account_no='$yformatted'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where account_no='$yformatted'";

		if ($this->dbobj->conn->query($sql2)==true) {
			$result="<div class='alert alert-success alert-dismissible fade show' role='alert'>GL Posting successful
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}else{

			$result="<div class='alert alert-danger alert-dismissible fade show' role='alert'>GL Posting Failed
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";

		}

		


}



return $result;



}









public function deactivate($deactivate){

	$sql1="UPDATE user set active='$deactivate' where access='TELLER'";
	$this->dbobj->conn->query($sql1);

	$sql2="UPDATE user set active='$deactivate' where access='CSO'";
	$this->dbobj->conn->query($sql2);

	$sql3="UPDATE user set active='$deactivate' where access='HOP'";

     if ($this->dbobj->conn->query($sql3)==true) {
     	echo "All Users Deactivated successfully";
     }
     else{
     	echo "Deactivation Failed";
     }


}




public function activate($activate){

	$sql1="UPDATE user set active='$activate' where access='TELLER'";
	$this->dbobj->conn->query($sql1);

	$sql2="UPDATE user set active='$activate' where access='CSO'";
	$this->dbobj->conn->query($sql2);

	$sql3="UPDATE user set active='$activate' where access='HOP'";

     if ($this->dbobj->conn->query($sql3)==true) {
     	echo "All Users Activated successfully";
     }
     else{
     	echo "Activation Failed";
     }


}



public function till($glcode){
	$sql="SELECT * from gl_ledger where gl_code='$glcode' and deleted='N'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[] = $result->fetch_assoc()) {
		
	}

	return $row;
}
//...............................................................
//birthday

public function birthday(){
	$sql="SELECT * from customer_details where DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
	
	}

	foreach ($row as $item) {
		if (!empty($item)) {
		
			$tel=$item['tel'];

			///sms sending .................................

			$user = "Hallmark%20Capital%20LTD";
				$pass = "hallmark2021";
				$mobile = $tel;
				$msg = 'We%20realize%20how%20important%20today%20is%20to%20you.%20Birthdays%20come%20once%20in%20a%20year,%20so%20we%20celebrate%20you%20today.%20Happy%20birthday,%20and%20have%20an%20amazing%20year.%20From%20all%20of%20us%20at%20Hallmark%20Capital.';

				$url = "https://sms.com.ng/sendsms.php?user=$user&password=$pass&mobile=$mobile&senderid=SMS.com.ng&message=$msg&dnd=1";

				// Initializes a new cURL session
				$curl = curl_init($url);

				// Execute cURL request with all previous settings
				$response = curl_exec($curl);

				// Close cURL session
				curl_close($curl);

// $owneremail="ikenna4capitalplan@gmail.com";
//                 $subacct="SUB2";
//                 $subacctpwd="better";
//                 $sendto=$tel; /* destination number */
//                 $sender="Hallmark"; /* sender id */
//                 $message='We realize how important today is to you. Birthdays come once in a year, so we celebrate you today. Happy birthday, and have an amazing year. From all of us at Hallmark Capital.'; /* message to be sent */
//                 /* create the required URL */
//                 $url = "http://www.smslive247.com/http/index.aspx?"
//                 . "cmd=sendquickmsg"
//                 . "&owneremail=" . UrlEncode($owneremail)
//                 . "&subacct=" . UrlEncode($subacct)
//                 . "&subacctpwd=" . UrlEncode($subacctpwd)
//                 . "&message=" . UrlEncode($message)
//                 . "&sender=" . UrlEncode($sender)
//                 .  "&sendto=" . UrlEncode($sendto);
//                 /* call the URL */
//                 if ($f = @fopen($url, "r"))
//                 {
//                 $answer = fgets($f, 255);
//                 if (substr($answer, 0, 1) == "+")
//                 {
//                // echo "SMS to $dnr was successful.";
//                 } 
 				       
 				       
//  				   }





		}
	}
}

//.........................................................

//investment booking function............................................................................

public function investmentbooking($acctid,$nubanfd,$accountnamefd,$balfd,$amtfd,$intfd,$durationfd,$totalintfd,$totaldue,$maturitydate,$wht,$user){

		$sql="INSERT into investment set acctid='$acctid',nuban='$nubanfd',acctname='$accountnamefd',acctbal='$balfd',fdamt='$amtfd',fdint='$intfd',duration='$durationfd',totalint='$totalintfd',wht='$wht', intdue='$totaldue',maturity='$maturitydate'";

		$this->dbobj->conn->query($sql);

		$refno=$this->dbobj->conn->insert_id;

		$refnoformated='FDB00/'.$refno;

		$sql2="UPDATE investment set ref='$refnoformated' where fdid='$refno'";

		if ($this->dbobj->conn->query($sql2)==True) {
		
		
			$result="<div class='alert alert-success alert-dismissible fade show' role='alert'>Investment Booking successful
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}else{

			$result="<div class='alert alert-danger alert-dismissible fade show' role='alert'>Investment Booking Failed
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
             <span aria-hidden='true'>close</span>
              </button>

			</div>";
		}

		return $result;
}


		//second leg of the transaction
///investment booked approval.......................................................................



	 public function investmentbookedapproval($ref,$nuban,$acctno,$acctname,$fdamt,$fdint,$totalint,$maturity,$duration,$acctbal,$user) {

		$narration="Investment Booking(FDB/".$duration.'days/'.$fdint.'%)';

		

		$sql1="INSERT into ledger set account_no='$acctno',Refno='$ref',NUBAN='$nuban',narration='$narration',debit='$fdamt',user='$user'";

		$this->dbobj->conn->query($sql1);

		$sql2="UPDATE customer_details set bal='$acctbal' where account_no='$acctno'";

		$this->dbobj->conn->query($sql2);

	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='200014'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$glcode=$select1['gl_code'];
	$glname=$select1['gl_name'];
	$narration2='FDB/'.$nuban;

	$sql3="INSERT into gl_ledger set class_id='$formatted',narration='$narration2',credit='$fdamt',user='$user', gl_code='$glcode',gl_name='$glname',refno='$ref'";
	$this->dbobj->conn->query($sql3);

	$sql4="UPDATE investment set remark='Approved' where Ref='$ref'";

		if ($this->dbobj->conn->query($sql4)==True){

			$result="<div class='alert alert-info'>Investment Approval successful.</div>";
		}else{

			$result="<div class='alert alert-danger'>Investment Approval Failed.</div>";
		}

		return $result;
}




//investment approval fumnction.............................................................................

public function selectinvestmentbooked(){
	$sql="SELECT * from investment where remark='active'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
	
	}

return $row;
}




public function displayinvestment($ref){
	$sql="SELECT * from investment where ref='$ref'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}




//matured Investment function............................................................................

public function investmentmatured(){
	$sql="SELECT * from investment where DATE_FORMAT(maturity, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') and remark='Approved'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
	
	}
        foreach ($row as $item) {
        	if (!empty($item)) {
        		
        	
           	
$acctid=$item['fdid'];

$narration="Investment capital Matured(".$item['ref'].')';

$refnoformated=$item['ref'];
$nubanfd=$item['nuban'];


$capital=$item['fdamt'];

$int=$item['totalint'];

$narration2= "Interest on Investment Matured(".$item['ref'].')';

$narration3= "WHT(".$item['ref'].')';

$narration5="FDB(".$item['ref'].')';

$wht=$item['wht'];

            


$sql2="INSERT into ledger set account_no='$acctid',Refno='$refnoformated',NUBAN='$nubanfd',narration='$narration',credit='$capital',user='Auto_Tr'";

	$this->dbobj->conn->query($sql2);

	$sql3="INSERT into ledger set account_no='$acctid',Refno='$refnoformated',NUBAN='$nubanfd',narration='$narration2',credit='$int',user='Auto_Tr'";

	$this->dbobj->conn->query($sql3);

	$sql4="INSERT into ledger set account_no='$acctid',Refno='$refnoformated',NUBAN='$nubanfd',narration='$narration3',debit='$wht',user='Auto_Tr'";

	$this->dbobj->conn->query($sql4);

	$sql5="UPDATE investment set remark='matured', paidback='$capital' where ref='$refnoformated'";

	$this->dbobj->conn->query($sql5);

$sqlselectc=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='200014'");

	$select1c=$sqlselectc->fetch_assoc();

	$formattedc=$select1c['class_id'];
	$glcodec=$select1c['gl_code'];
	$glnamec=$select1c['gl_name'];
	

	$sql3="INSERT into gl_ledger set class_id='$formattedc',narration='$narration5',debit='$capital',user='Auto_Tr', gl_code='$glcodec',gl_name='$glnamec',refno='$refnoformated'";
	$this->dbobj->conn->query($sql3);




$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_name='WHT'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$glcode=$select1['gl_code'];
	$glname=$select1['gl_name'];
	
	$sql6="INSERT into gl_ledger set class_id='$formatted',narration='$narration3',credit='$wht',user='Auto_Tr', gl_code='$glcode',gl_name='$glname',refno='$refnoformated'";

	$this->dbobj->conn->query($sql6);

	//new code version2

$sqlselectfd=$this->dbobj->conn->query("SELECT * from gl_create where gl_name='interest-paid-on-investment'");

	$select2=$sqlselectfd->fetch_assoc();

	$formattedfd=$select2['class_id'];
	$glcodefd=$select2['gl_code'];
	$glnamefd=$select2['gl_name'];
	$narration4="int paid on investment(".$item['ref'].')';
	
	$sql7="INSERT into gl_ledger set class_id='$formattedfd',narration='$narration4',debit='$int',user='Auto_Tr', gl_code='$glcodefd',gl_name='$glnamefd',refno='$refnoformated'";

	$this->dbobj->conn->query($sql7);


}
}
}



//investment reversal notify.........................................................
public function investmentreversal($ref){
	$sql="SELECT * from investment where ref='$ref' and remark='Approved' ";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}


//investment reversal function.......................................................

public function reverseinvestmentbooking($ref,$refrev,$acctid,$nubanrev,$creditrev,$user,$acctnamerev,$accttype){

	$sql="SELECT * from investment where ref='$ref' and remark='Approved' ";
	$out=$this->dbobj->conn->query($sql);
	if ($out->num_rows > 0) {
		
	$statusL='FDB_Reversed';
	

	$sql1="UPDATE investment set remark='$statusL' where ref='$refrev'";

	$this->dbobj->conn->query($sql1);

	$narration2='Transaction reversal('.$nubanrev.')';

	$sql2="INSERT into ledger set account_no='$acctid',Refno='$refrev',NUBAN='$nubanrev',narration='$narration2',credit='$creditrev',user='$user',status='$statusL'";

	$this->dbobj->conn->query($sql2);

	$updateleg="UPDATE ledger set status='$statusL' where Refno='$ref'";
	$this->dbobj->conn->query($updateleg);



$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='200014'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$glcode=$select1['gl_code'];
	$glname=$select1['gl_name'];
	$narrationfd='FDB/'.$nubanrev;

	$sql3="INSERT into gl_ledger set class_id='$formatted',narration='$narrationfd',debit='$creditrev',user='$user', gl_code='$glcode',gl_name='$glname',refno='$ref'";
	$this->dbobj->conn->query($sql3);


	$sql3="INSERT into reversal set ref='$refrev', acctno='$acctid' ,nuban='$nubanrev',acctname='$acctnamerev',credit='$creditrev',accttype='$accttype',status='$statusL'";
		$this->dbobj->conn->query($sql3);

		//update bal for reversa..
		$sql4="SELECT SUM(credit) from ledger where NUBAN='$nubanrev' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql4);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql5="SELECT SUM(debit) from ledger where NUBAN='$nubanrev'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql5);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql6="UPDATE customer_details set bal='$totalsum' where NUBAN='$nubanrev'";

		if ($this->dbobj->conn->query($sql6)==true) {
			$result="<div class='alert alert-info'>Transaction reversed successfully.</div>";
		}else{
			$result="<div class='alert alert-danger'>Transaction reversed Failed.</div>";
		}
}else{

$result="<div class='alert alert-danger'>No record of this transaction found for reversal.</div>";

}

		return $result;


}


//transfer sender and receiver display details function.........................................................

public function sender($nuban){


$sql1="SELECT SUM(credit) from ledger where NUBAN='$nuban' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where NUBAN='$nuban'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where NUBAN='$nuban'";

		$this->dbobj->conn->query($sql2);

	$sql = "SELECT * from customer_details where NUBAN='$nuban'";

	$result=$this->dbobj->conn->query($sql);

	
 $row = $result->fetch_assoc();
	
 

return $row;
		} 


		public function receiver($nuban){


$sql1="SELECT SUM(credit) from ledger where NUBAN='$nuban' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where NUBAN='$nuban'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where NUBAN='$nuban'";

		$this->dbobj->conn->query($sql2);

	$sql = "SELECT * from customer_details where NUBAN='$nuban'";

	$result=$this->dbobj->conn->query($sql);

	
 $row = $result->fetch_assoc();
	
 

return $row;
		}        
       

//Intra transfer function................................................................

public function transfer($sendernuban,$senderamount,$receivernuban,$user,$senderacctid,$receiveracctid,$sendername,$receivername,$sendertype,$receivertype){

		$sql1="SELECT * from customer_details where NUBAN='$sendernuban'";

		$out1=$this->dbobj->conn->query($sql1);

		$row1=$out1->fetch_assoc();

		$xbal=$row1['bal'];

		if ($xbal > $senderamount ) {
			
		$sql9="INSERT into transfer set type='sender',acctno='$senderacctid',nuban='$sendernuban',acctname='$sendername',accttype='$sendertype',sentamt='$senderamount',status='successful'";

		$this->dbobj->conn->query($sql9);

		$x=$this->dbobj->conn->insert_id;

		$ref="TFR00/".$x;

		$sql8="UPDATE transfer set ref='$ref' where id='$x'";
		$this->dbobj->conn->query($sql8);

		$sql10="INSERT into transfer set type='receiver',ref='$ref',acctno='$receiveracctid',nuban='$receivernuban',acctname='$receivername',accttype='$receivertype',receivedamt='$senderamount',status='successful'";

		if ($this->dbobj->conn->query($sql10)==true) {
			$result="<div class='alert alert-success'>Transfer  successful</div>";

		}else{
			$result="<div class='alert alert-danger'>Transfer  Failed</div>";
		}
	}else{
		$result="<div class='alert alert-warning'>Insufficient Balance in senders account</div> ";
	}

return $result;
}



//transfer approval function....................................................................


public function transferapprovalview(){
	$sql="SELECT * from transfer where status='successful' and type='sender'";

	$result=$this->dbobj->conn->query($sql);


	while ($row[]=$result->fetch_assoc()) {
		
	}

	return $row;
}





public function transferapprovalchecksender($ref){
	$sql="SELECT * from transfer where ref='$ref' and type='sender' and status='successful'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();
		
	

	return $row;
}

public function transferapprovalcheckreceiver($ref){
	$sql="SELECT * from transfer where ref='$ref' and type='receiver' and status='successful'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();
		
	

	return $row;
}



//tranfer approval function................................



public function trfapproval($ref,$sendernuban,$senderacctid,$senderamount,$receivernuban,$receiveracctid,$user,$status,$sendername,$receivername){

	// $sql1="INSERT into ledger set account_no='$senderacctid',NUBAN='$sendernuban',debit='$senderamount',user='$user'";

	// $out=$this->dbobj->conn->query($sql1);

	
	$narration1='Transfer to '.$receivername.'('.$ref.')';

	$narration2='Transfer from '.$sendername.'('.$ref.')';

	// $sql2="UPDATE ledger set Refno='$ref',narration='$narration1' where id='$x'";
	// $this->dbobj->conn->query($sql2);

	$sql1="INSERT into ledger set account_no='$senderacctid',NUBAN='$sendernuban',debit='$senderamount',Refno='$ref',narration='$narration1',user='$user'";

	$out=$this->dbobj->conn->query($sql1);

	$sql3="INSERT into ledger set account_no='$receiveracctid',Refno='$ref',NUBAN='$receivernuban',narration='$narration2',credit='$senderamount',user='$user'";

	$this->dbobj->conn->query($sql3);

	//update bal for sender...........

	$sql4="SELECT SUM(credit) from ledger where NUBAN='$sendernuban' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql4);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where NUBAN='$sendernuban'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql5="UPDATE customer_details set bal='$totalsum' where NUBAN='$sendernuban'";

		$this->dbobj->conn->query($sql5);

		//update bal for receiver...........


		$sql6="SELECT SUM(credit) from ledger where NUBAN='$receivernuban' and deleted='N'";

		$balr=$this->dbobj->conn->query($sql6);

		foreach ($balr as $rowr) {
			$sumdpr=$rowr['SUM(credit)'];


		}
			$sql7="SELECT SUM(debit) from ledger where NUBAN='$receivernuban'  and deleted='N'";

		$balr=$this->dbobj->conn->query($sql7);

		foreach ($balr as $rowr) {
			$sumwdrr = $rowr['SUM(debit)'];

		}
			
			$totalsumr=$sumdpr-$sumwdrr;

		$sql8="UPDATE customer_details set bal='$totalsumr' where NUBAN='$receivernuban'";

		$this->dbobj->conn->query($sql8);

		$sql15="UPDATE transfer set status='$status' where ref='$ref'";


		if ($this->dbobj->conn->query($sql15)==True) {
			$result="<div class='alert alert-success'>Transfer Approval successful</div>";

		}else{
			$result="<div class='alert alert-success'>Transfer Approval Failed</div>";
		}

		return $result;
}


//transfer reversal function ............................................


public function transferreversal($ref,$sendernuban,$senderacctid,$senderamount,$receivernuban,$receiveracctid,$user){

	$sql="SELECT * from transfer where ref='$ref' and status='successful'";

	$out=$this->dbobj->conn->query($sql);



	if ($out->num_rows >= 1) {
		
	
	$refedit=$ref.'(RVD)';
	
	$narration='Transfer Reversed('.$ref.')';

	$sql1="INSERT into ledger set account_no='$senderacctid',NUBAN='$sendernuban',credit='$senderamount',Refno='$refedit',narration='$narration',user='$user',status='Reversed'";

	$out=$this->dbobj->conn->query($sql1);

	$sql3="INSERT into ledger set account_no='$receiveracctid',Refno='$refedit',NUBAN='$receivernuban',narration='$narration',debit='$senderamount',user='$user', status='Reversed'";

	$this->dbobj->conn->query($sql3);

	//update bal for sender...........

	$sql4="SELECT SUM(credit) from ledger where NUBAN='$sendernuban' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql4);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where NUBAN='$sendernuban'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql5="UPDATE customer_details set bal='$totalsum' where NUBAN='$sendernuban'";

		$this->dbobj->conn->query($sql5);

		//update bal for receiver...........


		$sql6="SELECT SUM(credit) from ledger where NUBAN='$receivernuban' and deleted='N'";

		$balr=$this->dbobj->conn->query($sql6);

		foreach ($balr as $rowr) {
			$sumdpr=$rowr['SUM(credit)'];


		}
			$sql7="SELECT SUM(debit) from ledger where NUBAN='$receivernuban'  and deleted='N'";

		$balr=$this->dbobj->conn->query($sql7);

		foreach ($balr as $rowr) {
			$sumwdrr = $rowr['SUM(debit)'];

		}
			
			$totalsumr=$sumdpr-$sumwdrr;

		$sql8="UPDATE customer_details set bal='$totalsumr' where NUBAN='$receivernuban'";

		$this->dbobj->conn->query($sql8);

		$sql15="UPDATE transfer set status='Reversed' where ref='$ref'";


		if ($this->dbobj->conn->query($sql15)==True) {
			$result="<div class='alert alert-success'>Reversal successful</div>";

		}else{
			$result="<div class='alert alert-success'>Reversal Failed</div>";
		}

	}else{
		$result="<div class='alert alert-warning'>No record found or Transaction already Reversed</div>";
	}

		return $result;
}











//loan type function........................................................

public function loantype($user,$loantype){
	$out=$this->dbobj->conn->query("SELECT * from loantype where loantype='loantype'");
	$xyz=$out->num_rows;
	if ($xyz > 0) {
		

	$sql="INSERT into loantype set user='$user',loantype='$loantype'";

	if ($this->dbobj->conn->query($sql)==true) {
		
		$result="<div class='alert alert-success'>Loan type successfully added</div>";
	}
	else{
		$result="<div class='alert alert-danger'>Loan type Failed</div>";
	} }else{
		$result="<div class='alert alert-warning'>Loan type already exit</div>";
	}

	return $result;

}


//loan type select function................................................

public function selectloantype(){
	$sql="SELECT * from loantype";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		
	}

	return $row;
}


//loan booking function...........................................................

public function loanbooking($acctnoloan, $acctnubanloan, $acctnameloan, $loantype, $loanrequest, $period, $totalint, $applydate, $firstdate, $loanrate, $totalrepay, $loanpurpose, $loancollateral,$mInterest,$mPrincipal,$user){



	$no=$period*30;


// Declare a date 
$date = date_create($applydate); 
  
// Use date_add() function to add date object 
date_add($date, date_interval_create_from_date_string($no.'days')); 
  
// Display the added date 
$loanexpdate=date_format($date, "Y-m-d");
		
	

$sql="INSERT into loan_booking set acctno='$acctnoloan',nuban='$acctnubanloan',acctname='$acctnameloan',loantype='$loantype',totalprincipal='$loanrequest',totalmonth='$period',totalinterest='$totalint',applicationdate='$applydate',firstdeductiondate='$firstdate',loanexpdate='$loanexpdate',loanrate='$loanrate',totalrepayment='$totalrepay',loanpurpose='$loanpurpose',collateral='$loancollateral',m_i_d='$mInterest',m_p_d='$mPrincipal',nextdeductiondate='$firstdate',deductionmain='$firstdate'";


if ($this->dbobj->conn->query($sql)==true) {

	@$id=$this->dbobj->conn->insert_id;

	$ref="LBR00/".$id;
	$narration='Loan Booking [/'.$loanrate.'%/ '.$period.'month(s)]';

	$sql2="UPDATE loan_booking set status='successful',ref='$ref' where id='$id'";

	$this->dbobj->conn->query($sql2);

	// $sqlz="SELECT * from customer_details where account_no='$acctnoloan'";

	// $outz=$this->dbobj->conn->query($sqlz);

	// $rowz=$outz->fetch_assoc();

	//$bal=$rowz['bal'];
	// $loanbal=$rowz['loanbal'];

	// $loanb=$loanbal+$totalrepay;

	// $sql4="UPDATE customer_details set loanbal='$loanb' where account_no='$acctnoloan'";
	// $this->dbobj->conn->query($sql4);

 //  $sqlledger="INSERT into ledger set account_no='$acctnoloan',Refno='$ref',NUBAN='$acctnubanloan',narration='$narration',credit='$loanrequest',user='$user'";

	// $this->dbobj->conn->query($sqlledger);



	$result="<div class='alert alert-success'>Loan record saved successfully with Ref No: $ref</div>";
}else{

	$sql3="UPDATE loan_booking set status='Failed' where id='$id'";

	$this->dbobj->conn->query($sql3);

		$result="<div class='alert alert-danger'>Loan Failed</div>";
}

return $result;

}
///Loan approval....................................................function


public function loanapprove($refaploan,$acctno,$nubanap,$totalrepayap,$loanamtap,$rateap,$pap,$status,$user){
	$narration='Loan Booking [/'.$rateap.'%/ '.$pap.'month(s)]';

	

	$sql="INSERT ledger set account_no='$acctno',Refno='$refaploan',NUBAN='$nubanap',narration='$narration',credit='$loanamtap',user='$user'";
	$this->dbobj->conn->query($sql);

	$sqlz="SELECT * from customer_details where account_no='$acctno'";

	$outz=$this->dbobj->conn->query($sqlz);

	$rowz=$outz->fetch_assoc();

	$bal=$rowz['bal'];
	$loanbal=$rowz['loanbal'];

	$loanb=$loanbal+$totalrepayap;

	$sql4="UPDATE customer_details set loanbal='$loanb' where account_no='$acctno'";

	$this->dbobj->conn->query($sql4);

	$sql5="UPDATE loan_booking set status='$status' where acctno='$acctno'";
	$this->dbobj->conn->query($sql5);

	$glcode='100012';
	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$glcode'");

	$select1=$sqlselect->fetch_assoc();

	$formattedglid=$select1['class_id'];
	$formattedglname=$select1['gl_name'];

	$sqlx="INSERT into gl_ledger set class_id='$formattedglid',Refno='$refaploan',narration='$narration',debit='$loanamtap',user='$user', gl_code='$glcode',gl_name='$formattedglname'";

	if ($this->dbobj->conn->query($sqlx)==true) {
		
		$result="<div class='alert alert-info'>Approved successful with Ref: $refaploan</div>";
	}else{
		$result="<div class='alert alert-danger'>Loan Failed</div>";
	}

return $result;

}







//loan deduction function

//remember to pass the glcode where u r calling the function loandeduction

public function loandeduction($glcode,$glcodep){

	$sql="SELECT * from loan_booking where DATE_FORMAT(nextdeductiondate, '%Y-%m-%d') < DATE_FORMAT(CURDATE(), '%Y-%m-%d') and status!='LBR_Reversed' and status!='successful' and status!='Paid-Up'";

	$out=$this->dbobj->conn->query($sql);

	while ($row[]=$out->fetch_assoc()) {
		
	}

	foreach ($row as $item) {
		if (!empty($item)) {
			
		
		$loanref=$item['ref'];

		$totalprincipal=$item['totalprincipal'];

		$principalpaid=$item['principalpaid'];


		$totalint=$item['totalinterest'];
		$intpaid=$item['interestpaid'];

		$acctno=$item['acctno'];

		$nuban=$item['nuban'];

		$mPd=$item['m_p_d'];

		$mId=$item['m_i_d'];

		$firstdeductiondate=$item['firstdeductiondate'];

		$nextdeductiondate=$item['nextdeductiondate'];

		$totalmonth=$item['totalmonth'];
		$deductedmonth=$item['deductedmonth'];
		$remainingmonths=$item['remainingmonths'];

		$deductionmain=$item['deductionmain'];
		$loanid=$item['id'];


$sql2="SELECT * from customer_details where account_no='$acctno'";

$out2=$this->dbobj->conn->query($sql2);

$row2=$out2->fetch_assoc();

$bal=$row2['bal'];
$loanbal=$row2['loanbal'];






if ($bal >= $item['m_i_d'] && $item['totalinterest']!=$item['interestpaid']) {

	$narrationint='Loan interest deduction';

	//loan interest is deducted from the customers acct ones the above conditions are met

 $sqlledger="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narrationint',debit='$mId',user='Auto_Tr',loanref='$loanref'";

$this->dbobj->conn->query($sqlledger);

//update ledger refno 

@$id=$this->dbobj->conn->insert_id;
	$ref="LD00/".$id;

	$sql4="UPDATE ledger set Refno='$ref' where id='$id'";

	$this->dbobj->conn->query($sql4);

//update loan bal on customer details table
	 

	 //   $zz=@$loanbal-$mId;
		// $sqlzz="UPDATE customer_details set loanbal='$zz' where account_no='$acctno'";
		// $this->dbobj->conn->query($sqlzz);

	


//remember to pass the glcode for loan interest where u r calling the function loandeduction
//I inserted the deducted interest into the loan interest GL

$narrationx='Loan interest deduction'.$id;

	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$glcode'");

	$select1=$sqlselect->fetch_assoc();

	$formattedglid=$select1['class_id'];
	$formattedglname=$select1['gl_name'];

	$sqlx="INSERT into gl_ledger set class_id='$formattedglid',Refno='$ref',narration='$narrationx',credit='$mId',user='Auto_Tr', gl_code='$glcode',gl_name='$formattedglname'";

	$this->dbobj->conn->query($sqlx);

	///here i will update the loan_booking table with the interest paid

	$iP=$intpaid+$mId;

	$iRm=$totalint-$mId;

	$sqlloanbooking="UPDATE loan_booking set interestpaid='$iP',interestremaining='$iRm'where id='$loanid'";

	$this->dbobj->conn->query($sqlloanbooking);

}else{


}


//create condition for principal deduction

if ($bal >= $item['m_p_d'] && $item['totalprincipal']!=$item['principalpaid']) {


	$narrationp='Loan principal deduction';

	//loan principal is deducted from the customers acct ones the above conditions are met

 $sqlledgerp="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narrationp',debit='$mPd',user='Auto_Tr',loanref='$loanref'";
$this->dbobj->conn->query($sqlledgerp);

//update the refno of ledger

@$idp=$this->dbobj->conn->insert_id;
	$refp="LD00/".$idp;

	$sql4p="UPDATE ledger set Refno='$refp' where id='$idp'";

	$this->dbobj->conn->query($sql4p);

//update loan balance on the customer details table
		$v=$mPd+$mId;
		$xx=@$loanbal-$v;
		$sqlyx="UPDATE customer_details set loanbal='$xx' where account_no='$acctno'";
		$this->dbobj->conn->query($sqlyx);

	
	

	


//remember to pass the glcodep for loan principal deduction where u r calling the function loandeduction
//I inserted the deducted interest into the loan interest GL

$narrationy='Loan principal deduction'.$idp;

	$sqlselectp=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$glcodep'");

	$select1p=$sqlselectp->fetch_assoc();

	$formattedglidp=$select1p['class_id'];
	$formattedglnamep=$select1p['gl_name'];

	$sqly="INSERT into gl_ledger set class_id='$formattedglidp',Refno='$refp',narration='$narrationy',credit='$mPd',user='Auto_Tr', gl_code='$glcodep',gl_name='$formattedglnamep'";

	$this->dbobj->conn->query($sqly);

	//update the loan_booking table with deducted months and remaining months

	    
		
	

		$dmonth=$deductedmonth+1;

	

	///here i will update the loan_booking table with the principal paid

	$pP=$principalpaid+$mPd;

	$pRm=$totalprincipal-$mPd;

	$sqlloanbookingp="UPDATE loan_booking set principalpaid='$pP',principalremaining='$pRm',deductedmonth='$dmonth' where id='$loanid'";

	$this->dbobj->conn->query($sqlloanbookingp);

  //       $xx=@$loanbal-$mPd;
		// $sqlyx="UPDATE customer_details set loanbal='$xx' where account_no='$acctno'";
		// $this->dbobj->conn->query($sqlyx);



$m = date_create($deductionmain); 
  
// Use date_add() function to add date object 
date_add($m, date_interval_create_from_date_string('30 days')); 
  
// Display the added date 
	$mx=date_format($m, "Y-m-d");

$sqlm="UPDATE loan_booking set deductionmain='$mx' where id='$loanid'";

	$this->dbobj->conn->query($sqlm);



	$nextdeductiondatemain="UPDATE loan_booking set nextdeductiondate='$mx' where id='$loanid'";

	$this->dbobj->conn->query($nextdeductiondatemain);



}else{

	// Declare a date 
$dated = date_create(@$nextdeductiondate); 
  
// Use date_add() function to add date object 
date_add($dated, date_interval_create_from_date_string('1 days')); 
  
// Display the added date 
	@$nextdeduction=date_format($dated, "Y-m-d");

	$nextdeductiondatep="UPDATE loan_booking set nextdeductiondate='$nextdeduction' where id='$loanid'";

	$this->dbobj->conn->query($nextdeductiondatep);
}

}
	
}
}







public function statusupdate(){

	$sql1="SELECT * from loan_booking";

	$out=$this->dbobj->conn->query($sql1);

	while ($row[]=$out->fetch_assoc()) {
		
	}

	foreach ($row as $item) {
		if (!empty($item)) {

$loanid=$item['id'];
if ($item['totalmonth']==$item['deductedmonth'])
 {
	$sqlstatus="UPDATE loan_booking set status='Expired' where id='$loanid'";

	$this->dbobj->conn->query($sqlstatus);
 }
	
if ($item['totalprincipal']==$item['principalpaid'] && $item['totalinterest']==$item['interestpaid']) {

	$sqlstatus2="UPDATE loan_booking set status='Paid-Up' where id='$loanid'";

	$this->dbobj->conn->query($sqlstatus2);
	
}

}
}
}


//   

//Loan reversal notify
public function loanreversaldisplay($ref){
	$sql="SELECT * from loan_booking where ref='$ref' and status='Approved' and interestpaid='' ";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}

//loan reversal function

public function loanreversal($ref,$refrevloan,$acctidloan,$nubanrevloan,$creditrevloan,$user,$acctnamerevloan,$accttype,$totalrepay){

	$sqltest="SELECT * from loan_booking where ref='$ref' and status='Approved' ";
	$outtest=$this->dbobj->conn->query($sqltest);
	if ($outtest->num_rows > 0) {
		$statusL='LBR_Reversed';

	$sql="UPDATE loan_booking set status='$statusL' where ref='$ref'";

	$this->dbobj->conn->query($sql);

$narration2="Loan Booking Reversed ".$ref;

 	//$statusL='LBR_Reversed';


	$sql2="INSERT into ledger set account_no='$acctidloan',Refno='$refrevloan',NUBAN='$nubanrevloan',narration='$narration2',debit='$creditrevloan',user='$user',status='$statusL'";

	$this->dbobj->conn->query($sql2);

	$updateleg="UPDATE ledger set status='$statusL' where Refno='$ref'";
	$this->dbobj->conn->query($updateleg);

	$sql3="INSERT into reversal set ref='$refrevloan', acctno='$acctidloan' ,nuban='$nubanrevloan',acctname='$acctnamerevloan',credit='$creditrevloan',accttype='$accttype',status='$statusL'";
		$this->dbobj->conn->query($sql3);

		$sqlloanbal="SELECT * from customer_details where NUBAN='$nubanrevloan'";

		$takeloanbal=$this->dbobj->conn->query($sqlloanbal);
		$loan=$takeloanbal->fetch_assoc();

		$loanbal=$loan['loanbal'];

		$loancal=$loanbal-$totalrepay;





		//update bal for reversa..
		$sql4="SELECT SUM(credit) from ledger where NUBAN='$nubanrevloan' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql4);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql5="SELECT SUM(debit) from ledger where NUBAN='$nubanrevloan'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql5);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql6="UPDATE customer_details set bal='$totalsum',loanbal='$loancal' where NUBAN='$nubanrevloan'";

		if ($this->dbobj->conn->query($sql6)==true) {
			$result="<div class='alert alert-info'>Transaction reversed successfully.</div>";
		}else{
			$result="<div class='alert alert-danger'>transaction reversed Failed.</div>";
		}
}else{

$result="<div class='alert alert-danger'>No record of this transaction found for reversal.</div>";

}
return $result;

 
}





public function loanreport($status,$datef,$datet){
	$sql="SELECT * from loan_booking where status='$status' and DATE_FORMAT(applicationdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";
		$result=$this->dbobj->conn->query($sql);

	

		while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}
 

//testing.....................................

public function assettest(){
	$sql="SELECT * from gl_ledger where class_id='100'";
	$result=$this->dbobj->conn->query($sql);
	while ($row[]=$result->fetch_assoc()) {
			
		}

foreach ($row as $item) {
	$code=$item['gl_code'];

	return $code;


}
		

		

		$lent= count($row['gl_code']);

		for ($i=0; $i < $lent ; $i++) { 
			
			//return [$i]['gl_name'];

		}
		
		// foreach ($row as $item) {
			 
		// 	$code=$item['gl_code'];

		// 	return $code;


		// 	$sql2="SELECT * from gl_ledger where gl_code='$code'";
		// 	$result2=$this->dbobj->conn->query($sql2);

		// 	while ($row2[]=$result2->fetch_assoc()) {
				
		// 		foreach ($row2 as $item2) {
					
		// 			//return +$row['debit'];
		// 		}
		// 	}
		// }
}









//testing..................

public function asset($datef,$datet){

	$sql="SELECT * from gl_ledger where class_id='100' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}

public function liability($datef,$datet){

	$sql="SELECT * from gl_ledger where class_id='200' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}

public function income($datef,$datet){

	$sql="SELECT * from gl_ledger where class_id='400' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}


public function expense($datef,$datet){

	$sql="SELECT * from gl_ledger where class_id='500' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}







//testing this method


public function assettesting($name,$datef,$datet){

	$sql="SELECT * from gl_ledger where gl_name='$name' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}



public function trialdeposit($datef,$datet){
	$sql="SELECT * from ledger where  substring(Refno ,1, 3)='DEP' or substring(Refno ,1, 3)='WDR' and DATE_FORMAT(createdat, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}



public function trialloan($datef,$datet){
	$sql="SELECT * from loan_booking where DATE_FORMAT(applicationdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet' and status='successful'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}


public function trialinvestment($datef,$datet){
	$sql="SELECT * from investment where DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet' and remark='active'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	return $row;
}


public function loandeductionreminder(){
	$sql="SELECT * from loan_booking where status='successful'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		# code...
	}

	foreach ($row as $item) {

		if (!empty($item)) {
		
	$nextdeductiondate=$item['nextdeductiondate'];

	$nuban=$item['nuban'];

	$diff=strtotime($nextdeductiondate)-strtotime(date('Y-m-d'));
	$days = floor($diff / (60*60*24));

	if ($days==5) {

	$sql2="SELECT * from customer_details where NUBAN='$nuban'";

	$out1=$this->dbobj->conn->query($sql2);

	$outdisplay=$out1->fetch_assoc();

	$tel=$outdisplay['tel'];

///sms sending .................................

				// $user = "Hallmark%20Capital%20LTD";
				// $pass = "hallmark2021";
				// $mobile = $tel;
				// $msg = "Dear%20customer%20your%20loan%20repayment%20will%20be%20due%20shortly.%20Please%20kindly%20fund%20your%20account.";

				// $url = "https://sms.com.ng/sendsms.php?user=$user&password=$pass&mobile=$mobile&senderid=SMS.com.ng&message=$msg&dnd=1";

				// // Initializes a new cURL session
				// $curl = curl_init($url);

				// // Execute cURL request with all previous settings
				// $response = curl_exec($curl);

				// // Close cURL session
				// curl_close($curl);

 $owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message="Dear customer your loan repayment will be due shortly Please kindly fund your account."; /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r"))
                {
                $answer = fgets($f, 255);
                if (substr($answer, 0, 1) == "+")
                {
               // echo "SMS to $dnr was successful.";
                } 
 				       
 				       
 				   }

}

	}
	}
}

 

public function investmentreport($status,$datef,$datet){
	$sql="SELECT * from investment where remark='$status' and DATE_FORMAT(createdate, '%Y-%m-%d')  BETWEEN '$datef' AND '$datet'";
		$result=$this->dbobj->conn->query($sql);

	

		while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}





public function investmenttermination($nuban){
	$sql="SELECT * from investment where nuban='$nuban' and remark='active'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();
		
	

	return $row;
}

public function investmentterminationintcal($nuban){
	$sql="SELECT * from investment where nuban='$nuban' and remark='active'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();
		
	

	return $row;
}

//termination function

public function terminationfunction($fdid,$ref,$terminationnuban,$terminationname,$terminationamt,$duration,$rate,$expectedint,$inttilldate,$charges,$mday,$user,$wht){
	$sql="INSERT into investment_termination set acctid='$fdid',ref='$ref',nuban='$terminationnuban',acctname='$terminationname',amt='$terminationamt',duration='$duration',rate='$rate',exp_int='$expectedint',int_till_date='$inttilldate',penalty='$charges',maturity='$mday', user='$user'";


	if ($this->dbobj->conn->query($sql)==true) {
		$terminated='Terminated';

		$sql2i="UPDATE investment set remark='$terminated',paidback='$terminationamt' where ref='$ref'";

		$this->dbobj->conn->query($sql2i);

		

		//second leg

$narration="Terminated Investment(".$ref.")";

$narration2="Int on terminated investment(".$ref.")";

$narration3="WHT on Invt";

$narration3i='penalty on termination';



$sql2="INSERT into ledger set account_no='$fdid',Refno='$ref',NUBAN='$terminationnuban',narration='$narration',credit='$terminationamt',user='Auto_Tr'";

	$this->dbobj->conn->query($sql2);

	$sql3="INSERT into ledger set account_no='$fdid',Refno='$ref',NUBAN='$terminationnuban',narration='$narration2',credit='$inttilldate',user='Auto_Tr'";

	$this->dbobj->conn->query($sql3);

	$sql4="INSERT into ledger set account_no='$fdid',Refno='$ref',NUBAN='$terminationnuban',narration='$narration3',debit='$wht',user='Auto_Tr'";

	$this->dbobj->conn->query($sql4);

	$sql4i="INSERT into ledger set account_no='$fdid',Refno='$ref',NUBAN='$terminationnuban',narration='$narration3i',debit='$charges',user='Auto_Tr'";

	$this->dbobj->conn->query($sql4i);


	





$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_name='WHT'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$glcode=$select1['gl_code'];
	$glname=$select1['gl_name'];
	
	$sql6="INSERT into gl_ledger set class_id='$formatted',narration='$narration3',credit='$wht',user='Auto_Tr', gl_code='$glcode',gl_name='$glname',refno='$ref'";

	$this->dbobj->conn->query($sql6);

	//new code version1

$sqlselecti=$this->dbobj->conn->query("SELECT * from gl_create where gl_name='Penalty-on-termination'");

	$select1i=$sqlselecti->fetch_assoc();

	$formattedi=$select1i['class_id'];
	$glcodei=$select1i['gl_code'];
	$glnamei=$select1i['gl_name'];
	
	$sql6i="INSERT into gl_ledger set class_id='$formattedi',narration='$narration3i',credit='$charges',user='Auto_Tr', gl_code='$glcodei',gl_name='$glnamei',refno='$ref'";

	$this->dbobj->conn->query($sql6i);




	//new code version2

$sqlselectfd=$this->dbobj->conn->query("SELECT * from gl_create where gl_name='interest-paid-on-investment'");

	$select2=$sqlselectfd->fetch_assoc();

	$formattedfd=$select2['class_id'];
	$glcodefd=$select2['gl_code'];
	$glnamefd=$select2['gl_name'];
	$narration4="int paid on investment(".$ref.')';
	
	$sql7="INSERT into gl_ledger set class_id='$formattedfd',narration='$narration4',debit='$inttilldate',user='Auto_Tr', gl_code='$glcodefd',gl_name='$glnamefd',refno='$ref'";

	$this->dbobj->conn->query($sql7);



$result="Transaction successful";


	}

	else{

		$result="Failed";
	}
return $result;
}







//reversal display function


public function reversaldisplay($trid){
	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where Refno='$trid' and deleted='N' and ledger.status='cash_tr'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}





//deposit reversal

public function depositreversal($narration,$credit,$trid,$acctno,$acctname,$type,$user,$nuban){

$check=$this->dbobj->conn->query("SELECT status from ledger where status='cash_tr' and Refno='$trid'");

if ($check->num_rows > 0 && substr($trid,0,3 )=='DEP') {
	@$status='Reversed';

	@$statusL='Reversed_cash_tr';

	@$statusD='DEP_Reversed';

	$sqlrev="INSERT into reversal set acctno='$acctno',nuban='$nuban',acctname='$acctname',credit='$credit',accttype='$type',status='$statusD'";
	$this->dbobj->conn->query($sqlrev);

	$id=$this->dbobj->conn->insert_id;

	$refnoformated='RDT/00'.$id;

	$sqlrevupdate="UPDATE reversal set ref='$refnoformated' where id='$id'";

	$this->dbobj->conn->query($sqlrevupdate);


	$sqlledger="INSERT into ledger set Refno='$refnoformated', account_no='$acctno',NUBAN='$nuban',narration='$narration',debit='$credit',user='$user',status='$status'";

	$this->dbobj->conn->query($sqlledger);
	
	$updateleg="UPDATE ledger set status='$statusL' where Refno='$trid'";
	$this->dbobj->conn->query($updateleg);


	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_ledger where refno='$trid'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$tellercode=$select1['gl_code'];
	

	 $sqlgl="INSERT into gl_ledger set class_id='$formatted',narration='$narration',credit='$credit',user='$user', gl_code='$tellercode',gl_name='$formattedname',status='$status'";

if ($this->dbobj->conn->query($sqlgl)==true) {
		$result="<div class='alert alert-info'>Transaction Reversed successfully!</div>";
	} 
	else{
		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again.</div>";
	}
}else{

$result="<div class='alert alert-danger'>No record of this transaction found for reversal.</div>";
}
	return $result;
}



//withdrawal reversal

public function wdr_reversal($narration,$debit,$trid,$acctno,$acctname,$type,$user,$nuban){

$check=$this->dbobj->conn->query("SELECT status from ledger where status='cash_tr' and Refno='$trid'");

if ($check->num_rows > 0 && substr($trid,0,3 )=='WDR') {
	@$status='Reversed';

	@$statusL='Reversed_cash_tr';

	@$statusD='WDR_Reversed';

	$sqlrev="INSERT into reversal set acctno='$acctno',nuban='$nuban',acctname='$acctname',debit='$debit',accttype='$type',status='$statusD'";
	$this->dbobj->conn->query($sqlrev);

	$id=$this->dbobj->conn->insert_id;

	$refnoformated='RDT/00'.$id;

	$sqlrevupdate="UPDATE reversal set ref='$refnoformated' where id='$id'";

	$this->dbobj->conn->query($sqlrevupdate);


	$sqlledger="INSERT into ledger set Refno='$refnoformated', account_no='$acctno',NUBAN='$nuban',narration='$narration',credit='$debit',user='$user',status='$status'";

	$this->dbobj->conn->query($sqlledger);
	
	$updateleg="UPDATE ledger set status='$statusL' where Refno='$trid'";
	$this->dbobj->conn->query($updateleg);


	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_ledger where refno='$trid'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$tellercode=$select1['gl_code'];
	

	 $sqlgl="INSERT into gl_ledger set class_id='$formatted',narration='$narration',debit='$debit',user='$user', gl_code='$tellercode',gl_name='$formattedname',status='$status',refno='$refnoformated'";

if ($this->dbobj->conn->query($sqlgl)==true) {
		$result="<div class='alert alert-info'>Transaction Reversed successfully!</div>";
	} 
	else{
		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again.</div>";
	}
}else{

$result="<div class='alert alert-danger'>No record of this transaction found for reversal.</div>";
}
	return $result;
}



////new code to be added..................................................................................

//loan_deductoin_rev_display

public function loandeductionreversaldisplay($trid){
	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where Refno='$trid' and deleted='N'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}

///loan_deduction_reversal function................
public function loan_deduction_rev($narration,$debit,$trid,$acctno,$acctname,$type,$user,$nuban,$loanbal,$loanref){

$check=$this->dbobj->conn->query("SELECT loanref from ledger where loanref!='' and Refno='$trid'");

if ($check->num_rows > 0) {
	@$status='Reversed';

	@$statusL='Reversed_loan_ded';

	

	$sqlrev="INSERT into reversal set acctno='$acctno',nuban='$nuban',acctname='$acctname',debit='$debit',accttype='$type',status='$statusL'";
	$this->dbobj->conn->query($sqlrev);

	$id=$this->dbobj->conn->insert_id;

	$refnoformated='RDT/00'.$id;

	$sqlrevupdate="UPDATE reversal set ref='$refnoformated' where id='$id'";

	$this->dbobj->conn->query($sqlrevupdate);


	$sqlledger="INSERT into ledger set Refno='$refnoformated', account_no='$acctno',NUBAN='$nuban',narration='$narration',credit='$debit',user='$user',status='$status',loanref='$loanref'";

	$this->dbobj->conn->query($sqlledger);
	
	// $updateleg="UPDATE ledger set status='$statusL' where Refno='$trid'";
	// $this->dbobj->conn->query($updateleg);

	$Lbal=$loanbal*1+$debit;

	 $updateleg="UPDATE customer_details set loanbal='$Lbal' where account_no='$acctno'";
	$this->dbobj->conn->query($updateleg);



	$sqlselect=$this->dbobj->conn->query("SELECT * from gl_ledger where refno='$trid'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$code=$select1['gl_code'];
	

	 $sqlgl="INSERT into gl_ledger set class_id='$formatted',narration='$narration',debit='$debit',user='$user', gl_code='$code',gl_name='$formattedname',status='$status'";

if ($this->dbobj->conn->query($sqlgl)==true) {
		$result="<div class='alert alert-info'>Transaction Reversed successfully!</div>";
	} 
	else{
		$result="<div class='alert alert-danger'>Transaction Failed: Please check the Ref No and Try again.</div>";
	}
}else{

$result="<div class='alert alert-danger'>No record of this transaction found for reversal.</div>";
}
	return $result;
}


//special deduction function


public function special_deductionm($glcodesp){

	$sql="SELECT * from gl_create where gl_code='$glcodesp' and class_id='400'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;


}


public function specialdeductions($nuban,$name,$accttype,$rmbal,$sendamt,$glcode,$glname,$glamt,$usersp){

$sql="SELECT * from customer_details where NUBAN='$nuban'";

$result=$this->dbobj->conn->query($sql);

$row=$result->fetch_assoc();

$acctno=$row['account_no'];

if ($row['bal']>=$sendamt) {
	
	$sql1="INSERT into ledger set account_no='$acctno', NUBAN='$nuban',debit='$sendamt',user='$usersp'";

	$this->dbobj->conn->query($sql1);

	$id=$this->dbobj->conn->insert_id;

	$ref='SP-DED/'.$id;
	$narration1='Special Deduction';

	$sql2="UPDATE ledger set narration='$narration1',Refno='$ref' where id='$id'";

	$this->dbobj->conn->query($sql2);

	$sql3="SELECT * from gl_create where gl_code='$glcode'";

	$result3=$this->dbobj->conn->query($sql3);

	$row3=$result3->fetch_assoc();

	$classid=$row3['class_id'];

	$narration2='Special Deduction'.$nuban;

	$sql4="INSERT into gl_ledger set refno='$ref',class_id='$classid',gl_code='$glcode',gl_name='$glname',narration='$narration2', credit='$sendamt'";

	if ($this->dbobj->conn->query($sql4)==True) {
		$out="<div class='alert alert-success text-center'> Transaction successful</div>";
	}

	else{
		$out="<div class='alert alert-danger text-center'>Transaction Failed</div>";
	}


}

return $out;


}

//bank deposit function

public function bankclassselect(){

	$sql="SELECT * from gl_create where class_id='100'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
			
		}

		return $row;
}


public function depositbybank($acctno,$nuban,$narration,$credit,$user,$bankcode,$tel){
	 if (!isset($_SESSION['tellercode'])) {
		$result="<div class='alert alert-warning text-center'>You dont have a teller Access to Post...Please contact the Software admininstrator </div>";

		
	}else{

$sqltest=$this->dbobj->conn->query("SELECT * from customer_details where NUBAN='$nuban'");
	if ($sqltest->num_rows > 0) {
	    $status='cash_tr';


	$sql="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narration',credit='$credit',user='$user',status='$status'";

		$this->dbobj->conn->query($sql);

		$id=$this->dbobj->conn->insert_id;

	      $refnoformated='DEPBank/00'.$id;

		$update=$this->dbobj->conn->query("UPDATE ledger set Refno='$refnoformated' where id='$id'");

		$sql1="SELECT SUM(credit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}
			$sql1="SELECT SUM(debit) from ledger where account_no='$acctno'  and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			
			$totalsum=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsum' where account_no='$acctno'";

		$this->dbobj->conn->query($sql2);

///..............................second leg of transaction....................



$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$bankcode'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$formattednarration=$narration.'/'.$nuban;

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$formattednarration',debit='$credit',user='$user', gl_code='$bankcode',gl_name='$formattedname',status='$status'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);


		$result="<div class='alert alert-success text-center'>Cash Transaction successful</div>";
	
	}
else{
	$result="<div class='alert alert-danger text-center'>Failed! Incorrect Account Number</div>";
} 

///sms sending .................................


$sqltry="SELECT bal from customer_details where account_no='$acctno'";

$resulttry=$this->dbobj->conn->query($sqltry);

$rowtry=$resulttry->fetch_assoc();

$baltry=$rowtry['bal'];

				// $user = "Hallmark%20Capital%20LTD";
				// $pass = "hallmark2021";
				// $mobile = $tel;
				// $msg = 'Txn:%20Credit%20Acct%20Number:'.$nuban.'%20Amt:NGN%20'.$credit.'%20Desc:'.$narration.'%20Date:%20'.date("Y-m-d H:i:s").'%20Bal:NGN%20'.number_format($baltry,2);

				// $url = "https://sms.com.ng/sendsms.php?user=$user&password=$pass&mobile=$mobile&senderid=SMS.com.ng&message=$msg&dnd=1";

				// // Initializes a new cURL session
				// $curl = curl_init($url);

				// // Execute cURL request with all previous settings
				// $response = curl_exec($curl);

				// // Close cURL session
				// curl_close($curl);


 $owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message='Txn: Credit Acct Number:'.$nuban .' Amt:NGN '. $credit.' '. ' Desc:'. $narration.' Date: '.date("Y-m-d H:i:s").' Bal:NGN '.number_format($baltry,2); /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r"))
                {
                $answer = fgets($f, 255);
                if (substr($answer, 0, 1) == "+")
                {
               // echo "SMS to $dnr was successful.";
                } } 


}


return $result;
}



public function bankwdr($acctno,$nuban,$narration,$debit,$user,$bankcode,$tel){
    if (!isset($_SESSION['tellercode'])) {
    	$result="<div class='alert alert-warning text-center'>You dont have a teller Access to Post...Please contact the Software admininstrator </div>";
    	
    }else{

	$sqltest=$this->dbobj->conn->query("SELECT * from customer_details where NUBAN='$nuban'");
	$outwdr=$sqltest->fetch_assoc();
	$xbal=$outwdr['bal'];
	if ($xbal >= $debit) {
		
	if ($sqltest->num_rows > 0) {
		$status='cash_tr';
	
	$sql="INSERT into ledger set account_no='$acctno',NUBAN='$nuban',narration='$narration',debit='$debit',user='$user', status='$status'";

		$this->dbobj->conn->query($sql);

			


		$id=$this->dbobj->conn->insert_id;
		 $refnoformated='WDRBank/00'.$id;

		$update=$this->dbobj->conn->query("UPDATE ledger set Refno='$refnoformated' where id='$id'");

		$sql1="SELECT SUM(debit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			


		$sql1="SELECT SUM(credit) from ledger where account_no='$acctno' and deleted='N'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}


		$totalsumwdr=$sumdp-$sumwdr;

		$sql2="UPDATE customer_details set bal='$totalsumwdr' where account_no='$acctno'";

		$this->dbobj->conn->query($sql2);

		///........................second leg of the transaction....................



		$sqlselect=$this->dbobj->conn->query("SELECT * from gl_create where gl_code='$bankcode'");

	$select1=$sqlselect->fetch_assoc();

	$formatted=$select1['class_id'];
	$formattedname=$select1['gl_name'];
	$formattednarration=$narration.'/'.$nuban;

	$sql1="INSERT into gl_ledger set class_id='$formatted',narration='$formattednarration',credit='$debit',user='$user', gl_code='$bankcode',gl_name='$formattedname',status='$status'";

	$this->dbobj->conn->query($sql1);

	$refno=$this->dbobj->conn->insert_id;

	//$refnoformated='GL-Acct/'.$refno;

	$sqlupdate="UPDATE gl_ledger set refno='$refnoformated' where id='$refno'";
	$this->dbobj->conn->query($sqlupdate);

		$result="<div class='alert alert-success text-center'>Withdrawal Transaction successful</div>";
	} 
else{
	$result="<div class='alert alert-danger text-center'>Failed! Incorrect Account Number</div>";
} 


//sms sending .................................

				

 $owneremail="ikenna4capitalplan@gmail.com";
                $subacct="SUB2";
                $subacctpwd="better";
                $sendto=$tel; /* destination number */
                $sender="Hallmark"; /* sender id */
                $message='Txn: Debit Acct Number: '.$nuban .' Amt:NGN '. $debit.' '. ' Desc:'. $narration.' Date: '.date("Y-m-d H:i:s").' Bal:NGN '.number_format($totalsumwdr,2); /* message to be sent */
                /* create the required URL */
                $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendquickmsg"
                . "&owneremail=" . UrlEncode($owneremail)
                . "&subacct=" . UrlEncode($subacct)
                . "&subacctpwd=" . UrlEncode($subacctpwd)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                .  "&sendto=" . UrlEncode($sendto);
                /* call the URL */
                if ($f = @fopen($url, "r"))
                {
                $answer = fgets($f, 255);
                if (substr($answer, 0, 1) == "+")
                {
               // echo "SMS to $dnr was successful.";
                } }
 				       
            	}else{
            	$result="<div class='alert alert-warning text-center'>Insufficient Account Balance</div>";
            }      
 			   }


return $result;
}


//transaction view function

public function trview($ref){
	$sql="SELECT * from gl_ledger where refno='$ref'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}
//......................

public function trview1($ref){
	$sql="SELECT * from ledger RIGHT join customer_details on customer_details.account_no=ledger.account_no  where Refno='$ref'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();

	return $row;
}





//loan approval funtion

public function loansapprovalselect(){
	$sql="SELECT * from loan_booking where status='successful'";

	$result=$this->dbobj->conn->query($sql);
	while ($row[]=$result->fetch_assoc()) {
		
	}

	return $row;

}


public function loanapprovaldisplaymodul($ref){
	$sql="SELECT * from loan_booking where status='successful' and ref='$ref'";

	$result=$this->dbobj->conn->query($sql);

	$row=$result->fetch_assoc();
		
	

	return $row;

}



// bvn verify unit check................................



public function bvnverifycheck(){
$sql1="SELECT SUM(debit) from bvn_verify where status='verified'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumwdr = $row['SUM(debit)'];

		}
			


		$sql1="SELECT SUM(credit) from bvn_verify where status='verified'";

		$bal=$this->dbobj->conn->query($sql1);

		foreach ($bal as $row) {
			$sumdp=$row['SUM(credit)'];


		}


	return	$totalsumwdr=$sumdp-$sumwdr;

}


public function insertbvn($bvn,$user){

	$sql="INSERT into bvn_verify set bvn='$bvn',user='$user',status='verified',debit='1'";

	$this->dbobj->conn->query($sql);
}

// add unit........................

public function addunit($unit){

	$sql="INSERT into bvn_verify set bvn='0000000000',user='ADMIN',status='verified',credit='$unit'";

	if ($this->dbobj->conn->query($sql)==True) {
		$result="<div class='alert alert-success text-center'>Unit Added successfully</div>";
	}

	else{
	$result="<div class='alert alert-danger text-center'>Failed</div>";	
	}

	return $result;
}

//customer listing by account officer

public function customerlistingofficer($accountofficer){
	$sql="SELECT * from customer_details where accountofficer='$accountofficer'";

	$result=$this->dbobj->conn->query($sql);

	while ($row[]=$result->fetch_assoc()) {
		
	}

	return $row;
}





	}
?>


	
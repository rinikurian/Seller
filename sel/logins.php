<?php
if(isset($_POST["submit"]))
{
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $privatekey = "6LfTwkAUAAAAABv0qaagKeb3f_WpISGvWkTXRsGN";
    $response = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $data = json_decode($response);

    if (isset($data->success) AND $data->success == true) {
        
        
    
	$username=$_POST["username"];   //username value from the form
	$pwd=$_POST["password"];	//password value from the form
	//echo $username;
        $password = encryptIt($pwd);
	$sql="select * from login where username='$username' and password ='$password' and status=1"; //value querried from the table
	$res=mysqli_query($con,$sql);  //query executing function
if($res)
{
	
	if($fetch=mysqli_fetch_array($res))
	{
		if($fetch['role_id']==1)   
		{
//			$_SESSION["name"]=$fetch['name'];
			$_SESSION["userid"]=$fetch['userid'];
			$_SESSION["username"]=$username;	// setting username as session variable 
	header("location:admin_home.php");	//home page or the dashboard page to be redirected
	}
	elseif($fetch['role_id']==2)   
		{
		$_SESSION["username"]=$username;	// setting username as session variable 
		$_SESSION["userid"]=$fetch['userid'];
	header("location:sellerhome.php");
	}
        elseif($fetch['role_id']==3)   
		{
		$_SESSION["username"]=$username;	// setting username as session variable 
		$_SESSION["userid"]=$fetch['userid'];
	header("location:buyerhome.php");
	}
	}
        else
{
echo "<script>alert('invalid credentials!')</script>";
}
}

    }	
    else{
        echo '<script> alert("Unauthorized access!!!");</script>';
    }
}
?>
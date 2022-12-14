<?php
	function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
    }




	$username=filter_input(INPUT_POST,'username');
	$password=filter_input(INPUT_POST,'password');
	$p2=filter_input(INPUT_POST,'cpassword');
    $fname=$_POST["fname"];
    $email=$_POST["email"];
    $pno=$_POST["phonenumber"];
    $gender=$_POST["gender"];
	if(!empty($username))
	{
		if(!empty($_POST["password"]))  {
        $password = test_input($_POST["password"]);
        $cpassword = test_input($_POST["cpassword"]);
		if($_POST["password"] != $_POST["cpassword"])
		{
			echo "<script>alert('Re enter password correctly');</script>";
			echo "<script type='text/javascript'>window.top.location='signup.html';</script>";
		}
        if (strlen($_POST["password"]) <= '8') {
            echo "<script>alert('Your Password Must Contain At Least 8 Characters!');</script>";
			echo "<script type='text/javascript'>window.top.location='signup.html';</script>";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            echo "<script>alert('Your Password Must Contain At Least 1 Number!');</script>";
			echo "<script type='text/javascript'>window.top.location='signup.html';</script>";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            echo "<script>alert('Your Password Must Contain At Least 1 Capital Letter!');</script>";
			echo "<script type='text/javascript'>window.top.location='signup.html';</script>";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            echo "<script>alert('Your Password Must Contain At Least 1 Lowercase Letter!');</script>";
			echo "<script type='text/javascript'>window.top.location='signup.html';</script>";
        }
		else{	
			include('connection.php'); 
			if(mysqli_connect_error())
			{
				die('Connect error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
			}
			else
			{
				$check_username = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");	
				if(mysqli_num_rows($check_username) > 0){
					echo "<script>alert('Username already exists');</script>";		
					echo "<script type='text/javascript'>window.top.location='signup.html';</script>"; exit;
				}
				else{
					
					$result = mysqli_query($con, "INSERT INTO users VALUES ('$username','$password','$fname','$email','$pno','$gender')");
					echo "<script>alert('Signup Successfull');</script>";
					echo "<script type='text/javascript'>window.top.location='index.html';</script>";
				}
				$con->close();
			}
				}						
		}
		else{
			echo "<script>alert('Password should not be empty');</script>";	
			die();
		}
	}
	else
	{
		echo "Username should not be empty!!!";
		die();
	}
?>
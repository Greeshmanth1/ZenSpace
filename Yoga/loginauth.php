<?php
	include('connection.php');  
	session_start();
	$_SESSION['name'] = $_POST['username'];
	$globalusername=$_POST["username"];
	if(!empty($_POST['submit']))
	{
		$uname=$_POST["username"];
		$pswd=$_POST["password"];
		$query="select * from users where  username='$uname' and password='$pswd'";
		$result=mysqli_query($con,$query);
		$count=mysqli_num_rows($result);
		if($count>0)
		{
			header("Location: Welcome.html");
		}
		else{
			echo "<script>alert('Login failed!! Invalid User');</script>";
			echo "<script type='text/javascript'>window.top.location='login.html';</script>";
		}
	}
	$con->close();
?>
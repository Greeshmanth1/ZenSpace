<?php
	include('connection.php');  
  // echo "<script>alert('Check');</script>";
	if(!empty($_POST['submit']))
	{
    // echo "<script>alert('Check');</script>";
		// $uname=$_POST["username"];
		// $email=$_POST["email"];
    session_start();
	  $uname=$_SESSION['name'];
		// $query="select * from users where  username='$uname' ";
		// $result=mysqli_query($con,$query);
		// $count=mysqli_num_rows($result);

		// if($count>0)
		// {
		// 	echo "<script>alert('Already Registered');</script>";
		// 	echo "<script type='text/javascript'>window.top.location='Welcome.html';</script>";
		// }


    $query="select * from details where username='$uname'";
    $result=mysqli_query($con,$query);
		$count=mysqli_num_rows($result);
		if($count<=0)
		{
      // echo "<script>alert('Check');</script>";
      $timings=$_POST["timings"];
      $dob=$_POST["birthday"];
      $fee=500;
      $startdate=$_POST["startdate"];
      $result = mysqli_query($con, "INSERT INTO details VALUES ('$uname','$timings','$dob','$fee','$startdate')");
      echo "<script>alert('Inserted Successfully');</script>";		
		}
    else{
      echo "<script>alert('User is already registered');</script>";		
    }
    echo "<script type='text/javascript'>window.top.location='Welcome.html';</script>"; exit;

    // $result = $con->query($query);
    // if($result== true){ 
    // if ($result->num_rows > 0) {
    //   $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
      
    //   $msg= $row;
    // } 
	}
  $con->close();
?>

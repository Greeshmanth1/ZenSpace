<?php
	include("connection.php");
	
	if(!empty($_POST['submit']))
	{
		// echo "<script>alert('Login failed!! Invalid User');</script>";
		$uname=$_POST["username"];
		$pswd=$_POST["password"];
		$query="select * from admin where  username='$uname' and password='$pswd'";
		$result=mysqli_query($con,$query);
		$count=mysqli_num_rows($result);
		if($count<=0)
		{
		
			echo "<script>alert('Login failed!! Invalid User');</script>";
			echo "<script type='text/javascript'>window.top.location='adminlogin.html';</script>";
		}
	}
	$db= $con;
	
	$tableName1="users";
	$columns1= ['username', 'password','fullname','email','phone', 'gender'];
	// $fetchData1 = fetch_data($db, $tableName1, $columns1);
	
	$tableName2="details";
	$columns2= ['username', 'timings','dob','fee','startdate'];
	$fetchData = fetch_data($db, $tableName1, $columns1, $tableName2, $columns2);
	
	
	function fetch_data($db, $tableName1, $columns1, $tableName2, $columns2){
		if(empty($db)){
			$msg= "Database connection error";
		}elseif (empty($columns1) || empty($columns2)) {
			$msg="Empty Coloumns";
		}
		else
		{
			
			$query="SELECT * from users left join details on users.username=details.username";
			$result = $db->query($query);
			if($result== true){ 
			if ($result->num_rows > 0) {
				$row= mysqli_fetch_all($result, MYSQLI_ASSOC);
				
				$msg= $row;
			} 
			else {
				$msg= "No Data Found"; 
			}
			}else
			{
				$msg= mysqli_error($db);
			}
		}
		return $msg;
	}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <!-- <style>
	.table-fixed tbody {
    height: 300px;
    overflow-y: auto;
	overflow-x: auto;
    width: 100%;
	}

	.table-fixed thead,
	.table-fixed tbody,
	.table-fixed tr,
	.table-fixed td,
	.table-fixed th {
		display:block;
		
	}

	.table-fixed tbody td,
	.table-fixed tbody th,
	.table-fixed thead > tr > th {
		float: left;
		position: relative;

		&::after {
			content: '';
			clear: both;
			display: block;
		}
	}
  </style> -->
</head>
<body>
<div class="back" id="back">
      <button onclick="back()" >Back</button>
    </div>
    <script>
      function back(){
        location.replace("Main.html")
      }
    </script>
<div class="container">
    <div class="title">All User Details</div>
    <div class="content">
      
      <form action="server.php" method="get">
	  <div class="table-responsive" >
        <table class="table table-fixeds">
       <thead><tr><th>S.N</th>
         <th>Fullname</th>
         <th>Email</th>
         <th>Mobile Number</th>
         <th>Gender</th>
         <th>Timings</th>
         <th>DOB</th>
		 <th>Monthly Fee</th>
		 <th>Start Date</th>
		 <th>Remaining Days</th>
    </thead>
    <tbody>
<?php 
function dateDiff($date1, $date2)
{
	$date1_ts = strtotime($date1);
	$date2_ts = strtotime($date2);
	$diff = $date2_ts - $date1_ts;
	return round($diff / 86400);
}?>
  <?php
      if(is_array($fetchData)){      
		// echo "<script>alert('valid format');</script>";
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>
      <td><?php echo $data['fullname']??''; ?></td>
      <td><?php echo $data['email']??''; ?></td>
      <td><?php echo $data['phone']??''; ?></td>
      <td><?php echo $data['gender']??''; ?></td>
	  <td><?php echo $data['timings']??''; ?></td>  
      <td><?php echo $data['dob']??''; ?></td>
      <td><?php echo $data['fee']??''; ?></td>  
	  <td><?php echo $data['startdate']??''; ?></td> 
	  <td><?php 
	  $dates = new DateTime($data['startdate']); // Your date of birth
	  $todays = new DateTime();
	  $date1=$dates->format('Y-m-d');
	  $date2=$todays->format('Y-m-d');
	  
		$dateDiff = dateDiff($date1, $date2);
		// echo $dateDiff;
		if($dateDiff<0){
			echo "30 Days";

		}
		else{
			$temp=30-$dateDiff;
			if($temp<0){
				echo "0 days";
			}
			else{
			echo $temp." days";
			}
		}	 
	 ?></td>   
     </tr>
     <?php
      $sn++;}}else{ 
		echo "<script>alert('Login failed!! Invalid User');</script>";
		?>

      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
      </form>
    </div>
  </div>
    <?php echo $deleteMsg??''; ?>
</div>
</div>
</div> 
</body>
</html>
<?php 
$con->close(); ?>
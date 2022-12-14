<?php
	include("connection.php");

    session_start();
	$username=$_SESSION['name'];
    // session_destroy();
    $query="select * from details where  username='$username'";
    $result=mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    if($count<=0)
    {
        echo "<script type='text/javascript'>window.top.location='empty.html';</script>";
    }
    $result = $con->query($query);
    $msg= mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php 
function dateDiff($date1, $date2)
{
	$date1_ts = strtotime($date1);
	$date2_ts = strtotime($date2);
	$diff = $date2_ts - $date1_ts;
	return round($diff / 86400);
}?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="back" id="back">
      <button onclick="back()" >Back</button>
    </div>
    <script>
      function back(){
        location.replace("Welcome.html")
      }
    </script>
  <div class="container" >
    <div class="title">User Details</div>
    <div class="content"   >
        <div style="display:inline";>
      <form action="#">
        <?php foreach($msg as $data){?>
                <br>
            <div class="input-box">
                <span class="details">User Name</span>
                <?php echo $data['username']??''; ?>
            </div>
            <br>
            <div class="input-box">
                <span class="details">Timings</span>
                <?php echo $data['timings']??''; ?>
            </div>
            <br>
            <div class="input-box">
                <span class="details">DOB</span>
                <?php echo $data['dob']??''; ?>
            </div>
            <br>
            <div class="input-box">
                <span class="details">Monthly Fee</span>
                <?php echo $data['fee']??''; ?>
            </div>
            <br>
            <div class="input-box">
                <span class="details">Start Date</span>
                <?php echo $data['startdate']??''; ?>
            </div>
            <br>
            <div class="input-box">
                <span class="details">Remaining Days</span>
                <?php 
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
	  	 
	 ?>
    </div>





        <?php }
        $con->close();
        ?>
      </form>
    </div>
    </div>
  </div>
 
</body>
</html>
 


    <?php  
	
    session_start();
    $host = 'localhost';  
    $user = 'root';  
    $pass = '';  
    $db = 'careercliniqdb';
	
 
 
    $_SESSION["name"]= $_POST['name'];
	$_SESSION["email"] = $_POST['email'];
    $_SESSION["address"] = $_POST['address'];
    $_SESSION["city"] = $_POST['city'];
	$_SESSION["state"] = $_POST['state'];
    $_SESSION["zip"] = $_POST['zip'];
    $_SESSION["mobile"] = $_POST['mobile'];
    $_SESSION["dob"] = $_POST['dob'];
    $_SESSION["qualification"] = $_POST['qualification'];
    $_SESSION["skills"] = $_POST['skills'];
    $_SESSION["sf"] = $_POST['sf'];
    $_SESSION["reason"] = $_POST['reason'];




	$name=$_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $qualification = $_POST['qualification'];
    $skills = $_POST['skills'];
    $sf = $_POST['sf'];
    $reason = $_POST['reason'];
	
	
	
   $con = mysqli_connect($host, $user, $pass,  $db);  
    if(! $con )  
    {  
      die('Could not connect: ' . mysqli_error());  
    }  
	
	$sql1 = "select * from registration_details where name='$name' and email='$email'";
	
	$rs1 = mysqli_query($con, $sql1);
	
		if(mysqli_num_rows($rs1)>0)
		{
			
			include 'failure.html';
		}
		else
		{
			$randnum=rand(1000000,9999999);
			 $_SESSION["rcode"]=$randnum;
			 
			 $to_email = "$email";
			 
			$body='<html><body><p>Hello ' . $name . '!</p>';
$body.='<p>Kindly enter this verification code on the input box to proceed with completion of registration</p>';
$body.='<h3>This is your verification code:</h3>';
$body.='<h1 style="color:green">' . $randnum . '</h1>';
$body.='</html></body>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
if (mail($to_email, "Email Verification", $body,$headers))
{
	include 'input.html';
}			
else
{
	include 'failure.html';
}									
			
			
			
			
			
			/*
				$sql2 = "INSERT INTO registration_details (name,email,address,city,state,zip,mobile,qualification,skills,sf,reason,dob) values ('$name','$email','$address','$city','$state','$zip','$mobile','$qualification','$skills','$sf','$reason','$dob')";
				$rs2 = mysqli_query($con, $sql2);

				if($rs2)
				{
					$sql3 = "SELECT name,email,mobile from registration_details where name='$name' and email='$email' and mobile='$mobile'";
					$rs3 = mysqli_query($con, $sql1);

					if($rs3)
					{
								$sql4="SELECT name,email,mobile,sf,experience from consultant_details where sf='$sf'";
								$rs4 = mysqli_query($con, $sql4);
								if($rs4)
								{
									while ($row = mysqli_fetch_row($rs4))
										{
											
											
											$body="Hello $name!
Congratulations! You have taken a great step towards enhancing your career. Your registration is successful. You can now contact our excellent consultant from your specialised field. If you do require a different consultant kindly contact us back on the same mail.

Thank You & Regards,
Career Cliniq Team.
											
Here is the details of your consultant:

Name: $row[0]
Email: $row[1]
Mobile: $row[2]
Specialised field: $row[3]
Experience: $row[4]
											";
										
										}
										mysqli_free_result($rs4);
									
									
										$to_email = "$email";
										$subject = "Thanks for Registration - Consultant Details";
										

										
								}
								else
								{
										
								}
								if (mail($to_email, $subject, $body))
								{
									include 'success.html';	
								}
										
								else
								{
									
										include 'failure.html';	
								}	
								
					}
					
					
				}
				else
				{
					include 'failure.html';	
				}*/
		}
		
		   
		 
   mysqli_close($con);
	
	
	
	
	
	
	?> 
	
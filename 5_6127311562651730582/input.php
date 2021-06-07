

    <?php  
	
  session_start();
    $host = 'localhost';  
    $user = 'root';  
    $pass = '';  
    $db = 'careercliniqdb';
	
	$code = $_POST['code'];
   
	
	
	
   $con = mysqli_connect($host, $user, $pass,  $db);  
    if(! $con )  
    {  
      die('Could not connect: ' . mysqli_error());  
    }  
	
   
	$sql1 = "select * from registration_details where name='" . $_SESSION['name'] . "' and email='" . $_SESSION['email'] . "'";
	
	$rs1 = mysqli_query($con, $sql1);
	
		if(mysqli_num_rows($rs1)>0)
		{
			
			include 'failure.html';
		}
		else
		{
			if($_SESSION['rcode']==$code ){
				$sql2 = "INSERT INTO registration_details (name,email,address,city,state,zip,mobile,qualification,skills,sf,reason,dob) values ('" . $_SESSION['name'] . "','" . $_SESSION['email'] . "','" . $_SESSION['address'] . "','" . $_SESSION['city'] . "','" . $_SESSION['state'] . "','" . $_SESSION['zip'] . "','" . $_SESSION['mobile'] . "','" . $_SESSION['qualification'] . "','" . $_SESSION['skills'] . "','" . $_SESSION['sf'] . "','" . $_SESSION['reason'] . "','" . $_SESSION['dob'] . "')";
				$rs2 = mysqli_query($con, $sql2);

				if($rs2)
				{
					$sql3 = "SELECT name,email,mobile from registration_details where name='" . $_SESSION['name'] . "' and email='" . $_SESSION['email'] . "' and mobile='" . $_SESSION['mobile'] . "'";
					$rs3 = mysqli_query($con, $sql1);

					if($rs3)
					{
								$sql4="SELECT name,email,mobile,sf,experience from consultant_details where sf='" . $_SESSION['sf'] . "'";
								$rs4 = mysqli_query($con, $sql4);
								if($rs4)
								{
									while ($row = mysqli_fetch_row($rs4))
										{
											
											
											$body="Hello '" . $_SESSION['name'] . "'!
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
									
									
										$to_email = "" . $_SESSION['email'] . "";
										$subject = "Thanks for Registration - Consultant Details";
										

										
								}
								else
								{
										
								}
								if (mail($to_email, $subject, $body))
								{
									session_unset();
									session_destroy();
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
				}
		}
		else
		{
			include 'failure.html';
		}
		}
		   
		 
   mysqli_close($con);
	
	
	
	
	
	
	?> 
	
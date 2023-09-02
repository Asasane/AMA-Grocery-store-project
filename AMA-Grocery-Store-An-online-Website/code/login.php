<?php
//echo '<script>alert("Welcome to Geeks for Geeks")</script>';
session_start();
//echo '<script type="text/javascript">alert("' . $msg . '")</script>';
function test_input($data)
{
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
$username=$password="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(empty($_POST["password"]) || empty($_POST["username"]))
   {
	 $emailErr="password is missing";   
     header("location:login1.html");
     exit();
    }
   else
   {
     $username=$_POST['username'];
     $password=$_POST['password'];
     if($username=="aadmin")
     {
		 $_SESSION['name']=admin;
           session_write_close();
            echo "Admin";  
     }
     else
     {
		 
	 $salt="yughkjhbgvbhj";
     $password=md5($password.$salt);
	 
	 $conn=mysqli_connect("localhost","root","","grocery1");
	 if(!$conn)
      {
         echo "Failed to connect".mysqli_connect_err();
      }
     else
      {
         $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
         $result=mysqli_query($conn,$query);
         if(mysqli_num_rows($result)!=0)
		{ 
        $userData=mysqli_fetch_assoc($result);
        $_SESSION['name']=$userData['username'];
        $_SESSION['user_role']=$userData['role'];
        session_write_close();
        echo "Login successful";
		}
		else
		{
			echo "Login unsucc";
		}
   }
}
}
}
?>
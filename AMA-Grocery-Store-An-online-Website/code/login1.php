<?php
//echo '<script>alert("Welcome to Geeks for Geeks")</script>';die();
session_start();
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
  //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
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
    //echo $username;
    //echo $password;
     if($username=="adminn")
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
         //echo $username.$password;
         $query="SELECT * FROM users WHERE username='$username' AND password ='$password'";
         //$sql = "INSERT INTO MyGuests (firstname) VALUES ('$val')";
         $result=mysqli_query($conn,$query);
         //print_r($result);
         if(mysqli_num_rows($result)!=0)
	 { 
           
           $userData=mysqli_fetch_assoc($result);
           //print_r($userData);
           $_SESSION['name']=$userData['username'];
           session_write_close();
            echo "Login successful";
	 }
	 else
	 {
		 echo "Login unsuccessful";
	 }
   }
}
}
}

?>
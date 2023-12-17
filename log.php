<?php
  $_host="127.0.0.1";
  $_user="root";
  $_password="";
  $_db="hii";
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  $conn=mysqli_connect($_host,$_user, $_password,$_db);
  if(!$conn)
  {
    echo "connection failed".mysqli_connect_error();
  }
  else{
    header('location:rental.php');
  }
 $query=" select name,email,password from regester where name='$name' and email='$email' and password='$password'";
 $res=mysqli_query($conn,$query);
 
 if(mysqli_num_rows($res)>0){
  foreach($res as $row)
  {
    echo"\n";
    echo $row['name'];
    header('location:rental.php');
  }
 
}
else
{
  echo "data not found";
}
  
?>
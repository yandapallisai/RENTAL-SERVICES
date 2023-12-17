<?php
$_host="";
$hostname="127.0.0.1";
$username="root";
$password="";
$db="hii";
$conn=mysqli_connect($hostname,$username,$password,$db);
if(!$conn)
{
    echo "connected fail".mysqli_connect_error();
}
else
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    echo "connected successfull \n";
}
$sql="insert into regester(name,email,password) values('$name','$email','$password')";
$res = mysqli_query($conn,$sql);
if(!$res)
{
    echo "regester failed";
}
else{
    echo "\n successfully regestered";
}
$re="select * from regester";
$r=mysqli_query($conn,$re);

?>
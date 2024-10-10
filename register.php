<?php
$dbhost='localhost:3307';
$dbuser= 'root';
$dbpass='';
$db='registration1';

$name=$_POST['name'];
$email=$_POST['email'];
$number=$_POST['number'];
$password=$_POST['password'];
$exists=false;

$conn=mysqli_connect($dbhost, $dbuser, '', $db) ;





if(! $conn)
{
die('connection failed');
}
else
{
$stmt=$conn->prepare("insert into register1

(name,email,number,password)values
(?,?,?,?)");
$stmt->bind_param("ssis",$name,$email,
$number,$password);
$stmt->execute();
echo "registration successfully...";
$stmt->close();
$conn->close();
}
?>
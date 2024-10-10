<?php
$dbhost='localhost:3307';
$dbuser= 'root';
$dbpass='';
$db='registration1';

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];
$number=$_POST['number'];

$conn=mysqli_connect($dbhost, $dbuser, '', $db) ;


if(! $conn)
{
die('connection failed');
}
else
{
$stmt=$conn->prepare("insert into test

(firstname,lastname,email,password,number)values
(?,?,?,?,?)");
$stmt->bind_param("ssssi",$firstname,$lastname,$email,
$password,$number);
$stmt->execute();
echo "registration successfully...";
$stmt->close();
$conn->close();
}
?>
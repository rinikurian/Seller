<?php
$id=$_REQUEST['id'];
include 'db.php';
$sql="delete from costumer where customerid=$id";
$results=mysqli_query($dbcon,$sql);
if($results>0)
{
	echo "item deleted";
}
else
echo "cannot delete";
header("location:customershow.php")
?>
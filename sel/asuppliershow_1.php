
<?php 
include_once "db.php";
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
<style>
table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 60%;
}

th, td {
    padding: 15px;
}

</style>
         <body>
       <div class="jumbotron">
            <h2>
                <center>Customer Show</center>
            </h2>
        </div>

               
	



      <table border="5" style="background-color: white; color: #761a9b; margin: 0 auto;" >
<thead>
        <tr>
          <th>NAME</th>
          <th>MOBILE</th>
          <th>EMAIL</th>
          
          <th>ADDRESS</th>
          <th colspan="2">ACTION</th>
         
        </tr>
      </thead>
      <tbody>





<?php
$results=mysqli_query($dbcon,"select * from costumer");
while($row=mysqli_fetch_array($results))
{

?>
<td><?php echo $row['customername']; ?>"</td>
<td><?php echo $row['mobile']; ?></td>
<td><?php echo $row['email']; ?></td>

<td><?php echo $row['address']; ?></td>

 

<td><a href="asupplieredit_1.php?id=<?php echo $row['customerid'];?>" >Edit</a></td>
<td><a href="asupplierdelete_1.php?id=<?php echo $row['customerid'];?>">Delete</a></td>
</tr>
<?php } ?>
</tbody>
           
</table>
             <button class="btn btn-primary" id="btn_Product_reg" onclick="location.href = 'astaff_home.php';" style="float: right;">Back</button>
</body>
</html>

 <?php
include 'db.php';

?>


<?php
if (isset($_POST['signup'])) {
   
    $due=  str_replace("$","",$_POST['due']);
    $item_name = $_POST['item_name'];
    
     $cat = $_POST['cat'];
     echo $cat;
     $cost = str_replace("$","",$_POST['cost']);
     $price = str_replace("$","",$_POST['price']);
    $qty = str_replace("$","",$_POST['qty']);
    $subtotal = str_replace("$","",$_POST['subtotal']);
     $total = str_replace("$","",$_POST['total']);
      $paid = str_replace("$","",$_POST['paid']);
      $balancedue = str_replace("$","",$_POST['balancedue']);
      var_dump($_POST);
    // if ($password1 == $password) {
    //$sql = "INSERT INTO `staff`(`staff_name`,  `mob_number`, `email`, `password`,`address`, `status`) VALUES ('$staff_name','$mob_number','$email','$password1''$address',1)";


     $sql1="INSERT INTO `invoice`( `due`, `item_name`, `cat`, `cost`, `qty`, `price`, `subtotal`, `total`, `paid`, `balancedue`, `status`) VALUES ('$due','$item_name','$cat','$cost','$qty','$price','$subtotal','$total','$paid','$balancedue',1)";
//die($sql1);
    $res = mysqli_query($dbcon, $sql1)or die(mysqli_error($dbcon));
    
    $res=mysqli_query($dbcon,"select * from product WHERE productname='$item_name'");
    $row1=mysqli_fetch_array($res);
    $a=$row1['quantity'];
    $a=$a-$qty;
    $res=mysqli_query($dbcon,"update product set quantity='$a' where productname='$item_name'");


    //$p = "select max(productid) as lgid from product";

    //$q = mysqli_query($dbcon, $p) or die(mysqli_error($dbcon));
    //$row = mysqli_fetch_array($q);
    //$x = $row['lgid'];




    echo '<script> alert("Printing............ ")</script>';
//    } else {
//
//        echo '<script language="javascript">';
//        echo 'alert("Your password does not match")';
//        echo '</script>';
//    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
        <link rel="stylesheet" href="css/bootstrap.css">

</head>

<body>

	<div id="page-wrap">
<form name="frm" id="frm" method="post" action="#"onsubmit="return addUser()">
		
		
		<div id="identity">
		
            <textarea id="address">Chris Coyier
123 Appleseed Street
Appleville, WI 53719

Phone: (555) 555-5555</textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">Widget Corp.
c/o Steve Widget</textarea>
                    
            <table id="meta">
                <tr>
                    <?php
                    $a=0;
                    $sql="select invoiceid from invoice";
                    $res=mysqli_query($dbcon,$sql);
                    while($row=mysqli_fetch_array($res))
                    {
                        $a=$row['invoiceid'];
                                            }
                                            $a=$a+1; ?>
                    
                    <td class="meta-head"> Invoice </td>
                    <td><textarea> <?php echo $a; ?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date" name="date">2017-11-21</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><textarea class="due" id="due" name="due">$0.00</textarea></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		  <tr class="item-row">
		      <tr>
                     <td> <select name="item_name" id="item_name" class="item_name"style="width:20%;align-content: flex-start;">
                             
                    <option value="">select item</option>
                        <?php
                            $query = "SELECT * FROM category,subcategory where category.categoryid=subcategory.categoryid";
                            $results = mysqli_query($dbcon, $query);
                            foreach ($results as $records) {
                        ?>
                   <option value="<?php echo $records["categoryid"]; ?>"> <?php echo $records["categoryname"]; ?></option>

                        <?php
                            }
                         ?>
                </select></td>
                  
		      
                          <td><select name="cat" id="cat" class="cat" name="cat" style="width:20%;align-content: flex-start;">
                    <option value=" ">batch</option>
                </select></td>
                  
		      <td><textarea class="cost" name="cost" id="cost"onkeypress="javascript:return isNumber(event)">$0.00</textarea></td>
		      <td><textarea class="qty" name="qty" id="qty"onkeypress="javascript:return isNumber(event)">0</textarea></td>
                      <td><textarea class="price" name="price" id="price" onkeypress="javascript:return isNumber(event)">$0.00</textarea></td>
		  </tr>
		  
<!--		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea name="item" id="item" placeholder="Enter Product name" onkeypress="return onlyAlphabets(event,this);" required></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>

		      <td class="description"><textarea name="specification" id="specification" placeholder="Enter the specification"  onkeypress="return onlyAlphabets(event,this);" required></textarea></td>
		      <td><textarea class="cost" name="cost" id="cost"onkeypress="javascript:return isNumber(event)">$.00</textarea></td>
		      <td><textarea class="qty" name="qty" id="qty" onkeypress="javascript:return isNumber(event)"></textarea></td>
                      <td><textarea class="price" name="price" id="price" onkeypress="javascript:return isNumber(event)">$.00</textarea></td>
		  </tr>-->
		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
                      <td class="total-value"><textarea id="subtotal" name="subtotal">$0.00</textarea></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line" >Total</td>
                      <td class="total-value"><textarea id="total"name="total" >$0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid" name="paid" >$0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
                      <td class="total-value balance"><textarea class="due" id="balancedue" name="balancedue">$0.00</textarea></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		   <input type="submit" name="signup" value="Print" id="signup" class="btn btn-success">
                       <button class="btn btn-primary" id="" onclick="location.href = 'aonlinepay.php';" style="float: right;">Pay</button>&nbsp &nbsp &nbsp
                        <button class="btn btn-primary" id="" onclick="location.href = 'aproduct_view.php';" style="float: right;">Back to products</button>&nbsp&nbsp&nbsp
                       <button class="btn btn-primary" id="" onclick="location.href = 'astaff_home.php';" style="float: right;">Back</button>
		  
		</div>
</form>
 <script src="js/jqueryori.min.js"></script>
 <div id='item_img'>
</div>
	</div>
	
</body>

</html>
<script language="Javascript" type="text/javascript"> </script>
<script>

   $('#item_name').on('change', function(){
        $item_id = $(this).val();
        //alert($item_id);
        $.ajax({
          type: "POST",
          url: "getdata.php",
          data: "item_id="+$item_id,
          success: function(data){
            $("#cat").html(data);
            //alert(data);

      }
      });
   });

   $('#cat').on('change', function(){
        $cat_id = $('#cat').val();
        //alert($batch_id);
        $.ajax({
          type: "POST",
          url: "getdata2.php",
          data: "cat_id="+$cat_id,
          success: function(data){
            $("#subject").html(data);
                
      }
      });
   });

   //loads pic on cat_list change
   $('#load_pic').on('click', function(){
        $subject_id = $('#subject').val();
        if($.isNumeric($item_id))
        {
          $.ajax({
            type: "POST",
            url: "getpic.php",
            data: "subject_id="+$subject_id,
            success: function(data){
            //  alert(data);
              $("#item_img").html(data);

        }
        });
        $('#buy').toggleClass('buy_visibility');
        }
        else {
          alert('No item found');
        }
        // alert($spare_id);
   });







 
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode ==8))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
 
    

    // WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>
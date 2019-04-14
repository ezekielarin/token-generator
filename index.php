

<!DOCTYPE html>
<html>
<head>
	<title>Token Generator</title>
</head>
<body>

<?php 
//database connection
include "db.php";
   
   if (isset($_POST['generate'])) {
        $length =  $_POST['length'];
        $quantity =  $_POST['quantity'];
        $value =  $_POST['value'];
          
          //iterate for the quantity specified
        for ($i=0; $i < $quantity; $i++) { 

        	$code = rand(11,99999999999999999);
        	//trim to get the required length
        	$token = substr($code, 0, $length);
              //check if code already exists
        	$check = mysqli_num_rows(mysqli_query($con,"SELECT * FROM tokens WHERE token='$token'"));
        	if (!$check>0) {
        		
        	 $query = mysqli_query($con,"INSERT INTO tokens (token,token_value) VALUES('$token','$value')");
        	 if (!$query) {
        		echo $con->error;
        	     }
 
        	    }
            }
       }
    ?>



	<div class="">
	<form method="post">
		<span>Lenght of token</span>
		<input type="text" name="length"><br>
         <span>Quantity of tokens</span>
		<input type="text" name="quantity"><br>
		<span>value of tokens</span>
		<input type="text" name="value"><br>
		<input type="submit" name="generate" value="generate">
		
	</form>
</div>
<div>
	<table border="0" cellspacing="2" cellpadding="1">
		<tr>
			<th>Token</th>
			<th>Value</th>
			<th>Date generated</th>
		</tr>
		<?php
		$query =mysqli_query($con,"SELECT * FROM tokens ORDER BY id DESC");
		while ($tokens=mysqli_fetch_array($query)) {
	    ?>
	    <tr>
	    	<td><?php echo $tokens['token']?></td>
	    	<td><?php echo $tokens['token_value']?></td>
	    	<td><?php echo $tokens['gen_date']?></td>
	    </tr>

	   <?php
		}
		?>
	</table>
</div>
</body>
</html>
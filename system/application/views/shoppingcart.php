<h1>Shopping Cart</h1>
<div id='pleft'>

<?php echo form_open('welcome/checkout'); ?>
<table border='1' cellspacing='0' cellpadding='5'>
<?php
$TOTALPRICE = $_SESSION['totalprice'];

if (count($_SESSION['cart'])){
	foreach ($_SESSION['cart'] as $PID => $row){	
		$data = array(	
				'name' => "li_id[$PID]", 
				'value'=>$row['count'], 
				'id' => "li_id_$PID", 
				'class' => 'process',
				'size' => 5
		);
		
		echo "<tr valign='top'>\n";
		echo "<td>". form_input($data)."</td>\n";
		echo "<td id='li_name_".$PID."'>". $row['name']."</td>\n"; 
		echo "<td id='li_price_".$PID."'>". $row['price']."</td>\n";
		echo "<td id='li_total_".$PID."'>".number_format($row['price'] * $row['count'], 2,'.',',')."</td>\n";
		echo "<td><a href='#' onclick='javascript:jsRemoveProduct($PID)'>delete</a></td>\n";
		echo "</tr>\n";
	}
	
	$total_data = array('name' => 'total', 'id'=>'total', 'value' => $TOTALPRICE);
	echo "<tr valign='top'>\n";
	echo "<td colspan='3'>&nbsp;</td>\n";
	echo "<td colspan='2'>$TOTALPRICE ".form_hidden($total_data)."</td>\n";
	
	echo "</tr>\n";

	echo "<tr valign='top'>\n";
	echo "<td colspan='3'>&nbsp;</td>\n";
	echo "<td colspan='2'><input type='button' name='update' value='update' onClick='javascript:jsUpdateCart()'/></td>\n";
	echo "</tr>\n";	
	
	echo "<tr valign='top'>\n";
	echo "<td colspan='3'>&nbsp;</td>\n";
	echo "<td colspan='2'>".form_submit('submit', 'checkout')."</td>\n";
	echo "</tr>\n";	
}else{
	//just in case!
	echo "<tr><td>No items to show here!</td></tr>\n";
}//end outer if count
?>
</table>
</form>
<div id='ajax_msg'></div>
</div>
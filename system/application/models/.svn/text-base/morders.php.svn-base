<?php

class MOrders extends Model{
 function MOrders(){
    parent::Model();
 }

function updateCart($productid,$fullproduct){
	//pull in existing cart first!
	$cart = $_SESSION['cart'];//$this->session->userdata('cart');
	$productid = id_clean($productid);
	$totalprice = 0;
	if (count($fullproduct)){
		if (isset($cart[$productid])){
			$prevct = $cart[$productid]['count'];
			$prevname = $cart[$productid]['name'];
			$prevprice = $cart[$productid]['price'];
			$cart[$productid] = array(
					'name' => $prevname,
					'price' => $prevprice,
					'count' => $prevct + 1
					);
		}else{
			$cart[$productid] = array(
					'name' => $fullproduct['name'],
					'price' => $this->format_currency($fullproduct['price']),
					'count' => 1
					);			
		}
	
		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		//$this->session->set_userdata('totalprice', $totalprice);
		$_SESSION['cart'] = $cart;
		//$this->session->set_userdata('cart',true);
		$this->session->set_flashdata('conf_msg', "We've added this product to your cart."); 
	}

}

function removeLineItem($id){
	$id = id_clean($id);
	$totalprice = 0;
	$cart = $_SESSION['cart'];//$this->session->userdata('cart');
	if (isset($cart[$id])){
		unset($cart[$id]);
		foreach ($cart as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		
		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		$_SESSION['cart'] = $cart;
		//$this->session->set_userdata('totalprice', $totalprice);
		//$this->session->set_userdata('cart',true);
		echo "Product removed.";
	}else{
		echo "Product not in cart!";
	}
}

function updateCartAjax($idlist){
	$cart = $_SESSION['cart'];//$this->session->userdata('cart');
	//split idlist on comma first
	$records = explode(',',$idlist);
	$updated = 0;
	$totalprice = $_SESSION['totalprice'];
	//$this->session->userdata('totalprice');
	if (count($records)){
		foreach ($records as $record){
			if (strlen($record)){
				//split each record on colon
				$fields = explode(":",$record);
				$id = id_clean($fields[0]);
				$ct = $fields[1];
				
				if ($ct > 0 && $ct != $cart[$id]['count']){
					$cart[$id]['count'] = $ct;
					$updated++;
				}elseif ($ct == 0){
					unset($cart[$id]);
					$updated++;
				}
			
			}
			
		}
		
		
		if ($updated){
			$totalprice=0;
			foreach ($cart as $id => $product){
				$totalprice += $product['price'] * $product['count'];
			}		

			$_SESSION['totalprice'] = $this->format_currency($totalprice);
			$_SESSION['cart'] = $cart;
			//$this->session->set_userdata('totalprice', $totalprice);		
			//$this->session->set_userdata('cart',true);
			
		
			switch ($updated){
				case 0:
				$string = "No records";
				break;
				
				case 1:
				$string = "$updated record";
				break;
				
				default:
				$string = "$updated records";
				break;
			}
			echo "$string updated";
			//$this->session->set_flashdata('update_count', $string ." updated");
		}else{
			echo "No changes detected";
			//$this->session->set_flashdata('update_count', "No changes detected");
		}
	}else{
		echo "Nothing to update";
		//$this->session->set_flashdata('update_count', "Nothing to update");
	}
}

function verifyCart(){
	$cart = $_SESSION['cart'];
	$change = false;
	
	if (count($cart)){
		foreach ($cart as $id => $details){
			$idlist[] = $id;		
		}
		$ids = implode(",",$idlist);
		
		$this->db->select('id,price');
		$this->db->where("id in ($ids)");
		$Q = $this->db->get('products');
    	if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$db[$row['id']] = $row['price'];
			}
		}
		
		foreach ($cart as $id => $details){
			if (isset($db[$id])){
				if ($details['price'] != $db[$id]){
					$details['price'] = $this->format_currency($db[$id]);
					$change = true;
				}
				
				$final[$id] = $details;
			
			}else{
				$change = true;
			}
		}
		
		$totalprice=0;
		foreach ($final as $id => $product){
			$totalprice += $product['price'] * $product['count'];
		}		

		$_SESSION['totalprice'] = $this->format_currency($totalprice);
		$_SESSION['cart'] = $final;
		$this->session->set_flashdata('change',$change);
	
	}else{
		//nothing in cart!
		$this->session->set_flashdata('error',"Nothing in cart!");
	}

}

function format_currency($number){
	return number_format($number,2,'.',',');
}
 
}//end class
?>
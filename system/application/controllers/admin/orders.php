<?php

class Orders extends Controller {
  function Orders(){
    parent::Controller();
    session_start();
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
  
}


?>
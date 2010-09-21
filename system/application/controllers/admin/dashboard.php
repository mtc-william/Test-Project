<?php

class Dashboard extends Controller {
  function Dashboard(){
    parent::Controller();
    session_start();
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
 
  function index(){	
	$data['title'] = "Dashboard Home";
	$data['main'] = 'admin_home';
	$this->load->vars($data);
	$this->load->view('dashboard');
  }
 
 function logout(){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	$this->session->set_flashdata('error',"You've been logged out!");
	redirect('welcome/verify','refresh'); 	
 }
 
}
?>
<?php

class Welcome extends Controller {
  function Welcome(){
    parent::Controller();
    session_start();
    $this->output->enable_profiler(FALSE);
  }

  function index(){	
  	$this->output->cache(30);
	$data['title'] = "Welcome to Claudia's Kids";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['mainf'] = $this->MProducts->getMainFeature();
	$skip = $data['mainf']['id'];
	$data['sidef'] = $this->MProducts->getRandomProducts(3,$skip);
	$data['main'] = 'home';
	$this->load->vars($data);
	$this->load->view('template');
  }

  function cat($id){
  	//$this->benchmark->mark('query_start');
	$cat = $this->MCats->getCategory($id);
	//$this->benchmark->mark('query_end');
	if (!count($cat)){
		redirect('welcome/index','refresh');
	}
	$data['title'] = "Claudia's Kids | ". $cat['name'];
	
	if ($cat['parentid'] < 1){
		//show other categories
		$data['listing'] = $this->MCats->getSubCategories($id);
		$data['level'] = 1;
	}else{
		//show products
		$data['listing'] = $this->MProducts->getProductsByCategory($id);
		$data['level'] = 2;

	}
	$data['category'] = $cat;
	$data['main'] = 'category';
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');
 }



  function product($id){
	$product = $this->MProducts->getProduct($id);
	if (!count($product)){
		redirect('welcome/index','refresh');
	}
	$data['grouplist'] = $this->MProducts->getProductsByGroup(3,$product['grouping'],$id);
	$data['product'] = $product;
	$data['title'] = "Claudia's Kids | ". $product['name'];
	$data['main'] = 'product';
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$data['assigned_colors'] = $this->MProducts->getAssignedColors($id);
	$data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
	$data['colors'] = $this->MColors->getActiveColors();
	$data['sizes'] = $this->MSizes->getActiveSizes();
	$this->load->vars($data);
	$this->load->view('template');
  }

  function cart($productid=0){

	if ($productid > 0){
		//$productid = $this->uri->segment(3);
		$fullproduct = $this->MProducts->getProduct($productid);
		$this->MOrders->updateCart($productid,$fullproduct);
		redirect('welcome/product/'.$productid, 'refresh');
	
	}else{
		$data['title'] = "Claudia's Kids | Shopping Cart";
		if (count($_SESSION['cart'])){
			$data['main'] = 'shoppingcart';
			$data['navlist'] = $this->MCats->getCategoriesNav();
			$this->load->vars($data);
			$this->load->view('template');	
		}else{
			redirect('welcome/index','refresh');
		}
	}
  }
  

  function ajax_cart(){
   	$this->MOrders->updateCartAjax($this->input->post('ids'));
	
  
  }

  function ajax_cart_remove(){
   	$this->MOrders->removeLineItem($this->input->post('id'));
  }
  
  function checkout(){
  	$this->MOrders->verifyCart();
	$data['main'] = 'confirmorder';
	$data['title'] = "Claudia's Kids | Order Confirmation";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');   	
  }
  

  function search(){
  	
	if ($this->input->post('term')){
		$data['results'] = $this->MProducts->search($this->input->post('term'));
	}else{
		redirect('welcome/index','refresh');
	}
	$data['main'] = 'search';
	$data['title'] = "Claudia's Kids | Search Results";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');  
  }

  function verify(){
	if ($this->input->post('username')){
		$u = $this->input->post('username');
		$pw = $this->input->post('password');
		$this->MAdmins->verifyUser($u,$pw);
		if ($_SESSION['userid'] > 0){
			redirect('admin/dashboard','refresh');
		}
	}
	$data['main'] = 'login';
	$data['title'] = "Claudia's Kids | Admin Login";
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template');  
  }


  function pages($path){
    $page = $this->MPages->getPagePath($path);
	$data['main'] = 'page';
	$data['title'] = $page['name'];
	$data['page'] = $page;
	$data['navlist'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view('template'); 
  }

  
  
  function subscribe(){
  	if ($this->input->post('email')){
	  	$this->load->helper('email');
		if (!valid_email($this->input->post('email'))){
			$this->session->set_flashdata('subscribe_msg', 'Invalid email. Please try again!');
			redirect('welcome/index','refresh');
		}
		$this->MSubscribers->createSubscriber();
		$this->session->set_flashdata('subscribe_msg', 'Thanks for subscribing!');
		redirect('welcome/index','refresh');
  	}else{
		$this->session->set_flashdata('subscribe_msg', "You didn't fill out the form!");
		redirect('welcome/index','refresh');  		
  	}
  }


  function unsubscribe($id){
	//$id = $this->uri->segment(3);
	$this->MSubscribers->removeSubscriber($id);
	$this->session->set_flashdata('subscribe_msg','You have been unsubscribed!');
	redirect('welcome/index','refresh');
  }
  
}//end controller class

?>
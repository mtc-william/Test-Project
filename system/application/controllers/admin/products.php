<?php

class Products extends Controller {
  function Products(){
    parent::Controller();
    session_start();
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
  function index(){
	$data['title'] = "Manage Products";
	$data['main'] = 'admin_product_home';
	$data['products'] = $this->MProducts->getAllProducts();
	$data['categories'] = $this->MCats->getCategoriesDropDown();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MProducts->addProduct();
  		$this->session->set_flashdata('message','Product created');
  		redirect('admin/products/index','refresh');
  	}else{
		$data['title'] = "Create Product";
		$data['main'] = 'admin_product_create';
		$data['categories'] = $this->MCats->getCategoriesDropDown();
		$data['colors'] = $this->MColors->getActiveColors();
		$data['sizes'] = $this->MSizes->getActiveSizes();
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MProducts->updateProduct();
  		$this->session->set_flashdata('message','Product updated');
  		redirect('admin/products/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Product";
		$data['main'] = 'admin_product_edit';
		$data['product'] = $this->MProducts->getProduct($id);
		$data['categories'] = $this->MCats->getCategoriesDropDown();
		$data['assigned_colors'] = $this->MProducts->getAssignedColors($id);
		$data['assigned_sizes'] = $this->MProducts->getAssignedSizes($id);
		$data['colors'] = $this->MColors->getActiveColors();
		$data['sizes'] = $this->MSizes->getActiveSizes();
		if (!count($data['product'])){
			redirect('admin/products/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MProducts->deleteProduct($id);
	$this->session->set_flashdata('message','Product deleted');
	redirect('admin/products/index','refresh');
  }
  
  
  function batchmode(){
  	$this->MProducts->batchUpdate();
  	redirect('admin/products/index','refresh');
  }

  function export(){
  	$this->load->helper('download');
  	$csv = $this->MProducts->exportCsv();
  	$name = "product_export.csv";
  	force_download($name,$csv);

  }
  
  function import(){
	if ($this->input->post('csvinit')){
		$data['csv'] = $this->MProducts->importCsv();
		$data['title'] = "Preview Import Data";
		$data['main'] = 'admin_product_csv';
		$this->load->vars($data);
		$this->load->view('dashboard');

	}elseif($this->input->post('csvgo')){
		if (eregi("finalize", $this->input->post('submit'))){
			$this->MProducts->csv2db();
			$this->session->set_flashdata('message','CSV data imported');
		}else{
			$this->session->set_flashdata('message','CSV data import cancelled');
		}
		redirect('admin/products/index','refresh');
	}
  	
  }
}


?>
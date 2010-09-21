<?php

class MProducts extends Model{
 function MProducts(){
    parent::Model();
 }

 function getProduct($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('products',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }

 function getAllProducts(){
     $data = array();
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 }

 
 function getProductsByCategory($catid){
     $data = array();
     $this->db->select('id,name,shortdesc,thumbnail');
     $this->db->where('category_id', id_clean($catid));
     $this->db->where('status', 'active');
     $this->db->orderby('name','asc');
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 } 
 
 
  function getProductsByGroup($limit,$group,$skip){
     $data = array();
     if ($limit == 0){
     	$limit=3;
     }
     $this->db->select('id,name,shortdesc,thumbnail');
     $this->db->where('grouping', db_clean($group,16));
     $this->db->where('status', 'active');
     $this->db->where('id !=', id_clean($skip));
     $this->db->orderby('name','asc');
     $this->db->limit($limit);
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data; 
 } 
 
 
 function getMainFeature(){
     $data = array();
     $this->db->select("id,name,shortdesc,image");
     $this->db->where('featured','true');
     $this->db->where('status', 'active');
     $this->db->orderby("rand()"); 
     $this->db->limit(1);
     $Q = $this->db->get('products');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data = array(
         	"id" => $row['id'],
         	"name" => $row['name'],
         	"shortdesc" => $row['shortdesc'],
         	"image" => $row['image']
         	);
       }
    }
    $Q->free_result();    
    return $data;  
 
 }
 
 
function getRandomProducts($limit,$skip){
	$data = array();
	$temp = array();
	if ($limit == 0){
	$limit=3;
	}
	$this->db->select("id,name,thumbnail,category_id");
	$this->db->where('id !=', id_clean($skip));
	$this->db->orderby("category_id","asc"); 
	$this->db->limit(100);
	$Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
         $temp[$row['category_id']] = array(
         	"id" => $row['id'],
         	"name" => $row['name'],
         	"thumbnail" => $row['thumbnail']
         	);
		}
	}

	shuffle($temp);
	if (count($temp)){
		for ($i=1;$i<=$limit; $i++){
			$data[] = array_shift($temp);
		} 
	}
	$Q->free_result();    
	return $data;  
}


function search($term){
	$data = array();
	$this->db->select('id,name,shortdesc,thumbnail');
	$this->db->like('name',db_clean($term));
	$this->db->orlike('shortdesc',db_clean($term));
	$this->db->orlike('longdesc',db_clean($term));
    $this->db->orderby('name','asc');
    $this->db->where('status','active');
    $this->db->limit(50);
    $Q = $this->db->get('products');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();    
    return $data;
}
 
 
 function addProduct(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' => db_clean($_POST['shortdesc']),
		'longdesc' => db_clean($_POST['longdesc'],5000),
		'status' => db_clean($_POST['status'],8),
		'grouping' => db_clean($_POST['grouping'],16),
		'category_id' => id_clean($_POST['category_id']),
		'featured' => db_clean($_POST['featured'],3),
		'price' => db_clean($_POST['price'],16)
	
	);

	if ($_FILES){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				exit();
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "/images/".$image['file_name'];
		
			}
		}
		
		
		if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
				$this->upload->display_errors();
				exit();
			}
			$thumb = $this->upload->data();
	
			if ($thumb['file_name']){
				$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			}
		}
	}
	$this->db->insert('products', $data);	
	
	$new_product_id = $this->db->insert_id();
	
	if (count($_POST['colors'])){
		foreach ($_POST['colors']  as $value){
			$data = array('product_id' => $new_product_id, 
					'color_id' => $value);
			$this->db->insert('products_colors',$data);
		}
	}
	
	if (count($_POST['sizes'])){
		foreach ($_POST['sizes']  as $value){
			$data = array('product_id' => $new_product_id, 
					'size_id' => $value);
			$this->db->insert('products_sizes',$data);
		}	
	}	
 }
 
 function updateProduct(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' => db_clean($_POST['shortdesc']),
		'longdesc' => db_clean($_POST['longdesc'],5000),
		'status' => db_clean($_POST['status'],8),
		'grouping' => db_clean($_POST['grouping'],16),
		'category_id' => id_clean($_POST['category_id']),
		'featured' => db_clean($_POST['featured'],3),
		'price' => db_clean($_POST['price'],16)
	
	);
	if ($_FILES){
		
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
	    if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				exit();
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "/images/".$image['file_name'];
		
			}
		}
		
		if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
				$this->upload->display_errors();
				exit();
			}
			$thumb = $this->upload->data();
		
			if ($thumb['file_name']){
				$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			}
		}
	}
 	$this->db->where('id', $_POST['id']);
	$this->db->update('products', $data);	
 
	$this->db->where('product_id', $_POST['id']);
	$this->db->delete('products_colors');
	$this->db->where('product_id', $_POST['id']);
	$this->db->delete('products_sizes'); 
	
	if (count($_POST['colors'])){
		foreach ($_POST['colors']  as $value){
			$data = array('product_id' => $_POST['id'], 
					'color_id' => $value);
			$this->db->insert('products_colors',$data);
		}
	}
	
	if (count($_POST['sizes'])){
		foreach ($_POST['sizes']  as $value){
			$data = array('product_id' => $_POST['id'], 
					'size_id' => $value);
			$this->db->insert('products_sizes',$data);
		}	
	}		
 }
 
 
 function deleteProduct($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('products', $data);	
 }
	
	
  function batchUpdate(){
  	if (count($this->input->post('p_id'))){
  		$data = array('category_id' => id_clean($this->input->post('category_id')),
  					'grouping' => db_clean($this->input->post('grouping'))
  					);
  		$idlist = implode(",",array_values($this->input->post('p_id')));
		$where = "id in ($idlist)";
  		$this->db->where($where);
  		$this->db->update('products',$data);
  		$this->session->set_flashdata('message', 'Products updated');
  	}else{
    	$this->session->set_flashdata('message', 'Nothing to update!');
	} 
  
  }

 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from products");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 function importCsv(){
 	
	$config['upload_path'] = './csv/';
	$config['allowed_types'] = 'csv';
	$config['max_size'] = '2000';
	$config['remove_spaces'] = true;
	$config['overwrite'] = true;
	$this->load->library('upload', $config);
  	$this->load->library('CSVReader'); 
  	
	if(!$this->upload->do_upload('csvfile')){
		$this->upload->display_errors();
		exit();
	}
	$csv = $this->upload->data();
	$path = $csv['full_path'];
	
	return $this->csvreader->parseFile($path);
 }
 
 function csv2db(){
 	unset($_POST['submit']);
 	unset($_POST['csvgo']);
 	
 	foreach ($_POST as $line => $data){
 		if (isset($data['id'])){
 			$this->db->where('id',$data['id']);
 			unset($data['id']);
 			$this->db->update('products',$data);	
 		}else{
 			$this->db->insert('products',$data);
 		}
 	}
 }
 
 
 function reassignProducts(){
 	$data = array('category_id' => $this->input->post('categories'));
	$idlist = implode(",",array_keys($this->session->userdata('orphans')));
	$where = "id in ($idlist)";
 	$this->db->where($where);
 	$this->db->update('products',$data);
 } 
 
 
 function getAssignedColors($id){
 	$data = array();
 	$this->db->select('color_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_colors');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row['color_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 }
 
 
 function getAssignedSizes($id){
 	$data = array();
 	$this->db->select('size_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_sizes');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row['size_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 } 
}//end class
?>
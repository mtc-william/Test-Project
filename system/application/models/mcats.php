<?php

class MCats extends Model{

	function MCats(){
		parent::Model();
	}


function getCategory($id){
    $data = array();
    $options = array('id' =>id_clean($id));
    $Q = $this->db->getwhere('categories',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllCategories(){
     $data = array();
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }



 function getSubCategories($catid){
     $data = array();
     $this->db->select('id,name,shortdesc');
     $this->db->where('parentid', id_clean($catid));
     $this->db->where('status', 'active');
     $this->db->orderby('name','asc');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
       		$sql = "select thumbnail as src 
       				from products 
       				where category_id=".id_clean($row['id'])."
       				and status='active'
       				order by rand() limit 1";
       		$Q2 = $this->db->query($sql);
 
       	
       		if($Q2->num_rows() > 0){
				$thumb = $Q2->row_array();
       			$THUMB = $thumb['src'];
       		}else{
       			$THUMB = '';
       		}
       		$Q2->free_result();
       		$data[] = array(
       			'id' => $row['id'], 
       			'name' => $row['name'], 
       			'shortdesc' => $row['shortdesc'],
       			'thumbnail' => $THUMB
       		);
       	}
    }
    $Q->free_result();  
    
    return $data; 

 }


 function getCategoriesNav(){
     $data = array();
     $this->db->select('id,name,parentid');
     $this->db->where('status', 'active');
     $this->db->orderby('parentid','asc');
     $this->db->orderby('name','asc');
     $this->db->groupby('parentid,id');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result() as $row){
			if ($row->parentid > 0){
				$data[0][$row->parentid]['children'][$row->id] = $row->name;
			
			}else{
				$data[0][$row->id]['name'] = $row->name;
			}
		}
    }
    $Q->free_result(); 
    return $data; 
 }



 function getCategoriesDropDown(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('parentid !=',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }

	
 function getTopCategories(){
     $data[0] = 'root';
     $this->db->where('parentid',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }	





	
 function addCategory(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'shortdesc' =>  db_clean($_POST['shortdesc']),
		'longdesc' =>  db_clean($_POST['longdesc'],5000),
		'status' =>  db_clean($_POST['status'],8),
		'parentid' => id_clean($_POST['parentid'])
	
	);

	$this->db->insert('categories', $data);	 
 }
 
 function updateCategory(){
	$data = array( 
		'name' =>  db_clean($_POST['name']),
		'shortdesc' =>  db_clean($_POST['shortdesc']),
		'longdesc' =>  db_clean($_POST['longdesc'],5000),
		'status' =>  db_clean($_POST['status'],8),
		'parentid' =>  id_clean($_POST['parentid'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('categories', $data);	
 
 }
 
 function deleteCategory($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('categories', $data);	
 }
 
 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from categories");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 
 function checkOrphans($id){
 	$data = array();
 	$this->db->select('id,name');
 	$this->db->where('category_id',id_clean($id));
 	$Q = $this->db->get('products');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data;  	
 
 }
 

	
}

?>
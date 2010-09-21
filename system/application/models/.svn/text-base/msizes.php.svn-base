<?php

class MSizes extends Model{

	function MSizes(){
		parent::Model();
	}

function getSize($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('sizes',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllSizes(){
     $data = array();
     $Q = $this->db->get('sizes');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 
 function getActiveSizes(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('status','active');
     $Q = $this->db->get('sizes');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }  
 
 function createSize(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8)	
	);

	$this->db->insert('sizes', $data);	 
 }
 
 function updateSize(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8)
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('sizes', $data);	
 
 }
 
 function deleteSize($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('sizes', $data);
	
 } 

}//end class
?>
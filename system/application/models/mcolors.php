<?php

class MColors extends Model{

	function MColors(){
		parent::Model();
	}

function getColor($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('colors',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllColors(){
     $data = array();
     $Q = $this->db->get('colors');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 function getActiveColors(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('status','active');
     $Q = $this->db->get('colors');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 } 
 
 function createColor(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8)	
	);

	$this->db->insert('colors', $data);	 
 }
 
 function updateColor(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8)
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('colors', $data);	
 
 }
 
 function deleteColor($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('colors', $data);
	
 } 
 
 
}//end class
?>
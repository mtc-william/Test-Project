<?php

class MSubscribers extends Model{

	function MSubscribers(){
		parent::Model();
	}

function getSubscriber($id){
    $this->db->where('id',id_clean($id));
    $this->db->limit(1);
    $Q = $this->db->getwhere('subscribers');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
	
 function getAllSubscribers(){
     $data = array();
     $Q = $this->db->get('subscribers');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 
 function createSubscriber(){
	$this->db->where('email', $_POST['email']);
	$this->db->from('subscribers');
	$ct = $this->db->count_all_results();

	if ($ct == 0){
		$data = array( 
			'name' => db_clean($_POST['name']),
			'email' => db_clean($_POST['email'])	
		);

		$this->db->insert('subscribers', $data);	 
 	}
 }
 
 
 function updateSubscriber(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'email' => db_clean($_POST['email'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('subscribers', $data);	
 
 }
 
 function removeSubscriber($id){
 	$this->db->where('id', id_clean($id));
	$this->db->delete('subscribers');
	
 } 

}//end class
?>
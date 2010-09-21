<?php

class MAdmins extends Model{

	function MAdmins(){
		parent::Model();
	}


	function verifyUser($u,$pw){
		$this->db->select('id,username'); 
		$this->db->where('username',db_clean($u,16));
		// echo dohash($pw);
		$this->db->where('password', db_clean(dohash($pw),16));
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('admins');

		if ($Q->num_rows() > 0){
			$row = $Q->row_array();
			$_SESSION['userid'] = $row['id'];
			$_SESSION['username'] = $row['username'];
		}else{
			$this->session->set_flashdata('error', 'Sorry, your username or password is incorrect!');
		}		
	}

	function getUser($id){
      $data = array();
      $options = array('id' => id_clean($id));
      $Q = $this->db->getwhere('admins',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }

      $Q->free_result();    
      return $data;  		

	}
	
	function getAllUsers(){
     $data = array();
     $Q = $this->db->get('admins');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();    
     return $data; 	
	}
	
	
	function addUser(){
      $data = array('username' => db_clean($_POST['username'],16),
                    'email' => db_clean($_POST['email'],255),
                    'status' => db_clean($_POST['status'],8),
                    'password' => db_clean(dohash($_POST['password']),16)
                    );
	
	  $this->db->insert('admins',$data);
	
	}
	
	function updateUser(){
      $data = array('username' => db_clean($_POST['username'],16),
                    'email' => db_clean($_POST['email'],255),
                    'status' => db_clean($_POST['status'],8),
                    'password' => db_clean(dohash($_POST['password']),16)
                    );
	  $this->db->where('id',id_clean($_POST['id']));
	  $this->db->update('admins',$data);	
	
	}
	
	
	function deleteUser($id){
 	 $data = array('status' => 'inactive');
 	 $this->db->where('id', id_clean($id));
	 $this->db->update('admins', $data);
	
	}
}


?>
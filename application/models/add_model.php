<?php

class Add_Model Extends CI_Model {
  function addIdea() {
    $data = array(
       'subject' => $this->input->post('subject') ,
       'body' => $this->input->post('body')
    );

    if($this->db->insert('comment', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  function ajaxAddIdea($subject, $body) {
    $data = array(
       'subject' => $subject,
       'body' => $body
    );

    if($this->db->insert('comment', $data)) {
      return TRUE;
    } else {
      return FALSE;
    } 
  }
  
  function deleteIdea($id) {
    if($this->db->where('id', $id)->delete('comment')) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  function getIdea($id = FALSE) {
    if($id) { 
      return $this->db->where('id', $id)->get('comment')->row();
    } else {
      return $this->db->limit('10')->order_by('id', 'desc')->get('comment')->result_object();
    }
  }
  
  function editIdea($id) {
    
    $data = array(
      'subject' => $this->input->post('subject'),
      'body' => $this->input->post('body')
    );

    if($this->db->where('id', $id)->update('comment', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  function createUser() {
    
    $ip_address = $this->input->ip_address();
    //$salt	= $this->store_salt ? $this->salt() : FALSE;
    //$password	= $this->hash_password($this->input->post('password'), $salt);

    // Users table.
    $data = array(
		'email'       => $this->input->post('email'),
    'password'    => $this->input->post('password'),
		'email'      => $this->input->post('email'),
		'group_id'   => 1,
		'ip_address' => $ip_address,
		'created_on' => now(),
		'last_login' => now(),
		'active'     => 0
		 );
    
    if($this->db->insert('users', $data)) {
      return TRUE;
    } else {
      return FALSE;
    } 
  }
  
  function addConfirmation($user_id, $email) {
    $data = array(
      'user_id'   =>    $user_id,
      'key'       =>    md5($email)
    );
    
    if($this->db->insert('confirm', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
    
  }
  
  function confirmationKey($id) {
    $q = $this->db->select('key')->where('id', $id)->get('confirm');
    
    if($q->num_rows() === 0) {
      return FALSE;
    }
       
    return $q->row('key');
  }
  
  // grab user_id, to pass within activateUser() model function
  function getActivateUserID($id) {
    $q = $this->db->select('user_id')->where('key', $id)->get('confirm');
    
    if($q->num_rows() === 0) {
      return FALSE;
    }
       
    return $q->row('user_id');
  }
  
  // activates the user, by setting value to 1
  function activateUser($id) {
    $data = array(
      'active' => 1
    );
    $this->db->where('id', $id)->update('users', $data);
  }
}
?>
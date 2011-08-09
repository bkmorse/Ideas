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
}
?>
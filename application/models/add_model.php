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
  
  function getIdea() {
    return $this->db->limit('10')->order_by('id', 'desc')->get('comment')->result_object();
  }
}
?>
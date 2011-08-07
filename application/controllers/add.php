<?php

class Add Extends CI_Controller {
  function index() {
    
    $this->load->database();
    $this->load->model('add_model');
    
    $this->form_validation->set_rules('subject', 'Subject', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    if ($this->form_validation->run() == TRUE) {
      if($this->add_model->addIdea())
        print '<h1>Idea added</h1>';
    }
    
    $data['ideas'] = $this->add_model->getIdea();
    $this->load->view('add-idea-view', $data);
    
    
  }
  
  function table() {
    $this->load->dbforge();
    $this->load->database();
    $this->dbforge->add_key('id', TRUE);
    $fields = array(

      'id' => array(
      'type' => 'INT',
      'constraint' => '5',
      'unsigned' => TRUE,
      'auto_increment' => TRUE,
      ),
      
      'subject' => array(
      'type' => 'VARCHAR',
      'constraint' => '50',
      ),
      
      'body' => array(
      'type' => 'BLOB',
      ),
      
    );
    
    $this->dbforge->add_field($fields);
    $this->dbforge->create_table('comment');
  }
}
?>
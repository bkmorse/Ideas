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
  
  function ajax_check() {
    $this->load->model('add_model');
    if($this->input->post('ajax') == '1') {
      //print '<h2>Ajax Posted</h2>';
      if($this->add_model->ajaxAddIdea($this->input->post('subject'), $this->input->post('body'))) {
        print 'success';
      } else {
        print 'failure';
      }
    }
  }
  
  function edit($id) {
    $this->load->model('add_model');
    
    
    $this->form_validation->set_rules('subject', 'Subject', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    if ($this->form_validation->run() == TRUE) {
      if($this->add_model->editIdea($id))
        print '<h1>Updated</h1>';
    }
    $data['idea'] = $this->add_model->getIdea($id);
    $data['ideas'] = $this->add_model->getIdea();
    $this->load->view('edit-idea-view', $data);
    
    //$this->add_model->updateIdea();
  }
  
  function ajax() {
    $this->load->model('add_model');

    $this->load->view('add-idea-ajax-view');
  }
  
  function delete($id) {
    $this->load->model('add_model');
    
    if($this->add_model->deleteIdea($id)) {
      redirect('add/');
    } else {
      print '<h2>Could not delete</h2>';
      redirect('add/');
    }
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
<?php

class Add Extends CI_Controller {
  function index() {
    
    $this->load->dbforge();
    $this->load->database();
    $fields = array(
      'users' => array(
      'type' => 'VARCHAR',
      'constraint' => '100',
      ),
    );
    
    $this->dbforge->add_field($fields);
    $this->dbforge->create_table('table_name');
    $data = array(
       'subject' => 'My subject' ,
       'body' => 'My body'
    );

    $this->db->insert('comment', $data);
    
    print_r($this->db->get('comment')->result_array());
    
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
<?php
class Password Extends CI_Controller {
  
  function index() {
    //$this->load->model('password_model');
    //$this->password_model->storePassword();
    if($this->input->post('signup')) {
      $this->register($this->input->post('username'), $this->input->post('password'));
      print 'account created';
    } elseif($this->input->post('login')) {
      if($this->login($this->input->post('username'), $this->input->post('password'))) {
        print 'success';
      } else {
        print 'failure';
      }
    } else {
      $this->load->view('account-signup-form');
    }
  }
  
  private function prep_password($password) {
    return sha1($password.$this->config->item('encryption_key'));
  }

  function login($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', $this->prep_password($password));

     $query = $this->db->get('account', 1);

     if ( $query->num_rows() == 1) {
       // set your cookies and sessions etc here
       return true;
     }

     return false;
  }

  function register($username, $password) {
    $data = array('username' => $username, 'password' => $this->prep_password($password));
    $this->db->insert('account', $data); 
  }
}

?>
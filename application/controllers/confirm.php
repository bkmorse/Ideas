<?php
class Confirm extends CI_Controller {
  function index($key = '') {
    
    print 'get me a key';
  }
  
  function signup() {
    $this->load->view('signup-view');
    $this->load->model('add_model');
    $this->form_validation->set_rules('email', 'email', 'required|email');
    $this->form_validation->set_rules('password', 'password', 'required');

    // need to work on a lot.
    if ($this->form_validation->run() == TRUE) {
      if($this->add_model->createUser()) {
        //$user_id = $this->db->insert_id();
        if($this->add_model->addConfirmation($this->db->insert_id(), $this->input->post('email'))) {
          print '<h1>User created, please check email for confirmation</h1>';
          
          $key = $this->add_model->confirmationKey($this->db->insert_id());
          print $key;
          $this->confirmationEmail($this->input->post('email'), $key);
        } else {
          print '<h1>Error adding to confirm table</h1>';
        }
      }
        
    }
  }
  
  // send confirmation key to user to activate account
  private function confirmationEmail($email, $key) {
    $this->email->from('your@example.com', 'Your Name');
    $this->email->to('bkmorse@gmail.com'); 

    $this->email->subject($key);
    $this->email->message('http://localhost:8888/Ideas/confirm/activate/'.$key);	

    $this->email->send();

    echo $this->email->print_debugger();
  }
  
  function activate($id) {
    $this->load->model('add_model');
    
    $user_id = $this->add_model->getActivateUserID($id);
    
    if($user_id) {
      $this->add_model->activateUser($user_id);
    }
  }
  
}
?>
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Landing extends CI_Controller{
  function __construct(){
		parent::__construct();

    ini_set('session.gc_maxlifetime',60);
    $this->load->database();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('register');
    $this->load->library('parser');
  //  $this->db->connect();
  }

  public function index(){
    ;
  }

  public function sendMessage()
  {
	$text =  $this->input->post('text');
	$this->register->sendMessage($this->session->userdata('uid')
								 ,$text
								 ,$this->session->userdata('country'));
	redirect("admin");
  }

  public function loadAdmin(){
    if($this->session->userdata('isOnline')===true){
      $data=array(
        'page_title'=>$this->session->userdata('user'),
        'user'=>$this->session->userdata('user'),
		'messages' => $this->session->userdata('isKing') ?
						$this->register->kingMessages($this->session->userdata('country')) :
						$this->register->allMessages($this->session->userdata('country')),
		'users' => $this->register->allUsers($this->session->userdata('country')),
    'isKing' => $this->session->userdata('isKing')
      );
      $this->load->view('template/header',$data);
      $this->load->view('template/sidenavleft',$data);
      $this->load->view('admin',$data);

	  if($this->session->userdata('isKing')===true)
		$this->load->view('peoples',$data);

	  if($this->session->userdata('isKing')===false)
		$this->load->view('sendmessage',$data);

	  $this->load->view('form',$data);
      $this->load->view('template/footer');
    }
    else{
      redirect("login");
    }
  }
  public function login(){
    $username=$this->input->post('username');
    $password=$this->input->post('password');
    $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|max_length[40]');
    $this->form_validation->set_rules('password','Password','trim|required|min_length[3]|max_length[40]');
    if($this->form_validation->run()){
      if($this->register->checkExist($username,$password)){
        $arr=$this->register->find('users',array('username'=>$username,'password'=>$password));
		$this->session->set_userdata('uid',$arr[0]->id);
        $this->session->set_userdata('firstname',$arr[0]->firstname);
        $this->session->set_userdata('lastname',$arr[0]->lastname);
        $this->session->set_userdata('email',$arr[0]->email);
        $this->session->set_userdata('isOnline',true);
        $this->session->set_userdata('user',$username);
		$this->session->set_userdata('country',$arr[0]->country_id);
		$this->session->set_userdata('isKing',$arr[0]->role=='king');
        redirect("admin");
      }
      else{
        redirect("login");
      }
    }
    else{
      redirect("login");
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }
  public function register(){
    $username=$this->input->post('username');
    $password=$this->input->post('password');
    $email=$this->input->post('email');
    $firstname=$this->input->post('firstname');
    $lastname=$this->input->post('lastname');
	$country=$this->input->post('country');
	$cname=$this->input->post('cname');
    $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[30]');
    $this->form_validation->set_rules('firstname','FirstName','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('lastname','LastName','trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[40]');
    $this->form_validation->set_rules('email','Email','required');

    if($this->form_validation->run()){
      if(!$this->register->checkExist($username,$email)){
		$isKing = false;
		if($country=="-1"){
		  $country = $this->register->add_country($cname);
		  $isKing = true;
		}
		else
		{
		  $country = $this->register->verify_country($country);
		}
        $this->register->register($username,$email,$password,$firstname,$lastname,$country,$isKing);
        $this->session->set_userdata('isOnline',true);
        $this->session->set_userdata('user',$username);
        $arr=$this->register->find('users',array('username'=>$username,'password'=>$password));
		$this->session->set_userdata('uid',$arr[0]->id);
        $this->session->set_userdata('firstname',$arr[0]->firstname);
        $this->session->set_userdata('lastname',$arr[0]->lastname);
        $this->session->set_userdata('email',$arr[0]->email);
		$this->session->set_userdata('country',$country);
		$this->session->set_userdata('isKing',$isKing);
        //$this->sendregisterMail($username,$email)
        $this->loadAdmin();
      }
   }

    else{
      redirect('register');
    }
  }
  public function forgetPass(){
    $data=array(
      'heading'=>"404 Not Found",
        'message'=>"Sorry! This Page Was not Found!"
    );
    $this->load->view('errors\html\error_404',$data);
  }
  public function sendregisterMail($username,$email){
    //send_mail($email,$user->find_by_email($email)->homePageURL);
  }

  public function loadLogin(){
    if($this->session->userdata('isOnline')===true){
        $this->loadAdmin();
    }
    else {
        $this->load->view('login');
    }

  }
  public function loadRegister(){
    $this->load->view('register',Array(
	  'countries' => $this->register->allCountries(),
	));
  }

  public function upvote()
  {
    if($this->session->userdata('isOnline')===true){
      $user_id = $this->session->userdata('uid');
      $id = $this->input->get('id');

      $this->register->upvote($user_id, $id);
      $this->loadAdmin();
    }
  }
  public function getAllMessages()
  {
    if($this->session->userdata('isOnline')===true){
          $user=$this->session->userdata('user');
          $people=$this->input->post('inboxpeople');
          echo $user;
          echo $people;
    }

    //return all message of this user;
  }

  public function loadInboxPage()
  {
      $this->register->getInputBox('P4');
  }
  public function get($value='')
  {
    # code...
  }

}
?>

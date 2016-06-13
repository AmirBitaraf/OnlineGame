
<?php
class Email extends CI_Controller {
    function __construct(){
    parent::__construct();
//  $this->load->library('email');
    }
    function index(){
      // the message
    ini_set("SMTP","smtp.gmail.com");
    ini_set("smtp_port","587");
    $msg = "First line of text\nSecond line of text";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail("reznov3395@gmail.com","My subject",$msg);
}
  function index__()
  {
    $config=array();
    $config['useragent'] = 'CodeIgniter';
    $config['protocol'] = 'smtp';
    //$config['mailpath'] = '/usr/sbin/sendmail';
    $config['smtp_host'] ='ssl://smtp.googlemail.com';
    $config['smtp_user'] = 'Testpro74@gmail.com';
    $config['smtp_pass'] = 'reznov74';
    $config['smtp_port'] = 465;
    $config['parameter_spacing'] = false;
    $config['smtp_timeout'] = 60;
    $config['wordwrap'] = TRUE;
    $config['wrapchars'] = 76;
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['validate'] = FALSE;
    $config['priority'] = 3;
    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";
    $config['bcc_batch_mode'] = FALSE;
    $config['bcc_batch_size'] = 200;

                   $this->load->library('email');
                   $this->email->initialize($config);
                   //$this->email->initialize($config);

                   $this->email->from('Testpro74@gmail.com', 'admin');
                   $this->email->to('reznov3395@gmail.com');
                  // $this->email->cc('reznov3395@gmail.com');
                //   $this->email->bcc($this->input->post('email'));
                   $this->email->subject('Registration Verification: Continuous Imapression');
                   $msg = "Thanks for signing up!
               Your account has been created,
               you can login with your credentials after you have activated your account by pressing the url below.
               Please click this link to activate your account:<a href='.base_url('user/verify').'/'.'>Click Here</a>";

               $this->email->message($msg);
               //$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));

               $this->email->send();


               echo $this->email->print_debugger();

  }
}
?>

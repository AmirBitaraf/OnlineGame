<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  DBMaker extends CI_Controller {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('installDB');
    }
    public function installdb()
    {
      $this->installDB->install();
      echo "Data Base Was Installed";
      // redirect("login");
    }
}
?>

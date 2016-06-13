<?php
class Register extends CI_Model{
  private $user;
  function __construct(){
      parent::__construct();
      $this->load->dbforge();
      $this->load->library('table');

  }


  public function find($table,$option){
    $this->db->from($table);
    $this->db->where($option);
    return $this->db->get()->result();
  }

  public function checkExist($username,$password){
      $arr=array(
          'username'=>$username,
          'password'=>$password
      );
      $this->db->where($arr);
      $this->db->from('users');
      $res=$this->db->count_all_results();
      if($res>0){
          return true;
      }
      return false;
  }

  public function findAll($table){
      return $this->db->get($table)->result();
  }


  public function makeRandom(){
    $this->db->flush_cache();
    $min=9999;
    $counter=0;
    $max=999999;
    $random=null;
    while($counter !== count($this->findAll('users'))) {
        $counter++;
        $random = (string)rand($min, $max);
        $res = $this->find('users', array('randomuserid' => $random));
        if (count($res) > 0) {
            break;
        }
    }
    return $random;
  }

  public function getUserData($username,$password){
    $this->db->flush_cache();
    $arr=array(
        'username'=>$username,
        'password'=>$password
    );
    $query = $this->db->select('*')
        ->where($arr)
        ->get('users');
    return $query;
  }

  public function register($username,$email,$password,$firstname,$lastname,$country,$isKing){
    //$randomUserID=$this->makeRandom();
    $arr=array(
      'firstname'=>$firstname,
        'lastname'=>$lastname,
        'email'=>$email,
        'password'=>$password,
        'lastname'=>$lastname,
        'username'=>$username,
        'country_id'=>$country,
        'role'=>($isKing ? "king" : "member")
    );
    $this->db->set($arr);
    if($this->db->insert('users')){
      if ($isKing) {
        $insert_id = $this->db->insert_id();      
        $data = array(
                 'user_owner' => $insert_id
              );
        $this->db->where('id', $country);
        $this->db->update('country', $data);
      }
      return true;
    }
    return false;
  }
  
  public function add_country($cname){
    $arr=array(
      'name'=>$cname,
      'user_owner'=>0
    );
    $this->db->set($arr);
    if($this->db->insert('country'))
    {
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }
    return null;
  }
  
  public function verify_country($country)
  {
    $arr=array(
          'id'=>intval($country)          
      );
      $this->db->where($arr);
      $this->db->from('country');
      $res=$this->db->count_all_results();
      if($res>0){
          return intval($country);
      }
      return null;
  }
  
  public function allCountries()
  {
    return $this->findAll('country');
  }
  
  public function insertMessage($people,$text)
  {
    $arr = array(
      'people_id' => $people,
      'text'=>$text
    );

    $this->db->set($arr);
    if($this->db->insert('messages')){
      return true;
    }
    return false;
  }

  public function checkExist_Temp($username,$password){
    $this->db->flush_cache();
    var_dump($this->findAll('users'));
  }
  public function getInputBox($p_name){

    $query =$this->db->query("SELECT find_people_by_name($p_name)");
    $row = $query->first_row()->find_people_by_name;
    $query2=$this->db->query("SELECT get_messages_of_people($row)");
    $array = array();
    foreach ($query2->result() as $row1) {
      array_push($array,$row1);
    }

    var_dump($array);

  }
  public function sendMessage($user,$text,$country)
  {
    $arr=array(
      'text'=>$text,
      'country_id'=>intval($country),
      'user_id'=>intval($user)
    );
    $this->db->set($arr);
    if($this->db->insert('messages')){
      return true;
    }
    return false;
  }
  
  public function allMessages($country)
  {
    return $this->db->query("SELECT * FROM allMessages($country)")->result();
  }
  
  public function kingMessages($country)
  {
    return $this->db->query("SELECT * FROM allMessages($country) WHERE votes > (SELECT COUNT(*) FROM users WHERE country_id=$country) / 2")->result();
  }
  
  public function allUsers($country)
  {
    return $this->db->query("SELECT * FROM users WHERE country_id=$country")->result();
  }
  
  public function upvote()
  {
    # code...
  }
  public function query($string)
  {
    $this->db->query($string);
  }

}

?>

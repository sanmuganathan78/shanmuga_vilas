<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Login extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->model('login_model');
date_default_timezone_set('Asia/Kolkata');
}

public function index()
{
if($this->session->set_userdata('rcbio_login')=='')
{
$this->load->view('login');
}
else
{
redirect('dashboard');
}
}

public function validate()
{
// $this->backup();
$data=$this->login_model->add();
$count=count($data);
if($count==1)
{
foreach($data as $l)
{
$username=$l['username'];
$password=$l['password'];
$try=array(
'rcbio_username'=>$_POST['username'],
'rcbio_password'=>$_POST['password'],
'rcbio_usertype' => $l['userType'],
'rcbio_userid'=>$l['id'],
'rcbio_login'=>true
);

$this->session->set_userdata($try);
//redirect('dashboard');
if($l['userType']=='A')
{
redirect('dashboard');
}
else
{
$logMenus=$this->db->where('login_id',$this->session->userdata('rcbio_userid'))->get('user_menu')->row();
redirect($logMenus->sub_menu_link);
}	
}
}
else
{
$this->session->set_flashdata('msg1','Username and Password Incorrect! ');
redirect('login');
}
}

Public function backup()
{

$result = $this->db->get_where('backup_details',array('date_created' => date('Y-m-d')))->num_rows();

if($result==0) {
$this->load->dbutil();

$prefs = array(     
'format'      => 'zip',             
'filename'    => 'my_db_backup.sql'
);

$backup =& $this->dbutil->backup($prefs); 
// echo $backup;
// exit();
$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';

$save = 'backups/'.$db_name;
$this->load->helper('file');
write_file($save, $backup);
$data = array(
'file_name'    => $db_name,
'date_created' => date('Y-m-d')
);
$this->db->insert('backup_details',$data);
}
// echo 'Backup Successfully taken !';

}

public function logout()
{
$this->session->sess_destroy();
redirect('login');
}
}
ob_flush();
?>
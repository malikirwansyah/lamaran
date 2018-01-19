<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_regis extends CI_Controller {


	var $folder =   "adminb3/master/user_regis";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data user registrasi";
    var $id_menu =	"17";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/user_regis_model');
			$this->load->model('login_model');
	}

	protected function template($page,$data)
	{
		
		$kg=$this->session->userdata('kdgroup_user');
		$cm= $this->login_model->cek_menu($kg,$this->id_menu);
		foreach ($cm as $row):
                       
                               ".$row->status.";
                    endforeach;
        $ck=$row->status;    

		if($this->session->userdata('logged_in')!="" && $ck==1){
			$this->load->view('adminb3/header',$data);			
			$this->load->view($this->fkiri."/".$this->kiri);
			$this->load->view($this->folder."/".$page);		
			$this->load->view('adminb3/footer');
		}else{

			header('location:'.base_url().'','refresh');
		}
		
	}

	public function index()
	{
		redirect('adminb3/user_regis/data_user_regis');
	}


	public function data_user_regis()
	{
			$data['st_active']	= $this->user_regis_model->st_active;
			$data['st']	= $this->user_regis_model->st;
			$data['title']	= $this->title;	
			$data['dt_user_regis']=$this->db->get('m_user_regis');														
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);	

		
	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";							
		$this->template($page,$data);	
	}

	
	public function edit($kduser_regis=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kduser_regis=$this->input->post('kduser_regis');
			$noktp=$this->input->post('noktp');
			$password=$this->input->post('password');
			$nama_lengkap=$this->input->post('nama_lengkap');
			$email=$this->input->post('email');
			$active=$this->input->post('active');
			$status_kode=$this->input->post('status_kode');
			  	
			   	$data_user_regis=array(
			   					'noktp'=>$noktp,
		                	 	'password'=>$password,
		                	 	'nama_lengkap'=>$nama_lengkap,
					            'email'=>$email,
					            'active'=>$active,
					            'status_kode'=>$status_kode,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kduser_regis', $kduser_regis);
	        		$this->db->update('m_user_regis', $data_user_regis);
	        		$this->session->set_flashdata('save_user_regis', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/user_regis/data_user_regis');
			   	
        }
         else
        {
        	$data['st_active']	= $this->user_regis_model->st_active;
			$data['st']	= $this->user_regis_model->st;
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->user_regis_model->edit($kduser_regis)->row();				
			$this->template($page,$data);	
        }
		
			
	}

public function view() {
if($this->input->post('kduser_regis')){
     $kduser_regis = $this->input->post('kduser_regis');
     $st= $this->user_regis_model->st;
     $st_active	= $this->user_regis_model->st_active;
    $result = $this->user_regis_model->view($kduser_regis);
    if (!empty($result))
                {

                    foreach ($result as $row):
                        echo "
                         <table class='table table-bordered'>
       
	 	<tr>
            <td >Date Regis</td><td>".$row->tgl_regis."</td>
        </tr>
        <tr>
           <td >Active Regis</td><td>".$row->tglactive_regis."</td>
        </tr>
        <tr>
            <td >KTP</td><td>".$row->noktp."</td>
        </tr>
        <tr>
           <td >Nama Lengkap</td><td>".$row->nama_lengkap."</td>
        </tr>
        <tr>
           <td >Email</td><td>".$row->email."</td>
        </tr>
        <tr>
           <td >Password</td><td>".$row->password."</td>
        </tr>
        <tr>
           <td >Last Login</td><td>".$row->last_login."</td>
        </tr>
        <tr>
           <td >Last Logout</td><td>".$row->last_logout."</td>
        </tr>
  		<tr>
           <td >Status</td><td>".$st[$row->status_kode]."</td>
        </tr>
        <tr>
           <td >Active</td><td>".$st[$row->active]."</td>
        </tr>
	</table>";

                      
                        
                        
                    endforeach;
                    }
                else
                {
                    echo "<li> <em> Not found ... </em> </li>";
                }
              

    }
}

	
}
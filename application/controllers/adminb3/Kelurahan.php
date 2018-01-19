<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends CI_Controller {


	var $folder =   "adminb3/master/kelurahan";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data kelurahan";
    var $id_menu =	"4";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/kelurahan_model');
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
		redirect('adminb3/kelurahan/data_kelurahan');
	}


	public function data_kelurahan()
	{
			
			$data['title']	= $this->title;	
			$data['dt_kelurahan']=$this->db->query('
				select kab.kabupaten,pro.provinsi,kel.kelurahan,kel.kdkelurahan,kec.kecamatan 
				from m_kelurahan as kel
				inner join m_kecamatan as kec on kec.kdkecamatan=kel.kdkelurahan
				inner join m_kabupaten as kab on kab.kdkabupaten=kel.kdkabupaten
				inner join m_provinsi as pro on pro.kdprovinsi=kel.kdprovinsi
				');															
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);	

		
	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";
		$data['dt_provinsi']=$this->db->get('m_provinsi');							
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_kelurahan', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/kelurahan/data_kelurahan');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
				$kdprovinsi=$this->input->post('kdprovinsi');
				$kdkabupaten=$this->input->post('kdkabupaten');
				$kdkecamatan=$this->input->post('kdkecamatan');
			    $kelurahan=$this->input->post('kelurahan');
			    $data_kelurahan=array(
					'kdprovinsi'=>$kdprovinsi,
					'kdkabupaten'=>$kdkabupaten,
					'kdkecamatan'=>$kdkecamatan,
					'kelurahan'=>$kelurahan,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_kelurahan);
				$this->db->insert('m_kelurahan',$dt);
				$this->session->set_flashdata("save_kelurahan","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/kelurahan/data_kelurahan');				
			}
	}

	public function edit($kdkelurahan=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		     $kdlogin=$this->session->userdata('kdlogin');
		    $kdkelurahan=$this->input->post('kdkelurahan');
		    $kdprovinsi=$this->input->post('kdprovinsi');
			$kelurahan=$this->input->post('kelurahan');
			$kdkabupaten=$this->input->post('kdkabupaten');
			$kdkecamatan=$this->input->post('kdkecamatan');
			  	
			   	$data_kelurahan=array(
			   			'kdprovinsi'=>$kdprovinsi,
					            'kelurahan'=>$kelurahan,
					            'kdkabupaten'=>$kdkabupaten,
					            'kdkecamatan'=>$kdkecamatan,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdkelurahan', $kdkelurahan);
	        		$this->db->update('m_kelurahan', $data_kelurahan);
	        		$this->session->set_flashdata('save_kelurahan', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/kelurahan/data_kelurahan');
			   	
        }
         else
        {
        	$data['dt_provinsi']=$this->db->get('m_provinsi');	
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['edit'] = $this->kelurahan_model->edit($kdkelurahan)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}
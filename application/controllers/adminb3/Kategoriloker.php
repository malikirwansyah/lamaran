<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategoriloker extends CI_Controller {


	var $folder =   "adminb3/master/kategoriloker";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data kategoriloker";
    var $id_menu =	"13";
   
	
	function __construct(){
		
		parent::__construct();
			$this->load->model('master/kategoriloker_model');
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
		redirect('adminb3/kategoriloker/data_kategoriloker');
	}


	public function data_kategoriloker()
	{
			
			$data['title']	= $this->title;	
			$data['st'] = $this->kategoriloker_model->st;
			$data['dt_kategoriloker']=$this->db->get('m_kategoriloker');														
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

	public function simpan()
	{
		$this->form_validation->set_rules('kategoriloker', 'kategoriloker', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_kategoriloker', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/kategoriloker/data_kategoriloker');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
			    $kategoriloker=$this->input->post('kategoriloker');
			    $tgl_awal=$this->input->post('tgl_awal');
			    $tgl_akhir=$this->input->post('tgl_akhir');

			    if ($tgl_awal > $tgl_akhir ) {
					$this->session->set_flashdata("save_kategoriloker","Mohon isi form dengan benar");
					header('location:'.base_url().'adminb3/kategoriloker/data_kategoriloker');	
				} else {

			    $data_kategoriloker=array(
					'kategoriloker'=>$kategoriloker,
					'tgl_akhir'=>$tgl_akhir,
					'tgl_awal'=>$tgl_awal,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_kategoriloker);
				$this->db->insert('m_kategoriloker',$dt);
				$this->session->set_flashdata("save_kategoriloker","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/kategoriloker/data_kategoriloker');
				}				
			}
	}

	public function edit($kdkategoriloker=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');

		    $kdkategoriloker=$this->input->post('kdkategoriloker');
			$kategoriloker=$this->input->post('kategoriloker');
			$tgl_awal=$this->input->post('tgl_awal');
			$tgl_akhir=$this->input->post('tgl_akhir');
			$status=$this->input->post('status');

			if ($tgl_awal > $tgl_akhir ) {
					$this->session->set_flashdata("save_kategoriloker","Mohon isi form dengan benar");
					header('location:'.base_url().'adminb3/kategoriloker/data_kategoriloker');	
			} else {
			  	
			    $data_kategoriloker=array(
					'kategoriloker'=>$kategoriloker,
					'tgl_akhir'=>$tgl_akhir,
					'tgl_awal'=>$tgl_awal,
					'status'=>$status,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdkategoriloker', $kdkategoriloker);
	        		$this->db->update('m_kategoriloker', $data_kategoriloker);
	        		$this->session->set_flashdata('save_kategoriloker', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/kategoriloker/data_kategoriloker');
			}
			   	
        }
         else
        {
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['st'] = $this->kategoriloker_model->st;
			$data['edit'] = $this->kategoriloker_model->edit($kdkategoriloker)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}
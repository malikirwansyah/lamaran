<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loker extends CI_Controller {


	var $folder =   "adminb3/master/loker";
	var $kiri	=	"kiri";
	var $fkiri	=	"adminb3/master";
    var $title  =   "Data loker";
    var $id_menu =	"14";
   
	
	function __construct(){
		parent::__construct();
			$this->load->model('master/loker_model');
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
		redirect('adminb3/loker/data_loker');
	}


	public function data_loker()
	{
			
			$data['title']	= $this->title;	
			$data['st'] = $this->loker_model->st;
			$data['dt_loker']=$this->db->query('
				SELECT lok.*,kat.kdkategoriloker,kat.kategoriloker,kat.tgl_awal,kat.tgl_akhir FROM m_loker as lok
				inner join m_kategoriloker as kat on kat.kdkategoriloker=lok.kdkategoriloker
				ORDER BY kat.tgl_awal DESC
			');														
			$data['judul']	= $this->title;
			$page			= "home";							
			$this->template($page,$data);	

		
	}

	public function input()
	{
		$data['title']	= $this->title;	
		$page			= "input";
		$data['dt_kategoriloker']=$this->db->get_where('m_kategoriloker',array('status' => 1 ));									
		$this->template($page,$data);	
	}

	public function simpan()
	{
		$this->form_validation->set_rules('loker', 'loker', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
							
				$this->session->set_flashdata('save_loker', "data tidak Boleh Kosong");
		       	header('location:'.base_url().'adminb3/loker/data_loker');
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$created_at=date("Y-m-d h:i:s");
				$kdlogin=$this->session->userdata('kdlogin');
				$kdkategoriloker=$this->input->post('kdkategoriloker');
			    $loker=$this->input->post('loker');
			    $ket=$this->input->post('ket');
			    $tgl_awal=$this->input->post('tgl_awal');
			    $tgl_akhir=$this->input->post('tgl_akhir');

			//	if ($tgl_awal > $tgl_akhir ) {
			//		$this->session->set_flashdata("save_loker","Mohon isi form dengan benar");
			//		header('location:'.base_url().'adminb3/loker/data_loker');	
			//	} else {
					 $data_loker=array(
					'kdkategoriloker'=>$kdkategoriloker,
					'loker'=>$loker,
					'ket'=>$ket,
		          //  'tgl_awal'=>$tgl_awal,
		        //    'tgl_akhir'=>$tgl_akhir,
					'created_at'=>$created_at,
		            'created_by'=>$kdlogin
					);
				$dt=array_merge($data_loker);
				$this->db->insert('m_loker',$dt);
				$this->session->set_flashdata("save_loker","Data berhasil Ditambah");
				header('location:'.base_url().'adminb3/loker/data_loker');	
				
			//	}
				
				
			  			
			}
	}

	public function edit($kdloker=0)
	{
		
		if(isset($_POST['submit']))
        {
			date_default_timezone_set("Asia/Jakarta"); 
		    $update_at=date("Y-m-d h:i:s");
		    $kdlogin=$this->session->userdata('kdlogin');
		    $kdloker=$this->input->post('kdloker');
		    $kdkategoriloker=$this->input->post('kdkategoriloker');
			$loker=$this->input->post('loker');
			$ket=$this->input->post('ket');
			$tgl_awal=$this->input->post('tgl_awal');
			$tgl_akhir=$this->input->post('tgl_akhir');
			$status=$this->input->post('status');
			 
			//if ($tgl_awal > $tgl_akhir ) {
			//		$this->session->set_flashdata("save_loker","Mohon isi form dengan benar");
		//			header('location:'.base_url().'adminb3/loker/data_loker');	
		//		} else {
						$data_loker=array(
							'kdkategoriloker'=>$kdkategoriloker,
					            'loker'=>$loker,
					            'ket'=>$ket,
					          //  'tgl_awal'=>$tgl_awal,
					         //   'tgl_akhir'=>$tgl_akhir,
					            'status'=>$status,
		                	 	'update_at'=>$update_at,
		                	 	'update_by'=>$kdlogin
		                	 	);
		            $this->db->where('kdloker', $kdloker);
	        		$this->db->update('m_loker', $data_loker);
	        		$this->session->set_flashdata('save_loker', "data berhasil disimpan");
			        header('location:'.base_url().'adminb3/loker/data_loker');
				
		//		}
			   
			   	
        }
         else
        {
        	$data['st'] = $this->loker_model->st;		
         	$data['title']	= $this->title;	
			$page			= "edit";
			$data['dt_kategoriloker']=$this->db->get_where('m_kategoriloker',array('status' => 1 ));								
			$data['edit'] = $this->loker_model->edit($kdloker)->row();				
			$this->template($page,$data);	
        }
		
			
	}

	
}
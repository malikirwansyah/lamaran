 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	var $folder =   "home";
 

	function __construct()
    {
        parent::__construct();
        $this->load->library(array('Recaptcha'));
        $this->load->model('register_model');
        $this->load->helper('string');
    }

    protected function template($page,$data)
	{
		$this->load->view('home/header',$data);	
		$this->load->view($this->folder."/".$page);				
		$this->load->view('home/footer');
		
	}

	public function index()
	{
		redirect('app/login');
	}

	public function login()
	{
		if($this->session->userdata('masuk_in')=="")
		{
			$this->form_validation->set_rules('noktp', 'No ktp', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$recaptcha = $this->input->post('g-recaptcha-response');
       		$response = $this->recaptcha->verifyResponse($recaptcha);
			//if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
			if ($this->form_validation->run() == FALSE ) 
			{
				$data['title']	= "User Authentication-RS. Baiturrahim Jambi";
				$page="login";	
				$data['captcha']	= $this->recaptcha->getWidget();
				$data['script_captcha'] = $this->recaptcha->getScriptTag();	
				$this->template($page,$data);
			}
			else
			{
				$dt['noktp'] = $this->input->post('noktp');
				$dt['password'] = $this->input->post('password');
				$this->register_model->getLoginData($dt);
			}
		}	

		else if($this->session->userdata('masuk_in')!="" )
		{
			header('location:'.base_url().'user/home/home','refresh');
		}
	
		
	}	

	public function register()
	{

				$data['title']	= "Registrasi User-RS. Baiturrahim Jambi";
				$page="register";	
				$data['captcha']	= $this->recaptcha->getWidget();
				$data['script_captcha'] = $this->recaptcha->getScriptTag();	
				$this->template($page,$data);
 		
	}	

	public function save_register()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
       	$response = $this->recaptcha->verifyResponse($recaptcha);
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('noktp', 'No ktp', 'trim|required');
		if ($this->form_validation->run() == FALSE ) 
			{
				$this->session->set_flashdata('result_login', "lengkapi form");
				header('location:'.base_url().'app/register','refresh');
			}
		else{

			$simpan["noktp"] = $this->input->post("noktp");
			if($this->register_model->cek($simpan["noktp"])==0)
			{
				date_default_timezone_set("Asia/Jakarta");
				$tgl=date("ymd");
				$created_at=date("Y-m-d h:i:s");
				$kode=$this->register_model->buat_kode($tgl);
				$noktp=$this->input->post('noktp');
				$password=$this->input->post('password');
				$nama_lengkap=$this->input->post('nama_lengkap');
				$kirim=$this->input->post('email');
				$encrypted_id=sha1($kode);

				if(!preg_match ('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU',$kirim))
				{
					$this->session->set_flashdata('result_login', "Maaf,alamat email yang anda dimasukkan tidak valid");
					header('location:'.base_url().'app/register','refresh');
				}
				else
				{
					$config = $this->config->item('setting_email');
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
								
					

					$htmlContent = '<p>Sdr/i, <b>'.$nama_lengkap.'</b></p>';
					$htmlContent .= '<p>Terimakasih telah melakukan registrasi di e-Recruitment <b>RS BAITURRAHIM Jambi</b></p>';
					$htmlContent .= '<p>Silahkan menuju link berikut untuk aktivasi akun anda</b></p>';
					$htmlContent .= '<p>'.base_url().'app/verification/'.$encrypted_id.'</p>';
					$htmlContent .= '<p>Salam,</p>';
					$htmlContent .= '<p>Recruitment Team</p>';
					$htmlContent .= '<p>RS BAITURRAHIM JAMBI</p>';
					

					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('csbaiturrahim@gmail.com');
					$list = array($kirim);
					$this->email->to($list);
					$this->email->subject("Aktivasi Sistem e-Recruitment RS BAITURRAHIM Jambi");
					$this->email->message($htmlContent);

					if($this->email->send())
						{
							 $data_regis=array(
								'kduser_regis'=>$kode,
								'noktp'=>$noktp,
								'password'=>$password,
								'email'=>$kirim,
								'tgl_regis'=>$created_at,
								'nama_lengkap'=>$nama_lengkap,
								'kode_aktivasi'=>$encrypted_id,
								'created_at'=>$created_at
								);
							$dt=array_merge($data_regis);
							$this->db->insert('m_user_regis',$dt);
							$this->session->set_flashdata('result_login', "Silahkan cek email anda untuk aktifasi akun");
							header('location:'.base_url().'app/register','refresh');
						}
					else
						{
							$this->session->set_flashdata('result_login', "Gagal mengirim email, mohon registrasi kembali dengan email yang valid");
							header('location:'.base_url().'app/register','refresh');
						}
				}
			}
			else
				{
					$this->session->set_flashdata("result_login","
					<p style='text-align:center; margin:0px;'> Maaf, anda sudah terdaftar</p>");
					header('location:'.base_url().'app/register','refresh');
				}
			
			}		
	}	

public function forgot()
	{
		if(isset($_POST['submit']))
        {

				$recaptcha = $this->input->post('g-recaptcha-response');
		       	$response = $this->recaptcha->verifyResponse($recaptcha);
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				
				//if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) 
				if ($this->form_validation->run() == FALSE ) 
					{
						$this->session->set_flashdata('result_login', "lengkapi form");
						header('location:'.base_url().'app/forgot','refresh');
					}
				else{

					$simpan["email"] = $this->input->post("email");
					//email kosong
					if($this->register_model->cek_email($simpan["email"])==0)
						{
							$this->session->set_flashdata("result_login","
							<p style='text-align:center; margin:0px;'> Maaf, email anda tidak terdaftar</p>");
							header('location:'.base_url().'app/forgot','refresh');
						}
					//email ada
					else
						{
							date_default_timezone_set("Asia/Jakarta");
							$update_at=date("Y-m-d h:i:s");
							$kirim=$this->input->post('email');
							$kode=$this->register_model->ambil_kode($kirim);
							$encrypted_id=sha1($kode);
							echo $encrypted_id;
							//email tidak valid
							if(!preg_match ('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU',$kirim))
							{
								$this->session->set_flashdata('result_login', "Maaf,alamat email yang anda dimasukkan tidak valid");
								header('location:'.base_url().'app/forgot','refresh');
							}
							//email valid
							else
							{
								$config = $this->config->item('setting_email');
								$this->load->library('email', $config);
								$this->email->set_newline("\r\n");
											
								
								$htmlContent .= '<p>We received a request to change your password </p>';
								$htmlContent .= '<p>Click the link below to set new password </b></p>';
								$htmlContent .= '<p>'.base_url().'app/new_pasword/'.$encrypted_id.'</p>';
								$htmlContent .= '<p>if you dont want to change your password,you can ignore this email.</b></p>';
								$htmlContent .= '<p>Thanks,</p>';
								$htmlContent .= '<p>Recruitment Team</p>';
								$htmlContent .= '<p>RS BAITURRAHIM JAMBI</p>';
								

								$this->email->initialize($config);
								$this->email->set_newline("\r\n");
								$this->email->from('csbaiturrahim@gmail.com');
								$list = array($kirim);
								$this->email->to($list);
								$this->email->subject("New password - Sistem e-Recruitment RS BAITURRAHIM Jambi");
								$this->email->message($htmlContent);

								if($this->email->send())
								{
									 
									$this->session->set_flashdata('result_login', "Silahkan cek email anda untuk password baru anda");
									header('location:'.base_url().'app/forgot','refresh');
								}
								else
								{
									$this->session->set_flashdata('result_login', "Gagal mengirim email");
									header('location:'.base_url().'app/forgot','refresh');
								}
								

							}
						}
					
					}
		}
         else
        {
         	$data['title']	= "Forgot Password-RS. Baiturrahim Jambi";
			$page="forgot";	
			$data['captcha']	= $this->recaptcha->getWidget();
			$data['script_captcha'] = $this->recaptcha->getScriptTag();	
			$this->template($page,$data);	
        }		
	}

	function new_pasword($kode_aktivasi=0)
	{
		
		if (!$data['row']=$this->register_model->kode_password($kode_aktivasi)) 
      	{
      		header('location:'.base_url().'app/login','refresh');
      		
        
      	}
    //jika  ada  
	    else
	    {

	    	date_default_timezone_set("Asia/Jakarta");
			$update_at=date("Y-m-d h:i:s");
	    	$password=random_string('alnum', 8);
	    	$kirim=$this->register_model->ambil_email($kode_aktivasi);
	    	
			$config = $this->config->item('setting_email');
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			
			echo $password;
			$htmlContent .= '<p>New your password is <b>'.$password.'</b></p>';
			$htmlContent .= '<p>Salam,</p>';
			$htmlContent .= '<p>Recruitment Team</p>';
			$htmlContent .= '<p>RS BAITURRAHIM JAMBI</p>';
					

			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('csbaiturrahim@gmail.com');
			$list = array($kirim);
			$this->email->to($list);
			$this->email->subject("New Password Sistem e-Recruitment RS BAITURRAHIM Jambi");
			$this->email->message($htmlContent);

			if($this->email->send())
			{
									 
				$dt = array(
				'update_at' => $update_at,
				'password' => $password
				 );
				$this->db->where('kode_aktivasi', $kode_aktivasi);
			    $this->db->update('m_user_regis', $dt);

			    $this->session->set_flashdata('result_login', "Silahkan cek email anda untuk mendapatkan password ");
				header('location:'.base_url().'app/login','refresh'); 
			}
			else
			{
				$this->session->set_flashdata('result_login', "Gagal coba lagi");
				header('location:'.base_url().'app/login','refresh');
			}

			
		    
	    } 

		
		
	}
	
	function verification($kode_aktivasi=0)
	{

		date_default_timezone_set("Asia/Jakarta");
		$created_at=date("Y-m-d h:i:s");
		$dt = array(
		'tglactive_regis' => $created_at,
		 'status_kode' => 1
		 );
		$this->db->where('kode_aktivasi', $kode_aktivasi);
	    $this->db->update('m_user_regis', $dt); 
	    $this->session->set_flashdata('result_login', "Akun anda telah aktif, silahkan login");
		header('location:'.base_url().'app/login','refresh');
		
	}

	function logout($kdlogin=0)
	{
		date_default_timezone_set("Asia/Jakarta");
		$last_logout =  date('Y-m-d h:i:s');
	    $data_logout=array('last_logout'=>$last_logout);
	    $this->db->where('kdlogin', $kdlogin);
        $this->db->update('m_login', $data_logout);
		$this->session->sess_destroy();
		header('location:'.base_url().'','refresh');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {


  var $folder =   "user/master/pendidikan";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Pendidikan";

  
  function __construct(){
    parent::__construct();
      $this->load->model('user/pendidikan_model');    
  }

  protected function template($page,$data)
  {
    if($this->session->userdata('masuk_in')!=""){
      $this->load->view('user/header',$data);     
       $this->load->view($this->fkiri."/".$this->kiri);
      $this->load->view($this->folder."/".$page);   
      $this->load->view('user/footer');
    }else{

      header('location:'.base_url().'');
    }
    
  }

  public function index()
  {
    if($this->session->userdata('masuk_in')!=""){
      redirect('user/pendidikan/data_pendidikan');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_pendidikan($kdregis=0)
  {
      $kdregis=$this->session->userdata('kdregis'); 
      $data['title']  = $this->title;                      
      $data['judul']  = $this->title;
     
      $data['dt_pendidikan']=$this->db->get('m_pendidikan');
      
      $page     = "home";   
      
      if (!$data['row']=$this->pendidikan_model->cek_kode($kdregis)) {
       $this->template($page,$data); 
      } else {
        //ada
        $data['edit'] = $this->pendidikan_model->edit($kdregis)->row();  
        $this->template($page,$data); 
      }
     
  }

  public function simpan()
  {
    $kdregis=$this->session->userdata('kdregis');
    if (!$data['row']=$this->pendidikan_model->cek_kode($kdregis))
    //jika data tidak ada 
    {
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('kdpendidikan', 'Pendidikan', 'trim|required');
    $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    $this->form_validation->set_rules('tgl_awal', 'Start', 'trim|required');
    $this->form_validation->set_rules('tgl_akhir', 'End', 'trim|required');
    if($this->form_validation->run() == FALSE)
      {
              
        $this->session->set_flashdata('save_pendidikan', "Lengkapi Form");
        header('location:'.base_url().'user/pendidikan/data_pendidikan');
      }
      else
      {

        date_default_timezone_set("Asia/Jakarta");
        $created_at=date("Y-m-d h:i:s");
        $update_at=date("Y-m-d h:i:s");
        $kdregis=$this->session->userdata('kdregis'); 

        //pendidikan
        $kdpendidikan=$this->input->post('kdpendidikan');
        $nama=$this->input->post('nama');
        $nilai=$this->input->post('nilai');
        $alamat=$this->input->post('alamat');
        $tgl_awal=$this->input->post('tgl_awal');
        $tgl_akhir=$this->input->post('tgl_akhir');
        $nilai=$this->input->post('nilai');
        
        if ($tgl_awal > $tgl_akhir) 
        //jika data salah
        {
          $this->session->set_flashdata('save_pendidikan', "Mohon diisi dengan benar");
          header('location:'.base_url().'user/pendidikan/data_pendidikan');  
        }
        //jika data benar 
        else 
        {
            $config['upload_path']          = './foto_ijazah/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 200;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file1'))
              {
                $this->session->set_flashdata('save_pendidikan', "Ukuran Maksimum file 200kb,<br/>
                                  File yang diizinkan untuk upload .jpg, .jpeg, .png");
                header('location:'.base_url().'user/pendidikan/data_pendidikan');

              }
            
            else
              {
                $this->upload->do_upload('file1');
                $file1 = $this->upload->data();
                $foto=$file1['orig_name'];
                $dt_pendidikan=array(
                  'kduser_regis'=>$kdregis,
                  'kdpendidikan'=>$kdpendidikan,'nama'=>$nama,
                  'nilai'=>$nilai,'alamat'=>$alamat,
                  'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,
                  'foto'=>$foto,           
                  'created_at'=>$created_at,
                  'created_by'=>$kdregis
                );
                
                $dt=array_merge($dt_pendidikan);
                $this->db->insert('m_user_pendidikan ',$dt);

                $this->session->set_flashdata('save_pendidikan', "Data berhasil disimpan");
                header('location:'.base_url().'user/pendidikan/data_pendidikan');   
              }  
        }
        

           

               
      }

    }
    //jika data ada   
    else 
      {
       header('location:'.base_url().'user/pendidikan/data_pendidikan');  
      } 


    
  }

  public function edit()
  {
    $kdregis=$this->session->userdata('kdregis');
    if (!$data['row']=$this->pendidikan_model->cek_kode($kdregis)) 
    {
      //jika tidak ada
     header('location:'.base_url().'user/pendidikan/data_pendidikan');

    }
    //jika data ada   
    else 
    {
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('kdpendidikan', 'Pendidikan', 'trim|required');
    $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    $this->form_validation->set_rules('tgl_awal', 'Start', 'trim|required');
    $this->form_validation->set_rules('tgl_akhir', 'End', 'trim|required');
    if($this->form_validation->run() == FALSE)
      {
              
        $this->session->set_flashdata('save_pendidikan', "Lengkapi Form");
        header('location:'.base_url().'user/pendidikan/data_pendidikan');
      }
      else
      {

        date_default_timezone_set("Asia/Jakarta");
        $created_at=date("Y-m-d h:i:s");
        $update_at=date("Y-m-d h:i:s");
        $kdregis=$this->session->userdata('kdregis'); 

        //user
        
        $kdpendidikan=$this->input->post('kdpendidikan');
        $nama=$this->input->post('nama');
        $nilai=$this->input->post('nilai');
        $alamat=$this->input->post('alamat');
        $tgl_awal=$this->input->post('tgl_awal');
        $tgl_akhir=$this->input->post('tgl_akhir');
        $nilai=$this->input->post('nilai');

        if ($tgl_awal > $tgl_akhir) 
        //jika data salah
        {
          $this->session->set_flashdata('save_pendidikan', "Mohon diisi dengan benar");
          header('location:'.base_url().'user/pendidikan/data_pendidikan');  
        }
        //jika data benar 
        else 
        {

            $config['upload_path']          = './foto_ijazah/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 200;
            $this->load->library('upload', $config);

                //file 1 ada 
                if (($_FILES['file1']['name']) )
                {
                  if ( ! $this->upload->do_upload('file1'))
                  {
                    $this->session->set_flashdata('save_pendidikan', "Ukuran Maksimum file 200kb,<br/>
                                  File yang diizinkan untuk upload .jpg, .jpeg, .png");
                    header('location:'.base_url().'user/pendidikan/data_pendidikan'); 
                  }
                  else
                  {
                    $this->upload->do_upload('file1');
                    $file1 = $this->upload->data();
                    $foto=$file1['orig_name'];

                    $dt_pendidikan=array(
                     
                      'kdpendidikan'=>$kdpendidikan,'nama'=>$nama,
                      'nilai'=>$nilai,'alamat'=>$alamat,
                      'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,'foto'=>$foto,      
                      'update_at'=>$update_at,
                      'update_by'=>$kdregis
                    );

                    $this->db->where('kduser_regis', $kdregis);
                    $this->db->update('m_user_pendidikan', $dt_pendidikan);
                    $this->session->set_flashdata('save_pendidikan', "Data berhasil disimpan");
                    header('location:'.base_url().'user/pendidikan/data_pendidikan');   
                  }
                }
                elseif(empty($_FILES['file1']['name']))
                {
                  $dt_pendidikan=array(
                    
                      'kdpendidikan'=>$kdpendidikan,'nama'=>$nama,
                      'nilai'=>$nilai,'alamat'=>$alamat,
                      'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,         
                      'update_at'=>$update_at,
                      'update_by'=>$kdregis
                    );
                      $this->db->where('kduser_regis', $kdregis);
                      $this->db->update('m_user_pendidikan', $dt_pendidikan);
                      $this->session->set_flashdata('save_pendidikan', "Data berhasil disimpan");
                      header('location:'.base_url().'user/pendidikan/data_pendidikan');   
                } 
        }  



 

               
      }   
    } 


    
  }

  
}
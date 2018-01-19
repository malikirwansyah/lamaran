<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {


  var $folder =   "user/master/profil";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Profil";

  
  function __construct(){
    parent::__construct();
      $this->load->model('user/profil_model');    
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
      redirect('user/profil/data_profil');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_profil($kdregis=0)
  {
      $kdregis=$this->session->userdata('kdregis'); 
      $data['title']  = $this->title;                      
      $data['judul']  = $this->title;
      $data['st_jk'] = $this->profil_model->st_jk;
      $data['dt_agama']=$this->db->get('m_agama');
      $data['dt_pernikahan']=$this->db->get('m_status_pernikahan');
      $page     = "home";   
      
      if (!$data['row']=$this->profil_model->cek_kode($kdregis)) {
       $this->template($page,$data); 
      } else {
        //ada
        $data['edit'] = $this->profil_model->edit($kdregis)->row();  
        $this->template($page,$data); 
      }
     
  }

  public function simpan()
  {
    $kdregis=$this->session->userdata('kdregis');
    if (!$data['row']=$this->profil_model->cek_kode($kdregis)) 
    {
  //    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
    $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
    $this->form_validation->set_rules('kdagama', 'agama', 'trim|required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
    $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'trim|required');
    $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    $this->form_validation->set_rules('hp', 'HP', 'trim|required');
    $this->form_validation->set_rules('kdstatus_pernikahan', 'Status Pernikahan', 'trim|required');
    if($this->form_validation->run() == FALSE)
      {
              
        $this->session->set_flashdata('save_profil', "Lengkapi Form");
        header('location:'.base_url().'user/profil/data_profil');
      }
      else
      {

        date_default_timezone_set("Asia/Jakarta");
        $created_at=date("Y-m-d h:i:s");
        $update_at=date("Y-m-d h:i:s");
        $kdregis=$this->session->userdata('kdregis'); 

        //user
        
        $nama_lengkap=$this->input->post('nama_lengkap');
        //profil
        $tempat_lahir=$this->input->post('tempat_lahir');
        $tgl_lahir=$this->input->post('tgl_lahir');
        $jk=$this->input->post('jk');
        $kdagama=$this->input->post('kdagama');
        $tinggi_badan=$this->input->post('tinggi_badan');
        $berat_badan=$this->input->post('berat_badan');
        $alamat=$this->input->post('alamat');
        $hp=$this->input->post('hp');
        $kdstatus_pernikahan=$this->input->post('kdstatus_pernikahan');

        $config['upload_path']          = './foto_user/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 200;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file1'))
          {
            $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
            header('location:'.base_url().'user/profil/data_profil');

          }
        elseif( ! $this->upload->do_upload('file2'))
          {
            $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
            header('location:'.base_url().'user/profil/data_profil');
          }
        else
          {
            $this->upload->do_upload('file1');
            $file1 = $this->upload->data();
            $foto=$file1['orig_name'];

            $this->upload->do_upload('file2');
            $file2 = $this->upload->data();
            $foto_ktp=$file2['orig_name'];

           // $data_user=array(
             // 'nama_lengkap'=>$nama_lengkap,
              //'update_at'=>$update_at,
              //'update_by'=>$kdregis
             // );
           // $this->db->where('kduser_regis', $kdregis);
           // $this->db->update('m_user_regis', $data_user);
           
            $dt_profil=array(
              'kduser_regis'=>$kdregis,
              'tempat_lahir'=>$tempat_lahir,'tgl_lahir'=>$tgl_lahir,
              'jk'=>$jk,'kdagama'=>$kdagama,
              'tinggi_badan'=>$tinggi_badan,'berat_badan'=>$berat_badan,
              'alamat'=>$alamat,'hp'=>$hp,
              'kdstatus_pernikahan'=>$kdstatus_pernikahan,'foto'=>$foto,
              'foto_ktp'=>$foto_ktp,              
              'created_at'=>$created_at,
              'created_by'=>$kdregis
            );
            
            $dt=array_merge($dt_profil);
            $this->db->insert('m_user_profil ',$dt);

            $this->session->set_flashdata('save_profil', "Data berhasil disimpan");
            header('location:'.base_url().'user/profil/data_profil');   
          }     

               
      }

    }
    //ada   
    else 
      {
       header('location:'.base_url().'user/profil/data_profil'); 
      } 


    
  }

  public function edit()
  {
    $kdregis=$this->session->userdata('kdregis');
    if (!$data['row']=$this->profil_model->cek_kode($kdregis)) 
    {
      //jika tidak ada
     header('location:'.base_url().'user/profil/data_profil');

    }
    //ada   
    else 
    {
   //   $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
    $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
    $this->form_validation->set_rules('kdagama', 'agama', 'trim|required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
    $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'trim|required');
    $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    $this->form_validation->set_rules('hp', 'HP', 'trim|required');
    $this->form_validation->set_rules('kdstatus_pernikahan', 'Status Pernikahan', 'trim|required');
    if($this->form_validation->run() == FALSE)
      {
              
        $this->session->set_flashdata('save_profil', "Lengkapi Form");
        header('location:'.base_url().'user/profil/data_profil');
      }
      else
      {

        date_default_timezone_set("Asia/Jakarta");
        $created_at=date("Y-m-d h:i:s");
        $update_at=date("Y-m-d h:i:s");
        $kdregis=$this->session->userdata('kdregis'); 

        //user
        
        $nama_lengkap=$this->input->post('nama_lengkap');
        //profil
        $tempat_lahir=$this->input->post('tempat_lahir');
        $tgl_lahir=$this->input->post('tgl_lahir');
        $jk=$this->input->post('jk');
        $kdagama=$this->input->post('kdagama');
        $tinggi_badan=$this->input->post('tinggi_badan');
        $berat_badan=$this->input->post('berat_badan');
        $alamat=$this->input->post('alamat');
        $hp=$this->input->post('hp');
        $kdstatus_pernikahan=$this->input->post('kdstatus_pernikahan');

        $config['upload_path']          = './foto_user/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 200;
        $this->load->library('upload', $config);

            //file 1 ada file 2 kosong
            if (($_FILES['file1']['name'])&&empty($_FILES['file2']['name']) )
            {
              if ( ! $this->upload->do_upload('file1'))
              {
                $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
                header('location:'.base_url().'user/profil/data_profil'); 
              }
              else
              {
                $this->upload->do_upload('file1');
                $file1 = $this->upload->data();
                $foto=$file1['orig_name'];
                $dt_profil=array(
                  'kduser_regis'=>$kdregis,
                  'tempat_lahir'=>$tempat_lahir,'tgl_lahir'=>$tgl_lahir,
                  'jk'=>$jk,'kdagama'=>$kdagama,
                  'tinggi_badan'=>$tinggi_badan,'berat_badan'=>$berat_badan,
                  'alamat'=>$alamat,'hp'=>$hp,
                  'kdstatus_pernikahan'=>$kdstatus_pernikahan,'foto'=>$foto,          
                  'update_at'=>$update_at,
                  'update_by'=>$kdregis
                );
                $this->db->where('kduser_regis', $kdregis);
                $this->db->update('m_user_profil', $dt_profil);
                $this->session->set_flashdata('save_profil', "Data berhasil disimpan");
                header('location:'.base_url().'user/profil/data_profil');   
              }
            }
            //file 2 ada file 1 kosong
            elseif (($_FILES['file2']['name'])&&empty($_FILES['file1']['name']))
            {
              if ( ! $this->upload->do_upload('file2'))
              {
                $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
                header('location:'.base_url().'user/profil/data_profil'); 
              }
              else
              {
                $this->upload->do_upload('file2');
                $file2 = $this->upload->data();
                $foto_ktp=$file2['orig_name'];
                $dt_profil=array(
                  'kduser_regis'=>$kdregis,
                  'tempat_lahir'=>$tempat_lahir,'tgl_lahir'=>$tgl_lahir,
                  'jk'=>$jk,'kdagama'=>$kdagama,
                  'tinggi_badan'=>$tinggi_badan,'berat_badan'=>$berat_badan,
                  'alamat'=>$alamat,'hp'=>$hp,
                  'kdstatus_pernikahan'=>$kdstatus_pernikahan,
                  'foto_ktp'=>$foto_ktp,              
                  'update_at'=>$update_at,
                  'update_by'=>$kdregis
                );
                $this->db->where('kduser_regis', $kdregis);
                $this->db->update('m_user_profil', $dt_profil);
                $this->session->set_flashdata('save_profil', "Data berhasil disimpan");
                header('location:'.base_url().'user/profil/data_profil');   
              } 
            }
            //jika ada file 1 dan file 2
            elseif (($_FILES['file1']['name'])&&($_FILES['file2']['name'])) 
            {
              if ( ! $this->upload->do_upload('file1'))
              {
                $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
                header('location:'.base_url().'user/profil/data_profil'); 
              }
              elseif(! $this->upload->do_upload('file2'))
              {
                $this->session->set_flashdata('save_profil', "Ukuran Maksimum file 200kb,<br/>
                              File yang diizinkan untuk upload .jpg, .jpeg, .png");
                header('location:'.base_url().'user/profil/data_profil'); 
              }
              else
              {
                 $this->upload->do_upload('file1');
                  $file1 = $this->upload->data();
                  $foto=$file1['orig_name'];

                  $this->upload->do_upload('file2');
                  $file2 = $this->upload->data();
                  $foto_ktp=$file2['orig_name'];

                
                  $dt_profil=array(
                    'kduser_regis'=>$kdregis,
                    'tempat_lahir'=>$tempat_lahir,'tgl_lahir'=>$tgl_lahir,
                    'jk'=>$jk,'kdagama'=>$kdagama,
                    'tinggi_badan'=>$tinggi_badan,'berat_badan'=>$berat_badan,
                    'alamat'=>$alamat,'hp'=>$hp,
                    'kdstatus_pernikahan'=>$kdstatus_pernikahan,'foto'=>$foto,
                    'foto_ktp'=>$foto_ktp,              
                    'update_at'=>$update_at,
                    'update_by'=>$kdregis
                  );
                  $this->db->where('kduser_regis', $kdregis);
                  $this->db->update('m_user_profil', $dt_profil);
                  $this->session->set_flashdata('save_profil', "Data berhasil disimpan");
                  header('location:'.base_url().'user/profil/data_profil');   
              }
            }
            else
            {
                
                  $dt_profil=array(
                   
                    'tempat_lahir'=>$tempat_lahir,'tgl_lahir'=>$tgl_lahir,
                    'jk'=>$jk,'kdagama'=>$kdagama,
                    'tinggi_badan'=>$tinggi_badan,'berat_badan'=>$berat_badan,
                    'alamat'=>$alamat,'hp'=>$hp,
                    'kdstatus_pernikahan'=>$kdstatus_pernikahan,
                    'update_at'=>$update_at,
                    'update_by'=>$kdregis
                  );
                  $this->db->where('kduser_regis', $kdregis);
                  $this->db->update('m_user_profil', $dt_profil);
                  $this->session->set_flashdata('save_profil', "Data berhasil disimpan");
                  header('location:'.base_url().'user/profil/data_profil');   
            }  

               
      }   
    } 


    
  }

  
}
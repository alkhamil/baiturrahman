<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/pengaturan_web/Berita_model');
    }

	public function index()
	{
        $data['title'] = 'Berita';
        $data['isi'] = 'admin/pengaturan_web/berita/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/pengaturan_web/berita/simpan');
        $data['data'] = base_url('admin/pengaturan_web/berita/data');
        $data['get'] = base_url('admin/pengaturan_web/berita/get_data');
        $data['hapus'] = base_url('admin/pengaturan_web/berita/hapus');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Berita_model->lists(
            '*',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['image'] = $ls['image'];
				$row['name'] = $ls['name'];
				$row['posted_date'] = date('d-m-Y H:i:s', strtotime($ls['posted_date']));
				$row['desc'] = $ls['desc'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Berita_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Berita_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $select = "*";
        $data['berita'] = $this->Berita_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {

        $image = null;
        // image
        if($_FILES['image']['tmp_name']) {
            $image_data = $this->upload_data('image');
            if(isset($image_data['type']) && $image_data['type'] == 'error') {
                $msg = $image_data;
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/pengaturan_web/berita'), 'refresh');
                exit;
            }
            $image = base_url('assets/uploads/').$image_data['file_name'];
        }

        $savedata['name'] = $this->input->post('name', TRUE);
        $savedata['posted_date'] = date('Y-m-d H:i:s');
        $savedata['desc'] = $this->input->post('desc', TRUE);
        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
            $berita = $this->Berita_model->get(['id'=>$this->input->post('id')]);
            if ($image) {
                $image_path = substr($berita->image, strlen(base_url()));
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $savedata['image'] = $image;
            }else {
                $savedata['image'] = $berita->image;
            }
			$this->Berita_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
            if ($image) {
                $savedata['image'] = $image;
            }
            $this->Berita_model->insert($savedata);
        }

        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $msg = array(
                'type' => 'error',
                'msg' => 'Data tidak berhasil disimpan',
            );
        }else {
            $this->db->trans_commit();
            $msg = array(
                'type' => 'success',
                'msg' => 'Data Berhasil disimpan',
            );
        }
        $this->session->set_flashdata('msg', $msg);
        
        redirect(base_url('admin/pengaturan_web/berita'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Berita_model->delete($where);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $msg = array(
                'type' => 'error',
                'msg' => 'Data tidak terhapus.',
            );
        }else{
            $this->db->trans_commit();
            $msg = array(
                'type' => 'success',
                'msg' => 'Data berhasil terhapus.',
            );
        }
        echo json_encode($msg);
    }

    public function upload_data($field_name)
    {
        $config['upload_path']          = './assets/uploads';
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['max_size']             = 2048; // 2mb

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload($field_name)) {
            $error = [
                'error' => $this->upload->display_errors()
            ];
            return [
                'type' => 'error',
                'msg' => strip_tags($error['error'])
            ];
        }else {
            return $this->upload->data();
        }
    }
}

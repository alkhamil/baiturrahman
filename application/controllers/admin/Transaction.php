<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Transaction_model');
    }

	public function index()
	{
        $data['title'] = 'Transaksi';
        $data['isi'] = 'admin/transaction/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/transaction/simpan');
        $data['data'] = base_url('admin/transaction/data');
        $data['get'] = base_url('admin/transaction/get_data');
        $data['hapus'] = base_url('admin/transaction/hapus');
        $data['cetak'] = base_url('admin/transaction/cetak');
        $data['select_trans_type'] = base_url('admin/transaction/select_trans_type');
        $data['select_zakat_type'] = base_url('admin/transaction/select_zakat_type');
        $data['select_jamaah'] = base_url('admin/transaction/select_jamaah');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        if ($this->input->post('filter_trans_type_id', TRUE)) {
            $where['t_transaction.trans_type_id'] = $this->input->post('filter_trans_type_id', TRUE);
        }
        if($this->input->post('filter_start_date', TRUE) && $this->input->post('filter_end_date', TRUE)) {
            if($this->input->post('filter_start_date', TRUE) == $this->input->post('filter_end_date', TRUE)) {
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') = "] = $this->input->post('filter_start_date', TRUE);
            } else {
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y')  >= "] = $this->input->post('filter_start_date', TRUE);
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') <= "] = $this->input->post('filter_end_date', TRUE);
            }
        } else {
            $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') = "] = date('d/m/Y');
        }
        $no = $this->input->post('start');
        $list = $this->Transaction_model->lists(
            '
                t_transaction.*,
                m_trans_type.name as trans_type,
                m_zakat_type.name as zakat_type,
                m_jamaah.name as jamaah_name
            ',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['created_date'] = date('d-M-Y', strtotime($ls['created_date']));
				$row['trans_type'] = $ls['trans_type'];
				$row['zakat_type'] = $ls['zakat_type'];
				$row['jamaah_name'] = $ls['jamaah_name'];
				$row['code'] = $ls['code'];
				$row['label'] = $ls['label'];
				$row['amount'] = $ls['amount'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Transaction_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Transaction_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['t_transaction.id'] = $this->input->get('id', TRUE);
        $select = "
            t_transaction.*,
            m_trans_type.id as trans_type_id,
            m_trans_type.name as trans_type_name,
            m_zakat_type.id as zakat_type_id,
            m_zakat_type.name as zakat_type_name,
            m_jamaah.id as jamaah_id,
            m_jamaah.name as jamaah_name
        ";
        $join = [
            [
                'table'     => 'm_trans_type',
                'on'        => 'm_trans_type.id = t_transaction.trans_type_id'
            ],
            [
                'table'     => 'm_zakat_type',
                'on'        => 'm_zakat_type.id = t_transaction.zakat_type_id'
            ],
            [
                'table'     => 'm_jamaah',
                'on'        => 'm_jamaah.id = t_transaction.jamaah_id'
            ]
        ];
        $data['transaction'] = $this->Transaction_model->get($where, $select, $join);
        
        echo json_encode($data);
    }

    public function cetak()
    {
        $where = [];
        $data['trans_type_name'] = null;
        if ($this->input->get('filter_trans_type_id', TRUE)) {
            $where['m_trans_type.id'] = $this->input->get('filter_trans_type_id', TRUE);
            $data['trans_type_name'] = $this->get_name('m_trans_type', $this->input->get('filter_trans_type_id', TRUE));
        }

        if($this->input->get('filter_start_date', TRUE) && $this->input->get('filter_end_date', TRUE)) {
            if($this->input->get('filter_start_date', TRUE) == $this->input->get('filter_end_date', TRUE)) {
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') = "] = $this->input->get('filter_start_date', TRUE);
            } else {
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y')  >= "] = $this->input->get('filter_start_date', TRUE);
                $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') <= "] = $this->input->get('filter_end_date', TRUE);
            }
            $data['start_date'] = date('d/m/Y', strtotime(str_replace('/', '-', $this->input->get('filter_start_date', TRUE))));
            $data['end_date'] = date('d/m/Y', strtotime(str_replace('/', '-', $this->input->get('filter_end_date', TRUE))));
        } else {
            $where["DATE_FORMAT(t_transaction.created_date, '%d/%m/%Y') = "] = date('d/m/Y');
        }
        
        $select = "
            t_transaction.*, 
            m_trans_type.name as trans_type_name,
            m_zakat_type.name as zakat_type_name,
            m_jamaah.name as jamaah_name
        ";
        $join = [
            [
                'table'     => 'm_trans_type',
                'on'        => 'm_trans_type.id = t_transaction.trans_type_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_zakat_type',
                'on'        => 'm_zakat_type.id = t_transaction.zakat_type_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_jamaah',
                'on'        => 'm_jamaah.id = t_transaction.jamaah_id',
                'type'      => 'left'
            ]
        ];
        $list = $this->Transaction_model->get_all($where, $select, $join);
        $data['data'] = $list;
        $data['title'] = 'Lampiran Transaksi';

        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $data['title'];
        $this->pdf->load_view('admin/transaction/cetak', $data);
    }

    public function get_name($table, $id)
    {
        $data = $this->db->get_where($table, ['id' => $id])->row();
        return $data->name;
    }

    public function simpan()
    {
        $savedata['trans_type_id'] = $this->input->post('trans_type_id', TRUE);
        $savedata['zakat_type_id'] = $this->input->post('zakat_type_id', TRUE);
        $savedata['jamaah_id'] = $this->input->post('jamaah_id', TRUE);
        $savedata['code'] = 'IN'.date('YmdHis');
        $savedata['label'] = $this->input->post('label', TRUE);
        $savedata['amount'] = $this->input->post('amount', TRUE);
        $savedata['desc'] = $this->input->post('desc', TRUE);
        $savedata['created_by'] = $this->userdata->id;
        $savedata['created_date'] = date('Y-m-d H:i:s');

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
            $trans_old = $this->Transaction_model->get(['t_transaction.id' => $this->input->post('id')]);
            $amount_old = $trans_old->amount;
            $this->increment_trans_saldo($savedata['trans_type_id'], $savedata['amount'], $amount_old);

			$this->Transaction_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
			$this->Transaction_model->insert($savedata);
            $this->increment_trans_saldo($savedata['trans_type_id'], $savedata['amount']);
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
        
        redirect(base_url('admin/transaction'), 'refresh');
    }

    public function increment_trans_saldo($trans_type_id, $amount, $amount_old = null)
    {
        $current = $this->db->get_where('m_trans_type', ['id' => $trans_type_id])->row();
        $where['id'] = $trans_type_id;
        if ($amount_old) {
            $savedata['saldo'] = $current->saldo - $amount_old;
            $this->db->where($where);
            $this->db->update('m_trans_type', $savedata);
            
            $current_edit = $this->db->get_where('m_trans_type', ['id' => $trans_type_id])->row();
            $savedata['saldo'] = $current_edit->saldo + $amount;
            $this->db->where($where);
            $this->db->update('m_trans_type', $savedata);
        } else {
            $savedata['saldo'] = $current->saldo + $amount;
            $this->db->where($where);
            $this->db->update('m_trans_type', $savedata);
        }
    }

    public function hapus()
    {
        $trans_current = $this->Transaction_model->get(['t_transaction.id' => $this->input->get('id')]);
        $current = $this->db->get_where('m_trans_type', ['id' => $trans_current->trans_type_id])->row();
        $savedata['saldo'] = $current->saldo - $trans_current->amount;
        $this->db->where(['id' => $trans_current->trans_type_id]);
        $this->db->update('m_trans_type', $savedata);
        
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Transaction_model->delete($where);

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

    public function select_trans_type()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Transaction_model->order_by = "id";
        $this->Transaction_model->order_type = "ASC";
        $this->Transaction_model->search_field = "name";
        $this->Transaction_model->column_search = "name";
        $this->Transaction_model->table = "m_trans_type";
        $data = $this->Transaction_model->list_select($q, $where);
        echo json_encode($data);
    }

    public function select_zakat_type()
    {
        $q = $this->input->get('q');
        $where['trans_type_id'] = $this->input->get('trans_type_id', TRUE);
        $this->Transaction_model->order_by = "id";
        $this->Transaction_model->order_type = "ASC";
        $this->Transaction_model->search_field = "name";
        $this->Transaction_model->column_search = "name";
        $this->Transaction_model->table = "m_zakat_type";
        $data = $this->Transaction_model->list_select($q, $where);
        echo json_encode($data);
    }

    public function select_jamaah()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Transaction_model->order_by = "id";
        $this->Transaction_model->order_type = "ASC";
        $this->Transaction_model->search_field = "name";
        $this->Transaction_model->column_search = "name";
        $this->Transaction_model->table = "m_jamaah";
        $data = $this->Transaction_model->list_select($q, $where);
        echo json_encode($data);
    }
}

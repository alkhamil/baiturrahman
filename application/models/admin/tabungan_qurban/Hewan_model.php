<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hewan_model extends CI_Model {

    public $table = 'm_hewan';
    public $primary_key = 'm_hewan.id';
    public $order_by = 'm_hewan.id';
    public $order_type = 'DESC';
    public $search_field = 'm_hewan.label';
    public $column_order = ['m_hewan.price', 'm_hewan.label', 'm_hewan_jenis.name', 'm_hewan_golongan.name']; //set column field database for datatable orderable
    public $column_search = ['m_hewan.price', 'm_hewan.label', 'm_hewan_jenis.name', 'm_hewan_golongan.name']; //set column field database for datatable searchable 

    public function __construct()
    {
        parent::__construct();
    }

    function lists($select = '*', $where = null, $limit = 10 ,$offset = 0)
    {
        $this->db->select($select)
                 ->join('m_hewan_jenis', 'm_hewan_jenis.id = m_hewan.hewan_jenis_id', 'left')
                 ->join('m_hewan_golongan', 'm_hewan_golongan.id = m_hewan.hewan_golongan_id', 'left')
                 ->limit($limit,$offset);

        if($where) {
            if(isset($where['q']) && $where['q'])
                $this->db->like("LOWER(".$this->search_field.")", $where['q']);
            else
                $this->db->where($where);
        }

        // Search for datatables
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($this->input->post('search')['value']) // if datatable send POST for search
            {
                    
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like("LOWER(".$item.")", strtolower($this->input->post('search')['value']));
                }
                else
                {
                    $this->db->or_like("LOWER(".$item.")", strtolower($this->input->post('search')['value']));
                }
    
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
            
        if($this->input->post('order')) // here order processing
        {
            if(isset($this->column_order[$this->input->post('order')['0']['column']]))
                $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        } else {
            $this->db->order_by($this->order_by, $this->order_type);
        }
         
        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    function list_count($where = null, $is_where = false) {
        $this->db->join('m_hewan_jenis', 'm_hewan_jenis.id = m_hewan.hewan_jenis_id', 'left')
                    ->join('m_hewan_golongan', 'm_hewan_golongan.id = m_hewan.hewan_golongan_id', 'left');

        if($is_where) {
            if($where) {
                if(isset($where['q']) && $where['q'])
                    $this->db->like("LOWER(".$this->search_field.")", $where['q']);
                else {
                    $this->db->where($where);
                }
            }
        }

        // Search for datatables
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($this->input->post('search')['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like("LOWER(".$item.")", strtolower($this->input->post('search')['value']));
                    
                }
                else
                {
                    $this->db->or_like("LOWER(".$item.")", strtolower($this->input->post('search')['value']));
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get($where, $select = '*', $join = null)
    {
        $this->db->select($select);
        if($where)
            $this->db->where($where);
            
        if($join) {
            if(is_array($join)) {
                foreach($join as $j) {
                    if(!isset($j['type'])) 
                        $type = 'default';
                    else
                        $type = $j['type'];

                    if($type == 'default')
                        $this->db->join($j['table'], $j['on']);
                    else
                        $this->db->join($j['table'], $j['on'], $j['type']);
                }
            }
        }
        if($this->order_by != '') {
            $this->db->order_by($this->order_by, $this->order_type);
        }

        $q = $this->db->get($this->table);
        return $q->row();
    }

    function get_all($where, $select = '*', $join = null)
    {
        $this->db->select($select);
        if($where)
            $this->db->where($where);
            
        if($join) {
            if(is_array($join)) {
                foreach($join as $j) {
                    if(!isset($j['type'])) 
                        $type = 'default';
                    else
                        $type = $j['type'];

                    if($type == 'default')
                        $this->db->join($j['table'], $j['on']);
                    else
                        $this->db->join($j['table'], $j['on'], $j['type']);
                }
            }
        }
        if($this->order_by != '') {
            $this->db->order_by($this->order_by, $this->order_type);
        }

        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    function list_select($q = null, $where = null, $select = '*', $limit = 10 ,$offset = 0)
    {
        $this->db->select($select)
                 ->order_by($this->order_by, $this->order_type)
                 ->limit($limit,$offset);

        if($where) {
            $this->db->where($where);
        }
        if($q) {
            $this->db->like("LOWER(".$this->search_field.")", strtolower($q));
        }
         
        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function update($data, $where, $where_type = 'default')
    {   
        if($where_type == 'where_in') { // where in
            foreach($where as $w) {
                $this->db->where_in($w['column'], $w['value']);
            }
        } else if($where_type == 'where_not_in') { // where not in
            foreach($where as $w) {
                $this->db->where_not_in($w['column'], $w['value']);
            }
        } else if($where_type == 'where_like') { // where like
            foreach($where as $w) {
                $this->db->like($w['column'], $w['value']);
            }
        } else { // where
            $this->db->where($where);
        }

        $q = $this->db->update($this->table, $data);
        return $q;
    }

    function delete($where=null, $where_type = 'default')
    {   
        if($where_type == 'where_in') { // where in
            foreach($where as $w) {
                $this->db->where_in($w['column'], $w['value']);
            }
        } else if($where_type == 'where_not_in') { // where not in
            foreach($where as $w) {
                $this->db->where_not_in($w['column'], $w['value']);
            }
        } else if($where_type == 'where_like') { // where like
            foreach($where as $w) {
                $this->db->like($w['column'], $w['value']);
            }
        } else { // where
            $this->db->where($where);
        }
        
        $q = $this->db->delete($this->table);
        return $q;
    }
    
}

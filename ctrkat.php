<?php defined('BASEPATH') OR exit('Sorry bro ! Jangan kaya gini make webnya...');

class Ctrkat extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('m_kategori');
    }
    
    function index(){
        
        
        $data = array();
        $data['ambil'] = $this->m_kategori->tampilkat();
        $this->load->view('back/viewkat', $data);
        
    }
    
    function tambah(){
        
        $data = array();
        $data['nmkat'] = array('name' => 'nmkat');
        $data['deskat'] = array('name' => 'deskat');
        
        $this->load->view('back/viewkat', $data);
        
    }
    
    function masuk(){
        
        $base = $this->input->post('nmkat');
        
        $hapus = preg_replace('/[^\da-z ]/i', '', $base); // Ieu paraqgi ng hapus spesial karakter terkecuali spasi
        $replace = str_replace(" ", "-", $hapus); // Ieu paragi ngaganti spasi jadi strip
        $kecil = strtolower($replace); // Ieu mah paragi ng leutikan huruf
        
        $nmkat = $this->input->post('nmkat');
        $deskat = $this->input->post('deskat');
        $data = array('nmkat' => $nmkat, 'slugkat' => $kecil, 'deskat' => $deskat);
        
        $this->m_kategori->isikat($data);
        
        if ($this->db->trans_status() === FALSE){
            echo 'Data tidak masuk';
        }else{
            echo 'Data berhasil masuk';
        }
        
        
    }
    
    function edit(){
        
        $id = $this->uri->segment(4);
        
        $data = array();
        $data['ambil'] = $this->m_kategori->editkat();
        $data['idkat'] = array('idkat' => $id);
        $data['nmkat'] = array('name' => 'nmkat');
        $data['slugkat'] = array('name' => 'slugkat');
        $data['deskat'] = array('name' => 'deskat');
        
        $this->load->view('back/viewkat', $data);
        
    }
    
    function update(){
        
        $data = $this->input->post(array('idkat', 'nmkat', 'slugkat', 'deskat'));        
        $this->m_kategori->isiedit($data);
        
        if($this->db->trans_status() === FALSE){
            redirect('admin/ctrkat/edit/'.$this->uri->segment(4), 'refresh');
        }else{
            redirect('admin/ctrkat', 'refresh');
        }
    }
    
    function hapus(){
        
        $id = $this->uri->segment(4);
        $this->m_kategori->hapuskat($id);
        
        if($this->db->trans_status() === FALSE){
            redirect('admin/ctrkat', 'refresh');
        }else{            
            redirect('admin/ctrkat', 'refresh');
        }
       
    }
    
    function detil(){
        
        $id = $this->uri->segment(3);
        
        $data = array();
        $data['ambil'] = $this->m_kategori->detil();
        $data['idkat'] = array('slugkat' => $id);
               
        $this->load->view('back/viewkat', $data);
        
    }
    
    public function _remap(){ // Fungsi ieu penting pisan kudu di pake unggal nyieunweb
        
        $data = $this->uri->segment(3);
        
        if (empty($data))
        {
                $this->index();
        }
        else if($data === 'tambah')
        {
                $this->tambah();
        }
        else if($data === 'masuk')
        {
                $this->masuk();
        }
        else if($data === 'edit')
        {
                $this->edit();
        }
        else if($data === 'hapus')
        {
                $this->hapus();
        }
        else if($data === 'update')
        {
                $this->update();            
        }
        else{
                $this->detil();
        }
        
    }
}
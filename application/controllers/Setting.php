<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $this->cart->destroy();
        $query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang ORDER BY tb_customer.ruang_lingkup")->result();
        $q    = $this->all->get_all('tb_ruang_lingkup');
        $data = array('data_filter' => $q,
                      'data_kab'    => $this->all->get_all('kabupaten'),
                      'data_cust'   => $query,
                      'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
                      'menu'        => 'Menu Pelanggan',
                      'content'     => 'Admin/customer/data_customer');
        $this->load->view('layout/wrapper', $data);
    }

}

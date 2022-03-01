<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $data = array('data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                      'menu'      => 'FILTER RUTE DALAM & LUAR KOTA',
                      'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                      'content'   => 'Admin/filter/filter_rute');
        $this->load->view('layout/wrapper', $data);
    }

    
    public function input_data_filter() {
        $kode = $this->input->post('kode_toko', true);
        $pjg  = strlen($kode);
        if($pjg == 1) {
            $record = '00000'.$kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00000'.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');               } 
            }
        } elseif($pjg == 2) {
             $record = '0000'.$kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%$record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                    $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
           } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0000'.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                  } 
            }
        } elseif($pjg == 3) {
            $record = '000'.$kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%$record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 000'.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                } 
            }
        }elseif($pjg == 4) {
            $record = '00'.$kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%$record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                    $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00'.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                } 
            }
        }
        elseif($pjg == 5) {
            $record = '0'.$kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%$record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                     $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0'.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                } 
            }
        } elseif($pjg == 6) {
            $record = $kode;
            $query = $this->db->query("SELECT * FROM tb_filter_data WHERE kode_toko LIKE '%$record%'")->row();
            if($query != NULL) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Telah Disimpan, tanyakan kepada Order Entry, apakah orderan dirilis 2 kali</div>');
                $data = array('data_cust' => $query,
                              'data_filter' => $this->db->query("SELECT * FROM tb_filter_data")->result(),
                              'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                              'menu'      => 'Filter Rute dalam dan Luar Kota',
                              'content'   => 'Admin/filter/sudah_ada');
                     $this->load->view('layout/wrapper', $data);
            } else {
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko' => $get_data->kode_toko,
                                  'nama_toko' => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'    => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                } 
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Kode Customer yang diinput melebihi 6 digit</div>');
            redirect(base_url('filter'), 'refresh');
        }
    }

    
    public function input_data_ganda() {
        $kode = $this->input->post('kode_toko', true);
        $pjg  = strlen($kode);
        if($pjg == 1) {
            $record = '00000'.$kode;
            $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
            if($get_data != NULL) {
                $data = array('kode_toko'     => $get_data->kode_toko,
                              'nama_toko'     => $get_data->nama_toko,
                              'ruang_lingkup' => $get_data->ruang_lingkup,
                              'id_kab'        => $get_data->id_kab);
                $this->all->in($data, 'tb_filter_data');
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('filter'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                redirect(base_url('filter'), 'refresh');
            } 
        } elseif($pjg == 2) {
            $record = '0000'.$kode;
            $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
            if($get_data != NULL) {
                $data = array('kode_toko'     => $get_data->kode_toko,
                              'nama_toko'     => $get_data->nama_toko,
                              'ruang_lingkup' => $get_data->ruang_lingkup,
                              'id_kab'        => $get_data->id_kab);
                $this->all->in($data, 'tb_filter_data');
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('filter'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                redirect(base_url('filter'), 'refresh');
            } 
        }elseif($pjg == 3) {
            $record = '000'.$kode;
            $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
            if($get_data != NULL) {
                $data = array('kode_toko'     => $get_data->kode_toko,
                              'nama_toko'     => $get_data->nama_toko,
                              'ruang_lingkup' => $get_data->ruang_lingkup,
                              'id_kab'        => $get_data->id_kab);
                $this->all->in($data, 'tb_filter_data');
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('filter'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                redirect(base_url('filter'), 'refresh');
            } 
        }elseif($pjg == 4) {
            $record = '00'.$kode;
            $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
            if($get_data != NULL) {
                $data = array('kode_toko'     => $get_data->kode_toko,
                              'nama_toko'     => $get_data->nama_toko,
                              'ruang_lingkup' => $get_data->ruang_lingkup,
                              'id_kab'        => $get_data->id_kab);
                $this->all->in($data, 'tb_filter_data');
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                redirect(base_url('filter'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                redirect(base_url('filter'), 'refresh');
               } 
            }
        else {
            $record = '0'.$kode;
                $get_data = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$record%'")->row();
                if($get_data != NULL) {
                    $data = array('kode_toko'     => $get_data->kode_toko,
                                  'nama_toko'     => $get_data->nama_toko,
                                  'ruang_lingkup' => $get_data->ruang_lingkup,
                                  'id_kab'        => $get_data->id_kab);
                    $this->all->in($data, 'tb_filter_data');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('filter'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko '.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                } 
           }
        }

        public function filter_wilayah() {
            if(isset($_POST['filter'])) {
                $kode  = $this->input->post('kode_ruang', true);
                $query = $this->all->get_result(array('ruang_lingkup' => $kode), 'tb_filter_data');
                if($query != NULL) {
                    $data = array('data_filter' => $query,
                                  'menu'        => 'Filter Rute dalam atau Luar Kota',
                                  'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
                                  'content'     => 'Admin/filter/filter_rute');
                   $this->load->view('layout/wrapper', $data);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">>Kode Toko '.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('filter'), 'refresh');
                }
            }
        }

        public function input_aco() {
          $no_aco = $this->input->post('no_aco', true);
          $data = $this->all->get_all('tb_filter_data');
          $get_all_filter = count($data);
        foreach($data as $d) {
            $aco[]  = $d->no_urut;
            for($i = 0; $i < count($aco); $i++) { 
                $no = $no_aco + $i;
                $updt = $this->all->edit(array('no_aco' => $no), 'tb_filter_data', array('no_urut' => $d->no_urut));
            }
        }
        $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Berhasil Disetting</div>');
        redirect(base_url('filter'), 'refresh');
    }


    public function delt_toko($no_urut) {
        $get_data = $this->all->get(array('no_urut' => $no_urut), 'tb_filter_data');
        if($get_data == false) {
            $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data tidak ditemukan</div>');
            redirect(base_url('filter'), 'refresh');
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Toko Berhasil Dihapus</div>');
            $data = $this->all->delt(array('no_urut' => $no_urut), 'tb_filter_data');
            redirect(base_url('filter'), 'refresh');
        }
    }

    public function delt() {
        $this->db->query("DELETE FROM tb_filter_data");
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
        redirect(base_url('filter'), 'refresh');
    }

    public function delta($id_kab) {
        $this->all->delt(array('id_kab' => $id_kab), 'tb_filter_data');
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
        redirect(base_url('filter/cluster'), 'refresh');
    }

    public function cluster() {
        $data = $this->db->query("SELECT DISTINCT ruang_lingkup FROM tb_filter_data")->result();
        if($data != NULL) {
            $data = array('data_filter' => $data,
                          'data_kab'  => $this->all->get_all('kabupaten'),
                          'menu'      => 'Pengelompokkan Ruang Lingkup',
                          'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                          'content'   => 'Admin/filter/cluster');
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
            redirect(base_url('Main/'), 'refresh');
        }
    }

    public function all_area() {
        if(isset($_POST['filter_area'])) {
            $get_id = $this->input->post('kode_kab', true);
            $get = $this->all->get_result(array('id_kab' => $get_id), 'tb_filter_data');
            $data = array('data_filter' => $get,
                          'data_kab'  => $this->all->get_all('kabupaten'),
                          'id_kab'    => $get_id,
                          'menu'      => 'Filter Rute dalam atau Luar Kota',
                          'lingkup'   => $this->all->get_all('tb_ruang_lingkup'),
                          'content'   => 'Admin/filter/filter_kab');
            $this->load->view('layout/wrapper', $data);
        } else {

        }
    }
    
    public function detail($kode_ruang) {
        $query = $this->db->query("SELECT * FROM ((tb_filter_data INNER JOIN tb_ruang_lingkup ON tb_filter_data.ruang_lingkup = tb_ruang_lingkup.kode_ruang) INNER JOIN tb_customer ON tb_filter_data.kode_toko = tb_customer.kode_toko) WHERE tb_filter_data.ruang_lingkup = '$kode_ruang' ORDER BY tb_filter_data.no_urut ASC")->result();
        if($query != NULL) {
            $data = array('data_cust' => $query,
                          'menu'      => 'Detail Toko',
                          'content'   => 'Admin/filter/detail');
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
            redirect(base_url('Area/detail/'.$kode_ruang), 'refresh');
        }
    }

    public function del_cluster($kode_ruang) {
        $this->db->query("DELETE FROM tb_filter_data WHERE ruang_lingkup = '$kode_ruang'");
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Cluster Telah Dihapus</div>');
        redirect(base_url('Filter/cluster'), 'refresh');
    }
}
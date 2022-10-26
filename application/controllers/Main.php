<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('All_model', 'all');
	}

	public function destroy()
	{
		return session_destroy();
	}

	public function index()
	{
		$this->cart->destroy();
		$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang ORDER BY tb_customer.ruang_lingkup")->result();
		$q    = $this->all->get_all('tb_ruang_lingkup');
		$data = array(
			'data_filter' => $q,
			'data_kab'    => $this->all->get_all('kabupaten'),
			'data_cust'   => $query,
			'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
			'menu'        => 'Menu Pelanggan',
			'content'     => 'Admin/customer/data_customer'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_toko()
	{
		if (isset($_POST['tambah_toko'])) {
			$kode = $this->input->post('kode_toko', true);
			$query = $this->all->get(array('kode_toko' => $kode), 'tb_customer');
			if ($query != NULL) {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Telah Digunakan</div>');
				redirect(base_url('Main/'), 'refresh');
			} else {
				$data = array(
					'kode_toko'     => $kode,
					'nama_toko'     => $this->input->post('nama_toko', true),
					'alamat'        => $this->input->post('alamat', true),
					'ruang_lingkup' => $this->input->post('ruang_lingkup', true),
					'id_kab'        => $this->input->post('id_kab', true),
					'set_wilayah'   => 1,
					'setting_disc'  => 'No'
				);
				$this->all->in($data, 'tb_customer');
				$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		}
	}

	public function edit_customer($kd_toko)
	{
		if (isset($_POST['edittoko'])) {
			$ambil_kode  = $this->all->get(array('kode_toko' => $kd_toko), 'tb_customer');
			$data_filter = $this->all->get(array('kode_toko' => $kd_toko), 'tb_filter_data');
			if ($ambil_kode != FALSE) {
				if ($data_filter != FALSE) {
					$ruang = $this->input->post('ruang_lingkup', true);
					$data = array(
						'kode_toko' => $kd_toko,
						'nama_toko' => $this->input->post('nama_toko', true),
						'alamat'    => $this->input->post('alamat', true),
						'ruang_lingkup' => $ruang,
						'id_kab'    => $this->input->post('id_kab', true),
						'geotag'    => $this->input->post('geotag', true)
					);
					$this->all->edit($data, 'tb_customer', array('kode_toko' => $kd_toko));
					$this->all->edit(array('ruang_lingkup' => $ruang), 'tb_filter_data', array('kode_toko' => $kd_toko));
					$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Diubah</div>');
					redirect(base_url('Main/redirec/' . $kd_toko), 'refresh');
				} else {
					$data = array(
						'kode_toko'     => $kd_toko,
						'nama_toko'     => $this->input->post('nama_toko', true),
						'alamat'        => $this->input->post('alamat', true),
						'ruang_lingkup' => $this->input->post('ruang_lingkup', true),
						'id_kab'        => $this->input->post('id_kab', true),
						'geotag'        => $this->input->post('geotag', true)
					);
					$this->all->edit($data, 'tb_customer', array('kode_toko' => $kd_toko));
					$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Diubah</div>');
					redirect(base_url('Main/redirec/' . $kd_toko), 'refresh');
				}
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Anda belum memilih kode toko</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		}
	}

	public function redirec($kode)
	{
		$pjg  = strlen($kode);
		if ($pjg == 1) {
			$record = '00000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 2) {
			$record = '0000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'menu'        => 'Menu Pelanggan',
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 3) {
			$record = '000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'menu'        => 'Menu Pelanggan',
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 4) {
			$record = '00' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 5) {
			$record = '0' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} else {
			$record = $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		}
	}

	public function filter_customer()
	{
		if (isset($_POST['filter'])) {
			$kode  = $this->input->post('kode_ruang', true);
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_customer.ruang_lingkup = '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_cust'   => $query,
					'data_filter' => $q,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'menu'        => 'Cari Toko Berdasarkan Wilayah',
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		}
	}

	public function cari_toko()
	{
		$kode = $this->input->post('kode_toko', true);
		$pjg  = strlen($kode);
		if ($pjg == 1) {
			$record = '00000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 2) {
			$record = '0000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'menu'        => 'Menu Pelanggan',
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 3) {
			$record = '000' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'menu'        => 'Menu Pelanggan',
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 000' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} elseif ($pjg == 4) {
			$record = '00' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 00' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		} else {
			$record = '0' . $kode;
			$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE kode_toko LIKE '%$record%' OR nama_toko LIKE '$kode'")->result();
			if ($query != NULL) {
				$q    = $this->all->get_all('tb_ruang_lingkup');
				$data = array(
					'data_filter' => $q,
					'data_cust'   => $query,
					'data_kab'    => $this->all->get_all('kabupaten'),
					'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
					'menu'        => 'Menu Pelanggan',
					'content'     => 'Admin/customer/data_customer'
				);
				$this->load->view('layout/wrapper', $data);
			} else {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Kode Toko 0' . $kode . ' Tidak Ditemukan</div>');
				redirect(base_url('Main/'), 'refresh');
			}
		}
	}

	public function csv()
	{
		if (!isset($_POST['import'])) {
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Maaf anda belum meilih data</div>');
			redirect(base_url('Main'), 'refresh');
		} else {
			$this->cart->destroy();
			$fileName = $_FILES["csv"]["tmp_name"];
			if ($_FILES["csv"]["size"] > 0) {
				$file = fopen($fileName, "r");
				while (($column = fgetcsv($file, 10000, ",")) !== false) {
					$query = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko = '$column[0]'")->row();
					if ($query != NULL) {
						$data = array(
							'id'      => $query->kode_toko,
							'qty'     => 1,
							'price'   => 1,
							'name'    => $query->nama_toko,
							'options' => array(
								'alamat'        => $query->alamat,
								'ruang_lingkup' => $query->ruang_lingkup
							)
						);
						$this->cart->insert($data);
					} elseif ($query == NULL) {
						$data = array(
							'kode_toko'      => $column[0],
							'nama_toko'      => $column[1],
							'alamat'         => $column[2],
							'ruang_lingkup'  => $column[3],
							'set_wilayah'    => 1
						);
						$this->all->in($data, 'tb_customer');
					}
				}
				if (!empty($this->cart->contents())) {
					$this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Ganda terdeteksi</div>');
					redirect(base_url('Main'), 'refresh');
				} else {
					$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
					redirect(base_url('Main'), 'refresh');
				}
			}
		}
	}

	public function delt_cust()
	{
		$this->db->query("DELETE FROM tb_customer");
		$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
		redirect(base_url('Main/'), 'refresh');
	}

	public function kwitansi()
	{
		$data = array(
			'menu'        => 'Menu Pelanggan',
			'content'     => 'Admin/wilayah/kwitansi1'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function settingDisc($kode)
	{
		$cust = $this->all->get(array('kode_toko' => $kode), 'tb_customer');
		if ($cust != NULL) {
			$this->all->edit(array('setting_disc' => 'Yes'), 'tb_customer', array('kode_toko' => $kode));
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Di Setting</div>');
			redirect(base_url('Main/filterSetting/' . $cust->ruang_lingkup), 'refresh');
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Main'), 'refresh');
		}
	}

	public function noDisc($kode)
	{
		$cust = $this->all->get(array('kode_toko' => $kode), 'tb_customer');
		if ($cust != NULL) {
			$this->all->edit(array('setting_disc' => 'No'), 'tb_customer', array('kode_toko' => $kode));
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Di Setting</div>');
			redirect(base_url('Main/filterSetting/' . $cust->ruang_lingkup), 'refresh');
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Main'), 'refresh');
		}
	}

	public function filterSetting($kode_ruang)
	{
		$query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_customer.ruang_lingkup = '$kode_ruang'")->result();
		if ($query != NULL) {
			$q    = $this->all->get_all('tb_ruang_lingkup');
			$data = array(
				'data_cust'   => $query,
				'data_filter' => $q,
				'menu'        => 'Cari Toko Berdasarkan Wilayah',
				'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
				'content'     => 'Admin/customer/data_customer'
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Main/'), 'refresh');
		}
	}

	public function customer()
	{
		return $this->db->query("SELECT * FROM tb_filter_data")->result();
	}
}

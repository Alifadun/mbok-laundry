<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin();

        $this->user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user;
        $data['tampilan'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->user;

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->user;

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    public function laundry($id = null)
    {
        $this->load->model('laundry_model');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if (is_null($id)) {
            $data['title'] = 'Data Laundry';
            $data['datalaundry'] = $this->laundry_model->ambil_semua_laundry();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/laundry', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Detail Laundry';
            $data['datalaundry'] = $this->laundry_model->ambil_satu_laundry($id);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/detaillaundry', $data);
            $this->load->view('templates/footer');
        }
    }

    public function catatlaundry()
    {
        $this->load->model('laundry_model');

        $data['title'] = 'Catat laundry';
        $data['user'] = $this->user;
        $data['paket'] = $this->laundry_model->ambil_semua_paket();
        $data['users'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

        $this->form_validation->set_rules('jmlpakaian', 'jmlpakaian', 'required');
        $this->form_validation->set_rules('jmlberat', 'jmlberat', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/catatlaundry', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
                'jumlah_pakaian' => htmlspecialchars($this->input->post('jmlpakaian', true)),
                'jumlah_berat' => htmlspecialchars($this->input->post('jmlberat', true)),
                'id_paket' => htmlspecialchars($this->input->post('id_paket', true)),
                'status_laundry' => htmlspecialchars($this->input->post('status_laundry', true)),
                'status_pembayaran' => htmlspecialchars($this->input->post('status_pembayaran', true)),
                'tanggal' => date('Y-m-d')
            ];
            if ($data['jumlah_pakaian'] > 100) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah melebihi batas!</div>');
                redirect('admin/laundry');
            } else {
                $this->db->insert('data_laundry', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
                redirect('admin/laundry');
            }
        }
    }

    public function updateLaundry()
    {
        $this->load->model('laundry_model');

        $id = $this->input->post('id_laundry');
        $data = [
            'status_laundry' => $this->input->post('status_laundry'),
            'status_pembayaran' => $this->input->post('status_pembayaran')
        ];

        $proses = $this->laundry_model->update_laundry($data, $id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah paket!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah paket!</div>');
        }

        redirect('admin/laundry/');
    }

    public function invoice()
    {
        $this->load->model('laundry_model');

        $id = $this->input->post('id_laundry');

        if (is_null($id)) {
            redirect('admin/laundry/');
        }

        $data['title'] = "Invoice";
        $data['datalaundry'] = $this->laundry_model->ambil_satu_laundry($id);
        $this->load->view('templates/header', $data);
        $this->load->view('invoice', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses berhasil diubah!</div>');
    }

    // Pesan
    public function pesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->user;

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_semua_pesan()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->user;
        $data = [
            'user_id' => $user['id'],
            'isi_pesan' => $this->input->post('isi_pesan'),
            'status' => 'Open',
            'tanggal' => date("Y-m-d H:i:s")
        ];

        $proses = $this->pesan_model->tambah_pesan($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan pesan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pesan!</div>');
        }

        redirect('admin/pesan');
    }

    public function detailPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->user;

        $id = $this->uri->segment('3');

        $data = [
            'title' => 'Pesan',
            'user' => $user,
            'pesan' =>  $this->pesan_model->ambil_detail_pesan_user($id),
            'detailPesan' => $this->pesan_model->detail_balasan_pesan($id)
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function balasPesan()
    {
        $this->load->model('pesan_model');
        $user =
            $this->user;
        $data = [
            'user_id' => $user['id'],
            'pesan_id' => $this->input->post('pesan_id'),
            'isi_balasan' => $this->input->post('isi_balasan'),
            'tanggal' => date("Y-m-d H:i:s")
        ];

        $proses = $this->pesan_model->balas_pesan($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan pesan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pesan!</div>');
        }

        redirect('user/detailPesan/' . $this->input->post('pesan_id'));
    }

    public function tutupPesan()
    {
        $this->load->model('pesan_model');
        $data = [
            'status' => 'Selesai'
        ];
        $id = $this->input->post('pesan_id');

        $proses = $this->pesan_model->tutup_pesan($data, $id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan selesai.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pesan gagal selesai.</div>');
        }

        redirect('admin/pesan');
    }

    // Paket Laundry
    public function paket()
    {
        $this->load->model('laundry_model');

        $user = $this->user;

        $data = [
            'title' => 'Paket Laundry',
            'user' => $user,
            'paket' => $this->laundry_model->ambil_semua_paket()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/paket', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPaket()
    {
        $this->load->model('laundry_model');

        $data = [
            'nama_paket' => $this->input->post('nama_paket'),
            'harga_paket' => $this->input->post('harga_paket'),
            'keterangan_paket' => $this->input->post('keterangan_paket')
        ];

        $proses = $this->laundry_model->tambah_paket($data);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan paket!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan paket!</div>');
        }

        redirect('admin/paket');
    }

    public function ubahPaket()
    {
        $this->load->model('laundry_model');

        $id = $this->input->post('id_paket');
        $data = [
            'nama_paket' => $this->input->post('nama_paket'),
            'harga_paket' => $this->input->post('harga_paket'),
            'keterangan_paket' => $this->input->post('keterangan_paket')
        ];

        $proses = $this->laundry_model->ubah_paket($data, $id);

        if ($proses) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah paket!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah paket!</div>');
        }

        redirect('admin/paket');
    }
}

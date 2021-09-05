<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }
    public function catatlaundry()
    {
        $data['title'] = 'Catat laundry';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
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
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama', true)),
                'jumlah_pakaian' => htmlspecialchars($this->input->post('jmlpakaian', true)),
                'jumlah_berat' => htmlspecialchars($this->input->post('jmlberat', true)),
                'harga' => htmlspecialchars($this->input->post('jmlharga', true)),
                'tanggal' => date('Y-m-d')
            ];
            if (!preg_match("/^[a-zA-Z]*$/", $data['nama_pelanggan'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak boleh ada angka!</div>');
                redirect('admin/catatlaundry');
            } else {
                if ($data['jumlah_pakaian'] > 100) {    
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah melebihi batas!</div>');
                    redirect('admin/catatlaundry');
                } else {

                    $this->db->insert('data_laundry', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect('admin/catatlaundry');
                }
            }
        }
    }
    public function hargalaundry()
    {
        $data['title'] = 'Catat harga laundry';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/hargalaundry', $data);
        $this->load->view('templates/footer');
        /*$this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jmlpakaian', 'jmlpakaian', 'required');
        $this->form_validation->set_rules('jmlberat', 'jmlberat', 'required');
        if ($this->form_validation->run() == false) {
        } else {
            $data = [
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama', true)),
                'jumlah_pakaian' => htmlspecialchars($this->input->post('jmlpakaian', true)),
                'jumlah_berat' => htmlspecialchars($this->input->post('jmlberat', true))
            ];
            $this->db->insert('data_laundry', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
            redirect('admin/catatlaundry');
        }*/
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
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
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
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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
            $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function datalaundry()
    {
        $data['title'] = 'View Laundry';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['datalaundry'] = $this->db->get('data_laundry')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/datalaundry', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // jika ada gambar yang akan diupload 
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat profil anda berhasil diubah!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi saat ini salah!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi tidak boleh sama!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah yang bener 
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }


    public function hapusDataLaundry()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->delete('data_laundry');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data!</div>');
        redirect('user/datalaundry');
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
            'pesan' =>  $this->pesan_model->ambil_semua_pesan_user($user['id'])
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPesan() {
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
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pesan!</div>');
        }

        redirect('admin/pesan');
    }

    public function detailPesan() {
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

    public function balasPesan() {
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

    public function tutupPesan() {
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

        redirect('user/pesan');
    }
}

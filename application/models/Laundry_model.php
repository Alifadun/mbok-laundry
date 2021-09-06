<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laundry_model extends CI_Model
{
    // Paket
    public function ambil_semua_paket()
    {
        return $this->db->get('paket_laundry')->result_array();
    }

    public function tambah_paket($data)
    {
        return $this->db->insert('paket_laundry', $data);
    }

    public function ubah_paket($data, $id)
    {
        $this->db->where('id_paket', $id);
        return $this->db->update('paket_laundry', $data);
    }

    public function ambil_semua_laundry()
    {
        $this->db->from('data_laundry')
            ->join('paket_laundry', 'data_laundry.id_paket = paket_laundry.id_paket', 'left')
            ->join('user', 'data_laundry.id_pelanggan = user.id', 'left');
        return $this->db->get()->result_array();
    }

    public function ambil_satu_laundry($id)
    {
        $this->db->from('data_laundry')
            ->join('paket_laundry', 'data_laundry.id_paket = paket_laundry.id_paket', 'left')
            ->join('user', 'data_laundry.id_pelanggan = user.id', 'left')
            ->where('data_laundry.id', $id);
        return $this->db->get()->row_array();
    }

    public function update_laundry($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('data_laundry', $data);
    }

    public function ambil_laundry_user($id)
    {
        $this->db->from('data_laundry')
            ->join('paket_laundry', 'data_laundry.id_paket = paket_laundry.id_paket', 'left')
            ->join('user', 'data_laundry.id_pelanggan = user.id', 'left')
            ->where('user.id', $id);
        return $this->db->get()->result_array();
    }
    
    public function laundry_selesai($id) {
        $this->db->from('data_laundry')
            ->where('status_laundry', 'Selesai')
            ->where('id_pelanggan', $id);
        return $this->db->get()->result_array();
    }

    public function laundry_belum_lunas($id) {
        $this->db->from('data_laundry')
            ->where('status_pembayaran', 'Belum Lunas')
            ->where('id_pelanggan', $id);
        return $this->db->get()->result_array();
    }
}

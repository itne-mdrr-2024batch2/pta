<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mKelolaData extends CI_Model
{
    //kategori
    public function select_pegawai()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        return $this->db->get()->result();
    }
    public function insert_pegawai($data)
    {
        $this->db->insert('pegawai', $data);
    }
    public function updatekategori($id, $data)
    {
        $this->db->where('nip_pegawai', $id);
        $this->db->update('pegawai', $data);
    }
    public function deletepegawai($id)
    {
        $this->db->where('nip_pegawai', $id);
        $this->db->delete('pegawai');
    }

    //barang
    public function select_tablet()
    {
        $this->db->select('*');
        $this->db->from('tablet');
        return $this->db->get()->result();
    }
    public function insert_tablet($data)
    {
        $this->db->insert('tablet', $data);
    }
    public function updatetablet($id, $data)
    {
        $this->db->where('imei_tab', $id);
        $this->db->update('tablet', $data);
    }
    public function deletetablet($id)
    {
        $this->db->where('imei_tab', $id);
        $this->db->delete('tablet');
    }

    //transaksi
    public function select_transaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        return $this->db->get()->result();
    }
    public function insert_transaksi($data)
    {
        $this->db->insert('transaksi', $data);
    }
    public function updatetransaksi($id, $data)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi', $data);
    }
    public function deletetransaksi($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('transaksi');
    }

    //user
    public function select_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->result();
    }
    public function insert_user($data)
    {
        $this->db->insert('user', $data);
    }
    public function updateuser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }
    public function delete($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
	 // Metode untuk mengambil semua data tablet berdasarkan IMEI
	 public function get_all_tablets()
	 {
		 $this->db->select('imei_tab');
		 $this->db->from('tablet'); // Sesuaikan nama tabel dengan nama tabel tablet di database Anda
		 return $this->db->get()->result();
	 }
 
	 // Metode untuk mengambil semua data pegawai berdasarkan NIP
	 public function get_all_pegawai()
	 {
		 $this->db->select('nip_pegawai');
		 $this->db->from('pegawai'); // Sesuaikan nama tabel dengan nama tabel pegawai di database Anda
		 return $this->db->get()->result();
	 }
	 public function get_user_by_id($user_id)
{
    return $this->db->get_where('user', ['id' => $user_id])->row();
}

}

/* End of file mKelolaData.php */

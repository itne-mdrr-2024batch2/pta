<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mDashboard extends CI_Model
{
    public function total()
    {
        // Data untuk info box lain yang sudah ada
        $data = array(
            'monitoring' => (object) ['jml_monitoring' => $this->db->count_all('monitoring')],
            'pengajuan' => (object) ['jml_pengajuan' => $this->db->count_all('pengajuan')],
            'asset' => (object) ['jml_asset' => $this->db->count_all('asset')],
            'user' => (object) ['jml_user' => $this->db->count_all('user')],
            'berfungsi' => (object) ['jml_berfungsi' => $this->get_berfungsi_count()],
            'tidak_berfungsi' => (object) ['jml_tidak_berfungsi' => $this->get_tidak_berfungsi_count()]
        );
        return $data;
    }

    private function get_berfungsi_count()
    {
        // Query untuk jumlah aset yang berfungsi
        $this->db->where('status', 'berfungsi'); // Sesuaikan dengan kondisi status "berfungsi" pada tabel
        $this->db->from('asset'); // Nama tabel yang sesuai
        return $this->db->count_all_results();
    }

    private function get_tidak_berfungsi_count()
    {
        // Query untuk jumlah aset yang tidak berfungsi
        $this->db->where('status', 'tidak_berfungsi'); // Sesuaikan dengan kondisi status "tidak berfungsi"
        $this->db->from('asset');
        return $this->db->count_all_results();
    }
}


/* End of file mDashboard.php */

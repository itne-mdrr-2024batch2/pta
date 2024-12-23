<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        check_and_refresh_token();
        check_role(['SUPER']);
    }

    public function index()
    {
        $token = $this->session->userdata('accessToken');

        // Pastikan token tersedia
        if (!$token) {
            $this->session->set_flashdata('error', 'Anda belum login!');
            redirect('cAuth');
        }

        // Siapkan header untuk request
        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        // URL API transaksi
        $apiUrlTransaksi = $this->config->item('api_url') . '/transaksi/counts';

        // CURL untuk transaksi
        $chTransaksi = curl_init($apiUrlTransaksi);
        curl_setopt($chTransaksi, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chTransaksi, CURLOPT_HTTPHEADER, $headers);

        $responseTransaksi = curl_exec($chTransaksi);
        curl_close($chTransaksi);

        // Decode respons transaksi
        $transaksi = json_decode($responseTransaksi, true);

        // Default jika transaksi gagal
        $data['transaksi'] = $transaksi ?: [
            'kondisi' => ['BERFUNGSI' => 0, 'TIDAK_BERFUNGSI' => 0],
            'status' => ['LENGKAP' => 0, 'TIDAK_LENGKAP' => 0],
            'transaksi' => ['PENERIMAAN' => 0, 'PENGEMBALIAN' => 0],
        ];

        // URL API tab count
        $apiUrlTabCount = $this->config->item('api_url') . '/tab/count';

        // CURL untuk tab count
        $chTabCount = curl_init($apiUrlTabCount);
        curl_setopt($chTabCount, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chTabCount, CURLOPT_HTTPHEADER, $headers);

        $responseTabCount = curl_exec($chTabCount);
        curl_close($chTabCount);

        // Decode respons tab count
        $tabCounts = json_decode($responseTabCount, true);

        // Default jika tab count gagal
        $data['tabCounts'] = $tabCounts ?: [
            'total' => 0,
            'SAMSUNG_GALAXY_TAB_S8_5G' => 0,
            'SAMSUNG_GALAXY_TAB_S7_PLUS' => 0,
        ];

        // Tampilkan view dengan data
        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/vDashboard', $data);
        $this->load->view('Super/Layout/footer');
    }
}

/* End of file cDashboard.php */

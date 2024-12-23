<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        check_and_refresh_token();
        check_role(['ADMIN']);
    }

    public function index()
    {
        $token = $this->session->userdata('accessToken'); // Ambil token dari sesi

        // Pastikan token tersedia
        if (!$token) {
            $this->session->set_flashdata('error', 'Anda belum login!');
            redirect('/');
        }

        // Siapkan header untuk request
        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $apiUrl = $this->config->item('api_url') . '/transaksi/counts';

        // Inisialisasi CURL untuk mendapatkan data dari API
        $ch = curl_init($apiUrl);
        // curl_setopt($ch, CURLOPT_URL, 'http://localhost:3000/transaksi/counts');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode respons JSON menjadi array
        $transaksi = json_decode($response, true);

        // Kirim data ke view jika respons valid, atau set sebagai array kosong
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
        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/vDashboard', $data);
        $this->load->view('Admin/Layout/footer');
    }

    public function update_activity()
    {
        $this->session->set_userdata('lastActivity', time());
        echo json_encode(['status' => 'success']);
    }
}


/* End of file cDashboard.php */
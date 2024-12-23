<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class cKelolaData extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        check_and_refresh_token();
        check_role(['VIEWER']);
    }


    public function pegawai()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/pegawai/';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $pegawaiData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($pegawaiData)) {
            $pegawaiData = [];
        }

        $data = array(
            'pegawai' => json_decode($response, true)
        );

        $this->load->view('User/Layout/head');
        $this->load->view('User/Layout/aside');
        $this->load->view('User/Pegawai/vpegawai', $data);
        $this->load->view('User/Layout/footer');
    }

    //device
    public function tablet()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/tab/';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $tabletData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($tabletData)) {
            $tabletData = [];
        }

        $data = array(
            'tablet' => json_decode($response, true)
        );

        $this->load->view('User/Layout/head');
        $this->load->view('User/Layout/aside');
        $this->load->view('User/Tablet/vtablet', $data);
        $this->load->view('User/Layout/footer');
    }

    //transaksi
    public function transaksi()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/transaksi?tmt=asc';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode response, ensuring it's a valid array
        $transaksiData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($transaksiData)) {
            $transaksiData = []; // Use an empty array if the response is invalid
        }

        $data = array(
            'transaksi' => json_decode($response, true)
        );

        $this->load->view('User/Layout/head');
        $this->load->view('User/Layout/aside');
        $this->load->view('User/Transaksi/vtransaksi', $data);
        $this->load->view('User/Layout/footer');
    }

    // Profile
    public function profil()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user/me';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $profilData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($profilData)) {
            $profilData = []; // Set as an empty array if decoding fails
        }

        $data = array(
            'profil' => $profilData
        );


        $data = array(
            'profil' => json_decode($response, true)
        );

        $this->load->view('User/Layout/head');
        $this->load->view('User/Layout/aside');
        $this->load->view('User/Profil/vprofil', $data);
        $this->load->view('User/Layout/footer');
    }

    public function updatepassword()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user/me';

        $postData = json_encode(array(
            'oldPassword' => $this->input->post('oldPassword'),
            'newPassword' => $this->input->post('newPassword'),
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $this->session->set_flashdata('success', 'Password Berhasil Diganti!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengganti password. Silakan coba lagi.');
        }

        redirect('User/cKelolaData/profil');
    }
}
/* End of file cKelolaData.php */

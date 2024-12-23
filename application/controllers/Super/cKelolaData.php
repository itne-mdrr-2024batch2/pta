<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class cKelolaData extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        check_and_refresh_token();
        check_role(['SUPER']);
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

        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/Pegawai/vpegawai', $data);
        $this->load->view('Super/Layout/footer');
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

        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/Tablet/vtablet', $data);
        $this->load->view('Super/Layout/footer');
    }

    //user
    public function user()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user/';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = array(
            'user' => json_decode($response)
        );

        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/user/vuser', $data);
        $this->load->view('Super/Layout/footer');
    }

    public function createuser()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user';

        $postData = json_encode(array(
            'name' => $this->input->post('name'),
            'nomor_hp' => $this->input->post('nomor_hp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ));

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 201) {
            $this->session->set_flashdata('success', 'Data User Berhasil Disimpan!');
        } elseif ($httpCode == 409) {
            $this->session->set_flashdata('error', 'Email sudah digunakan. Silakan gunakan email yang lain.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data user. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/user');
    }

    public function updateuser($id)
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user/' . $id;

        // Ambil data dari form
        $data = array(
            'name' => $this->input->post('name'),
            'nomor_hp' => $this->input->post('nomor_hp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role')
        );

        // Jika password diisi, tambahkan ke $data
        if ($this->input->post('password') !== '') {
            $data['password'] = $this->input->post('password');
        }

        $postData = json_encode($data);

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
            $this->session->set_flashdata('success', 'Data User Berhasil Diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data user. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/user');
    }


    public function deleteuser($id)
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/user/' . $id;

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $this->session->set_flashdata('success', 'Data User Berhasil Dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data user. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/user');
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

        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/Transaksi/vtransaksi', $data);
        $this->load->view('Super/Layout/footer');
    }

    public function createtransaksi()
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/transaksi';

        $postData = json_encode(array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi')
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $this->session->set_flashdata('success', 'Data Transaksi Berhasil Disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data transaksi. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/transaksi');
    }

    public function updatetransaksi($id_transaksi)
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/transaksi/' . $id_transaksi;

        $postData = json_encode(array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi')
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
            $this->session->set_flashdata('success', 'Data Transaksi Berhasil Diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data transaksi. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/transaksi');
    }

    public function deletetransaksi($id_transaksi)
    {
        $token = $this->session->userdata('accessToken');
        $apiUrl = $this->config->item('api_url') . '/transaksi/' . $id_transaksi;

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $this->session->set_flashdata('success', 'Data Transaksi Berhasil Dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data transaksi. Silakan coba lagi.');
        }

        redirect('Super/cKelolaData/transaksi');
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

        $this->load->view('Super/Layout/head');
        $this->load->view('Super/Layout/aside');
        $this->load->view('Super/Profil/vprofil', $data);
        $this->load->view('Super/Layout/footer');
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

        redirect('Super/cKelolaData/profil');
    }
}

/* End of file cKelolaData.php */

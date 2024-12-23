<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Memastikan pengguna sudah login dan refresh token jika perlu
function check_and_refresh_token()
{
    $ci = get_instance();
    $accessToken = $ci->session->userdata('accessToken');
    $refreshToken = $ci->session->userdata('refreshToken');

    if (!$accessToken || !$refreshToken) {
        redirect('/'); // Redirect ke halaman login
    }

    // Verifikasi access token dengan backend
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ci->config->item('api_url') . '/auth/verify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $accessToken"
    ));
    $result = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status == 401) { // Jika token kedaluwarsa
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ci->config->item('api_url') . '/auth/refresh');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); // Menggunakan POST
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['refreshToken' => $refreshToken])); // Body JSON
        $response = curl_exec($ch);
        $refresh_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($refresh_status == 200) {
            $authData = json_decode($response);
            if (isset($authData->accessToken)) {
                // Simpan access token baru di sesi
                $ci->session->set_userdata('accessToken', $authData->accessToken);

                // Debug log (sementara)
                log_message('debug', 'AccessToken diperbarui: ' . $authData->accessToken);

                return $authData->accessToken;
            } else {
                redirect('cAuth/logout'); // Logout jika data tidak valid
            }
        } else {
            // Jika refresh token gagal
            // redirect('cAuth/logout');
        }
    } elseif ($status !== 200) {
        // Jika ada masalah lain dengan verifikasi token
        // redirect('cAuth/logout');
    }

    // Debug log (sementara)
    // log_message('debug', 'AccessToken valid: ' . $accessToken);

    return $accessToken; // Kembalikan token yang valid
}

if (!function_exists('check_role')) {
    function check_role($allowed_roles)
    {
        $CI = &get_instance();
        $user_role = $CI->session->userdata('role');

        if (!in_array($user_role, $allowed_roles)) {
            // Redirect ke halaman yang sesuai jika role tidak diizinkan
            $CI->session->set_flashdata('error', 'Akses Ditolak!');
            redirect('/');
            exit;
        }
    }
}

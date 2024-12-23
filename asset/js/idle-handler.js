let idleTimer;

// Reset timer saat pengguna berinteraksi
function resetIdleTimer() {
    clearTimeout(idleTimer);

    // Kirim permintaan AJAX untuk memperbarui aktivitas
    fetch('/cDashboard/update_activity', { method: 'POST' })
        .catch(err => console.error('Error updating activity:', err));

    idleTimer = setTimeout(() => {
        // alert('Anda telah logout karena tidak aktif selama 15 menit.');
        window.location.href = BASE_URL + 'cAuth/logout';
    }, 60 * 60 * 1000); // 1 jam
}

// Event listener untuk aktivitas pengguna
document.addEventListener('mousemove', resetIdleTimer);
document.addEventListener('keydown', resetIdleTimer);
document.addEventListener('click', resetIdleTimer);

// Inisialisasi timer
resetIdleTimer();

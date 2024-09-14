// Fungsi untuk menampilkan notifikasi sukses
function showSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: message,
    });
}

// Fungsi untuk menampilkan notifikasi error
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: message,
    });
}

// Fungsi untuk menampilkan notifikasi error dari server
function showServerError(error) {
    Swal.fire({
        icon: 'error',
        title: 'Kesalahan Server',
        text: 'Terjadi kesalahan pada server: ' + error,
    });
}

// Fungsi untuk submit form
function submitForm(event) {
    event.preventDefault(); // Mencegah reload halaman saat form dikirim

    const formData = new FormData(event.target);

    fetch('save_checklist_pc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Panggil fungsi sukses dari file eksternal
            showSuccess(data.message);
            event.target.reset(); // Reset form setelah sukses
        } else {
            // Panggil fungsi error dari file eksternal
            showError('Gagal menyimpan data: ' + data.message);
        }
    })
    .catch(error => {
        // Panggil fungsi error server dari file eksternal
        showServerError(error);
    });
}

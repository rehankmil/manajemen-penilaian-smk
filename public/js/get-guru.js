$(document).ready(function() {
        // Fungsi untuk memuat data guru berdasarkan mapel_id
        function loadGuruByMapel(mapelId) {
            if (!mapelId) {
                // Jika tidak ada mapel yang dipilih, kosongkan dropdown guru
                $('#guru_id').html('<option value="">-- Pilih Mata Pelajaran Terlebih Dahulu --</option>');
                return;
            }
            
            // Tampilkan indikator loading
            $('#guru_id').html('<option value="">Memuat data guru...</option>');
            
            // Kirim ajax request
            $.ajax({
                url: "/get-guru-by-mapel",
                type: "GET",
                data: {
                    mapel_id: mapelId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Kosongkan dropdown guru
                        $('#guru_id').empty();
                        
                        // Tambahkan opsi default
                        $('#guru_id').append('<option value="">-- Pilih Guru --</option>');
                        
                        // Jika tidak ada data
                        if (response.data.length === 0) {
                            $('#guru_id').append('<option value="" disabled>Tidak ada guru untuk mata pelajaran ini</option>');
                        } else {
                            // Tambahkan data guru ke dropdown
                            $.each(response.data, function(key, value) {
                                $('#guru_id').append('<option value="' + value.id + '">' + value.nama + '</option>');
                            });
                        }
                    } else {
                        alert('Terjadi kesalahan saat memuat data guru');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan pada server');
                }
            });
        }
        
        // Event listener untuk perubahan pada dropdown mapel
        $('#mapel_id').on('change', function() {
            var mapelId = $(this).val();
            loadGuruByMapel(mapelId);
        });
        
        // Panggil fungsi untuk memuat data guru jika ada mapel_id yang sudah dipilih sebelumnya
        var selectedMapelId = $('#mapel_id').val();
        if (selectedMapelId) {
            loadGuruByMapel(selectedMapelId);
        }
    });
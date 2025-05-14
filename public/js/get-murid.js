$(document).ready(function() {
        // Fungsi untuk memuat data murid berdasarkan kelas_id
        function loadMuridByKelas(kelasId) {
            if (!kelasId) {
                // Jika tidak ada kelas yang dipilih, kosongkan dropdown murid
                $('#murid_id').html('<option value="">-- Pilih Kelas Terlebih Dahulu --</option>');
                return;
            }
            
            // Tampilkan indikator loading
            $('#murid_id').html('<option value="">Memuat data murid...</option>');
            
            // Kirim ajax request
            $.ajax({
                url: "/get-murid-by-kelas",
                type: "GET",
                data: {
                    kelas_id: kelasId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Kosongkan dropdown murid
                        $('#murid_id').empty();
                        
                        // Tambahkan opsi default
                        $('#murid_id').append('<option value="">-- Pilih Murid --</option>');
                        
                        // Jika tidak ada data
                        if (response.data.length === 0) {
                            $('#murid_id').append('<option value="" disabled>Tidak ada murid untuk kelas ini</option>');
                        } else {
                            // Tambahkan data murid ke dropdown
                            $.each(response.data, function(key, value) {
                                $('#murid_id').append('<option value="' + value.id + '">' + value.nama + '</option>');
                            });
                        }
                    } else {
                        alert('Terjadi kesalahan saat memuat data murid');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan pada server');
                }
            });
        }
        
        // Event listener untuk perubahan pada dropdown kelas
        $('#kelas_id').on('change', function() {
            var kelasId = $(this).val();
            loadMuridByKelas(kelasId);
        });
        
        // Panggil fungsi untuk memuat data murid jika ada kelas_id yang sudah dipilih sebelumnya
        var selectedKelasId = $('#kelas_id').val();
        if (selectedKelasId) {
            loadMuridByKelas(selectedKelasId);
        }
    });
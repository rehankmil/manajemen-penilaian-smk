
document.addEventListener('DOMContentLoaded', function() {
    const chartElement = document.getElementById('predikatChart');
    if (!chartElement) return;
    
    const ctx = chartElement.getContext('2d');
    
    // Ambil data dari data attributes
    const predicates = JSON.parse(chartElement.dataset.predicates || '[]');
    const counts = JSON.parse(chartElement.dataset.counts || '[]').map(Number);
    
    console.log('Counts:', counts);
    console.log('Predicates:', predicates);

    console.log('Raw data attributes:', chartElement.dataset);
    console.log('Parsed counts:', counts);


    // Membuat warna untuk setiap predikat
    const backgroundColors = getPredicateColors(predicates);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: predicates,
            datasets: [{
                label: 'Jumlah Nilai',
                data: counts,
                backgroundColor: backgroundColors,
                borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                    y: {
                        type: 'linear', // pastikan ini ada
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            stepSize: 1
                        },
                        suggestedMin: 0,
                        suggestedMax: Math.max(...counts) + 1 // biar gak auto kecil
                    }
                },
            plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Nilai Berdasarkan Predikat'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Jumlah: ${context.raw} nilai`;
                        }
                    }
                }
            }
        }
    });
});

// Fungsi untuk menentukan warna berdasarkan predikat
function getPredicateColors(predicates) {
    const colorMap = {
        'A': 'rgba(75, 192, 192, 0.7)',    // Hijau
        'B': 'rgba(54, 162, 235, 0.7)',    // Biru
        'C': 'rgba(255, 206, 86, 0.7)',    // Kuning
        'D': 'rgba(255, 159, 64, 0.7)',    // Oranye
        'E': 'rgba(255, 99, 132, 0.7)'     // Merah
    };

    return predicates.map(pred => {
        return colorMap[pred] || `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`;
    });
}
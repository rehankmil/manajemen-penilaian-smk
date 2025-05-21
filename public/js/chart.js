document.addEventListener('DOMContentLoaded', function() {
    // Cari semua canvas chart dalam halaman
    const chartElement = document.getElementById('muridDistributionChart');
    if (!chartElement) return;
    
    // Ambil data dari data attributes
    const labels = JSON.parse(chartElement.dataset.labels || '[]');
    const data = JSON.parse(chartElement.dataset.values || '[]');
    
    const ctx = chartElement.getContext('2d');
    
    // Membuat array warna secara dinamis berdasarkan jumlah kelas
    const backgroundColors = generateColors(labels.length);
    
    const muridDistributionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribusi Jumlah Murid per Kelas'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} murid (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
});

// Fungsi untuk menghasilkan warna
function generateColors(count) {
    const colors = [];
    for (let i = 0; i < count; i++) {
        const hue = (i * 360) / count;
        colors.push(`hsl(${hue}, 70%, 60%)`);
    }
    return colors;
}
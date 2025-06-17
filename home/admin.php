<?php
// ===================================================================
// BAGIAN 1: PERSIAPAN DATA UNTUK KEDUA CHART (PHP)
// ===================================================================

// ASUMSI: Anda sudah memiliki koneksi database dalam variabel $koneksi
// include 'inc/koneksi.php';

// --- Langkah 1: Ambil semua fakultas yang ada untuk dijadikan label chart ---
$sql_fakultas = "SELECT id_fakultas, nama_fakultas FROM fakultas ORDER BY nama_fakultas ASC";
$query_fakultas = mysqli_query($koneksi, $sql_fakultas);

$fakultas_labels = [];       // Array untuk menampung nama fakultas (misal: ["Teknik", "Ekonomi"])
$fakultas_data_values = [];  // Array untuk menampung jumlah mahasiswa (misal: [150, 200])

if ($query_fakultas) {
    while ($row_fakultas = mysqli_fetch_assoc($query_fakultas)) {
        // Simpan nama fakultas sebagai label
        $fakultas_labels[] = $row_fakultas['nama_fakultas'];
        $current_fakultas_id = $row_fakultas['id_fakultas'];

        // --- Langkah 2: Untuk setiap fakultas, hitung jumlah total mahasiswanya ---
        $sql_count = "SELECT COUNT(*) AS total_mahasiswa 
                      FROM mahasiswa 
                      JOIN prodi ON mahasiswa.prodi_id = prodi.id_prodi 
                      WHERE prodi.fakultas_id = '$current_fakultas_id'";
        
        $query_count = mysqli_query($koneksi, $sql_count);
        $count_data = mysqli_fetch_assoc($query_count);
        
        // Simpan jumlah mahasiswa ke dalam array data
        $fakultas_data_values[] = $count_data['total_mahasiswa'] ?? 0;
    }
} else {
    // Tangani jika query fakultas gagal
    error_log("Error fetching fakultas data: " . mysqli_error($koneksi));
}

// --- Langkah 3: Siapkan data dalam format JSON untuk dikonsumsi oleh JavaScript ---
$json_fakultas_labels = json_encode($fakultas_labels);
$json_fakultas_data = json_encode($fakultas_data_values);

// Siapkan array warna agar setiap irisan pie/batang memiliki warna berbeda
$backgroundColors = [
    'rgba(4, 35, 102, 0.8)', 'rgba(142, 144, 255, 0.8)', 'rgba(255, 205, 86, 0.8)', 
    'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)',
    'rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)'
];
$json_background_colors = json_encode($backgroundColors);

$borderColors = str_replace('0.8', '1', $json_background_colors); // Buat warna border lebih solid

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="row kotak-staf" style="margin-top: 50px;">

    <div class="kotak-chart-staff">
        <div class="kotak-chart1">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="kotak-chart2">
            <canvas id="myChart2"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- Data yang akan digunakan bersama oleh kedua chart ---
    const labels = <?= $json_fakultas_labels; ?>;
    const dataValues = <?= $json_fakultas_data; ?>;
    const bgColors = <?= $json_background_colors; ?>;
    const brdColors = <?= $borderColors; ?>;

    // --- Inisialisasi Chart 1 (Bar Chart) ---
    const ctx1 = document.getElementById('myChart1');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: brdColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Mahasiswa per Fakultas',
                        font: { size: 16 }
                    },
                    legend: {
                        display: false // Legenda bisa disembunyikan untuk bar chart tunggal
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // --- Inisialisasi Chart 2 (Pie Chart) ---
    const ctx2 = document.getElementById('myChart2');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: dataValues,
                    backgroundColor: bgColors,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Mahasiswa per Fakultas',
                        font: { size: 16 }
                    },
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) { label += ': '; }
                                if (context.parsed !== null) {
                                    label += context.parsed.toLocaleString('id-ID') + ' mahasiswa';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
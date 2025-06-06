


<div class="kotak-krp">
<h2>Kartu Rencana Partisipasi ( Periode Aktif : <?= $tahunAjaran ?>-<?= $periode ?>)</h2>
<div class="krp-alert">
  <strong>Kartu Rencana Partisipasi (KRP)</strong> Adalah Rencana Kegiatan yang akan diikuti, silahkan Pilih Beberapa Rencana Kegiatan Untuk Semester Depan !!!
</div>

<form  method="post" action="?page=data-krp">
<!-- kategori wajib -->
 <div class="kategori-wajib">
    <?php
    // Ambil semua kode wajib yang sudah dipilih oleh mahasiswa
    $query_krp_mhs = mysqli_query($koneksi, "SELECT kode FROM khp WHERE npm='$data_id' AND kode IN ('WU001', 'WU002')");
    
    // Buat array untuk menyimpan kode yang sudah ada
    $kode_terpilih = [];
    while($row_kode = mysqli_fetch_assoc($query_krp_mhs)) {
        $kode_terpilih[] = $row_kode['kode'];
    }

    // Daftar seluruh kode wajib
    $wajib = [
        'WU001' => ['label' => 'PKKMB (Peserta)', 'bobot' => 25],
        'WU002' => ['label' => 'Dies Natalis (Peserta)', 'bobot' => 10]
    ];

    // Cek apakah sudah memilih salah satu
    if (count($kode_terpilih) >= 1) {
        echo "<div class='alert alert-success'>Anda sudah memilih salah satu kategori wajib.</div>";

        // Ambil kode yang belum dipilih
        $kode_sisa = array_diff(array_keys($wajib), $kode_terpilih);

        // Jika masih ada yang belum dipilih, tampilkan opsi sisa
        if (!empty($kode_sisa)) {
            echo '<div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Silakan pilih satu lagi jika diperlukan</div>';
            echo '<div class="table-container"><table class="activity-table table table-hover"><thead><tr>
                    <th>No</th><th>Kode</th><th>Jenis Kegiatan</th><th>Bobot</th><th>Pilih</th></tr></thead><tbody>';

            $no = 1;
            foreach ($kode_sisa as $kode) {
                echo "<tr>
                        <th scope='row' class='text-center'>{$no}</th>
                        <td class='text-center'>{$kode}</td>
                        <td>{$wajib[$kode]['label']}</td>
                        <td class='text-center'>{$wajib[$kode]['bobot']}</td>
                        <td class='text-center'><input type='checkbox' name='krpnilai[]' value='{$kode}' style='transform: scale(1.4);'></td>
                      </tr>";
                $no++;
            }

            echo '</tbody></table></div>';
        }
    } else {
        // Jika belum memilih salah satu pun, tampilkan semua
        ?>
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Wajib Universitas/Fakultas</div>
        <div class="table-container">
            <table class="activity-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Jenis Kegiatan</th>
                        <th>Bobot</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center">1</th>
                        <td class="text-center">WU001</td>
                        <td>PKKMB (Peserta)</td>
                        <td class="text-center">25</td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="WU001" style="transform: scale(1.4);"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center">2</th>
                        <td class="text-center">WU002</td>
                        <td>Dies Natalis (Peserta)</td>
                        <td class="text-center">10</td>
                        <td class="text-center"><input type="checkbox" name="krpnilai[]" value="WU002" style="transform: scale(1.4);"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<!-- end wajib universitas -->


    
    <!-- organisasi -->
    <div class="kotak-organisasi">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Organisasi dan Kepemimpinan</div>
        <div class="table-container table-responsive" style="max-height: 370px; overflow-y: auto;">
        <table class="activity-table table table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Jenis Kegiatan</th>
            <th>Bobot</th>
            <th>Pilih</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <th scope="row" width="2%" class="text-center">1</th>
            <td width="5%" class="text-center">OR001</td>
            <td>Pengurus Organisasi Tingkat Internasional (Ketua)</td>
            <td width="5%" class="text-center">80</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR001" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">2</th>
            <td width="5%" class="text-center">OR002</td>
            <td>Pengurus Organisasi Tingkat Internasional (Wakil Ketua)</td>
            <td width="5%" class="text-center">70</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR002" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">3</th>
            <td width="5%" class="text-center">OR003</td>
            <td>Pengurus Organisasi Tingkat Internasional (Sekretaris)</td>
            <td width="5%" class="text-center">60</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR003" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">4</th>
            <td width="5%" class="text-center">OR004</td>
            <td>Pengurus Organisasi Tingkat Internasional (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">50</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR004" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">5</th>
            <td width="5%" class="text-center">OR005</td>
            <td>Pengurus Organisasi Tingkat Internasional (Anggota Pengurus)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR005" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">6</th>
            <td width="5%" class="text-center">OR006</td>
            <td>Pengurus Organisasi Tingkat Nasional (Ketua)</td>
            <td width="5%" class="text-center">60</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR006" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">7</th>
            <td width="5%" class="text-center">OR007</td>
            <td>Pengurus Organisasi Tingkat Nasional (Wakil Ketua)</td>
            <td width="5%" class="text-center">50</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR007" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">8</th>
            <td width="5%" class="text-center">OR008</td>
            <td>Pengurus Organisasi Tingkat Nasional (Sekretaris)</td>
            <td width="5%" class="text-center">40</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR008" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">9</th>
            <td width="5%" class="text-center">OR009</td>
            <td>Pengurus Organisasi Tingkat Nasional (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR009" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">10</th>
            <td width="5%" class="text-center">OR010</td>
            <td>Pengurus Organisasi Tingkat Nasional (Anggota Pengurus)</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR010" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">11</th>
            <td width="5%" class="text-center">OR011</td>
            <td>Pengurus Organisasi Tingkat Regional (Ketua)</td>
            <td width="5%" class="text-center">55</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR011" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">12</th>
            <td width="5%" class="text-center">OR012</td>
            <td>Pengurus Organisasi Tingkat Regional (Wakil Ketua)</td>
            <td width="5%" class="text-center">45</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR012" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">13</th>
            <td width="5%" class="text-center">OR013</td>
            <td>Pengurus Organisasi Tingkat Regional (Sekretaris)</td>
            <td width="5%" class="text-center">35</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR013" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">14</th>
            <td width="5%" class="text-center">OR014</td>
            <td>Pengurus Organisasi Tingkat Regional (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">25</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR014" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">15</th>
            <td width="5%" class="text-center">OR015</td>
            <td>Pengurus Organisasi Tingkat Regional (Anggota Pengurus)</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR015" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">16</th>
            <td width="5%" class="text-center">OR016</td>
            <td>Pengurus Organisasi Tingkat Lokal (Ketua)</td>
            <td width="5%" class="text-center">50</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR016" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">17</th>
            <td width="5%" class="text-center">OR017</td>
            <td>Pengurus Organisasi Tingkat Lokal (Wakil Ketua)</td>
            <td width="5%" class="text-center">40</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR017" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">18</th>
            <td width="5%" class="text-center">OR018</td>
            <td>Pengurus Organisasi Tingkat Lokal (Sekretaris)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR018" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">19</th>
            <td width="5%" class="text-center">OR019</td>
            <td>Pengurus Organisasi Tingkat Lokal (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR019" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">20</th>
            <td width="5%" class="text-center">OR020</td>
            <td>Pengurus Organisasi Tingkat Lokal (Anggota Pengurus)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR020" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">21</th>
            <td width="5%" class="text-center">OR021</td>
            <td>Pengurus Organisasi Tingkat Universitas (Ketua)</td>
            <td width="5%" class="text-center">40</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR021" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">22</th>
            <td width="5%" class="text-center">OR022</td>
            <td>Pengurus Organisasi Tingkat Universitas (Wakil Ketua)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR022" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">23</th>
            <td width="5%" class="text-center">OR023</td>
            <td>Pengurus Organisasi Tingkat Universitas (Sekretaris)</td>
            <td width="5%" class="text-center">25</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR023" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">24</th>
            <td width="5%" class="text-center">OR024</td>
            <td>Pengurus Organisasi Tingkat Universitas (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR024" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">25</th>
            <td width="5%" class="text-center">OR025</td>
            <td>Pengurus Organisasi Tingkat Universitas (Anggota Pengurus)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR025" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">26</th>
            <td width="5%" class="text-center">OR026</td>
            <td>Pengurus Organisasi Tingkat Fakultas (Ketua)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR026" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">27</th>
            <td width="5%" class="text-center">OR027</td>
            <td>Pengurus Organisasi Tingkat Fakultas (Wakil Ketua)</td>
            <td width="5%" class="text-center">25</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR027" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">28</th>
            <td width="5%" class="text-center">OR028</td>
            <td>Pengurus Organisasi Tingkat Fakultas (Sekretaris)</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR028" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">29</th>
            <td width="5%" class="text-center">OR029</td>
            <td>Pengurus Organisasi Tingkat Fakultas (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR029" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">30</th>
            <td width="5%" class="text-center">OR030</td>
            <td>Pengurus Organisasi Tingkat Fakultas (Anggota Pengurus)</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR030" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">31</th>
            <td width="5%" class="text-center">OR031</td>
            <td>Pengurus Organisasi Tingkat Program Studi (Ketua)</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR031" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">32</th>
            <td width="5%" class="text-center">OR032</td>
            <td>Pengurus Organisasi Tingkat Program Studi (Wakil Ketua)</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR032" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">33</th>
            <td width="5%" class="text-center">OR033</td>
            <td>Pengurus Organisasi Tingkat Program Studi (Sekretaris)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR033" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">34</th>
            <td width="5%" class="text-center">OR034</td>
            <td>Pengurus Organisasi Tingkat Program Studi (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">6</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR034" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">35</th>
            <td width="5%" class="text-center">OR035</td>
            <td>Pengurus Organisasi Tingkat Program Studi (Anggota Pengurus)</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR035" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">36</th>
            <td width="5%" class="text-center">OR036</td>
            <td>Pengurus Organisasi Tingkat UKM (Ketua)</td>
            <td width="5%" class="text-center">30</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR036" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">37</th>
            <td width="5%" class="text-center">OR037</td>
            <td>Pengurus Organisasi Tingkat UKM (Wakil Ketua)</td>
            <td width="5%" class="text-center">25</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR037" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">38</th>
            <td width="5%" class="text-center">OR038</td>
            <td>Pengurus Organisasi Tingkat UKM (Sekretaris)</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR038" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">39</th>
            <td width="5%" class="text-center">OR039</td>
            <td>Pengurus Organisasi Tingkat UKM (Pengurus inti lainnya)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR039" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">40</th>
            <td width="5%" class="text-center">OR040</td>
            <td>Pengurus Organisasi Tingkat UKM (Anggota Pengurus)</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR040" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">41</th>
            <td width="5%" class="text-center">OR041</td>
            <td>Anggota Aktif Organisasi Tingkat Internasional</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR041" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">42</th>
            <td width="5%" class="text-center">OR042</td>
            <td>Anggota Aktif Organisasi Tingkat Nasional</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR042" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">43</th>
            <td width="5%" class="text-center">OR043</td>
            <td>Anggota Aktif Organisasi Tingkat Regional</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR043" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">44</th>
            <td width="5%" class="text-center">OR044</td>
            <td>Anggota Aktif Organisasi Tingkat Lokal</td>
            <td width="5%" class="text-center">6</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR044" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">45</th>
            <td width="5%" class="text-center">OR045</td>
            <td>Anggota Aktif Organisasi Tingkat Universitas</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR045" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">46</th>
            <td width="5%" class="text-center">OR046</td>
            <td>Anggota Aktif Organisasi Tingkat Fakultas</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR046" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">47</th>
            <td width="5%" class="text-center">OR047</td>
            <td>Anggota Aktif Organisasi Tingkat Program Studi</td>
            <td width="5%" class="text-center">2</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR047" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">48</th>
            <td width="5%" class="text-center">OR048</td>
            <td>Anggota Aktif Organisasi Tingkat Lainnya</td>
            <td width="5%" class="text-center">1</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR048" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">49</th>
            <td width="5%" class="text-center">OR049</td>
            <td>Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Lanjut</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR049" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">50</th>
            <td width="5%" class="text-center">OR050</td>
            <td>Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Menengah</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR050" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">51</th>
            <td width="5%" class="text-center">OR051</td>
            <td>Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Dasar</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR051" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">52</th>
            <td width="5%" class="text-center">OR052</td>
            <td>Latihan kepemimpinan lainnya Tingkat </td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR052" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">53</th>
            <td width="5%" class="text-center">OR053</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Internasional</td>
            <td width="5%" class="text-center">20</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR053" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">54</th>
            <td width="5%" class="text-center">OR054</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Nasional</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR054" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">55</th>
            <td width="5%" class="text-center">OR055</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Regional</td>
            <td width="5%" class="text-center">13</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR055" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">56</th>
            <td width="5%" class="text-center">OR056</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Lokal</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR056" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">57</th>
            <td width="5%" class="text-center">OR057</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Universitas</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR057" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">58</th>
            <td width="5%" class="text-center">OR058</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Fakultas</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR058" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">59</th>
            <td width="5%" class="text-center">OR059</td>
            <td>Panitia dalam suatu kegiatan kemahasiswaan Tingkat Program Studi</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR059" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">60</th>
            <td width="5%" class="text-center">OR060</td>
            <td>Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa (Universitas)</td>
            <td width="5%" class="text-center">15</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR060" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">61</th>
            <td width="5%" class="text-center">OR061</td>
            <td>Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa (Fakultas)</td>
            <td width="5%" class="text-center">10</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR061" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">62</th>
            <td width="5%" class="text-center">OR062</td>
            <td>Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa(Program Studi)</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR062" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">63</th>
            <td width="5%" class="text-center">OR063</td>
            <td>Berpartisipasi dalam pemilihan ormawa (Universitas)</td>
            <td width="5%" class="text-center">7</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR063" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">64</th>
            <td width="5%" class="text-center">OR064</td>
            <td>Berpartisipasi dalam pemilihan ormawa (Fakultas)</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR064" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">65</th>
            <td width="5%" class="text-center">OR065</td>
            <td>Berpartisipasi dalam pemilihan ormawa (Program Studi)</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR065" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">66</th>
            <td width="5%" class="text-center">OR066</td>
            <td>Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Pengurus Harian)</td>
            <td width="5%" class="text-center">5</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR066" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">67</th>
            <td width="5%" class="text-center">OR067</td>
            <td>Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Anggota Lab)</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR067" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">68</th>
            <td width="5%" class="text-center">OR068</td>
            <td>Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Nasabah BPRS Mini Bank)</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR068" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">69</th>
            <td width="5%" class="text-center">OR069</td>
            <td>Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis - Akun Saham (GIS BEI)</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR069" style="transform: scale(1.4);"></td>
            </tr>
            <tr>
            <th scope="row" width="2%" class="text-center">70</th>
            <td width="5%" class="text-center">OR070</td>
            <td>Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis - Relawan Pajak</td>
            <td width="5%" class="text-center">3</td>
            <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="OR070" style="transform: scale(1.4);"></td>
            </tr>
            </tbody>
        </table>
        </div>
     </div>
    <!-- end organisasi -->

    <!-- penalaran -->
    <div class="kotak-penalaran">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Penalaran dan Keilmuan</div>
        <div class="table-container" style="max-height: 370px; overflow-y: auto;">
        <table class="activity-table table table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Jenis Kegiatan</th>
            <th>Bobot</th>
            <th>Pilih</th>
            </tr>
            </thead>
            <tbody>
                    <tr>
                        <th scope="row" width="2%" class="text-center">1</th>
                        <td width="5%" class="text-center">PI001</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Internasional (Juara I)</td>
                        <td width="5%" class="text-center">120</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI001" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">2</th>
                        <td width="5%" class="text-center">PI002</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Internasional (Juara II)</td>
                        <td width="5%" class="text-center">110</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI002" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">3</th>
                        <td width="5%" class="text-center">PI003</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Internasional (Juara III)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI003" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">4</th>
                        <td width="5%" class="text-center">PI004</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Internasional (Finalis)</td>
                        <td width="5%" class="text-center">90</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI004" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">5</th>
                        <td width="5%" class="text-center">PI005</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Internasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI005" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">6</th>
                        <td width="5%" class="text-center">PI006</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Nasional (Juara I)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI006" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">7</th>
                        <td width="5%" class="text-center">PI007</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Nasional (Juara II)</td>
                        <td width="5%" class="text-center">90</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI007" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">8</th>
                        <td width="5%" class="text-center">PI008</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Nasional (Juara III)</td>
                        <td width="5%" class="text-center">80</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI008" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">9</th>
                        <td width="5%" class="text-center">PI009</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Nasional (Finalis)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI009" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">10</th>
                        <td width="5%" class="text-center">PI010</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Nasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI010" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">11</th>
                        <td width="5%" class="text-center">PI011</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Regional (Juara I)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI011" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">12</th>
                        <td width="5%" class="text-center">PI012</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Regional (Juara II)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI012" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">13</th>
                        <td width="5%" class="text-center">PI013</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Regional (Juara III)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI013" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">14</th>
                        <td width="5%" class="text-center">PI014</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Regional (Finalis)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI014" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">15</th>
                        <td width="5%" class="text-center">PI015</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Regional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI015" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">16</th>
                        <td width="5%" class="text-center">PI016</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Lokal (Juara I)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI016" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">17</th>
                        <td width="5%" class="text-center">PI017</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Lokal (Juara II)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI017" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">18</th>
                        <td width="5%" class="text-center">PI018</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Lokal (Juara III)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI018" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">19</th>
                        <td width="5%" class="text-center">PI019</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Lokal (Finalis)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI019" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">20</th>
                        <td width="5%" class="text-center">PI020</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Lokal (Peserta terpilih)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI020" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">21</th>
                        <td width="5%" class="text-center">PI021</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Universitas (Juara I)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI021" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">22</th>
                        <td width="5%" class="text-center">PI022</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Universitas (Juara II)</td>
                        <td width="5%" class="text-center">45</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI022" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">23</th>
                        <td width="5%" class="text-center">PI023</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Universitas (Juara III)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI023" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">24</th>
                        <td width="5%" class="text-center">PI024</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Universitas (Finalis)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI024" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">25</th>
                        <td width="5%" class="text-center">PI025</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Universitas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI025" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">26</th>
                        <td width="5%" class="text-center">PI026</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara I)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI026" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">27</th>
                        <td width="5%" class="text-center">PI027</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara II)</td>
                        <td width="5%" class="text-center">28</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI027" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">28</th>
                        <td width="5%" class="text-center">PI028</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara III)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI028" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">29</th>
                        <td width="5%" class="text-center">PI029</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Fakultas (Finalis)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI029" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">30</th>
                        <td width="5%" class="text-center">PI030</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Fakultas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI030" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">31</th>
                        <td width="5%" class="text-center">PI031</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara I)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI031" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">32</th>
                        <td width="5%" class="text-center">PI032</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara II)</td>
                        <td width="5%" class="text-center">12</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI032" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">33</th>
                        <td width="5%" class="text-center">PI033</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara III)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI033" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">34</th>
                        <td width="5%" class="text-center">PI034</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Program Studi (Finalis)</td>
                        <td width="5%" class="text-center">8</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI034" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">35</th>
                        <td width="5%" class="text-center">PI035</td>
                        <td>Lomba karya Tulis Ilmiah Tingkat Program Studi (Peserta terpilih)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI035" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">36</th>
                        <td width="5%" class="text-center">PI036</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Internasional</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI036" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">37</th>
                        <td width="5%" class="text-center">PI037</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Nasional</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI037" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">38</th>
                        <td width="5%" class="text-center">PI038</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Regional</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI038" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">39</th>
                        <td width="5%" class="text-center">PI039</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Lokal</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI039" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">40</th>
                        <td width="5%" class="text-center">PI040</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Universitas</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI040" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">41</th>
                        <td width="5%" class="text-center">PI041</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Fakultas</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI041" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">42</th>
                        <td width="5%" class="text-center">PI042</td>
                        <td>Mengikuti kegiatan lomba ilmiah Tingkat Prodi</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI042" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">43</th>
                        <td width="5%" class="text-center">PI043</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Internasional (Pembicara)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI043" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">44</th>
                        <td width="5%" class="text-center">PI044</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran)  Tingkat Internasional (Moderator)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI044" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">45</th>
                        <td width="5%" class="text-center">PI045</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Internasional (Peserta)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI045" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">46</th>
                        <td width="5%" class="text-center">PI046</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Pembicara)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI046" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">47</th>
                        <td width="5%" class="text-center">PI047</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Moderator)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI047" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">48</th>
                        <td width="5%" class="text-center">PI048</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Peserta)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI048" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">49</th>
                        <td width="5%" class="text-center">PI049</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Pembicara)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI049" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">50</th>
                        <td width="5%" class="text-center">PI050</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Moderator)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI050" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">51</th>
                        <td width="5%" class="text-center">PI051</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Peserta)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI051" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">52</th>
                        <td width="5%" class="text-center">PI052</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Pembicara)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI052" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">53</th>
                        <td width="5%" class="text-center">PI053</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Moderator)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI053" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">54</th>
                        <td width="5%" class="text-center">PI054</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Peserta)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI054" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">55</th>
                        <td width="5%" class="text-center">PI055</td>
                        <td>Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Universitas (Pembicara)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI055" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">56</th>
                        <td width="5%" class="text-center">PI056</td>
                        <td>kegiatan / forum ilmiah Tingkat Universitas (Moderator)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI056" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">57</th>
                        <td width="5%" class="text-center">PI057</td>
                        <td>kegiatan / forum ilmiah Tingkat Universitas (Peserta)</td>
                        <td width="5%" class="text-center">8</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI057" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">58</th>
                        <td width="5%" class="text-center">PI058</td>
                        <td>kegiatan / forum ilmiah Tingkat Fakultas (Pembicara)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI058" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">59</th>
                        <td width="5%" class="text-center">PI059</td>
                        <td>kegiatan / forum ilmiah Tingkat Fakultas (Moderator)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI059" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">60</th>
                        <td width="5%" class="text-center">PI060</td>
                        <td>kegiatan / forum ilmiah Tingkat Fakultas (Peserta)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI060" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">61</th>
                        <td width="5%" class="text-center">PI061</td>
                        <td>kegiatan / forum ilmiah Tingkat Program Studi (Pembicara)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI061" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">62</th>
                        <td width="5%" class="text-center">PI062</td>
                        <td>kegiatan / forum ilmiah Tingkat Program Studi (Moderator)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI062" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">63</th>
                        <td width="5%" class="text-center">PI063</td>
                        <td>kegiatan / forum ilmiah Tingkat Program Studi (Peserta)</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI063" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">64</th>
                        <td width="5%" class="text-center">PI064</td>
                        <td>Menghasilkan temuan inovasi yang dipatenkan</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI064" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">65</th>
                        <td width="5%" class="text-center">PI065</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Internasional (Ketua)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI065" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">66</th>
                        <td width="5%" class="text-center">PI066</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Internasional (Anggota)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI066" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">67</th>
                        <td width="5%" class="text-center">PI067</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional-Akreditasi (Ketua)</td>
                        <td width="5%" class="text-center">75</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI067" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">68</th>
                        <td width="5%" class="text-center">PI068</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional-Akreditasi (Anggota)</td>
                        <td width="5%" class="text-center">35</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI068" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">69</th>
                        <td width="5%" class="text-center">PI069</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional (Ketua)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI069" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">70</th>
                        <td width="5%" class="text-center">PI070</td>
                        <td>Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional (Anggota)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI070" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">71</th>
                        <td width="5%" class="text-center">PI071</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Internasional (Ketua)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI071" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">72</th>
                        <td width="5%" class="text-center">PI072</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Internasional (Anggota)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI072" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">73</th>
                        <td width="5%" class="text-center">PI073</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Nasional (Ketua)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI073" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">74</th>
                        <td width="5%" class="text-center">PI074</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Nasional (Anggota)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI074" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">75</th>
                        <td width="5%" class="text-center">PI075</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Regional (Ketua)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI075" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">76</th>
                        <td width="5%" class="text-center">PI076</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Regional (Anggota)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI076" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">77</th>
                        <td width="5%" class="text-center">PI077</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Lokal (Ketua)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI077" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">78</th>
                        <td width="5%" class="text-center">PI078</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Lokal (Anggota)</td>
                        <td width="5%" class="text-center">7</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI078" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">79</th>
                        <td width="5%" class="text-center">PI079</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Universitas (Ketua)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI079" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">80</th>
                        <td width="5%" class="text-center">PI080</td>
                        <td>Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Universitas (Anggota)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI080" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">81</th>
                        <td width="5%" class="text-center">PI081</td>
                        <td>Menghasilkan karya yang didanai oleh pemerintah/pihak lain Tingkat  (Ketua)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI081" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">82</th>
                        <td width="5%" class="text-center">PI082</td>
                        <td>Menghasilkan karya yang didanai oleh pemerintah/pihak lain Tingkat  (Anggota)</td>
                        <td width="5%" class="text-center">7</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI082" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">83</th>
                        <td width="5%" class="text-center">PI083</td>
                        <td>Memberikan pelatihan/bimbingan dalam penyusunan karya tulis</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI083" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">84</th>
                        <td width="5%" class="text-center">PI084</td>
                        <td>Aktif membantu kegiatan laboratorium Tingkat Universitas</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI084" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">85</th>
                        <td width="5%" class="text-center">PI085</td>
                        <td>Aktif membantu kegiatan laboratorium Tingkat Fakultas</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI085" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">86</th>
                        <td width="5%" class="text-center">PI086</td>
                        <td>Mengikuti kuliah tamu</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI086" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">87</th>
                        <td width="5%" class="text-center">PI087</td>
                        <td>Terlibat dalam penelitian pihak lain</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI087" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">88</th>
                        <td width="5%" class="text-center">PI088</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara I)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI088" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">89</th>
                        <td width="5%" class="text-center">PI089</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara II)</td>
                        <td width="5%" class="text-center">90</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI089" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">90</th>
                        <td width="5%" class="text-center">PI090</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara III)</td>
                        <td width="5%" class="text-center">80</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI090" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">91</th>
                        <td width="5%" class="text-center">PI091</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Finalis)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI091" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">92</th>
                        <td width="5%" class="text-center">PI092</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI092" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">93</th>
                        <td width="5%" class="text-center">PI093</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara I)</td>
                        <td width="5%" class="text-center">80</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI093" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">94</th>
                        <td width="5%" class="text-center">PI094</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara II)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI094" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">95</th>
                        <td width="5%" class="text-center">PI095</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara III)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI095" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">96</th>
                        <td width="5%" class="text-center">PI096</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Finalis)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI096" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">97</th>
                        <td width="5%" class="text-center">PI097</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI097" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">98</th>
                        <td width="5%" class="text-center">PI098</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara I)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI098" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">99</th>
                        <td width="5%" class="text-center">PI099</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara II)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI099" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">100</th>
                        <td width="5%" class="text-center">PI100</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara III)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI100" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">101</th>
                        <td width="5%" class="text-center">PI101</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Finalis)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI101" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">102</th>
                        <td width="5%" class="text-center">PI102</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI102" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">103</th>
                        <td width="5%" class="text-center">PI103</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara I)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI103" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">104</th>
                        <td width="5%" class="text-center">PI104</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara II)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI104" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">105</th>
                        <td width="5%" class="text-center">PI105</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara III)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI105" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">106</th>
                        <td width="5%" class="text-center">PI106</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Finalis)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI106" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">107</th>
                        <td width="5%" class="text-center">PI107</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI107" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">108</th>
                        <td width="5%" class="text-center">PI108</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara I)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI108" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">109</th>
                        <td width="5%" class="text-center">PI109</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara II)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI109" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">110</th>
                        <td width="5%" class="text-center">PI110</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara III)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI110" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">111</th>
                        <td width="5%" class="text-center">PI111</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Finalis)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI111" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">112</th>
                        <td width="5%" class="text-center">PI112</td>
                        <td>PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI112" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">113</th>
                        <td width="5%" class="text-center">PI113</td>
                        <td>Program Kreatifitas Mahasiswa (PKM) Tingkat  (Proposal Lolos Seleksi Universitas)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI113" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">114</th>
                        <td width="5%" class="text-center">PI114</td>
                        <td>Program Kreatifitas Mahasiswa (PKM) Tingkat  (Proposal diajukan)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI114" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">115</th>
                        <td width="5%" class="text-center">PI115</td>
                        <td>Pelatihan Keahlian (Pelatihan Bahasa Inggris  - Peserta)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI115" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">116</th>
                        <td width="5%" class="text-center">PI116</td>
                        <td>Pelatihan Keahlian (Pelatihan Komputer - Peserta)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI116" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">117</th>
                        <td width="5%" class="text-center">PI117</td>
                        <td>Tes Uji Kopetensi Akademik Tingkat  (Peserta)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI117" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">118</th>
                        <td width="5%" class="text-center">PI118</td>
                        <td>Tes Uji Kopetensi Akademik Tingkat  (Panitia)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI118" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">119</th>
                        <td width="5%" class="text-center">PI119</td>
                        <td>Kampus Mengajar (LLDIKTI)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI119" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">120</th>
                        <td width="5%" class="text-center">PI120</td>
                        <td>Magang Mandiri</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="PI120" style="transform: scale(1.4);"></td>
                    </tr>
                </tbody>
            </tbody>
        </table>
        </div>
     </div>
    <!-- end penalaran -->

    <!-- minat -->
    <div class="kotak-minat">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Minat dan Bakat</div>
        <div class="table-container" style="max-height: 370px; overflow-y: auto;">
        <table class="activity-table table table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Jenis Kegiatan</th>
            <th>Bobot</th>
            <th>Pilih</th>
            </tr>
            </thead>
            <tbody>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">1</th>
                        <td width="5%" class="text-center">MB001</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara I)</td>
                        <td width="5%" class="text-center">100</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB001" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">2</th>
                        <td width="5%" class="text-center">MB002</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara II)</td>
                        <td width="5%" class="text-center">90</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB002" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">3</th>
                        <td width="5%" class="text-center">MB003</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara III)</td>
                        <td width="5%" class="text-center">80</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB003" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">4</th>
                        <td width="5%" class="text-center">MB004</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Finalis)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB004" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">5</th>
                        <td width="5%" class="text-center">MB005</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB005" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">6</th>
                        <td width="5%" class="text-center">MB006</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara I)</td>
                        <td width="5%" class="text-center">80</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB006" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">7</th>
                        <td width="5%" class="text-center">MB007</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara II)</td>
                        <td width="5%" class="text-center">70</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB007" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">8</th>
                        <td width="5%" class="text-center">MB008</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara III)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB008" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">9</th>
                        <td width="5%" class="text-center">MB009</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Finalis)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB009" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">10</th>
                        <td width="5%" class="text-center">MB010</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB010" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">11</th>
                        <td width="5%" class="text-center">MB011</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara I)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB011" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">12</th>
                        <td width="5%" class="text-center">MB012</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara II)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB012" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">13</th>
                        <td width="5%" class="text-center">MB013</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara III)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB013" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">14</th>
                        <td width="5%" class="text-center">MB014</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Finalis)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB014" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">15</th>
                        <td width="5%" class="text-center">MB015</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Peserta terpilih)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB015" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">16</th>
                        <td width="5%" class="text-center">MB016</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara I)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB016" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">17</th>
                        <td width="5%" class="text-center">MB017</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara II)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB017" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">18</th>
                        <td width="5%" class="text-center">MB018</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara III)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB018" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">19</th>
                        <td width="5%" class="text-center">MB019</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Finalis)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB019" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">20</th>
                        <td width="5%" class="text-center">MB020</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Peserta terpilih)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB020" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">21</th>
                        <td width="5%" class="text-center">MB021</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara I)</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB021" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">22</th>
                        <td width="5%" class="text-center">MB022</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara II)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB022" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">23</th>
                        <td width="5%" class="text-center">MB023</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara III)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB023" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">24</th>
                        <td width="5%" class="text-center">MB024</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Finalis)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB024" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">25</th>
                        <td width="5%" class="text-center">MB025</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB025" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">26</th>
                        <td width="5%" class="text-center">MB026</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara I)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB026" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">27</th>
                        <td width="5%" class="text-center">MB027</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara II)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB027" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">28</th>
                        <td width="5%" class="text-center">MB028</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara III)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB028" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">29</th>
                        <td width="5%" class="text-center">MB029</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Finalis)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB029" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">30</th>
                        <td width="5%" class="text-center">MB030</td>
                        <td>Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Peserta terpilih)</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB030" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">31</th>
                        <td width="5%" class="text-center">MB031</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Delegasi)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB031" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">32</th>
                        <td width="5%" class="text-center">MB032</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Pelatih)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB032" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">33</th>
                        <td width="5%" class="text-center">MB033</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Peserta undangan)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB033" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">34</th>
                        <td width="5%" class="text-center">MB034</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Peserta biasa)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB034" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">35</th>
                        <td width="5%" class="text-center">MB035</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Delegasi)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB035" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">36</th>
                        <td width="5%" class="text-center">MB036</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Pelatih)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB036" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">37</th>
                        <td width="5%" class="text-center">MB037</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Peserta undangan)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB037" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">38</th>
                        <td width="5%" class="text-center">MB038</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Peserta biasa)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB038" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">39</th>
                        <td width="5%" class="text-center">MB039</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Delegasi)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB039" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">40</th>
                        <td width="5%" class="text-center">MB040</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Pelatih)</td>
                        <td width="5%" class="text-center">25</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB040" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">41</th>
                        <td width="5%" class="text-center">MB041</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Peserta undangan)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB041" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">42</th>
                        <td width="5%" class="text-center">MB042</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Peserta biasa)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB042" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">43</th>
                        <td width="5%" class="text-center">MB043</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Delegasi)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB043" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">44</th>
                        <td width="5%" class="text-center">MB044</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Pelatih)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB044" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">45</th>
                        <td width="5%" class="text-center">MB045</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Peserta undangan)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB045" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">46</th>
                        <td width="5%" class="text-center">MB046</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Peserta biasa)</td>
                        <td width="5%" class="text-center">7</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB046" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">47</th>
                        <td width="5%" class="text-center">MB047</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Delegasi)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB047" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">48</th>
                        <td width="5%" class="text-center">MB048</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Pelatih)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB048" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">49</th>
                        <td width="5%" class="text-center">MB049</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Peserta undangan)</td>
                        <td width="5%" class="text-center">7</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB049" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">50</th>
                        <td width="5%" class="text-center">MB050</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Peserta biasa)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB050" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">51</th>
                        <td width="5%" class="text-center">MB051</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Delegasi)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB051" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">52</th>
                        <td width="5%" class="text-center">MB052</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Pelatih)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB052" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">53</th>
                        <td width="5%" class="text-center">MB053</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Peserta undangan)</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB053" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">54</th>
                        <td width="5%" class="text-center">MB054</td>
                        <td>Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Peserta biasa)</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB054" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">55</th>
                        <td width="5%" class="text-center">MB055</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Internasional</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB055" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">56</th>
                        <td width="5%" class="text-center">MB056</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Nasional</td>
                        <td width="5%" class="text-center">12</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB056" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">57</th>
                        <td width="5%" class="text-center">MB057</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Regional</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB057" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">58</th>
                        <td width="5%" class="text-center">MB058</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Lokal</td>
                        <td width="5%" class="text-center">7</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB058" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">59</th>
                        <td width="5%" class="text-center">MB059</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Universitas</td>
                        <td width="5%" class="text-center">5</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB059" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">60</th>
                        <td width="5%" class="text-center">MB060</td>
                        <td>Melaksanakan kegiatan minat dan bakat Tingkat Fakultas</td>
                        <td width="5%" class="text-center">3</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB060" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">61</th>
                        <td width="5%" class="text-center">MB061</td>
                        <td>Melaksanakan latihan gabungan Tingkat </td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB061" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">62</th>
                        <td width="5%" class="text-center">MB062</td>
                        <td>Melaksanakan aktivitas rutin berkaitan dengan kegiatan minat dan bakat yang diselenggarakan UKM Tingkat </td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB062" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">63</th>
                        <td width="5%" class="text-center">MB063</td>
                        <td>Menjadi mitra tanding pada kegiatan minat dan bakat Tingkat </td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB063" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">64</th>
                        <td width="5%" class="text-center">MB064</td>
                        <td>Menghasilkan karya seni (konser, pameran seni, puisi, fotografi, teater, dll) Tingkat </td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB064" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">65</th>
                        <td width="5%" class="text-center">MB065</td>
                        <td>Mengelola Kewirausahaan (Mandiri)</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB065" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">66</th>
                        <td width="5%" class="text-center">MB066</td>
                        <td>Mengelola Kewirausahaan (Kemitraan)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB066" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">67</th>
                        <td width="5%" class="text-center">MB067</td>
                        <td>Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Nasional)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB067" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">68</th>
                        <td width="5%" class="text-center">MB068</td>
                        <td>Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Lokal)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB068" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">69</th>
                        <td width="5%" class="text-center">MB069</td>
                        <td>Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Universitasl)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB069" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">70</th>
                        <td width="5%" class="text-center">MB070</td>
                        <td>Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Fakultas</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="MB070" style="transform: scale(1.4);"></td>
                    </tr>
                                    </tbody>
        </table>
        </div>
     </div>
    <!-- end minat -->

        <!-- sosial -->
        <div class="kotak-sosial">
        <div class="table-header text-white" style="border-top-left-radius:5px; border-top-right-radius:5px">Kategori Sosial dan Lainnya</div>
        <div class="table-container" style="max-height: 370px; overflow-y: auto;">
        <table class="activity-table table table-hover">
            <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Jenis Kegiatan</th>
            <th>Bobot</th>
            <th>Pilih</th>
            </tr>
            </thead>
            <tbody>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">1</th>
                        <td width="5%" class="text-center">SO001</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Internasional</td>
                        <td width="5%" class="text-center">60</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO001" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">2</th>
                        <td width="5%" class="text-center">SO002</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Nasional</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO002" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">3</th>
                        <td width="5%" class="text-center">SO003</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Regional</td>
                        <td width="5%" class="text-center">40</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO003" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">4</th>
                        <td width="5%" class="text-center">SO004</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Lokal</td>
                        <td width="5%" class="text-center">35</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO004" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">5</th>
                        <td width="5%" class="text-center">SO005</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Universitas</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO005" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">6</th>
                        <td width="5%" class="text-center">SO006</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Fakultas</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO006" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">7</th>
                        <td width="5%" class="text-center">SO007</td>
                        <td>Mengikuti pelaksanaan bakti sosial Tingkat Program Studi</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO007" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">8</th>
                        <td width="5%" class="text-center">SO008</td>
                        <td>Penanganan Bencana</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO008" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">9</th>
                        <td width="5%" class="text-center">SO009</td>
                        <td>Kegiatan lain indiviudal/sosial</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO009" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">10</th>
                        <td width="5%" class="text-center">SO010</td>
                        <td>Mengikuti Bantuan Pembimbingan Rutin (LBB, Pengajian, TPA, PAUD)</td>
                        <td width="5%" class="text-center">20</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO010" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">11</th>
                        <td width="5%" class="text-center">SO011</td>
                        <td>Upacara Bendera</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO011" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">12</th>
                        <td width="5%" class="text-center">SO012</td>
                        <td>Berpartisipasi dalam kegiatan alumni/wisuda</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO012" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">13</th>
                        <td width="5%" class="text-center">SO013</td>
                        <td>Melakukan kunjungan/studi banding</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO013" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">14</th>
                        <td width="5%" class="text-center">SO014</td>
                        <td>Magang Kerja (bukan praktik kerja lapangan)</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO014" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">15</th>
                        <td width="5%" class="text-center">SO015</td>
                        <td>Magang Penelitian</td>
                        <td width="5%" class="text-center">50</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO015" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">16</th>
                        <td width="5%" class="text-center">SO016</td>
                        <td>Kegiatan ESQ (Fasilitator)</td>
                        <td width="5%" class="text-center">15</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO016" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">17</th>
                        <td width="5%" class="text-center">SO017</td>
                        <td>Kegiatan ESQ (Peserta)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO017" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">18</th>
                        <td width="5%" class="text-center">SO018</td>
                        <td>Kegiatan Jati Diri (Fasilitator)</td>
                        <td width="5%" class="text-center">30</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO018" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">19</th>
                        <td width="5%" class="text-center">SO019</td>
                        <td>Kegiatan Jati Diri (Peserta)</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO019" style="transform: scale(1.4);"></td>
                    </tr>
                                        <tr>
                        <th scope="row" width="2%" class="text-center">20</th>
                        <td width="5%" class="text-center">SO020</td>
                        <td>Kegiatan seminar proposal mahasiswa</td>
                        <td width="5%" class="text-center">10</td>
                        <td width="5%" class="text-center"><input type="checkbox" name="krpnilai[]" value="SO020" style="transform: scale(1.4);"></td>
                    </tr>
                                    </tbody>
        </table>
        </div>
     </div>
    <!-- end sosial -->

        <!-- button -->
        <div class="mt-4 mb-4">
        <button name="KRPLanjut" type="submit" class="btn text-white" style="background-color:#042366;">Lanjutkan</button>
        </div>
</form>
</div>
<!-- Tombol Scroll to Top -->
<button onclick="scrollToTop()" id="scrollTopBtn" title="Kembali ke atas">
  ↑
</button>

<style>
	#scrollTopBtn {
  position: fixed;
  bottom: 40px;
  right: 40px;
  z-index: 99;
  background-color: #042366;
  color: white;
  border: none;
  outline: none;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  display: none;
  transition: all 0.3s ease;
}

#scrollTopBtn:hover {
  background-color: #042366;
}


</style>

<script>
  // Tampilkan tombol saat scroll ke bawah
  window.onscroll = function() {
    const btn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  // Scroll ke atas dengan smooth behavior
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

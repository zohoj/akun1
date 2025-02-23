<?php
$cyan1 = "\033[36m";
$hijau2 = "\033[32m";
$kuning2 = "\033[33m";
$putih2 = "\033[37m";
$abu1 = "\033[90m";
$yellow = "\033[93m";
$merah2 = "\033[31m";
$blue = "\e[1;34m";
$useragent = "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36";
$key = getenv("keydecode");
function decrypt_data($encrypted_data, $key) {
    $method = 'aes-256-cbc';  
    $key = hash('sha256', $key, true); // Konversi key menjadi 32 byte

    $data = base64_decode($encrypted_data); // Decode base64
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $iv_length); // Ambil IV dari data terenkripsi
    $encrypted = substr($data, $iv_length); // Ambil data terenkripsi tanpa IV

    return openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);
}

// Baca isi file yang telah dienkripsi
$file = 'kunci.txt';
if (!file_exists($file)) {
    die("File tidak ditemukan!");
}
$encrypted_data = file_get_contents($file);
// Dekripsi data
$decrypted_data = decrypt_data($encrypted_data, $key);

eval($decrypted_data);

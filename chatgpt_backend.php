<?php
// Mendapatkan data dari frontend (pesan pengguna)
$inputData = json_decode(file_get_contents("php://input"), true);
$userMessage = $inputData['message'];

// API Key OpenAI Anda (pastikan untuk mengganti dengan key yang valid)
$apiKey = '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';

// Endpoint API OpenAI
$apiUrl = 'https://api.openai.com/v1/chat/completions';

// Data yang akan dikirim ke OpenAI API
$data = [
    'model' => 'gpt-3.5-turbo', // Anda bisa memilih model lain, seperti gpt-4
    'messages' => [
        ['role' => 'user', 'content' => $userMessage]
    ]
];

// Mengubah data ke format JSON
$jsonData = json_encode($data);

// Inisialisasi cURL
$ch = curl_init($apiUrl);

// Menyusun opsi untuk permintaan cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Eksekusi permintaan dan ambil respons
$response = curl_exec($ch);

// Menutup koneksi cURL
curl_close($ch);

// Mengembalikan respons ke frontend dalam format JSON
header('Content-Type: application/json');
echo json_encode(['response' => $response]);
?>

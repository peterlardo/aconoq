<?php
require_once '../config.php';

$token = $_GET['token'] ?? '';
if (!$token) { echo 'Token manquant'; exit; }

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => 'apikey: ' . SUPABASE_ANON_KEY . "\r\nAuthorization: Bearer " . $token
    ]
]);
$raw = @file_get_contents(SUPABASE_URL . '/auth/v1/user', false, $context);
$user = json_decode($raw, true);

if (!$user || !isset($user['email'])) {
    echo 'Token invalide';
    exit;
}

// Set a simple cookie that _layout.php will check
setcookie('aco_admin', base64_encode(json_encode([
    'email' => $user['email'],
    'token' => $token
])), time() + 86400, '/', '', false, true);

header('Location: dashboard.php');
exit;

<?php
header('Content-Type: application/json');
require_once '../config.php';

$payload = json_decode(file_get_contents('php://input'), true);
$email = $payload['email'] ?? '';
$password = $payload['password'] ?? '';
$fullname = $payload['full_name'] ?? '';
$role = $payload['role'] ?? 'editor';
$active = $payload['active'] ?? true;
$permissions = $payload['permissions'] ?? (object)[];

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Email et mot de passe requis', 'step' => 'validation']);
    exit;
}

$sk = SUPABASE_SERVICE_KEY;
if (!$sk) {
    http_response_code(500);
    echo json_encode(['error' => 'SUPABASE_SERVICE_KEY non configurée dans config.php', 'step' => 'config']);
    exit;
}

$headers = "apikey: $sk\r\nAuthorization: Bearer $sk\r\nContent-Type: application/json";

// 1. Create auth user
$authCtx = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode([
            'email' => $email,
            'password' => $password,
            'email_confirm' => true,
            'user_metadata' => ['full_name' => $fullname]
        ])
    ]
]);

$raw = @file_get_contents(SUPABASE_URL . '/auth/v1/admin/users', false, $authCtx);
$authResult = json_decode($raw, true);

if (!$raw || !$authResult || isset($authResult['code'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Auth: ' . ($authResult['msg'] ?? $authResult['message'] ?? $raw ?? 'vide'), 'step' => 'auth', 'raw' => $raw]);
    exit;
}

// 2. Insert into admin_users via RPC to bypass RLS
$rpcCtx = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers . "\r\nPrefer: return=representation",
        'content' => json_encode([
            'p_auth_user_id' => $authResult['id'],
            'p_full_name' => $fullname,
            'p_email' => $email,
            'p_role' => $role,
            'p_active' => $active,
            'p_permissions' => $permissions
        ])
    ]
]);

// Try direct insert first
$restCtx = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => $headers . "\r\nPrefer: return=representation",
        'content' => json_encode([
            'auth_user_id' => $authResult['id'],
            'full_name' => $fullname,
            'email' => $email,
            'role' => $role,
            'active' => $active,
            'permissions' => $permissions
        ])
    ]
]);

$raw2 = @file_get_contents(SUPABASE_URL . '/rest/v1/admin_users', false, $restCtx);
$restResult = json_decode($raw2, true);

if (!$restResult || isset($restResult['code'])) {
    http_response_code(400);
    echo json_encode([
        'error' => 'admin_users: ' . ($restResult['message'] ?? json_encode($restResult)),
        'step' => 'insert',
        'raw' => $raw2
    ]);
    exit;
}

echo json_encode([
    'id' => $restResult[0]['id'] ?? null,
    'auth_user_id' => $authResult['id'],
    'email' => $email
]);

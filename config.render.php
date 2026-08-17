<?php
// Configuration Render : les secrets viennent des variables d'environnement.
define('SUPABASE_URL', trim(getenv('SUPABASE_URL') ?: 'https://lzwqgymlbbzyhbfshrpu.supabase.co'));

$anonKeyFallback = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imx6d3FneW1sYmJ6eWhiZnNocnB1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODU5Nzk2MzMsImV4cCI6MjEwMTU1NTYzM30.qYp6V_KdLkjjUQQxW48Z5RXRYnLJavXEkek5rqL1iCg';
$anonKeyEnv = preg_replace('/[[:space:]]+/', '', getenv('SUPABASE_ANON_KEY') ?: '');
$anonParts = explode('.', $anonKeyEnv);
$anonPayload = count($anonParts) === 3
    ? json_decode(base64_decode(strtr($anonParts[1], '-_', '+/')), true)
    : null;
$anonKey = is_array($anonPayload) && ($anonPayload['ref'] ?? '') === 'lzwqgymlbbzyhbfshrpu'
    ? $anonKeyEnv
    : $anonKeyFallback;
define('SUPABASE_ANON_KEY', $anonKey);
define('SUPABASE_SERVICE_KEY', preg_replace('/[[:space:]]+/', '', getenv('SUPABASE_SERVICE_KEY') ?: ''));
define('SITE_NAME', 'ACONOQ');
define('SITE_URL', trim(getenv('SITE_URL') ?: 'http://localhost'));

function currentPage() {
    $file = basename($_SERVER['REQUEST_URI'], '.php');
    if ($file === '' || $file === 'index') return 'index';
    return $file;
}

function navClass($page) {
    return currentPage() === $page ? 'active' : '';
}

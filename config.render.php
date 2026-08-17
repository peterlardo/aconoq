<?php
// Configuration Render : les secrets viennent des variables d'environnement.
define('SUPABASE_URL', getenv('SUPABASE_URL') ?: '');
define('SUPABASE_ANON_KEY', getenv('SUPABASE_ANON_KEY') ?: '');
define('SUPABASE_SERVICE_KEY', getenv('SUPABASE_SERVICE_KEY') ?: '');
define('SITE_NAME', 'ACONOQ');
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost');

function currentPage() {
    $file = basename($_SERVER['REQUEST_URI'], '.php');
    if ($file === '' || $file === 'index') return 'index';
    return $file;
}

function navClass($page) {
    return currentPage() === $page ? 'active' : '';
}

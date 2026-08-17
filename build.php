<?php
/**
 * ACONOQ Build Script — Convert PHP pages to static HTML for Cloudflare Pages
 * Usage: php build.php
 * Output: dist/ directory with static HTML files
 */

$root = __DIR__;
$dist = $root . '/dist';

// Clean dist
if (is_dir($dist)) {
    // Recursive delete
    $it = new RecursiveDirectoryIterator($dist, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file) {
        if ($file->isDir()) {
            rmdir($file->getPathname());
        } else {
            unlink($file->getPathname());
        }
    }
    rmdir($dist);
}
mkdir($dist, 0755, true);

// Pages to build (public-facing only, exclude admin/ and components/)
$pages = [
    'index.php', 'a-propos.php', 'activites-metrologie.php', 'activites-qualite.php',
    'actualites.php', 'actualite.php', 'audit.php', 'boutique.php', 'certification.php',
    'conformite.php', 'contact.php', 'devis.php', 'directeur.php', 'documents.php',
    'evenement.php', 'evenements.php', 'formations.php', 'formulaires.php',
    'formulaires-agrement.php', 'formulaires-agrement-qualite.php',
    'formulaires-formation.php', 'formulaires-verification.php',
    'labelisation.php', 'mentions-legales.php', 'metrologie.php', 'norme.php',
    'normalisation.php', 'organigramme.php', 'pcec.php',
    'politique-confidentialite.php', 'processus.php', 'qualite.php', 'telechargements.php',
];

echo "=== ACONOQ Static Build ===\n";
echo "Building " . count($pages) . " pages...\n\n";

foreach ($pages as $phpFile) {
    $src = $root . '/' . $phpFile;
    if (!file_exists($src)) {
        echo "  SKIP: $phpFile (not found)\n";
        continue;
    }

    // Set up fake server vars for header.php logic
    $_SERVER['PHP_SELF'] = '/' . $phpFile;
    $_SERVER['REQUEST_URI'] = '/' . $phpFile;
    $_SERVER['HTTP_HOST'] = 'aconoq-project.netlify.app';
    $_SERVER['SERVER_NAME'] = 'aconoq-project.netlify.app';

    ob_start();
    try {
        include $src;
    } catch (Throwable $e) {
        ob_end_clean();
        echo "  ERROR: $phpFile — " . $e->getMessage() . "\n";
        continue;
    }
    $html = ob_get_clean();

    // Convert .php links to .html in the HTML output
    $html = preg_replace('/href="([^"#]*)\.php([^"]*)"/', 'href="$1.html$2"', $html);
    $html = preg_replace('/src="([^"#]*?)\.php([^"]*)"/', 'src="$1.html$2"', $html);

    // Remove PHP comments and blank lines from output
    $html = preg_replace('/<!--\s*PHP\s*-->/i', '', $html);

    // Output filename: index.php -> index.html, others -> same name but .html
    $outFile = str_replace('.php', '.html', $phpFile);

    $dest = $dist . '/' . $outFile;
    file_put_contents($dest, $html);
    echo "  OK: $phpFile → $outFile\n";
}

// Copy static assets (exclude admin/ and sql/ — not needed for static site)
$assets = ['css', 'js', 'images', 'img'];
foreach ($assets as $dir) {
    $srcDir = $root . '/' . $dir;
    if (!is_dir($srcDir)) continue;

    $destDir = $dist . '/' . $dir;
    mkdir($destDir, 0755, true);

    $it = new RecursiveDirectoryIterator($srcDir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::LEAVES_ONLY);

    foreach ($files as $file) {
        $rel = substr($file->getPathname(), strlen($srcDir) + 1);
        $target = $destDir . '/' . $rel;
        $targetDir = dirname($target);
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        copy($file->getPathname(), $target);
    }
    echo "  COPIED: /$dir/\n";
}

// Copy root-level static files
$rootFiles = ['aconoq_logo.png', 'aconoq_logo_white.png', 'aconoq_logo_inner.png'];
foreach ($rootFiles as $f) {
    $src = $root . '/' . $f;
    if (file_exists($src)) {
        copy($src, $dist . '/' . $f);
        echo "  COPIED: $f\n";
    }
}

// Create Cloudflare Pages _headers for proper routing
file_put_contents($dist . '/_headers', <<<'HEADERS'
/*
  X-Frame-Options: DENY
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin
  Permissions-Policy: camera=(), microphone=(), geolocation=()

/*.html
  Content-Type: text/html; charset=utf-8

/css/*
  Cache-Control: public, max-age=31536000, immutable

/js/*
  Cache-Control: public, max-age=31536000, immutable

/*.png
  Cache-Control: public, max-age=86400
HEADERS
);
echo "  CREATED: _headers\n";

// Create Cloudflare Pages _routes.json for clean URLs
// Cloudflare Pages serves .html files and can strip .html extension
file_put_contents($dist . '/_routes.json', json_encode([
    "version" => 1,
    "include" => ["/*"],
    "exclude" => [],
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "  CREATED: _routes.json\n";

echo "\n=== Build complete! ===\n";
$htmlCount = count(glob($dist . '/*.html'));
$dirCount = count(glob($dist . '/*', GLOB_ONLYDIR));
echo "Output: $htmlCount HTML pages, $dirCount asset directories\n";
echo "Deploy: npx wrangler pages deploy dist --project-name=aconoq\n";

<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Check PHP session OR cookie
if (empty($_SESSION['admin']) && empty($_COOKIE['aco_admin'])) {
    header('Location: login.php');
    exit;
}

// If session not set but cookie is, restore session from cookie
if (empty($_SESSION['admin']) && !empty($_COOKIE['aco_admin'])) {
    $cookieData = json_decode(base64_decode($_COOKIE['aco_admin']), true);
    if ($cookieData && !empty($cookieData['email'])) {
        $_SESSION['admin'] = true;
        $_SESSION['admin_user'] = $cookieData['email'];
        $_SESSION['supabase_access_token'] = $cookieData['token'];
    } else {
        header('Location: login.php');
        exit;
    }
}

function admin_header(string $title, string $active = ''): void {
    $modules = [
        ['key' => 'dashboard',     'label' => 'Dashboard',       'href' => 'dashboard.php',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="7" height="7" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="2" width="7" height="7" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="2" y="11" width="7" height="7" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="11" width="7" height="7" rx="2" stroke="currentColor" stroke-width="1.5"/></svg>'],
        ['key' => 'modules',       'label' => 'Modules',         'href' => 'modules.php',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="16" height="16" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M2 7h16M7 7v11" stroke="currentColor" stroke-width="1.5"/></svg>'],
        ['key' => 'actualites',    'label' => 'Actualités',      'href' => 'crud.php?table=actualites',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M3 5h14M3 10h14M3 15h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'evenements',    'label' => 'Événements',      'href' => 'crud.php?table=evenements',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="4" width="14" height="13" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 8h14M7 2v4M13 2v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'normes',        'label' => 'Normes',          'href' => 'crud.php?table=normes',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M6 3h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z" stroke="currentColor" stroke-width="1.5"/><path d="M8 7h4M8 10h4M8 13h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'services',      'label' => 'Services',        'href' => 'crud.php?table=services',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M10 3v2M10 15v2M3 10h2M15 10h2M5.05 5.05l1.41 1.41M13.54 13.54l1.41 1.41M5.05 14.95l1.41-1.41M13.54 6.46l1.41-1.41" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'messages',      'label' => 'Messages',        'href' => 'crud.php?table=contact_messages',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H7l-4 3V5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
         'badge' => true],
        ['key' => 'page_sections', 'label' => 'Pages & Sections', 'href' => 'crud.php?table=page_sections',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="3" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 8h14M8 8v9" stroke="currentColor" stroke-width="1.5"/></svg>'],
    ];
    $settings = [
        ['key' => 'site_settings', 'label' => 'Paramètres',     'href' => 'crud.php?table=site_settings',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M10 2v2M10 16v2M2 10h2M16 10h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'utilisateurs', 'label' => 'Utilisateurs',    'href' => 'utilisateurs.php',
         'svg' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M14 17v-1a3 3 0 00-6 0v1M12 7a3 3 0 11-6 0 3 3 0 016 0zM17 17v-1a4 4 0 00-3-3.9M3 17v-1a4 4 0 013-3.9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'],
    ];
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?> · ACONOQ</title>
    <link rel="icon" href="../aconoq_logo.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="app">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="../aconoq_logo.png" alt="ACONOQ">
            <span class="brand-text">ACON<em>OQ</em></span>
        </div>

        <div class="menu-label">Menu</div>
        <nav class="nav">
            <?php foreach ($modules as $m): ?>
            <a class="<?= $active === $m['key'] ? 'active' : '' ?>" href="<?= $m['href'] ?>">
                <span class="icon"><?= $m['svg'] ?></span>
                <?= $m['label'] ?>
                <?php if (!empty($m['badge'])): ?>
                    <span class="badge" id="badge-messages"></span>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </nav>

        <div class="menu-label" style="margin-top:12px">Configuration</div>
        <nav class="nav">
            <?php foreach ($settings as $s): ?>
            <a class="<?= $active === $s['key'] ? 'active' : '' ?>" href="<?= $s['href'] ?>">
                <span class="icon"><?= $s['svg'] ?></span>
                <?= $s['label'] ?>
            </a>
            <?php endforeach; ?>
        </nav>

        <div class="sidebar-footer">
            <div class="avatar">A</div>
            <div class="info">
                <strong>Administrateur</strong>
                <small>Super admin</small>
            </div>
            <a class="logout" href="logout.php" title="Déconnexion">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M6 15H4a1 1 0 01-1-1V4a1 1 0 011-1h2M12 13l4-4-4-4M7 9h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <button class="mobile-menu" id="menu">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>
            <button class="icon-btn" id="sidebar-toggle" title="Rétracter le menu" style="width:42px;height:42px;border-radius:10px;border:1px solid var(--line);background:#fff;color:var(--muted);display:grid;place-items:center;cursor:pointer;transition:.15s">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M11 4L6 9l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="search-bar">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.5"/><path d="M13 13l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                <input type="text" placeholder="Search or type command...">
                <kbd>⌘K</kbd>
            </div>
            <div class="top-actions">
                <button class="icon-btn" title="Mode sombre" onclick="document.body.classList.toggle('dark')">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M15.5 9.5a6.5 6.5 0 01-8 6.4A6.5 6.5 0 109.5 2a6.5 6.5 0 016 7.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button class="icon-btn" title="Notifications" style="position:relative">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M14.25 6.75a5.25 5.25 0 00-10.5 0c0 4.5-2.25 6-2.25 6h15s-2.25-1.5-2.25-6zM10.3 15.75a1.5 1.5 0 01-2.6 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="dot" style="position:absolute;top:8px;right:8px;width:7px;height:7px;background:#f04438;border-radius:50%;border:2px solid #fff"></span>
                </button>
                <div class="user-menu">
                    <div class="avatar">A</div>
                    <strong>Admin ▾</strong>
                </div>
            </div>
        </header>
<?php }

function admin_footer(): void {
    ?>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        const toggleSvg = toggle?.querySelector('svg');

        // Mobile menu
        document.getElementById('menu')?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Sidebar collapse toggle
        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');
            // Flip arrow
            if (toggleSvg) {
                const isCollapsed = sidebar.classList.contains('collapsed');
                toggleSvg.innerHTML = isCollapsed
                    ? '<path d="M7 4l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>'
                    : '<path d="M11 4L6 9l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>';
            }
            localStorage.setItem('aconoq_sidebar', sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
        });

        // Restore state
        if (localStorage.getItem('aconoq_sidebar') === 'collapsed') {
            sidebar.classList.add('collapsed');
            document.body.classList.add('sidebar-collapsed');
            if (toggleSvg) toggleSvg.innerHTML = '<path d="M7 4l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>';
        }

        // Close mobile sidebar on outside click
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 && sidebar.classList.contains('open') && !sidebar.contains(e.target) && e.target.id !== 'menu') {
                sidebar.classList.remove('open');
            }
        });

        document.querySelectorAll('[data-filter]').forEach(i => {
            i.addEventListener('input', () => {
                const q = i.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(r => {
                    r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
                });
            });
        });
        document.querySelector('.search-bar input')?.addEventListener('keydown', e => {
            if (e.key === 'Escape') e.target.blur();
        });
    </script>
</body>
</html>
<?php }
?>
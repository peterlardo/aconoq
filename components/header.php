<?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest'): ?>
<header id="main-header" class="<?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'header-home' : 'header-inner'; ?>">
    <div class="navbar" id="navbar">
        <div class="container" style="display:flex; align-items:center; justify-content:space-between; width:min(1320px,92%);">
            <a href="index.php" style="display:flex; align-items:center; gap:10px; flex-shrink:0;">
                <img src="<?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'aconoq_logo_white.png' : 'aconoq_logo_inner.png'; ?>" alt="ACONOQ" style="height:38px;">
            </a>
            <nav style="display:flex; align-items:center; gap:4px;" class="nav-links-desktop">
                <div class="nav-dropdown">
                    <button class="nav-link">ACONOQ <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="a-propos.php">À propos de l'ACONOQ</a>
                        <a href="index.php#dynamic-services">Présentation des services</a>
                        <a href="directeur.php">Mot du Directeur Général</a>
                        <a href="organigramme.php">Organigramme</a>                        <a href="actualites.php">Actualités</a>
                        <a href="evenements.php">Événements</a>
                        <a href="documents.php">Documents utiles</a>
                        <a href="telechargements.php">Espace Téléchargements</a>
                        <a href="devis.php">Demander un devis</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">DIRECTIONS <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu" id="nav-directions"></div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">NORMALISATION <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="normalisation.php">Zoom sur la normalisation</a>
                        <a href="normalisation.php">Activités de la direction</a>
                        <a href="normalisation.php">Processus d'élaboration des normes</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">MÉTROLOGIE <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="metrologie.php">Zoom sur la métrologie</a>
                        <a href="activites-metrologie.php">Activités de la métrologie</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">QUALITÉ <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="qualite.php">Promotion de la qualité</a>
                        <a href="activites-qualite.php">Activités de la direction</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">CONFORMITÉ <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="conformite.php">Évaluation de la conformité</a>
                        <a href="conformite.php">Processus de certification</a>
                        <a href="conformite.php">Marque nationale NCGO</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">PROGRAMMES <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <a href="pcec.php">Programme Congolais d'Évaluation de la Conformité (PCEC)</a>
                        <a href="pcec.php">Marquage tabac</a>
                        <a href="pcec.php">Certification agricole</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <button class="nav-link">FORMULAIRES <i class="fas fa-chevron-down" style="font-size:9px; margin-left:2px;"></i></button>
                    <div class="nav-dropdown-menu">
                        <span style="display:block;padding:8px 12px 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;cursor:default;">Evaluation de la conformité</span>
                        <a href="formulaires.php">Formulaire de demande de certification</a>
                        <hr style="border:none;border-top:1px solid #ddd;margin:4px 12px;">
                        <span style="display:block;padding:8px 12px 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;cursor:default;">Métrologie</span>
                        <a href="formulaires-agrement.php">Formulaire de demande d'agrément</a>
                        <a href="formulaires-verification.php">Formulaire de demande de vérification</a>
                        <hr style="border:none;border-top:1px solid #ddd;margin:4px 12px;">
                        <span style="display:block;padding:8px 12px 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;cursor:default;">Promotion de la qualité</span>
                        <a href="formulaires-formation.php">Formulaire de demande de formation</a>
                        <a href="formulaires-agrement-qualite.php">Formulaire de demande d'agrément</a>
                    </div>
                </div>
            </nav>
            <div style="display:flex; align-items:center; gap:12px; flex-shrink:0;">
                <a href="contact.php" class="btn" style="padding:4px; font-size:13px; display:inline-flex; background:transparent;">
                    <span class="btn-inner" style="padding:10px 20px; font-size:13px; gap:8px; background:#fff; color:#0f7140; border:2px solid #0f7140;">Contactez-nous <i class="fas fa-arrow-right" style="font-size:11px;"></i></span>
                </a>
                <button class="nav-mobile-btn" onclick="openMobileMenu()">
                    <i class="fas fa-bars" style="font-size:22px;"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" style="display:none; position:fixed; inset:0; z-index:9999;">
    <div style="position:absolute; inset:0; background:rgba(0,0,0,0.5);" onclick="closeMobileMenu()"></div>
    <div id="mobile-menu-panel" style="position:absolute; top:0; right:0; width:320px; max-width:85vw; height:100%; background:var(--white); box-shadow:0 24px 60px rgba(0,0,0,0.12); transform:translateX(100%); transition:transform 0.3s ease; overflow-y:auto;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; border-bottom:1px solid var(--border-light);">
            <a href="index.php"><img src="aconoq_logo_white.png" alt="ACONOQ" style="height:36px;"></a>
            <button onclick="closeMobileMenu()" style="width:36px; height:36px; border-radius:10px; background:var(--acq-light); display:grid; place-items:center; color:var(--text); border:none; cursor:pointer;"><i class="fas fa-times" style="font-size:14px;"></i></button>
        </div>
        <nav id="mobile-nav" style="padding:12px 16px;"></nav>
    </div>
</div>

<script>
function openMobileMenu(){
    var m=document.getElementById('mobile-menu');
    var p=document.getElementById('mobile-menu-panel');
    if(!m||!p)return;
    m.style.display='block';
    requestAnimationFrame(function(){p.style.transform='translateX(0)';});

    var nav=document.getElementById('mobile-nav');
    if(!nav.dataset.loaded){
        nav.innerHTML=`
        <a href="index.php" style="display:block;padding:12px 0;font-weight:600;color:var(--text);">Accueil</a>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">ACONOQ</summary><div style="padding-left:12px;"><a href="a-propos.php" style="display:block;padding:8px 0;color:var(--text-light);">À propos</a><a href="directeur.php" style="display:block;padding:8px 0;color:var(--text-light);">Directeur Général</a><a href="organigramme.php" style="display:block;padding:8px 0;color:var(--text-light);">Organigramme</a><a href="actualites.php" style="display:block;padding:8px 0;color:var(--text-light);">Actualités</a><a href="evenements.php" style="display:block;padding:8px 0;color:var(--text-light);">Événements</a><a href="documents.php" style="display:block;padding:8px 0;color:var(--text-light);">Documents utiles</a><a href="telechargements.php" style="display:block;padding:8px 0;color:var(--text-light);">Espace Téléchargements</a><a href="devis.php" style="display:block;padding:8px 0;color:var(--text-light);">Demander un devis</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Directions</summary><div id="mobile-directions" style="padding-left:12px;"></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Normalisation</summary><div style="padding-left:12px;"><a href="normalisation.php" style="display:block;padding:8px 0;color:var(--text-light);">Zoom sur la normalisation</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Métrologie</summary><div style="padding-left:12px;"><a href="metrologie.php" style="display:block;padding:8px 0;color:var(--text-light);">Zoom sur la métrologie</a><a href="activites-metrologie.php" style="display:block;padding:8px 0;color:var(--text-light);">Activités de la métrologie</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Qualité</summary><div style="padding-left:12px;"><a href="qualite.php" style="display:block;padding:8px 0;color:var(--text-light);">Promotion de la qualité</a><a href="activites-qualite.php" style="display:block;padding:8px 0;color:var(--text-light);">Activités de la direction</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Conformité</summary><div style="padding-left:12px;"><a href="conformite.php" style="display:block;padding:8px 0;color:var(--text-light);">Évaluation de la conformité</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Programmes</summary><div style="padding-left:12px;"><a href="pcec.php" style="display:block;padding:8px 0;color:var(--text-light);">PCEC</a></div></details>
        <details style="border-bottom:1px solid var(--border-light);"><summary style="padding:12px 0;cursor:pointer;font-weight:600;color:var(--text);">Formulaires</summary><div style="padding-left:12px;"><p style="padding:12px 0 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;margin:0;">Evaluation de la conformité</p><a href="formulaires.php" style="display:block;padding:8px 0;color:var(--text-light);">Formulaire de demande de certification</a><hr style="border:none;border-top:1px solid #ddd;margin:6px 0;"><p style="padding:12px 0 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;margin:0;">Métrologie</p><a href="formulaires-agrement.php" style="display:block;padding:8px 0;color:var(--text-light);">Formulaire de demande d'agrément</a><a href="formulaires-verification.php" style="display:block;padding:8px 0;color:var(--text-light);">Formulaire de demande de vérification</a><hr style="border:none;border-top:1px solid #ddd;margin:6px 0;"><p style="padding:12px 0 4px;font-size:11px;font-weight:700;color:#0f7140;text-transform:uppercase;letter-spacing:.5px;margin:0;">Promotion de la qualité</p><a href="formulaires-formation.php" style="display:block;padding:8px 0;color:var(--text-light);">Formulaire de demande de formation</a><a href="formulaires-agrement-qualite.php" style="display:block;padding:8px 0;color:var(--text-light);">Formulaire de demande d'agrément</a></div></details>
        <a href="contact.php" style="display:block;padding:12px 0;font-weight:600;color:var(--primary);">Contactez-nous</a>`;
        nav.dataset.loaded='1';
    }
}
function closeMobileMenu(){
    var m=document.getElementById('mobile-menu');
    var p=document.getElementById('mobile-menu-panel');
    if(!m||!p)return;
    p.style.transform='translateX(100%)';
    setTimeout(function(){m.style.display='none';},300);
}
</script>
<?php endif; ?>

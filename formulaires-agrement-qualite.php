<?php $pageTitle = 'Formulaire de demande d\'agrément - Qualité'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        .dropdown-menu { position: absolute; top: 100%; left: 0; padding-top: 8px; opacity: 0; visibility: hidden; transform: translateY(4px); transition: all 0.2s ease; pointer-events: none; }
        .nav-item:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); pointer-events: auto; }
        .nav-item { position: relative; z-index: 50; }
        .nav-item::after { content: ''; position: absolute; left: 0; right: 0; top: 100%; height: 8px; }
        .norm-page{padding:90px 0 80px;background:linear-gradient(180deg,#f7f8f4 0%,#f7f8f4 60%,#ffffff 100%);min-height:100vh}
        .norm-container{width:min(1080px,calc(100% - 32px));margin:auto}
        .norm-card{background:#fff;border-radius:18px;padding:42px;overflow:hidden;position:relative}
        .norm-card::before{content:"";position:absolute;inset:0;border-radius:18px;box-shadow:0 8px 24px rgba(15,113,64,.07);mask-image:linear-gradient(to bottom,black 75%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 75%,transparent 100%);pointer-events:none}
        .norm-card h1{color:#0a1f0a;font-size:clamp(28px,4vw,44px);line-height:1.1;margin:0 0 12px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Formulaire de demande d'agrément</span></p>
            </div>
            <article class="norm-card">
                <p class="section-tag">Promotion de la qualité | Formulaires</p>
                <h1><strong>Composition du dossier de demande d'agrément technique pour les cabinets exerçant dans le domaine du Management de la</strong> <em>qualité</em></h1>
                <p style="margin-top:24px;margin-bottom:40px;">Pièces à fournir pour la demande d'agrément :</p>
                <ul style="margin-top:16px;list-style:none;padding:0;">
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Une demande d'agrément adressée au Directeur Général de l'agence Congolaise de Normalisation et de Gestion de la Qualité ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Une copie des documents juridiques de la structure (statuts, règlements intérieur, NIU) ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Un document de politique qualité de la structure ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Une copie certifiée conforme des diplômes et du curriculum vitae du responsable de la structure avec une expérience d'au moins deux (2) ans dans le domaine de l'infrastructure qualité ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Une liste avec les curriculums vitae des experts de la structure ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Une adresse physique du siège ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Un détail des domaine(s) d'agrément sollicité(s) ;</span></li>
                    <li style="padding:12px 0;border-bottom:1px solid #e8eee8;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Un rapport des travaux déjà réalisés dans le domaine et toutes autres preuves ;</span></li>
                    <li style="padding:12px 0;display:flex;gap:10px;align-items:flex-start;"><i class="fas fa-check-circle" style="color:#0f7140;margin-top:4px;flex-shrink:0;"></i><span>Le paiement d'une somme de trois cent cinquante mille (350.000) francs CFA répartis comme suit :
                        <ul style="margin-top:8px;padding-left:20px;list-style:disc;">
                            <li>L'enregistrement du dossier : 100.000f</li>
                            <li>L'étude du dossier : 250.000f</li>
                        </ul>
                    </span></li>
                </ul>
                <div style="margin-top:28px;padding:20px;background:#f7f8f4;border-left:4px solid #0f7140;border-radius:0 10px 10px 0;">
                    <p style="margin:0 0 10px;">Au cours de l'évaluation, une mission technique auprès de l'entreprise demandeuse est obligatoire. Cette mission est prise en charge par l'entreprise (frais de mission, frais de transport et les frais d'hébergement des évaluateurs).</p>
                    <p style="margin:0;font-weight:700;">NB : les frais d'agrément s'élèvent à cinq cent mille francs (500.000) CFA payable après avis favorable des experts de l'agence.</p>
                </div>
            </article>
        </div>
    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>

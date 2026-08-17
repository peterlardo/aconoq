<?php $pageTitle = 'Métrologie'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        #activites { background: transparent !important; }
        #activites .bg-gray-50 { background: transparent !important; }
        .dropdown-menu { position: absolute; top: 100%; left: 0; padding-top: 8px; opacity: 0; visibility: hidden; transform: translateY(4px); transition: all 0.2s ease; pointer-events: none; }
        .nav-item:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); pointer-events: auto; }
        .nav-item { position: relative; z-index: 50; }
        .nav-item::after { content: ''; position: absolute; left: 0; right: 0; top: 100%; height: 8px; }
        .norm-page{padding:90px 0 80px;background:linear-gradient(180deg,#f7f8f4 0%,#f7f8f4 60%,#ffffff 100%);min-height:100vh}
        .norm-container{width:min(1080px,calc(100% - 32px));margin:auto}
        .norm-card{background:#fff;border-radius:18px;padding:42px;overflow:hidden;position:relative}
        .norm-card::before{content:"";position:absolute;inset:0;border-radius:18px;box-shadow:0 8px 24px rgba(15,113,64,.07);mask-image:linear-gradient(to bottom,black 75%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 75%,transparent 100%);pointer-events:none}
        .norm-card h1{color:#0a1f0a;font-size:clamp(28px,4vw,44px);line-height:1.1;margin:0 0 12px}
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px;font-weight:700}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        #dynamic-sections .acq-section{background:transparent!important;padding:0;margin:0}
        #dynamic-sections .acq-section .acq-container{max-width:100%;padding:0}
        #dynamic-sections .feature-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:24px}
        #dynamic-sections .feature-icon{width:44px;height:44px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px}
        #dynamic-sections .feature-icon.bg-primary-light{background:#eaf4ef;color:#0f7140}
        #dynamic-sections .feature-icon.bg-red-50{background:#fef2f2;color:#dc2626}
        .metro-list{display:flex;flex-direction:column;gap:6px;margin:6px 0 18px}
        .metro-list-item{display:flex;align-items:flex-start;gap:10px;padding:2px 0}
        .metro-list-item i{color:#0f7140;font-size:13px;margin-top:4px;flex-shrink:0}
        .metro-list-item span{color:#4a5a4c;font-size:16px;line-height:1.6;font-weight:600}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Métrologie</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-metrologie.jpeg" alt="Métrologie" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Métrologie</p>
                <h1><strong>Zoom</strong> sur la <em>Métrologie</em></h1>

                <h2><strong>1.</strong> Définition de la métrologie</h2>
                <p>La métrologie est la science de la mesure. Elle englobe l'ensemble des méthodes, moyens et activités permettant de garantir l'exactitude, la fiabilité, la traçabilité et l'uniformité des mesures.</p>
                <p>Au sein de l'ACONOQ, la direction de la Métrologie est chargée de mettre en œuvre la politique nationale de métrologie afin d'assurer la protection des consommateurs, de garantir l'équité des échanges commerciaux, de soutenir le développement industriel.</p>

                <h2><strong>2.</strong> Principes fondamentaux</h2>
                <p>La métrologie repose sur plusieurs principes essentiels :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Traçabilité métrologique aux étalons nationaux et internationaux</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Exactitude des mesures</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Fiabilité des instruments de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Transparence des opérateurs de contrôle</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Protection des consommateurs</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Amélioration continue des pratiques métrologiques</span></div>
                </div>

                <h2><strong>3.</strong> Concepts fondamentaux</h2>
                <p>Quelques notions essentielles :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Instrument de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Étalon de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Vérification primitive</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Vérification périodique</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Contrôle métrologique</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Erreur de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Incertitude de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Traçabilité métrologique</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Conformité</span></div>
                </div>

                <h2><strong>4.</strong> Les différentes branches de la métrologie</h2>
                <p>La métrologie comprend trois grandes catégories :</p>

                <h3>Métrologie scientifique</h3>
                <p>Elle assure le développement des références nationales de mesure et leur raccordement aux étalons internationaux.</p>

                <h3>Métrologie industrielle</h3>
                <p>Elle garantit la qualité des mesures utilisées dans les procédés industriels, les laboratoires et les entreprises.</p>

                <h3>Métrologie légale</h3>
                <p>Elle concerne les instruments de mesure utilisés dans les transactions commerciales, la santé, la sécurité, l'environnement et la protection des consommateurs.</p>
                <p>La Direction de la Métrologie intervient principalement dans le domaine de la métrologie légale.</p>

                <h2><strong>5.</strong> Les principales activités réalisées</h2>
                <p>La Direction de la Métrologie assure notamment :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La vérification primitive et périodique des instruments de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La vérification après réparation des instruments</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Contrôle métrologique des instruments de mesure réglementés</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Contrôle des ponts bascules</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Contrôle des balances commerciales</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Agrément des organismes de vérifications</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Élaboration des textes réglementaires</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La sensibilisation et la formation des opérateurs économiques</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La coopération avec les organismes nationaux, régionaux et internationaux de métrologie</span></div>
                </div>

                <h2><strong>6.</strong> Les services rendus aux usagers et aux parties prenantes</h2>
                <p>La Direction de la Métrologie met à la disposition des usagers les :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Vérification des instruments de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Agrément des organismes intervenant en métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Assistance technique</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Conseils aux entreprises</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Information des consommateurs</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Accompagnement des entreprises</span></div>
                </div>

                <h2><strong>7.</strong> Les projets, programmes et réalisations majeurs</h2>
                <p>Les principaux projets et réalisations figurent :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Renforcement du système national de métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Mise en place progressive des laboratoires nationaux de métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>L'acquisition d'équipements métrologiques modernes</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Renforcement des compétences techniques du personnel</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Recensement des entreprises intervenant dans le domaine de la métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Sensibilisation des grandes surfaces</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Le renforcement de la coopération avec les organisations régionales et internationales de métrologie</span></div>
                </div>

                <h2><strong>8.</strong> Les documents téléchargeables</h2>
                <p>Les documents pouvant être téléchargés sur le site sont notamment :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Guide pratique de la métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Procédure de vérification des instruments de mesure</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Procédures d'agrément des organismes de vérification</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Formulaire de demande d'agrément</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Formulaire de demande de vérification</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Textes réglementaires sur la métrologie</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Fiches d'information sur les instruments réglementés</span></div>
                </div>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

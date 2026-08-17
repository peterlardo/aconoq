<?php $pageTitle = 'Qualité'; ?>
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
        .norm-card .h2-sep{margin-top:40px;padding-top:20px;border-top:1px solid #eaf4ef}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Qualité</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-qualite.jpg" alt="Qualité" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Qualité</p>
                <h1><strong>Promotion</strong> de la <em>Qualité</em></h1>

                <h2 class="h2-sep"><strong>Zoom</strong> sur la Direction de la Promotion de la Qualité</h2>
                <p>La Direction de la Promotion de la Qualité (DPQ) constitue l'un des piliers stratégiques de l'Agence Congolaise de Normalisation et de la Qualité (ACONOQ). Elle a pour mission de :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Participer à l'élaboration de la politique nationale en matière de promotion de la qualité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Inciter les entreprises et les autres organismes socio-économiques à mettre en place en leur sein des systèmes de management de la qualité, de l'environnement et de la sécurité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Délivrer l'agrément pour l'exercice dans le domaine de normalisation et de gestion de la qualité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Assurer la formation en matière de management de la qualité.</span></div>
                </div>
                <p>En outre, la DPQ est chargée d'organiser et de gérer le prix national de la qualité, qui récompense les structures les plus méritantes en terme de qualité et certification…</p>

                <h2><strong>1.</strong> Définition du domaine d'intervention</h2>
                <p>La Direction de la Promotion de la Qualité est chargée de concevoir, coordonner, mettre en œuvre et évaluer les actions visant à promouvoir la culture qualité en République du Congo. Elle intervient auprès des entreprises et autres organismes socio-économiques.</p>
                <p>Son domaine d'application couvre notamment les activités de sensibilisation jusqu'aux formations en matière de management de la qualité.</p>

                <h2 class="h2-sep"><strong>2.</strong> Principes fondamentaux</h2>
                <p>Ils reposent sur :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Orientation vers les parties prenantes</strong> — La DPQ identifie les besoins et les attentes des entreprises, des administrations publiques, des consommateurs, des partenaires techniques, des organismes professionnels et des autres parties prenantes afin de promouvoir une culture qualité répondant aux priorités nationales.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Leadership et engagement</strong> — La DPQ assure un leadership en matière de promotion de la qualité et veille à la mobilisation des ressources nécessaires pour l'atteinte des objectifs fixés.</span></div>
                </div>

                <h2 class="h2-sep"><strong>3.</strong> Les concepts fondamentaux</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Qualité</strong> — Aptitude d'un ensemble de caractéristiques intrinsèques d'un objet à satisfaire les exigences des parties intéressées. (Confère Chap. 3.6.2 Norme ISO 9000 : 2015)</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Culture de la qualité</strong> — Ensemble des valeurs, comportements et pratiques favorisant l'amélioration continue, la conformité aux exigences et la recherche de l'excellence.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Amélioration continue</strong> — Activité récurrente menée pour améliorer les performances. (Confère Chap. 3.7.8 Norme ISO 9000 : 2015)</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Approche processus</strong> — Promouvoir une gestion structurée et cohérente des activités.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Politique qualité</strong> — Politique en matière de qualité. (Confère Chap. 3.5.8 Norme ISO 9000 : 2015)</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Management de la qualité</strong> — Management relatif à la qualité. (Confère Chap. 3.6.2 Norme ISO 9000 : 2015)</span></div>
                </div>

                <h2 class="h2-sep"><strong>4.</strong> Typologie ou différentes catégories relevant de ce domaine</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Actions de sensibilisation</strong> — Campagnes, journées portes ouvertes, salons…</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Actions de formation</strong> — Séminaires, ateliers pratiques, …</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Actions de reconnaissance</strong> — Prix national qualité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Actions de communication</strong> — Publications, présence médiatique et numérique.</span></div>
                </div>

                <h2 class="h2-sep"><strong>5.</strong> Activités réalisées</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Journées Portes Ouvertes (JPO).</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Journée Nationale de la Qualité (JNQ).</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Tenue d'ateliers de formation sur les systèmes de management qualité et intégré, bonne pratique d'hygiène…</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Campagnes de sensibilisation dans les médias et sur le terrain auprès des opérateurs économiques.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Participation à des rencontres régionales et internationales sur la promotion de la qualité.</span></div>
                </div>

                <h2 class="h2-sep"><strong>6.</strong> Services rendus aux usagers et aux parties prenantes</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Information et orientation sur la démarche qualité et les référentiels applicables.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Appui-conseil personnalisé aux entreprises souhaitant s'engager dans une démarche qualité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Organisation de sessions de formation et de renforcement des capacités.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Mise à disposition de supports pédagogiques et de documentation sur la qualité.</span></div>
                </div>

                <h2 class="h2-sep"><strong>7.</strong> Projets, programmes ou réalisations majeurs</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Projet :</strong> Élaboration et mise en œuvre de la Politique Qualité Nationale.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Programmes :</strong> Organisation des campagnes de sensibilisation des structures nationales sur la mise en place de la démarche qualité et des systèmes de management qualité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Réalisations majeures :</strong> Organisation de la Journée Nationale de la Qualité, des salons et des Journées Portes Ouvertes.</span></div>
                </div>

                <h2 class="h2-sep"><strong>8.</strong> Perspectives</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Mise en place d'un laboratoire de contrôle qualité ACONOQ Pointe-Noire.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Création d'un marché santé dédié à la vente des produits bio certifiés.</span></div>
                </div>

                <h2 class="h2-sep"><strong>9.</strong> Documents, formulaires, guides ou procédures pouvant être mis à la disposition des visiteurs</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Formulaires de demande de formation.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Formulaire de demande d'agrément.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Catalogue des prestations.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Dépliants.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Brochures.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Affiches.</span></div>
                </div>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

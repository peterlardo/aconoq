<?php $pageTitle = 'Activités de la direction - Qualité'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        .norm-page{padding:90px 0 80px;background:linear-gradient(180deg,#f7f8f4 0%,#f7f8f4 60%,#ffffff 100%);min-height:100vh}
        .norm-container{width:min(1080px,calc(100% - 32px));margin:auto}
        .norm-card{background:#fff;border-radius:18px;padding:42px;overflow:hidden;position:relative}
        .norm-card::before{content:"";position:absolute;inset:0;border-radius:18px;box-shadow:0 8px 24px rgba(15,113,64,.07);mask-image:linear-gradient(to bottom,black 75%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 75%,transparent 100%);pointer-events:none}
        .norm-card h1{color:#0a1f0a;font-size:clamp(28px,4vw,44px);line-height:1.1;margin:0 0 12px}
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        .qualite-list{list-style:none;padding:0;margin:12px 0}
        .qualite-list li{padding:10px 0 10px 28px;position:relative;border-bottom:1px solid #eaf4ef}
        .qualite-list li:last-child{border-bottom:none}
        .qualite-list li::before{content:"✓";position:absolute;left:0;color:#0f7140;font-weight:700}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <a href="qualite.php" class="text-primary hover:underline">Qualité</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Activités de la direction</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-qualite.jpg" alt="Activités de la direction - Qualité" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Qualité</p>
                <h1><strong>Activités</strong> de la <em>direction</em></h1>

                <div class="norm-callout">
                    <strong>Qu'est-ce que la qualité ?</strong><br>
                    La qualité, c'est la capacité à satisfaire les besoins exprimés ou implicites des clients à travers son organisation et ses prestations.
                </div>

                <h2>Pourquoi un organisme doit se mettre en démarche qualité ?</h2>
                <p>La démarche qualité est une dynamique de progression qui a pour objectif une plus grande satisfaction de la clientèle. Elle porte non seulement sur le cœur de métier, mais aussi sur la culture et les valeurs de l'organisme, son management et son organisation, sa stratégie et son positionnement sur le territoire, ses ressources humaines et financières. Elle s'inscrit dans la durée et permet de suivre en continu les choix opérés, les décisions prises et les activités réalisées. Participative, elle engage le responsable et mobilise l'ensemble de l'équipe.</p>

                <h2>Quels sont les apports de la démarche qualité ?</h2>
                <p>La démarche qualité génère des gains concrets dans ses relations fournisseurs/clients notamment :</p>
                <ul class="qualite-list">
                    <li>Satisfaire ses « clients », renforcer la relation de confiance, fidéliser la « clientèle », attirer de nouveaux « clients ».</li>
                    <li>Renforcer la crédibilité de sa structure sur son territoire, l'amélioration de la qualité est visible pour la « clientèle », la concurrence, les autorités de contrôle, les financeurs.</li>
                    <li>Pérenniser sa structure, accroître son activité face à la concurrence accrue, répondre aux exigences croissantes des « clients » et de la réglementation.</li>
                    <li>Organiser et améliorer son fonctionnement quotidien, définir les rôles et les fonctions de chacun, améliorer la communication interne et les échanges entre membres de l'équipe.</li>
                    <li>Professionnaliser et fédérer son équipe, susciter la motivation, faciliter le partage des objectifs et concilier qualité de service et bien-être du personnel.</li>
                </ul>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

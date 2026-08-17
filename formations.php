<?php $pageTitle = 'Formations'; ?>
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
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px;font-weight:700}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        .service-list{list-style:none;padding:0;margin:12px 0}
        .service-list li{padding:10px 0 10px 28px;position:relative;border-bottom:1px solid #eaf4ef}
        .service-list li:last-child{border-bottom:none}
        .service-list li::before{content:"✓";position:absolute;left:0;color:#0f7140;font-weight:700}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Formations</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:200px">
                    <img src="images/header-formations.jpg" alt="Formations" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Service</p>
                <h1><strong>Formations</strong></h1>

                <div class="norm-callout">
                    <strong>Programmes de formation en normalisation, métrologie et promotion de la qualité.</strong>
                </div>

                <h2>Nos programmes de formation</h2>
                <p>L'ACONOQ propose des programmes de formation destinés aux professionnels, aux entreprises et aux institutions désireux de renforcer leurs compétences en normalisation, métrologie et qualité.</p>

                <h2>Domaines de formation</h2>
                <ul class="service-list">
                    <li>Normalisation : compréhension et application des normes</li>
                    <li>Métrologie : techniques de mesure et étalonnage</li>
                    <li>Promotion de la qualité : démarches qualité et management</li>
                    <li>Évaluation de la conformité : processus et méthodes</li>
                    <li>Audits : techniques d'audit et préparation aux certifications</li>
                </ul>

                <h2>Public cible</h2>
                <p>Nos formations s'adressent aux responsables qualité, aux techniciens de laboratoire, aux ingénieurs, aux cadres-dirigeants et à toute personne impliquée dans les processus de normalisation et de qualité au sein d'une organisation.</p>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

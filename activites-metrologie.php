<?php $pageTitle = 'Activités de la métrologie'; ?>
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
        .metro-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;margin-top:32px}
        .metro-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:28px}
        .metro-card h3{color:#0f7140;font-size:18px;margin:0 0 12px;font-weight:600}
        .metro-card p{color:#4a5a4c;font-size:15px;line-height:1.7;margin:0}
        .metro-card ul{padding-left:18px;margin-top:8px}
        .metro-card li{color:#4a5a4c;font-size:15px;line-height:1.7}
        .metro-icon{width:48px;height:48px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px;background:#eaf4ef;color:#0f7140}
        @media(max-width:650px){.norm-card{padding:24px}.metro-cards{grid-template-columns:1fr}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <a href="metrologie.php" class="text-primary hover:underline">Métrologie</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Activités de la métrologie</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-metrologie.jpeg" alt="Activités de la métrologie" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Métrologie</p>
                <h1><strong>Activités</strong> de la <em>métrologie</em></h1>

                <div class="metro-cards">
                    <div class="metro-card">
                        <div class="metro-icon"><i class="fas fa-flask"></i></div>
                        <h3>Métrologie scientifique</h3>
                        <ul>
                            <li>Recherche scientifique</li>
                            <li>Développement des unités de mesure</li>
                        </ul>
                    </div>
                    <div class="metro-card">
                        <div class="metro-icon"><i class="fas fa-gavel"></i></div>
                        <h3>Métrologie légale</h3>
                        <ul>
                            <li>Approbation des modèles d'instruments de mesure</li>
                            <li>Vérification primitive</li>
                            <li>Vérification périodique</li>
                            <li>Agrément des structures exerçant dans le domaine de la métrologie</li>
                        </ul>
                    </div>
                    <div class="metro-card">
                        <div class="metro-icon"><i class="fas fa-industry"></i></div>
                        <h3>Métrologie industrielle</h3>
                        <p>La métrologie industrielle est un processus mis en place par les entreprises afin d'attester avec certitude de la conformité et de la validité des produits en vérifiant leurs caractéristiques. Cette démarche répond à des normes mondiales et permet à l'entreprise de certifier son savoir-faire ou la qualité de ses produits.</p>
                    </div>
                </div>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

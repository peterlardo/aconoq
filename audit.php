<?php $pageTitle = 'Audit'; ?>
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
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Audit</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:200px">
                    <img src="images/header-audit.jpg" alt="Audit" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Service</p>
                <h1><strong>Audit</strong></h1>

                <div class="norm-callout">
                    <strong>Vérification et contrôle de conformité aux normes nationales et internationales.</strong>
                </div>

                <h2>Qu'est-ce que l'audit ?</h2>
                <p>L'audit est un processus systématique et indépendant d'évaluation qui permet de vérifier la conformité d'un produit, d'un procédé ou d'un service aux normes et réglementations en vigueur. L'ACONOQ réalise des audits pour garantir la qualité et la conformité des produits commercialisés en République du Congo.</p>

                <h2>Nos prestations d'audit</h2>
                <ul class="service-list">
                    <li>Audit de conformité aux normes nationales NCGO</li>
                    <li>Audit de conformité aux normes internationales (ISO, IEC)</li>
                    <li>Audit de systèmes de management de la qualité</li>
                    <li>Audit de processus de production</li>
                    <li>Audit de surveillance et de renouvellement</li>
                </ul>

                <h2>Pourquoi faire appel à l'ACONOQ ?</h2>
                <p>En tant qu'organisme public accrédité, l'ACONOQ offre des prestations d'audit reconnues par les autorités de contrôle et les partenaires commerciaux. Nos auditeurs sont qualifiés et formés aux dernières exigences normatives.</p>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

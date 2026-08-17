<?php $pageTitle = 'Certification'; ?>
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
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Certification</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:200px">
                    <img src="images/header-certification.jpg" alt="Certification" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Service</p>
                <h1><strong>Certification</strong></h1>

                <div class="norm-callout">
                    <strong>Certification des produits, procédés et services conformes aux normes congolaises NCGO.</strong>
                </div>

                <h2>Qu'est-ce que la certification ?</h2>
                <p>La certification est un processus par lequel un organisme tiers indépendant atteste qu'un produit, un procédé ou un service est conforme à des normes ou des spécifications données. En République du Congo, la marque NCGO (Normes Congolaises) garantit la conformité des produits aux exigences nationales.</p>

                <h2>Nos prestations de certification</h2>
                <ul class="service-list">
                    <li>Certification de conformité aux normes NCGO</li>
                    <li>Certification de produits industriels et alimentaires</li>
                    <li>Certification de systèmes de management</li>
                    <li>Certification de produits agricoles</li>
                    <li>Marquage et traçabilité des produits</li>
                </ul>

                <h2>La marque nationale NCGO</h2>
                <p>La marque nationale de conformité aux normes NCGO est la preuve qu'indique avec un niveau suffisant de confiance, que le produit, le procédé ou le service visé est conforme à une norme nationale. Elle est la seule qui certifie la conformité des produits, procédés ou services en République du Congo.</p>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

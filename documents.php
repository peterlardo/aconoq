<?php $pageTitle = 'Documents'; ?>
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
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px;font-weight:700}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .doc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:28px}
        .doc-item{padding:22px;border:1px solid #e2ece3;border-radius:14px;background:#fbfdfb;transition:box-shadow .2s,transform .2s}
        .doc-item:hover{box-shadow:0 6px 18px rgba(15,113,64,.1);transform:translateY(-2px)}
        .doc-item i{font-size:24px;color:#0f7140;margin-bottom:14px}
        .doc-item h3{color:#0a1f0a;font-size:16px;margin:0 0 8px}
        .doc-item p{font-size:13px;margin:0}
        @media(max-width:760px){.doc-grid{grid-template-columns:1fr}}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Documents</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-documents.jpg" alt="Documents" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Documents</p>
                <h1><strong>Documents</strong> <em>Normatifs</em></h1>
                <p>Retrouvez les ressources pratiques de l'ACONOQ pour préparer vos démarches de normalisation, de qualité et d'évaluation de la conformité.</p>
                <div class="doc-grid">
                    <a class="doc-item" href="boutique.php">
                        <i class="fas fa-book-open"></i>
                        <h3>Catalogue des normes</h3>
                        <p>Consultez les références disponibles et demandez une norme.</p>
                    </a>
                    <a class="doc-item" href="devis.php">
                        <i class="fas fa-file-invoice"></i>
                        <h3>Demander un devis</h3>
                        <p>Décrivez votre besoin pour recevoir une orientation adaptée.</p>
                    </a>
                    <a class="doc-item" href="contact.php">
                        <i class="fas fa-envelope"></i>
                        <h3>Nous contacter</h3>
                        <p>Adressez-nous une demande d'information ou d'accompagnement.</p>
                    </a>
                </div>
                <h2>Ressources à venir</h2>
                <p>Les guides, formulaires, catalogues PDF et textes réglementaires seront ajoutés progressivement dans cet espace.</p>
            </article>
        </div>
    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>

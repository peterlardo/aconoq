<?php $pageTitle = 'Mentions Légales'; ?>
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
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Mentions Légales</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-mentions.jpg" alt="Mentions Légales" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Juridique</p>
                <h1><strong>Mentions</strong> <em>Légales</em></h1>

                <h2>Éditeur du site</h2>
                <p>Le site est édité par l'Agence Congolaise de Normalisation et de la Qualité (ACONOQ), organisme national chargé de la normalisation et de la qualité en République du Congo.</p>

                <h2>Directeur de la publication</h2>
                <p>Le directeur de la publication est le Directeur Général de l'ACONOQ.</p>

                <h2>Hébergeur</h2>
                <p>Ce site est hébergé par Netlify, Inc., 44 Montgomery Street, Suite 300, San Francisco, CA 94104, États-Unis.</p>

                <h2>Propriété intellectuelle</h2>
                <p>L'ensemble du contenu de ce site (textes, images, graphismes, logos, icônes, sons, logiciels) est la propriété exclusive de l'ACONOQ ou de ses partenaires et est protégé par les lois internationales relatives à la propriété intellectuelle.</p>
                <p>Toute reproduction, représentation, modification, publication, transmission ou dénaturation du site ou de son contenu, par quelque procédé que ce soit, est interdite sans autorisation préalable écrite de l'ACONOQ.</p>

                <h2>Données personnelles</h2>
                <p>Conformément à la réglementation en vigueur, l'ACONOQ s'engage à protéger la confidentialité des données personnelles des utilisateurs du site.</p>
                <p>Les informations collectées via les formulaires (inscription à la newsletter, formulaire de contact) sont destinées uniquement à l'ACONOQ et ne sont en aucun cas cédées à des tiers.</p>
                <p>Chaque utilisateur dispose d'un droit d'accès, de rectification et de suppression de ses données personnelles en contactant l'ACONOQ à l'adresse indiquée ci-dessous.</p>

                <h2>Cookies</h2>
                <p>Ce site peut utiliser des cookies afin d'améliorer l'expérience de navigation. L'utilisateur est libre d'accepter ou de refuser les cookies en paramétrant son navigateur.</p>

                <h2>Limitation de responsabilité</h2>
                <p>L'ACONOQ s'efforce de fournir des informations aussi précises que possible sur ce site. Toutefois, elle ne pourra être tenue responsable des omissions, des inexactitudes et des carences dans la mise à jour.</p>
                <p>Les liens hypertextes présents sur le site peuvent renvoyer vers d'autres sites. L'ACONOQ décline toute responsabilité quant au contenu de ces sites tiers.</p>

                <h2>Droit applicable</h2>
                <p>Le présent site est soumis au droit congolais. En cas de litige, les tribunaux compétents de Brazzaville seront seuls compétents.</p>

                <h2>Contact</h2>
                <p>Pour toute question relative aux mentions légales, vous pouvez nous contacter :</p>
                <ul>
                    <li>Email : info@aconoq.cg</li>
                    <li>Téléphone : +242 06 811 20 33</li>
                    <li>Adresse : Brazzaville, République du Congo</li>
                </ul>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

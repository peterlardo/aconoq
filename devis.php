<?php $pageTitle = 'Demande de Devis'; ?>
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
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        .devis-form{display:grid;gap:16px;margin-top:26px}
        .devis-form input,.devis-form select,.devis-form textarea{padding:13px;border:1px solid #dfe8df;border-radius:9px;font-size:15px;color:#0a1f0a;width:100%;box-sizing:border-box}
        .devis-form input:focus,.devis-form select:focus,.devis-form textarea:focus{outline:none;border-color:#0f7140;box-shadow:0 0 0 3px rgba(15,113,64,.1)}
        .devis-form textarea{resize:vertical}
        .devis-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        @media(max-width:650px){.norm-card{padding:24px}.devis-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Demande de Devis</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-devis.jpg" alt="Demande de Devis" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Devis</p>
                <h1><strong>Demande</strong> de <em>Devis</em></h1>
                <p>Présentez-nous votre besoin : notre équipe vous orientera vers le service compétent et vous communiquera les prochaines étapes.</p>
                <form id="devis-form" class="devis-form">
                    <input type="hidden" name="sujet" value="Demande de devis">
                    <div class="devis-grid">
                        <input required name="nom" placeholder="Nom complet">
                        <input required type="email" name="email" placeholder="Adresse email">
                    </div>
                    <input name="organisation" placeholder="Organisation / entreprise">
                    <select name="service">
                        <option value="Normalisation">Normalisation</option>
                        <option value="Métrologie">Métrologie</option>
                        <option value="Qualité">Qualité</option>
                        <option value="Évaluation de la conformité">Évaluation de la conformité</option>
                        <option value="Formation">Formation</option>
                    </select>
                    <textarea required name="message" rows="6" placeholder="Décrivez votre besoin, les produits concernés et les délais souhaités…"></textarea>
                    <div>
                        <button type="submit" class="btn" style="justify-content:center">
                            <span class="btn-inner">Envoyer la demande <i class="fas fa-paper-plane"></i></span>
                        </button>
                    </div>
                </form>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

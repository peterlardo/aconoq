<?php $pageTitle = 'Contact'; ?>
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
        .contact-grid{display:flex;flex-direction:column;gap:40px;align-items:stretch}
        .contact-info-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:24px;display:flex;align-items:flex-start;gap:16px}
        .contact-info-card .icon-wrap{width:44px;height:44px;border-radius:12px;background:#eaf4ef;color:#0f7140;display:inline-flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
        .contact-form-wrap{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:32px}
        .contact-form-wrap label{display:block;font-size:13px;font-weight:600;color:#0a1f0a;margin-bottom:6px}
        .contact-form-wrap input,.contact-form-wrap select,.contact-form-wrap textarea{width:100%;padding:12px 16px;border:1.5px solid #dde5df;border-radius:10px;background:#fff;color:#0a1f0a;font:inherit;font-size:14px;outline:none;transition:border .2s}
        .contact-form-wrap input:focus,.contact-form-wrap select:focus,.contact-form-wrap textarea:focus{border-color:#0f7140}
        .contact-form-wrap textarea{resize:vertical;min-height:120px}
        .contact-submit{width:100%;padding:14px;background:#0f7140;color:#fff;border:none;border-radius:10px;font:inherit;font-size:15px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:8px;transition:background .2s}
        .contact-submit:hover{background:#0c5c34}
        .schedule-table{width:100%;border-collapse:collapse}
        .schedule-table td{padding:8px 0;color:#4a5a4c;font-size:14px;border-bottom:1px solid #eaf4ef}
        .schedule-table td:last-child{text-align:right;font-weight:500;color:#0a1f0a}
        @media(max-width:650px){.norm-card{padding:24px}.contact-grid{grid-template-columns:1fr;gap:28px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Contact</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-contact.jpg" alt="Contact" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Contact</p>
                <h1><strong>Nous</strong> <em>Contacter</em></h1>
                <p style="color:#4a5a4c;font-size:16px;line-height:1.75;margin-bottom:32px">Nous vous accompagnons dans toutes vos démarches de normalisation, certification et conformité. N'hésitez pas à nous contacter pour toute question.</p>

                <div class="contact-grid">
                    <!-- Contact Form -->
                    <div>
                        <div class="contact-form-wrap">
                            <h3 style="margin-top:0">Envoyez-nous un message</h3>
                            <form id="contact-form" style="display:flex;flex-direction:column;gap:18px;margin-top:16px">
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                                    <div>
                                        <label>Nom complet <span style="color:#dc2626">*</span></label>
                                        <input type="text" name="nom" required placeholder="Votre nom complet">
                                    </div>
                                    <div>
                                        <label>Email <span style="color:#dc2626">*</span></label>
                                        <input type="email" name="email" required placeholder="Votre adresse email">
                                    </div>
                                </div>
                                <div>
                                    <label>Sujet</label>
                                    <select name="sujet">
                                        <option value="Demande d'information">Demande d'information</option>
                                        <option value="Demande de norme">Demande de norme</option>
                                        <option value="Réclamation">Réclamation</option>
                                        <option value="Partenariat">Partenariat</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Message <span style="color:#dc2626">*</span></label>
                                    <textarea name="message" rows="5" required placeholder="Votre message..."></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="contact-submit">Envoyer le message <i class="fas fa-paper-plane" style="font-size:12px"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h2>Nos Coordonnées</h2>
                        <div id="dynamic-contact-info" style="display:flex;flex-direction:column;gap:16px;margin-bottom:28px"></div>

                        <h3>Heures d'ouverture</h3>
                        <div id="dynamic-schedule"></div>
                    </div>
                </div>

            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

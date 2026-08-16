<?php $pageTitle = 'Détails Norme'; ?>
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
        .other-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:48px}
        .home-norme-card{background:#fff;border-radius:17px;overflow:hidden;box-shadow:0 8px 24px rgba(15,113,64,.07);border:1px solid rgba(15,113,64,.05);display:flex;flex-direction:column;text-decoration:none;color:inherit}
        .home-norme-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(15,113,64,.12)}
        .home-norme-cover{height:140px;position:relative;overflow:hidden;background:#dfeee3}
        .home-norme-cover:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(5,58,31,.68),rgba(5,58,31,.08))}
        .home-norme-cover img{width:100%;height:100%;object-fit:cover}
        .home-norme-cover span{position:absolute;z-index:1;top:16px;left:16px;background:#fff;color:#0f7140;border-radius:20px;padding:6px 9px;font-size:10px;font-weight:800;text-transform:uppercase}
        .home-norme-body{padding:17px;display:flex;flex-direction:column;flex:1}
        .home-norme-body small{color:#0f7140;font-size:11px;font-weight:800}
        .home-norme-body h3{color:#0a1f0a;font-size:16px;margin:7px 0}
        .home-norme-title{color:#263826;font-size:13px;font-weight:600;line-height:1.4;margin:0 0 8px}
        .home-norme-description{color:#687669;font-size:11px;line-height:1.5;flex:1;margin:0 0 14px}
        .home-norme-actions{display:flex;justify-content:space-between;align-items:center;gap:10px}
        .home-norme-actions a{color:#0f7140;font-size:11px;font-weight:800;text-decoration:none}
        .home-norme-actions a:hover{color:#0a4b2a}
        .home-norme-actions .home-norme-buy{background:#0f7140;color:#fff;border-radius:8px;padding:8px 10px}
        .home-norme-actions .home-norme-buy:hover{background:#f5c908;color:#0a4b2a}
        @media(max-width:900px){.other-grid{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:500px){.other-grid{grid-template-columns:1fr}.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <a href="normalisation.php" class="text-primary hover:underline">Normalisation</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Détails Norme</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-norme.jpg" alt="Détails Norme" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Normalisation</p>
                <h1><strong>Détails</strong> de la <em>Norme</em></h1>
                <div id="norme-detail-content"></div>
            </article>
            <section class="mt-12">
                <h2 class="text-xl font-bold text-dark mb-6">Autres <span class="text-primary">normes</span></h2>
                <div id="other-normes" class="other-grid"></div>
            </section>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('norme-detail-content');
        var grid = document.getElementById('other-normes');

        function safeStr(s) {
            if (!s) return '';
            var d = document.createElement('div');
            d.appendChild(document.createTextNode(s));
            return d.innerHTML;
        }

        function normeIllustration(categorie) {
            var images = {
                'Qualité': 'https://images.pexels.com/photos/3861958/pexels-photo-3861958.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Environnement': 'https://images.pexels.com/photos/3305/garden-apple-tree-countryside.jpg?auto=compress&cs=tinysrgb&w=900',
                'Santé et sécurité': 'https://images.pexels.com/photos/3768131/pexels-photo-3768131.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Agroalimentaire': 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Management': 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Alimentation': 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Construction': 'https://images.pexels.com/photos/3184464/pexels-photo-3184464.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Électricité': 'https://images.pexels.com/photos/3184300/pexels-photo-3184300.jpeg?auto=compress&cs=tinysrgb&w=900',
                'Métrologie': 'https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg?auto=compress&cs=tinysrgb&w=900'
            };
            return images[categorie] || 'https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=900';
        }

        function loadOtherNormes() {
            if (!grid) return;
            supabaseClient.from('normes').select('id, titre, code, date_pub, statut, categorie').order('date_pub', { ascending: false }).limit(8).then(function (res) {
                var rows = res.data || [];
                if (!rows.length) { grid.innerHTML = '<p class="text-sm text-gray-400">Aucune autre norme.</p>'; return; }
                grid.innerHTML = rows.map(function (n) {
                    var imgSrc = n.image_url || normeIllustration(n.categorie);
                    var href = n.code ? 'norme.php?code=' + encodeURIComponent(n.code) : 'norme.php?id=' + n.id;
                    return '<article class="home-norme-card">' +
                        '<div class="home-norme-cover"><img src="' + imgSrc + '" alt="' + safeStr(n.categorie) + '" loading="lazy"><span>' + safeStr(n.origine || 'Nationale') + '</span></div>' +
                        '<div class="home-norme-body">' +
                        '<small>' + safeStr(n.categorie || 'Norme') + '</small>' +
                        '<h3>' + safeStr(n.code) + '</h3>' +
                        '<p class="home-norme-title">' + safeStr(n.titre) + '</p>' +
                        '<div class="home-norme-actions"><a href="' + href + '">Détails <i class="fas fa-arrow-right"></i></a><a href="boutique.php" class="home-norme-buy">Acheter</a></div>' +
                        '</div></article>';
                }).join('');
            }).catch(function (err) {
                console.error('Autres normes error:', err);
                grid.innerHTML = '<p class="text-sm text-red-500">Erreur: ' + (err.message || err) + '</p>';
            });
        }

        function loadArticle(id, code) {
            if (!id && !code) {
                container.innerHTML = '<p class="text-gray-text">Aucune norme spécifiée.</p>';
                loadOtherNormes();
                return;
            }

            var query = supabaseClient.from('normes').select('*');
            if (id) {
                query = query.eq('id', id);
            } else {
                query = query.eq('code', code);
            }
            query.single().then(function (result) {
                var data = result.data;
                var error = result.error;
                if (error || !data) {
                    container.innerHTML = '<p class="text-gray-text">Cette norme est introuvable.</p>';
                    loadOtherNormes();
                    return;
                }

                var dateStr = data.date_pub ? new Date(data.date_pub).toLocaleDateString('fr-FR', {year:'numeric',month:'long',day:'numeric'}) : '';
                var tags = [];
                if (data.origine) tags.push(data.origine);
                if (data.type_iso) tags.push(data.type_iso);
                if (data.categorie) tags.push(data.categorie);
                if (data.statut) tags.push(data.statut.charAt(0).toUpperCase() + data.statut.slice(1));

                var html = '';
                if (tags.length) {
                    html += '<div class="norm-meta">' + tags.map(function(t) { return '<span class="px-3 py-1 rounded-full bg-primary-light text-primary text-xs font-medium mr-2 mb-2">' + t + '</span>'; }).join('') + '</div>';
                }
                html += '<h2>' + (data.titre || '') + '</h2>';
                if (dateStr) html += '<p class="text-sm text-gray-400 mb-4"><i class="fas fa-calendar-alt mr-1"></i> ' + dateStr + '</p>';
                if (data.description) html += '<p>' + data.description + '</p>';
                html += '<div class="mt-6"><a href="boutique.php" class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-xl font-semibold hover:bg-primary-dark transition"><i class="fas fa-shopping-cart"></i> Consulter la boutique</a> <a href="normalisation.php" class="inline-flex items-center gap-2 text-primary font-semibold ml-4 hover:underline"><i class="fas fa-arrow-left"></i> Retour à la normalisation</a></div>';

                container.innerHTML = html;
                loadOtherNormes();
            }).catch(function (err) {
                console.error('Erreur chargement norme:', err);
                container.innerHTML = '<p class="text-gray-text">Erreur de chargement.</p>';
                loadOtherNormes();
            });
        }

        var params = new URLSearchParams(window.location.search);
        var id = params.get('id');
        var code = params.get('code');
        loadArticle(id, code);
    });
    </script>

</body>
</html>

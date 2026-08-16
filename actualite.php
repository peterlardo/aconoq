<?php $pageTitle = 'Actualité'; ?>
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
        .other-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:48px}
        .other-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;overflow:hidden;transition:transform .2s,box-shadow .2s}
        .other-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(15,113,64,.1)}
        .other-card img{width:100%;height:120px;object-fit:cover}
        .other-card-body{padding:14px}
        .other-card-body h3{font-size:14px;color:#0a1f0a;margin:0 0 6px;line-height:1.3}
        .other-card-body span{font-size:12px;color:#687669}
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
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <a href="actualites.php" class="text-primary hover:underline">Actualités</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Détails</span></p>
            </div>
            <article id="actualite-detail" class="norm-card">
                <div id="article-cover" style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px;display:none">
                    <img id="article-cover-img" src="" alt="" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Actualités</p>
                <h1 id="article-title"><strong>Actualité</strong></h1>
                <div id="article-meta" class="norm-meta"></div>
                <div id="article-body"></div>
            </article>
            <section class="mt-12">
                <h2 class="text-xl font-bold text-dark mb-6">Autres <span class="text-primary">actualités</span></h2>
                <div id="other-articles" class="other-grid"></div>
            </section>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var params = new URLSearchParams(window.location.search);
        var id = params.get('id');
        var slug = params.get('slug');
        var coverWrap = document.getElementById('article-cover');
        var coverImg = document.getElementById('article-cover-img');
        var titleEl = document.getElementById('article-title');
        var metaEl = document.getElementById('article-meta');
        var bodyEl = document.getElementById('article-body');
        var grid = document.getElementById('other-articles');

        function formatDate(d) {
            if (!d) return '';
            var dt = new Date(d);
            return dt.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
        }

        function escapeHtml(s) {
            if (!s) return '';
            var d = document.createElement('div');
            d.appendChild(document.createTextNode(s));
            return d.innerHTML;
        }

        function loadOther(currentId) {
            if (!grid) return;
            supabaseClient.from('actualites').select('id, titre, image_url, date_pub').order('date_pub', { ascending: false }).limit(8).then(function (res) {
                var rows = (res.data || []).filter(function(a) { return a.id !== currentId; });
                if (!rows.length) { grid.innerHTML = '<p class="text-sm text-gray-400">Aucune autre actualité.</p>'; return; }
                grid.innerHTML = rows.map(function (a) {
                    var img = a.image_url ? '<img src="' + a.image_url + '" alt="' + (a.titre || '') + '">' : '<div style="height:120px;background:#eaf4ef;display:flex;align-items:center;justify-content:center;color:#0f7140"><i class="fas fa-newspaper text-2xl"></i></div>';
                    var dt = a.date_pub ? new Date(a.date_pub).toLocaleDateString('fr-FR', { day:'numeric', month:'short', year:'numeric' }) : '';
                    return '<a href="actualite.php?id=' + a.id + '" class="other-card" style="text-decoration:none;color:inherit">' + img + '<div class="other-card-body"><h3>' + (a.titre || '') + '</h3><span>' + dt + '</span></div></a>';
                }).join('');
            }).catch(function (err) {
                console.error('Autres actualités error:', err);
                grid.innerHTML = '<p class="text-sm text-red-500">Erreur: ' + (err.message || err) + '</p>';
            });
        }

        if (!id && !slug) {
            bodyEl.innerHTML = '<p>Aucune actualité sélectionnée.</p>';
            loadOther(null);
            return;
        }

        var query = supabaseClient.from('actualites').select('*');
        if (id) {
            query = query.eq('id', id);
        } else {
            query = query.eq('slug', slug);
        }

        query.maybeSingle().then(function (result) {
            var data = result.data;
            var error = result.error;

            if (error || !data) {
                titleEl.innerHTML = '<em>Actualité introuvable</em>';
                bodyEl.innerHTML = '<p>Cette actualité est introuvable ou n\'existe plus.</p>';
                loadOther(null);
                return;
            }

            if (data.image_url) {
                coverWrap.style.display = 'block';
                coverImg.src = data.image_url;
                coverImg.alt = data.titre || '';
            }

            titleEl.innerHTML = escapeHtml(data.titre);

            var meta = '<i class="far fa-calendar mr-2"></i>' + formatDate(data.date_pub);
            if (data.auteur) {
                meta += ' &middot; <i class="fas fa-user mr-1"></i> ' + escapeHtml(data.auteur);
            }
            metaEl.innerHTML = meta;

            bodyEl.innerHTML = '<div style="white-space:pre-line;">' + escapeHtml(data.contenu) + '</div>';

            loadOther(data.id);
        }).catch(function (err) {
            console.error('Article load error:', err);
            bodyEl.innerHTML = '<p>Erreur de chargement.</p>';
            loadOther(null);
        });
    });
    </script>

</body>
</html>

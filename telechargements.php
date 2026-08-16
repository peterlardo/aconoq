<?php $pageTitle = 'Espace Téléchargements'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        .dropdown-menu{position:absolute;top:100%;left:0;padding-top:8px;opacity:0;visibility:hidden;transform:translateY(4px);transition:all .2s ease;pointer-events:none}
        .nav-item:hover .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0);pointer-events:auto}
        .nav-item{position:relative;z-index:50}
        .nav-item::after{content:'';position:absolute;left:0;right:0;top:100%;height:8px}
        .norm-page{padding:90px 0 80px;background:linear-gradient(180deg,#f7f8f4 0%,#f7f8f4 60%,#ffffff 100%);min-height:100vh}
        .norm-container{width:min(1080px,calc(100% - 32px));margin:auto}
        .norm-card{background:#fff;border-radius:18px;padding:42px;overflow:hidden;position:relative}
        .norm-card::before{content:"";position:absolute;inset:0;border-radius:18px;box-shadow:0 8px 24px rgba(15,113,64,.07);mask-image:linear-gradient(to bottom,black 75%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 75%,transparent 100%);pointer-events:none}
        .norm-card h1{color:#0a1f0a;font-size:clamp(28px,4vw,44px);line-height:1.1;margin:0 0 12px}
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .dl-filters{display:grid;grid-template-columns:auto 1fr 1fr auto;gap:14px;margin:24px 0;padding:18px 20px;background:#fff;border:1px solid #e2ece3;border-radius:14px;align-items:center}
        .dl-filters h3{font-size:15px;color:#0a1f0a;margin:0;white-space:nowrap}
        .dl-filters label{display:block;font-size:12px;color:#687669;margin-bottom:6px}
        .dl-filters select,.dl-filters input{width:100%;border:1px solid #dfe8df;border-radius:9px;padding:10px 12px;color:#263826;background:#fff;outline:none;font:inherit;font-size:13px}
        .dl-filters select:focus,.dl-filters input:focus{border-color:#0f7140;box-shadow:0 0 0 2px rgba(15,113,64,.12)}
        .dl-reset{border:0;background:transparent;color:#0f7140;cursor:pointer;font-size:12px;font-weight:700;white-space:nowrap;padding:0}
        .dl-reset:hover{text-decoration:underline}
        .dl-results-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
        .dl-results-count{font-size:13px;color:#687669}
        .dl-list{display:flex;flex-direction:column;gap:10px}
        .dl-item{display:flex;align-items:center;gap:16px;padding:16px 20px;border:1px solid #e2ece3;border-radius:12px;background:#fbfdfb;transition:box-shadow .2s,transform .2s}
        .dl-item:hover{box-shadow:0 6px 18px rgba(15,113,64,.1);transform:translateY(-1px)}
        .dl-item-icon{width:42px;height:42px;border-radius:10px;background:#fde8e8;color:#dc2626;display:inline-flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
        .dl-item-body{flex:1;min-width:0}
        .dl-item-title{font-size:14px;font-weight:600;color:#0a1f0a;margin:0 0 2px}
        .dl-item-meta{font-size:12px;color:#8a9a8c;margin:0}
        .dl-item-tag{display:inline-block;padding:2px 8px;border-radius:6px;background:#eaf4ef;color:#0f7140;font-size:11px;font-weight:600;margin-left:6px}
        .dl-item-download{padding:8px 14px;border-radius:8px;background:#0f7140;color:#fff;border:none;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:background .2s;flex-shrink:0;text-decoration:none}
        .dl-item-download:hover{background:#0c5c34}
        .dl-empty{text-align:center;padding:40px 0;color:#8a9a8c;font-size:15px}
        .dl-empty i{font-size:32px;color:#dde5df;display:block;margin-bottom:12px}
        .dl-pagination{display:flex;justify-content:center;align-items:center;gap:6px;margin:24px 0 4px}
        .dl-pagination button{border:1px solid #dfe8df;background:#fff;color:#0f7140;border-radius:8px;min-width:34px;height:34px;cursor:pointer;font-size:12px;font-weight:700;transition:all .2s}
        .dl-pagination button:hover,.dl-pagination button.is-active{background:#0f7140;color:#fff;border-color:#0f7140}
        .dl-pagination button:disabled{opacity:.4;cursor:not-allowed}
        @media(max-width:800px){.dl-filters{grid-template-columns:1fr 1fr}.dl-filters h3{grid-column:1/-1}}
        @media(max-width:520px){.dl-filters{display:flex;flex-direction:column;gap:14px}.norm-card{padding:24px}.dl-item{flex-direction:column;align-items:flex-start}.dl-item-download{width:100%;justify-content:center}}
    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Espace Téléchargements</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-documents.jpg" alt="Téléchargements" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Téléchargements</p>
                <h1><strong>Espace</strong> <em>Téléchargements</em></h1>
                <p style="color:#4a5a4c;font-size:16px;line-height:1.75;margin-bottom:8px">Accédez aux documents officiels de l'ACONOQ. Recherchez par nom, filtrez par catégorie et par année.</p>

                <!-- Boutique-style filter bar -->
                <div class="dl-filters">
                    <h3><i class="fas fa-sliders" style="color:#0f7140;margin-right:6px"></i>Filtrer</h3>
                    <div>
                        <label for="dl-search">Recherche</label>
                        <input type="text" id="dl-search" placeholder="Nom du document...">
                    </div>
                    <div>
                        <label for="dl-category">Catégorie</label>
                        <select id="dl-category"><option value="all">Toutes les catégories</option></select>
                    </div>
                    <div>
                        <label for="dl-year">Année</label>
                        <select id="dl-year"><option value="all">Toutes les années</option></select>
                    </div>
                    <button class="dl-reset" id="dl-reset"><i class="fas fa-rotate-left" style="margin-right:4px"></i>Réinitialiser</button>
                </div>

                <!-- Results -->
                <div class="dl-results-head">
                    <span class="dl-results-count" id="dl-count">Chargement...</span>
                </div>
                <div id="documentList" class="dl-list"></div>
                <div id="dl-pagination" class="dl-pagination"></div>

            </article>
        </div>
    </main>
    <?php include 'components/footer.php'; ?>

    <script>
    (function(){
        const esc = v => String(v??'').replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]));

        const allDocuments = [
            { title: "Compte-rendu de la réunion du Conseil d'administration - S1 2026", category: "Comptes-rendus", year: 2026, size: "245 Ko", date: "15/03/2026" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S2 2025", category: "Comptes-rendus", year: 2025, size: "312 Ko", date: "18/09/2025" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S1 2025", category: "Comptes-rendus", year: 2025, size: "289 Ko", date: "12/03/2025" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S2 2024", category: "Comptes-rendus", year: 2024, size: "278 Ko", date: "20/09/2024" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S1 2024", category: "Comptes-rendus", year: 2024, size: "265 Ko", date: "14/03/2024" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S2 2023", category: "Comptes-rendus", year: 2023, size: "298 Ko", date: "22/09/2023" },
            { title: "Compte-rendu de la réunion du Conseil d'administration - S1 2023", category: "Comptes-rendus", year: 2023, size: "271 Ko", date: "10/03/2023" },
            { title: "Rapport annuel d'activité - 2025", category: "Rapports", year: 2025, size: "1.8 Mo", date: "28/02/2026" },
            { title: "Rapport annuel d'activité - 2024", category: "Rapports", year: 2024, size: "1.6 Mo", date: "15/02/2025" },
            { title: "Rapport annuel d'activité - 2023", category: "Rapports", year: 2023, size: "1.5 Mo", date: "20/02/2024" },
            { title: "Rapport d'audit interne - 2025", category: "Rapports", year: 2025, size: "420 Ko", date: "10/12/2025" },
            { title: "Rapport financier - S1 2025", category: "Rapports", year: 2025, size: "380 Ko", date: "15/07/2025" },
            { title: "Rapport d'activité de la Direction de la Normalisation - 2024", category: "Rapports", year: 2024, size: "520 Ko", date: "30/01/2025" },
            { title: "Rapport d'activité de la Direction de la Métrologie - 2024", category: "Rapports", year: 2024, size: "490 Ko", date: "30/01/2025" },
            { title: "Circulaire n°001/2026 - Procédures de certification renforcées", category: "Circulaires", year: 2026, size: "156 Ko", date: "10/01/2026" },
            { title: "Circulaire n°003/2025 - Normes obligatoires des produits alimentaires", category: "Circulaires", year: 2025, size: "189 Ko", date: "05/11/2025" },
            { title: "Circulaire n°002/2025 - Calibrage des instruments de mesure", category: "Circulaires", year: 2025, size: "142 Ko", date: "15/06/2025" },
            { title: "Circulaire n°001/2025 - Révision du processus PCEC", category: "Circulaires", year: 2025, size: "167 Ko", date: "12/01/2025" },
            { title: "Circulaire n°001/2024 - Application des normes ISO", category: "Circulaires", year: 2024, size: "178 Ko", date: "08/01/2024" },
            { title: "Guide de demande de norme - Édition 2025", category: "Guides", year: 2025, size: "890 Ko", date: "20/03/2025" },
            { title: "Guide pratique de certification des produits - 2024", category: "Guides", year: 2024, size: "1.2 Mo", date: "15/06/2024" },
            { title: "Guide d'utilisation de la marque NCGO - 2024", category: "Guides", year: 2024, size: "650 Ko", date: "10/09/2024" },
            { title: "Guide du Métrologue - Édition 2023", category: "Guides", year: 2023, size: "780 Ko", date: "01/04/2023" },
            { title: "Guide de conformité des produits importés - 2023", category: "Guides", year: 2023, size: "950 Ko", date: "20/07/2023" },
            { title: "Formulaire de demande de norme", category: "Formulaires", year: 2025, size: "124 Ko", date: "01/01/2025" },
            { title: "Formulaire de demande de certification", category: "Formulaires", year: 2025, size: "156 Ko", date: "01/01/2025" },
            { title: "Formulaire d'inscription à la newsletter", category: "Formulaires", year: 2024, size: "89 Ko", date: "01/06/2024" },
            { title: "Formulaire de demande de devis", category: "Formulaires", year: 2024, size: "112 Ko", date: "01/03/2024" },
            { title: "Formulaire de réclamation", category: "Formulaires", year: 2023, size: "98 Ko", date: "01/09/2023" },
            { title: "Bulletin de la normalisation - N°12 / 2025", category: "Publications", year: 2025, size: "2.1 Mo", date: "15/12/2025" },
            { title: "Bulletin de la normalisation - N°11 / 2025", category: "Publications", year: 2025, size: "1.9 Mo", date: "15/06/2025" },
            { title: "Bulletin de la normalisation - N°10 / 2024", category: "Publications", year: 2024, size: "2.0 Mo", date: "15/12/2024" },
            { title: "Bulletin de la normalisation - N°9 / 2024", category: "Publications", year: 2024, size: "1.8 Mo", date: "15/06/2024" },
            { title: "Revue Qualité & Standards - Hors-série 2023", category: "Publications", year: 2023, size: "3.5 Mo", date: "01/11/2023" },
            { title: "Bulletin de la normalisation - N°8 / 2023", category: "Publications", year: 2023, size: "1.7 Mo", date: "15/12/2023" },
        ];

        const categoryIcons = {
            'Comptes-rendus': 'fas fa-clipboard-list',
            'Rapports': 'fas fa-chart-bar',
            'Circulaires': 'fas fa-scroll',
            'Guides': 'fas fa-book',
            'Formulaires': 'fas fa-file-alt',
            'Publications': 'fas fa-newspaper'
        };

        let currentPage = 1;
        const pageSize = 10;

        const search = document.getElementById('dl-search');
        const catSel = document.getElementById('dl-category');
        const yearSel = document.getElementById('dl-year');
        const list = document.getElementById('documentList');
        const countEl = document.getElementById('dl-count');
        const pagEl = document.getElementById('dl-pagination');

        function populateFilters() {
            const cats = [...new Set(allDocuments.map(d => d.category))].sort();
            const years = [...new Set(allDocuments.map(d => d.year))].sort((a,b) => b - a);
            cats.forEach(c => { const o = document.createElement('option'); o.value = c; o.textContent = c; catSel.appendChild(o); });
            years.forEach(y => { const o = document.createElement('option'); o.value = y; o.textContent = y; yearSel.appendChild(o); });
        }

        function renderPagination(totalPages) {
            if (totalPages <= 1) { pagEl.innerHTML = ''; return; }
            let h = '<button data-page="prev"' + (currentPage===1?' disabled':'') + '><i class="fas fa-chevron-left"></i></button>';
            for (let i = 1; i <= totalPages; i++) h += '<button data-page="'+i+'" class="'+(i===currentPage?'is-active':'')+'">'+i+'</button>';
            h += '<button data-page="next"' + (currentPage===totalPages?' disabled':'') + '><i class="fas fa-chevron-right"></i></button>';
            pagEl.innerHTML = h;
        }

        function render() {
            const q = search.value.toLowerCase().trim();
            const cat = catSel.value;
            const year = yearSel.value;

            let filtered = allDocuments.filter(d => {
                if (q && !d.title.toLowerCase().includes(q)) return false;
                if (cat !== 'all' && d.category !== cat) return false;
                if (year !== 'all' && d.year !== parseInt(year)) return false;
                return true;
            });

            const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
            if (currentPage > totalPages) currentPage = totalPages;
            const pageRows = filtered.slice((currentPage - 1) * pageSize, currentPage * pageSize);

            countEl.textContent = filtered.length + ' document' + (filtered.length !== 1 ? 's' : '') + ' trouvé' + (filtered.length !== 1 ? 's' : '');

            if (pageRows.length === 0) {
                list.innerHTML = '<div class="dl-empty"><i class="fas fa-folder-open"></i>Aucun document trouvé pour cette sélection.</div>';
                renderPagination(0);
                return;
            }

            list.innerHTML = pageRows.map(d => {
                const icon = categoryIcons[d.category] || 'fas fa-file-pdf';
                return '<div class="dl-item">' +
                    '<div class="dl-item-icon"><i class="fas fa-file-pdf"></i></div>' +
                    '<div class="dl-item-body">' +
                        '<p class="dl-item-title">' + esc(d.title) + '</p>' +
                        '<p class="dl-item-meta">' +
                            '<i class="fas fa-calendar" style="margin-right:3px"></i> ' + esc(d.date) +
                            ' <span class="dl-item-tag">' + esc(d.category) + '</span>' +
                            ' <span class="dl-item-tag">' + d.year + '</span>' +
                            ' <span style="margin-left:6px"><i class="fas fa-weight-hanging" style="margin-right:3px"></i>' + esc(d.size) + '</span>' +
                        '</p>' +
                    '</div>' +
                    '<a href="#" class="dl-item-download" onclick="event.preventDefault()"><i class="fas fa-download"></i> PDF</a>' +
                '</div>';
            }).join('');

            renderPagination(totalPages);
        }

        search.addEventListener('input', () => { currentPage = 1; render(); });
        catSel.addEventListener('change', () => { currentPage = 1; render(); });
        yearSel.addEventListener('change', () => { currentPage = 1; render(); });

        pagEl.addEventListener('click', e => {
            const btn = e.target.closest('[data-page]');
            if (!btn || btn.disabled) return;
            const total = Math.max(1, Math.ceil(allDocuments.filter(d => {
                const q = search.value.toLowerCase().trim();
                const cat = catSel.value;
                const year = yearSel.value;
                if (q && !d.title.toLowerCase().includes(q)) return false;
                if (cat !== 'all' && d.category !== cat) return false;
                if (year !== 'all' && d.year !== parseInt(year)) return false;
                return true;
            }).length / pageSize));
            if (btn.dataset.page === 'prev') currentPage = Math.max(1, currentPage - 1);
            else if (btn.dataset.page === 'next') currentPage = Math.min(total, currentPage + 1);
            else currentPage = Number(btn.dataset.page);
            render();
            window.scrollTo({top: document.getElementById('documentList').offsetTop - 120, behavior: 'smooth'});
        });

        document.getElementById('dl-reset').addEventListener('click', () => {
            search.value = ''; catSel.value = 'all'; yearSel.value = 'all'; currentPage = 1; render();
        });

        populateFilters();
        render();
    })();
    </script>
</body>
</html>
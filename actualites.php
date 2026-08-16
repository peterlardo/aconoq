<?php $pageTitle = 'Actualités'; ?>
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
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        @media(max-width:650px){.norm-card{padding:24px}}
        .actualites-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:32px}
        .actualite-card{display:block;background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;overflow:hidden;transition:transform .2s,box-shadow .2s}
        .actualite-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(15,113,64,.1)}
        .actualite-card img{width:100%;height:200px;object-fit:cover}
        .actualite-card-body{padding:22px}
        .actualite-card-body h2{color:#0a1f0a;font-size:18px;margin:8px 0 6px;line-height:1.3}
        .actualite-card:hover .actualite-card-body h2{color:#0f7140}
        .actualite-card-body p{color:#4a5a4c;font-size:14px;line-height:1.6;margin:0}
        .actualite-date{color:#687669;font-size:12px}
        .actualite-excerpt{color:#4a5a4c;font-size:14px;line-height:1.6;margin-top:8px}
        .al-filters{display:grid;grid-template-columns:1fr auto auto auto;gap:12px;margin-bottom:24px;align-items:center}
        .al-filters input,.al-filters select{border:1px solid #dfe8df;border-radius:9px;padding:10px 14px;color:#263826;background:#fff;font-size:13px;outline:none;min-width:0}
        .al-filters input:focus,.al-filters select:focus{border-color:#0f7140;box-shadow:0 0 0 2px rgba(15,113,64,.12)}
        .al-reset{border:0;background:transparent;color:#0f7140;cursor:pointer;font-size:12px;font-weight:700;white-space:nowrap;padding:10px 0}
        .al-reset:hover{text-decoration:underline}
        .shop-pagination{display:flex;justify-content:center;align-items:center;gap:6px;margin:24px 0 4px}
        .shop-pagination button{border:1px solid #dfe8df;background:#fff;color:#0f7140;border-radius:8px;min-width:34px;height:34px;cursor:pointer;font-size:12px;font-weight:700}
        .shop-pagination button:hover,.shop-pagination button.is-active{background:#0f7140;color:#fff;border-color:#0f7140}
        .shop-pagination button:disabled{opacity:.4;cursor:not-allowed}
        @media(max-width:900px){.actualites-grid{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:700px){.actualites-grid{grid-template-columns:1fr}.al-filters{grid-template-columns:1fr 1fr}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Actualités</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-actualites.jpg" alt="Actualités" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Actualités</p>
                <h1><strong>Nos</strong> <em>Actualités</em></h1>
                <div class="al-filters">
                    <input type="text" id="al-search" placeholder="Rechercher par titre…">
                    <select id="al-cat"><option value="all">Toutes les catégories</option></select>
                    <select id="al-year"><option value="all">Toutes les années</option></select>
                    <button class="al-reset" id="al-reset"><i class="fas fa-rotate-left mr-1"></i>Réinitialiser</button>
                </div>
                <div id="actualites-list" class="actualites-grid">
                    <p class="text-gray-text">Chargement…</p>
                </div>
                <div id="al-pagination" class="shop-pagination"></div>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
    (function(){
        const root = document.getElementById('actualites-list');
        const esc = v => String(v??'').replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]));
        const search = document.getElementById('al-search');
        const catSel = document.getElementById('al-cat');
        const yearSel = document.getElementById('al-year');
        const resetBtn = document.getElementById('al-reset');
        let allData = [];
        let alPage = 1;
        const alPageSize = 9;

        function populateFilters(data){
            const cats = [...new Set(data.map(i=>i.categorie).filter(Boolean))].sort();
            const years = [...new Set(data.map(i=>new Date(i.date_pub).getFullYear()))].sort((a,b)=>b-a);
            cats.forEach(c=>{const o=document.createElement('option');o.value=c;o.textContent=c;catSel.appendChild(o)});
            years.forEach(y=>{const o=document.createElement('option');o.value=y;o.textContent=y;yearSel.appendChild(o)});
        }

        function renderPagination(totalPages){
            const el=document.getElementById('al-pagination');
            if(totalPages<=1){el.innerHTML='';return;}
            let h=`<button data-al-page="prev" ${alPage===1?'disabled':''}><i class="fas fa-chevron-left"></i></button>`;
            for(let i=1;i<=totalPages;i++) h+=`<button data-al-page="${i}" class="${i===alPage?'is-active':''}">${i}</button>`;
            h+=`<button data-al-page="next" ${alPage===totalPages?'disabled':''}><i class="fas fa-chevron-right"></i></button>`;
            el.innerHTML=h;
        }

        function render(){
            const q = search.value.toLowerCase().trim();
            let rows = allData;
            if(q) rows = rows.filter(i=>i.titre.toLowerCase().includes(q));
            if(catSel.value!=='all') rows = rows.filter(i=>i.categorie===catSel.value);
            if(yearSel.value!=='all') rows = rows.filter(i=>new Date(i.date_pub).getFullYear()===Number(yearSel.value));
            if(!rows.length){root.innerHTML='<p class="text-gray-text" style="grid-column:1/-1">Aucune actualité ne correspond à votre recherche.</p>';renderPagination(0);return;}
            const totalPages=Math.max(1,Math.ceil(rows.length/alPageSize));
            if(alPage>totalPages) alPage=totalPages;
            const pageRows=rows.slice((alPage-1)*alPageSize, alPage*alPageSize);
            renderPagination(totalPages);
            root.innerHTML=pageRows.map(i=>`
                <a href="actualite.php?id=${encodeURIComponent(i.id)}" class="actualite-card">
                    ${i.image_url?`<img src="${esc(i.image_url)}" alt="${esc(i.titre)}">`:''}
                    <div class="actualite-card-body">
                        <span class="actualite-date"><i class="far fa-calendar mr-1"></i>${i.date_pub?new Date(i.date_pub).toLocaleDateString('fr-FR'):''}</span>
                        <h2>${esc(i.titre)}</h2>
                        ${i.resume?`<p class="actualite-excerpt">${esc(i.resume)}</p>`:''}
                        <span class="text-primary text-sm font-medium inline-flex items-center gap-1 mt-3">Lire la suite <i class="fas fa-arrow-right text-xs"></i></span>
                    </div>
                </a>
            `).join('');
        }

        search.addEventListener('input', ()=>{alPage=1;render()});
        catSel.addEventListener('change', ()=>{alPage=1;render()});
        yearSel.addEventListener('change', ()=>{alPage=1;render()});
        resetBtn.addEventListener('click', ()=>{search.value='';catSel.value='all';yearSel.value='all';alPage=1;render()});
        document.getElementById('al-pagination').addEventListener('click',e=>{
            const b=e.target.closest('[data-al-page]');
            if(!b)return;
            const total=Math.max(1,Math.ceil((allData||[]).length/alPageSize));
            if(b.dataset.alPage==='prev') alPage=Math.max(1,alPage-1);
            else if(b.dataset.alPage==='next') alPage=Math.min(total,alPage+1);
            else alPage=Number(b.dataset.alPage);
            render();
            window.scrollTo({top:document.getElementById('actualites-list').offsetTop-120,behavior:'smooth'});
        });

        supabaseClient.from('actualites').select('*').order('date_pub',{ascending:false}).then(({data,error})=>{
            if(error||!data?.length){
                root.innerHTML='<p class="text-gray-text">Aucune actualité pour le moment.</p>';
                return;
            }
            allData = data;
            populateFilters(data);
            render();
        });
    })();
    </script>

</body>
</html>

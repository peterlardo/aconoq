<?php $pageTitle = 'Événements'; ?>
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
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px;font-weight:700}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        #dynamic-sections .acq-section{background:transparent!important;padding:0;margin:0}
        #dynamic-sections .acq-section .acq-container{max-width:100%;padding:0}
        #dynamic-sections .feature-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:24px}
        #dynamic-sections .feature-icon{width:44px;height:44px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px}
        #dynamic-sections .feature-icon.bg-primary-light{background:#eaf4ef;color:#0f7140}
        #dynamic-sections .feature-icon.bg-red-50{background:#fef2f2;color:#dc2626}
        .events-listing{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:32px}
        .event-card{display:block;background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;overflow:hidden;transition:transform .2s,box-shadow .2s}
        .event-card:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(15,113,64,.12)}
        .event-card img{width:100%;height:200px;object-fit:cover}
        .event-card-body{padding:20px}
        .event-card-body h3{margin:0 0 6px;font-size:17px;color:#0a1f0a}
        .event-card-body .event-date{color:#0f7140;font-size:13px;font-weight:600;margin-bottom:8px}
        .event-card-body p{margin:0;color:#4a5a4c;font-size:14px;line-height:1.6}
        .events-empty{grid-column:1/-1;text-align:center;padding:60px 0;color:#687669}
        .ev-filters{display:grid;grid-template-columns:1fr auto auto auto;gap:12px;margin-bottom:24px;align-items:center}
        .ev-filters input,.ev-filters select{border:1px solid #dfe8df;border-radius:9px;padding:10px 14px;color:#263826;background:#fff;font-size:13px;outline:none;min-width:0}
        .ev-filters input:focus,.ev-filters select:focus{border-color:#0f7140;box-shadow:0 0 0 2px rgba(15,113,64,.12)}
        .ev-reset{border:0;background:transparent;color:#0f7140;cursor:pointer;font-size:12px;font-weight:700;white-space:nowrap;padding:10px 0}
        .ev-reset:hover{text-decoration:underline}
        .shop-pagination{display:flex;justify-content:center;align-items:center;gap:6px;margin:24px 0 4px}
        .shop-pagination button{border:1px solid #dfe8df;background:#fff;color:#0f7140;border-radius:8px;min-width:34px;height:34px;cursor:pointer;font-size:12px;font-weight:700}
        .shop-pagination button:hover,.shop-pagination button.is-active{background:#0f7140;color:#fff;border-color:#0f7140}
        .shop-pagination button:disabled{opacity:.4;cursor:not-allowed}
        @media(max-width:900px){.events-listing{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:650px){.norm-card{padding:24px}.events-listing{grid-template-columns:1fr}.ev-filters{grid-template-columns:1fr 1fr}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Événements</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-evenements.jpg" alt="Événements" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Actualités</p>
                <h1><strong>Nos</strong> <em>Événements</em></h1>
                <div class="ev-filters">
                    <input type="text" id="ev-search" placeholder="Rechercher par titre…">
                    <select id="ev-cat"><option value="all">Toutes les catégories</option></select>
                    <select id="ev-year"><option value="all">Toutes les années</option></select>
                    <button class="ev-reset" id="ev-reset"><i class="fas fa-rotate-left mr-1"></i>Réinitialiser</button>
                </div>
                <div id="evenements-list" class="events-listing">
                    <p class="events-empty">Chargement…</p>
                </div>
                <div id="ev-pagination" class="shop-pagination"></div>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
    (function(){
        const root = document.getElementById('evenements-list');
        const esc = v => String(v??'').replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]));
        const search = document.getElementById('ev-search');
        const catSel = document.getElementById('ev-cat');
        const yearSel = document.getElementById('ev-year');
        const resetBtn = document.getElementById('ev-reset');
        let allData = [];
        let evPage = 1;
        const evPageSize = 9;

        function populateFilters(data){
            const cats = [...new Set(data.map(i=>i.type_event).filter(Boolean))].sort();
            const years = [...new Set(data.map(i=>new Date(i.date_debut).getFullYear()))].sort((a,b)=>b-a);
            cats.forEach(c=>{const o=document.createElement('option');o.value=c;o.textContent=c;catSel.appendChild(o)});
            years.forEach(y=>{const o=document.createElement('option');o.value=y;o.textContent=y;yearSel.appendChild(o)});
        }

        function renderPagination(totalPages){
            const el=document.getElementById('ev-pagination');
            if(totalPages<=1){el.innerHTML='';return;}
            let h=`<button data-ev-page="prev" ${evPage===1?'disabled':''}><i class="fas fa-chevron-left"></i></button>`;
            for(let i=1;i<=totalPages;i++) h+=`<button data-ev-page="${i}" class="${i===evPage?'is-active':''}">${i}</button>`;
            h+=`<button data-ev-page="next" ${evPage===totalPages?'disabled':''}><i class="fas fa-chevron-right"></i></button>`;
            el.innerHTML=h;
        }

        function render(){
            const q = search.value.toLowerCase().trim();
            let rows = allData;
            if(q) rows = rows.filter(i=>i.titre.toLowerCase().includes(q));
            if(catSel.value!=='all') rows = rows.filter(i=>i.type_event===catSel.value);
            if(yearSel.value!=='all') rows = rows.filter(i=>new Date(i.date_debut).getFullYear()===Number(yearSel.value));
            if(!rows.length){root.innerHTML='<p class="events-empty">Aucun événement ne correspond à votre recherche.</p>';renderPagination(0);return;}
            const totalPages=Math.max(1,Math.ceil(rows.length/evPageSize));
            if(evPage>totalPages) evPage=totalPages;
            const pageRows=rows.slice((evPage-1)*evPageSize, evPage*evPageSize);
            renderPagination(totalPages);
            root.innerHTML=pageRows.map(i=>`
                <a href="evenement.php?id=${encodeURIComponent(i.id)}" class="event-card">
                    ${i.image_url?`<img src="${esc(i.image_url)}" alt="${esc(i.titre)}">`:`<div style="height:200px;background:#eaf4ef;display:grid;place-items:center;"><i class="fas fa-calendar-alt text-4xl text-primary opacity-50"></i></div>`}
                    <div class="event-card-body">
                        <span class="event-date"><i class="far fa-calendar mr-1"></i>${new Date(i.date_debut).toLocaleDateString('fr-FR',{day:'numeric',month:'long',year:'numeric'})}${i.date_fin?' — '+new Date(i.date_fin).toLocaleDateString('fr-FR',{day:'numeric',month:'long',year:'numeric'}):''}</span>
                        <h3>${esc(i.titre)}</h3>
                        ${i.lieu?`<p><i class="fas fa-map-marker-alt mr-1 text-primary"></i>${esc(i.lieu)}</p>`:''}
                        ${i.description?`<p style="margin-top:8px">${esc(i.description).substring(0,120)}${i.description.length>120?'…':''}</p>`:''}
                    </div>
                </a>
            `).join('');
        }

        search.addEventListener('input', ()=>{evPage=1;render()});
        catSel.addEventListener('change', ()=>{evPage=1;render()});
        yearSel.addEventListener('change', ()=>{evPage=1;render()});
        resetBtn.addEventListener('click', ()=>{search.value='';catSel.value='all';yearSel.value='all';evPage=1;render()});
        document.getElementById('ev-pagination').addEventListener('click',e=>{
            const b=e.target.closest('[data-ev-page]');
            if(!b)return;
            const total=Math.max(1,Math.ceil((allData||[]).length/evPageSize));
            if(b.dataset.evPage==='prev') evPage=Math.max(1,evPage-1);
            else if(b.dataset.evPage==='next') evPage=Math.min(total,evPage+1);
            else evPage=Number(b.dataset.evPage);
            render();
            window.scrollTo({top:document.getElementById('evenements-list').offsetTop-120,behavior:'smooth'});
        });

        supabaseClient.from('evenements').select('*').order('date_debut',{ascending:false}).then(({data,error})=>{
            if(error||!data?.length){
                root.innerHTML='<p class="events-empty">Aucun événement pour le moment.</p>';
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

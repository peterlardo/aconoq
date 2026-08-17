<?php $pageTitle = 'Événement'; ?>
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
        .norm-meta{color:#687669;font-size:12px;margin-bottom:28px}
        .norm-callout{border-left:4px solid #f5c908;background:#fffdf0;padding:16px 18px;border-radius:0 10px 10px 0;margin:18px 0}
        #dynamic-sections .acq-section{background:transparent!important;padding:0;margin:0}
        #dynamic-sections .acq-section .acq-container{max-width:100%;padding:0}
        #dynamic-sections .feature-card{background:#f7f8f4;border:1px solid #eaf4ef;border-radius:14px;padding:24px}
        #dynamic-sections .feature-icon{width:44px;height:44px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px}
        #dynamic-sections .feature-icon.bg-primary-light{background:#eaf4ef;color:#0f7140}
        #dynamic-sections .feature-icon.bg-red-50{background:#fef2f2;color:#dc2626}
        .event-info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin:24px 0;padding:24px;background:#f7f8f4;border-radius:14px}
        .event-info-item{display:flex;gap:12px;align-items:flex-start}
        .event-info-item i{width:18px;color:#0f7140;margin-top:2px}
        .event-info-item strong{display:block;color:#0a1f0a;font-size:13px;margin-bottom:2px}
        .event-info-item span{color:#4a5a4c;font-size:14px;line-height:1.5}
        .upcoming-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
        .upcoming-card{display:block;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 8px 24px rgba(15,113,64,.08)}
        .upcoming-card img{width:100%;height:160px;object-fit:cover}
        .upcoming-card-body{padding:18px}
        @media(max-width:650px){.norm-card{padding:24px}.event-info-grid{grid-template-columns:1fr}.upcoming-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <a href="index.php#evenements-grid" class="text-primary hover:underline">Événements</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Détails</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-evenement.jpg" alt="Événement" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Événements</p>
                <h1><strong>Événement</strong></h1>
                <div id="event-content"><p style="color:#687669">Chargement de l'événement…</p></div>
            </article>
            <section class="mt-16" aria-labelledby="upcoming-title">
                <div class="flex items-end justify-between mb-8">
                    <div><p class="section-tag">Calendrier</p><h2 id="upcoming-title" class="section-heading" style="font-size:24px;color:#0a1f0a;margin:8px 0 0">Prochains <em style="color:#0f7140">événements</em></h2></div>
                    <a href="index.php#evenements-grid" class="text-primary text-sm font-medium inline-flex items-center gap-2 hover:gap-3 transition-all">Voir tous <i class="fas fa-arrow-right"></i></a>
                </div>
                <div id="upcoming-events" class="upcoming-grid"><p style="color:#687669">Chargement…</p></div>
            </section>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
    (function () {
        const content = document.getElementById('event-content');
        const upcoming = document.getElementById('upcoming-events');
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        const slug = params.get('slug');
        const esc = (v) => String(v ?? '').replace(/[&<>'"]/g, (c) => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]));
        const fmtDate = (v, withTime) => v ? new Date(v).toLocaleDateString('fr-FR', withTime ? {day:'2-digit',month:'long',year:'numeric',hour:'2-digit',minute:'2-digit'} : {day:'2-digit',month:'long',year:'numeric'}) : 'À préciser';
        const typeLabel = (v) => ({formation:'Formation',salon:'Salon',evenement:'Événement'}[v] || 'Événement');
        const empty = '<p style="color:#687669">Cet événement est introuvable.</p>';

        let query = supabaseClient.from('evenements').select('*');
        if (id && /^\d+$/.test(id)) {
            query = query.eq('id', id);
        } else if (slug) {
            query = query.eq('slug', slug);
        } else {
            content.innerHTML = empty;
            return;
        }
        query.maybeSingle().then(({data, error}) => {
            if (error || !data) { content.innerHTML = empty; return; }
            document.querySelector('h1').innerHTML = esc(data.titre);
            let html = '';
            html += `<div class="event-info-grid">
                <div class="event-info-item"><i class="far fa-calendar"></i><div><strong>Début</strong><span>${esc(fmtDate(data.date_debut, true))}</span></div></div>
                ${data.date_fin ? `<div class="event-info-item"><i class="far fa-calendar-check"></i><div><strong>Fin</strong><span>${esc(fmtDate(data.date_fin, true))}</span></div></div>` : ''}
                <div class="event-info-item"><i class="fas fa-map-marker-alt"></i><div><strong>Lieu</strong><span>${esc(data.lieu || 'À préciser')}</span></div></div>
                <div class="event-info-item"><i class="fas fa-tag"></i><div><strong>Type</strong><span>${esc(typeLabel(data.type_event))}</span></div></div>
            </div>`;
            if (data.image_url) {
                html += `<div style="margin:24px 0;border-radius:14px;overflow:hidden"><img src="${esc(data.image_url)}" alt="${esc(data.titre)}" style="width:100%;height:auto;display:block"></div>`;
            }
            html += `<div style="white-space:pre-line;color:#4a5a4c;font-size:16px;line-height:1.75">${esc(data.description || 'Découvrez les détails de cet événement organisé par l\'ACONOQ.')}</div>`;
            content.innerHTML = html;
        });

        supabaseClient.from('evenements').select('*').gte('date_debut', new Date().toISOString()).order('date_debut', {ascending: true}).limit(4).then(({data}) => {
            const rows = (data || []).filter(item => String(item.id) !== String(id)).slice(0, 3);
            if (!rows.length) { upcoming.innerHTML = '<p style="color:#687669">Aucun autre événement à venir pour le moment.</p>'; return; }
            upcoming.innerHTML = rows.map(item => `<a href="evenement.php?id=${encodeURIComponent(item.id)}" class="upcoming-card group">${item.image_url ? `<img src="${esc(item.image_url)}" alt="${esc(item.titre)}">` : '<div style="height:160px;background:#eaf4ef;display:grid;place-items:center;"><i class="fas fa-calendar-alt text-3xl text-primary opacity-50"></i></div>'}<div class="upcoming-card-body"><span style="color:#0f7140;font-size:12px;font-weight:600">${esc(fmtDate(item.date_debut))}</span><h3 style="color:#0a1f0a;font-size:15px;font-weight:600;margin:8px 0 0">${esc(item.titre)}</h3><p style="color:#687669;font-size:12px;margin:8px 0 0"><i class="fas fa-map-marker-alt mr-1"></i>${esc(item.lieu || 'Lieu à préciser')}</p></div></a>`).join('');
        });
    })();
    </script>

</body>
</html>

<?php require '_layout.php'; admin_header('Modules', 'dashboard'); ?>
<div class="content">
    <div class="page-head">
        <p>Administration ACONOQ</p>
        <h1>Modules</h1>
        <p>Choisissez un module pour gérer ses contenus.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:28px" id="module-grid">
    </div>
</div>

<script>
const modules = [
    { key:'actualites',   label:'Actualités',       desc:'Publier et gérer les actualités du site.',   icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 6h16M4 12h16M4 18h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>', color:'#3c50e0' },
    { key:'evenements',   label:'Événements',       desc:'Planifier les événements et rendez-vous.',    icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 9h18M8 2v4M16 2v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>', color:'#12b76a' },
    { key:'normes',       label:'Normes',           desc:'Gérer les normes et documents de référence.', icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7 4h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" stroke="currentColor" stroke-width="1.5"/><path d="M9 8h6M9 12h6M9 16h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>', color:'#f79009' },
    { key:'services',     label:'Services',         desc:'Administrer les services proposés.',          icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>', color:'#15b9d7' },
    { key:'contact_messages', label:'Messages',     desc:'Consulter les messages reçus du site.',       icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 7a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2H8l-4 4V7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>', color:'#f04438' },
    { key:'page_sections',label:'Pages & Sections', desc:'Gérer le contenu des pages institutionnelles.',icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 9h18M9 9v12" stroke="currentColor" stroke-width="1.5"/></svg>', color:'#667085' },
    { key:'site_settings',label:'Paramètres',       desc:'Configuration générale du site ACONOQ.',      icon:'<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>', color:'#667085' },
];

const grid = document.getElementById('module-grid');
grid.innerHTML = modules.map(m => `
    <a href="crud.php?table=${m.key}" style="text-decoration:none;color:inherit;padding:24px;display:flex;flex-direction:column;gap:14px;background:var(--white);border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);transition:all .2s;cursor:pointer" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.08)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow)'">
        <div style="width:48px;height:48px;border-radius:14px;background:${m.color}15;color:${m.color};display:grid;place-items:center">${m.icon}</div>
        <h3 style="font-size:16px;font-weight:700;margin:0">${m.label}</h3>
        <p style="font-size:13px;color:var(--muted);margin:0;line-height:1.5">${m.desc}</p>
        <div style="margin-top:auto;display:flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:${m.color}">
            Gérer
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
    </a>
`).join('');
</script>
<?php admin_footer(); ?>
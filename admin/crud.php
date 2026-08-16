<?php
require '_layout.php';
$table = $_GET['table'] ?? 'actualites';
$navMap = [
    'actualites' => 'actualites', 'evenements' => 'evenements', 'normes' => 'normes',
    'services' => 'services', 'contact_messages' => 'messages', 'site_settings' => 'parametres',
    'page_sections' => 'page_sections', 'chiffres_cles' => 'modules', 'directeur' => 'modules',
    'directions' => 'modules', 'partenaires' => 'modules', 'newsletter_subscribers' => 'modules',
    'page_heroes' => 'modules', 'hero_slides' => 'modules', 'banners' => 'modules',
    'faq_items' => 'modules', 'certification_steps' => 'modules', 'processus' => 'modules',
    'contact_info' => 'modules', 'schedule' => 'modules', 'advantages' => 'modules',
    'how_it_works' => 'modules', 'pcec_exceptions' => 'modules', 'categories' => 'modules',
];
$active = $navMap[$table] ?? 'actualites';
admin_header('Gestion des contenus', $active);
?>
<div class="content">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div class="page-head" style="margin:0">
        <p id="subtitle">Source : Supabase</p>
        <h1 id="title">Chargement…</h1>
    </div>
    <div style="display:flex;gap:10px">
        <select id="module" class="field" style="height:42px;border:1px solid var(--line);border-radius:10px;padding:0 14px;font-size:13px"></select>
        <a class="primary" id="btn-new" style="display:inline-flex;align-items:center;gap:6px;text-decoration:none">+ Nouveau</a>
    </div>
</div>

<section class="card" style="padding:20px">
    <div class="toolbar" style="margin-bottom:12px">
        <input id="search" class="search" placeholder="Rechercher…">
    </div>
    <div id="status" class="crud-status">Chargement…</div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr id="thead"></tr></thead>
            <tbody id="tbody"></tbody>
        </table>
    </div>
</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="../js/supabase.js"></script>
<script src="admin-data.js"></script>
<script>
const configs = {
    actualites:       { label:'Actualités',        cols:['titre','categorie','date_pub','auteur','created_at'],   display:{titre:'Titre',categorie:'Catégorie',date_pub:'Date',auteur:'Auteur',created_at:'Créé le'} },
    evenements:       { label:'Événements',        cols:['titre','lieu','date_debut','date_fin','type_event'],   display:{titre:'Événement',lieu:'Lieu',date_debut:'Début',date_fin:'Fin',type_event:'Type'} },
    normes:           { label:'Normes',            cols:['code','titre','categorie','statut','created_at'],      display:{code:'Code',titre:'Intitulé',categorie:'Catégorie',statut:'Statut',created_at:'Créé le'} },
    services:         { label:'Services',          cols:['title','description','icon_class','ordre','active'],   display:{title:'Titre',description:'Description',icon_class:'Icône',ordre:'Ordre',active:'Actif'} },
    contact_messages: { label:'Messages',          cols:['name','email','subject','message','created_at'],       display:{name:'Nom',email:'Email',subject:'Sujet',message:'Message',created_at:'Reçu le'} },
    site_settings:    { label:'Paramètres du site',cols:['key','value'],                                        display:{key:'Clé',value:'Valeur'} },
    page_sections:    { label:'Pages & Sections',  cols:['page_slug','section_key','title','ordre','active'],    display:{page_slug:'Page',section_key:'Section',title:'Titre',ordre:'Ordre',active:'Actif'} },
    chiffres_cles:    { label:'Chiffres clés',     cols:['label','valeur','icone','ordre'],                      display:{label:'Libellé',valeur:'Valeur',icone:'Icône',ordre:'Ordre'} },
    directeur:        { label:'Directeur',         cols:['nom','titre','created_at'],                            display:{nom:'Nom',titre:'Titre',created_at:'Créé le'} },
    directions:       { label:'Directions',        cols:['nom','description','icone','couleur','ordre'],         display:{nom:'Nom',description:'Description',icone:'Icône',couleur:'Couleur',ordre:'Ordre'} },
    partenaires:      { label:'Partenaires',       cols:['nom','site_web','ordre'],                              display:{nom:'Nom',site_web:'Site web',ordre:'Ordre'} },
    newsletter_subscribers: { label:'Newsletter',  cols:['nom','email','date_inscription'],                      display:{nom:'Nom',email:'Email',date_inscription:'Inscrit le'} },
    page_heroes:      { label:'Héros de pages',    cols:['page_slug','title','subtitle'],                         display:{page_slug:'Page',title:'Titre',subtitle:'Sous-titre'} },
    hero_slides:      { label:'Slider héros',      cols:['title','badge','cta1_label','ordre','active'],          display:{title:'Titre',badge:'Badge',cta1_label:'CTA',ordre:'Ordre',active:'Actif'} },
    banners:          { label:'Bannières',         cols:['page_slug','title','badge','ordre'],                    display:{page_slug:'Page',title:'Titre',badge:'Badge',ordre:'Ordre'} },
    faq_items:        { label:'FAQ',               cols:['question','categorie','ordre','active'],                display:{question:'Question',categorie:'Catégorie',ordre:'Ordre',active:'Actif'} },
    certification_steps: { label:'Étapes certification', cols:['title','ordre'],                                 display:{title:'Titre',ordre:'Ordre'} },
    processus:        { label:'Processus',         cols:['title','step_number'],                                 display:{title:'Titre',step_number:'Étape'} },
    contact_info:     { label:'Infos contact',     cols:['key','value'],                                         display:{key:'Clé',value:'Valeur'} },
    schedule:         { label:'Horaires',          cols:['day','hours'],                                         display:{day:'Jour',hours:'Horaires'} },
    advantages:       { label:'Avantages',         cols:['title','description'],                                  display:{title:'Titre',description:'Description'} },
    how_it_works:     { label:'Comment ça marche', cols:['title','step_number'],                                  display:{title:'Titre',step_number:'Étape'} },
    pcec_exceptions:  { label:'Exceptions PCEC',   cols:['product_name','reason','active'],                       display:{product_name:'Produit',reason:'Raison',active:'Actif'} },
    categories:       { label:'Catégories',        cols:['nom','type_module','couleur','ordre','active'],         display:{nom:'Nom',type_module:'Module',couleur:'Couleur',ordre:'Ordre',active:'Actif'} },
};

let table = new URLSearchParams(location.search).get('table') || 'actualites';
let rows = [];

const module = document.getElementById('module');
Object.entries(configs).forEach(([k,v]) => module.add(new Option(v.label, k)));
module.value = table;
module.onchange = () => location.href = 'crud.php?table=' + module.value;

document.getElementById('btn-new').href = 'edit.php?table=' + table;

function fmtVal(v, key) {
    if (v === true) return '<span class="tag green">Actif</span>';
    if (v === false) return '<span class="tag orange">Inactif</span>';
    if (key === 'statut') {
        const cls = v === 'publié' || v === 'actif' ? 'green' : 'orange';
        return '<span class="tag ' + cls + '">' + (v || '—') + '</span>';
    }
    if (v && typeof v === 'object') return JSON.stringify(v);
    if (key && (key.includes('date') || key === 'created_at' || key === 'updated_at') && v) {
        const d = new Date(v);
        if (!isNaN(d)) return d.toLocaleDateString('fr-FR', { day:'numeric', month:'short', year:'numeric' });
    }
    if (String(v).length > 80) return String(v).substring(0, 80) + '…';
    return v ?? '—';
}

async function load() {
    document.getElementById('status').textContent = 'Chargement…';
    try {
        rows = await AconoqData.query(table, 'select=*');
        const cfg = configs[table];
        document.getElementById('title').textContent = cfg.label;
        document.getElementById('subtitle').textContent = rows.length + ' élément(s)';
        document.getElementById('thead').innerHTML = cfg.cols.map(f =>
            '<th>' + (cfg.display[f] || f) + '</th>'
        ).join('') + '<th style="width:140px">Actions</th>';
        render();
        document.getElementById('status').textContent = rows.length + ' élément(s) trouvé(s)';
    } catch(e) {
        document.getElementById('status').textContent = 'Erreur : ' + e.message;
    }
}

function render() {
    const q = document.getElementById('search').value.toLowerCase();
    const cfg = configs[table];
    document.getElementById('tbody').innerHTML = rows
        .filter(r => JSON.stringify(r).toLowerCase().includes(q))
        .map((r, i) => '<tr>' + cfg.cols.map(f =>
            '<td class="json">' + fmtVal(r[f], f) + '</td>'
        ).join('') + '<td class="actions">' +
            '<a href="edit.php?table=' + table + '&id=' + r.id + '" style="color:var(--primary);font-size:13px;font-weight:600">Modifier</a>' +
            '<button onclick="del(' + i + ')" style="color:var(--red);font-size:13px;font-weight:600;margin-left:12px">Supprimer</button>' +
        '</td></tr>').join('') || '<tr><td colspan="' + (cfg.cols.length + 1) + '" class="empty">Aucun contenu trouvé.</td></tr>';
}

document.getElementById('search').oninput = render;

window.del = async (i) => {
    if (!confirm('Supprimer définitivement cet élément ?')) return;
    try {
        await AconoqData.remove(table, rows[i].id);
        await load();
    } catch(e) { alert('Suppression refusée : ' + e.message); }
};

load();
</script>
<?php admin_footer(); ?>
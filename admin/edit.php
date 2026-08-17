<?php
require '_layout.php';
$table = $_GET['table'] ?? 'actualites';
$id = $_GET['id'] ?? null;
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
$isEdit = !empty($id);
$pageTitle = $isEdit ? 'Modifier' : 'Nouveau';
admin_header($pageTitle . ' contenu', $active);
?>
<div class="content">
<div style="display:flex;align-items:center;gap:16px;margin-bottom:28px">
    <a href="crud.php?table=<?= htmlspecialchars($table) ?>" style="color:var(--muted);text-decoration:none;font-size:14px;display:flex;align-items:center;gap:6px">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M11 4L6 9l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Retour
    </a>
</div>

<div class="edit-layout" style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start">
    <!-- FORMULAIRE -->
    <div>
        <div class="page-head" style="margin-bottom:20px">
            <p id="subtitle">Table : <strong id="table-label">—</strong></p>
            <h1 id="form-title"><?= $pageTitle ?> contenu</h1>
        </div>

        <section class="card" style="padding:28px">
            <form id="form">
                <div class="form-grid" id="fields"></div>
                <div class="form-actions" style="margin-top:24px">
                    <a href="crud.php?table=<?= htmlspecialchars($table) ?>" class="secondary" style="text-decoration:none">Annuler</a>
                    <button class="primary" type="submit" id="submit-btn"><?= $isEdit ? 'Enregistrer les modifications' : 'Créer le contenu' ?></button>
                </div>
            </form>
            <div id="msg" style="margin-top:16px;display:none"></div>
        </section>
    </div>

    <!-- SIDEBAR DROITE: LISTE DES ÉLÉMENTS -->
    <section class="card" style="padding:0;overflow:hidden;position:sticky;top:120px;margin-top:70px">
        <div style="padding:16px 20px;border-bottom:1px solid var(--line);display:flex;justify-content:space-between;align-items:center">
            <h3 style="font-size:14px;font-weight:600;margin:0" id="sidebar-title">Éléments</h3>
            <a id="btn-new-sidebar" class="primary" style="font-size:12px;padding:6px 12px;text-decoration:none;border-radius:8px">+ Nouveau</a>
        </div>
        <input id="list-search" type="text" placeholder="Rechercher…" style="width:100%;padding:10px 16px;border:none;border-bottom:1px solid var(--line);font-size:13px;outline:none;background:transparent">
        <div id="items-list" style="max-height:calc(100vh - 220px);overflow-y:auto"></div>
    </section>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="../js/supabase.js"></script>
<script src="admin-data.js"></script>
<script src="https://cdn.tiny.cloud/1/fwwpl52a8etb2e7wdn90ougk01jl20ffw2kxwmhvu5r2jwtm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
const fieldDefs = {
    actualites: [
        { key:'titre',      label:'Titre',         type:'text',     required:true },
        { key:'contenu',    label:'Contenu',        type:'textarea', required:true },
        { key:'categorie',  label:'Catégorie',      type:'dynamic_select', module:'actualites' },
        { key:'image_url',  label:'Image',          type:'file',     accept:'image/*' },
        { key:'date_pub',   label:'Date publication',type:'date' },
        { key:'auteur',     label:'Auteur',         type:'text' },
    ],
    evenements: [
        { key:'titre',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'lieu',       label:'Lieu',           type:'text' },
        { key:'date_debut', label:'Date début',     type:'datetime-local' },
        { key:'date_fin',   label:'Date fin',       type:'datetime-local' },
        { key:'type_event', label:'Type',           type:'dynamic_select', module:'evenements' },
        { key:'image_url',  label:'Image',          type:'file',     accept:'image/*' },
    ],
    normes: [
        { key:'code',       label:'Code',           type:'text',     required:true },
        { key:'titre',      label:'Intitulé',       type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'categorie',  label:'Catégorie',      type:'dynamic_select', module:'normes' },
        { key:'type_iso',   label:'Type ISO',       type:'select', options:['NCGO','ISO','CEI','Autre'] },
        { key:'origine',    label:'Origine',        type:'select', options:['Congolais','International','Régional'] },
        { key:'date_pub',   label:'Date publication',type:'date' },
        { key:'statut',     label:'Statut',         type:'select', options:['brouillon','publié','en révision','active'] },
    ],
    services: [
        { key:'title',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'icon_class', label:'Icône (classe)',  type:'text' },
        { key:'link_url',   label:'Lien URL',       type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
        { key:'active',     label:'Actif',          type:'checkbox', default:true },
    ],
    contact_messages: [
        { key:'name',       label:'Nom',            type:'text',     disabled:true },
        { key:'email',      label:'Email',          type:'text',     disabled:true },
        { key:'subject',    label:'Sujet',          type:'text',     disabled:true },
        { key:'message',    label:'Message',        type:'textarea', disabled:true },
        { key:'status',     label:'Statut',         type:'select', options:['unread','read','archived'] },
    ],
    site_settings: [
        { key:'key',        label:'Clé',            type:'text',     required:true },
        { key:'value',      label:'Valeur',         type:'textarea', required:true },
    ],
    page_sections: [
        { key:'page_slug',   label:'Page (slug)',   type:'text',     required:true },
        { key:'section_key', label:'Clé section',   type:'text',     required:true },
        { key:'badge',       label:'Badge',         type:'text' },
        { key:'title',       label:'Titre',         type:'text' },
        { key:'icon_class',  label:'Icône',         type:'text' },
        { key:'content',     label:'Contenu',       type:'textarea' },
        { key:'ordre',       label:'Ordre',         type:'number' },
        { key:'active',      label:'Actif',         type:'checkbox', default:true },
    ],
    chiffres_cles: [
        { key:'label',      label:'Libellé',        type:'text',     required:true },
        { key:'valeur',     label:'Valeur',         type:'text',     required:true },
        { key:'icone',      label:'Icône',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'ordre',      label:'Ordre',          type:'number' },
    ],
    directeur: [
        { key:'nom',        label:'Nom',            type:'text',     required:true },
        { key:'titre',      label:'Titre',          type:'text',     required:true },
        { key:'photo_url',  label:'Photo',          type:'file',     accept:'image/*' },
        { key:'message',    label:'Message',        type:'textarea', required:true },
    ],
    directions: [
        { key:'nom',        label:'Nom',            type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea', required:true },
        { key:'icone',      label:'Icône',          type:'text',     required:true },
        { key:'couleur',    label:'Couleur',        type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
    ],
    partenaires: [
        { key:'nom',        label:'Nom',            type:'text',     required:true },
        { key:'logo_url',   label:'Logo',           type:'file',     accept:'image/*' },
        { key:'site_web',   label:'Site web',       type:'text' },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'ordre',      label:'Ordre',          type:'number' },
    ],
    newsletter_subscribers: [
        { key:'nom',        label:'Nom',            type:'text',     disabled:true },
        { key:'email',      label:'Email',          type:'text',     disabled:true },
        { key:'date_inscription', label:'Inscrit le', type:'date',   disabled:true },
    ],
    page_heroes: [
        { key:'page_slug',  label:'Page (slug)',    type:'text',     required:true },
        { key:'image_url',  label:'Image',          type:'file',     accept:'image/*' },
        { key:'title',      label:'Titre',          type:'text' },
        { key:'subtitle',   label:'Sous-titre',     type:'text' },
    ],
    hero_slides: [
        { key:'image_url',  label:'Image',          type:'file',     accept:'image/*', required:true },
        { key:'alt_text',   label:'Texte alt',      type:'text' },
        { key:'badge',      label:'Badge',          type:'text' },
        { key:'title',      label:'Titre',          type:'text' },
        { key:'subtitle',   label:'Sous-titre',     type:'textarea' },
        { key:'cta1_label', label:'CTA 1 label',    type:'text' },
        { key:'cta1_url',   label:'CTA 1 URL',      type:'text' },
        { key:'cta2_label', label:'CTA 2 label',    type:'text' },
        { key:'cta2_url',   label:'CTA 2 URL',      type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
        { key:'active',     label:'Actif',          type:'checkbox', default:true },
    ],
    banners: [
        { key:'page_slug',  label:'Page (slug)',    type:'text',     required:true },
        { key:'image_url',  label:'Image',          type:'file',     accept:'image/*' },
        { key:'badge',      label:'Badge',          type:'text' },
        { key:'title',      label:'Titre',          type:'text' },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'cta1_label', label:'CTA 1 label',    type:'text' },
        { key:'cta1_url',   label:'CTA 1 URL',      type:'text' },
        { key:'features',   label:'Features (JSON)', type:'textarea' },
        { key:'ordre',      label:'Ordre',          type:'number' },
    ],
    faq_items: [
        { key:'question',   label:'Question',       type:'text',     required:true },
        { key:'answer',     label:'Réponse',        type:'textarea', required:true },
        { key:'categorie',  label:'Catégorie',      type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
        { key:'active',     label:'Actif',          type:'checkbox', default:true },
    ],
    certification_steps: [
        { key:'title',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'icon_class', label:'Icône',          type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
    ],
    processus: [
        { key:'title',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'icon_class', label:'Icône',          type:'text' },
        { key:'step_number',label:'Étape n°',       type:'number' },
    ],
    contact_info: [
        { key:'key',        label:'Clé',            type:'text',     required:true },
        { key:'value',      label:'Valeur',         type:'text',     required:true },
    ],
    schedule: [
        { key:'day',        label:'Jour',           type:'text',     required:true },
        { key:'hours',      label:'Horaires',       type:'text',     required:true },
    ],
    advantages: [
        { key:'title',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'icon_class', label:'Icône',          type:'text' },
    ],
    how_it_works: [
        { key:'title',      label:'Titre',          type:'text',     required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'icon_class', label:'Icône',          type:'text' },
        { key:'step_number',label:'Étape n°',       type:'number' },
    ],
    pcec_exceptions: [
        { key:'product_name',label:'Produit',       type:'text',     required:true },
        { key:'reason',     label:'Raison',         type:'textarea' },
        { key:'active',     label:'Actif',          type:'checkbox', default:true },
    ],
    categories: [
        { key:'nom',        label:'Nom',            type:'text',     required:true },
        { key:'type_module',label:'Module',         type:'select', options:['actualites','evenements','normes'], required:true },
        { key:'description',label:'Description',     type:'textarea' },
        { key:'couleur',    label:'Couleur',        type:'text' },
        { key:'ordre',      label:'Ordre',          type:'number' },
        { key:'active',     label:'Actif',          type:'checkbox', default:true },
    ],
};

const table = new URLSearchParams(location.search).get('table') || 'actualites';
const id = new URLSearchParams(location.search).get('id') || null;
const fields = fieldDefs[table] || [];
let currentData = {};

document.getElementById('table-label').textContent = table;
document.getElementById('btn-new-sidebar').href = 'edit.php?table=' + table;

// === SIDEBAR LIST ===
let allItems = [];
let labelKey = fields.length ? fields[0].key : 'id';

function renderSidebar(filter = '') {
    const q = filter.toLowerCase();
    const filtered = allItems.filter(r => JSON.stringify(r).toLowerCase().includes(q));
    const list = document.getElementById('items-list');
    if (!filtered.length) {
        list.innerHTML = '<div style="padding:20px;text-align:center;color:var(--muted);font-size:13px">Aucun élément.</div>';
        return;
    }
    list.innerHTML = filtered.map(r => {
        const active = r.id == id;
        const title = r[labelKey] || r.titre || r.title || r.nom || r.code || r.key || ('#' + r.id);
        const sub = r.categorie || r.statut || r.type_event || r.page_slug || '';
        const dot = (r.active === true || r.statut === 'publié') ? '#12b76a' : (r.active === false ? '#f79009' : '#667085');
        return `<a href="edit.php?table=${table}&id=${r.id}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:inherit;border-bottom:1px solid var(--line);${active ? 'background:var(--primary-light)' : ''};transition:.1s"
            onmouseover="this.style.background='${active ? 'var(--primary-light)' : '#f9fafb'}'"
            onmouseout="this.style.background='${active ? 'var(--primary-light)' : 'transparent'}'">
            <span style="width:8px;height:8px;border-radius:50%;background:${dot};flex-shrink:0"></span>
            <div style="min-width:0;flex:1">
                <div style="font-size:13px;font-weight:${active ? '600' : '500'};color:${active ? 'var(--primary)' : 'var(--ink)'};white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${String(title).substring(0, 40)}</div>
                ${sub ? '<div style="font-size:11px;color:var(--muted);margin-top:1px">' + sub + '</div>' : ''}
            </div>
        </a>`;
    }).join('');
}

document.getElementById('list-search').addEventListener('input', (e) => renderSidebar(e.target.value));

async function loadSidebar() {
    try {
        allItems = await AconoqData.query(table, 'select=*');
        document.getElementById('sidebar-title').textContent = allItems.length + ' élément(s)';
        renderSidebar();
    } catch(e) { console.warn('Sidebar load error:', e.message); }
}

loadSidebar();

function buildForm(data = {}) {
    currentData = data;
    document.getElementById('fields').innerHTML = fields.map(f => {
        let val = data[f.key] ?? f.default ?? '';
        if (val === true || val === false) val = val;
        if (f.type === 'datetime-local' && val) val = String(val).slice(0, 16);
        if (typeof val === 'object') val = JSON.stringify(val, null, 2);

        const disabled = f.disabled ? 'disabled' : '';
        const req = f.required ? 'required' : '';

        if (f.type === 'checkbox') {
            return `<label style="display:flex;align-items:center;gap:10px;font-size:13px;font-weight:600;cursor:pointer">
                <input type="checkbox" name="${f.key}" ${val !== false ? 'checked' : ''} ${disabled} style="width:18px;height:18px;accent-color:var(--primary)">
                ${f.label}
            </label>`;
        }
        if (f.type === 'file') {
            const preview = val ? `<div style="margin-top:8px"><img src="${val}" style="max-height:120px;border-radius:8px;border:1px solid var(--line)"></div>` : '';
            return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                ${f.label}
                <input type="file" name="${f.key}" accept="${f.accept||'image/*'}" ${disabled} style="width:100%;margin-top:6px;padding:10px;border:1px solid var(--line);border-radius:10px;font-size:13px;background:#fff">
                ${preview}
                ${val ? `<input type="hidden" name="${f.key}_existing" value="${val}">` : ''}
            </label>`;
        }
        if (f.type === 'textarea') {
            if (f.disabled) {
                return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                    ${f.label}
                    <textarea name="${f.key}" disabled style="width:100%;margin-top:6px;padding:12px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;min-height:120px;resize:vertical;outline:none;font-family:inherit;background:#f9fafb">${String(val).replaceAll('<','&lt;')}</textarea>
                </label>`;
            }
            return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                ${f.label}
                <textarea name="${f.key}" class="rich-editor" ${req} style="width:100%;margin-top:6px">${String(val).replaceAll('<','&lt;')}</textarea>
            </label>`;
        }
        if (f.type === 'dynamic_select') {
            return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                ${f.label}
                <select name="${f.key}" data-dynamic-module="${f.module||''}" ${disabled} ${req} style="width:100%;margin-top:6px;padding:12px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;background:#fff"><option value="">Chargement…</option></select>
            </label>`;
        }
        if (f.type === 'select') {
            const opts = f.options.map(o => `<option value="${o}" ${val === o ? 'selected' : ''}>${o}</option>`).join('');
            return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                ${f.label}
                <select name="${f.key}" ${disabled} ${req} style="width:100%;margin-top:6px;padding:12px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;background:#fff">${opts}</select>
            </label>`;
        }
        return `<label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
            ${f.label}
            <input type="${f.type}" name="${f.key}" value="${String(val).replaceAll('"','&quot;')}" ${disabled} ${req} style="width:100%;margin-top:6px;padding:12px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;outline:none">
        </label>`;
    }).join('');

    // Load dynamic selects from categories table
    loadDynamicSelects(data);

    // Init TinyMCE on rich-editor textareas
    setTimeout(initTinyMCE, 100);
}

async function loadDynamicSelects(formData) {
    const dynamicFields = fields.filter(f => f.type === 'dynamic_select');
    for (const f of dynamicFields) {
        const sel = document.querySelector(`select[data-dynamic-module="${f.module}"]`);
        if (!sel) continue;
        try {
            const cats = await AconoqData.query('categories', 'select=*&type_module=eq.' + f.module + '&active=eq.true&order=ordre');
            const currentVal = formData[f.key] || '';
            sel.innerHTML = '<option value="">— Choisir —</option>' +
                cats.map(c => `<option value="${c.nom}" ${currentVal === c.nom ? 'selected' : ''}>${c.nom}</option>`).join('') +
                '<option value="_custom">+ Ajouter une catégorie…</option>';
            sel.addEventListener('change', function() {
                if (this.value === '_custom') {
                    const name = prompt('Nom de la nouvelle catégorie :');
                    if (name && name.trim()) {
                        AconoqData.insert('categories', { nom: name.trim(), type_module: f.module, active: true, ordre: 99 }).then(() => {
                            const opt = document.createElement('option');
                            opt.value = name.trim();
                            opt.textContent = name.trim();
                            sel.insertBefore(opt, sel.lastElementChild);
                            sel.value = name.trim();
                        }).catch(e => showMsg('Erreur : ' + e.message, false));
                    } else {
                        sel.value = currentVal;
                    }
                }
            });
        } catch(e) {
            console.warn('Dynamic select error:', e.message);
            sel.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }
}

function initTinyMCE() {
    if (typeof tinymce === 'undefined') return;
    tinymce.remove();
    const textareas = document.querySelectorAll('textarea.rich-editor');
    if (!textareas.length) return;
    tinymce.init({
        selector: 'textarea.rich-editor',
        height: 350,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount',
            'emoticons', 'codesample'
        ],
        toolbar: 'undo redo | blocks | bold italic strikethrough underline | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'link image media table | ' +
            'forecolor backcolor emoticons codesample | ' +
            'removeformat code fullscreen',
        images_upload_url: '',
        automatic_uploads: false,
        content_style: 'body { font-family: Inter, -apple-system, sans-serif; font-size: 14px; padding: 12px; }',
        language: 'fr_FR',
        convert_urls: false,
        branding: false,
        promotion: false,
        setup: function(editor) {
            editor.on('change', function() { editor.save(); });
        }
    });
}

function showMsg(text, ok) {
    const el = document.getElementById('msg');
    el.style.display = 'block';
    el.style.padding = '14px 18px';
    el.style.borderRadius = '10px';
    el.style.fontSize = '13px';
    el.style.fontWeight = '600';
    if (ok) {
        el.style.background = 'var(--green-bg)';
        el.style.color = 'var(--green)';
    } else {
        el.style.background = 'var(--red-bg)';
        el.style.color = 'var(--red)';
    }
    el.textContent = text;
}

document.getElementById('form').onsubmit = async (e) => {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.textContent = 'Enregistrement…';

    // Sync TinyMCE content
    if (typeof tinymce !== 'undefined') tinymce.triggerSave();

    const formData = new FormData(e.target);
    const data = {};

    for (const [k, v] of formData.entries()) {
        if (k.endsWith('_existing')) continue;
        const field = fields.find(f => f.key === k);
        if (field && field.type === 'checkbox') {
            data[k] = true;
        } else if (field && field.type === 'file') {
            if (v.size > 0) {
                try {
                    const ext = v.name.split('.').pop();
                    const path = table + '/' + Date.now() + '_' + Math.random().toString(36).slice(2,8) + '.' + ext;
                    const { error: upErr } = await supabaseClient.storage.from('admin-images').upload(path, v, { contentType: v.type });
                    if (upErr) throw upErr;
                    const { data: urlData } = supabaseClient.storage.from('admin-images').getPublicUrl(path);
                    data[k] = urlData.publicUrl;
                } catch(err) {
                    showMsg('Erreur upload image : ' + err.message, false);
                    btn.disabled = false;
                    btn.textContent = id ? 'Enregistrer les modifications' : 'Créer le contenu';
                    return;
                }
            } else {
                const existing = formData.get(k + '_existing');
                if (existing) data[k] = existing;
            }
        } else {
            if (typeof v === 'string') {
                const raw = v.trim();
                if (raw === '') data[k] = '';
                else {
                    try { data[k] = raw.startsWith('{') || raw.startsWith('[') ? JSON.parse(raw) : raw; }
                    catch { data[k] = raw; }
                }
            }
        }
    }

    // FormData omits unchecked checkboxes; send false explicitly so updates can disable flags.
    fields.filter(f => f.type === 'checkbox' && !formData.has(f.key)).forEach(f => { data[f.key] = false; });

    try {
        if (id) {
            await AconoqData.update(table, id, data);
            showMsg('Contenu modifié avec succès !', true);
        } else {
            await AconoqData.insert(table, data);
            showMsg('Contenu créé avec succès !', true);
            setTimeout(() => {
                location.href = 'crud.php?table=' + table;
            }, 1200);
        }
    } catch(err) {
        showMsg('Erreur : ' + err.message, false);
    }

    btn.disabled = false;
    btn.textContent = id ? 'Enregistrer les modifications' : 'Créer le contenu';
};

// Load existing data if editing
(async () => {
    if (id) {
        try {
            const rows = await AconoqData.query(table, 'select=*&id=eq.' + encodeURIComponent(id));
            if (rows.length) buildForm(rows[0]);
            else { showMsg('Élément introuvable.', false); }
        } catch(e) { showMsg('Erreur chargement : ' + e.message, false); }
    } else {
        buildForm();
    }
})();
</script>
<?php admin_footer(); ?>

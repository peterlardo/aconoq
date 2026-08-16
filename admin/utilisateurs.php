<?php require '_layout.php'; admin_header('Utilisateurs', 'utilisateurs'); ?>

<div class="content">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px">
        <div class="page-head" style="margin:0">
            <p>Sécurité et accès</p>
            <h1>Gestion des utilisateurs</h1>
        </div>
        <button class="primary" onclick="openModal()">+ Nouvel utilisateur</button>
    </div>

    <!-- STATS -->
    <div class="stats-row" style="margin-bottom:24px">
        <article class="card stat-card">
            <div class="stat-header"><div class="stat-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M16 17v1a2 2 0 01-2 2H6a2 2 0 01-2-2v-1M15 7a4 4 0 11-8 0 4 4 0 018 0zM20 17v-1a4 4 0 00-3-3.9M16 3.1a4 4 0 010 7.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></div>
            <div class="stat-label">Total</div>
            <div class="stat-value" id="stat-total">—</div>
        </article>
        <article class="card stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:var(--green-bg);color:var(--green)"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="1.5"/></svg></div></div>
            <div class="stat-label">Actifs</div>
            <div class="stat-value" id="stat-active">—</div>
        </article>
        <article class="card stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:var(--red-bg);color:var(--red)"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M15 9l-6 6M9 9l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></div></div>
            <div class="stat-label">Inactifs</div>
            <div class="stat-value" id="stat-inactive">—</div>
        </article>
    </div>

    <!-- TABLE -->
    <section class="card" style="padding:20px">
        <div class="toolbar" style="margin-bottom:12px">
            <input id="search" class="search" placeholder="Rechercher un utilisateur…">
        </div>
        <div id="status" class="crud-status">Chargement…</div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Permissions</th>
                        <th>Statut</th>
                        <th style="width:140px">Actions</th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>
        </div>
    </section>
</div>

<!-- MODAL -->
<div id="modal-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;display:none;align-items:center;justify-content:center" onclick="if(event.target===this)closeModal()">
    <div class="card" style="width:680px;max-width:95vw;max-height:90vh;overflow-y:auto;padding:0">
        <div style="padding:20px 24px;border-bottom:1px solid var(--line);display:flex;justify-content:space-between;align-items:center">
            <h2 id="modal-title" style="font-size:18px;font-weight:700;margin:0">Nouvel utilisateur</h2>
            <button onclick="closeModal()" style="background:none;border:none;cursor:pointer;font-size:20px;color:var(--muted)">&times;</button>
        </div>
        <form id="user-form" style="padding:24px">
            <input type="hidden" name="id" id="f-id">
            <input type="hidden" name="auth_user_id" id="f-auth-user-id">

            <label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                Nom complet *
                <input type="text" name="full_name" id="f-fullname" required style="width:100%;margin-top:6px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;outline:none">
            </label>

            <label style="font-size:12px;font-weight:600;color:var(--muted);display:block;margin-top:16px">
                Email *
                <input type="email" name="email" id="f-email" required style="width:100%;margin-top:6px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;outline:none">
            </label>

            <label style="font-size:12px;font-weight:600;color:var(--muted);display:block;margin-top:16px">
                Mot de passe *
                <input type="password" name="password" id="f-password" minlength="6" required style="width:100%;margin-top:6px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;outline:none">
            </label>


            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px">
                <label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                    Rôle
                    <select name="role" id="f-role" style="width:100%;margin-top:6px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;background:#fff">
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="editor" selected>Éditeur</option>
                        <option value="viewer">Lecteur</option>
                    </select>
                </label>
                <label style="font-size:12px;font-weight:600;color:var(--muted);display:block">
                    Statut
                    <select name="active" id="f-active" style="width:100%;margin-top:6px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;font-size:14px;background:#fff">
                        <option value="true">Actif</option>
                        <option value="false">Inactif</option>
                    </select>
                </label>
            </div>

            <!-- PERMISSIONS -->
            <div style="margin-top:20px">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
                    <h3 style="font-size:14px;font-weight:600;margin:0">Permissions par module</h3>
                    <label style="font-size:12px;font-weight:500;display:flex;align-items:center;gap:6px;cursor:pointer">
                        <input type="checkbox" id="select-all" onchange="toggleAllPerms(this)" style="accent-color:var(--primary)">
                        Tout sélectionner
                    </label>
                </div>
                <div id="permissions-grid" style="display:grid;grid-template-columns:repeat(3, 1fr);gap:6px;max-height:240px;overflow-y:auto;padding:12px;background:var(--bg);border-radius:10px;border:1px solid var(--line)"></div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px">
                <button type="button" class="secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="primary" id="submit-btn">Enregistrer</button>
            </div>
        </form>
        <div id="msg" style="padding:0 24px 16px;display:none"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="../js/supabase.js"></script>
<script src="admin-data.js"></script>
<script>
const ALL_MODULES = [
    { slug: 'dashboard',  label: 'Dashboard' },
    { slug: 'actualites', label: 'Actualités' },
    { slug: 'evenements', label: 'Événements' },
    { slug: 'normes',     label: 'Normes' },
    { slug: 'services',   label: 'Services' },
    { slug: 'messages',   label: 'Messages' },
    { slug: 'boutique',   label: 'Boutique' },
    { slug: 'users',      label: 'Utilisateurs' },
    { slug: 'sections',   label: 'Pages & Sections' },
    { slug: 'hero',       label: 'Héros / Slider' },
    { slug: 'banners',    label: 'Bannières' },
    { slug: 'faq',        label: 'FAQ' },
    { slug: 'contact',    label: 'Contact' },
    { slug: 'settings',   label: 'Paramètres' },
];

const ROLE_LABELS = { super_admin: 'Super Admin', admin: 'Admin', editor: 'Éditeur', viewer: 'Lecteur' };
const ROLE_COLORS = { super_admin: '#dc2626', admin: '#3b82f6', editor: '#0f7140', viewer: '#64748b' };

let users = [];

function getPermsObj() {
    const perms = {};
    ALL_MODULES.forEach(m => {
        const cb = document.querySelector(`#permissions-grid input[value="${m.slug}"]`);
        perms[m.slug] = cb ? cb.checked : false;
    });
    return perms;
}

function countPerms(perms) {
    if (!perms || typeof perms !== 'object') return 0;
    return Object.values(perms).filter(v => v === true).length;
}

function fmtDate(d) {
    if (!d) return '—';
    return new Date(d).toLocaleDateString('fr-FR', { day:'numeric', month:'short', year:'numeric' });
}

function renderPerms(perms = {}) {
    document.getElementById('permissions-grid').innerHTML = ALL_MODULES.map(m =>
        `<label style="display:flex;align-items:center;gap:6px;padding:6px 8px;border-radius:6px;font-size:12px;cursor:pointer;${perms[m.slug] ? 'background:var(--primary-light);font-weight:600' : ''}">
            <input type="checkbox" name="perm_${m.slug}" value="${m.slug}" ${perms[m.slug] ? 'checked' : ''} onchange="highlightPerm(this)" style="accent-color:var(--primary)">
            ${m.label}
        </label>`
    ).join('');
}

function highlightPerm(cb) {
    const label = cb.closest('label');
    label.style.background = cb.checked ? 'var(--primary-light)' : 'transparent';
    label.style.fontWeight = cb.checked ? '600' : '';
}

function toggleAllPerms(cb) {
    document.querySelectorAll('#permissions-grid input[type=checkbox]').forEach(c => {
        c.checked = cb.checked;
        highlightPerm(c);
    });
}

function renderTable() {
    const q = document.getElementById('search').value.toLowerCase();
    const filtered = users.filter(u => JSON.stringify(u).toLowerCase().includes(q));

    document.getElementById('stat-total').textContent = users.length;
    document.getElementById('stat-active').textContent = users.filter(u => u.active).length;
    document.getElementById('stat-inactive').textContent = users.filter(u => !u.active).length;

    document.getElementById('tbody').innerHTML = filtered.map(u => {
        const perms = u.permissions || {};
        const permCount = countPerms(perms);
        const initials = (u.full_name || 'U').split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const color = ROLE_COLORS[u.role] || '#64748b';
        return `<tr>
            <td>
                <div style="display:flex;align-items:center;gap:10px">
                    <div style="width:36px;height:36px;border-radius:50%;background:${color};color:#fff;display:grid;place-items:center;font-weight:700;font-size:12px;flex-shrink:0">${initials}</div>
                    <strong style="font-size:13px">${u.full_name || '—'}</strong>
                </div>
            </td>
            <td style="font-size:13px">${u.email}</td>
            <td><span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;background:${color}15;color:${color}">${ROLE_LABELS[u.role] || u.role}</span></td>
            <td style="font-size:12px;color:var(--muted)">${permCount} module(s)</td>
            <td><span class="tag ${u.active ? 'green' : 'orange'}">${u.active ? 'Actif' : 'Inactif'}</span></td>
            <td class="actions">
                <a href="#" onclick="editUser('${u.id}');return false" style="color:var(--primary);font-size:13px;font-weight:600">Modifier</a>
                <button onclick="deleteUser('${u.id}')" style="color:var(--red);font-size:13px;font-weight:600;margin-left:12px;background:none;border:none;cursor:pointer">Supprimer</button>
            </td>
        </tr>`;
    }).join('') || '<tr><td colspan="6" class="empty">Aucun utilisateur trouvé.</td></tr>';

    document.getElementById('status').textContent = filtered.length + ' utilisateur(s)';
}

function openModal() {
    document.getElementById('modal-overlay').style.display = 'flex';
    document.getElementById('modal-title').textContent = 'Nouvel utilisateur';
    document.getElementById('user-form').reset();
    document.getElementById('f-id').value = '';
    document.getElementById('f-auth-user-id').value = '';
    document.getElementById('f-password').required = true;
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').placeholder = '';
    renderPerms({});
    document.getElementById('select-all').checked = false;
}

function closeModal() {
    document.getElementById('modal-overlay').style.display = 'none';
}

function editUser(id) {
    const u = users.find(x => x.id === id);
    if (!u) return;
    document.getElementById('modal-overlay').style.display = 'flex';
    document.getElementById('modal-title').textContent = 'Modifier : ' + u.full_name;
    document.getElementById('f-id').value = u.id;
    document.getElementById('f-auth-user-id').value = u.auth_user_id || '';
    document.getElementById('f-fullname').value = u.full_name || '';
    document.getElementById('f-email').value = u.email || '';
    document.getElementById('f-role').value = u.role || 'editor';
    document.getElementById('f-active').value = u.active ? 'true' : 'false';
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').required = false;
    document.getElementById('f-password').placeholder = 'Laisser vide pour conserver';
    renderPerms(u.permissions || {});
    const allChecked = ALL_MODULES.every(m => u.permissions && u.permissions[m.slug]);
    document.getElementById('select-all').checked = allChecked;
}

async function deleteUser(id) {
    const u = users.find(x => x.id === id);
    if (!u) return;
    if (!confirm('Supprimer l\'utilisateur ' + (u.full_name || u.email) + ' ?')) return;
    try {
        await AconoqData.remove('admin_users', id);
        await loadUsers();
    } catch(e) { alert('Erreur : ' + e.message); }
}

function showMsg(text, ok) {
    const el = document.getElementById('msg');
    el.style.display = 'block';
    el.style.cssText = 'padding:12px 24px 16px;font-size:13px;font-weight:600;border-radius:10px;margin:0 24px 16px;' + (ok ? 'background:var(--green-bg);color:var(--green)' : 'background:var(--red-bg);color:var(--red)');
    el.textContent = text;
    setTimeout(() => { el.style.display = 'none'; }, 4000);
}

document.getElementById('user-form').onsubmit = async (e) => {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.textContent = 'Enregistrement…';

    const id = document.getElementById('f-id').value;
    const password = document.getElementById('f-password').value;

    const data = {
        full_name: document.getElementById('f-fullname').value.trim(),
        email: document.getElementById('f-email').value.trim(),
        role: document.getElementById('f-role').value,
        active: document.getElementById('f-active').value === 'true',
        permissions: getPermsObj(),
        updated_at: new Date().toISOString()
    };

    try {
        if (id) {
            await AconoqData.update('admin_users', id, data);
            showMsg('Utilisateur modifié !', true);
        } else {
            if (!password || password.length < 6) {
                showMsg('Le mot de passe doit contenir au moins 6 caractères.', false);
                btn.disabled = false; btn.textContent = 'Enregistrer'; return;
            }
            const res = await fetch('api_create_user.php?t=' + Date.now(), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: data.email,
                    password: password,
                    full_name: data.full_name,
                    role: data.role,
                    active: data.active,
                    permissions: data.permissions
                })
            });
            const result = await res.json();
            if (!res.ok) {
                console.error('API Error:', JSON.stringify(result));
                throw new Error(result.error || 'Erreur création');
            }
            showMsg('Utilisateur créé !', true);
        }
        closeModal();
        await loadUsers();
    } catch(err) {
        showMsg('Erreur : ' + err.message, false);
    }
    btn.disabled = false;
    btn.textContent = 'Enregistrer';
};

document.getElementById('search').addEventListener('input', renderTable);

async function loadUsers() {
    document.getElementById('status').textContent = 'Chargement…';
    try {
        users = await AconoqData.query('admin_users', 'select=*&order=created_at.desc');
        renderTable();
    } catch(e) {
        document.getElementById('status').textContent = 'Erreur : ' + e.message;
    }
}

loadUsers();
</script>

<?php admin_footer(); ?>

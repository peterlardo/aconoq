<?php require '_layout.php'; admin_header('Dashboard', 'dashboard'); ?>
<div class="content">
    <!-- TOP BAR: SEARCH -->
    <div style="background:var(--primary);border-radius:14px;padding:20px 28px;margin-bottom:20px;color:#fff;display:flex;align-items:center;justify-content:space-between">
        <div id="welcome-wrap">
            <h2 id="welcome-title" style="margin:0;font-size:22px;color:#fff">Dashboard</h2>
            <p id="welcome-msg" style="margin:4px 0 0;font-size:13px;opacity:.85"></p>
        </div>
        <div style="position:relative;width:320px">
            <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;opacity:.4" width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="5.5" stroke="#1a1a1a" stroke-width="1.5"/><path d="M11 11l3 3" stroke="#1a1a1a" stroke-width="1.5" stroke-linecap="round"/></svg>
            <input id="global-search" type="text" placeholder="Rechercher une page, une norme, un événement…"
                   style="width:100%;padding:10px 14px 10px 36px;border-radius:10px;border:1px solid #e4e7ec;background:#fff;color:#1a1a1a;font-size:13px;outline:none;transition:.15s"
                   onfocus="this.style.borderColor='#dc2626';this.style.boxShadow='0 0 0 3px rgba(220,38,38,.15)'"
                   onblur="this.style.borderColor='#e4e7ec';this.style.boxShadow='none'">
            <div id="search-results" style="display:none;position:absolute;top:calc(100% + 6px);left:0;right:0;background:#fff;border-radius:12px;box-shadow:0 12px 32px rgba(0,0,0,.18);z-index:100;max-height:320px;overflow-y:auto;color:#1a1a1a"></div>
        </div>
    </div>

    <!-- ROW 1: 6 STAT CARDS -->
    <div class="stats-row">
        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 5h16M3 10h16M3 15h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <span class="stat-trend up" id="trend-news">—</span>
            </div>
            <div class="stat-label">Actualités</div>
            <div class="stat-value" id="s-news">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><rect x="3" y="4" width="16" height="15" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 9h16M8 2v4M14 2v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <span class="stat-trend down" id="trend-events">—</span>
            </div>
            <div class="stat-label">Événements</div>
            <div class="stat-value" id="s-events">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M6 3h10a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z" stroke="currentColor" stroke-width="1.5"/><path d="M8 7h6M8 10h6M8 13h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <span class="stat-trend up" id="trend-normes">—</span>
            </div>
            <div class="stat-label">Normes</div>
            <div class="stat-value" id="s-normes">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 6a2 2 0 012-2h10a2 2 0 012 2v9a2 2 0 01-2 2H8l-4 3V6z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <span class="stat-trend down" id="trend-messages">—</span>
            </div>
            <div class="stat-label">Messages</div>
            <div class="stat-value" id="s-messages">—</div>
        </article>
    </div>

    <!-- ROW 2: 2 MORE STATS + GAUGE -->
    <div class="stats-row">
        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M11 3v2M11 17v2M3 11h2M17 11h2M5.8 5.8l1.4 1.4M14.8 14.8l1.4 1.4M5.8 16.2l1.4-1.4M14.8 7.2l1.4-1.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <span class="stat-trend up" id="trend-services">—</span>
            </div>
            <div class="stat-label">Services</div>
            <div class="stat-value" id="s-services">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><rect x="3" y="3" width="16" height="16" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 8h16M8 8v11" stroke="currentColor" stroke-width="1.5"/></svg>
                </div>
                <span class="stat-trend up" id="trend-sections">—</span>
            </div>
            <div class="stat-label">Pages & Sections</div>
            <div class="stat-value" id="s-sections">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--green-bg);color:var(--green)">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M11 11a4 4 0 100-8 4 4 0 000 8zM3 19c0-3.3 3.6-6 8-6s8 2.7 8 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <span class="stat-trend up" id="trend-total">—</span>
            </div>
            <div class="stat-label">Total contenus</div>
            <div class="stat-value" id="s-total">—</div>
        </article>

        <article class="card stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--orange-bg);color:var(--orange)">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M11 2v4M11 16v4M2 11h4M16 11h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="11" cy="11" r="4" stroke="currentColor" stroke-width="1.5"/></svg>
                </div>
                <span class="stat-trend up" id="trend-published">—</span>
            </div>
            <div class="stat-label">Actifs (publiés)</div>
            <div class="stat-value" id="s-published">—</div>
        </article>
    </div>

    <!-- ROW 3: DERNIERS ÉVÉNEMENTS -->
    <div class="stats-row gauge-row" style="grid-template-columns:1fr">
        <article class="card" style="padding:24px">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                <h3 style="font-size:16px;font-weight:600;margin:0">Derniers événements</h3>
                <a href="crud.php?table=evenements" class="primary" style="text-decoration:none;font-size:13px;padding:8px 16px">Voir tout →</a>
            </div>
            <div id="list-events"><div class="empty-msg">Chargement…</div></div>
        </article>
    </div>

    <!-- ROW 4: STATISTICS TABLE — ACTUALITÉS -->
    <div class="card stats-card" style="margin-bottom:20px">
        <div class="card-head">
            <div>
                <h3>Dernières actualités</h3>
                <p style="color:var(--muted);font-size:13px;margin:4px 0 0">Détail des actualités publiées</p>
            </div>
            <a href="crud.php?table=actualites" class="primary" style="text-decoration:none;font-size:13px;padding:8px 16px">Voir tout →</a>
        </div>
        <div id="stats-content"><div class="empty-msg">Chargement…</div></div>
    </div>

    <!-- ROW 5: RECENT LISTS -->
    <div class="bottom-grid">
        <article class="card" style="padding:24px">
            <h3 style="font-size:16px;font-weight:600;margin:0 0 16px">Derniers messages</h3>
            <div id="list-messages"><div class="empty-msg">Chargement…</div></div>
        </article>
        <article class="card" style="padding:24px">
            <h3 style="font-size:16px;font-weight:600;margin:0 0 16px">Dernières normes</h3>
            <div id="list-normes"><div class="empty-msg">Chargement…</div></div>
        </article>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="../js/supabase.js"></script>
<script src="admin-data.js"></script>
<script>
(async function() {
    const months = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

    // === WELCOME MESSAGE ===
    function setWelcome() {
        const h = new Date().getHours();
        const greeting = h < 12 ? 'Bonjour' : h < 18 ? 'Bon après-midi' : 'Bonsoir';
        const email = localStorage.getItem('aconoq_admin_email') || 'Admin';
        const name = email.split('@')[0];
        document.getElementById('welcome-msg').textContent = greeting + ', ' + name;
    }
    setWelcome();

    function fmtDate(d) {
        if (!d) return '—';
        return new Date(d).toLocaleDateString('fr-FR', { day:'numeric', month:'short', year:'numeric' });
    }

    function animateCount(el, target) {
        if (target === 0) { el.textContent = '0'; return; }
        let current = 0;
        const step = Math.ceil(target / 25);
        const timer = setInterval(() => {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current.toLocaleString('fr-FR');
        }, 20);
    }

    function renderList(el, rows, map) {
        if (!rows || !rows.length) { el.innerHTML = '<div class="empty-msg">Aucun élément.</div>'; return; }
        el.innerHTML = rows.slice(0, 5).map(r => {
            const m = map(r);
            return `<div class="list-item">
                <div class="dot ${m.dot||'green'}"></div>
                <div class="info"><strong>${m.title}</strong><small>${m.sub||''}</small></div>
                <div class="meta">${m.meta||''}</div>
            </div>`;
        }).join('');
    }

    async function safeQuery(table, params) {
        try { return await AconoqData.query(table, params); }
        catch(e) {
            console.warn('Query failed for', table, e.message);
            // Show error in dashboard stats area for debugging
            const el = document.getElementById('stats-content');
            if (el && el.textContent.includes('Chargement')) {
                el.innerHTML = '<div class="empty-msg" style="color:#dc2626">Erreur de connexion à Supabase: ' + e.message.substring(0, 120) + '<br><small>Vérifiez la console pour plus de détails.</small></div>';
            }
            return [];
        }
    }

    try {
        const [news, events, normes, messages, services, sections] = await Promise.all([
            safeQuery('actualites', 'select=*'),
            safeQuery('evenements', 'select=*'),
            safeQuery('normes', 'select=*'),
            safeQuery('contact_messages', 'select=*'),
            safeQuery('services', 'select=*'),
            safeQuery('page_sections', 'select=*'),
        ]);

        // Counts
        const allData = [news, events, normes, messages, services, sections];
        const counts = allData.map(d => d.length);
        const activeCounts = allData.map(d => d.filter(r => r.active === true || r.statut === 'publié').length);
        const draftCounts = allData.map((d, i) => counts[i] - activeCounts[i]);

        // === STAT CARDS ===
        animateCount(document.getElementById('s-news'), counts[0]);
        animateCount(document.getElementById('s-events'), counts[1]);
        animateCount(document.getElementById('s-normes'), counts[2]);
        animateCount(document.getElementById('s-messages'), counts[3]);
        animateCount(document.getElementById('s-services'), counts[4]);
        animateCount(document.getElementById('s-sections'), counts[5]);

        const totalCount = counts.reduce((a, b) => a + b, 0);
        const totalActive = activeCounts.reduce((a, b) => a + b, 0);
        animateCount(document.getElementById('s-total'), totalCount);
        animateCount(document.getElementById('s-published'), totalActive);

        // Trends
        document.getElementById('trend-news').textContent = counts[0] + ' total';
        document.getElementById('trend-events').textContent = counts[1] + ' total';
        document.getElementById('trend-normes').textContent = counts[2] + ' total';
        const unread = messages.filter(m => m.status !== 'read').length;
        document.getElementById('trend-messages').textContent = unread + ' non lus';
        document.getElementById('trend-services').textContent = counts[4] + ' total';
        document.getElementById('trend-sections').textContent = counts[5] + ' total';
        document.getElementById('trend-total').textContent = totalCount + ' total';
        document.getElementById('trend-published').textContent = totalActive + ' actifs';

        // === LIST: DERNIERS ÉVÉNEMENTS ===
        renderList(document.getElementById('list-events'), events, r => ({
            title: r.titre || 'Sans titre',
            sub: r.lieu ? '📍 ' + r.lieu : (r.type_event || ''),
            meta: fmtDate(r.date_debut),
            dot: 'blue'
        }));

        // === TABLE: DERNIÈRES ACTUALITÉS ===
        const recentNews = news.slice(0, 10);
        if (recentNews.length) {
            document.getElementById('stats-content').innerHTML = `
                <div class="table-wrap"><table class="table">
                    <thead><tr>
                        <th>Titre</th><th>Catégorie</th><th>Auteur</th><th>Date</th><th>Lien</th>
                    </tr></thead>
                    <tbody>${recentNews.map(r => `<tr>
                        <td><strong>${(r.titre || '—').substring(0, 60)}</strong></td>
                        <td>${r.categorie || '—'}</td>
                        <td>${r.auteur || '—'}</td>
                        <td>${fmtDate(r.date_pub || r.created_at)}</td>
                        <td><a href="edit.php?table=actualites&id=${r.id}" style="color:var(--primary);font-weight:600;font-size:13px">Modifier</a></td>
                    </tr>`).join('')}</tbody>
                </table></div>`;
        } else {
            document.getElementById('stats-content').innerHTML = '<div class="empty-msg">Aucune actualité.</div>';
        }

        // === RECENT LISTS ===
        renderList(document.getElementById('list-messages'), messages, r => ({
            title: r.name || 'Anonyme',
            sub: r.subject || (r.message || '').substring(0, 50),
            meta: fmtDate(r.created_at),
            dot: r.status === 'read' ? 'green' : 'red'
        }));
        renderList(document.getElementById('list-normes'), normes, r => ({
            title: r.code || r.titre || 'Sans titre',
            sub: r.categorie || r.description || '',
            meta: r.statut || '—',
            dot: r.statut === 'publié' ? 'green' : 'orange'
        }));

        // === GLOBAL SEARCH ===
        const searchInput = document.getElementById('global-search');
        const searchResults = document.getElementById('search-results');
        let searchTimer;

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            const q = searchInput.value.trim().toLowerCase();
            if (q.length < 2) { searchResults.style.display = 'none'; searchResults.innerHTML = ''; return; }

            searchTimer = setTimeout(() => {
                const matches = [];
                news.forEach(r => {
                    const haystack = [r.titre, r.categorie, r.auteur, r.contenu].join(' ').toLowerCase();
                    if (haystack.includes(q)) matches.push({ type: 'Actualité', title: r.titre, sub: r.categorie || '', id: r.id, table: 'actualites' });
                });
                events.forEach(r => {
                    const haystack = [r.titre, r.lieu, r.type_event, r.description].join(' ').toLowerCase();
                    if (haystack.includes(q)) matches.push({ type: 'Événement', title: r.titre, sub: r.lieu || r.type_event || '', id: r.id, table: 'evenements' });
                });

                if (!matches.length) {
                    searchResults.innerHTML = '<div style="padding:14px 16px;color:#667;font-size:13px">Aucun résultat pour "' + searchInput.value.trim() + '"</div>';
                } else {
                    searchResults.innerHTML = matches.slice(0, 8).map(m => `
                        <a href="edit.php?table=${m.table}&id=${m.id}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:inherit;border-bottom:1px solid #f3f4f6;transition:.1s"
                           onmouseover="this.style.background='#f8faf9'" onmouseout="this.style.background='transparent'">
                            <span style="flex-shrink:0;font-size:11px;font-weight:600;padding:3px 8px;border-radius:6px;${m.type === 'Actualité' ? 'background:#dcfce7;color:#16a34a' : 'background:#dbeafe;color:#2563eb'}">${m.type}</span>
                            <div style="min-width:0">
                                <div style="font-size:13px;font-weight:600;color:#1a1a1a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${m.title || 'Sans titre'}</div>
                                ${m.sub ? '<div style="font-size:12px;color:#667;margin-top:1px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + m.sub + '</div>' : ''}
                            </div>
                        </a>
                    `).join('');
                }
                searchResults.style.display = 'block';
            }, 200);
        });

        searchInput.addEventListener('blur', () => setTimeout(() => { searchResults.style.display = 'none'; }, 250));
        searchInput.addEventListener('focus', () => { if (searchResults.innerHTML) searchResults.style.display = 'block'; });

        // Badge sidebar
        const badge = document.getElementById('badge-messages');
        if (badge) badge.textContent = unread || '';

    } catch(e) {
        console.error('Dashboard error:', e);
    }
})();
</script>
<?php admin_footer(); ?>
// ============================================
// ACONOQ - Application Logic
// ============================================

function getPageSlug() {
  const path = window.location.pathname;
  const file = path.split('/').pop() || 'index.html';
  return file.replace('.html', '');
}

document.addEventListener('DOMContentLoaded', () => {
  const slug = getPageSlug();
  loadChiffresCles();
  loadDirections();
  loadNormes();
  loadEvenements();
  loadPartenaires();
  loadActualites();
  loadDynamicPcecRoutes();
  loadDynamicFooter();
  initFormulaires();
  loadDynamicPageHero(slug);
  loadDynamicPageContent(slug);

  if (slug === 'index') {
    loadDynamicHeroSlides();
    loadDynamicServices();
    loadDynamicBanners();
    loadDynamicProcessus();
  }
  if (slug === 'boutique') {
    loadBoutiqueContent();
  }
  if (slug === 'contact') {
    loadDynamicContactInfo();
  }
  if (slug === 'pcec') {
    loadPcecExceptions();
    loadCertificationSteps();
  }
  if (slug === 'conformite') {
    loadCertificationSteps();
  }
});

// ============================================
// 1. CHIFFRES CLES
// ============================================
async function loadChiffresCles() {
  const container = document.getElementById('chiffres-cles-grid');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('chiffres_cles')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;

    container.innerHTML = data.map(item => `
      <div class="text-center">
        <div class="chiffre-icon mx-auto mb-3">
          <i class="${item.icone}"></i>
        </div>
        <div class="chiffre-value font-serif text-3xl lg:text-4xl font-bold text-white mb-1" data-target="${item.valeur}">
          0
        </div>
        <p class="text-white/80 text-sm font-medium">${item.label}</p>
        <p class="text-white/50 text-xs mt-1">${item.description}</p>
      </div>
    `).join('');

    animateChiffres();
  } catch (err) {
    console.error('Erreur chargement chiffres cles:', err);
  }
}

function animateChiffres() {
  const values = document.querySelectorAll('.chiffre-value');
  values.forEach(el => {
    const target = el.getAttribute('data-target');
    const numStr = target.replace(/[^0-9]/g, '');
    const suffix = target.replace(/[0-9\s]/g, '');
    const num = parseInt(numStr);
    let current = 0;
    const step = Math.ceil(num / 60);
    const interval = setInterval(() => {
      current += step;
      if (current >= num) {
        current = num;
        clearInterval(interval);
      }
      el.textContent = current.toLocaleString('fr-FR') + suffix;
    }, 30);
  });
}

// ============================================
// 2. NOS DIRECTIONS
// ============================================
async function loadDirections() {
  const container = document.getElementById('nav-directions');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('directions')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;

    container.innerHTML = data.map(item => `
      <a href="#" class="block px-4 py-2 text-xs text-gray-600 hover:bg-primary-light hover:text-primary transition">
        ${item.nom}
      </a>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement directions:', err);
  }
}

// ============================================
// 3. NORMES POPULAIRES
// ============================================
async function loadNormes() {
  const container = document.getElementById('normes-grid');
  const countEl = document.getElementById('normes-count');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('normes')
      .select('*')
      .eq('statut', 'active')
      .order('date_pub', { ascending: false });

    if (error) throw error;

    window._normesData = data;
    renderNormes(data);
    if (countEl) countEl.textContent = data.length;
    populateNormeFilters(data);
    bindNormeFilters();
  } catch (err) {
    console.error('Erreur chargement normes:', err);
    container.innerHTML = '<p class="text-gray-text text-center col-span-3">Donn\u00e9es temporairement indisponibles</p>';
  }
}

function renderNormes(normes) {
  const container = document.getElementById('normes-grid');
  const countEl = document.getElementById('normes-count');
  if (countEl) countEl.textContent = normes.length;

  if (normes.length === 0) {
    container.innerHTML = '<p class="text-gray-text text-center col-span-3">Aucune norme ne correspond \u00e0 votre recherche.</p>';
    return;
  }

  container.innerHTML = normes.map(item => `
    <div class="feature-card">
      <div class="flex items-center justify-between mb-3">
        <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-primary-light text-primary">
          ${item.categorie}
        </span>
        <span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full bg-green-100 text-green-700">
          ${item.statut}
        </span>
      </div>
      <h3 class="font-semibold text-base text-dark mb-1">${item.code}</h3>
      <p class="font-medium text-sm text-dark mb-2">${item.titre}</p>
      <p class="text-gray-text text-xs leading-relaxed mb-3">${item.description || ''}</p>
      <div class="flex items-center gap-2 mb-3">
        ${item.type_iso ? `<span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded bg-blue-50 text-blue-700">${item.type_iso}</span>` : ''}
        ${item.origine ? `<span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded bg-orange-50 text-orange-700">${item.origine}</span>` : ''}
      </div>
      <div class="flex items-center justify-between">
        <span class="text-xs text-gray-text"><i class="far fa-calendar mr-1"></i>${new Date(item.date_pub).toLocaleDateString('fr-FR')}</span>
        <a href="#" class="text-primary text-xs font-medium inline-flex items-center gap-1 hover:gap-2 transition-all">
          Consulter <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  `).join('');
}

function populateNormeFilters(data) {
  const categories = [...new Set(data.map(n => n.categorie))].sort();
  const types = [...new Set(data.map(n => n.type_iso).filter(Boolean))].sort();
  const origins = [...new Set(data.map(n => n.origine).filter(Boolean))].sort();
  const years = [...new Set(data.map(n => new Date(n.date_pub).getFullYear()))].sort((a, b) => b - a);

  const fillSelect = (id, values) => {
    const sel = document.getElementById(id);
    if (!sel) return;
    const first = sel.options[0];
    sel.innerHTML = '';
    sel.appendChild(first);
    values.forEach(v => {
      const opt = document.createElement('option');
      opt.value = v;
      opt.textContent = v;
      sel.appendChild(opt);
    });
  };

  fillSelect('filter-categorie', categories);
  fillSelect('filter-type-iso', types);
  fillSelect('filter-origine', origins);
  fillSelect('filter-annee', years);
}

function bindNormeFilters() {
  const searchInput = document.getElementById('norme-search-input');
  const filters = ['filter-categorie', 'filter-type-iso', 'filter-origine', 'filter-annee'];

  const applyFilters = () => {
    const q = searchInput ? searchInput.value.toLowerCase() : '';
    const cat = document.getElementById('filter-categorie').value;
    const typeIso = document.getElementById('filter-type-iso').value;
    const origine = document.getElementById('filter-origine').value;
    const annee = document.getElementById('filter-annee').value;

    let results = window._normesData || [];

    if (q) {
      results = results.filter(n =>
        n.code.toLowerCase().includes(q) ||
        n.titre.toLowerCase().includes(q) ||
        (n.description && n.description.toLowerCase().includes(q))
      );
    }
    if (cat !== 'all') results = results.filter(n => n.categorie === cat);
    if (typeIso !== 'all') results = results.filter(n => n.type_iso === typeIso);
    if (origine !== 'all') results = results.filter(n => n.origine === origine);
    if (annee !== 'all') results = results.filter(n => new Date(n.date_pub).getFullYear() === Number(annee));

    renderNormes(results);
  };

  if (searchInput) searchInput.addEventListener('input', applyFilters);
  filters.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('change', applyFilters);
  });
}

// ============================================
// 4. EVENEMENTS
// ============================================
async function loadEvenements() {
  const container = document.getElementById('evenements-grid');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('evenements')
      .select('*')
      .gte('date_debut', new Date().toISOString())
      .order('date_debut', { ascending: true })
      .limit(4);

    if (error) throw error;

    if (data.length === 0) {
      container.innerHTML = '<p class="text-gray-text text-center col-span-4">Aucun \u00e9v\u00e9nement \u00e0 venir pour le moment.</p>';
      return;
    }

    const typeColors = {
      formation: { bg: 'bg-blue-100', text: 'text-blue-700', label: 'Formation' },
      salon: { bg: 'bg-purple-100', text: 'text-purple-700', label: 'Salon' },
      evenement: { bg: 'bg-green-100', text: 'text-green-700', label: '\u00c9v\u00e9nement' }
    };

    container.innerHTML = data.map(item => {
      const type = typeColors[item.type_event] || typeColors.evenement;
      const dateStart = new Date(item.date_debut);
      const day = dateStart.toLocaleDateString('fr-FR', { day: '2-digit' });
      const month = dateStart.toLocaleDateString('fr-FR', { month: 'short' });
      const year = dateStart.getFullYear();

      return `
        <div class="feature-card group">
          ${item.image_url ? `
            <div class="overflow-hidden rounded-lg mb-4">
              <img src="${item.image_url}" alt="${item.titre}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-500">
            </div>
          ` : ''}
          <div class="flex items-start gap-4">
            <div class="text-center flex-shrink-0 bg-primary-light rounded-xl px-3 py-2">
              <div class="text-2xl font-bold text-primary leading-none">${day}</div>
              <div class="text-xs text-primary uppercase font-medium">${month}</div>
              <div class="text-[10px] text-gray-text">${year}</div>
            </div>
            <div class="flex-1 min-w-0">
              <span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full ${type.bg} ${type.text} mb-2">
                ${type.label}
              </span>
              <h3 class="font-semibold text-sm text-dark mb-1 line-clamp-2">${item.titre}</h3>
              <p class="text-gray-text text-xs leading-relaxed mb-2 line-clamp-2">${item.description || ''}</p>
              <div class="flex items-center gap-3 text-[11px] text-gray-text">
                <span><i class="fas fa-map-marker-alt mr-1"></i>${item.lieu || 'Non pr\u00e9cis\u00e9'}</span>
              </div>
            </div>
          </div>
        </div>
      `;
    }).join('');
  } catch (err) {
    console.error('Erreur chargement \u00e9v\u00e9nements:', err);
  }
}

// ============================================
// 5. DYNAMIC PAGE HERO
// ============================================
async function loadDynamicPageHero(slug) {
  const heroEl = document.getElementById('page-hero');
  if (!heroEl) return;

  try {
    const { data, error } = await supabaseClient
      .from('page_heroes')
      .select('*')
      .eq('page_slug', slug)
      .single();

    if (error || !data) return;

    if (data.image_url) {
      heroEl.style.backgroundImage = `url('${data.image_url}')`;
    }
    const titleEl = heroEl.querySelector('.hero-title');
    if (titleEl && data.title) titleEl.textContent = data.title;
    const subEl = heroEl.querySelector('.hero-subtitle');
    if (subEl && data.subtitle) subEl.textContent = data.subtitle;
  } catch (err) {
    console.error('Erreur chargement hero:', err);
  }
}

// ============================================
// 6. DYNAMIC PAGE CONTENT (page_sections + card_grids)
// ============================================
async function loadDynamicPageContent(slug) {
  const sectionsContainer = document.getElementById('dynamic-sections');
  if (!sectionsContainer) return;

  try {
    const [sectionsRes, gridsRes] = await Promise.all([
      supabaseClient.from('page_sections').select('*').eq('page_slug', slug).order('ordre', { ascending: true }),
      supabaseClient.from('card_grids').select('*').eq('page_slug', slug).order('ordre', { ascending: true })
    ]);

    const sections = sectionsRes.data || [];
    const grids = gridsRes.data || [];

    const groupedGrids = {};
    grids.forEach(g => {
      if (!groupedGrids[g.grid_key]) groupedGrids[g.grid_key] = [];
      groupedGrids[g.grid_key].push(g);
    });

    sectionsContainer.innerHTML = sections.map(s => renderPageSection(s, groupedGrids)).join('');
  } catch (err) {
    console.error('Erreur chargement sections:', err);
  }
}

function renderPageSection(section, groupedGrids) {
  const c = section.content || {};
  let html = '';

  if (section.badge) {
    html += `<span class="text-primary text-xs font-semibold tracking-widest uppercase mb-3 block">${section.badge}</span>`;
  }
  html += `<h2 class="font-serif text-3xl lg:text-4xl font-bold text-dark mb-6"><i class="${section.icon_class} text-primary mr-3 text-2xl"></i>${section.title}</h2>`;

  if (c.paragraphs && Array.isArray(c.paragraphs)) {
    html += c.paragraphs.map(p => `<p class="text-gray-text text-base leading-relaxed mb-4">${p}</p>`).join('');
  }

  if (c.description) {
    html += `<p class="text-gray-text text-base leading-relaxed mb-6">${c.description}</p>`;
  }

  if (c.list_title) {
    html += `<h3 class="font-semibold text-lg text-dark mb-3 mt-6">${c.list_title}</h3>`;
  }

  if (c.list_items && Array.isArray(c.list_items)) {
    html += '<div class="bg-gray-50 rounded-xl p-6 mb-6">';
    html += c.list_items.map((item, i) => `
      <div class="flex items-start gap-3 mb-3">
        <span class="flex-shrink-0 w-7 h-7 bg-primary/10 text-primary rounded-full flex items-center justify-center text-sm font-bold">${i + 1}</span>
        <p class="text-gray-text text-sm leading-relaxed pt-0.5">${item}</p>
      </div>
    `).join('');
    html += '</div>';
  }

  if (c.items && Array.isArray(c.items)) {
    html += '<div class="bg-gray-50 rounded-xl p-6 mb-6">';
    html += c.items.map(item => `
      <div class="flex items-start gap-3 mb-3">
        <i class="fas fa-check-circle text-primary mt-1 flex-shrink-0"></i>
        <p class="text-gray-text text-sm leading-relaxed">${item}</p>
      </div>
    `).join('');
    html += '</div>';
  }

  if (c.services && Array.isArray(c.services)) {
    html += '<div class="grid sm:grid-cols-3 gap-6 mt-6">';
    html += c.services.map(s => `
      <div class="bg-gray-50 rounded-xl p-5 text-center">
        <i class="${s.icon} text-primary text-2xl mb-3"></i>
        <p class="font-semibold text-sm text-dark">${s.name}</p>
      </div>
    `).join('');
    html += '</div>';
  }

  if (c.cards && Array.isArray(c.cards)) {
    html += '<div class="grid sm:grid-cols-2 gap-6 mt-6">';
    html += c.cards.map(card => {
      const colorClass = card.color === 'red' ? 'bg-red-50 text-red-600' : 'bg-primary-light text-primary';
      return `
        <div class="feature-card">
          <span class="feature-icon ${colorClass}"><i class="${card.icon}"></i></span>
          <h3 class="font-semibold text-base text-dark mb-2">${card.title}</h3>
          <p class="text-gray-text text-sm leading-relaxed">${card.description}</p>
        </div>
      `;
    }).join('');
    html += '</div>';
  }

  if (c.highlight) {
    html += `<div class="bg-primary-light border-l-4 border-primary rounded-r-xl p-5 mt-6">
      <p class="text-primary text-sm font-medium"><i class="fas fa-star mr-2"></i>${c.highlight}</p>
    </div>`;
  }

  if (c.name && c.role) {
    const name = c.name;
    const role = c.role;
    const photo = c.photo_url || '';
    const paragraphs = c.paragraphs || [];
    const sigName = c.signature_name || name;
    const sigTitle = c.signature_title || role;
    const sigOrg = c.signature_org || '';

    html = `
      <div class="grid lg:grid-cols-2 gap-12 items-start">
        <div class="relative lg:sticky lg:top-28">
          ${photo ? `<div class="rounded-2xl overflow-hidden shadow-2xl"><img src="${photo}" alt="${name}" class="w-full h-[400px] object-cover"></div>` : ''}
        </div>
        <div>
          <p class="text-primary text-xs font-semibold tracking-widest uppercase mb-3">${section.badge || 'Message officiel'}</p>
          <h2 class="font-serif text-3xl lg:text-4xl font-bold text-dark mb-6"><strong>${name}</strong></h2>
          <p class="text-gray-text text-sm mb-4 italic">${role}</p>
          ${paragraphs.map(p => `<p class="text-gray-text text-base leading-relaxed mb-4">${p}</p>`).join('')}
          <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="font-bold text-dark">${sigName}</p>
            <p class="text-gray-text text-sm">${sigTitle}</p>
            <p class="text-gray-text text-xs">${sigOrg}</p>
          </div>
        </div>
      </div>
    `;
    return html;
  }

  return `<section class="mb-10">${html}</section>`;
}

// ============================================
// 7. DYNAMIC SERVICES GRID (index)
// ============================================
async function loadDynamicServices() {
  const container = document.getElementById('dynamic-services');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('services')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;

    container.innerHTML = data.map(item => `
      <div class="feature-card">
        <span class="feature-icon"><i class="${item.icon_class}" style="font-size:22px"></i></span>
        <h3>${item.title}</h3>
        <p>${item.description}</p>
        ${item.link_url && item.link_url !== '#' ? `<a href="${item.link_url}" class="link-more"><span class="link-more-inner">En savoir plus</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>` : ''}
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement services:', err);
  }
}

// ============================================
// 8. DYNAMIC HERO SLIDES (index)
// ============================================
async function loadDynamicHeroSlides() {
  const carousel = document.getElementById('heroCarousel');
  if (!carousel) return;

  try {
    const { data, error } = await supabaseClient
      .from('hero_slides')
      .select('*')
      .order('ordre', { ascending: true });

    if (error || !data || data.length === 0) return;

    carousel.innerHTML = data.map((s, i) =>
      `<div class="hero-slide ${i === 0 ? 'active' : ''}" style="background-image: url('${s.image_url}')"></div>`
    ).join('');

    const dotsContainer = document.getElementById('carouselDots');
    if (dotsContainer) {
      dotsContainer.innerHTML = data.map((_, i) =>
        `<button class="carousel-dot ${i === 0 ? 'active' : ''}" onclick="goToSlide(${i})"></button>`
      ).join('');
    }

    const heroText = document.querySelector('.hero-content-inner');
    if (heroText && data[0]) {
      const badge = heroText.querySelector('.hero-badge');
      const title = heroText.querySelector('.hero-title');
      const subtitle = heroText.querySelector('.hero-subtitle');
      const cta1 = heroText.querySelector('.hero-cta1');
      const cta2 = heroText.querySelector('.hero-cta2');
      if (badge && data[0].badge) badge.textContent = data[0].badge;
      if (title) title.innerHTML = data[0].title || '';
      if (subtitle) subtitle.innerHTML = data[0].subtitle || '';
      if (cta1 && data[0].cta1_label) { cta1.textContent = data[0].cta1_label; cta1.href = data[0].cta1_url || '#'; }
      if (cta2 && data[0].cta2_label) { cta2.textContent = data[0].cta2_label; cta2.href = data[0].cta2_url || '#'; }
    }

    window._heroSlides = data;
    window._heroTotal = data.length;
  } catch (err) {
    console.error('Erreur chargement hero slides:', err);
  }
}

// ============================================
// 9. DYNAMIC BANNERS (index)
// ============================================
async function loadDynamicBanners() {
  const container = document.getElementById('dynamic-banners');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('banners')
      .select('*')
      .eq('page_slug', 'index')
      .order('ordre', { ascending: true });

    if (error || !data || data.length === 0) return;

    const filtered = data.filter(b => b.badge !== 'Boutique en ligne');
    if (filtered.length === 0) { container.remove(); return; }

    container.innerHTML = filtered.map(b => `
      <section class="relative h-[400px] lg:h-[480px] overflow-hidden mb-8">
        <img src="${b.image_url}" alt="${b.title}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-primary/50 to-transparent"></div>
        <div class="absolute inset-0 flex items-center">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-xl text-white">
              <span class="text-white/80 text-xs font-semibold tracking-widest uppercase">${b.badge}</span>
              <h2 class="font-serif text-3xl lg:text-5xl font-black mt-3 mb-4">${b.title}</h2>
              <p class="text-white/80 text-base leading-relaxed mb-6">${b.description}</p>
              <a href="${b.cta1_url || '#'}" class="inline-flex items-center gap-2 bg-white text-primary px-6 py-3 rounded text-sm font-semibold hover:bg-gray-100 transition">
                ${b.cta1_label} <i class="fas fa-arrow-right text-xs"></i>
              </a>
            </div>
          </div>
        </div>
      </section>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement banners:', err);
  }
}

// ============================================
// 10. DYNAMIC PROCESSUS (index)
// ============================================
async function loadDynamicProcessus() {
  const container = document.getElementById('processCarousel') || document.getElementById('dynamic-processCarousel') || document.getElementById('dynamic-processus');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('processus')
      .select('*')
      .order('ordre', { ascending: true });

    if (error || !data || data.length === 0) return;

    container.innerHTML = data.map(item => `
      <div class="process-slide min-w-[33.333%] px-3">
        <div class="feature-card h-full">
          <span class="feature-icon"><i class="${item.icon_class}" style="font-size:22px"></i></span>
          <h3>${item.title}</h3>
          <p>${item.description}</p>
          <a href="${item.link_url || '#'}" class="link-more link-more-red mt-4"><span class="link-more-inner">En savoir plus</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
        </div>
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement processus:', err);
  }
}

// ============================================
// 11. CONTACT INFO + SCHEDULE
// ============================================
async function loadDynamicContactInfo() {
  const infoContainer = document.getElementById('dynamic-contact-info');
  const schedContainer = document.getElementById('dynamic-schedule');
  if (!infoContainer && !schedContainer) return;

  try {
    const [infoRes, schedRes] = await Promise.all([
      supabaseClient.from('contact_info').select('*').order('ordre', { ascending: true }),
      supabaseClient.from('schedule').select('*').order('ordre', { ascending: true })
    ]);

    if (infoContainer && infoRes.data) {
      infoContainer.innerHTML = infoRes.data.map(item => `
        <div class="feature-card flex items-start gap-4">
          <span class="feature-icon"><i class="${item.icon_class}"></i></span>
          <div>
            <h3 class="font-semibold text-base text-dark mb-1">${item.title}</h3>
            ${item.link ? `<a href="${item.link}" class="text-primary text-sm hover:underline">${item.value}</a>` : `<p class="text-gray-text text-sm">${item.value}</p>`}
          </div>
        </div>
      `).join('');
    }

    if (schedContainer && schedRes.data) {
      schedContainer.innerHTML = schedRes.data.map(item => `
        <div class="flex items-center justify-between py-2 ${item.ordre < schedRes.data.length ? 'border-b border-gray-100' : ''}">
          <span class="text-sm text-gray-text">${item.days}</span>
          <span class="text-sm font-medium ${item.status === 'Ouvert' ? 'text-green-600' : 'text-red-500'}">${item.hours}</span>
        </div>
      `).join('');
    }
  } catch (err) {
    console.error('Erreur chargement contact info:', err);
  }
}

// ============================================
// 12. BOUTIQUE: FAQ + ADVANTAGES + HOW IT WORKS
// ============================================
async function loadBoutiqueContent() {
  const faqContainer = document.getElementById('dynamic-faq');
  const advContainer = document.getElementById('dynamic-advantages');
  const hiwContainer = document.getElementById('dynamic-how-it-works');

  try {
    const [faqRes, advRes, hiwRes] = await Promise.all([
      faqContainer ? supabaseClient.from('faq_items').select('*').eq('page_slug', 'boutique').order('ordre', { ascending: true }) : { data: null },
      advContainer ? supabaseClient.from('advantages').select('*').eq('page_slug', 'boutique').order('ordre', { ascending: true }) : { data: null },
      hiwContainer ? supabaseClient.from('how_it_works').select('*').eq('page_slug', 'boutique').order('ordre', { ascending: true }) : { data: null }
    ]);

    if (faqContainer && faqRes.data && faqRes.data.length) {
      faqContainer.innerHTML = faqRes.data.map(item => `
        <div class="feature-card">
          <div class="flex items-start gap-3 mb-2">
            <i class="${item.icon_class} text-primary mt-1"></i>
            <h3 class="font-semibold text-sm text-dark">${item.question}</h3>
          </div>
          <p class="text-gray-text text-sm leading-relaxed ml-9">${item.answer}</p>
        </div>
      `).join('');
    }

    if (advContainer && advRes.data && advRes.data.length) {
      advContainer.innerHTML = advRes.data.map(item => `
        <div class="flex items-start gap-3 mb-4">
          <div class="w-10 h-10 bg-primary-light rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="${item.icon_class} text-primary"></i>
          </div>
          <div>
            <h4 class="font-semibold text-sm text-dark">${item.title}</h4>
            <p class="text-gray-text text-xs leading-relaxed">${item.description}</p>
          </div>
        </div>
      `).join('');
    }

    if (hiwContainer && hiwRes.data && hiwRes.data.length) {
      hiwContainer.innerHTML = hiwRes.data.map(item => `
        <div class="text-center">
          <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white font-bold text-xl">${item.step_number}</span>
          </div>
          <h4 class="font-semibold text-sm text-dark mb-2">${item.title}</h4>
          <p class="text-gray-text text-xs leading-relaxed">${item.description}</p>
        </div>
      `).join('');
    }
  } catch (err) {
    console.error('Erreur chargement boutique:', err);
  }
}

// ============================================
// 13. PCEC EXCEPTIONS
// ============================================
async function loadPcecExceptions() {
  const container = document.getElementById('dynamic-pcec-exceptions');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('pcec_exceptions')
      .select('*')
      .limit(1)
      .single();

    if (error || !data) return;

    const items = data.items || [];
    container.innerHTML = `
      <h3 class="font-semibold text-lg text-dark mb-2">${data.title}</h3>
      <p class="text-gray-text text-sm mb-4">${data.intro_text}</p>
      <div class="grid sm:grid-cols-2 gap-2">
        ${items.map((item, i) => `
          <div class="flex items-start gap-2 bg-gray-50 rounded-lg p-3">
            <span class="flex-shrink-0 w-6 h-6 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs font-bold">${i + 1}</span>
            <p class="text-gray-text text-sm">${item}</p>
          </div>
        `).join('')}
      </div>
    `;
  } catch (err) {
    console.error('Erreur chargement PCEC exceptions:', err);
  }
}

// ============================================
// 14. CERTIFICATION STEPS
// ============================================
async function loadCertificationSteps() {
  const container = document.getElementById('dynamic-certification-steps');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('certification_steps')
      .select('*')
      .order('ordre', { ascending: true });

    if (error || !data || !data.length) return;

    container.innerHTML = data.map(step => `
      <div class="flex items-start gap-4">
        <div class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold">${step.step_number}</div>
        <div>
          <h4 class="font-semibold text-sm text-dark">${step.title}</h4>
          <p class="text-gray-text text-sm">${step.description}</p>
        </div>
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement certification steps:', err);
  }
}

// ============================================
// 15. PARTENAIRES (infinite scroll)
// ============================================
async function loadPartenaires() {
  const container = document.getElementById('dynamic-partenaires');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('partenaires')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;
    if (!data || data.length === 0) return;

    const items = data.map(p => `
      <a href="${p.site_web || '#'}" target="_blank" rel="noopener" class="partenaire-item flex-shrink-0 flex items-center justify-center gap-3 px-10 py-6 bg-white rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-lg transition-all duration-300 group min-w-[200px]" title="${p.description || ''}">
        <img src="${p.logo_url || ''}" alt="${p.nom}" class="h-10 w-10 object-contain">
        <span class="text-base font-bold text-gray-700 group-hover:text-primary transition-colors">${p.nom}</span>
      </a>
    `).join('');

    container.innerHTML = items + items;
  } catch (err) {
    console.error('Erreur chargement partenaires:', err);
  }
}

// ============================================
// 16. ACTUALITES
// ============================================
async function loadActualites() {
  const container = document.getElementById('dynamic-actualites');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('actualites')
      .select('*')
      .order('date_pub', { ascending: false })
      .limit(6);

    if (error) throw error;
    if (!data || data.length === 0) {
      container.innerHTML = '<p class="text-gray-text text-center col-span-3">Aucune actualité pour le moment.</p>';
      return;
    }

    container.innerHTML = data.map(item => `
      <div class="feature-card group">
        <div class="overflow-hidden rounded-lg mb-4">
          <img src="${item.image_url || ''}" alt="${item.titre}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
        </div>
        <span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full bg-primary-light text-primary mb-2">${item.categorie || ''}</span>
        <h3 class="font-semibold text-sm text-dark mb-1">${item.titre}</h3>
        <p class="text-gray-text text-xs leading-relaxed mb-2">${item.contenu || ''}</p>
        <span class="text-[11px] text-gray-text"><i class="far fa-calendar mr-1"></i>${item.date_pub ? new Date(item.date_pub).toLocaleDateString('fr-FR') : ''}</span>
        <a href="#" class="text-primary text-sm font-medium inline-flex items-center gap-2 hover:gap-3 transition-all mt-3">Lire la suite <i class="fas fa-arrow-right text-xs"></i></a>
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement actualités:', err);
  }
}

// ============================================
// 17. DYNAMIC PCEC ROUTES (card_grids)
// ============================================
async function loadDynamicPcecRoutes() {
  const container = document.getElementById('dynamic-pcec-routes');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('card_grids')
      .select('*')
      .eq('page_slug', 'index')
      .eq('grid_key', 'pcec-routes')
      .order('ordre', { ascending: true });

    if (error) throw error;
    if (!data || data.length === 0) return;

    container.innerHTML = data.map(item => `
      <div class="feature-card">
        <span class="feature-icon"><i class="${item.icon_class || 'fas fa-route'}" style="font-size:22px"></i></span>
        <h3>${item.title}</h3>
        <p>${item.description || ''}</p>
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement PCEC routes:', err);
  }
}

// ============================================
// 18. DYNAMIC FOOTER
// ============================================
async function loadDynamicFooter() {
  const container = document.getElementById('dynamic-footer');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('site_settings')
      .select('*')
      .eq('key', 'footer')
      .single();

    if (error || !data) return;

    const val = data.value || {};
    const links = val.links || {};
    const contact = val.contact || {};

    container.innerHTML = `
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
          <div class="col-span-2 md:col-span-1">
            <a href="/" class="flex items-center gap-2 mb-4">
              <img src="${val.logo || 'aconoq_logo.png'}" alt="ACONOQ" class="h-10">
            </a>
            <p class="text-white/70 text-sm leading-relaxed mb-4">${val.description || ''}</p>
            <div class="flex gap-3">
              ${(val.social || []).map(s => `<a href="${s.url}" target="_blank" rel="noopener" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition"><i class="${s.icon} text-white text-sm"></i></a>`).join('')}
            </div>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">ACONOQ</h4>
            <ul class="space-y-2">
              ${(links.aconoq || []).map(l => `<li><a href="${l.url}" class="text-white/70 text-sm hover:text-white transition">${l.label}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">Directions</h4>
            <ul class="space-y-2">
              ${(links.directions || []).map(l => `<li><a href="${l.url}" class="text-white/70 text-sm hover:text-white transition">${l.label}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">Services</h4>
            <ul class="space-y-2">
              ${(links.services || []).map(l => `<li><a href="${l.url}" class="text-white/70 text-sm hover:text-white transition">${l.label}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">Contact</h4>
            <ul class="space-y-3">
              ${contact.address ? `<li class="flex items-start gap-2 text-white/70 text-sm"><i class="fas fa-map-marker-alt mt-1"></i><span>${contact.address}</span></li>` : ''}
              ${contact.phone ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-phone"></i><a href="tel:${contact.phone}" class="hover:text-white transition">${contact.phone}</a></li>` : ''}
              ${contact.email ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-envelope"></i><a href="mailto:${contact.email}" class="hover:text-white transition">${contact.email}</a></li>` : ''}
              ${contact.hours ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-clock"></i><span>${contact.hours}</span></li>` : ''}
            </ul>
            <div class="mt-4">
              <form id="footer-newsletter" class="flex gap-2">
                <input type="email" name="email" placeholder="Votre email" class="flex-1 px-3 py-2 bg-white/10 border border-white/20 rounded text-white text-sm placeholder-white/50 focus:outline-none focus:border-white/40">
                <button type="submit" class="px-4 py-2 bg-white text-red-600 rounded text-sm font-semibold hover:bg-gray-100 transition"><i class="fas fa-paper-plane"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
          <p class="text-white/50 text-xs">&copy; ${new Date().getFullYear()} ACONOQ. Tous droits réservés.</p>
          <div class="flex gap-4">
            ${(val.legal || []).map(l => `<a href="${l.url}" class="text-white/50 text-xs hover:text-white transition">${l.label}</a>`).join('')}
          </div>
        </div>
      </div>
    `;

    const footerNl = document.getElementById('footer-newsletter');
    if (footerNl) {
      footerNl.addEventListener('submit', async (e) => {
        e.preventDefault();
        const emailInput = footerNl.querySelector('[name="email"]');
        const email = emailInput ? emailInput.value.trim() : '';
        if (!email) return;
        const btn = footerNl.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        btn.disabled = true;
        try {
          const { error: insErr } = await supabaseClient
            .from('newsletter_subscribers')
            .insert([{ email }]);
          if (insErr) throw insErr;
          btn.innerHTML = '<i class="fas fa-check"></i>';
          emailInput.value = '';
          setTimeout(() => { btn.innerHTML = '<i class="fas fa-paper-plane"></i>'; btn.disabled = false; }, 3000);
        } catch (err) {
          console.error('Erreur newsletter footer:', err);
          btn.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
          setTimeout(() => { btn.innerHTML = '<i class="fas fa-paper-plane"></i>'; btn.disabled = false; }, 3000);
        }
      });
    }
  } catch (err) {
    console.error('Erreur chargement footer:', err);
  }
}

// ============================================
// FORMULAIRES
// ============================================
function initFormulaires() {
  const newsletterForm = document.getElementById('newsletter-form');
  const contactForm = document.getElementById('contact-form');

  if (newsletterForm) {
    newsletterForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const emailInput = newsletterForm.querySelector('[name="email"]');
      const nomInput = newsletterForm.querySelector('[name="nom"]');
      const email = emailInput ? emailInput.value.trim() : '';
      const nom = nomInput ? nomInput.value.trim() : email.split('@')[0];
      const btn = newsletterForm.querySelector('button[type="submit"]');
      const origText = btn.innerHTML;

      if (!email) return;

      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription...';
      btn.disabled = true;

      try {
        const { error } = await supabaseClient
          .from('newsletter_subscribers')
          .insert([{ nom, email }]);

        if (error) throw error;

        btn.innerHTML = '<i class="fas fa-check"></i> Inscrit !';
        btn.classList.add('bg-green-600');
        btn.classList.remove('bg-white', 'text-red-600');
        newsletterForm.reset();

        setTimeout(() => {
          btn.innerHTML = origText;
          btn.classList.remove('bg-green-600');
          btn.classList.add('bg-white', 'text-red-600');
          btn.disabled = false;
        }, 3000);
      } catch (err) {
        console.error('Erreur newsletter:', err);
        btn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Erreur';
        btn.classList.add('bg-red-600');
        btn.classList.remove('bg-white', 'text-red-600');

        setTimeout(() => {
          btn.innerHTML = origText;
          btn.classList.remove('bg-red-600');
          btn.classList.add('bg-white', 'text-red-600');
          btn.disabled = false;
        }, 3000);
      }
    });
  }

  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const nom = contactForm.querySelector('[name="nom"]').value.trim();
      const email = contactForm.querySelector('[name="email"]').value.trim();
      const sujet = contactForm.querySelector('[name="sujet"]').value.trim();
      const message = contactForm.querySelector('[name="message"]').value.trim();
      const btn = contactForm.querySelector('button[type="submit"]');
      const origText = btn.innerHTML;

      if (!nom || !email || !sujet || !message) return;

      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';
      btn.disabled = true;

      try {
        const { error } = await supabaseClient
          .from('contact_messages')
          .insert([{ nom, email, sujet, message }]);

        if (error) throw error;

        btn.innerHTML = '<i class="fas fa-check"></i> Envoy\u00e9 !';
        btn.classList.add('bg-green-600');
        btn.classList.remove('bg-primary');
        contactForm.reset();

        setTimeout(() => {
          btn.innerHTML = origText;
          btn.classList.remove('bg-green-600');
          btn.classList.add('bg-primary');
          btn.disabled = false;
        }, 3000);
      } catch (err) {
        console.error('Erreur contact:', err);
        btn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Erreur';
        btn.classList.add('bg-red-600');
        btn.classList.remove('bg-primary');

        setTimeout(() => {
          btn.innerHTML = origText;
          btn.classList.remove('bg-red-600');
          btn.classList.add('bg-primary');
          btn.disabled = false;
        }, 3000);
      }
    });
  }
}

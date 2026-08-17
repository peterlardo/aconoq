// ============================================
// ACONOQ - Application Logic
// ============================================

function getPageSlug() {
  const path = window.location.pathname;
  const file = path.split('/').pop() || 'index.php';
  return file.replace('.php', '').replace('.html', '');
}

function safe(v) { return v != null ? v : ''; }
function safeStr(v) { return v != null ? String(v) : ''; }
function fixUrl(u) { return safeStr(u).replace(/\.html/g, '.php'); }

document.addEventListener('DOMContentLoaded', () => {
  const slug = getPageSlug();
  loadChiffresCles();
  loadDirections();
  loadNormes();
  loadEvenements();
  loadEvenementsGallery();
  loadPartenaires();
  loadActualites();
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
        <div class="chiffre-icon mx-auto mb-2">
          <i class="${safeStr(item.icone)}"></i>
        </div>
        <div class="chiffre-value font-serif text-xl lg:text-2xl font-bold text-white mb-0.5" data-target="${safeStr(item.valeur)}">
          0
        </div>
        <p class="text-white/80 text-xs font-medium">${safeStr(item.label)}</p>
        <p class="text-white/50 text-[10px] mt-0.5">${safeStr(item.description)}</p>
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

    container.innerHTML = data.map(item => {
      const url = (item.url || '#').replace(/\.html/g, '.php');
      return `<a href="${url}" class="block px-4 py-2 text-xs text-gray-600 hover:bg-primary-light hover:text-primary transition">${safeStr(item.nom)}</a>`;
    }).join('');
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

function normeIllustration(categorie) {
  const images = {
    'Qualité':'https://images.pexels.com/photos/3861958/pexels-photo-3861958.jpeg?auto=compress&cs=tinysrgb&w=900',
    'Environnement':'https://images.pexels.com/photos/3305/garden-apple-tree-countryside.jpg?auto=compress&cs=tinysrgb&w=900',
    'Santé et sécurité':'https://images.pexels.com/photos/3768131/pexels-photo-3768131.jpeg?auto=compress&cs=tinysrgb&w=900',
    'Agroalimentaire':'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=900',
    'Sécurité de l’information':'https://images.pexels.com/photos/60504/security-protection-anti-virus-software-60504.jpeg?auto=compress&cs=tinysrgb&w=900',
    'Métrologie':'https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg?auto=compress&cs=tinysrgb&w=900'
  };
  return images[categorie] || 'https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=900';
}

let normesPage = 1;
const normesPageSize = 4;

function renderNormesPagination(totalPages) {
  const el = document.getElementById('normes-pagination');
  if (!el || totalPages <= 1) { if (el) el.innerHTML = ''; return; }
  let html = `<button data-norme-page="prev" ${normesPage === 1 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i></button>`;
  for (let i = 1; i <= totalPages; i++) html += `<button data-norme-page="${i}" class="${i === normesPage ? 'is-active' : ''}">${i}</button>`;
  html += `<button data-norme-page="next" ${normesPage === totalPages ? 'disabled' : ''}><i class="fas fa-chevron-right"></i></button>`;
  el.innerHTML = html;
}
function renderNormes(normes) {
  const container = document.getElementById('normes-grid');
  const countEl = document.getElementById('normes-count');
  if (countEl) countEl.textContent = normes.length;
  if (normes.length === 0) {
    container.innerHTML = '<p class="text-gray-text text-center col-span-4">Aucune norme ne correspond à votre recherche.</p>';
    return;
  }
  const totalPages = Math.max(1, Math.ceil(normes.length / normesPageSize));
  if (normesPage > totalPages) normesPage = totalPages;
  const pageRows = normes.slice((normesPage - 1) * normesPageSize, normesPage * normesPageSize);
  renderNormesPagination(totalPages);
  container.innerHTML = pageRows.map(item => `
    <article class="home-norme-card">
      <div class="home-norme-cover"><img src="${normeIllustration(item.categorie)}" alt="Illustration ${safeStr(item.categorie)}" loading="lazy"><span>${safeStr(item.origine || 'Nationale')}</span></div>
      <div class="home-norme-body">
        <small>${safeStr(item.categorie || 'Norme')}</small>
        <h3>${safeStr(item.code)}</h3>
        <p class="home-norme-title">${safeStr(item.titre)}</p>
        <p class="home-norme-description">${safeStr(item.description || 'Référence disponible dans le catalogue ACONOQ.')}</p>
        <div class="home-norme-actions"><a href="norme.php?code=${encodeURIComponent(item.code)}">Détails <i class="fas fa-arrow-right"></i></a><a href="boutique.php" class="home-norme-buy">Acheter</a></div>
      </div>
    </article>
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

  const pagination = document.getElementById('normes-pagination');
  if (pagination && !pagination.dataset.bound) {
    pagination.dataset.bound = 'true';
    pagination.addEventListener('click', e => {
      const button = e.target.closest('[data-norme-page]');
      if (!button) return;
      const total = Math.max(1, Math.ceil((window._normesData || []).length / normesPageSize));
      if (button.dataset.normePage === 'prev') normesPage = Math.max(1, normesPage - 1);
      else if (button.dataset.normePage === 'next') normesPage = Math.min(total, normesPage + 1);
      else normesPage = Number(button.dataset.normePage);
      applyFilters();
      window.scrollTo({top: document.getElementById('normes-grid').offsetTop - 120, behavior: 'smooth'});
    });
  }
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
    if (!data || data.length === 0) {
      container.innerHTML = '<p class="text-gray-text text-center col-span-4">Aucun événement à venir pour le moment.</p>';
      return;
    }

    const typeColors = {
      formation: { bg: 'bg-blue-100', text: 'text-blue-700', label: 'Formation' },
      salon: { bg: 'bg-purple-100', text: 'text-purple-700', label: 'Salon' },
      evenement: { bg: 'bg-green-100', text: 'text-green-700', label: 'Événement' }
    };

    container.innerHTML = data.map(item => {
      const type = typeColors[item.type_event] || typeColors.evenement;
      const dateStart = new Date(item.date_debut);
      const day = dateStart.toLocaleDateString('fr-FR', { day: '2-digit' });
      const month = dateStart.toLocaleDateString('fr-FR', { month: 'short' });
      const year = dateStart.getFullYear();
      return `
        <a href="evenement.php?id=${encodeURIComponent(item.id)}" class="feature-card group block">
          ${item.image_url ? `<div class="overflow-hidden rounded-lg mb-4"><img src="${item.image_url}" alt="${safeStr(item.titre)}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-500"></div>` : `<div class="overflow-hidden rounded-lg mb-4 bg-gradient-to-br from-[rgba(15,113,64,0.1)] to-[rgba(15,113,64,0.05)] h-44 flex items-center justify-center"><i class="fas fa-calendar-alt text-[#0f7140] text-3xl opacity-30"></i></div>`}
          <div class="flex items-start gap-4">
            <div class="text-center flex-shrink-0 bg-primary-light rounded-xl px-3 py-2"><div class="text-2xl font-bold text-primary leading-none">${day}</div><div class="text-xs text-primary uppercase font-medium">${month}</div><div class="text-[10px] text-gray-text">${year}</div></div>
            <div class="flex-1 min-w-0"><span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full ${type.bg} ${type.text} mb-2">${type.label}</span><h3 class="font-semibold text-sm text-dark mb-1 line-clamp-2">${safeStr(item.titre)}</h3><p class="text-gray-text text-xs leading-relaxed mb-2 line-clamp-2">${safeStr(item.description)}</p><div class="flex items-center gap-3 text-[11px] text-gray-text"><span><i class="fas fa-map-marker-alt mr-1"></i>${safeStr(item.lieu) || 'Non précisé'}</span></div><span class="text-primary text-xs font-semibold inline-flex items-center gap-2 mt-3">Voir l’événement <i class="fas fa-arrow-right"></i></span></div>
          </div>
        </a>`;
    }).join('');
  } catch (err) {
    console.error('Erreur chargement événements:', err);
  }
}
// ============================================

async function loadEvenementsGallery() {
  const container = document.getElementById('events-gallery-grid');
  if (!container) return;
  const fallbackImages = ['https://images.pexels.com/photos/3184436/pexels-photo-3184436.jpeg?auto=compress&cs=tinysrgb&w=1200','https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=900','https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=900','https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=900','https://images.pexels.com/photos/1181396/pexels-photo-1181396.jpeg?auto=compress&cs=tinysrgb&w=900'];
  try {
    const { data, error } = await supabaseClient.from('evenements').select('id,titre,date_debut,image_url').order('date_debut', { ascending: false }).limit(5);
    if (error) throw error;
    if (!data || !data.length) { container.innerHTML = '<div class="events-gallery-empty">Les photos de nos événements seront bientôt disponibles.</div>'; return; }

    const items = data.map((item, index) => ({
      ...item,
      image: item.image_url || fallbackImages[index % fallbackImages.length],
      date: item.date_debut ? new Date(item.date_debut).toLocaleDateString('fr-FR', { month: 'long', year: 'numeric' }) : 'ACONOQ'
    }));

    // First card becomes a carousel of all event images
    const first = items[0];
    const carouselSlides = items.map((it, i) =>
      `<div class="egc-slide${i === 0 ? ' active' : ''}" data-index="${i}">
        <img src="${it.image}" alt="${safeStr(it.titre)}" loading="${i === 0 ? 'eager' : 'lazy'}">
        <span class="events-gallery-caption"><small>${it.date}</small><strong>${safeStr(it.titre)}</strong></span>
      </div>`
    ).join('');
    const carouselDots = items.map((_, i) =>
      `<button class="egc-dot${i === 0 ? ' active' : ''}" data-index="${i}"></button>`
    ).join('');

    const carouselCard = `
      <div class="events-gallery-card events-gallery-carousel" id="eventsGalleryCarousel">
        <div class="egc-slides">${carouselSlides}</div>
        <button class="egc-arrow egc-prev" aria-label="Précédent"><i class="fas fa-chevron-left"></i></button>
        <button class="egc-arrow egc-next" aria-label="Suivant"><i class="fas fa-chevron-right"></i></button>
        <div class="egc-dots">${carouselDots}</div>
      </div>`;

    // Remaining cards (index 1..N)
    const otherCards = items.slice(1).map(it =>
      `<a href="evenement.php?id=${encodeURIComponent(it.id)}" class="events-gallery-card">
        <img src="${it.image}" alt="${safeStr(it.titre)}" loading="lazy">
        <span class="events-gallery-caption"><small>${it.date}</small><strong>${safeStr(it.titre)}</strong></span>
      </a>`
    ).join('');

    container.innerHTML = carouselCard + otherCards;

    // Initialize carousel logic
    initEventsGalleryCarousel();
  } catch (err) { console.error('Erreur galerie événements:', err); container.innerHTML = '<div class="events-gallery-empty">Les photos de nos événements seront bientôt disponibles.</div>'; }
}

function initEventsGalleryCarousel() {
  const wrapper = document.getElementById('eventsGalleryCarousel');
  if (!wrapper) return;
  const slides = wrapper.querySelectorAll('.egc-slide');
  const dots = wrapper.querySelectorAll('.egc-dot');
  const total = slides.length;
  if (total <= 1) return;
  let current = 0;
  let autoplayTimer;

  function goTo(idx) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (idx + total) % total;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
  }

  function resetAutoplay() {
    clearInterval(autoplayTimer);
    autoplayTimer = setInterval(() => goTo(current + 1), 4000);
  }

  wrapper.querySelector('.egc-prev').addEventListener('click', () => { goTo(current - 1); resetAutoplay(); });
  wrapper.querySelector('.egc-next').addEventListener('click', () => { goTo(current + 1); resetAutoplay(); });
  dots.forEach(d => d.addEventListener('click', () => { goTo(parseInt(d.dataset.index)); resetAutoplay(); }));

  resetAutoplay();
}
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
    const badgeEl = heroEl.querySelector('.hero-badge');
    if (badgeEl && data.badge) badgeEl.textContent = data.badge;
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

    const bgAltern = ['acq-section--cream', 'acq-section--white'];
    sectionsContainer.innerHTML = sections.map((s, i) => {
      const bg = bgAltern[i % 2];
      const inner = renderPageSection(s, groupedGrids);
      return `<section id="${safeStr(s.section_key)}" class="acq-section ${bg}"><div class="acq-container">${inner}</div></section>`;
    }).join('');
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
  const iconHtml = '';
  const titleText = section.title || '';
  const headingTag = titleText === "Qu'est-ce que la normalisation ?" ? 'h4' : 'h3';
  const headingSize = headingTag === 'h4' ? 'text-xl lg:text-2xl' : 'text-2xl lg:text-3xl';
  html += `<${headingTag} class="font-serif ${headingSize} font-bold text-dark mb-6">${iconHtml}${titleText}</${headingTag}>`;

  // Render grouped card_grids for this section
  const sectionKey = section.section_key;
  if (sectionKey && groupedGrids[sectionKey]) {
    const cards = groupedGrids[sectionKey];
    html += '<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">';
    html += cards.map(card => {
      const colorClass = card.card_color === 'red' ? 'bg-red-50 text-red-600' : 'bg-primary-light text-primary';
      const link = fixUrl(card.card_link || '');
      const wrapOpen = link ? `<a href="${link}" class="feature-card" style="text-decoration:none;display:block">` : '<div class="feature-card">';
      const wrapClose = link ? '</a>' : '</div>';
      return `
        ${wrapOpen}
          ${card.card_number ? `<div class="text-3xl font-bold text-primary/15 mb-2">${card.card_number}</div>` : ''}
          ${card.card_icon ? `<span class="feature-icon ${colorClass}"><i class="${safeStr(card.card_icon)}"></i></span>` : ''}
          <h3 class="font-semibold text-base text-dark mb-2">${safeStr(card.card_title)}</h3>
          <p class="text-gray-text text-sm leading-relaxed">${safeStr(card.card_description)}</p>
        ${wrapClose}
      `;
    }).join('');
    html += '</div>';
  }

  if (c.paragraphs && Array.isArray(c.paragraphs)) {
    html += c.paragraphs.map(p => `<p class="text-gray-text text-base leading-relaxed mb-4">${safeStr(p)}</p>`).join('');
  }

  if (c.description) {
    html += `<p class="text-gray-text text-base leading-relaxed mb-6">${safeStr(c.description)}</p>`;
  }

  if (c.list_title) {
    html += `<h3 class="font-semibold text-lg text-dark mb-3 mt-6">${safeStr(c.list_title)}</h3>`;
  }

  if (c.list_items && Array.isArray(c.list_items)) {
    html += '<div class="mb-6">';
    html += c.list_items.map((item, i) => `
      <div class="flex items-start gap-3 mb-2">
        <i class="fas fa-check-circle text-primary mt-1 flex-shrink-0" style="font-size:13px"></i>
        <p class="text-gray-text text-base leading-relaxed font-semibold">${safeStr(item)}</p>
      </div>
    `).join('');
    html += '</div>';
  }

  if (c.items && Array.isArray(c.items)) {
    html += '<div class="mb-6">';
    html += c.items.map(item => `
      <div class="flex items-start gap-3 mb-2">
        <i class="fas fa-check-circle text-primary mt-1 flex-shrink-0" style="font-size:13px"></i>
        <p class="text-gray-text text-base leading-relaxed font-semibold">${safeStr(item)}</p>
      </div>
    `).join('');
    html += '</div>';
  }

  if (c.services && Array.isArray(c.services)) {
    html += '<div class="grid sm:grid-cols-3 gap-6 mt-6">';
    html += c.services.map(s => `
      <div class="bg-gray-50 rounded-xl p-5 text-center">
        <i class="${safeStr(s.icon)} text-primary text-2xl mb-3"></i>
        <p class="font-semibold text-sm text-dark">${safeStr(s.name)}</p>
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
          <span class="feature-icon ${colorClass}"><i class="${safeStr(card.icon)}"></i></span>
          <h3 class="font-semibold text-base text-dark mb-2">${safeStr(card.title)}</h3>
          <p class="text-gray-text text-sm leading-relaxed">${safeStr(card.description)}</p>
        </div>
      `;
    }).join('');
    html += '</div>';
  }

  if (c.highlight) {
    html += `<div class="bg-primary-light border-l-4 border-primary rounded-r-xl p-5 mt-6">
      <p class="text-primary text-sm font-medium"><i class="fas fa-star mr-2"></i>${safeStr(c.highlight)}</p>
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
          ${photo ? `<div class="rounded-2xl overflow-hidden shadow-2xl"><img src="${photo}" alt="${safeStr(name)}" class="w-full h-[460px] object-cover director-photo"></div>` : ''}
        </div>
        <div>
          <p class="text-primary text-xs font-semibold tracking-widest uppercase mb-3">${section.badge || 'Message officiel'}</p>
          <h2 class="font-serif text-3xl lg:text-4xl font-bold text-dark mb-6"><strong>${safeStr(name)}</strong></h2>
          <p class="text-gray-text text-sm mb-4 italic">${safeStr(role)}</p>
          ${paragraphs.map(p => `<p class="text-gray-text text-base leading-relaxed mb-4">${safeStr(p)}</p>`).join('')}
          <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="font-bold text-dark">${safeStr(sigName)}</p>
            <p class="text-gray-text text-sm">${safeStr(sigTitle)}</p>
            <p class="text-gray-text text-xs">${safeStr(sigOrg)}</p>
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

    const seen = new Set();
    const unique = data.filter(item => {
      if (seen.has(item.title)) return false;
      seen.add(item.title);
      return true;
    });

    container.innerHTML = unique.map(item => `
      <div class="feature-card">
        <span class="feature-icon"><i class="${safeStr(item.icon_class)}" style="font-size:22px"></i></span>
        <h3>${safeStr(item.title)}</h3>
        <p>${safeStr(item.description)}</p>
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
  const heroContainer = document.getElementById('heroTextContainer');
  if (!carousel) return;

  try {
    const { data: dbSlides, error } = await supabaseClient
      .from('hero_slides')
      .select('*')
      .eq('active', true)
      .order('ordre', { ascending: true });

    const slides = [...(dbSlides || [])];

    slides.push({
      image_url: 'images/pcec.jpg',
      badge: '',
      title: 'Le PCEC',
      subtitle: 'Programme national d\'evaluation de la conformite des produits importes au Congo.',
      cta1_label: 'Decouvrir le PCEC',
      cta1_url: 'pcec.php',
      cta2_label: 'Nos Programmes',
      cta2_url: '#programmes'
    });

    carousel.innerHTML = slides.map((s, i) =>
      `<div class="hero-slide ${i === 0 ? 'active' : ''}" style="background-image: url('${s.image_url}')"></div>`
    ).join('');

    const dotsContainer = document.getElementById('carouselDots');
    if (dotsContainer) {
      dotsContainer.innerHTML = slides.map((_, i) =>
        `<button class="carousel-dot ${i === 0 ? 'active' : ''}" onclick="goToSlide(${i})"></button>`
      ).join('');
    }

    if (heroContainer) {
      heroContainer.innerHTML = slides.map((s, i) => {
        const badge = s.badge || '';
        const title = s.title || '';
        const subtitle = s.subtitle || '';
        const cta1Label = s.cta1_label || '';
        const cta1Url = s.cta1_url || '#';
        const cta2Label = s.cta2_label || '';
        const cta2Url = s.cta2_url || '#';

        return `
          <div class="hero-text-group ${i === 0 ? 'active' : ''}" data-slide-index="${i}">
            <div class="max-w-xl">
              ${badge ? `<div class="hero-badge-anim inline-block mb-4 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase" style="background:rgba(245,201,8,0.15); color:#f5c908; border:1px solid rgba(245,201,8,0.3);">${badge}</div>` : ''}
              ${title ? `<h1 class="hero-title-anim text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6" style="letter-spacing:-0.03em">${title}</h1>` : ''}
              ${subtitle ? `<p class="hero-subtitle-anim text-white/75 text-base leading-relaxed mb-8 max-w-md">${subtitle}</p>` : ''}
              ${(cta1Label || cta2Label) ? `
                <div class="hero-cta-anim flex flex-wrap gap-4">
                  ${cta1Label ? `<a href="${cta1Url}" class="hero-btn-primary group" style="border-radius:30px; padding: 4px 4px 4px 24px;"><span class="hero-btn-label" style="background:#fff; color:#0f7140; padding:10px 20px; border-radius:30px; font-weight:600;">${cta1Label}</span></a>` : ''}
                  ${cta2Label ? `<a href="${cta2Url}" class="hero-btn-outline" style="border-color:rgba(255,255,255,0.4); color:#fff; border-radius:30px; padding:12px 28px; font-size:14px; font-weight:600; display:inline-flex; align-items:center; text-decoration:none;">${cta2Label}</a>` : ''}
                </div>
              ` : ''}
            </div>
          </div>`;
      }).join('');
    }

    window._heroSlides = slides;
    window._heroTotal = slides.length;

    if (typeof initCarousel === 'function') initCarousel();
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

    const filtered = data.filter(b => b.badge !== 'Boutique en ligne' && b.badge !== 'PCEC');
    if (filtered.length === 0) { container.remove(); return; }

    container.innerHTML = filtered.map(b => `
      <section class="relative h-[400px] lg:h-[480px] overflow-hidden mb-8">
        <img src="${b.image_url || ''}" alt="${safeStr(b.title)}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-primary/50 to-transparent"></div>
        <div class="absolute inset-0 flex items-center">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-xl text-white">
              <span class="text-white/80 text-xs font-semibold tracking-widest uppercase">${safeStr(b.badge)}</span>
              <h2 class="font-serif text-3xl lg:text-5xl font-black mt-3 mb-4">${safeStr(b.title)}</h2>
              <p class="text-white/80 text-base leading-relaxed mb-6">${safeStr(b.description)}</p>
              <a href="${b.cta1_url || '#'}" class="inline-flex items-center gap-2 bg-white text-primary px-6 py-3 rounded text-sm font-semibold hover:bg-gray-100 transition">
                ${safeStr(b.cta1_label)} <i class="fas fa-arrow-right text-xs"></i>
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
function processLink(item) {
  if (item.link_url && item.link_url !== '#') return item.link_url;
  const title = safeStr(item.title).toLowerCase();
  if (title.includes('certification')) return 'processus.php?type=certification';
  if (title.includes('obligatoire')) return 'processus.php?type=normes-obligatoires';
  if (title.includes('formation')) return 'processus.php?type=formations';
  if (title.includes('audit') || title.includes('contrôle')) return 'processus.php?type=audit-controle';
  return 'processus.php?type=normes';
}
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
          <span class="feature-icon"><i class="${safeStr(item.icon_class)}" style="font-size:22px"></i></span>
          <h3>${safeStr(item.title)}</h3>
          <p>${safeStr(item.description)}</p>
          <a href="${processLink(item)}" class="link-more link-more-red mt-4"><span class="link-more-inner">En savoir plus</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
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
          <span class="feature-icon"><i class="${safeStr(item.icon_class)}"></i></span>
          <div>
            <h3 class="font-semibold text-base text-dark mb-1">${safeStr(item.title)}</h3>
            ${item.link ? `<a href="${item.link}" class="text-primary text-sm hover:underline">${safeStr(item.value)}</a>` : `<p class="text-gray-text text-sm">${safeStr(item.value)}</p>`}
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
            <i class="${safeStr(item.icon_class)} text-primary mt-1"></i>
            <h3 class="font-semibold text-sm text-dark">${safeStr(item.question)}</h3>
          </div>
          <p class="text-gray-text text-sm leading-relaxed ml-9">${safeStr(item.answer)}</p>
        </div>
      `).join('');
    }

    if (advContainer && advRes.data && advRes.data.length) {
      advContainer.innerHTML = advRes.data.map(item => `
        <div class="flex items-start gap-3 mb-4">
          <div class="w-10 h-10 bg-primary-light rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="${safeStr(item.icon_class)} text-primary"></i>
          </div>
          <div>
            <h4 class="font-semibold text-sm text-dark">${safeStr(item.title)}</h4>
            <p class="text-gray-text text-xs leading-relaxed">${safeStr(item.description)}</p>
          </div>
        </div>
      `).join('');
    }

    if (hiwContainer && hiwRes.data && hiwRes.data.length) {
      hiwContainer.innerHTML = hiwRes.data.map(item => `
        <div class="text-center">
          <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white font-bold text-xl">${safeStr(item.step_number)}</span>
          </div>
          <h4 class="font-semibold text-sm text-dark mb-2">${safeStr(item.title)}</h4>
          <p class="text-gray-text text-xs leading-relaxed">${safeStr(item.description)}</p>
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
      <h3 class="font-semibold text-lg text-dark mb-2">${safeStr(data.title)}</h3>
      <p class="text-gray-text text-sm mb-4">${safeStr(data.intro_text)}</p>
      <div class="grid sm:grid-cols-2 gap-2">
        ${items.map((item, i) => `
          <div class="flex items-start gap-2 bg-gray-50 rounded-lg p-3">
            <span class="flex-shrink-0 w-6 h-6 bg-primary/10 text-primary rounded-full flex items-center justify-center text-xs font-bold">${i + 1}</span>
            <p class="text-gray-text text-sm">${safeStr(item)}</p>
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
        <div class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold">${safeStr(step.step_number)}</div>
        <div>
          <h4 class="font-semibold text-sm text-dark">${safeStr(step.title)}</h4>
          <p class="text-gray-text text-sm">${safeStr(step.description)}</p>
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

    const fallbackLogos = {
      'COTECNA': 'https://cdn.brandfetch.io/id11m9B62s/w/400/h/400/theme/dark/icon.jpeg?c=1bxid64Mup7aczewSAYMX',
      'TÜV': 'https://static.cdnlogo.com/logos/t/90/tuv-rheinland.svg',
      'Bureau Veritas': 'https://companieslogo.com/img/orig/BVI.PA_BIG-ce76bf51.png',
      'ARSO': 'https://latestlogo.com/wp-content/uploads/2024/08/arso.png'
    };
    const items = data.map(p => {
      const imgUrl = p.logo_url || fallbackLogos[p.nom] || '';
      const logoHtml = imgUrl
        ? `<img src="${imgUrl}" alt="${safeStr(p.nom)}" class="h-12 object-contain">`
        : `<span class="text-xl font-black tracking-tight">${safeStr(p.nom)}</span>`;
      return `
      <a href="${p.site_web || '#'}" target="_blank" rel="noopener" class="partenaire-item flex-shrink-0 flex items-center justify-center gap-3 px-10 py-6 bg-white rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-lg transition-all duration-300 group min-w-[200px]" title="${safeStr(p.description)}">
        ${logoHtml}
      </a>`;
    }).join('');

    container.innerHTML = items;
  } catch (err) {
    console.error('Erreur chargement partenaires:', err);
  }
}

// ============================================
// 16. ACTUALITES
// ============================================
// ============================================
// 17. DYNAMIC ACTUALITÉS (with pagination)
// ============================================
let actualitesPage = 0;
const ACTUALITES_PER_PAGE = 4;

async function loadActualites() {
  actualitesPage = 0;
  await fetchActualites();
}

async function fetchActualites() {
  const container = document.getElementById('dynamic-actualites');
  if (!container) return;

  const from = actualitesPage * ACTUALITES_PER_PAGE;
  const to = from + ACTUALITES_PER_PAGE - 1;

  try {
    const result = await supabaseClient
      .from('actualites')
      .select('*')
      .order('date_pub', { ascending: false })
      .range(from, to);

    const data = result.data;
    const error = result.error;

    if (error) {
      console.error('Erreur chargement actualités:', error);
      container.innerHTML = '<p class="text-red-500 text-sm text-center col-span-full">Erreur de chargement des actualités. Veuillez réessayer plus tard.</p>';
      return;
    }

    if (actualitesPage === 0 && (!data || data.length === 0)) {
      container.innerHTML = '<p class="text-gray-text text-center col-span-full">Aucune actualité pour le moment.</p>';
      return;
    }

    const cards = (data || []).map(item => `
      <a href="actualite.php?id=${encodeURIComponent(item.id)}" class="feature-card group block">
        <div class="overflow-hidden rounded-lg mb-4">
          <img src="${item.image_url || ''}" alt="${safeStr(item.titre)}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
        </div>
        <h3 class="font-semibold text-sm text-dark mb-1">${safeStr(item.titre)}</h3>
        <span class="text-[11px] text-gray-text"><i class="far fa-calendar mr-1"></i>${item.date_pub ? new Date(item.date_pub).toLocaleDateString('fr-FR') : ''}</span>
        <span class="text-primary text-sm font-medium inline-flex items-center gap-2 hover:gap-3 transition-all mt-3">Lire la suite <i class="fas fa-arrow-right text-xs"></i></span>
      </a>
    `).join('');

    if (actualitesPage === 0) {
      container.innerHTML = cards;
    } else {
      container.insertAdjacentHTML('beforeend', cards);
    }

    const existingBtn = document.getElementById('actualites-load-more');
    if (existingBtn) existingBtn.remove();

    if (data && data.length === ACTUALITES_PER_PAGE) {
      actualitesPage++;
      const btnWrap = document.createElement('div');
      btnWrap.id = 'actualites-load-more';
      btnWrap.className = 'col-span-full text-center mt-8';
      btnWrap.innerHTML = '<button onclick="fetchActualites()" class="inline-flex items-center gap-2 text-primary text-sm font-semibold border-2 border-primary rounded-full px-6 py-2.5 hover:bg-primary hover:text-white transition-all duration-300">Voir plus d\'actualités <i class="fas fa-arrow-right"></i></button>';
      container.parentElement.appendChild(btnWrap);
    }
  } catch (err) {
    console.error('Erreur chargement actualités:', err);
    container.innerHTML = '<p class="text-red-500 text-sm text-center col-span-full">Erreur de connexion. Vérifiez votre connexion internet.</p>';
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
    const columns = val.columns || [];
    const contact = val.contact || {};
    const socialLinks = val.social_links || [];
    const brandDesc = val.brand_description || val.description || '';
    const logoUrl = val.logo_url || val.logo || 'aconoq_logo.png';
    const legal = (val.legal || []).map(l => {
      if (l.label && l.label.toLowerCase().includes('confidentialit') && (!l.url || l.url === '#')) l.url = 'politique-confidentialite.php';
      return l;
    });
    const copyrightText = val.copyright || '';

    const aconoqLinks = [...(columns[0] ? columns[0].links || [] : []), {label:'Documents utiles',url:'documents.php'}, {label:'Demander un devis',url:'devis.php'}, {label:'Politique RGPD',url:'politique-confidentialite.php'}];
    const dirLinks = columns[1] ? columns[1].links || [] : [];
    const servLinks = columns[2] ? columns[2].links || [] : [];

    container.innerHTML = `
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative overflow-hidden">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 relative z-10">
          <div class="col-span-2 md:col-span-1">
            <a href="index.php" class="flex items-center gap-2 mb-4">
              <img src="${logoUrl}" alt="ACONOQ" class="h-10" style="background: transparent;">
            </a>
            <p class="text-white/70 text-sm leading-relaxed mb-4">${safeStr(brandDesc)}</p>
            <div class="flex gap-3">
              ${socialLinks.map(s => `<a href="${safeStr(s.url)}" target="_blank" rel="noopener" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition"><i class="${safeStr(s.icon)} text-white text-sm"></i></a>`).join('')}
            </div>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">${safeStr(columns[0] ? columns[0].title : 'ACONOQ')}</h4>
            <ul class="space-y-2">
              ${aconoqLinks.map(l => `<li><a href="${fixUrl(l.url)}" class="text-white/70 text-sm hover:text-white transition">${safeStr(l.label)}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">${safeStr(columns[1] ? columns[1].title : 'Directions')}</h4>
            <ul class="space-y-2">
              ${dirLinks.map(l => `<li><a href="${fixUrl(l.url)}" class="text-white/70 text-sm hover:text-white transition">${safeStr(l.label)}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">${safeStr(columns[2] ? columns[2].title : 'Services')}</h4>
            <ul class="space-y-2">
              ${servLinks.map(l => `<li><a href="${fixUrl(l.url)}" class="text-white/70 text-sm hover:text-white transition">${safeStr(l.label)}</a></li>`).join('')}
            </ul>
          </div>
          <div>
            <h4 class="text-white font-semibold mb-4">Contact</h4>
            <ul class="space-y-3">
              ${contact.address ? `<li class="flex items-start gap-2 text-white/70 text-sm"><i class="fas fa-map-marker-alt mt-1"></i><span>${safeStr(contact.address)}</span></li>` : ''}
              ${contact.phone ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-phone"></i><a href="tel:${safeStr(contact.phone)}" class="hover:text-white transition">${safeStr(contact.phone)}</a></li>` : ''}
              ${contact.email ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-envelope"></i><a href="mailto:${safeStr(contact.email)}" class="hover:text-white transition">${safeStr(contact.email)}</a></li>` : ''}
              ${contact.hours ? `<li class="flex items-center gap-2 text-white/70 text-sm"><i class="fas fa-clock"></i><span>${safeStr(contact.hours)}</span></li>` : ''}
            </ul>
            <h4 class="text-white font-semibold mb-3 mt-6">Newsletter</h4>
            <p class="text-white/70 text-sm mb-3">Restez informé de nos actualités et événements.</p>
            <form id="footer-newsletter" class="flex flex-col gap-2">
              <input type="email" name="email" placeholder="Votre email" class="w-full px-4 py-2.5 bg-white border border-white/20 rounded-lg text-gray-800 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/40">
              <button type="submit" class="px-5 py-2.5 bg-white text-red-600 rounded-lg text-sm font-semibold hover:bg-gray-100 transition"><i class="fas fa-paper-plane"></i> S'abonner</button>
            </form>
          </div>
        </div>
      </div>
      <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
          <p class="text-white/50 text-xs">&copy; ${new Date().getFullYear()} ACONOQ. Tous droits r&eacute;serv&eacute;s.</p>
          <div class="flex gap-4">
            ${legal.map(l => `<a href="${fixUrl(l.url)}" class="text-white/50 text-xs hover:text-white transition">${safeStr(l.label)}</a>`).join('')}
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

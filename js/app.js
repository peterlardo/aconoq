// ============================================
// ACONOQ - Application Logic
// ============================================

document.addEventListener('DOMContentLoaded', () => {
  loadChiffresCles();
  loadDirecteur();
  loadDirections();
  loadNormes();
  loadEvenements();
  loadPartenaires();
  initFormulaires();
});

// ============================================
// 1. CHIFFRES CLÉS
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
    console.error('Erreur chargement chiffres clés:', err);
    container.innerHTML = '<p class="text-white/50 text-center col-span-4">Données temporairement indisponibles</p>';
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
// 2. MOT DU DIRECTEUR
// ============================================
async function loadDirecteur() {
  const container = document.getElementById('directeur-content');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('directeur')
      .select('*')
      .limit(1)
      .single();

    if (error) throw error;

    container.innerHTML = `
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="relative">
          <div class="rounded-2xl overflow-hidden shadow-2xl">
            <img src="${data.photo_url || 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=800'}" 
                 alt="${data.nom}" class="w-full h-[400px] object-cover">
          </div>
          <div class="absolute -bottom-6 -right-6 bg-primary text-white px-6 py-3 rounded-xl shadow-lg">
            <p class="font-semibold text-sm">${data.titre}</p>
          </div>
        </div>
        <div>
          <p class="text-primary text-xs font-semibold tracking-widest uppercase mb-3">Mot du Directeur</p>
          <h2 class="font-serif text-3xl lg:text-4xl font-bold text-dark mb-6">
            <strong>${data.nom}</strong>
          </h2>
          <div class="relative pl-6 border-l-4 border-primary mb-6">
            <p class="text-gray-text text-base leading-relaxed italic">
              "${data.message}"
            </p>
          </div>
          <a href="#" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded text-sm font-medium hover:bg-primary-dark transition">
            En savoir plus <i class="fas fa-arrow-right text-xs"></i>
          </a>
        </div>
      </div>
    `;
  } catch (err) {
    console.error('Erreur chargement directeur:', err);
    container.innerHTML = '<p class="text-gray-text text-center">Contenu temporairement indisponible</p>';
  }
}

// ============================================
// 3. NOS DIRECTIONS
// ============================================
async function loadDirections() {
  const container = document.getElementById('directions-grid');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('directions')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;

    container.innerHTML = data.map(item => `
      <div class="direction-card">
        <div class="direction-icon" style="background: ${item.couleur}15; color: ${item.couleur}">
          <i class="${item.icone}" style="font-size: 26px"></i>
        </div>
        <h3 class="font-semibold text-lg text-dark mb-2">${item.nom}</h3>
        <p class="text-gray-text text-sm leading-relaxed mb-4">${item.description}</p>
        <a href="#" class="inline-flex items-center gap-2 text-sm font-medium transition-all hover:gap-3" style="color: ${item.couleur}">
          Découvrir <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>
    `).join('');
  } catch (err) {
    console.error('Erreur chargement directions:', err);
    container.innerHTML = '<p class="text-gray-text text-center col-span-5">Données temporairement indisponibles</p>';
  }
}

// ============================================
// 4. NORMES POPULAIRES
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
  } catch (err) {
    console.error('Erreur chargement normes:', err);
    container.innerHTML = '<p class="text-gray-text text-center col-span-3">Données temporairement indisponibles</p>';
  }
}

function renderNormes(normes) {
  const container = document.getElementById('normes-grid');
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
      <div class="flex items-center justify-between">
        <span class="text-xs text-gray-text"><i class="far fa-calendar mr-1"></i>${new Date(item.date_pub).toLocaleDateString('fr-FR')}</span>
        <a href="#" class="text-primary text-xs font-medium inline-flex items-center gap-1 hover:gap-2 transition-all">
          Consulter <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  `).join('');
}

function filterNormes(categorie) {
  const btns = document.querySelectorAll('.norme-filter-btn');
  btns.forEach(b => {
    b.classList.toggle('bg-primary', b.dataset.cat === categorie);
    b.classList.toggle('text-white', b.dataset.cat === categorie);
    b.classList.toggle('bg-gray-100', b.dataset.cat !== categorie);
    b.classList.toggle('text-dark', b.dataset.cat !== categorie);
  });

  if (!window._normesData) return;
  const filtered = categorie === 'all'
    ? window._normesData
    : window._normesData.filter(n => n.categorie === categorie);
  renderNormes(filtered);
}

function searchNormes(query) {
  if (!window._normesData) return;
  const q = query.toLowerCase();
  const filtered = window._normesData.filter(n =>
    n.code.toLowerCase().includes(q) ||
    n.titre.toLowerCase().includes(q) ||
    (n.description && n.description.toLowerCase().includes(q))
  );
  renderNormes(filtered);
}

// ============================================
// 5. ÉVÉNEMENTS
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
                <span><i class="fas fa-map-marker-alt mr-1"></i>${item.lieu || 'Non précisé'}</span>
              </div>
            </div>
          </div>
        </div>
      `;
    }).join('');
  } catch (err) {
    console.error('Erreur chargement événements:', err);
    container.innerHTML = '<p class="text-gray-text text-center col-span-4">Données temporairement indisponibles</p>';
  }
}

// ============================================
// 6. PARTENAIRES
// ============================================
async function loadPartenaires() {
  const container = document.getElementById('partenaires-track');
  if (!container) return;

  try {
    const { data, error } = await supabaseClient
      .from('partenaires')
      .select('*')
      .order('ordre', { ascending: true });

    if (error) throw error;

    container.innerHTML = data.map(item => `
      <a href="${item.site_web || '#'}" target="_blank" rel="noopener" class="partenaire-item flex-shrink-0 flex items-center justify-center px-8 py-4 bg-white rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-lg transition-all duration-300 group" title="${item.description || item.nom}">
        <img src="${item.logo_url}" alt="${item.nom}" class="h-12 w-auto max-w-[120px] object-contain opacity-60 group-hover:opacity-100 transition-opacity grayscale group-hover:grayscale-0">
      </a>
    `).join('');

    clonePartenairesForInfiniteScroll();
  } catch (err) {
    console.error('Erreur chargement partenaires:', err);
  }
}

function clonePartenairesForInfiniteScroll() {
  const track = document.getElementById('partenaires-track');
  if (!track) return;
  const items = track.innerHTML;
  track.innerHTML += items;
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
      const nom = newsletterForm.querySelector('[name="nom"]').value.trim();
      const email = newsletterForm.querySelector('[name="email"]').value.trim();
      const btn = newsletterForm.querySelector('button[type="submit"]');
      const origText = btn.innerHTML;

      if (!nom || !email) return;

      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription...';
      btn.disabled = true;

      try {
        const { error } = await supabaseClient
          .from('newsletter_subscribers')
          .insert([{ nom, email }]);

        if (error) throw error;

        btn.innerHTML = '<i class="fas fa-check"></i> Inscrit !';
        btn.classList.add('bg-green-600');
        btn.classList.remove('bg-primary');
        newsletterForm.reset();

        setTimeout(() => {
          btn.innerHTML = origText;
          btn.classList.remove('bg-green-600');
          btn.classList.add('bg-primary');
          btn.disabled = false;
        }, 3000);
      } catch (err) {
        console.error('Erreur newsletter:', err);
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

        btn.innerHTML = '<i class="fas fa-check"></i> Envoyé !';
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

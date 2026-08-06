-- ============================================
-- ACONOQ - Seed Supplement: Missing Dynamic Data
-- Run AFTER seed_dynamic.sql
-- ============================================

-- 1. PCEC ROUTES (card_grids)
INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_icon, card_number, ordre) VALUES
('index', 'pcec-routes', 'Route A', 'Concerne toutes les importations peu fréquentes. L''évaluation est basée sur le contrôle documentaire et l''inspection physique systématique, visant des exportateurs peu fréquents.', 'fas fa-truck', NULL, 1),
('index', 'pcec-routes', 'Route B', 'Concerne les importations préalablement enregistrées. L''évaluation est basée sur le contrôle documentaire et l''inspection physique inopinée, ciblant les exportateurs fréquents.', 'fas fa-ship', NULL, 2),
('index', 'pcec-routes', 'Route C', 'Concerne les importations des produits sous licence enregistrées. L''évaluation est basée sur l''audit d''usine, le contrôle documentaire et l''inspection physique inopinée, s''appliquant aux fabricants, distributeurs officiels et propriétaires de marques.', 'fas fa-industry', NULL, 3)
ON CONFLICT DO NOTHING;

-- 2. PROCESSUS CAROUSEL (replace existing)
DELETE FROM processus;
INSERT INTO processus (title, description, icon_class, link_url, ordre) VALUES
('Processus d''élaboration des normes', 'Processus de certification', 'fas fa-file-alt', '#', 1),
('Processus de certification', 'Vérification et validation de conformité de vos produits et procédés aux normes en vigueur.', 'fas fa-certificate', '#', 2),
('Normes rendues d''application obligatoires', 'Dispositions légales rendant obligatoire l''application de normes spécifiques sur le territoire national.', 'fas fa-gavel', '#', 3),
('Formations', 'Programmes de formation en normalisation, métrologie et systèmes de management de la qualité.', 'fas fa-graduation-cap', '#', 4),
('Audit et Contrôle', 'Vérification de conformité aux normes nationales et internationales pour garantir la sécurité et la qualité.', 'fas fa-search', '#', 5)
ON CONFLICT DO NOTHING;

-- 3. FOOTER SETTINGS
INSERT INTO site_settings (key, value) VALUES
('footer', '{
  "brand_description": "L''Agence congolaise de normalisation et de la qualité est un établissement public à caractère administratif, doté de la personnalité morale et de l''autonomie financière.",
  "logo_url": "https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/aconoq_logo_white.png",
  "copyright": "© 2025 ACONOQ - Agence Congolaise de Normalisation et de la Qualité. Tous droits réservés.",
  "social_links": [
    {"icon": "fab fa-facebook-f", "url": "#"},
    {"icon": "fab fa-twitter", "url": "#"},
    {"icon": "fab fa-instagram", "url": "#"},
    {"icon": "fab fa-linkedin-in", "url": "#"}
  ],
  "columns": [
    {
      "title": "ACONOQ",
      "links": [
        {"label": "Actualité et annonces", "url": "#"},
        {"label": "Présentation des services", "url": "#"},
        {"label": "Mot du Directeur Général", "url": "directeur.html"},
        {"label": "À propos de l''ACONOQ", "url": "a-propos.html"},
        {"label": "Organigramme", "url": "organigramme.html"},
        {"label": "Cadre réglementaire", "url": "#"}
      ]
    },
    {
      "title": "Nos Directions",
      "links": [
        {"label": "Normalisation", "url": "normalisation.html"},
        {"label": "Métrologie", "url": "metrologie.html"},
        {"label": "Promotion de la qualité", "url": "qualite.html"},
        {"label": "Évaluation de la conformité", "url": "conformite.html"},
        {"label": "PCEC", "url": "pcec.html"}
      ]
    },
    {
      "title": "Services",
      "links": [
        {"label": "Audit", "url": "#"},
        {"label": "Certification", "url": "#"},
        {"label": "Labelisation", "url": "#"},
        {"label": "Formations", "url": "#"},
        {"label": "Marque NCGO", "url": "#"},
        {"label": "ZLECAF", "url": "#"}
      ]
    }
  ],
  "contact": {
    "address": "10, Impasse Jean-Marie NIABIA, Quartier OCH, Brazzaville",
    "phone": "+242 04 404 6270",
    "email": "contact@aconoq.cg",
    "hours": "Lun - Ven: 8:00 - 17:00"
  },
  "newsletter": {
    "title": "Restez informé",
    "description": "Recevez nos actualités et mise à jour directement dans votre boîte mail."
  },
  "legal": [
    {"label": "Politique de confidentialité", "url": "#"},
    {"label": "Conditions d''utilisation", "url": "#"}
  ]
}'::jsonb)
ON CONFLICT (key) DO UPDATE SET value = EXCLUDED.value, updated_at = now();

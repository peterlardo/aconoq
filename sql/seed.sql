-- ============================================
-- ACONOQ - Base de données Supabase
-- Exécuter ce fichier dans l'éditeur SQL de Supabase
-- ============================================

-- 1. CHIFFRES CLÉS
CREATE TABLE IF NOT EXISTS chiffres_cles (
  id BIGSERIAL PRIMARY KEY,
  label TEXT NOT NULL,
  valeur TEXT NOT NULL,
  icone TEXT NOT NULL,
  description TEXT,
  ordre INT DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 2. DIRECTEUR
CREATE TABLE IF NOT EXISTS directeur (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  titre TEXT NOT NULL,
  photo_url TEXT,
  message TEXT NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 3. DIRECTIONS
CREATE TABLE IF NOT EXISTS directions (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  description TEXT NOT NULL,
  icone TEXT NOT NULL,
  couleur TEXT DEFAULT '#0f7140',
  ordre INT DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 4. NORMES
CREATE TABLE IF NOT EXISTS normes (
  id BIGSERIAL PRIMARY KEY,
  code TEXT NOT NULL UNIQUE,
  titre TEXT NOT NULL,
  description TEXT,
  categorie TEXT NOT NULL,
  type_iso TEXT DEFAULT 'NCGO',
  origine TEXT DEFAULT 'Congolais',
  date_pub DATE DEFAULT CURRENT_DATE,
  statut TEXT DEFAULT 'active',
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Si la table existe déjà sans les colonnes, exécuter :
-- ALTER TABLE normes ADD COLUMN IF NOT EXISTS type_iso TEXT DEFAULT 'NCGO';
-- ALTER TABLE normes ADD COLUMN IF NOT EXISTS origine TEXT DEFAULT 'Congolais';

-- 5. ÉVÉNEMENTS
CREATE TABLE IF NOT EXISTS evenements (
  id BIGSERIAL PRIMARY KEY,
  titre TEXT NOT NULL,
  description TEXT,
  date_debut TIMESTAMPTZ NOT NULL,
  date_fin TIMESTAMPTZ,
  lieu TEXT,
  type_event TEXT NOT NULL,
  image_url TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 6. PARTENAIRES
CREATE TABLE IF NOT EXISTS partenaires (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  logo_url TEXT,
  site_web TEXT,
  description TEXT,
  ordre INT DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 7. ACTUALITÉS
CREATE TABLE IF NOT EXISTS actualites (
  id BIGSERIAL PRIMARY KEY,
  titre TEXT NOT NULL,
  contenu TEXT NOT NULL,
  image_url TEXT,
  categorie TEXT NOT NULL,
  date_pub TIMESTAMPTZ DEFAULT NOW(),
  auteur TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- 8. NEWSLETTER SUBSCRIBERS
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  date_inscription TIMESTAMPTZ DEFAULT NOW()
);

-- 9. CONTACT MESSAGES
CREATE TABLE IF NOT EXISTS contact_messages (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  email TEXT NOT NULL,
  sujet TEXT NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ============================================
-- INDEXES
-- ============================================
CREATE INDEX IF NOT EXISTS idx_normes_categorie ON normes(categorie);
CREATE INDEX IF NOT EXISTS idx_normes_statut ON normes(statut);
CREATE INDEX IF NOT EXISTS idx_evenements_date ON evenements(date_debut);
CREATE INDEX IF NOT EXISTS idx_actualites_date ON actualites(date_pub);
CREATE INDEX IF NOT EXISTS idx_actualites_categorie ON actualites(categorie);

-- ============================================
-- RLS (Row Level Security) - Lecture publique
-- ============================================
ALTER TABLE chiffres_cles ENABLE ROW LEVEL SECURITY;
ALTER TABLE directeur ENABLE ROW LEVEL SECURITY;
ALTER TABLE directions ENABLE ROW LEVEL SECURITY;
ALTER TABLE normes ENABLE ROW LEVEL SECURITY;
ALTER TABLE evenements ENABLE ROW LEVEL SECURITY;
ALTER TABLE partenaires ENABLE ROW LEVEL SECURITY;
ALTER TABLE actualites ENABLE ROW LEVEL SECURITY;
ALTER TABLE newsletter_subscribers ENABLE ROW LEVEL SECURITY;
ALTER TABLE contact_messages ENABLE ROW LEVEL SECURITY;

-- Politiques de lecture publique
CREATE POLICY "Lecture publique chiffres_cles" ON chiffres_cles FOR SELECT USING (true);
CREATE POLICY "Lecture publique directeur" ON directeur FOR SELECT USING (true);
CREATE POLICY "Lecture publique directions" ON directions FOR SELECT USING (true);
CREATE POLICY "Lecture publique normes" ON normes FOR SELECT USING (true);
CREATE POLICY "Lecture publique evenements" ON evenements FOR SELECT USING (true);
CREATE POLICY "Lecture publique partenaires" ON partenaires FOR SELECT USING (true);
CREATE POLICY "Lecture publique actualites" ON actualites FOR SELECT USING (true);

-- Politiques d'insertion pour formulaires
CREATE POLICY "Insertion newsletter" ON newsletter_subscribers FOR INSERT WITH CHECK (true);
CREATE POLICY "Insertion contact" ON contact_messages FOR INSERT WITH CHECK (true);

-- ============================================
-- DONNÉES DE DÉMO
-- ============================================

-- Chiffres Clés
INSERT INTO chiffres_cles (label, valeur, icone, description, ordre) VALUES
('Normes publiées', '1 250+', 'fas fa-file-alt', 'Normes nationales et internationales adoptées', 1),
('Entreprises certifiées', '850+', 'fas fa-certificate', 'Entreprises détenant la marque NCGO', 2),
('Formations réalisées', '3 200+', 'fas fa-graduation-cap', 'Professionnels formés en normalisation', 3),
('Opérateurs évalués', '5 000+', 'fas fa-check-circle', 'Opérateurs économiques évalués via le PCEC', 4);

-- Directeur
INSERT INTO directeur (nom, titre, photo_url, message) VALUES
('Directeur Général', 'Directeur Général de l''ACONOQ', 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=400',
'L''ACONOQ s''engage à promouvoir la qualité, la normalisation et la conformité des produits en République du Congo. Notre mission est de garantir la sécurité des consommateurs et de soutenir le développement économique du pays à travers des normes rigoureuses et un accompagnement de proximité. Ensemble, nous construisons un avenir où la qualité est au cœur de chaque production congolaise.');

-- Directions
INSERT INTO directions (nom, description, icone, couleur, ordre) VALUES
('Normalisation', 'Élaboration, adoption et diffusion des normes nationales congolaises NCGO.', 'fas fa-book', '#0f7140', 1),
('Métrologie', 'Assurer l''exactitude et la fiabilité des mesures sur le territoire national.', 'fas fa-ruler-combined', '#1a56db', 2),
('Promotion de la Qualité', 'Sensibiliser et accompagner les acteurs économiques dans l''amélioration de la qualité.', 'fas fa-award', '#d97706', 3),
('Évaluation de la Conformité', 'Vérifier la conformité des produits aux normes avant leur mise sur le marché.', 'fas fa-clipboard-check', '#dc2626', 4),
('PCEC', 'Programme Congolais d''Évaluation de la Conformité avant embarquement.', 'fas fa-shield-alt', '#7c3aed', 5);

-- Normes
INSERT INTO normes (code, titre, description, categorie, date_pub, statut) VALUES
('NCGO 001-2024', 'Systèmes de management de la qualité', 'Exigences relatives aux systèmes de management de la qualité pour les organisations', 'Management', '2024-01-15', 'active'),
('NCGO 002-2024', 'Sécurité alimentaire - HACCP', 'Principes et applications du système HACCP pour la sécurité des denrées alimentaires', 'Alimentation', '2024-03-20', 'active'),
('NCGO 003-2024', 'Étiquetage des produits alimentaires', 'Exigences d''étiquetage nutritionnel et sanitaire des denrées alimentaires préemballées', 'Alimentation', '2024-05-10', 'active'),
('NCGO 004-2024', 'Matériaux de construction - Ciment', 'Spécifications techniques pour les ciments destinés à la construction', 'Construction', '2024-07-01', 'active'),
('NCGO 005-2024', 'Équipements électriques - Sécurité', 'Exigences de sécurité pour les équipements électriques à usage domestique', 'Électricité', '2024-09-15', 'active'),
('NCGO 006-2024', 'Métrologie légale - Instruments de mesure', 'Réglementation sur la vérification des instruments de mesure commerciaux', 'Métrologie', '2024-11-01', 'active');

-- Événements
INSERT INTO evenements (titre, description, date_debut, date_fin, lieu, type_event, image_url) VALUES
('Formation HACCP - Niveau 1', 'Formation initiale aux principes HACCP pour les professionnels de la restauration et de l''agroalimentaire.', '2026-09-15 08:00:00+01', '2026-09-17 17:00:00+01', 'Brazzaville - CCIAC', 'formation', 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800'),
('Salon International de la Qualité 2026', 'Événement annuel réunissant les acteurs de la normalisation et de la qualité en Afrique centrale.', '2026-10-20 09:00:00+01', '2026-10-22 18:00:00+01', 'Brazzaville - Palais des Congrès', 'salon', 'https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?auto=compress&cs=tinysrgb&w=800'),
('Journée Portes Ouvertes ACONOQ', 'Découvrez nos installations et nos services lors de notre journée portes ouvertes annuelle.', '2026-11-15 09:00:00+01', '2026-11-15 17:00:00+01', 'ACONOQ - Brazzaville', 'evenement', 'https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=800'),
('Atelier Certification NCGO', 'Atelier pratique sur les démarches d''obtention de la marque de conformité NCGO.', '2026-12-05 08:30:00+01', '2026-12-05 16:30:00+01', 'Pointe-Noire - Centre Technique', 'formation', 'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=800');

-- Partenaires
INSERT INTO partenaires (nom, logo_url, site_web, description, ordre) VALUES
('ISO', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/ISO_Logo_%28Red_square%29.svg/200px-ISO_Logo_%28Red_square%29.svg.png', 'https://www.iso.org', 'Organisation Internationale de Normalisation', 1),
('OIM', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/BIPM_Logo.svg/200px-BIPM_Logo.svg.png', 'https://www.bipm.org', 'Organisation Internationale des Poids et Mesures', 2),
('SONORCO', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2020/07/aconoq_logo.png', '#', 'Société Nationale de Normalisation du Congo', 3),
('AFNOR', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/AFNOR_logo.svg/200px-AFNOR_logo.svg.png', 'https://www.afnor.org', 'Association Française de Normalisation', 4),
('ARSO', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/African_Standards_Organisation_logo.svg/200px-African_Standards_Organisation_logo.svg.png', 'https://www.arso-africa.org', 'African Organisation for Standardisation', 5),
('Intertek', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Intertek_logo.svg/200px-Intertek_logo.svg.png', 'https://www.intertek.com', 'Leader mondial de l''évaluation de la conformité', 6);

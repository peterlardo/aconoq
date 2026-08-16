-- ============================================
-- TABLE: categories
-- Gestion des catégories pour actualités, événements, normes
-- ============================================

CREATE TABLE IF NOT EXISTS categories (
  id BIGSERIAL PRIMARY KEY,
  nom TEXT NOT NULL,
  type_module TEXT NOT NULL DEFAULT 'actualites',
  description TEXT,
  couleur TEXT DEFAULT '#0f7140',
  ordre INT DEFAULT 0,
  active BOOLEAN DEFAULT true,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

ALTER TABLE categories ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS "Public read categories" ON categories;
CREATE POLICY "Public read categories" ON categories FOR SELECT USING (true);

DROP POLICY IF EXISTS "Admin full access categories" ON categories;
CREATE POLICY "Admin full access categories" ON categories
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- Seed catégories actualités
INSERT INTO categories (nom, type_module, description, couleur, ordre) VALUES
  ('Normalisation', 'actualites', 'Normes et réglementations', '#0f7140', 1),
  ('Qualité', 'actualites', 'Qualité et certification', '#3b82f6', 2),
  ('Événement', 'actualites', 'Évenements et manifestations', '#f59e0b', 3),
  ('Formation', 'actualites', 'Formations et ateliers', '#8b5cf6', 4),
  ('PCEC', 'actualites', 'Programme congolais d''évaluation de la conformité', '#ef4444', 5),
  ('ZLECAF', 'actualites', 'Zone de libre-échange continentale', '#06b6d4', 6),
  ('Communiqué', 'actualites', 'Communiqués de presse', '#64748b', 7)
ON CONFLICT DO NOTHING;

-- Seed catégories événements
INSERT INTO categories (nom, type_module, description, couleur, ordre) VALUES
  ('Formation', 'evenements', 'Sessions de formation', '#8b5cf6', 1),
  ('Salon', 'evenements', 'Salons et expositions', '#f59e0b', 2),
  ('Conférence', 'evenements', 'Conférences et colloques', '#3b82f6', 3),
  ('Atelier', 'evenements', 'Ateliers pratiques', '#0f7140', 4),
  ('Journée portes ouvertes', 'evenements', 'Journées portes ouvertes', '#ef4444', 5)
ON CONFLICT DO NOTHING;

-- Seed catégories normes
INSERT INTO categories (nom, type_module, description, couleur, ordre) VALUES
  ('NCGO', 'normes', 'Normes Congolaises', '#0f7140', 1),
  ('ISO', 'normes', 'Organisation Internationale de Normalisation', '#3b82f6', 2),
  ('CEI', 'normes', 'Commission Électrotechnique Internationale', '#f59e0b', 3),
  ('Africaine', 'normes', 'Normes africaines', '#8b5cf6', 4)
ON CONFLICT DO NOTHING;

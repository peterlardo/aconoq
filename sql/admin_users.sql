-- ============================================
-- TABLE: admin_users
-- Gestion des utilisateurs admin avec rôles et permissions
-- ============================================

CREATE TABLE IF NOT EXISTS admin_users (
  id BIGSERIAL PRIMARY KEY,
  email TEXT NOT NULL UNIQUE,
  nom TEXT NOT NULL,
  prenom TEXT NOT NULL,
  role TEXT NOT NULL DEFAULT 'editeur',
  permissions JSONB DEFAULT '[]'::jsonb,
  avatar_url TEXT,
  active BOOLEAN DEFAULT true,
  last_login TIMESTAMPTZ,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

ALTER TABLE admin_users ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS "Admin full access admin_users" ON admin_users;
CREATE POLICY "Admin full access admin_users" ON admin_users
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- Seed: admin par défaut
-- ============================================
INSERT INTO admin_users (email, nom, prenom, role, permissions, active) VALUES
  ('admin@aconoq.cg', 'Admin', 'Super', 'super_admin', '["*"]', true)
ON CONFLICT (email) DO UPDATE SET
  role = EXCLUDED.role,
  permissions = EXCLUDED.permissions,
  updated_at = NOW();

-- ============================================
-- Liste des modules disponibles pour les permissions
-- ============================================
-- Modules: actualites, evenements, normes, services, contact_messages,
--          site_settings, page_sections, chiffres_cles, directeur,
--          directions, partenaires, newsletter_subscribers, page_heroes,
--          hero_slides, banners, faq_items, certification_steps,
--          processus, contact_info, schedule, advantages,
--          how_it_works, pcec_exceptions, categories, dashboard, utilisateurs

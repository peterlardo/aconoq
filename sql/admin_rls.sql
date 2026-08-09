-- ============================================
-- ACONOQ ADMIN DASHBOARD - RLS Policies
-- Exécuter ce fichier dans Supabase SQL Editor
-- ============================================

-- 1. Créer un rôle admin dans auth.users
-- IMPORTANT: D'abord créer l'utilisateur via Supabase Dashboard > Authentication > Users
-- Ou utiliser: SELECT auth.create_user('admin@aconoq.cg', 'VotreMotDePasse', 'admin');

-- 2. Ajouter une colonne role aux profils (optionnel, alternative via JWT)
-- Si vous utilisez auth.users avec un custom claim, adaptez les policies ci-dessous

-- ============================================
-- POLICIES ADMIN POUR TOUTES LES TABLES
-- ============================================

-- Fonction helper pour vérifier si l'utilisateur est admin
CREATE OR REPLACE FUNCTION is_admin()
RETURNS BOOLEAN AS $$
BEGIN
  RETURN (
    SELECT EXISTS (
      SELECT 1 FROM auth.users
      WHERE id = auth.uid()
      AND (
        raw_user_meta_data->>'role' = 'admin'
        OR email = 'admin@aconoq.cg'
      )
    )
  );
END;
$$ LANGUAGE plpgsql SECURITY DEFINER STABLE;

-- ============================================
-- TABLE: chiffres_cles
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON chiffres_cles;
CREATE POLICY "Admin full access" ON chiffres_cles
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: directeur
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON directeur;
CREATE POLICY "Admin full access" ON directeur
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: directions
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON directions;
CREATE POLICY "Admin full access" ON directions
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: normes
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON normes;
CREATE POLICY "Admin full access" ON normes
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: evenements
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON evenements;
CREATE POLICY "Admin full access" ON evenements
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: partenaires
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON partenaires;
CREATE POLICY "Admin full access" ON partenaires
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: actualites
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON actualites;
CREATE POLICY "Admin full access" ON actualites
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: newsletter_subscribers
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON newsletter_subscribers;
CREATE POLICY "Admin full access" ON newsletter_subscribers
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: contact_messages
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON contact_messages;
CREATE POLICY "Admin full access" ON contact_messages
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: site_settings
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON site_settings;
CREATE POLICY "Admin full access" ON site_settings
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: page_heroes
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON page_heroes;
CREATE POLICY "Admin full access" ON page_heroes
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: hero_slides
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON hero_slides;
CREATE POLICY "Admin full access" ON hero_slides
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: services
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON services;
CREATE POLICY "Admin full access" ON services
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: banners
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON banners;
CREATE POLICY "Admin full access" ON banners
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: processus
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON processus;
CREATE POLICY "Admin full access" ON processus
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: page_sections
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON page_sections;
CREATE POLICY "Admin full access" ON page_sections
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: card_grids
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON card_grids;
CREATE POLICY "Admin full access" ON card_grids
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: faq_items
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON faq_items;
CREATE POLICY "Admin full access" ON faq_items
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: certification_steps
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON certification_steps;
CREATE POLICY "Admin full access" ON certification_steps
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: pcec_exceptions
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON pcec_exceptions;
CREATE POLICY "Admin full access" ON pcec_exceptions
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: contact_info
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON contact_info;
CREATE POLICY "Admin full access" ON contact_info
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: schedule
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON schedule;
CREATE POLICY "Admin full access" ON schedule
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: advantages
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON advantages;
CREATE POLICY "Admin full access" ON advantages
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- TABLE: how_it_works
-- ============================================
DROP POLICY IF EXISTS "Admin full access" ON how_it_works;
CREATE POLICY "Admin full access" ON how_it_works
  FOR ALL USING (is_admin()) WITH CHECK (is_admin());

-- ============================================
-- STORAGE (si vous voulez gérer les uploads d'images)
-- ============================================
-- Créer un bucket pour les images admin
INSERT INTO storage.buckets (id, name, public) 
VALUES ('admin-images', 'admin-images', true)
ON CONFLICT (id) DO NOTHING;

-- Policy pour que les admins puissent tout faire sur le bucket
DROP POLICY IF EXISTS "Admin storage access" ON storage.objects;
CREATE POLICY "Admin storage access" ON storage.objects
  FOR ALL USING (
    bucket_id = 'admin-images' AND is_admin()
  ) WITH CHECK (
    bucket_id = 'admin-images' AND is_admin()
  );

-- ============================================
-- INSTRUCTIONS POST-INSTALLATION
-- ============================================
-- 1. Exécuter ce fichier dans Supabase SQL Editor
-- 2. Aller dans Authentication > Users
-- 3. Créer un utilisateur avec email: admin@aconoq.cg
-- 4. Dans les User Metadata, ajouter: {"role": "admin"}
-- 5. Aller sur /admin/login.html et se connecter

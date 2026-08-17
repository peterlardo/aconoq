-- ============================================
-- ACONOQ - Add Public Read Policies
-- Allows anonymous users to read public-facing tables
-- Execute in Supabase SQL Editor
-- ============================================

-- chiffres_cles (homepage stats)
DROP POLICY IF EXISTS "Public read" ON chiffres_cles;
CREATE POLICY "Public read" ON chiffres_cles FOR SELECT USING (true);

-- directeur (directeur page)
DROP POLICY IF EXISTS "Public read" ON directeur;
CREATE POLICY "Public read" ON directeur FOR SELECT USING (true);

-- directions (organigramme + nav)
DROP POLICY IF EXISTS "Public read" ON directions;
CREATE POLICY "Public read" ON directions FOR SELECT USING (true);

-- normes (boutique + homepage)
DROP POLICY IF EXISTS "Public read" ON normes;
CREATE POLICY "Public read" ON normes FOR SELECT USING (true);

-- evenements (events page + homepage)
DROP POLICY IF EXISTS "Public read" ON evenements;
CREATE POLICY "Public read" ON evenements FOR SELECT USING (true);

-- partenaires (homepage)
DROP POLICY IF EXISTS "Public read" ON partenaires;
CREATE POLICY "Public read" ON partenaires FOR SELECT USING (true);

-- actualites (news page + homepage)
DROP POLICY IF EXISTS "Public read" ON actualites;
CREATE POLICY "Public read" ON actualites FOR SELECT USING (true);

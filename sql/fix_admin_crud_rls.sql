-- ACONOQ : autoriser le CRUD aux administrateurs authentifiés
CREATE OR REPLACE FUNCTION public.is_admin()
RETURNS BOOLEAN
LANGUAGE sql
STABLE
SECURITY DEFINER
SET search_path = public, auth
AS $$
  SELECT EXISTS (
    SELECT 1
    FROM auth.users
    WHERE id = auth.uid()
      AND (
        email = 'admin@aconoq.cg'
        OR raw_user_meta_data->>'role' = 'admin'
      )
  );
$$;


-- Compatibilité du module Utilisateurs avec l'interface d'administration
CREATE TABLE IF NOT EXISTS public.admin_users (
  id BIGSERIAL PRIMARY KEY,
  email TEXT NOT NULL UNIQUE,
  full_name TEXT,
  nom TEXT,
  prenom TEXT,
  auth_user_id UUID,
  role TEXT NOT NULL DEFAULT 'editor',
  permissions JSONB DEFAULT '{}'::jsonb,
  active BOOLEAN DEFAULT true,
  last_login TIMESTAMPTZ,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);
ALTER TABLE public.admin_users ADD COLUMN IF NOT EXISTS full_name TEXT;
ALTER TABLE public.admin_users ADD COLUMN IF NOT EXISTS auth_user_id UUID;
ALTER TABLE public.admin_users ALTER COLUMN nom DROP NOT NULL;
ALTER TABLE public.admin_users ALTER COLUMN prenom DROP NOT NULL;
UPDATE public.admin_users
SET full_name = NULLIF(TRIM(CONCAT_WS(' ', prenom, nom)), '')
WHERE full_name IS NULL;
DO $$
DECLARE
  table_name text;
BEGIN
  FOREACH table_name IN ARRAY ARRAY[
    'actualites','evenements','normes','services','contact_messages',
    'site_settings','page_sections','chiffres_cles','directeur','directions',
    'partenaires','newsletter_subscribers','page_heroes','hero_slides',
    'banners','faq_items','certification_steps','processus','contact_info',
    'schedule','advantages','how_it_works','pcec_exceptions','categories',
    'card_grids','admin_users'
  ]
  LOOP
    IF to_regclass('public.' || table_name) IS NOT NULL THEN
      EXECUTE format('ALTER TABLE public.%I ENABLE ROW LEVEL SECURITY', table_name);
      EXECUTE format('DROP POLICY IF EXISTS "Admin full access" ON public.%I', table_name);
      EXECUTE format(
        'CREATE POLICY "Admin full access" ON public.%I FOR ALL TO authenticated USING (public.is_admin()) WITH CHECK (public.is_admin())',
        table_name
      );
    END IF;
  END LOOP;
END $$;

-- Uploads d'images utilisés par le formulaire admin
INSERT INTO storage.buckets (id, name, public)
VALUES ('admin-images', 'admin-images', true)
ON CONFLICT (id) DO UPDATE SET public = true;
DROP POLICY IF EXISTS "Admin storage access" ON storage.objects;
CREATE POLICY "Admin storage access" ON storage.objects
  FOR ALL TO authenticated
  USING (bucket_id = 'admin-images' AND public.is_admin())
  WITH CHECK (bucket_id = 'admin-images' AND public.is_admin());


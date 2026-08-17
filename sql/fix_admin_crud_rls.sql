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
    'card_grids'
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

-- ACONOQ: policies complémentaires nécessaires au dashboard Supabase
-- À exécuter après admin_rls.sql. Les tables publiques restent lisibles par anon.
ALTER TABLE actualites ENABLE ROW LEVEL SECURITY;
ALTER TABLE evenements ENABLE ROW LEVEL SECURITY;
ALTER TABLE normes ENABLE ROW LEVEL SECURITY;
ALTER TABLE contact_messages ENABLE ROW LEVEL SECURITY;
DO $$ DECLARE t text; BEGIN
  FOREACH t IN ARRAY ARRAY['actualites','evenements','normes','contact_messages'] LOOP
    EXECUTE format('DROP POLICY IF EXISTS "Admin full access" ON %I', t);
    EXECUTE format('CREATE POLICY "Admin full access" ON %I FOR ALL USING (is_admin()) WITH CHECK (is_admin())', t);
  END LOOP;
END $$;

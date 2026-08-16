CREATE TABLE IF NOT EXISTS admin_users (
  id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
  auth_user_id uuid UNIQUE REFERENCES auth.users(id) ON DELETE CASCADE,
  email text UNIQUE NOT NULL,
  full_name text NOT NULL DEFAULT '',
  role text NOT NULL DEFAULT 'editor' CHECK (role IN ('super_admin','admin','editor','viewer')),
  permissions jsonb NOT NULL DEFAULT '{"dashboard":true,"actualites":false,"evenements":false,"normes":false,"boutique":false,"messages":false,"users":false}'::jsonb,
  active boolean NOT NULL DEFAULT true,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);
ALTER TABLE admin_users ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "Admin users access" ON admin_users;
CREATE POLICY "Admin users access" ON admin_users FOR ALL USING (is_admin()) WITH CHECK (is_admin());

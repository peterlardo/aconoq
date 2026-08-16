# Déploiement ACONOQ — PHP + Supabase

## Architecture

- Le serveur PHP héberge les pages publiques et `/admin`.
- Supabase héberge la base de données, l'authentification et le stockage.
- Les pages PHP utilisent l'API Supabase via `config.php` et `js/supabase.js`.

## Déploiement

1. Choisir un hébergement PHP : Hostinger/cPanel, un VPS ou Render.
2. Envoyer le contenu du projet dans le dossier public (`public_html` ou équivalent).
3. Vérifier que PHP 8.1+ est activé.
4. Conserver `config.php` avec les variables Supabase du projet.
5. Dans Supabase SQL Editor, exécuter dans cet ordre :
   - `sql/migrate_dynamic.sql`
   - `sql/seed_dynamic.sql`
   - `sql/admin_rls.sql`
   - `admin/admin-supabase.sql`
6. Dans Supabase Authentication > Users, créer `admin@aconoq.cg` avec le rôle `admin` dans User Metadata.
7. Tester `/admin/supabase-login.php`, puis `/admin/crud.php?table=actualites`.

## Important

Netlify ne doit servir que la version statique éventuelle. Il ne peut pas exécuter les fichiers PHP. Le domaine public doit pointer vers l'hébergement PHP une fois celui-ci choisi.

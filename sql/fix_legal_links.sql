-- ============================================
-- FIX: Politique de confidentialité URL in footer legal links
-- Run in Supabase SQL Editor
-- ============================================

UPDATE site_settings
SET value = jsonb_set(
  value,
  '{legal}',
  (
    SELECT jsonb_agg(
      CASE
        WHEN elem->>'label' = 'Politique de confidentialité'
        THEN jsonb_set(elem, '{url}', '"politique-confidentialite.php"')
        ELSE elem
      END
    )
    FROM jsonb_array_elements(value->'legal') AS elem
  )
),
updated_at = now()
WHERE key = 'footer'
AND value->'legal' @> '[{"label": "Politique de confidentialité", "url": "#"}]';

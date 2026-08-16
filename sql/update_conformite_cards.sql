-- Replace 6 conformité cards with exactly 3: Certification, Inspection, Essais
DELETE FROM card_grids WHERE page_slug = 'conformite' AND grid_key = 'activites';

INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_icon, card_link, ordre, active)
VALUES
  ('conformite', 'activites', 'Certification', 'Évaluation et certification de la conformité de vos produits aux normes en vigueur.', 'fas fa-certificate', 'pcec.php', 1, true),
  ('conformite', 'activites', 'Inspection', 'Vérification sur site de la conformité des produits et processus.', 'fas fa-search', 'contact.php', 2, true),
  ('conformite', 'activites', 'Essais', 'Tests et vérifications techniques pour confirmer la conformité aux exigences.', 'fas fa-flask', 'devis.php', 3, true);

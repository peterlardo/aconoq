INSERT INTO hero_slides (image_url, badge, title, subtitle, cta1_label, cta1_url, cta2_label, cta2_url, ordre, active)
VALUES (
  'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1fRkRsoTmZZoAZjrxW2qzcTFV2C3DsCq-LufFTU5TqA&s',
  'ACONOQ',
  'Nouveau slider',
  'Description du nouveau slide.',
  'En savoir plus',
  'a-propos.php',
  'Nous Contacter',
  'contact.php',
  (SELECT COALESCE(MAX(ordre), 0) + 1 FROM hero_slides),
  true
);

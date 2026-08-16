TRUNCATE TABLE services;

INSERT INTO services (title, description, icon_class, link_url, ordre) VALUES
('Audit', 'Vérification et contrôle de conformité aux normes nationales et internationales.', 'fas fa-clipboard-check', 'audit.php', 1),
('Certification', 'Certification des produits, procédés et services conformes aux normes congolaises NCGO.', 'fas fa-certificate', 'certification.php', 2),
('Labelisation', 'Attribution de labels et marques nationales de conformité aux normes.', 'fas fa-award', 'labelisation.php', 3),
('Formations', 'Programmes de formation en normalisation, métrologie et promotion de la qualité.', 'fas fa-graduation-cap', 'formations.php', 4);

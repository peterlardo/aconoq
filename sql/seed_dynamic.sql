-- ============================================
-- ACONOQ - Seed: All Dynamic Content
-- Run AFTER migrate_dynamic.sql
-- ============================================

-- 1. SITE SETTINGS
INSERT INTO site_settings (key, value) VALUES ('footer', '{"brand_description": "L''Agence congolaise de normalisation et de la qualité est un établissement public à caractère administratif, doté de la personnalité morale et de l''autonomie financière.", "logo_url": "https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/aconoq_logo_white.png", "copyright": "© 2025 ACONOQ - Agence Congolaise de Normalisation et de la Qualité. Tous droits réservés.", "social_links": [{"icon": "fab fa-facebook-f", "url": "#"}, {"icon": "fab fa-twitter", "url": "#"}, {"icon": "fab fa-instagram", "url": "#"}, {"icon": "fab fa-linkedin-in", "url": "#"}], "columns": [{"title": "ACONOQ", "links": [{"label": "Actualité et annonces", "url": "#"}, {"label": "Présentation des services", "url": "#"}, {"label": "Mot du Directeur Général", "url": "directeur.html"}, {"label": "À propos de l''ACONOQ", "url": "a-propos.html"}, {"label": "Organigramme", "url": "organigramme.html"}, {"label": "Cadre réglementaire", "url": "#"}]}, {"title": "Nos Directions", "links": [{"label": "Normalisation", "url": "normalisation.html"}, {"label": "Métrologie", "url": "metrologie.html"}, {"label": "Promotion de la qualité", "url": "qualite.html"}, {"label": "Évaluation de la conformité", "url": "conformite.html"}, {"label": "PCEC", "url": "pcec.html"}]}, {"title": "Services", "links": [{"label": "Audit", "url": "#"}, {"label": "Certification", "url": "#"}, {"label": "Labelisation", "url": "#"}, {"label": "Formations", "url": "#"}, {"label": "Marque NCGO", "url": "#"}, {"label": "ZLECAF", "url": "#"}]}], "contact": {"address": "Brazzaville, République du Congo", "phone": "+1 212 946 2700", "email": "contact@aconoq.cg", "hours": "Mon - Fri: 9:00 - 18:00"}, "newsletter": {"title": "Restez informé", "description": "Recevez nos actualités et mise à jour directement dans votre boîte mail."}, "legal": [{"label": "Politique de confidentialité", "url": "#"}, {"label": "Conditions d''utilisation", "url": "#"}]}'::jsonb)
ON CONFLICT (key) DO UPDATE SET value = EXCLUDED.value, updated_at = now();

-- 2. PAGE HEROES
INSERT INTO page_heroes (page_slug, image_url, title, subtitle) VALUES
('a-propos', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/slider11-scaled.png', 'À propos de l''ACONOQ', NULL),
('directeur', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/dg2-scaled.png', 'Mot du Directeur Général', NULL),
('organigramme', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/person.png', 'Organigramme', NULL),
('normalisation', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/management1.png', 'La Normalisation', NULL),
('metrologie', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/09/Image-metrologie-scaled-1.jpeg', 'La Métrologie', NULL),
('qualite', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/target.png', 'Promotion de la Qualité', NULL),
('conformite', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/certificate.png', 'Évaluation de la Conformité', NULL),
('pcec', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/port.png', 'Le PCEC', NULL),
('contact', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/transport-logistics-products-scaled.jpg', 'Contactez-nous', NULL),
('boutique', 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Boutique NCGO', NULL)
ON CONFLICT (page_slug) DO UPDATE SET image_url = EXCLUDED.image_url, title = EXCLUDED.title, updated_at = now();

-- 3. HERO SLIDES
INSERT INTO hero_slides (image_url, alt_text, badge, title, subtitle, cta1_label, cta1_url, cta2_label, cta2_url, ordre) VALUES
('https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Normalisation Congo', 'Agence Congolaise de Normalisation et de la Qualité', 'La mesure précise', 'garantie votre réussite.', 'À propos de nous', 'a-propos.html', 'Nous Contacter', 'contact.html', 1),
('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Qualité et Standards', NULL, 'Excellence & Qualité', 'au service du développement national.', 'Découvrir nos services', '#', 'En savoir plus', 'a-propos.html', 2),
('https://images.pexels.com/photos/2310090/pexels-photo-2310090.jpeg?auto=compress&cs=tinysrgb&w=1920', 'PCEC Conformité', NULL, 'Conformité sans frontières', 'Le PCEC au service de la sécurité des produits.', 'Découvrir le PCEC', 'pcec.html', 'Nous contacter', 'contact.html', 3),
('https://images.pexels.com/photos/1108101/pexels-photo-1108101.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Métrologie', NULL, 'Précision & Mesure', 'La métrologie pour garantir l''exactitude des mesures.', 'La Métrologie', 'metrologie.html', 'Contactez-nous', 'contact.html', 4)
ON CONFLICT DO NOTHING;

-- 4. SERVICES
INSERT INTO services (title, description, icon_class, link_url, ordre) VALUES
('Audit', 'Vérification et contrôle de conformité aux normes nationales et internationales.', 'fas fa-clipboard-check', '#', 1),
('Certification', 'Certification des produits, procédés et services conformes aux normes congolaises NCGO.', 'fas fa-certificate', '#', 2),
('Labelisation', 'Attribution de labels et marques nationales de conformité aux normes.', 'fas fa-award', '#', 3),
('Formations', 'Programmes de formation en normalisation, métrologie et promotion de la qualité.', 'fas fa-graduation-cap', '#', 4)
ON CONFLICT DO NOTHING;

-- 5. BANNERS
INSERT INTO banners (page_slug, image_url, badge, title, description, cta1_label, cta1_url, features, ordre) VALUES
('index', 'https://images.pexels.com/photos/2310090/pexels-photo-2310090.jpeg?auto=compress&cs=tinysrgb&w=1920', 'PCEC', 'Conformité sans frontières', 'Le Programme Congolais d''Évaluation de la Conformité garantit la sécurité et la qualité de tous les produits importés en République du Congo.', 'Découvrir le PCEC', 'pcec.html', '[]'::jsonb, 1),
('index', 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Boutique en ligne', 'Achetez vos normes', 'Accédez à notre catalogue de normes et téléchargez les documents officiels directement en ligne.', 'Voir le catalogue', 'boutique.html', '["Consultez le catalogue de normes NCGO","Téléchargez les documents officiels"]'::jsonb, 2)
ON CONFLICT DO NOTHING;

-- 6. PROCESSUS
INSERT INTO processus (title, description, icon_class, link_url, ordre) VALUES
('Demande', 'Déposez votre demande de normalisation ou de certification auprès de l''ACONOQ.', 'fas fa-file-alt', '#', 1),
('Analyse', 'Notre équipe analyse votre demande et définit les exigences applicables.', 'fas fa-search', '#', 2),
('Évaluation', 'Réalisation des évaluations et vérifications nécessaires.', 'fas fa-check-double', '#', 3),
('Certification', 'Délivrance du certificat de conformité ou du label NCGO.', 'fas fa-award', '#', 4),
('Suivi', 'Suivi continu pour maintenir la conformité de vos produits et services.', 'fas fa-chart-line', '#', 5)
ON CONFLICT DO NOTHING;

-- 7. PAGE SECTIONS
INSERT INTO page_sections (page_slug, section_key, badge, title, icon_class, content, ordre) VALUES
('a-propos', 'presentation', NULL, 'Présentation', 'fas fa-building', '{"paragraphs": ["L''ACONOQ, Agence Congolaise de Normalisation et de la Qualité, est un établissement public à caractère administratif, doté de la personnalité morale et de l''autonomie financière, créée par la Loi n°19-2015 du 10 août 2015.", "Elle est placée sous la tutelle du Gouvernement de la République du Congo et a pour mission de mettre en œuvre la politique nationale en matière de normalisation, de métrologie, de qualité et de conformité des produits."]}'::jsonb, 1),
('a-propos', 'missions', 'Nos Missions', 'Missions de l''ACONOQ', 'fas fa-bullseye', '{"items": ["Élaborer et publier les normes nationales congolaises (NCGO)", "Assurer la promotion de la qualité des produits et services", "Mettre en œuvre le Programme Congolais d''Évaluation de la Conformité (PCEC)", "Développer les infrastructures de métrologie au Congo", "Former et certifier les acteurs du système national de qualité", "Accompagner les entreprises dans la mise en place de systèmes de management de la qualité", "Veiller à la conformité des produits importés et exportés", "Promouvoir l''adoption des normes dans tous les secteurs économiques", "Contribuer à l''harmonisation des normes au niveau régional et international"]}'::jsonb, 2),
('directeur', 'message', 'Message officiel', 'Jean Jacques NGOKO MOUYABI', 'fas fa-user-tie', '{"name": "Jean Jacques NGOKO MOUYABI", "role": "Directeur Général de l''ACONOQ", "photo_url": "https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/dg2-scaled.png", "paragraphs": ["Dans un monde où les économies sont de plus en plus interconnectées, les échanges commerciaux internationaux en augmentation constante et, plus proche de nous avec l''avènement de la zone de libre-échange continentale (ZELCAF), les problématiques liées à la norme, à la qualité, à la certification et à la métrologie sont de plus en plus au cœur de toutes les activités économiques.", "Le Congo notre pays n''est pas en marge de cette dynamique, c''est pourquoi, le Gouvernement a depuis 2015 mis en place un cadre législatif et règlementaire pour construire pas à pas son système national de normalisation et de gestion de la qualité.", "L''ACONOQ, mesurant sa responsabilité dans la construction dudit système met tout en œuvre pour créer des bases sereines d''une véritable culture qualité dans notre pays.", "Elle accompagnera, formera, incitera tous les acteurs du système national de normalisation et de gestion de la qualité à considérer la qualité et la norme comme un levier incontournable.", "La normalisation doit être un outil de modernisation et de développement de l''économie nationale."], "signature_name": "Jean Jacques NGOKO MOUYABI", "signature_title": "Directeur Général", "signature_org": "Agence Congolaise de Normalisation et de la Qualité"}'::jsonb, 1),
('normalisation', 'definition', NULL, 'Qu''est-ce que la normalisation ?', 'fas fa-book', '{"paragraphs": ["La normalisation est l''activité qui consiste à établir, face à des besoins réels ou pressentis, des règles et des caractéristiques techniques applicables à un objet donné, en vue d''obtenir un niveau d''organisation et de qualité donné.", "Elle vise à améliorer la sécurité des produits, à promouvoir le commerce, à protéger les consommateurs et l''environnement, et à faciliter l''interopérabilité des systèmes et des produits."]}'::jsonb, 1),
('normalisation', 'norme', NULL, 'Qu''est-ce qu''une norme ?', 'fas fa-file-contract', '{"paragraphs": ["Une norme est un document technique établi par consensus et approuvé par un organisme reconnu, qui fournit des règles, des lignes directrices ou des caractéristiques pour des activités ou leurs résultats.", "Les normes peuvent être nationales (NCGO), régionales ou internationales (ISO, IEC) et couvrent tous les secteurs d''activité économique."]}'::jsonb, 2),
('normalisation', 'activites', 'Activités', 'Activités de la normalisation au Congo', 'fas fa-list-check', '{"items": ["Élaboration et révision des normes nationales NCGO", "Participation aux travaux de normalisation internationale (ISO, ARSO)", "Sensibilisation et formation des acteurs économiques", "Publication et diffusion des normes", "Gestion des comités techniques et comités miroirs", "Application des normes rendues obligatoires par voie réglementaire"]}'::jsonb, 4),
('metrologie', 'definition', NULL, 'Définition', 'fas fa-ruler-combined', '{"paragraphs": ["La métrologie est la science de la mesure. Elle comprend tous les aspects théoriques et pratiques de la mesure, quelle que soit l''incertitude de mesure et le domaine d''application.", "Elle joue un rôle essentiel dans le commerce, la santé, la sécurité, l''environnement et la recherche scientifique."], "list_title": "La métrologie se décline en trois types :", "list_items": ["Métrologie scientifique : recherche et développement de nouvelles méthodes de mesure", "Métrologie légale : réglementation des mesures pour protéger le consommateur", "Métrologie industrielle : contrôle qualité en production"]}'::jsonb, 1),
('metrologie', 'importance', 'Pourquoi', 'L''importance de la métrologie', 'fas fa-balance-scale', '{"description": "Sans métrologie, il est impossible de garantir l''exactitude et la fiabilité des mesures. C''est pourquoi l''ACONOQ met en place une infrastructure métrologique nationale pour assurer la traçabilité des mesures et la confiance dans les résultats."}'::jsonb, 2),
('metrologie', 'missions', 'Missions', 'Missions de la métrologie', 'fas fa-tasks', '{"items": ["Mettre en place et gérer les étalons nationaux de mesure", "Assurer la traçabilité métrologique des instruments de mesure", "Effectuer les vérifications et étalonnages des instruments", "Contrôler les instruments de mesure sur le marché", "Former les techniciens en métrologie"]}'::jsonb, 4),
('qualite', 'definition', NULL, 'Qu''est-ce que la qualité ?', 'fas fa-gem', '{"paragraphs": ["La qualité est l''ensemble des caractéristiques d''un ensemble d''entités qui lui confère la capacité de satisfaire des besoins exprimés et implicites. Elle concerne aussi bien les produits que les services.", "La promotion de la qualité vise à améliorer la compétitivité des entreprises congolaises et à renforcer la confiance des consommateurs dans les produits et services nationaux."]}'::jsonb, 1),
('qualite', 'demarche', NULL, 'Pourquoi une démarche qualité ?', 'fas fa-question-circle', '{"paragraphs": ["Une démarche qualité permet à une organisation de structurer ses actions pour améliorer en permanence la satisfaction de ses clients et parties prenantes.", "Elle conduit à une meilleure organisation, une réduction des coûts, une amélioration de la productivité et une renommée accrue sur le marché."]}'::jsonb, 2),
('conformite', 'presentation', 'Présentation', 'L''évaluation de la conformité', 'fas fa-certificate', '{"description": "L''ACONOQ évalue la conformité des produits, procédés et services aux exigences des normes et réglementations applicables.", "services": [{"name": "Certification", "icon": "fas fa-check-circle"}, {"name": "Inspection", "icon": "fas fa-search"}, {"name": "Essais", "icon": "fas fa-flask"}]}'::jsonb, 1),
('conformite', 'missions', 'Missions', 'Ses missions', 'fas fa-bullseye', '{"items": ["Certifier la conformité des produits aux normes NCGO", "Réaliser des inspections et des essais de conformité", "Délivrer les certificats de conformité", "Assurer le suivi post-certification", "Promouvoir la marque nationale de conformité NCGO", "Accompagner les entreprises dans le processus de certification", "Veiller à l''application des normes rendues obligatoires", "Contribuer à la réduction des pratiques de non-conformité"]}'::jsonb, 2),
('conformite', 'ncgo', 'Marque', 'La marque nationale de conformité NCGO', 'fas fa-award', '{"paragraphs": ["La marque nationale de conformité NCGO est un signe de confiance attestant qu''un produit satisfait aux exigences des normes congolaises.", "Elle permet aux consommateurs d''identifier les produits de qualité et encourage les entreprises à améliorer leur niveau de conformité."], "highlight": "Les produits certifiés portent la marque NCGO sur leur emballage, preuve de leur conformité aux normes nationales."}'::jsonb, 5),
('pcec', 'presentation', NULL, 'Présentation du PCEC', 'fas fa-shield-alt', '{"paragraphs": ["Le Programme Congolais d''Évaluation de la Conformité (PCEC) est un dispositif national mis en place par l''ACONOQ pour garantir que les produits importés en République du Congo sont conformes aux normes et réglementations techniques applicables.", "Le PCEC vise à protéger les consommateurs, l''environnement et l''économie nationale contre les produits non conformes."]}'::jsonb, 1),
('pcec', 'documents', 'Documents', 'Les documents du PCEC', 'fas fa-file-alt', '{"cards": [{"title": "Certificat de Conformité (CoC)", "description": "Document officiel attestant la conformité du produit aux normes applicables, délivré après évaluation réussie.", "icon": "fas fa-certificate", "color": "primary"}, {"title": "Rapport de Non-Conformité (RnC)", "description": "Document établi lorsqu''un produit ne répond pas aux exigences normatives, détaillant les non-conformités constatées.", "icon": "fas fa-exclamation-triangle", "color": "red"}]}'::jsonb, 5)
ON CONFLICT (page_slug, section_key) DO UPDATE SET content = EXCLUDED.content, updated_at = now();

-- 8. CARD GRIDS
INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_icon, card_number, ordre) VALUES
('normalisation', 'typologies', 'Normes internationales', 'Élaborées par les organismes internationaux comme l''ISO et l''IEC.', 'fas fa-globe', NULL, 1),
('normalisation', 'typologies', 'Normes régionales', 'Élaborées au niveau régional par des organismes comme l''ARSO.', 'fas fa-map', NULL, 2),
('normalisation', 'typologies', 'Normes nationales (NCGO)', 'Normes congolaises élaborées par l''ACONOQ, adaptées aux besoins locaux.', 'fas fa-flag', NULL, 3),
('normalisation', 'typologies', 'Normes d''entreprise', 'Normes internes adoptées par les entreprises pour améliorer leur performance.', 'fas fa-building', NULL, 4),
('metrologie', 'types', 'Métrologie scientifique', 'Recherche et développement de nouvelles méthodes de mesure.', 'fas fa-flask', NULL, 1),
('metrologie', 'types', 'Métrologie légale', 'Réglementation des mesures pour protéger le consommateur.', 'fas fa-gavel', NULL, 2),
('metrologie', 'types', 'Métrologie industrielle', 'Contrôle qualité en production et étalonnage des instruments.', 'fas fa-industry', NULL, 3),
('metrologie', 'roles', 'Étalonnage', 'Vérification et ajustement des instruments de mesure.', 'fas fa-sync-alt', NULL, 1),
('metrologie', 'roles', 'Vérification', 'Contrôle de conformité des instruments aux exigences réglementaires.', 'fas fa-clipboard-check', NULL, 2),
('metrologie', 'roles', 'Certification', 'Délivrance de certificats d''étalonnage et de conformité.', 'fas fa-certificate', NULL, 3),
('metrologie', 'roles', 'Formation', 'Formation des techniciens aux bonnes pratiques métrologiques.', 'fas fa-graduation-cap', NULL, 4),
('metrologie', 'roles', 'Contrôle', 'Contrôle des instruments de mesure sur le marché.', 'fas fa-search', NULL, 5),
('qualite', 'apports', 'Compétitivité', 'Les produits de qualité sont plus compétitifs sur le marché.', 'fas fa-trophy', NULL, 1),
('qualite', 'apports', 'Confiance', 'La qualité renforce la confiance des consommateurs.', 'fas fa-handshake', NULL, 2),
('qualite', 'apports', 'Réduction des coûts', 'La démarche qualité réduit les coûts liés aux non-conformités.', 'fas fa-chart-line', NULL, 3),
('qualite', 'apports', 'Innovation', 'La qualité encourage l''innovation et l''amélioration continue.', 'fas fa-lightbulb', NULL, 4),
('qualite', 'apports', 'Accès aux marchés', 'Les certifications facilitent l''accès aux marchés internationaux.', 'fas fa-door-open', NULL, 5),
('conformite', 'activites', 'Audits de certification', 'Évaluation complète du système de management.', 'fas fa-clipboard-check', NULL, 1),
('conformite', 'activites', 'Essais de conformité', 'Tests et vérifications techniques pour confirmer la conformité.', 'fas fa-flask', NULL, 2),
('conformite', 'activites', 'Inspections', 'Vérification sur site de la conformité des produits.', 'fas fa-search', NULL, 3),
('conformite', 'activites', 'Formation', 'Formation des acteurs aux exigences de conformité.', 'fas fa-graduation-cap', NULL, 4),
('conformite', 'activites', 'Conseil technique', 'Accompagnement pour la mise en conformité des produits.', 'fas fa-user-tie', NULL, 5),
('conformite', 'activites', 'Marque NCGO', 'Gestion de la marque nationale de conformité NCGO.', 'fas fa-award', NULL, 6),
('pcec', 'enjeux', 'Protection des consommateurs', 'Garantir que les produits importés sont sûrs.', 'fas fa-shield-alt', NULL, 1),
('pcec', 'enjeux', 'Protection de l''environnement', 'Empêcher l''importation de produits nocifs.', 'fas fa-leaf', NULL, 2),
('pcec', 'enjeux', 'Sécurité publique', 'Les produits dangereux doivent respecter les exigences.', 'fas fa-exclamation-triangle', NULL, 3),
('pcec', 'enjeux', 'Loyauté commerciale', 'Éliminer les produits frauduleux.', 'fas fa-balance-scale', NULL, 4),
('pcec', 'administrations', 'ACONOQ', 'Agence Congolaise de Normalisation et de la Qualité.', 'fas fa-building', NULL, 1),
('pcec', 'administrations', 'Douanes', 'Direction Générale des Douanes.', 'fas fa-passport', NULL, 2),
('pcec', 'administrations', 'Ministère du Commerce', 'Ministère chargé du Commerce.', 'fas fa-landmark', NULL, 3),
('pcec', 'administrations', 'CNAC', 'Commission Nationale d''Accréditation.', 'fas fa-certificate', NULL, 4)
ON CONFLICT DO NOTHING;

-- 9. PRINCIPES
INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_number, ordre) VALUES
('normalisation', 'principes', 'Consensus', 'Les normes sont établies par consensus.', '1', 1),
('normalisation', 'principes', 'Efficacité', 'Les processus sont efficaces et adaptés.', '2', 2),
('normalisation', 'principes', 'Ouverture', 'Les travaux sont ouvertes à toutes les parties.', '3', 3),
('normalisation', 'principes', 'Impartialité', 'Toutes les parties sont traitées équitablement.', '4', 4),
('normalisation', 'principes', 'Réseautage', 'La normalisation favorise le partenariat.', '5', 5),
('normalisation', 'principes', 'Cohérence', 'Les normes sont cohérentes entre elles.', '6', 6),
('normalisation', 'principes', 'Flexibilité', 'Les normes s''adaptent aux évolutions.', '7', 7),
('normalisation', 'principes', 'Transparence', 'Les processus sont transparents.', '8', 8),
('normalisation', 'principes', 'Volontariat', 'L''application est généralement volontaire.', '9', 9),
('normalisation', 'principes', 'Développement durable', 'Les normes intègrent les enjeux environnementaux.', '10', 10)
ON CONFLICT DO NOTHING;

-- 10. FAQ
INSERT INTO faq_items (page_slug, question, answer, icon_class, ordre) VALUES
('boutique', 'Comment accéder au catalogue de normes ?', 'Consultez notre catalogue en ligne ou contactez-nous pour les documents officiels.', 'fas fa-book', 1),
('boutique', 'Quels types de normes sont disponibles ?', 'Notre catalogue couvre les normes NCGO, ISO et ARSO dans tous les secteurs.', 'fas fa-list', 2),
('boutique', 'Comment télécharger les documents ?', 'Créez un compte, sélectionnez les normes et téléchargez après validation.', 'fas fa-download', 3),
('boutique', 'Modes de paiement acceptés ?', 'Virements bancaires, Mobile Money et carte bancaire.', 'fas fa-credit-card', 4)
ON CONFLICT DO NOTHING;

-- 11. CERTIFICATION STEPS
INSERT INTO certification_steps (step_number, title, description, ordre) VALUES
(1, 'Demande de certification', 'Déposez votre demande auprès de l''ACONOQ.', 1),
(2, 'Évaluation initiale', 'Analyse et planification de l''audit.', 2),
(3, 'Audit de certification', 'Vérification de conformité sur site.', 3),
(4, 'Décision', 'Examen des résultats et délivrance du certificat.', 4),
(5, 'Suivi post-certification', 'Audits de surveillance réguliers.', 5)
ON CONFLICT DO NOTHING;

-- 12. PCEC EXCEPTIONS
INSERT INTO pcec_exceptions (title, intro_text, items) VALUES
('Produits concernés par le PCEC', 'Les produits suivants sont soumis à l''évaluation de conformité :', '["Équipements électriques et électroniques", "Produits alimentaires et boissons", "Médicaments et produits pharmaceutiques", "Jouets et articles pour enfants", "Textiles et vêtements", "Pièces détachées automobiles", "Machines et équipements industriels", "Matériaux de construction", "Produits chimiques et dangereux", "Équipements de télécommunication", "Mobilier et articles ménagers", "Équipements de protection individuelle (EPI)", "Instruments de mesure", "Équipements médicaux", "Produits cosmétiques et d''hygiène", "Éclairage et luminaires", "Moteurs et alternateurs", "Pompes et compresseurs", "Réfrigérateurs et climatiseurs", "Appareils de cuisson", "Articles en plastique et caoutchouc"]'::jsonb)
ON CONFLICT DO NOTHING;

-- 13. CONTACT INFO
INSERT INTO contact_info (info_type, icon_class, title, value, link, ordre) VALUES
('address', 'fas fa-map-marker-alt', 'Adresse', '10, Impasse Jean-Marie NIABIA, Quartier OCH, Brazzaville', NULL, 1),
('phone', 'fas fa-phone', 'Téléphone', '+242 04 404 6270', 'tel:+242044046270', 2),
('email', 'fas fa-envelope', 'Email', 'contact@aconoq.cg', 'mailto:contact@aconoq.cg', 3)
ON CONFLICT DO NOTHING;

-- 14. SCHEDULE
INSERT INTO schedule (days, hours, status, ordre) VALUES
('Lundi - Vendredi', '8:00 - 17:00', 'Ouvert', 1),
('Samedi - Dimanche', 'Fermé', 'Fermé', 2)
ON CONFLICT DO NOTHING;

-- 15. ADVANTAGES
INSERT INTO advantages (page_slug, title, description, icon_class, ordre) VALUES
('boutique', 'Accès rapide', 'Téléchargez vos normes en quelques clics, 24h/24.', 'fas fa-bolt', 1),
('boutique', 'Documents officiels', 'Tous les documents sont les versions officielles de l''ACONOQ.', 'fas fa-file-alt', 2),
('boutique', 'Paiement sécurisé', 'Transactions sécurisées par Mobile Money, carte bancaire ou virement.', 'fas fa-lock', 3),
('boutique', 'Support client', 'Une équipe d''assistance disponible pour vous accompagner.', 'fas fa-headset', 4)
ON CONFLICT DO NOTHING;

-- 16. HOW IT WORKS
INSERT INTO how_it_works (page_slug, step_number, title, description, icon_class, ordre) VALUES
('boutique', 1, 'Choisissez vos normes', 'Parcourez le catalogue et sélectionnez les normes dont vous avez besoin.', 'fas fa-search', 1),
('boutique', 2, 'Ajoutez au panier', 'Ajoutez les documents sélectionnés à votre panier.', 'fas fa-shopping-cart', 2),
('boutique', 3, 'Procédez au paiement', 'Choisissez votre mode de paiement et validez votre commande.', 'fas fa-credit-card', 3),
('boutique', 4, 'Téléchargez', 'Accédez immédiatement à vos documents téléchargeables.', 'fas fa-download', 4)
ON CONFLICT DO NOTHING;
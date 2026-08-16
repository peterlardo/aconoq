-- ============================================
-- ACONOQ - Insertion événements et actualités réels
-- Depuis les sources web (LinkedIn, presse, etc.)
-- Exécuter dans l'éditeur SQL de Supabase
-- ============================================

-- ============================================
-- ÉVÉNEMENTS
-- ============================================

INSERT INTO evenements (titre, description, date_debut, date_fin, lieu, type_event, image_url) VALUES

-- 1. Webinaire Certification des produits
(
  'Webinaire : Certification des produits – Défis et opportunités',
  'Le 06 juillet 2026, l''ACONOQ a organisé un webinaire sur la certification des produits. Plus de 60 participants – entrepreneurs, industriels, responsables qualité et acteurs institutionnels – ont pris part à cette rencontre virtuelle animée par M. NGAMELLA Delbert Hermann, Directeur de l''Évaluation de la Conformité. Les échanges ont mis en lumière les enjeux stratégiques de la certification, les opportunités d''accès aux marchés et le rôle de la certification comme levier de confiance et qualité.',
  '2026-07-06 13:00:00+01',
  '2026-07-06 14:00:00+01',
  'En ligne (Zoom)',
  'webinaire',
  'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 2. Webinaire Procédure de Certification
(
  'Webinaire : La Procédure de Certification',
  'Session dédiée aux entrepreneurs, producteurs et artisans sur la procédure de certification, de la demande à l''octroi du certificat. Les étapes clés y ont été détaillées : préparation technique, demande, audits, analyses au laboratoire, revue de l''évaluation, décision et surveillance.',
  '2026-07-22 13:00:00+01',
  '2026-07-22 14:00:00+01',
  'En ligne (Zoom) – Brazzaville',
  'webinaire',
  'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 3. Atelier multi-acteurs cuisson propre
(
  'Atelier multi-acteurs : Solutions de cuisson propres',
  'Le 27 mai 2026, un atelier multi-acteurs soutenu par l''Union européenne et le programme EnDev/GETtransform a réuni à Brazzaville des institutions publiques, producteurs de foyers améliorés, acteurs de la finance et ONG pour promouvoir des solutions de cuisson plus propres et plus durables pour les ménages congolais.',
  '2026-05-27 09:00:00+01',
  '2026-05-27 17:00:00+01',
  'Brazzaville',
  'atelier',
  'https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 4. Forum Partenariat UDSN – Monde du Travail
(
  'Forum sur le Partenariat UDSN – Monde du Travail',
  'Du 2 au 4 février 2026 à Kintelé, experts, enseignants et professionnels ont réfléchi à des solutions pour renforcer l''adéquation entre la formation universitaire et les exigences du marché de l''emploi. L''ACONOQ a participé activement à ce cadre d''échanges dédié au rapprochement entre la formation et le monde professionnel.',
  '2026-02-02 09:00:00+01',
  '2026-02-04 17:00:00+01',
  'Kintelé, Congo',
  'forum',
  'https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 5. 12e Compétition Continentale de la Normalisation
(
  '12e Compétition Continentale de la Normalisation',
  'L''ACONOQ a organisé la 12e édition de la Compétition Continentale de la Normalisation, mettant en lumière le talent et la créativité de jeunes étudiants congolais passionnés par les enjeux de la normalisation. Dix lauréats ont été primés pour leurs idées novatrices et leur engagement remarquable.',
  '2025-05-20 09:00:00+01',
  '2025-05-20 17:00:00+01',
  'Brazzaville',
  'competition',
  'https://images.pexels.com/photos/3184649/pexels-photo-3184649.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 6. 6e Journée Nationale / 16e Journée Mondiale de la Qualité
(
  '16e Journée Mondiale / 6e Journée Nationale de la Qualité',
  'Organisée en novembre 2025 sous le thème « Partenariats pour les Objectifs de Développement durable », cette double célébration a réuni les acteurs du Système National de Normalisation et de Gestion de la Qualité. Conférences, ateliers pratiques, tables rondes et expositions ont été proposés.',
  '2025-11-14 09:00:00+01',
  '2025-11-15 17:00:00+01',
  'Brazzaville',
  'journée_qualité',
  'https://images.pexels.com/photos/3184300/pexels-photo-3184300.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 7. Formation artisans, PME et TPME
(
  'Programme de formation et sensibilisation artisans, PME et TPME',
  'De septembre à novembre 2025, l''ACONOQ a déployé un programme de formation à travers le Congo sur les fondamentaux de la qualité, les bonnes pratiques d''hygiène et de fabrication, la gestion documentaire et la gestion des risques. Les sessions se sont tenues à Pointe-Noire et Brazzaville.',
  '2025-09-01 08:00:00+01',
  '2025-11-14 17:00:00+01',
  'Pointe-Noire & Brazzaville',
  'formation',
  'https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=800'
),

-- 8. Table ronde préparatoire Journée Qualité 2025
(
  'Table ronde – Préparation Journée Qualité 2025',
  'Le 25 mars 2025, l''ACONOQ a réuni les parties prenantes du Système National de Normalisation pour une table ronde dédiée à la préparation de la 6e Journée Nationale et 16e Journée Mondiale de la Qualité. Le DG Jean-Jacques Ngoko Mouyabi a présidé les échanges sur le thème, le format et la stratégie de communication.',
  '2025-03-25 09:00:00+01',
  '2025-03-25 17:00:00+01',
  'Brazzaville – Siège ACONOQ',
  'table_ronde',
  'https://images.pexels.com/photos/3184464/pexels-photo-3184464.jpeg?auto=compress&cs=tinysrgb&w=800'
);


-- ============================================
-- ACTUALITÉS
-- ============================================

INSERT INTO actualites (titre, contenu, image_url, categorie, date_pub, auteur) VALUES

-- 1. TÜV Rheinland autorisé pour le PCEC
(
  'TÜV Rheinland autorisé par l''ACONOQ pour le PCEC',
  'À compter du 15 juillet 2026, TÜV Rheinland a été officiellement autorisé par l''ACONOQ à fournir des services d''évaluation de la conformité dans le cadre du PCEC. Cette autorisation fait suite au retrait de Bureau Veritas des programmes gouvernementaux de vérification de la conformité en Afrique et au Moyen-Orient. TÜV Rheinland rejoint Cotecna Inspection SA comme prestataire technique du programme. Entre mai 2022 et juin 2026, plus de 42 830 certificats de conformité ont été délivrés. La digitalisation complète du processus de certification est également annoncée depuis le 1er août 2026.',
  'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
  'PCEC',
  '2026-07-28 00:00:00+01',
  'Journal de Brazza'
),

-- 2. Cotecna à la Journée Mondiale des Normes 2025
(
  'Cotecna participe à la Journée Mondiale des Normes 2025',
  'Le 14 octobre 2025, Cotecna a participé en tant que sponsor à l''événement de la Journée Mondiale des Normes 2025 organisé par l''ACONOQ à Brazzaville. Sous le thème « A Shared Vision for a Better World: Partnerships for the Goals », l''événement a mis en avant comment les standards contribuent à renforcer la compétitivité des entreprises, améliorer la protection des consommateurs et faciliter les échanges commerciaux dans le cadre de la ZLECAf.',
  'https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?auto=compress&cs=tinysrgb&w=800',
  'Qualité',
  '2025-10-27 00:00:00+01',
  'Cotecna'
),

-- 3. Cotecna amendement contrat PCEC
(
  'Cotecna et l''ACONOQ signent un amendement au contrat PCEC',
  'Cotecna a annoncé la signature d''un amendement au contrat PCEC avec l''ACONOQ pour renforcer le contrôle de conformité des produits importés en République du Congo. Cette prolongation du mandat confirme la confiance placée en Cotecna par l''ACONOQ et le gouvernement congolais, et consolide un partenariat fondé sur le respect mutuel et la coopération technique.',
  'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=800',
  'PCEC',
  '2025-07-10 00:00:00+01',
  'Cotecna'
),

-- 4. Séminaire traçabilité des médicaments
(
  'Séminaire sur la lutte contre le commerce illicite des médicaments',
  'L''ACONOQ a organisé un séminaire d''échange sur les solutions de marquage et de traçabilité des produits pharmaceutiques, visant à lutter contre le commerce illicite des médicaments au Congo. Les participants se sont imprégnés des mécanismes permettant de tracer et d''authentifier les médicaments tout au long de la chaîne d''approvisionnement.',
  'https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=800',
  'Séminaire',
  '2024-06-27 00:00:00+01',
  'Journal de Brazza'
),

-- 5. Atelier multi-acteurs cuisson propre
(
  'L''ACONOQ participe à l''atelier multi-acteurs sur les solutions de cuisson propres',
  'Le 27 mai 2026, l''ACONOQ a participé à un atelier multi-acteurs soutenu par l''Union européenne et le programme GETtransform/EnDev. L''événement a réuni des institutions publiques, des producteurs de foyers améliorés, des acteurs de la finance et des ONG pour promouvoir des solutions de cuisson plus propres et plus durables pour les ménages congolais.',
  'https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=800',
  'Environnement',
  '2026-07-12 00:00:00+01',
  'ACONOQ'
),

-- 6. Forum UDSN Monde du Travail
(
  'L''ACONOQ au Forum Partenariat UDSN – Monde du Travail à Kintelé',
  'Du 2 au 4 février 2026, l''ACONOQ a participé au Forum sur le Partenariat UDSN – Monde du Travail à Kintelé. Cet événement a réuni experts, enseignants et professionnels pour réfléchir à des solutions concrètes renforçant l''adéquation entre la formation universitaire et les exigences du marché de l''emploi.',
  'https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?auto=compress&cs=tinysrgb&w=800',
  'Événement',
  '2026-02-04 00:00:00+01',
  'ACONOQ'
);

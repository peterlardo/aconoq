import json, shutil

def j(obj):
    return json.dumps(obj, ensure_ascii=False)

def q(text):
    """Escape single quotes for PostgreSQL"""
    return text.replace("'", "''")

def jsonb_val(obj):
    """Return a jsonb literal safe for SQL (escaped for SQL string)"""
    raw = j(obj)
    return raw.replace("'", "''")

sections_data = []

# a-propos
sections_data.append({
    'page_slug': 'a-propos', 'section_key': 'presentation', 'badge': None,
    'title': 'Présentation', 'icon_class': 'fas fa-building', 'ordre': 1,
    'content': {"paragraphs": [
        "L'ACONOQ, Agence Congolaise de Normalisation et de la Qualité, est un établissement public à caractère administratif, doté de la personnalité morale et de l'autonomie financière, créée par la Loi n°19-2015 du 10 août 2015.",
        "Elle est placée sous la tutelle du Gouvernement de la République du Congo et a pour mission de mettre en œuvre la politique nationale en matière de normalisation, de métrologie, de qualité et de conformité des produits."
    ]}
})
sections_data.append({
    'page_slug': 'a-propos', 'section_key': 'missions', 'badge': 'Nos Missions',
    'title': 'Missions de l\'ACONOQ', 'icon_class': 'fas fa-bullseye', 'ordre': 2,
    'content': {"items": [
        "Élaborer et publier les normes nationales congolaises (NCGO)",
        "Assurer la promotion de la qualité des produits et services",
        "Mettre en œuvre le Programme Congolais d'Évaluation de la Conformité (PCEC)",
        "Développer les infrastructures de métrologie au Congo",
        "Former et certifier les acteurs du système national de qualité",
        "Accompagner les entreprises dans la mise en place de systèmes de management de la qualité",
        "Veiller à la conformité des produits importés et exportés",
        "Promouvoir l'adoption des normes dans tous les secteurs économiques",
        "Contribuer à l'harmonisation des normes au niveau régional et international"
    ]}
})
sections_data.append({
    'page_slug': 'directeur', 'section_key': 'message', 'badge': 'Message officiel',
    'title': 'Jean Jacques NGOKO MOUYABI', 'icon_class': 'fas fa-user-tie', 'ordre': 1,
    'content': {"name": "Jean Jacques NGOKO MOUYABI", "role": "Directeur Général de l'ACONOQ",
        "photo_url": "https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/dg2-scaled.png",
        "paragraphs": [
            "Dans un monde où les économies sont de plus en plus interconnectées, les échanges commerciaux internationaux en augmentation constante et, plus proche de nous avec l'avènement de la zone de libre-échange continentale (ZELCAF), les problématiques liées à la norme, à la qualité, à la certification et à la métrologie sont de plus en plus au cœur de toutes les activités économiques.",
            "Le Congo notre pays n'est pas en marge de cette dynamique, c'est pourquoi, le Gouvernement a depuis 2015 mis en place un cadre législatif et règlementaire pour construire pas à pas son système national de normalisation et de gestion de la qualité.",
            "L'ACONOQ, mesurant sa responsabilité dans la construction dudit système met tout en œuvre pour créer des bases sereines d'une véritable culture qualité dans notre pays.",
            "Elle accompagnera, formera, incitera tous les acteurs du système national de normalisation et de gestion de la qualité à considérer la qualité et la norme comme un levier incontournable.",
            "La normalisation doit être un outil de modernisation et de développement de l'économie nationale."
        ],
        "signature_name": "Jean Jacques NGOKO MOUYABI", "signature_title": "Directeur Général",
        "signature_org": "Agence Congolaise de Normalisation et de la Qualité"
    }
})
sections_data.append({
    'page_slug': 'normalisation', 'section_key': 'definition', 'badge': None,
    'title': "Qu'est-ce que la normalisation ?", 'icon_class': 'fas fa-book', 'ordre': 1,
    'content': {"paragraphs": [
        "La normalisation est l'activité qui consiste à établir, face à des besoins réels ou pressentis, des règles et des caractéristiques techniques applicables à un objet donné, en vue d'obtenir un niveau d'organisation et de qualité donné.",
        "Elle vise à améliorer la sécurité des produits, à promouvoir le commerce, à protéger les consommateurs et l'environnement, et à faciliter l'interopérabilité des systèmes et des produits."
    ]}
})
sections_data.append({
    'page_slug': 'normalisation', 'section_key': 'norme', 'badge': None,
    'title': "Qu'est-ce qu'une norme ?", 'icon_class': 'fas fa-file-contract', 'ordre': 2,
    'content': {"paragraphs": [
        "Une norme est un document technique établi par consensus et approuvé par un organisme reconnu, qui fournit des règles, des lignes directrices ou des caractéristiques pour des activités ou leurs résultats.",
        "Les normes peuvent être nationales (NCGO), régionales ou internationales (ISO, IEC) et couvrent tous les secteurs d'activité économique."
    ]}
})
sections_data.append({
    'page_slug': 'normalisation', 'section_key': 'activites', 'badge': 'Activités',
    'title': 'Activités de la normalisation au Congo', 'icon_class': 'fas fa-list-check', 'ordre': 4,
    'content': {"items": [
        "Élaboration et révision des normes nationales NCGO",
        "Participation aux travaux de normalisation internationale (ISO, ARSO)",
        "Sensibilisation et formation des acteurs économiques",
        "Publication et diffusion des normes",
        "Gestion des comités techniques et comités miroirs",
        "Application des normes rendues obligatoires par voie réglementaire"
    ]}
})
sections_data.append({
    'page_slug': 'metrologie', 'section_key': 'definition', 'badge': None,
    'title': 'Définition', 'icon_class': 'fas fa-ruler-combined', 'ordre': 1,
    'content': {"paragraphs": [
        "La métrologie est la science de la mesure. Elle comprend tous les aspects théoriques et pratiques de la mesure, quelle que soit l'incertitude de mesure et le domaine d'application.",
        "Elle joue un rôle essentiel dans le commerce, la santé, la sécurité, l'environnement et la recherche scientifique."
    ], "list_title": "La métrologie se décline en trois types :",
    "list_items": [
        "Métrologie scientifique : recherche et développement de nouvelles méthodes de mesure",
        "Métrologie légale : réglementation des mesures pour protéger le consommateur",
        "Métrologie industrielle : contrôle qualité en production"
    ]}
})
sections_data.append({
    'page_slug': 'metrologie', 'section_key': 'importance', 'badge': 'Pourquoi',
    'title': "L'importance de la métrologie", 'icon_class': 'fas fa-balance-scale', 'ordre': 2,
    'content': {"description": "Sans métrologie, il est impossible de garantir l'exactitude et la fiabilité des mesures. C'est pourquoi l'ACONOQ met en place une infrastructure métrologique nationale pour assurer la traçabilité des mesures et la confiance dans les résultats."}
})
sections_data.append({
    'page_slug': 'metrologie', 'section_key': 'missions', 'badge': 'Missions',
    'title': 'Missions de la métrologie', 'icon_class': 'fas fa-tasks', 'ordre': 4,
    'content': {"items": [
        "Mettre en place et gérer les étalons nationaux de mesure",
        "Assurer la traçabilité métrologique des instruments de mesure",
        "Effectuer les vérifications et étalonnages des instruments",
        "Contrôler les instruments de mesure sur le marché",
        "Former les techniciens en métrologie"
    ]}
})
sections_data.append({
    'page_slug': 'qualite', 'section_key': 'definition', 'badge': None,
    'title': "Qu'est-ce que la qualité ?", 'icon_class': 'fas fa-gem', 'ordre': 1,
    'content': {"paragraphs": [
        "La qualité est l'ensemble des caractéristiques d'un ensemble d'entités qui lui confère la capacité de satisfaire des besoins exprimés et implicites. Elle concerne aussi bien les produits que les services.",
        "La promotion de la qualité vise à améliorer la compétitivité des entreprises congolaises et à renforcer la confiance des consommateurs dans les produits et services nationaux."
    ]}
})
sections_data.append({
    'page_slug': 'qualite', 'section_key': 'demarche', 'badge': None,
    'title': 'Pourquoi une démarche qualité ?', 'icon_class': 'fas fa-question-circle', 'ordre': 2,
    'content': {"paragraphs": [
        "Une démarche qualité permet à une organisation de structurer ses actions pour améliorer en permanence la satisfaction de ses clients et parties prenantes.",
        "Elle conduit à une meilleure organisation, une réduction des coûts, une amélioration de la productivité et une renommée accrue sur le marché."
    ]}
})
sections_data.append({
    'page_slug': 'conformite', 'section_key': 'presentation', 'badge': 'Présentation',
    'title': "L'évaluation de la conformité", 'icon_class': 'fas fa-certificate', 'ordre': 1,
    'content': {"description": "L'ACONOQ évalue la conformité des produits, procédés et services aux exigences des normes et réglementations applicables.",
        "services": [{"name": "Certification", "icon": "fas fa-check-circle"}, {"name": "Inspection", "icon": "fas fa-search"}, {"name": "Essais", "icon": "fas fa-flask"}]
    }
})
sections_data.append({
    'page_slug': 'conformite', 'section_key': 'missions', 'badge': 'Missions',
    'title': 'Ses missions', 'icon_class': 'fas fa-bullseye', 'ordre': 2,
    'content': {"items": [
        "Certifier la conformité des produits aux normes NCGO",
        "Réaliser des inspections et des essais de conformité",
        "Délivrer les certificats de conformité",
        "Assurer le suivi post-certification",
        "Promouvoir la marque nationale de conformité NCGO",
        "Accompagner les entreprises dans le processus de certification",
        "Veiller à l'application des normes rendues obligatoires",
        "Contribuer à la réduction des pratiques de non-conformité"
    ]}
})
sections_data.append({
    'page_slug': 'conformite', 'section_key': 'ncgo', 'badge': 'Marque',
    'title': 'La marque nationale de conformité NCGO', 'icon_class': 'fas fa-award', 'ordre': 5,
    'content': {"paragraphs": [
        "La marque nationale de conformité NCGO est un signe de confiance attestant qu'un produit satisfait aux exigences des normes congolaises.",
        "Elle permet aux consommateurs d'identifier les produits de qualité et encourage les entreprises à améliorer leur niveau de conformité."
    ], "highlight": "Les produits certifiés portent la marque NCGO sur leur emballage, preuve de leur conformité aux normes nationales."}
})
sections_data.append({
    'page_slug': 'pcec', 'section_key': 'presentation', 'badge': None,
    'title': 'Présentation du PCEC', 'icon_class': 'fas fa-shield-alt', 'ordre': 1,
    'content': {"paragraphs": [
        "Le Programme Congolais d'Évaluation de la Conformité (PCEC) est un dispositif national mis en place par l'ACONOQ pour garantir que les produits importés en République du Congo sont conformes aux normes et réglementations techniques applicables.",
        "Le PCEC vise à protéger les consommateurs, l'environnement et l'économie nationale contre les produits non conformes."
    ]}
})
sections_data.append({
    'page_slug': 'pcec', 'section_key': 'documents', 'badge': 'Documents',
    'title': 'Les documents du PCEC', 'icon_class': 'fas fa-file-alt', 'ordre': 5,
    'content': {"cards": [
        {"title": "Certificat de Conformité (CoC)", "description": "Document officiel attestant la conformité du produit aux normes applicables, délivré après évaluation réussie.", "icon": "fas fa-certificate", "color": "primary"},
        {"title": "Rapport de Non-Conformité (RnC)", "description": "Document établi lorsqu'un produit ne répond pas aux exigences normatives, détaillant les non-conformités constatées.", "icon": "fas fa-exclamation-triangle", "color": "red"}
    ]}
})

# Build SQL
lines = []
lines.append("-- ============================================")
lines.append("-- ACONOQ - Seed: All Dynamic Content")
lines.append("-- Run AFTER migrate_dynamic.sql")
lines.append("-- ============================================")
lines.append("")

# 1. SITE SETTINGS
footer_json = jsonb_val({
    'brand_description': "L'Agence congolaise de normalisation et de la qualité est un établissement public à caractère administratif, doté de la personnalité morale et de l'autonomie financière.",
    'logo_url': 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/aconoq_logo_white.png',
    'copyright': '© 2025 ACONOQ - Agence Congolaise de Normalisation et de la Qualité. Tous droits réservés.',
    'social_links': [{'icon': 'fab fa-facebook-f', 'url': '#'}, {'icon': 'fab fa-twitter', 'url': '#'}, {'icon': 'fab fa-instagram', 'url': '#'}, {'icon': 'fab fa-linkedin-in', 'url': '#'}],
    'columns': [
        {'title': 'ACONOQ', 'links': [{'label': 'Actualité et annonces', 'url': '#'}, {'label': 'Présentation des services', 'url': '#'}, {'label': 'Mot du Directeur Général', 'url': 'directeur.html'}, {'label': 'À propos de l\'ACONOQ', 'url': 'a-propos.html'}, {'label': 'Organigramme', 'url': 'organigramme.html'}, {'label': 'Cadre réglementaire', 'url': '#'}]},
        {'title': 'Nos Directions', 'links': [{'label': 'Normalisation', 'url': 'normalisation.html'}, {'label': 'Métrologie', 'url': 'metrologie.html'}, {'label': 'Promotion de la qualité', 'url': 'qualite.html'}, {'label': 'Évaluation de la conformité', 'url': 'conformite.html'}, {'label': 'PCEC', 'url': 'pcec.html'}]},
        {'title': 'Services', 'links': [{'label': 'Audit', 'url': '#'}, {'label': 'Certification', 'url': '#'}, {'label': 'Labelisation', 'url': '#'}, {'label': 'Formations', 'url': '#'}, {'label': 'Marque NCGO', 'url': '#'}, {'label': 'ZLECAF', 'url': '#'}]}
    ],
    'contact': {'address': 'Brazzaville, République du Congo', 'phone': '+1 212 946 2700', 'email': 'contact@aconoq.cg', 'hours': 'Mon - Fri: 9:00 - 18:00'},
    'newsletter': {'title': 'Restez informé', 'description': 'Recevez nos actualités et mise à jour directement dans votre boîte mail.'},
    'legal': [{'label': 'Politique de confidentialité', 'url': 'politique-confidentialite.php'}, {'label': 'Conditions d\'utilisation', 'url': '#'}]
})
lines.append("-- 1. SITE SETTINGS")
lines.append(f"INSERT INTO site_settings (key, value) VALUES ('footer', '{footer_json}'::jsonb)")
lines.append("ON CONFLICT (key) DO UPDATE SET value = EXCLUDED.value, updated_at = now();")
lines.append("")

# 2. PAGE HEROES
heroes = [
    ('a-propos', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/slider11-scaled.png', 'À propos de l\'ACONOQ'),
    ('directeur', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/dg2-scaled.png', 'Mot du Directeur Général'),
    ('organigramme', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/person.png', 'Organigramme'),
    ('normalisation', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/management1.png', 'La Normalisation'),
    ('metrologie', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/09/Image-metrologie-scaled-1.jpeg', 'La Métrologie'),
    ('qualite', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/target.png', 'Promotion de la Qualité'),
    ('conformite', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/certificate.png', 'Évaluation de la Conformité'),
    ('pcec', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/port.png', 'Le PCEC'),
    ('contact', 'https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/transport-logistics-products-scaled.jpg', 'Contactez-nous'),
    ('boutique', 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Boutique NCGO'),
]
lines.append("-- 2. PAGE HEROES")
lines.append("INSERT INTO page_heroes (page_slug, image_url, title, subtitle) VALUES")
vals = [f"('{slug}', '{url}', '{q(title)}', NULL)" for slug, url, title in heroes]
lines.append(",\n".join(vals) + "")
lines.append("ON CONFLICT (page_slug) DO UPDATE SET image_url = EXCLUDED.image_url, title = EXCLUDED.title, updated_at = now();")
lines.append("")

# 3. HERO SLIDES
slides = [
    ('https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Normalisation Congo', 'Agence Congolaise de Normalisation et de la Qualité', 'La mesure précise', 'garantie votre réussite.', 'À propos de nous', 'a-propos.html', 'Nous Contacter', 'contact.html', 1),
    ('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Qualité et Standards', None, 'Excellence & Qualité', 'au service du développement national.', 'Découvrir nos services', '#', 'En savoir plus', 'a-propos.html', 2),
    ('https://images.pexels.com/photos/2310090/pexels-photo-2310090.jpeg?auto=compress&cs=tinysrgb&w=1920', 'PCEC Conformité', None, 'Conformité sans frontières', 'Le PCEC au service de la sécurité des produits.', 'Découvrir le PCEC', 'pcec.html', 'Nous contacter', 'contact.html', 3),
    ('https://images.pexels.com/photos/1108101/pexels-photo-1108101.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Métrologie', None, 'Précision & Mesure', 'La métrologie pour garantir l\'exactitude des mesures.', 'La Métrologie', 'metrologie.html', 'Contactez-nous', 'contact.html', 4),
]
lines.append("-- 3. HERO SLIDES")
lines.append("INSERT INTO hero_slides (image_url, alt_text, badge, title, subtitle, cta1_label, cta1_url, cta2_label, cta2_url, ordre) VALUES")
vals = []
for s in slides:
    badge = 'NULL' if s[2] is None else f"'{q(s[2])}'"
    vals.append(f"('{s[0]}', '{q(s[1])}', {badge}, '{q(s[3])}', '{q(s[4])}', '{q(s[5])}', '{s[6]}', '{q(s[7])}', '{s[8]}', {s[9]})")
lines.append(",\n".join(vals))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 4. SERVICES
services = [
    ('Audit', 'Vérification et contrôle de conformité aux normes nationales et internationales.', 'fas fa-clipboard-check', '#', 1),
    ('Certification', 'Certification des produits, procédés et services conformes aux normes congolaises NCGO.', 'fas fa-certificate', '#', 2),
    ('Labelisation', 'Attribution de labels et marques nationales de conformité aux normes.', 'fas fa-award', '#', 3),
    ('Formations', 'Programmes de formation en normalisation, métrologie et promotion de la qualité.', 'fas fa-graduation-cap', '#', 4),
]
lines.append("-- 4. SERVICES")
lines.append("INSERT INTO services (title, description, icon_class, link_url, ordre) VALUES")
lines.append(",\n".join([f"('{q(s[0])}', '{q(s[1])}', '{s[2]}', '{s[3]}', {s[4]})" for s in services]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 5. BANNERS
banners = [
    ('index', 'https://images.pexels.com/photos/2310090/pexels-photo-2310090.jpeg?auto=compress&cs=tinysrgb&w=1920', 'PCEC', 'Conformité sans frontières', "Le Programme Congolais d'Évaluation de la Conformité garantit la sécurité et la qualité de tous les produits importés en République du Congo.", 'Découvrir le PCEC', 'pcec.html', '[]', 1),
    ('index', 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920', 'Boutique en ligne', 'Achetez vos normes', 'Accédez à notre catalogue de normes et téléchargez les documents officiels directement en ligne.', 'Voir le catalogue', 'boutique.html', '["Consultez le catalogue de normes NCGO","Téléchargez les documents officiels"]', 2),
]
lines.append("-- 5. BANNERS")
lines.append("INSERT INTO banners (page_slug, image_url, badge, title, description, cta1_label, cta1_url, features, ordre) VALUES")
lines.append(",\n".join([f"('{b[0]}', '{b[1]}', '{q(b[2])}', '{q(b[3])}', '{q(b[4])}', '{q(b[5])}', '{b[6]}', '{b[7]}'::jsonb, {b[8]})" for b in banners]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 6. PROCESSUS
processus = [
    ('Demande', "Déposez votre demande de normalisation ou de certification auprès de l'ACONOQ.", 'fas fa-file-alt', '#', 1),
    ('Analyse', "Notre équipe analyse votre demande et définit les exigences applicables.", 'fas fa-search', '#', 2),
    ('Évaluation', 'Réalisation des évaluations et vérifications nécessaires.', 'fas fa-check-double', '#', 3),
    ('Certification', 'Délivrance du certificat de conformité ou du label NCGO.', 'fas fa-award', '#', 4),
    ('Suivi', 'Suivi continu pour maintenir la conformité de vos produits et services.', 'fas fa-chart-line', '#', 5),
]
lines.append("-- 6. PROCESSUS")
lines.append("INSERT INTO processus (title, description, icon_class, link_url, ordre) VALUES")
lines.append(",\n".join([f"('{q(s[0])}', '{q(s[1])}', '{s[2]}', '{s[3]}', {s[4]})" for s in processus]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 7. PAGE SECTIONS
lines.append("-- 7. PAGE SECTIONS")
lines.append("INSERT INTO page_sections (page_slug, section_key, badge, title, icon_class, content, ordre) VALUES")
vals = []
for s in sections_data:
    badge = 'NULL' if s['badge'] is None else f"'{q(s['badge'])}'"
    content_json = jsonb_val(s['content'])
    vals.append(f"('{s['page_slug']}', '{s['section_key']}', {badge}, '{q(s['title'])}', '{s['icon_class']}', '{content_json}'::jsonb, {s['ordre']})")
lines.append(",\n".join(vals))
lines.append("ON CONFLICT (page_slug, section_key) DO UPDATE SET content = EXCLUDED.content, updated_at = now();")
lines.append("")

# 8. CARD GRIDS
grids = [
    ('normalisation', 'typologies', 'Normes internationales', 'Élaborées par les organismes internationaux comme l\'ISO et l\'IEC.', 'fas fa-globe', None, 1),
    ('normalisation', 'typologies', 'Normes régionales', 'Élaborées au niveau régional par des organismes comme l\'ARSO.', 'fas fa-map', None, 2),
    ('normalisation', 'typologies', 'Normes nationales (NCGO)', 'Normes congolaises élaborées par l\'ACONOQ, adaptées aux besoins locaux.', 'fas fa-flag', None, 3),
    ('normalisation', 'typologies', 'Normes d\'entreprise', 'Normes internes adoptées par les entreprises pour améliorer leur performance.', 'fas fa-building', None, 4),
    ('metrologie', 'types', 'Métrologie scientifique', 'Recherche et développement de nouvelles méthodes de mesure.', 'fas fa-flask', None, 1),
    ('metrologie', 'types', 'Métrologie légale', 'Réglementation des mesures pour protéger le consommateur.', 'fas fa-gavel', None, 2),
    ('metrologie', 'types', 'Métrologie industrielle', 'Contrôle qualité en production et étalonnage des instruments.', 'fas fa-industry', None, 3),
    ('metrologie', 'roles', 'Étalonnage', 'Vérification et ajustement des instruments de mesure.', 'fas fa-sync-alt', None, 1),
    ('metrologie', 'roles', 'Vérification', 'Contrôle de conformité des instruments aux exigences réglementaires.', 'fas fa-clipboard-check', None, 2),
    ('metrologie', 'roles', 'Certification', 'Délivrance de certificats d\'étalonnage et de conformité.', 'fas fa-certificate', None, 3),
    ('metrologie', 'roles', 'Formation', 'Formation des techniciens aux bonnes pratiques métrologiques.', 'fas fa-graduation-cap', None, 4),
    ('metrologie', 'roles', 'Contrôle', 'Contrôle des instruments de mesure sur le marché.', 'fas fa-search', None, 5),
    ('qualite', 'apports', 'Compétitivité', 'Les produits de qualité sont plus compétitifs sur le marché.', 'fas fa-trophy', None, 1),
    ('qualite', 'apports', 'Confiance', 'La qualité renforce la confiance des consommateurs.', 'fas fa-handshake', None, 2),
    ('qualite', 'apports', 'Réduction des coûts', 'La démarche qualité réduit les coûts liés aux non-conformités.', 'fas fa-chart-line', None, 3),
    ('qualite', 'apports', 'Innovation', 'La qualité encourage l\'innovation et l\'amélioration continue.', 'fas fa-lightbulb', None, 4),
    ('qualite', 'apports', 'Accès aux marchés', 'Les certifications facilitent l\'accès aux marchés internationaux.', 'fas fa-door-open', None, 5),
    ('conformite', 'activites', 'Audits de certification', 'Évaluation complète du système de management.', 'fas fa-clipboard-check', None, 1),
    ('conformite', 'activites', 'Essais de conformité', 'Tests et vérifications techniques pour confirmer la conformité.', 'fas fa-flask', None, 2),
    ('conformite', 'activites', 'Inspections', 'Vérification sur site de la conformité des produits.', 'fas fa-search', None, 3),
    ('conformite', 'activites', 'Formation', 'Formation des acteurs aux exigences de conformité.', 'fas fa-graduation-cap', None, 4),
    ('conformite', 'activites', 'Conseil technique', 'Accompagnement pour la mise en conformité des produits.', 'fas fa-user-tie', None, 5),
    ('conformite', 'activites', 'Marque NCGO', 'Gestion de la marque nationale de conformité NCGO.', 'fas fa-award', None, 6),
    ('pcec', 'enjeux', 'Protection des consommateurs', 'Garantir que les produits importés sont sûrs.', 'fas fa-shield-alt', None, 1),
    ('pcec', 'enjeux', 'Protection de l\'environnement', 'Empêcher l\'importation de produits nocifs.', 'fas fa-leaf', None, 2),
    ('pcec', 'enjeux', 'Sécurité publique', 'Les produits dangereux doivent respecter les exigences.', 'fas fa-exclamation-triangle', None, 3),
    ('pcec', 'enjeux', 'Loyauté commerciale', 'Éliminer les produits frauduleux.', 'fas fa-balance-scale', None, 4),
    ('pcec', 'administrations', 'ACONOQ', 'Agence Congolaise de Normalisation et de la Qualité.', 'fas fa-building', None, 1),
    ('pcec', 'administrations', 'Douanes', 'Direction Générale des Douanes.', 'fas fa-passport', None, 2),
    ('pcec', 'administrations', 'Ministère du Commerce', 'Ministère chargé du Commerce.', 'fas fa-landmark', None, 3),
    ('pcec', 'administrations', 'CNAC', 'Commission Nationale d\'Accréditation.', 'fas fa-certificate', None, 4),
]
lines.append("-- 8. CARD GRIDS")
lines.append("INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_icon, card_number, ordre) VALUES")
def card_number_val(val):
    return 'NULL' if val is None else f"'{val}'"

lines.append(",\n".join([f"('{g[0]}', '{g[1]}', '{q(g[2])}', '{q(g[3])}', '{g[4]}', {card_number_val(g[5])}, {g[6]})" for g in grids]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 9. PRINCIPES
principes = [
    ('Consensus', 'Les normes sont établies par consensus.', '1', 1),
    ('Efficacité', 'Les processus sont efficaces et adaptés.', '2', 2),
    ('Ouverture', 'Les travaux sont ouvertes à toutes les parties.', '3', 3),
    ('Impartialité', 'Toutes les parties sont traitées équitablement.', '4', 4),
    ('Réseautage', 'La normalisation favorise le partenariat.', '5', 5),
    ('Cohérence', 'Les normes sont cohérentes entre elles.', '6', 6),
    ('Flexibilité', 'Les normes s\'adaptent aux évolutions.', '7', 7),
    ('Transparence', 'Les processus sont transparents.', '8', 8),
    ('Volontariat', 'L\'application est généralement volontaire.', '9', 9),
    ('Développement durable', 'Les normes intègrent les enjeux environnementaux.', '10', 10),
]
lines.append("-- 9. PRINCIPES")
lines.append("INSERT INTO card_grids (page_slug, grid_key, card_title, card_description, card_number, ordre) VALUES")
lines.append(",\n".join([f"('normalisation', 'principes', '{q(p[0])}', '{q(p[1])}', '{p[2]}', {p[3]})" for p in principes]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 10. FAQ
faq = [
    ("Comment accéder au catalogue de normes ?", "Consultez notre catalogue en ligne ou contactez-nous pour les documents officiels.", 'fas fa-book', 1),
    ("Quels types de normes sont disponibles ?", "Notre catalogue couvre les normes NCGO, ISO et ARSO dans tous les secteurs.", 'fas fa-list', 2),
    ("Comment télécharger les documents ?", "Créez un compte, sélectionnez les normes et téléchargez après validation.", 'fas fa-download', 3),
    ("Modes de paiement acceptés ?", "Virements bancaires, Mobile Money et carte bancaire.", 'fas fa-credit-card', 4),
]
lines.append("-- 10. FAQ")
lines.append("INSERT INTO faq_items (page_slug, question, answer, icon_class, ordre) VALUES")
lines.append(",\n".join([f"('boutique', '{q(f[0])}', '{q(f[1])}', '{f[2]}', {f[3]})" for f in faq]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 11. CERTIFICATION STEPS
steps = [
    (1, 'Demande de certification', "Déposez votre demande auprès de l'ACONOQ.", 1),
    (2, 'Évaluation initiale', "Analyse et planification de l'audit.", 2),
    (3, 'Audit de certification', 'Vérification de conformité sur site.', 3),
    (4, 'Décision', 'Examen des résultats et délivrance du certificat.', 4),
    (5, 'Suivi post-certification', 'Audits de surveillance réguliers.', 5),
]
lines.append("-- 11. CERTIFICATION STEPS")
lines.append("INSERT INTO certification_steps (step_number, title, description, ordre) VALUES")
lines.append(",\n".join([f"({s[0]}, '{q(s[1])}', '{q(s[2])}', {s[3]})" for s in steps]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 12. PCEC EXCEPTIONS
pcec_items = ["Équipements électriques et électroniques", "Produits alimentaires et boissons", "Médicaments et produits pharmaceutiques", "Jouets et articles pour enfants", "Textiles et vêtements", "Pièces détachées automobiles", "Machines et équipements industriels", "Matériaux de construction", "Produits chimiques et dangereux", "Équipements de télécommunication", "Mobilier et articles ménagers", "Équipements de protection individuelle (EPI)", "Instruments de mesure", "Équipements médicaux", "Produits cosmétiques et d'hygiène", "Éclairage et luminaires", "Moteurs et alternateurs", "Pompes et compresseurs", "Réfrigérateurs et climatiseurs", "Appareils de cuisson", "Articles en plastique et caoutchouc"]
pcec_json = jsonb_val(pcec_items)
lines.append("-- 12. PCEC EXCEPTIONS")
lines.append("INSERT INTO pcec_exceptions (title, intro_text, items) VALUES")
lines.append(f"('Produits concernés par le PCEC', 'Les produits suivants sont soumis à l''évaluation de conformité :', '{pcec_json}'::jsonb)")
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 13. CONTACT INFO
contacts = [
    ('address', 'fas fa-map-marker-alt', 'Adresse', '10, Impasse Jean-Marie NIABIA, Quartier OCH, Brazzaville', None, 1),
    ('phone', 'fas fa-phone', 'Téléphone', '+242 04 404 6270', 'tel:+242044046270', 2),
    ('email', 'fas fa-envelope', 'Email', 'contact@aconoq.cg', 'mailto:contact@aconoq.cg', 3),
]
lines.append("-- 13. CONTACT INFO")
lines.append("INSERT INTO contact_info (info_type, icon_class, title, value, link, ordre) VALUES")
vals = []
for c in contacts:
    link = 'NULL' if c[4] is None else f"'{c[4]}'"
    vals.append(f"('{c[0]}', '{c[1]}', '{q(c[2])}', '{q(c[3])}', {link}, {c[5]})")
lines.append(",\n".join(vals))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 14. SCHEDULE
lines.append("-- 14. SCHEDULE")
lines.append("INSERT INTO schedule (days, hours, status, ordre) VALUES")
lines.append("('Lundi - Vendredi', '8:00 - 17:00', 'Ouvert', 1),")
lines.append("('Samedi - Dimanche', 'Fermé', 'Fermé', 2)")
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 15. ADVANTAGES
adv = [
    ('Accès rapide', 'Téléchargez vos normes en quelques clics, 24h/24.', 'fas fa-bolt', 1),
    ('Documents officiels', "Tous les documents sont les versions officielles de l'ACONOQ.", 'fas fa-file-alt', 2),
    ('Paiement sécurisé', 'Transactions sécurisées par Mobile Money, carte bancaire ou virement.', 'fas fa-lock', 3),
    ('Support client', "Une équipe d'assistance disponible pour vous accompagner.", 'fas fa-headset', 4),
]
lines.append("-- 15. ADVANTAGES")
lines.append("INSERT INTO advantages (page_slug, title, description, icon_class, ordre) VALUES")
lines.append(",\n".join([f"('boutique', '{q(a[0])}', '{q(a[1])}', '{a[2]}', {a[3]})" for a in adv]))
lines.append("ON CONFLICT DO NOTHING;")
lines.append("")

# 16. HOW IT WORKS
hiw = [
    (1, 'Choisissez vos normes', 'Parcourez le catalogue et sélectionnez les normes dont vous avez besoin.', 'fas fa-search', 1),
    (2, 'Ajoutez au panier', 'Ajoutez les documents sélectionnés à votre panier.', 'fas fa-shopping-cart', 2),
    (3, 'Procédez au paiement', 'Choisissez votre mode de paiement et validez votre commande.', 'fas fa-credit-card', 3),
    (4, 'Téléchargez', 'Accédez immédiatement à vos documents téléchargeables.', 'fas fa-download', 4),
]
lines.append("-- 16. HOW IT WORKS")
lines.append("INSERT INTO how_it_works (page_slug, step_number, title, description, icon_class, ordre) VALUES")
lines.append(",\n".join([f"('boutique', {h[0]}, '{q(h[1])}', '{q(h[2])}', '{h[3]}', {h[4]})" for h in hiw]))
lines.append("ON CONFLICT DO NOTHING;")

# Write
output = r"C:\Users\HP\Desktop\Designlabs\aconoq\sql\seed_dynamic.sql"
with open(output, 'w', encoding='utf-8') as f:
    f.write('\n'.join(lines))

shutil.copy2(output, r"C:\Users\HP\Desktop\seed_dynamic.sql")
print(f"OK - {len(lines)} lines written")

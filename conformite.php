<?php $pageTitle = 'Conformité'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        .dropdown-menu { position: absolute; top: 100%; left: 0; padding-top: 8px; opacity: 0; visibility: hidden; transform: translateY(4px); transition: all 0.2s ease; pointer-events: none; }
        .nav-item:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); pointer-events: auto; }
        .nav-item { position: relative; z-index: 50; }
        .nav-item::after { content: ''; position: absolute; left: 0; right: 0; top: 100%; height: 8px; }
        .norm-page{padding:90px 0 80px;background:linear-gradient(180deg,#f7f8f4 0%,#f7f8f4 60%,#ffffff 100%);min-height:100vh}
        .norm-container{width:min(1080px,calc(100% - 32px));margin:auto}
        .norm-card{background:#fff;border-radius:18px;padding:42px;overflow:hidden;position:relative}
        .norm-card::before{content:"";position:absolute;inset:0;border-radius:18px;box-shadow:0 8px 24px rgba(15,113,64,.07);mask-image:linear-gradient(to bottom,black 75%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 75%,transparent 100%);pointer-events:none}
        .norm-card h1{color:#0a1f0a;font-size:clamp(28px,4vw,44px);line-height:1.1;margin:0 0 12px}
        .norm-card h2{color:#0f7140;font-size:21px;margin:32px 0 10px;font-weight:700}
        .norm-card h3{color:#0a1f0a;font-size:16px;margin:20px 0 8px}
        .norm-card p,.norm-card li{color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card ul{padding-left:22px}
        #dynamic-sections .acq-section{background:transparent!important;padding:0;margin:0}
        #dynamic-sections .acq-section .acq-container{max-width:100%;padding:0}
        #dynamic-sections .acq-section .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:16px}
        #dynamic-sections .feature-card{padding:22px;border:1px solid #e2ece3;border-radius:14px;background:#fbfdfb;transition:box-shadow .2s,transform .2s}
        #dynamic-sections .feature-card:hover{box-shadow:0 6px 18px rgba(15,113,64,.1);transform:translateY(-2px)}
        #dynamic-sections .feature-card .feature-icon{width:auto;height:auto;border-radius:0;background:none!important;padding:0;margin-bottom:14px}
        #dynamic-sections .feature-card .feature-icon i{font-size:24px;color:#0f7140}
        #dynamic-sections .feature-card h3{color:#0a1f0a;font-size:16px;margin:0 0 8px}
        #dynamic-sections .feature-card p{font-size:13px;margin:0;color:#4a5a4c}
        @media(max-width:760px){#dynamic-sections .acq-section .grid{grid-template-columns:1fr}}
        .doc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:28px}
        .doc-item{padding:22px;border:1px solid #e2ece3;border-radius:14px;background:#fbfdfb;transition:box-shadow .2s,transform .2s;text-decoration:none;display:block}
        .doc-item:hover{box-shadow:0 6px 18px rgba(15,113,64,.1);transform:translateY(-2px)}
        .doc-item i{font-size:24px;color:#0f7140;margin-bottom:14px}
        .doc-item h3{color:#0a1f0a;font-size:16px;margin:0 0 8px}
        .doc-item p{font-size:13px;margin:0}
        @media(max-width:760px){.doc-grid{grid-template-columns:1fr}}
        .metro-list{display:flex;flex-direction:column;gap:6px;margin:6px 0 18px}
        .metro-list-item{display:flex;align-items:flex-start;gap:10px;padding:2px 0}
        .metro-list-item i{color:#0f7140;font-size:13px;margin-top:4px;flex-shrink:0}
        .metro-list-item span{color:#4a5a4c;font-size:16px;line-height:1.6;font-weight:600}
        .sub-item{padding-left:28px;color:#4a5a4c;font-size:16px;line-height:1.75}
        .norm-card .h2-sep{margin-top:40px;padding-top:20px;border-top:1px solid #eaf4ef}
        @media(max-width:650px){.norm-card{padding:24px}}
    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <main class="norm-page">
        <div class="norm-container">
            <div class="flex items-center justify-between mb-8">
                <a href="index.php" class="text-primary text-sm font-medium inline-flex items-center gap-2"><i class="fas fa-arrow-left"></i> Accueil</a>
                <p class="text-sm"><a href="index.php" class="text-primary hover:underline">Accueil</a> <span class="mx-1 text-gray-400">/</span> <span class="text-dark font-medium">Conformité</span></p>
            </div>
            <article class="norm-card">
                <div style="margin:-42px -42px 28px;border-radius:18px 18px 0 0;overflow:hidden;height:150px">
                    <img src="images/header-conformite.jpg?v=2" alt="Conformité" style="width:100%;height:100%;object-fit:cover">
                </div>
                <p class="section-tag">Conformité</p>
                <h1><strong>Évaluation</strong> de la <em>Conformité</em></h1>
                <div class="doc-grid">
                    <a class="doc-item" href="pcec.php">
                        <i class="fas fa-certificate"></i>
                        <h3>Programme PCEC</h3>
                        <p>Découvrez le Programme Congolais d'Évaluation de la Conformité.</p>
                    </a>
                    <a class="doc-item" href="devis.php">
                        <i class="fas fa-file-invoice"></i>
                        <h3>Demander un devis</h3>
                        <p>Décrivez votre besoin pour recevoir une orientation adaptée.</p>
                    </a>
                    <a class="doc-item" href="contact.php">
                        <i class="fas fa-envelope"></i>
                        <h3>Nous contacter</h3>
                        <p>Adressez-nous une demande d'information ou d'accompagnement.</p>
                    </a>
                </div>

                <h2 class="h2-sep"><strong>1.</strong> Définition</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La certification est une activité d'évaluation de la conformité par laquelle un organisme indépendant atteste qu'un produit, un service ou un système de management satisfait aux exigences d'un référentiel.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La labellisation est une activité d'évaluation de la conformité par laquelle un organisme autorisé attribue un label à un produit, un service, un processus ou une organisation, après avoir vérifié qu'il satisfait à un ensemble de critères ou d'exigences préétablis. Le label constitue un signe distinctif permettant d'attester de certaines caractéristiques, qualités ou performances auprès des utilisateurs et des parties intéressées.</span></div>
                </div>

                <h2 class="h2-sep"><strong>2.</strong> Principes fondamentaux de la certification</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Impartialité : garantir des décisions objectives et exemptes de tout conflit d'intérêts.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Compétence : disposer d'un personnel qualifié et maintenir ses compétences.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Indépendance : prendre des décisions fondées uniquement sur les résultats des évaluations.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Confidentialité : protéger les informations obtenues dans le cadre des activités de certification.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Transparence : communiquer clairement les règles et les processus de certification.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Objectivité : fonder toute décision sur des preuves vérifiables de conformité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Cohérence : appliquer les mêmes exigences à tous les demandeurs.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Responsabilité : assumer pleinement les décisions de certification.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Amélioration continue : renforcer continuellement l'efficacité du système de certification.</span></div>
                </div>

                <h2 class="h2-sep"><strong>3.</strong> Concepts fondamentaux de la certification</h2>
                <p>Dans le domaine de la certification, les concepts fondamentaux sont les notions de base qui permettent de comprendre le processus de certification et sa finalité.</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Conformité</strong> — Respect par un produit, un processus, un service, un système ou une personne des exigences spécifiées dans une norme, un règlement technique ou un référentiel.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Évaluation de la conformité</strong> — Démonstration que les exigences spécifiées relatives à un produit, un processus, un service, un système ou une personne sont satisfaites.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Organisme de certification</strong> — Organisme compétent et impartial chargé de réaliser les activités d'évaluation et de prendre les décisions de certification.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Preuve objective</strong> — Données démontrant l'existence ou la véracité d'un fait. Les décisions de certification doivent être fondées sur des preuves objectives.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Surveillance</strong> — Activités périodiques menées après la certification pour vérifier le maintien de la conformité.</span></div>
                </div>

                <h2 class="h2-sep"><strong>4.</strong> Typologie</h2>
                <h3>Certification de produits, procédés et services (ISO/IEC 17065)</h3>
                <p>Elle atteste qu'un produit, un procédé ou un service est conforme à un référentiel (norme, règlement technique, spécification, etc.).</p>
                <p><strong>Exemples :</strong></p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Ciment</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Eau en bouteille</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Équipements électriques</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Services de nettoyage</span></div>
                </div>
                <h3>Certification des systèmes de management (ISO/IEC 17021-1)</h3>
                <p>Elle atteste qu'une organisation applique un système de management conforme à une norme internationale.</p>
                <p><strong>Exemples :</strong></p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>ISO 9001 : Management de la qualité</span></div>
                </div>
                <h3>Certification des personnes (ISO/IEC 17024)</h3>
                <p>Elle reconnaît qu'une personne possède les compétences requises pour exercer une activité ou une profession selon des critères définis.</p>
                <p><strong>Exemples :</strong></p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Auditeur qualité</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Soudeur</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Expert en cybersécurité</span></div>
                </div>

                <h2 class="h2-sep"><strong>5.</strong> Principales activités</h2>
                <p>Dans le cadre de la certification de produits (conforme à l'ISO/IEC 17065), les principales activités correspondent aux étapes du processus de certification. Elles permettent de démontrer qu'un produit est conforme aux exigences d'un référentiel.</p>
                <p>Les principales activités de la certification sont :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Information et réception de la demande</strong> — Information du demandeur sur les conditions de certification. Réception et enregistrement de la demande de certification. Vérification de la complétude du dossier.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Revue de la demande</strong> — Analyse de la recevabilité de la demande. Vérification que le référentiel est applicable. Confirmation que l'organisme dispose des compétences et des ressources nécessaires.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Planification de l'évaluation</strong> — Planification des essais, inspections ou audits.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Revue des résultats de l'évaluation</strong> — Analyse des preuves recueillies. Vérification du traitement des éventuelles non-conformités. Confirmation que toutes les exigences sont satisfaites.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Décision de certification</strong> — Décision d'accorder, de refuser, de maintenir, de suspendre, de retirer ou de réduire la portée de la certification. Cette décision est prise par une personne ou un comité indépendant de ceux ayant réalisé l'évaluation.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span><strong>Délivrance du certificat</strong> — Émission du certificat de conformité. Autorisation d'utiliser la marque de certification, le cas échéant. Enregistrement de la certification.</span></div>
                </div>
                <div class="norm-callout">
                    <p><strong>Schéma simplifié du processus :</strong> Demande → Revue de la demande → Évaluation → Revue de l'évaluation → Décision → Délivrance du certificat</p>
                </div>

                <h2 class="h2-sep"><strong>6.</strong> Programmes mis en œuvre</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Le schéma national des produits issus de la production locale et destinés à l'exportation.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Le programme congolais d'évaluation de la conformité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Système de marquage et de traçabilité des produits du tabac.</span></div>
                </div>

                <h2 class="h2-sep"><strong>7.</strong> Documents à mettre à la disposition des visiteurs</h2>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Formulaire de demande de certification.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Procédure de certification simplifiée.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Liste des entreprises certifiées.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Liste des produits certifiés.</span></div>
                </div>

                <h2 class="h2-sep" style="margin-top:48px;padding-top:24px;border-top:2px solid #eaf4ef"><strong>Présentation du service des agréments des organismes</strong></h2>

                <h2><strong>8.</strong> Définition du domaine</h2>
                <p>Le service des agréments des organismes est un service administratif chargé d'étudier, d'évaluer et de délivrer les agréments nécessaires à l'exercice de certaines activités ou professions réglementées. Il est dirigé et animé par un chef de service et comprend deux bureaux dont :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Le bureau des agréments des organismes.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Le bureau de la documentation.</span></div>
                </div>

                <h2><strong>9.</strong> Les principes fondamentaux</h2>
                <p>Les principes fondamentaux du service des agréments des organismes sont les règles qui garantissent l'octroi, le maintien, la suspension ou le retrait d'un agrément.</p>

                <h2><strong>10.</strong> Les concepts fondamentaux</h2>
                <p>Nos concepts fondamentaux sont les suivants : agrément, organisme, évaluation, compétence, traçabilité…</p>

                <h2><strong>11.</strong> Les principales activités réalisées</h2>
                <p>Les principales activités réalisées sont les pré-audits, les audits, les rédactions des agréments.</p>

                <h2><strong>12.</strong> Les principaux programmes pouvant être mis à la disposition des visiteurs du site</h2>
                <p>Les flyers, les fiches d'octroi et de renouvellement des agréments.</p>

                <h2 class="h2-sep" style="margin-top:48px;padding-top:24px;border-top:2px solid #eaf4ef"><strong>Le service d'audits de l'ACONOQ</strong></h2>

                <h2><strong>13.</strong> La définition du domaine</h2>
                <p>Le domaine du service d'audits des organismes de l'ACONOQ regroupe l'ensemble des activités visant à évaluer, contrôler et surveiller les organismes d'évaluation de la conformité, afin de garantir leur compétence, leur impartialité et leur conformité aux exigences normatives et réglementaires en vigueur.</p>

                <h2><strong>14.</strong> Les principes fondamentaux</h2>
                <p>Le service d'audit de l'ACONOQ repose sur des principes internationaux solides et des concepts structurés, garantissant :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Transparence.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Impartialité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Efficacité.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>Crédibilité du système qualité national.</span></div>
                </div>

                <h2><strong>15.</strong> La typologie du service d'audits de l'ACONOQ</h2>
                <p>Elle comprend l'ensemble des catégories d'audits, d'organismes audités, d'objets d'évaluation, de modes de réalisation et de niveaux de constats, organisés selon un cycle structuré allant de la planification à la prise de décision et au suivi des actions correctives.</p>

                <h2><strong>16.</strong> Les principales activités réalisées</h2>
                <p>L'ACONOQ assure l'élaboration des normes, l'évaluation de la conformité, l'agrément et la surveillance des organismes, la mise en œuvre du Programme Congolais d'Évaluation de la Conformité (PCEC), ainsi que le contrôle de la qualité et de la sécurité des produits, en vue de garantir la protection des consommateurs et la fiabilité du système national de qualité.</p>

                <h2><strong>17.</strong> Les services rendus aux usagers et aux parties prenantes</h2>
                <p>L'ACONOQ fournit des services d'information normative, d'évaluation de la conformité, d'agrément et de surveillance des organismes, de facilitation des échanges commerciaux, de protection des consommateurs et d'appui technique aux pouvoirs publics, au bénéfice des usagers et des parties prenantes du système national de qualité.</p>

                <h2><strong>18.</strong> Les projets, programmes ou réalisations majeurs</h2>
                <p>L'ACONOQ met en œuvre des programmes structurants, notamment le Programme Congolais d'Évaluation de la Conformité (PCEC), le développement du système national de normalisation, le renforcement des infrastructures de laboratoire, la mise en place du système d'évaluation de la conformité, ainsi que des actions de formation, de coopération internationale et de modernisation institutionnelle, visant à garantir la qualité, la sécurité des produits et la compétitivité de l'économie nationale.</p>

                <h2><strong>19.</strong> Les documents, formulaires, guides ou procédures pouvant être mis à la disposition des visiteurs du site</h2>
                <p>L'ACONOQ met à la disposition des usagers et parties prenantes un ensemble de documents comprenant les normes nationales, règlements techniques, formulaires administratifs, guides pratiques, procédures opérationnelles et supports d'information, afin de faciliter l'accès à la conformité, d'améliorer la transparence et de renforcer l'efficacité du système national de qualité.</p>

                <h2 class="h2-sep" style="margin-top:48px;padding-top:24px;border-top:2px solid #eaf4ef"><strong>La cellule VOC de l'ACONOQ</strong></h2>

                <h2><strong>20.</strong> Définition du domaine de la cellule VOC</h2>
                <p>La cellule VOC de l'ACONOQ est le pilier opérationnel du contrôle de conformité des produits importés, garantissant que seules les marchandises conformes aux exigences réglementaires et normatives accèdent au marché congolais.</p>

                <h2><strong>21.</strong> Les principes et les concepts fondamentaux</h2>
                <p>La cellule VOC repose sur une approche préventive, structurée et normée de la conformité, combinant des principes de rigueur, impartialité, traçabilité et protection du consommateur, avec des concepts techniques issus de l'évaluation de la conformité.</p>

                <h2><strong>22.</strong> La typologie du domaine VOC</h2>
                <p>La typologie du domaine VOC de l'ACONOQ repose sur une structuration en catégories d'activités, de produits, de procédures, de décisions et d'acteurs, permettant une gestion complète, rigoureuse et efficace de la conformité des marchandises importées.</p>

                <h2><strong>23.</strong> Les principales activités réalisées pour le VOC</h2>
                <p>Les activités de la cellule VOC de l'ACONOQ couvrent l'ensemble du cycle de vérification de conformité : de la réception du dossier jusqu'à la délivrance du Certificat de Conformité, en passant par le contrôle, l'inspection, les essais, la décision et le suivi.</p>

                <h2><strong>24.</strong> Les services rendus aux usagers et aux parties prenantes pour le VOC</h2>
                <p>La cellule VOC de l'ACONOQ rend des services essentiels à l'ensemble des parties prenantes en assurant la conformité des produits, la sécurité du marché, la facilitation du commerce et la protection des consommateurs, tout en garantissant transparence, traçabilité et efficacité.</p>

                <h2><strong>25.</strong> Les projets, programmes ou réalisations majeurs pour le VOC</h2>
                <p>Les projets et réalisations du VOC de l'ACONOQ reposent principalement sur la mise en œuvre du PCEC, le renforcement des contrôles, la structuration du système, et une transition progressive vers la digitalisation, avec pour finalité la protection du marché et des consommateurs.</p>

                <h2>Documents pour le VOC</h2>
                <p>La mise à disposition de ces documents sur le site de l'ACONOQ permet de renforcer :</p>
                <div class="metro-list">
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La transparence.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La facilité d'accès à l'information.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>La conformité des usagers.</span></div>
                    <div class="metro-list-item"><i class="fas fa-check-circle"></i><span>L'efficacité du dispositif VOC.</span></div>
                </div>
            </article>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>

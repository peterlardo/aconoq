<?php $pageTitle = 'ACONOQ'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'components/head.php'; ?>
    <style>
        .nav-link { color: #fff; }
        .nav-link:hover { color: #fff; }
        :root {
            --green-900: #0f7140;
            --green-800: #0a4b2a;
            --green-700: #1a8a3c;
            --red-600: #dc2626;
            --cream: #f3f4f6;
            --white: #ffffff;
            --text: #1a2e1a;
            --text-light: #4a5a4c;
            --text-muted: #6b7280;
            --border: rgba(15, 113, 64, 0.1);
            --shadow-sm: 0 6px 18px rgba(15, 113, 64, 0.07);
            --shadow-md: 0 18px 46px rgba(15, 113, 64, 0.14);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text); background: var(--cream); }
        .font-serif { font-family: 'Inter', sans-serif; }

        /* === HERO === */
        .hero-carousel { position: absolute; inset: 0; }
        .hero-slide {
            position: absolute; inset: 0;
            opacity: 0;
            transition: opacity 1.8s ease-in-out, transform 9s ease-out;
            background-size: cover;
            background-position: center;
            transform: scale(1.05);
        }
        .hero-slide.active { opacity: 1; transform: scale(1); }
        .hero-slide::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 40%, rgba(0,0,0,0.15) 70%, transparent 100%);
        }
        .carousel-dots {
            position: absolute; bottom: 28px; left: 50%;
            transform: translateX(-50%); z-index: 25;
            display: flex; gap: 10px;
        }
        .carousel-dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: rgba(255,255,255,0.4); border: none; cursor: pointer;
            transition: all 0.3s;
        }
        .carousel-dot.active { background: #fff; transform: scale(1.3); }
        .carousel-arrow {
            position: absolute; top: 50%; transform: translateY(-50%); z-index: 25;
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(255,255,255,0.15); backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.2); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 16px; transition: all 0.3s;
        }
        .carousel-arrow:hover { background: var(--red-600); border-color: var(--red-600); }
        .carousel-arrow.prev { left: 20px; }
        .carousel-arrow.next { right: 20px; }

        /* === NAV === */
        .nav-item { position: relative; z-index: 50; }
        .nav-item::after { content: ''; position: absolute; left: 0; right: 0; top: 100%; height: 8px; }
        .dropdown-menu {
            position: absolute; top: 100%; left: 0; padding-top: 8px;
            opacity: 0; visibility: hidden; transition: opacity 0.15s, visibility 0.15s; z-index: 9999;
        }
        .nav-item:hover > .dropdown-menu { opacity: 1; visibility: visible; }

        /* === CARDS === */
        .feature-card {
            background: var(--white);
            border-radius: 18px;
            padding: 28px 24px;
            border: 1.5px solid var(--border);
            transition: all .35s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        .feature-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--green-900);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .4s ease;
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: transparent;
        }
        .feature-card:hover::before { transform: scaleX(1); }
        .feature-card h3 { font-weight: 600; font-size: 17px; margin-bottom: 10px; letter-spacing: -0.02em; }
        .feature-card p { font-size: 13.5px; color: var(--text-muted); line-height: 1.65; }
        .feature-icon {
            width: 52px; height: 52px; border-radius: 50%;
            background: rgba(15, 113, 64, 0.08);
            color: var(--green-900);
            display: grid; place-items: center;
            margin-bottom: 18px; transition: all .35s ease;
        }
        .feature-card:hover .feature-icon {
            background: var(--green-900); color: #fff;
        }

        .route-card .route-number {
            position: absolute; top: 10px; right: 14px;
            font-size: 24px; font-weight: 700;
            color: rgba(15,113,64,.08); transition: color .35s;
        }
        .route-card:hover .route-number { color: rgba(245,201,8,.65); }
        .route-link {
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 18px; color: var(--green-900);
            font-size: 14px; font-weight: 600;
            transition: gap .3s ease; text-decoration: none;
        }
        .route-link:hover { gap: 14px; color: var(--green-800); }
        @media (max-width: 700px) {
            .routes-banner > div:last-child {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 28px !important;
            }
        }
        .route-banner-grid { position:relative; z-index:1; width:min(1200px,92%); margin:-10px auto 0; padding-bottom:32px; display:grid; grid-template-columns:repeat(3,1fr); gap:18px; }
        .route-banner-card { position:relative; min-height:160px; padding:14px 18px 28px; border:1px solid rgba(255,255,255,.24); border-radius:20px; background:rgba(15,31,24,.58); color:#fff; backdrop-filter:blur(10px); transition:transform .3s,background .3s,border-color .3s; }
        .route-banner-card:hover { transform:translateY(-6px); background:rgba(15,31,24,.78); border-color:rgba(245,201,8,.7); }
        .route-banner-icon { width:42px; height:42px; display:grid; place-items:center; margin-bottom:14px; border-radius:50%; background:rgba(245,201,8,.16); color:#f5c908; font-size:18px; }
        .route-banner-number { display:none; }
        .route-banner-card h3 { margin:14px 0 8px; color:#fff; font-size:22px; font-weight:700; }
        .route-banner-card p { margin:0; color:rgba(255,255,255,.72); font-size:13.5px; line-height:1.6; }
        .route-banner-card .route-link { display:inline-flex; margin-top:16px; color:#f5c908; font-size:13px; font-weight:600; gap:7px; }
        @media (max-width:700px) { .route-banner-grid { grid-template-columns:1fr; margin-top:24px; } }
        .programs-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:28px; }
        .program-card { position:relative; padding:38px 28px 30px; background:#fff; border:1px solid rgba(15,113,64,.1); border-radius:18px; transition:transform .35s,box-shadow .35s,border-color .35s; }
        .program-card:hover { transform:translateY(-8px); box-shadow:0 18px 46px rgba(15,113,64,.14); border-color:transparent; }
        .program-number { display:block; font-size:46px; line-height:1; font-weight:800; color:transparent; -webkit-text-stroke:1.5px #0f7140; letter-spacing:-.04em; }
        .program-icon { width:64px; height:64px; margin:18px 0 20px; border-radius:50%; display:grid; place-items:center; background:rgba(245,201,8,.16); color:#0f7140; font-size:25px; transition:background .3s,color .3s; }
        .program-card:hover .program-icon { background:#f5c908; color:#0f7140; }
        .program-card h3 { margin:0 0 10px; color:#0f7140; font-size:19px; line-height:1.25; font-weight:700; }
        .program-card p { margin:0; color:#4a5a4c; font-size:14px; line-height:1.65; }
        .program-card ul { display:grid; gap:7px; margin:20px 0 0; padding:18px 0 0; border-top:1px solid rgba(15,113,64,.1); list-style:none; }
        .program-card li { display:flex; align-items:center; gap:8px; color:#0f7140; font-size:13px; }
        .program-card li i { color:#0f7140; font-size:11px; }
        .program-link { display:inline-flex; align-items:center; gap:8px; margin-top:20px; color:#0f7140; font-size:13.5px; font-weight:600; text-decoration:none; transition:gap .3s; }
        .program-link:hover { gap:14px; color:#0a4b2a; }
        @media (max-width: 800px) { .programs-grid { grid-template-columns:1fr; } }
        .routes-projects-head { display:flex; align-items:flex-end; justify-content:space-between; gap:24px; margin-bottom:42px; }
        .routes-projects-cta { display:inline-flex; align-items:center; gap:10px; padding:11px 18px; border-radius:999px; background:#0f7140; color:#fff; font-size:13px; font-weight:600; text-decoration:none; transition:background .25s,transform .25s; white-space:nowrap; }
        .routes-projects-cta:hover { background:#0a4b2a; transform:translateY(-2px); }
        .routes-projects-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.route-project-card { position:relative; min-height:200px; overflow:hidden; border-radius:20px; background:#0f7140; border:2px solid rgba(255,255,255,.6); }
        .route-project-card img { width:100%; height:100%; object-fit:cover; transition:transform .6s ease; opacity:0.25; }
        .route-project-card:hover img { transform:scale(1.07); }
        .route-project-overlay { position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end; padding:28px 24px; color:#fff; background:linear-gradient(to top,rgba(8,31,18,.94) 0%,rgba(8,31,18,.48) 52%,transparent 100%); }
        .route-project-overlay > span { color:#f5c908; font-size:13px; font-weight:700; letter-spacing:2px; margin-bottom:10px; }
        .route-project-overlay h3 { margin:0 0 8px; color:#fff; font-size:22px; font-weight:700; }
        .route-project-overlay p { margin:0; color:rgba(255,255,255,.78); font-size:14px; }
        .route-project-overlay a { display:inline-flex; align-items:center; gap:8px; margin-top:18px; color:#f5c908; font-size:13px; font-weight:600; text-decoration:none; }
        .route-project-overlay a:hover { gap:14px; }
        @media (max-width:800px) { .routes-projects-head { align-items:flex-start; flex-direction:column; } .routes-projects-grid { grid-template-columns:1fr; } }
        /* === BUTTONS (2-layer pill APSI style) === */
        .link-more {
            display: inline-flex; align-items: center; gap: 0;
            padding: 4px; border-radius: 30px;
            background: var(--green-900);
            font-weight: 500; font-size: 14px;
            margin-top: 18px; transition: all .3s ease;
            text-decoration: none;
        }
        .link-more-inner {
            display: inline-flex; align-items: center; gap: 6px;
            background: #fff; color: var(--green-900);
            padding: 9px 18px; border-radius: 30px;
            transition: all .3s ease; white-space: nowrap;
        }
        .link-more-arrow {
            width: 32px; height: 32px; border-radius: 50%;
            display: grid; place-items: center;
            color: #fff; font-size: 11px; font-weight: 700;
            transition: all .3s ease;
        }
        .link-more:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(15, 113, 64, 0.14);
        }
        .link-more:hover .link-more-inner { background: var(--gold); color: var(--green-900); }
        .link-more-red { background: var(--red-600); }
        .link-more-red .link-more-inner { color: var(--red-600); }
        .link-more-red:hover { box-shadow: 0 14px 30px rgba(220, 38, 38, 0.35); }
        .link-more-red:hover .link-more-inner { background: var(--green-900); color: #fff; }

        /* === SECTION HEADER (APSI style) === */
        .section-tag {
            color: var(--green-900); font-size: 12px; font-weight: 600;
            letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 12px;
            display: flex; align-items: center; gap: 8px;
        }
        .section-tag::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: var(--red-600);
        }
        .section-heading {
            font-family: 'Inter', sans-serif; font-weight: 700;
            font-size: clamp(26px, 3vw, 38px);
            line-height: 1.15; letter-spacing: -0.03em;
            color: var(--text); margin-bottom: 16px;
        }
        .section-heading em { font-style: normal; color: var(--green-900); }
        .section-heading .text-red { color: var(--red-600); }
        .section-text { color: var(--text-light); font-size: 15px; line-height: 1.7; max-width: 560px; }

        /* === PROCESS === */
        .process-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 28px; margin-top: 50px;
        }
        .process-step {
            position: relative; text-align: center;
            padding: 40px 28px; background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 18px; transition: all .35s;
        }
        .process-step:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
        }
        .process-step h3 { font-size: 19px; font-weight: 600; margin-bottom: 10px; letter-spacing: -0.02em; }
        .process-step p { font-size: 14px; color: var(--text-light); margin-bottom: 16px; line-height: 1.6; }
        .process-step .num {
            font-size: 52px; font-weight: 800;
            color: transparent; -webkit-text-stroke: 1.5px var(--green-900);
            line-height: 1; letter-spacing: -0.03em;
        }
        .process-icon {
            width: 68px; height: 68px; margin: 18px auto 20px;
            border-radius: 50%; background: rgba(15, 113, 64, 0.08);
            color: var(--green-900); display: grid; place-items: center;
            transition: all .35s;
        }
        .process-step:hover .process-icon { background: var(--green-900); color: #fff; }
        .process-list { display: grid; gap: 7px; text-align: left; }
        .process-list li {
            font-size: 13.5px; color: var(--green-900);
            display: flex; gap: 8px; align-items: center;
        }
        .process-list li i { color: var(--green-900); font-size: 14px; flex-shrink: 0; }

        /* === FEATURES GRID === */
        .features-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
        }
        @media (max-width: 1080px) { .features-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 760px) { .features-grid { grid-template-columns: 1fr; } }

        /* === PROCESS SLIDE === */
        .process-slide .feature-card { border: 1.5px solid rgba(220,38,38,0.15); padding: 18px 16px; }
        .process-slide .feature-card:hover { border-color: var(--red-600); }
        .process-slide .feature-card::before { background: var(--red-600); }
        .process-slide .feature-icon { background: rgba(220,38,38,0.08); color: var(--red-600); }
        .process-slide .feature-card:hover .feature-icon { background: var(--red-600); color: #fff; }

        /* === CHIFFRES CLES === */
        .chiffres-section {
            background: var(--green-900); position: relative; overflow: hidden;
        }
        .chiffres-section::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .chiffres-section .chiffre-icon {
            background: rgba(255,255,255,0.12); color: #fff;
        }
        .chiffres-section .chiffre-value { color: #fff; }
        .chiffres-section p { color: rgba(255,255,255,0.75); }
        .chiffre-icon {
            width: 56px; height: 56px; border-radius: 50%;
            background: rgba(255,255,255,0.12); color: #fff;
            display: grid; place-items: center; font-size: 22px; transition: all .35s;
        }
        .chiffres-section:hover .chiffre-icon {
            background: rgba(255,255,255,0.22); transform: scale(1.08);
        }

        /* === DIRECTIONS === */
        .direction-card {
            background: var(--white); border-radius: 18px; padding: 32px 24px;
            border: 1.5px solid var(--border); transition: all .35s ease;
            text-align: center;
        }
        .direction-card:hover {
            transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: transparent;
        }
        .direction-icon {
            width: 72px; height: 72px; margin: 0 auto 20px; border-radius: 50%;
            display: grid; place-items: center; transition: all .35s;
        }
        .direction-card:hover .direction-icon { transform: scale(1.1) rotate(5deg); }

        /* === NORMES === */
        #filter-categorie, #filter-type-iso, #filter-origine, #filter-annee { min-width: 160px; }

        /* === EVENTS === */
        .line-clamp-2 {
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }

        /* === PARTENAIRES === */
        .partenaires-section { overflow: hidden; }
        .partenaires-track {
            display: flex; gap: 24px; justify-content: center; flex-wrap: wrap;
        }

        /* === DOT PATTERN === */
        .dot-pattern::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(15,113,64,0.06) 1px, transparent 1px);
            background-size: 26px 26px; pointer-events: none;
        }

        /* === BTN PRIMARY === */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-900); color: #fff;
            padding: 12px 28px; border-radius: 10px; font-size: 14px;
            font-weight: 600; text-decoration: none; transition: all .3s;
        }
        .btn-primary:hover { background: var(--green-800); transform: translateY(-2px); box-shadow: 0 10px 24px rgba(15,113,64,0.3); }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px;
            border: 2px solid var(--green-900); color: var(--green-900);
            padding: 12px 28px; border-radius: 10px; font-size: 14px;
            font-weight: 600; text-decoration: none; transition: all .3s; background: transparent;
        }
        .btn-outline:hover { background: transparent; color: var(--green-900); }
        .btn-red-outline {
            display: inline-flex; align-items: center; gap: 8px;
            border: 2px solid var(--red-600); color: var(--red-600);
            padding: 12px 28px; border-radius: 10px; font-size: 14px;
            font-weight: 600; text-decoration: none; transition: all .3s; background: transparent;
        }
        .btn-red-outline:hover { background: var(--red-600); color: #fff; }

        /* Directeur */
        #directeur-content .rounded-2xl img { transition: transform .5s; }
        #directeur-content .rounded-2xl:hover img { transform: scale(1.03); }

        /* FAQ */
        .faq-item button i { transition: transform .3s; }
        .faq-item .rotate-45 { transform: rotate(45deg); }

        /* Hero Buttons */
        .hero-btn-primary { display: inline-flex; align-items: center; transition: all .3s; text-decoration: none; }
        .hero-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(245,201,8,0.35); }
        .hero-btn-primary:hover .hero-btn-label { background: #f5c908 !important; color: #0f7140 !important; }
        .hero-btn-primary:hover .hero-btn-arrow { background: #f5c908 !important; color: #0f7140 !important; }
        .hero-btn-outline { background: #f5c908 !important; border-color: #f5c908 !important; color: #0f7140 !important; transition: all .3s; }
        .hero-btn-outline:hover { background: #f5c908 !important; border-color: #f5c908 !important; color: #0f7140 !important; }

        /* === HERO TEXT PER-SLIDE ANIMATION (slide from right + fade) === */
        .hero-slide-content {
            position: absolute; inset: 0; z-index: 10;
            display: flex; align-items: center; pointer-events: none;
        }
        .hero-slide-content > .max-w-xl { pointer-events: auto; }
        .hero-text-group {
            position: absolute; inset: 0; display: flex; align-items: flex-start; padding-top: 200px;
            opacity: 0; transform: translateX(80px);
            transition: opacity 0.8s ease, transform 0.8s cubic-bezier(.22,1,.36,1);
            pointer-events: none;
        }
        .hero-text-group.active {
            opacity: 1; transform: translateX(0);
            pointer-events: auto;
        }
        .hero-text-group.exit {
            opacity: 0; transform: translateX(-60px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            pointer-events: none;
        }
        .hero-text-group .hero-badge-anim {
            opacity: 0; transform: translateX(40px);
            transition: opacity 0.6s ease 0.15s, transform 0.6s cubic-bezier(.22,1,.36,1) 0.15s;
        }
        .hero-text-group.active .hero-badge-anim {
            opacity: 1; transform: translateX(0);
        }
        .hero-text-group .hero-title-anim {
            opacity: 0; transform: translateX(50px);
            transition: opacity 0.6s ease 0.3s, transform 0.6s cubic-bezier(.22,1,.36,1) 0.3s;
        }
        .hero-text-group.active .hero-title-anim {
            opacity: 1; transform: translateX(0);
        }
        .hero-text-group .hero-subtitle-anim {
            opacity: 0; transform: translateX(50px);
            transition: opacity 0.6s ease 0.45s, transform 0.6s cubic-bezier(.22,1,.36,1) 0.45s;
        }
        .hero-text-group.active .hero-subtitle-anim {
            opacity: 1; transform: translateX(0);
        }
        .hero-text-group .hero-cta-anim {
            opacity: 0; transform: translateX(50px);
            transition: opacity 0.6s ease 0.6s, transform 0.6s cubic-bezier(.22,1,.36,1) 0.6s;
        }
        .hero-text-group.active .hero-cta-anim {
            opacity: 1; transform: translateX(0);
        }
    </style>
<style>.home-norme-card{background:#fff;border-radius:17px;overflow:hidden;box-shadow:0 8px 24px rgba(15,113,64,.07);border:1px solid rgba(15,113,64,.05);display:flex;flex-direction:column}.home-norme-cover{height:140px;position:relative;overflow:hidden;background:#dfeee3}.home-norme-cover:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(5,58,31,.68),rgba(5,58,31,.08))}.home-norme-cover img{width:100%;height:100%;object-fit:cover}.home-norme-cover span{position:absolute;z-index:1;top:16px;left:16px;background:#fff;color:#0f7140;border-radius:20px;padding:6px 9px;font-size:10px;font-weight:800;text-transform:uppercase}.home-norme-body{padding:17px;display:flex;flex-direction:column;flex:1}.home-norme-body small{color:#0f7140;font-size:11px;font-weight:800}.home-norme-body h3{color:#0a1f0a;font-size:16px;margin:7px 0}.home-norme-title{color:#263826;font-size:13px;font-weight:600;line-height:1.4;margin:0 0 8px}.home-norme-description{color:#687669;font-size:11px;line-height:1.5;flex:1;margin:0 0 14px}.home-norme-actions{display:flex;justify-content:space-between;align-items:center;gap:10px}.home-norme-actions a{color:#0f7140;font-size:11px;font-weight:800;text-decoration:none}.home-norme-actions a:hover{color:#0a4b2a}.home-norme-actions i{font-size:10px}.home-norme-actions .home-norme-buy{background:#0f7140;color:#fff;border-radius:8px;padding:8px 10px}.home-norme-actions .home-norme-buy:hover{background:#f5c908;color:#0a4b2a}@media(max-width:900px){.home-norme-description{font-size:12px}}.shop-pagination{display:flex;justify-content:center;align-items:center;gap:6px;margin:24px 0 4px}.shop-pagination button{border:1px solid #dfe8df;background:#fff;color:#0f7140;border-radius:8px;min-width:34px;height:34px;cursor:pointer;font-size:12px;font-weight:700}.shop-pagination button:hover,.shop-pagination button.is-active{background:#0f7140;color:#fff;border-color:#0f7140}.shop-pagination button:disabled{opacity:.4;cursor:not-allowed}</style><style>
.events-gallery-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));grid-auto-rows:190px;gap:16px}.events-gallery-card{position:relative;display:block;overflow:hidden;border-radius:18px;background:#eaf4ef;min-height:190px}.events-gallery-card:first-child{grid-column:span 2;grid-row:span 2}.events-gallery-card img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}.events-gallery-card:hover img{transform:scale(1.04)}.events-gallery-card:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 35%,rgba(5,31,15,.8))}.events-gallery-caption{position:absolute;z-index:1;left:18px;right:18px;bottom:16px;color:#fff}.events-gallery-caption small{display:block;color:#f5c908;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;margin-bottom:5px}.events-gallery-caption strong{font-size:14px;line-height:1.3}.events-gallery-empty{grid-column:1/-1;padding:44px;text-align:center;border-radius:16px;background:#f3f4f6;color:#687669}
.events-gallery-carousel{cursor:default}.events-gallery-carousel:hover img{transform:none}.events-gallery-carousel:after{display:none}
.egc-slides{position:relative;width:100%;height:100%;z-index:1}
.egc-slide:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 35%,rgba(5,31,15,.8))}
.egc-slide{position:absolute;inset:0;opacity:0;transition:opacity .6s ease}.egc-slide.active{opacity:1}
.egc-slide img{width:100%;height:100%;object-fit:cover}
.egc-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:5;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,.85);border:none;color:#0f7140;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .3s ease,background .3s ease;box-shadow:0 2px 8px rgba(0,0,0,.2)}.events-gallery-carousel:hover .egc-arrow{opacity:1}.egc-arrow:hover{background:#fff;color:#dc2626}.egc-prev{left:14px}.egc-next{right:14px}
.egc-dots{position:absolute;bottom:14px;left:50%;transform:translateX(-50%);z-index:5;display:flex;gap:6px}.egc-dot{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.5);border:none;cursor:pointer;transition:background .3s ease,transform .3s ease;padding:0}.egc-dot.active{background:#f5c908;transform:scale(1.3)}
@media(max-width:800px){.events-gallery-grid{grid-template-columns:repeat(2,minmax(0,1fr));grid-auto-rows:160px}.events-gallery-card:first-child{grid-column:span 2;grid-row:span 1}.egc-arrow{width:32px;height:32px;font-size:13px;opacity:1}}@media(max-width:520px){.events-gallery-grid{grid-template-columns:1fr}.events-gallery-card:first-child{grid-column:span 1}}
</style></head>
<body>

    <?php include 'components/header.php'; ?>

    <!-- HERO SECTION (carousel background) -->
    <section class="relative min-h-[520px] lg:min-h-[580px] overflow-hidden bg-[#0f7140]">
        <!-- Dot Pattern Overlay -->
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 24px 24px; z-index: 1; pointer-events: none;"></div>
        <!-- Carousel -->
        <div class="hero-carousel" id="heroCarousel"></div>
        <!-- Carousel Controls -->
        <button class="carousel-arrow prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-arrow next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="carousel-dots" id="carouselDots">
            <button class="carousel-dot active" onclick="goToSlide(0)"></button>
        </div>
        <!-- Hero Content (dynamic per-slide text) -->
        <div class="relative z-10 px-6 lg:px-12 pt-10 pb-6" id="heroTextContainer"></div>
    </section>

    <!-- THE BENEFIT -->
    <section class="py-16 lg:py-24 bg-[#f3f4f6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-center acq-reveal">
                <!-- Left Column -->
                <div class="lg:col-span-5">
                    <p class="section-tag">&Agrave; propos de l'ACONOQ</p>
                    <h2 class="section-heading">Qui <em>sommes-nous</em> ?</h2>
                    <p class="text-[#4a5a4c] text-[15px] leading-relaxed mb-6">
                        L'Agence Congolaise de Normalisation et de la Qualit&eacute; (ACONOQ) est l'institution nationale charg&eacute;e de la normalisation, de la m&eacute;trologie, de l'&eacute;valuation de la conformit&eacute; et de la promotion de la qualit&eacute; en R&eacute;publique du Congo.
                    </p>
                    <a href="a-propos.php" class="btn-outline" style="margin-bottom:32px">
                        En savoir plus <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <!-- Cards Mission & Vision -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="bg-white rounded-[18px] p-6 border border-[rgba(15,113,64,0.08)] hover:shadow-[0_18px_46px_rgba(15,113,64,0.14)] transition group" style="transition: all .35s">
                            <div class="w-12 h-12 rounded-full bg-[rgba(15,113,64,0.08)] flex items-center justify-center mb-4 group-hover:bg-[#0f7140] transition" style="transition: all .35s">
                                <i class="fas fa-bullseye text-[#0f7140] text-lg group-hover:text-white transition"></i>
                            </div>
                            <h4 class="font-bold text-[#1a2e1a] text-sm mb-2">Notre mission</h4>
                            <p class="text-[#6b7280] text-xs leading-relaxed">Assurer la normalisation, la m&eacute;trologie et l'&eacute;valuation de la conformit&eacute; pour garantir la s&eacute;curit&eacute; et la qualit&eacute; des produits import&eacute;s au Congo.</p>
                        </div>
                        <div class="bg-white rounded-[18px] p-6 border border-[rgba(15,113,64,0.08)] hover:shadow-[0_18px_46px_rgba(15,113,64,0.14)] transition group" style="transition: all .35s">
                            <div class="w-12 h-12 rounded-full bg-[rgba(15,113,64,0.08)] flex items-center justify-center mb-4 group-hover:bg-[#0f7140] transition" style="transition: all .35s">
                                <i class="fas fa-eye text-[#0f7140] text-lg group-hover:text-white transition"></i>
                            </div>
                            <h4 class="font-bold text-[#1a2e1a] text-sm mb-2">Notre vision</h4>
                            <p class="text-[#6b7280] text-xs leading-relaxed">Devenir une r&eacute;f&eacute;rence en mati&egrave;re de normalisation et de qualit&eacute; en Afrique centrale, au service du d&eacute;veloppement &eacute;conomique durable.</p>
                        </div>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="lg:col-span-7 relative">
                    <div class="relative rounded-[22px] overflow-hidden shadow-2xl">
                        <img src="https://www.aconoq-apps.com/aconoq/wp-content/uploads/2025/07/slider11-scaled.png" alt="Equipe ACONOQ" class="w-full h-[480px] lg:h-[560px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f7140]/40 via-transparent to-transparent"></div>
                        <!-- Badge bottom -->
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-sm rounded-[18px] p-5 flex items-center gap-4 z-20 shadow-lg">
                            <div class="w-12 h-12 rounded-full bg-[rgba(15,113,64,0.1)] flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-certificate text-[#0f7140] text-lg"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-[#1a2e1a] text-sm">Excellence &amp; Pr&eacute;CISION</p>
                                <p class="text-[#6b7280] text-xs">L'ACONOQ accompagne les op&eacute;rateurs &eacute;conomiques.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT WE DO SECTION -->
    <section class="pt-4 pb-8 lg:pt-6 lg:pb-12 bg-transparent relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-transparent p-0">
                <div class="mb-12">
                    <p class="section-tag">Ce que nous faisons</p>
                    <h2 class="section-heading">Nos services <em>phares</em></h2>
                    <p class="section-text">
                        Nous offrons une gamme compl&egrave;te de services en normalisation, m&eacute;trologie, certification et promotion de la qualit&eacute; pour garantir la conformit&eacute; de vos produits et proc&eacute;d&eacute;s.
                    </p>
                </div>
                <div id="dynamic-services" class="features-grid acq-reveal"></div>
            </div>
        </div>
    </section>

    <!-- ÉVALUATION DE LA CONFORMITÉ – LES ROUTES DU PCEC -->
    <section class="relative py-20 lg:py-28 overflow-hidden mt-[100px]">
        <div class="absolute inset-0">
            <img src="https://www.productcomplianceinstitute.com/wp-content/uploads/2022/05/AdobeStock_182832800-2-scaled.jpeg" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#0a1f12]/88"></div>
        </div>
        <div class="absolute z-10 hidden lg:block" style="top: 0; right: 200px;">
            <div class="flex items-center divide-x divide-gray-200 rounded-b-2xl overflow-hidden shadow-lg p-2.5" style="background: #f3f4f6;">
                <a href="pcec.php" class="flex items-center gap-2.5 px-5 py-2.5 text-[#4a5a4c] hover:text-[#0f7140] transition-all text-sm font-medium">
                    <i class="fas fa-file-signature text-[#0f7140] text-xs"></i> Demande de CoC
                </a>
                <a href="pcec.php" class="flex items-center gap-2.5 px-5 py-2.5 text-[#4a5a4c] hover:text-[#0f7140] transition-all text-sm font-medium">
                    <i class="fas fa-info-circle text-[#0f7140] text-xs"></i> Informations pratiques
                </a>
                <a href="pcec.php" class="flex items-center gap-2.5 px-5 py-2.5 text-[#4a5a4c] hover:text-[#0f7140] transition-all text-sm font-medium">
                    <i class="fas fa-lightbulb text-[#0f7140] text-xs"></i> Conseils
                </a>
                <a href="pcec.php" class="flex items-center gap-2.5 px-5 py-2.5 text-[#4a5a4c] hover:text-[#0f7140] transition-all text-sm font-medium">
                    <i class="fas fa-book-open text-[#0f7140] text-xs"></i> Comprendre le programme
                </a>
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <p class="text-[#f5c908] text-xs font-semibold tracking-widest uppercase mb-3 flex items-center gap-2">
                        <span style="width:6px;height:6px;border-radius:50%;background:#f5c908;display:inline-block"></span>
                        Évaluation de la conformité
                    </p>
                    <h2 class="text-3xl lg:text-5xl font-bold text-white mb-4" style="letter-spacing:-0.03em;">Les routes du <em style="font-style:normal;color:#f5c908;">PCEC</em></h2>
                    <p class="text-white/60 text-[15px] leading-relaxed">Trois parcours d'évaluation adaptés à la fréquence et à la nature des importations au Congo.</p>
                </div>
            </div>

            <div class="programs-grid">
                <article class="program-card">
                    <span class="program-number">01.</span>
                    <span class="program-icon"><i class="fas fa-clipboard-check"></i></span>
                    <h3>Route A – Contrôle systématique</h3>
                    <p>Pour les importations peu fréquentes. Chaque shipment fait l'objet d'un contrôle documentaire et physique complet.</p>
                    <ul><li><i class="fas fa-check"></i> Contrôle documentaire</li><li><i class="fas fa-check"></i> Inspection physique</li></ul>
                    <a href="pcec.php" class="program-link">Découvrir la route A <i class="fas fa-arrow-right"></i></a>
                </article>
                <article class="program-card">
                    <span class="program-number">02.</span>
                    <span class="program-icon"><i class="fas fa-bolt"></i></span>
                    <h3>Route B – Contrôle inopiné</h3>
                    <p>Pour les importateurs enregistrés. Des inspections aléatoires garantissent la conformité continue des produits.</p>
                    <ul><li><i class="fas fa-check"></i> Inspections aléatoires</li><li><i class="fas fa-check"></i> Suivi continu</li></ul>
                    <a href="pcec.php" class="program-link">Découvrir la route B <i class="fas fa-arrow-right"></i></a>
                </article>
                <article class="program-card">
                    <span class="program-number">03.</span>
                    <span class="program-icon"><i class="fas fa-industry"></i></span>
                    <h3>Route C – Audit d'usine</h3>
                    <p>Pour les produits sous licence. Un audit d'usine combiné à un contrôle régulier pour une certification durable.</p>
                    <ul><li><i class="fas fa-check"></i> Audit d'usine</li><li><i class="fas fa-check"></i> Certification durable</li></ul>
                    <a href="pcec.php" class="program-link">Découvrir la route C <i class="fas fa-arrow-right"></i></a>
                </article>
            </div>
        </div>
    </section>


    <!-- FEATURED PROJECTS SECTION -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <p class="section-tag">A la Une</p>
                    <h2 class="section-heading">Actualit&eacute;</h2>
                </div>
                <a href="actualites.php" class="link-more hidden sm:inline-flex"><span class="link-more-inner">Voir toute l'actualit&eacute;</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
            </div>
            <div id="dynamic-actualites" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 acq-reveal"></div>
            <div class="mt-6 text-center sm:hidden">
                <a href="actualites.php" class="link-more sm:hidden"><span class="link-more-inner">Voir toute l'actualit&eacute;</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
            </div>
        </div>
    </section>

    <!-- NORMES POPULAIRES -->
    <section class="relative py-16 lg:py-24 overflow-hidden bg-[#f3f4f6]">
        <div class="absolute inset-0">
            <img src="https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=1920" alt="" class="w-full h-full object-cover" style="filter: blur(2px) brightness(0.8); opacity:0.15;">
        </div>
        <div class="absolute inset-0 bg-[#f3f4f6]/80"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">            <div class="mb-10 flex items-end justify-between gap-6 flex-wrap">
                <div><p class="section-tag">R&eacute;f&eacute;rence</p><h2 class="section-heading">Nos Normes <span class="text-gray-400 font-normal text-2xl">(<span id="normes-count">0</span>)</span></h2></div>
                <div class="normes-actions flex items-center gap-3">
                    <a href="#normes-grid" class="link-more hidden sm:inline-flex"><span class="link-more-inner"><i class="fas fa-book-open"></i>Catalogue des Normes</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
                    <a href="boutique.php" class="link-more hidden sm:inline-flex"><span class="link-more-inner"><i class="fas fa-shopping-cart"></i>Acheter une norme</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row flex-wrap gap-3 mb-8">
                <div class="norme-search relative flex-1 min-w-[200px]">
                    <input type="text" id="norme-search-input" placeholder="Rechercher par nom, code..." class="w-full pl-10 pr-4 py-2.5 border border-[rgba(15,113,64,0.15)] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0f7140] focus:border-transparent bg-white">
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                </div>
                <select id="filter-categorie" class="px-4 py-2.5 border border-[rgba(15,113,64,0.15)] rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#0f7140] focus:border-transparent bg-white">
                    <option value="all">Toutes les cat&eacute;gories</option>
                </select>
                <select id="filter-type-iso" class="px-4 py-2.5 border border-[rgba(15,113,64,0.15)] rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#0f7140] focus:border-transparent bg-white">
                    <option value="all">Tous les types</option>
                </select>
                <select id="filter-origine" class="px-4 py-2.5 border border-[rgba(15,113,64,0.15)] rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#0f7140] focus:border-transparent bg-white">
                    <option value="all">Toutes origines</option>
                </select>
                <select id="filter-annee" class="px-4 py-2.5 border border-[rgba(15,113,64,0.15)] rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#0f7140] focus:border-transparent bg-white">
                    <option value="all">Toutes ann&eacute;es</option>
                </select>
            </div>
            <div id="normes-grid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 acq-reveal">
            </div><div id="normes-pagination" class="shop-pagination"></div>
        </div>
    </section>

    <!-- OUR PROCESS SECTION -->
    <section class="py-16 lg:py-24 bg-white relative dot-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <!-- Left - Heading -->
                <div class="lg:col-span-4">
                    <p class="section-tag">Notre Processus</p>
                    <h2 class="section-heading"><span class="text-red">Tout ce que vous aimeriez savoir</span></h2>
                    <p class="text-[#4a5a4c] text-[15px] leading-relaxed mb-6">
                        Nous suivons un processus rigoureux qui garantit la qualit&eacute;, la transparence et l'efficacit&eacute; &agrave; chaque &eacute;tape.
                    </p>
                    <a href="#" class="btn-red-outline">
                        En savoir plus <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
                <!-- Right - 3 Process Cards -->
                <div class="lg:col-span-8 relative">
                    <div class="overflow-hidden rounded-[18px]">
                        <div id="processCarousel" class="flex transition-transform duration-500 ease-in-out acq-reveal"></div>
                    </div>
                    <button onclick="moveProcess(-1)" class="absolute top-1/2 -left-5 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center text-[#0f7140] hover:bg-[#dc2626] hover:text-white transition z-10 border border-[rgba(15,113,64,0.1)]"><i class="fas fa-chevron-left text-sm"></i></button>
                    <button onclick="moveProcess(1)" class="absolute top-1/2 -right-5 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center text-[#0f7140] hover:bg-[#dc2626] hover:text-white transition z-10 border border-[rgba(15,113,64,0.1)]"><i class="fas fa-chevron-right text-sm"></i></button>
                    <div class="flex justify-center gap-2 mt-6">
                        <button onclick="goProcess(0)" class="process-dot w-2.5 h-2.5 rounded-full bg-[#0f7140] transition-colors"></button>
                        <button onclick="goProcess(1)" class="process-dot w-2.5 h-2.5 rounded-full bg-gray-300 transition-colors"></button>
                        <button onclick="goProcess(2)" class="process-dot w-2.5 h-2.5 rounded-full bg-gray-300 transition-colors"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- &Eacute;V&Eacute;NEMENTS -->
    <section class="py-16 lg:py-24 bg-[#f3f4f6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <p class="section-tag">Calendrier</p>
                    <h2 class="section-heading">&Eacute;v&eacute;nements <em>&agrave; venir</em></h2>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="#evenements-grid" class="link-more hidden sm:inline-flex"><span class="link-more-inner">Voir tout</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
                </div>
            </div>
            <div id="evenements-grid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 acq-reveal">
            </div>
        </div>
    </section>

    <!-- GALERIE PHOTOS ÉVÉNEMENTS -->
    <section class="events-gallery-section py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10">
                <div><p class="section-tag">Moments forts</p><h2 class="section-heading">Galerie photos <em>événements</em></h2></div>
                <a href="evenements.php" class="link-more hidden sm:inline-flex"><span class="link-more-inner">Tous les événements</span><span class="link-more-arrow"><i class="fas fa-arrow-right"></i></span></a>
            </div>
            <div id="events-gallery-grid" class="events-gallery-grid"></div>
        </div>
    </section>
    <!-- PARTENAIRES -->
    <section class="partenaires-section py-14 lg:py-20 bg-[#f3f4f6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 text-center">
            <p class="section-tag justify-center">Ils nous font confiance</p>
            <h2 class="section-heading">Nos <em>Partenaires</em></h2>
        </div>
        <div class="overflow-hidden">
            <div id="dynamic-partenaires" class="partenaires-track acq-reveal"></div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-16 lg:py-24 relative dot-pattern">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <p class="section-tag justify-center">Questions fr&eacute;quentes</p>
                <h2 class="section-heading">Vous avez des <em>questions</em> ?</h2>
            </div>
            <div class="space-y-3">
                <div class="faq-item bg-[#f3f4f6] rounded-[18px] border border-[rgba(15,113,64,0.08)] overflow-hidden transition">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-[#1a2e1a] text-sm pr-4">Qu'est-ce que l'ACONOQ ?</span>
                        <i class="fas fa-plus text-[#0f7140] text-sm transition-transform flex-shrink-0"></i>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-[#4a5a4c] text-sm leading-relaxed">L'ACONOQ est l'Agence Congolaise de Normalisation et de la Qualit&eacute;, institution nationale charg&eacute;e de la normalisation, de la m&eacute;trologie, de l'&eacute;valuation de la conformit&eacute; et de la promotion de la qualit&eacute; en R&eacute;publique du Congo.</p>
                    </div>
                </div>
                <div class="faq-item bg-[#f3f4f6] rounded-[18px] border border-[rgba(15,113,64,0.08)] overflow-hidden transition">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-[#1a2e1a] text-sm pr-4">Comment obtenir une certification de conformit&eacute; ?</span>
                        <i class="fas fa-plus text-[#0f7140] text-sm transition-transform flex-shrink-0"></i>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-[#4a5a4c] text-sm leading-relaxed">Pour obtenir une certification, vous devez contacter notre direction de la conformit&eacute; qui vous guidera &agrave; travers le processus d'&eacute;valuation adapt&eacute; &agrave; votre type d'importation (Route A, B ou C).</p>
                    </div>
                </div>
                <div class="faq-item bg-[#f3f4f6] rounded-[18px] border border-[rgba(15,113,64,0.08)] overflow-hidden transition">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-[#1a2e1a] text-sm pr-4">Quelles sont les diff&eacute;rentes routes d'&eacute;valuation du PCEC ?</span>
                        <i class="fas fa-plus text-[#0f7140] text-sm transition-transform flex-shrink-0"></i>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-[#4a5a4c] text-sm leading-relaxed">Le PCEC d&eacute;finit trois routes : la Route A pour les importations peu fr&eacute;quentes (contr&ocirc;le syst&eacute;matique), la Route B pour les importations enregistr&eacute;es (contr&ocirc;le inopin&eacute;), et la Route C pour les produits sous licence (audit d'usine + contr&ocirc;le).</p>
                    </div>
                </div>
                <div class="faq-item bg-[#f3f4f6] rounded-[18px] border border-[rgba(15,113,64,0.08)] overflow-hidden transition">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-[#1a2e1a] text-sm pr-4">Comment acc&eacute;der &agrave; la base de donn&eacute;es des normes ?</span>
                        <i class="fas fa-plus text-[#0f7140] text-sm transition-transform flex-shrink-0"></i>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-[#4a5a4c] text-sm leading-relaxed">Vous pouvez consulter et rechercher nos normes directement depuis la section &laquo; Nos Normes &raquo; sur notre site. Les filtres par cat&eacute;gorie, type ISO et origine vous permettent de trouver rapidement la norme recherch&eacute;e.</p>
                    </div>
                </div>
                <div class="faq-item bg-[#f3f4f6] rounded-[18px] border border-[rgba(15,113,64,0.08)] overflow-hidden transition">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-[#1a2e1a] text-sm pr-4">O&ugrave; se trouve l'ACONOQ ?</span>
                        <i class="fas fa-plus text-[#0f7140] text-sm transition-transform flex-shrink-0"></i>
                    </button>
                    <div class="faq-answer hidden px-6 pb-5">
                        <p class="text-[#4a5a4c] text-sm leading-relaxed">L'ACONOQ est situ&eacute;e &agrave; Brazzaville, R&eacute;publique du Congo. Vous pouvez nous contacter via notre formulaire en ligne ou par t&eacute;l&eacute;phone pour toute demande d'information.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script>
        // Hero Carousel - works with dynamic slides
        let currentSlide = 0;
        let slides, dots, totalSlides;
        let autoplayInterval;

        function initCarousel() {
            slides = document.querySelectorAll('.hero-slide');
            dots = document.querySelectorAll('.carousel-dot');
            totalSlides = slides.length;
            if (totalSlides > 0) startAutoplay();
        }

        function goToSlide(index) {
            if (!slides || !slides.length) return;
            const prevText = document.querySelector('.hero-text-group.active');
            if (prevText) { prevText.classList.remove('active'); prevText.classList.add('exit'); }
            slides[currentSlide].classList.remove('active');
            if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
            setTimeout(() => {
                document.querySelectorAll('.hero-text-group.exit').forEach(el => el.classList.remove('exit'));
            }, 600);
            const nextText = document.querySelector(`.hero-text-group[data-slide-index="${index}"]`);
            if (nextText) { nextText.classList.remove('exit'); nextText.classList.add('active'); }
        }

        function changeSlide(direction) {
            if (!slides || !slides.length) return;
            let next = currentSlide + direction;
            if (next < 0) next = totalSlides - 1;
            if (next >= totalSlides) next = 0;
            goToSlide(next);
            resetAutoplay();
        }

        function startAutoplay() {
            autoplayInterval = setInterval(() => changeSlide(1), 5000);
        }

        function resetAutoplay() {
            clearInterval(autoplayInterval);
            startAutoplay();
        }

        // Init carousel after dynamic content loads (fallback if loadDynamicHeroSlides already called it)
        setTimeout(initCarousel, 2500);

        // Process Carousel
        let processIndex = 0;

        function moveProcess(dir) {
            const processCarousel = document.getElementById('processCarousel');
            if (!processCarousel) return;
            const items = processCarousel.querySelectorAll('.process-slide');
            const processTotal = Math.ceil(items.length / 3);
            processIndex += dir;
            if (processIndex < 0) processIndex = processTotal - 1;
            if (processIndex >= processTotal) processIndex = 0;
            updateProcess();
        }

        function goProcess(i) {
            processIndex = i;
            updateProcess();
        }

        function updateProcess() {
            const processCarousel = document.getElementById('processCarousel');
            if (!processCarousel) return;
            const processDots = document.querySelectorAll('.process-dot');
            processCarousel.style.transform = 'translateX(-' + (processIndex * 33.333) + '%)';
            processDots.forEach((d, i) => {
                d.classList.toggle('bg-primary', i === processIndex);
                d.classList.toggle('bg-gray-300', i !== processIndex);
            });
        }
    </script>

    <script>
// Mobile Menu
function openMobileMenu() {
    document.getElementById('mobile-menu').classList.remove('hidden');
    document.getElementById('mobile-menu-panel').classList.remove('-translate-x-full');
    document.body.style.overflow = 'hidden';
}
function closeMobileMenu() {
    document.getElementById('mobile-menu').classList.add('hidden');
    document.getElementById('mobile-menu-panel').classList.add('-translate-x-full');
    document.body.style.overflow = '';
}
function toggleMobileAccordion(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('i');
    content.classList.toggle('hidden');
    icon.style.transform = content.classList.contains('hidden') ? '' : 'rotate(180deg)';
}

// Back to Top
window.addEventListener('scroll', function() {
    const btn = document.getElementById('back-to-top');
    if (window.scrollY > 400) {
        btn.classList.remove('opacity-0', 'pointer-events-none');
        btn.classList.add('opacity-100');
    } else {
        btn.classList.add('opacity-0', 'pointer-events-none');
        btn.classList.remove('opacity-100');
    }
});

// FAQ Toggle
function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const icon = btn.querySelector('i');
    const allItems = document.querySelectorAll('.faq-item');
    allItems.forEach(i => {
        if (i !== item) {
            i.querySelector('.faq-answer').classList.add('hidden');
            i.querySelector('i').classList.remove('rotate-45');
            i.querySelector('i').classList.add('fa-plus');
            i.querySelector('i').classList.remove('fa-minus');
        }
    });
    answer.classList.toggle('hidden');
    if (answer.classList.contains('hidden')) {
        icon.classList.remove('rotate-45', 'fa-minus');
        icon.classList.add('fa-plus');
    } else {
        icon.classList.add('rotate-45', 'fa-minus');
        icon.classList.remove('fa-plus');
    }
}

// Newsletter form
(function() {
    const form = document.getElementById('homepage-newsletter');
    if (!form) return;
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = form.querySelector('[name="email"]').value.trim();
        if (!email) return;
        const btn = form.querySelector('button[type="submit"]');
        const orig = btn.textContent;
        btn.textContent = '...';
        btn.disabled = true;
        try {
            const { error } = await supabaseClient.from('newsletter_subscribers').upsert({ email }, { onConflict: 'email' });
            if (error) throw error;
            btn.textContent = 'Inscrit !';
            btn.classList.add('bg-green-600');
            form.querySelector('[name="email"]').value = '';
            setTimeout(() => { btn.textContent = orig; btn.classList.remove('bg-green-600'); btn.disabled = false; }, 3000);
        } catch(err) {
            btn.textContent = 'Erreur';
            btn.classList.add('bg-red-500');
            setTimeout(() => { btn.textContent = orig; btn.classList.remove('bg-red-500'); btn.disabled = false; }, 3000);
        }
    });
})();
    </script>

</body>
</html>

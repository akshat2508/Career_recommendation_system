<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerAI — Find Your Ideal Career Path</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Instrument+Serif:ital@0;1&family=Unbounded:wght@700;900&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css'])

    <style>
        /* =============================================
           RESET & ROOT
        ============================================= */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --black:     #0a0a0a;
            --white:     #fafaf5;
            --lime:      #c8f73d;
            --coral:     #ff4d4d;
            --sky:       #3df7d4;
            --yellow:    #ffe500;
            --violet:    #7c3aed;
            --border:    3px solid #0a0a0a;
            --shadow:    5px 5px 0 #0a0a0a;
            --shadow-lg: 8px 8px 0 #0a0a0a;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--white);
            color: var(--black);
            font-family: 'Space Grotesk', sans-serif;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Noise overlay */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }

        /* =============================================
           TYPOGRAPHY HELPERS
        ============================================= */
        .font-display  { font-family: 'Unbounded', sans-serif; }
        .font-serif    { font-family: 'Instrument Serif', serif; }
        .font-body     { font-family: 'Space Grotesk', sans-serif; }

        /* =============================================
           BUTTONS
        ============================================= */
        .btn {
            border: var(--border);
            padding: 10px 22px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            background: transparent;
            color: var(--black);
            font-family: 'Space Grotesk', sans-serif;
            transition: transform 0.1s, box-shadow 0.1s;
            box-shadow: var(--shadow);
            display: inline-block;
            text-decoration: none;
            letter-spacing: 0.2px;
        }
        .btn:hover  { transform: translate(-2px, -2px); box-shadow: 7px 7px 0 var(--black); }
        .btn:active { transform: translate(2px, 2px);  box-shadow: 3px 3px 0 var(--black); }

        .btn-lime   { background: var(--lime); }
        .btn-coral  { background: var(--coral); color: var(--white); }
        .btn-yellow { background: var(--yellow); }
        .btn-sky    { background: var(--sky); }
        .btn-ghost  { background: rgba(255,255,255,0.1); color: var(--white); border-color: rgba(255,255,255,0.3); box-shadow: none; }
        .btn-ghost:hover { box-shadow: none; background: rgba(255,255,255,0.2); }

        .btn-lg { padding: 16px 36px; font-size: 17px; }
        .btn-xl { padding: 18px 44px; font-size: 18px; }

        /* =============================================
           SECTION BASE
        ============================================= */
        .section {
            padding: 80px 60px;
            border-bottom: var(--border);
        }

        .section-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Unbounded', sans-serif;
            font-size: clamp(26px, 3.5vw, 40px);
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 48px;
            letter-spacing: -0.5px;
        }

        /* =============================================
           SCROLL REVEAL
        ============================================= */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }


        /* =============================================
           NAVIGATION
        ============================================= */
        .nav {
            border-bottom: var(--border);
            padding: 16px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--white);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-logo {
            font-family: 'Unbounded', sans-serif;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -0.5px;
            text-decoration: none;
            color: var(--black);
        }
        .nav-logo span { color: var(--coral); }

        .nav-links {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .nav-plain {
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            color: var(--black);
            padding: 8px 16px;
            border: 2px solid transparent;
            transition: border-color 0.15s;
        }
        .nav-plain:hover { border-color: var(--black); }


        /* =============================================
           TICKER / MARQUEE
        ============================================= */
        .ticker {
            background: var(--black);
            color: var(--lime);
            padding: 11px 0;
            overflow: hidden;
            border-bottom: var(--border);
            font-family: 'Unbounded', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .ticker-inner {
            display: flex;
            gap: 60px;
            white-space: nowrap;
            animation: ticker-scroll 22s linear infinite;
        }
        .ticker-inner:hover { animation-play-state: paused; }
        .ticker-item::before { content: "★ "; color: var(--coral); }

        @keyframes ticker-scroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }


        /* =============================================
           HERO
        ============================================= */
        .hero {
            background: var(--yellow);
            border-bottom: var(--border);
            padding: 90px 60px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
            align-items: center;
            position: relative;
            overflow: hidden;
            min-height: 600px;
        }

        /* Decorative floating circle */
        .hero::before {
            content: "";
            position: absolute;
            right: -80px; top: -80px;
            width: 360px; height: 360px;
            background: var(--coral);
            border: var(--border);
            border-radius: 50%;
            z-index: 0;
            animation: hero-float 4s ease-in-out infinite;
        }

        /* Decorative dot grid */
        .hero::after {
            content: "";
            position: absolute;
            left: 40px; bottom: 40px;
            width: 120px; height: 120px;
            background-image: radial-gradient(circle, var(--black) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            opacity: 0.2;
            z-index: 0;
        }

        @keyframes hero-float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-24px) rotate(6deg); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-tag {
            display: inline-block;
            background: var(--black);
            color: var(--lime);
            padding: 6px 16px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .hero h1 {
            font-family: 'Unbounded', sans-serif;
            font-size: clamp(38px, 5vw, 64px);
            font-weight: 900;
            line-height: 1.04;
            letter-spacing: -1.5px;
            margin-bottom: 24px;
        }

        .hero h1 .accent {
            font-family: 'Instrument Serif', serif;
            font-style: italic;
            color: var(--violet);
            font-size: 1.08em;
        }

        .hero-desc {
            font-size: 18px;
            line-height: 1.75;
            max-width: 460px;
            margin-bottom: 40px;
            color: #333;
        }

        .hero-btns {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .hero-stats {
            display: flex;
            gap: 36px;
            flex-wrap: wrap;
        }

        .stat-item {
            border-left: 4px solid var(--black);
            padding-left: 16px;
        }

        .stat-num {
            font-family: 'Unbounded', sans-serif;
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: #555;
        }

        /* Hero visual — stacked career cards */
        .hero-visual {
            position: relative;
            z-index: 1;
        }

        .career-card {
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow-lg);
            padding: 28px 32px;
            margin-bottom: 16px;
            opacity: 0;
            animation: card-slide-in 0.6s ease forwards;
        }
        .career-card:nth-child(1) { animation-delay: 0.3s; }
        .career-card:nth-child(2) { animation-delay: 0.55s; margin-left: 30px; background: var(--sky); }
        .career-card:nth-child(3) { animation-delay: 0.8s;  margin-left: 60px; background: var(--lime); }

        @keyframes card-slide-in {
            from { opacity: 0; transform: translateX(50px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .career-card-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #666;
            margin-bottom: 8px;
        }

        .career-card-title {
            font-family: 'Unbounded', sans-serif;
            font-size: 20px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .career-card-badge {
            display: inline-block;
            background: var(--black);
            color: var(--lime);
            padding: 4px 14px;
            font-size: 13px;
            font-weight: 700;
        }


        /* =============================================
           WHAT WE DO — 3 COLUMN BORDERED GRID
        ============================================= */
        .what-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border: var(--border);
        }

        .what-card {
            padding: 44px 32px;
            border-right: var(--border);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s;
            cursor: default;
        }
        .what-card:last-child { border-right: none; }

        /* Animated bottom bar on hover */
        .what-card::after {
            content: "";
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 6px;
            background: var(--black);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }
        .what-card:hover::after { transform: scaleX(1); }
        .what-card:hover { transform: translateY(-5px); }

        .what-card-num {
            font-family: 'Unbounded', sans-serif;
            font-size: 52px;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 20px;
            color: black;
        }

        .what-card-icon {
            width: 56px; height: 56px;
            border: var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 24px;
            box-shadow: 3px 3px 0 var(--black);
        }

        .what-card h3 {
            font-family: 'Unbounded', sans-serif;
            font-size: 17px;
            font-weight: 900;
            margin-bottom: 14px;
        }

        .what-card p {
            font-size: 15px;
            line-height: 1.75;
            color: #444;
        }

        .bg-lime   { background: var(--lime); }
        .bg-sky    { background: var(--sky); }
        .bg-coral  { background: var(--coral); color: var(--white); }
        .bg-coral p, .bg-coral .what-card-label { color: rgba(255,255,255,0.8); }


        /* =============================================
           FEATURES — DARK SECTION
        ============================================= */
        .features-section {
            background: var(--black);
            color: var(--white);
        }
        .features-section .section-label { color: #444; }
        .features-section .section-title { color: var(--lime); }

        .feat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2px;
            background: #1a1a1a;
            border: var(--border);
            border-color: #1a1a1a;
        }

        .feat {
            padding: 40px 36px;
            background: var(--black);
            border: 2px solid #222;
            transition: border-color 0.25s, background 0.25s;
            cursor: default;
            position: relative;
        }
        .feat:hover { border-color: var(--lime); background: #0f0f0f; }

        .feat-num {
            font-family: 'Unbounded', sans-serif;
            font-size: 40px;
            font-weight: 900;
            color: white;
            margin-bottom: 20px;
            line-height: 1;
            transition: color 0.25s;
        }
        .feat:hover .feat-num { color: #2a2a2a; }

        .feat h3 {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--white);
        }

        .feat p {
            font-size: 14px;
            line-height: 1.8;
            color: #777;
        }

        .feat-tag {
            display: inline-block;
            margin-top: 20px;
            padding: 5px 14px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #2a2a2a;
            color: #444;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.25s;
        }
        .feat:hover .feat-tag { border-color: var(--lime); color: var(--lime); }


        /* =============================================
           HOW IT WORKS — 4-STEP ROW
        ============================================= */
        .steps-wrap {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border: var(--border);
            margin-top: 48px;
        }

        .step {
            padding: 40px 28px;
            border-right: var(--border);
            position: relative;
        }
        .step:last-child { border-right: none; }

        /* Arrow connector between steps */
        .step:not(:last-child)::after {
            content: "→";
            position: absolute;
            top: 50%; right: -22px;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: 900;
            z-index: 10;
            background: var(--black);
            color: var(--lime);
            width: 40px; height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: var(--border);
        }

        .step-num {
            font-family: 'Unbounded', sans-serif;
            font-size: 68px;
            font-weight: 900;
            color: var(--lime);
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 3px 3px 0 var(--black);
        }

        .step h3 {
            font-family: 'Unbounded', sans-serif;
            font-size: 14px;
            font-weight: 900;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .step p {
            font-size: 13px;
            line-height: 1.8;
            color: #555;
        }


        /* =============================================
           SOCIAL PROOF / TESTIMONIALS
        ============================================= */
        .proof-section {
            background: var(--lime);
        }

        .testimonials {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border: var(--border);
            margin-top: 48px;
        }

        .testi {
            border-right: var(--border);
            padding: 40px 32px;
            background: var(--white);
        }
        .testi:last-child { border-right: none; }
        .testi:nth-child(2) { background: var(--coral); color: var(--white); }

        .testi-stars {
            font-size: 18px;
            color: var(--black);
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        .testi:nth-child(2) .testi-stars { color: var(--yellow); }

        .testi-quote {
            font-family: 'Instrument Serif', serif;
            font-style: italic;
            font-size: 18px;
            line-height: 1.65;
            margin-bottom: 28px;
        }
        .testi:nth-child(2) .testi-quote { color: var(--white); }

        .testi-author {
            font-weight: 700;
            font-size: 14px;
        }

        .testi-role {
            font-size: 13px;
            color: #777;
            margin-top: 4px;
        }
        .testi:nth-child(2) .testi-role { color: rgba(255,255,255,0.65); }


        /* =============================================
           PRICING TEASER
        ============================================= */
        .pricing-section {
            background: var(--white);
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            border: var(--border);
            margin-top: 48px;
        }

        .price-card {
            padding: 44px 32px;
            border-right: var(--border);
            position: relative;
        }
        .price-card:last-child { border-right: none; }
        .price-card.featured { background: var(--violet); color: var(--white); }

        .price-plan {
            font-family: 'Unbounded', sans-serif;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }
        .price-card.featured .price-plan { color: var(--lime); }

        .price-amount {
            font-family: 'Unbounded', sans-serif;
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 6px;
        }

        .price-period {
            font-size: 14px;
            color: #888;
            margin-bottom: 32px;
        }
        .price-card.featured .price-period { color: rgba(255,255,255,0.6); }

        .price-features {
            list-style: none;
            margin-bottom: 36px;
        }
        .price-features li {
            font-size: 14px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #444;
        }
        .price-card.featured .price-features li { border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.8); }
        .price-features li::before {
            content: "✓";
            font-weight: 900;
            color: var(--black);
            font-size: 13px;
        }
        .price-card.featured .price-features li::before { color: var(--lime); }

        .price-badge {
            position: absolute;
            top: -1px; right: 24px;
            background: var(--lime);
            border: var(--border);
            border-top: none;
            padding: 6px 14px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }


        /* =============================================
           CTA SECTION
        ============================================= */
        .cta-section {
            background: var(--violet);
            padding: 110px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated blobs */
        .cta-section::before {
            content: "";
            position: absolute;
            left: -120px; bottom: -120px;
            width: 440px; height: 440px;
            background: var(--coral);
            border-radius: 50%;
            opacity: 0.25;
            animation: blob-pulse 3.5s ease-in-out infinite;
        }
        .cta-section::after {
            content: "";
            position: absolute;
            right: -80px; top: -80px;
            width: 320px; height: 320px;
            background: var(--lime);
            border-radius: 50%;
            opacity: 0.18;
            animation: blob-pulse 4s ease-in-out infinite reverse;
        }

        @keyframes blob-pulse {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.12); }
        }

        .cta-inner {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-family: 'Unbounded', sans-serif;
            font-size: clamp(36px, 5.5vw, 64px);
            font-weight: 900;
            color: var(--white);
            line-height: 1.08;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 44px;
            line-height: 1.7;
        }

        .cta-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }


        /* =============================================
           FOOTER
        ============================================= */
        .footer {
            background: var(--black);
            color: var(--white);
            border-top: var(--border);
            border-color: #222;
        }

        .footer-top {
            padding: 60px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 40px;
            border-bottom: 1px solid #1a1a1a;
        }

        .footer-logo {
            font-family: 'Unbounded', sans-serif;
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 16px;
            display: block;
            text-decoration: none;
            color: var(--white);
        }
        .footer-logo span { color: var(--lime); }

        .footer-tagline {
            font-size: 14px;
            color: #666;
            line-height: 1.7;
            max-width: 260px;
        }

        .footer-col-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #444;
            margin-bottom: 20px;
        }

        .footer-links-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links-list a {
            font-size: 14px;
            color: #777;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links-list a:hover { color: var(--lime); }

        .footer-bottom {
            padding: 24px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-copy { font-size: 13px; color: #444; }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .social-link {
            width: 36px; height: 36px;
            border: 1px solid #222;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .social-link:hover { background: var(--lime); color: var(--black); border-color: var(--lime); }


        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (max-width: 1024px) {
            .nav        { padding: 16px 32px; }
            .hero       { padding: 70px 32px; grid-template-columns: 1fr; }
            .hero::before { display: none; }
            .hero-visual { display: none; }
            .section    { padding: 70px 32px; }
            .cta-section{ padding: 90px 32px; }
        }

        @media (max-width: 768px) {
            .nav        { padding: 14px 20px; }
            .hero       { padding: 60px 20px; }
            .section    { padding: 60px 20px; }
            .cta-section{ padding: 70px 20px; }

            .what-grid  { grid-template-columns: 1fr; }
            .what-card  { border-right: none; border-bottom: var(--border); }
            .what-card:last-child { border-bottom: none; }

            .feat-grid  { grid-template-columns: 1fr; }

            .steps-wrap { grid-template-columns: 1fr 1fr; }
            .step:not(:last-child)::after { display: none; }
            .step:nth-child(2) { border-right: none; }

            .testimonials   { grid-template-columns: 1fr; }
            .testi          { border-right: none; border-bottom: var(--border); }
            .testi:last-child{ border-bottom: none; }

            .pricing-grid { grid-template-columns: 1fr; }
            .price-card   { border-right: none; border-bottom: var(--border); }
            .price-card:last-child { border-bottom: none; }

            .footer-top    { grid-template-columns: 1fr 1fr; padding: 40px 20px; }
            .footer-bottom { padding: 20px; flex-direction: column; gap: 16px; text-align: center; }
        }

        @media (max-width: 480px) {
            .hero h1    { font-size: 36px; }
            .hero-btns  { flex-direction: column; }
            .hero-stats { gap: 20px; }
            .steps-wrap { grid-template-columns: 1fr; }
            .cta-btns   { flex-direction: column; align-items: center; }
            .footer-top { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

{{-- ================================================
     NAVIGATION
================================================ --}}
<nav class="nav">
    <a href="{{ url('/') }}" class="nav-logo">Career<span>AI</span></a>

    <div class="nav-links">
        <a href="{{ route('login') }}" class="nav-plain">Login</a>
        <a href="{{ route('register') }}" class="btn btn-lime">Get Started →</a>
    </div>
</nav>


{{-- ================================================
     TICKER / MARQUEE
================================================ --}}
<div class="ticker" aria-hidden="true">
    <div class="ticker-inner">
        <span class="ticker-item">AI-Powered Career Matching</span>
        <span class="ticker-item">10,000+ Career Paths Analyzed</span>
        <span class="ticker-item">Personality-Based Suggestions</span>
        <span class="ticker-item">Skill Gap Analysis</span>
        <span class="ticker-item">Downloadable Career Reports</span>
        <span class="ticker-item">Find Your Dream Job</span>
        <span class="ticker-item">94% Match Accuracy</span>
        <span class="ticker-item">Results in Under 3 Minutes</span>
        {{-- Duplicate for seamless loop --}}
        <span class="ticker-item">AI-Powered Career Matching</span>
        <span class="ticker-item">10,000+ Career Paths Analyzed</span>
        <span class="ticker-item">Personality-Based Suggestions</span>
        <span class="ticker-item">Skill Gap Analysis</span>
        <span class="ticker-item">Downloadable Career Reports</span>
        <span class="ticker-item">Find Your Dream Job</span>
        <span class="ticker-item">94% Match Accuracy</span>
        <span class="ticker-item">Results in Under 3 Minutes</span>
    </div>
</div>


{{-- ================================================
     HERO
================================================ --}}
<section class="hero">
    <div class="hero-content">
        <div class="hero-tag">✦ AI Career Intelligence Platform</div>

        <h1>Find Your <span class="accent">Ideal</span><br>Career Path</h1>

        <p class="hero-desc">
            AI-powered recommendations based on your unique skills, interests, and personality.
            Stop guessing — start knowing exactly where you belong.
        </p>

        <div class="hero-btns">
            <a href="{{ route('register') }}" class="btn btn-coral btn-lg">
                Start Free — It's Quick →
            </a>
            <a href="#how-it-works" class="btn btn-lg" style="background: var(--white);">
                See How It Works
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num">94%</div>
                <div class="stat-label">Match accuracy</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">12k+</div>
                <div class="stat-label">Career paths mapped</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">3 min</div>
                <div class="stat-label">To get results</div>
            </div>
        </div>
    </div>

    <div class="hero-visual" aria-hidden="true">
        <div class="career-card">
            <div class="career-card-label">Top Match for You</div>
            <div class="career-card-title">UX Designer</div>
            <span class="career-card-badge">98% Match</span>
        </div>
        <div class="career-card">
            <div class="career-card-label">Strong Fit</div>
            <div class="career-card-title">Product Manager</div>
            <span class="career-card-badge">91% Match</span>
        </div>
        <div class="career-card">
            <div class="career-card-label">Also Consider</div>
            <div class="career-card-title">Data Analyst</div>
            <span class="career-card-badge">87% Match</span>
        </div>
    </div>
</section>


{{-- ================================================
     WHAT WE DO
================================================ --}}
<section class="section reveal" id="what-we-do">
    <div class="section-label">What We Do</div>
    <div class="section-title">Three steps to<br>career clarity.</div>

    <div class="what-grid">
        <div class="what-card bg-lime">
            <div class="what-card-num">01</div>
            <div class="what-card-icon">🧠</div>
            <h3>Analyze You</h3>
            <p>We go deep — skills, interests, personality type, and working style — to build your complete, honest profile.</p>
        </div>

        <div class="what-card bg-sky">
            <div class="what-card-num">02</div>
            <div class="what-card-icon">⚡</div>
            <h3>AI Matching</h3>
            <p>Our model cross-references thousands of career paths to surface the ones where you'll genuinely thrive and grow.</p>
        </div>

        <div class="what-card bg-coral">
            <div class="what-card-num">03</div>
            <div class="what-card-icon">🗺️</div>
            <h3>Clear Roadmap</h3>
            <p>Get a step-by-step, personalized roadmap — courses, skills, milestones — built specifically to reach your dream role.</p>
        </div>
    </div>
</section>


{{-- ================================================
     FEATURES — DARK
================================================ --}}
<section class="section features-section reveal" id="features">
    <div class="section-label">Features</div>
    <div class="section-title">Everything you need.<br>Nothing you don't.</div>

    <div class="feat-grid">
        <div class="feat">
            <div class="feat-num">01</div>
            <h3>Personality-Based Matching</h3>
            <p>
                Your personality isn't a footnote — it's the engine.
                We use proven psychological frameworks to align career suggestions with how you actually think and work.
            </p>
            <span class="feat-tag">MBTI + Big Five</span>
        </div>

        <div class="feat">
            <div class="feat-num">02</div>
            <h3>Skill Gap Analysis</h3>
            <p>
                See exactly what stands between you and your goal.
                No vague advice — precise, prioritized, actionable skills to develop next.
            </p>
            <span class="feat-tag">Precision Targeting</span>
        </div>

        <div class="feat">
            <div class="feat-num">03</div>
            <h3>AI Career Recommendations</h3>
            <p>
                Powered by Claude — one of the world's most capable AI models.
                Your suggestions are intelligent, nuanced, and genuinely personalized to you.
            </p>
            <span class="feat-tag">Powered by Claude AI</span>
        </div>

        <div class="feat">
            <div class="feat-num">04</div>
            <h3>Downloadable PDF Reports</h3>
            <p>
                Your complete career plan, beautifully formatted and ready to share with mentors, coaches, or future employers.
            </p>
            <span class="feat-tag">Export Anywhere</span>
        </div>
    </div>
</section>


{{-- ================================================
     HOW IT WORKS
================================================ --}}
<section class="section reveal" id="how-it-works">
    <div class="section-label">Process</div>
    <div class="section-title">From zero to career clarity<br>in under 3 minutes.</div>

    <div class="steps-wrap">
        <div class="step">
            <div class="step-num">01</div>
            <h3>Take the Personality Test</h3>
            <p>A quick, validated assessment that unlocks deep self-knowledge. Takes under 5 minutes.</p>
        </div>

        <div class="step">
            <div class="step-num">02</div>
            <h3>Enter Skills & Interests</h3>
            <p>Tell us what you're good at, what you love, and what you want your future to look like.</p>
        </div>

        <div class="step">
            <div class="step-num">03</div>
            <h3>Get AI Suggestions</h3>
            <p>Receive ranked career paths with detailed explanations of exactly why each fits you.</p>
        </div>

        <div class="step">
            <div class="step-num">04</div>
            <h3>Follow Your Roadmap</h3>
            <p>Execute your plan with curated resources, milestones, and progress tracking built in.</p>
        </div>
    </div>
</section>


{{-- ================================================
     TESTIMONIALS
================================================ --}}
<section class="section proof-section reveal" id="testimonials">
    <div class="section-label">Social Proof</div>
    <div class="section-title">People are finding<br>their paths.</div>

    <div class="testimonials">
        <div class="testi">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-quote">
                "I'd been stuck in the wrong career for years. CareerAI showed me UX Design as the top result —
                I'm now 6 months into a job I actually love."
            </p>
            <div class="testi-author">Sarah K.</div>
            <div class="testi-role">UX Designer @ Figma</div>
        </div>

        <div class="testi">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-quote">
                "The skill gap analysis was a revelation. I knew exactly what to learn and in what order.
                Landed a data role in just 4 months."
            </p>
            <div class="testi-author">Marcus T.</div>
            <div class="testi-role">Data Analyst @ Stripe</div>
        </div>

        <div class="testi">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-quote">
                "As a fresh grad with no idea what to do — this was exactly what I needed.
                Clear, honest, practical. Nothing like those generic career quizzes."
            </p>
            <div class="testi-author">Priya M.</div>
            <div class="testi-role">Product Manager @ Notion</div>
        </div>
    </div>
</section>


{{-- ================================================
     PRICING
================================================ --}}
<section class="section pricing-section reveal" id="pricing">
    <div class="section-label">Pricing</div>
    <div class="section-title">Simple, honest pricing.<br>Start free, upgrade anytime.</div>

    <div class="pricing-grid">
        {{-- Free --}}
        <div class="price-card">
            <div class="price-plan">Free</div>
            <div class="price-amount">$0</div>
            <div class="price-period">forever</div>
            <ul class="price-features">
                <li>Personality Test</li>
                <li>3 Career Suggestions</li>
                <li>Basic Skill Analysis</li>
                <li>Career Summary</li>
            </ul>
            <a href="{{ route('register') }}" class="btn" style="width:100%;text-align:center;display:block;">
                Get Started Free
            </a>
        </div>

        {{-- Pro — Featured --}}
        <div class="price-card featured">
            <div class="price-badge">Most Popular</div>
            <div class="price-plan">Pro</div>
            <div class="price-amount">$9</div>
            <div class="price-period">per month</div>
            <ul class="price-features">
                <li>Everything in Free</li>
                <li>Unlimited Career Paths</li>
                <li>Full Skill Gap Analysis</li>
                <li>Personalized Roadmap</li>
                <li>PDF Report Export</li>
            </ul>
            <a href="{{ route('register') }}" class="btn btn-lime" style="width:100%;text-align:center;display:block;">
                Start Pro Trial →
            </a>
        </div>

        {{-- Team --}}
        <div class="price-card">
            <div class="price-plan">Team</div>
            <div class="price-amount">$29</div>
            <div class="price-period">per month</div>
            <ul class="price-features">
                <li>Everything in Pro</li>
                <li>Up to 10 Members</li>
                <li>Team Analytics Dashboard</li>
                <li>Priority Support</li>
                <li>Custom Branding</li>
            </ul>
            <a href="{{ route('register') }}" class="btn btn-sky" style="width:100%;text-align:center;display:block;">
                Start Team Trial →
            </a>
        </div>
    </div>
</section>


{{-- ================================================
     CTA
================================================ --}}
<section class="cta-section reveal" id="cta">
    <div class="cta-inner">
        <h2>Your career<br>is waiting.</h2>
        <p>Stop drifting. Get your AI-powered career roadmap in 3 minutes — free.</p>
        <div class="cta-btns">
            <a href="{{ route('register') }}" class="btn btn-lime btn-xl">
                Get Started Free →
            </a>
            <a href="{{ route('login') }}" class="btn btn-ghost btn-xl">
                Already have an account
            </a>
        </div>
    </div>
</section>


{{-- ================================================
     FOOTER
================================================ --}}
<footer class="footer">
    <div class="footer-top">
        <div>
            <a href="{{ url('/') }}" class="footer-logo">Career<span>AI</span></a>
            <p class="footer-tagline">
                AI-powered career intelligence that helps you find where you truly belong and how to get there fast.
            </p>
        </div>

        <div>
            <div class="footer-col-title">Product</div>
            <ul class="footer-links-list">
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">How It Works</a></li>
                <li><a href="#">Roadmap</a></li>
            </ul>
        </div>

        <div>
            <div class="footer-col-title">Company</div>
            <ul class="footer-links-list">
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div>
            <div class="footer-col-title">Legal</div>
            <ul class="footer-links-list">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Cookie Policy</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-copy">© {{ date('Y') }} CareerAI. All rights reserved.</div>

        <div class="footer-social">
            <a href="#" class="social-link" title="Twitter / X">𝕏</a>
            <a href="#" class="social-link" title="LinkedIn">in</a>
            <a href="#" class="social-link" title="GitHub">gh</a>
        </div>
    </div>
</footer>


{{-- ================================================
     SCRIPTS
================================================ --}}
<script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(el => observer.observe(el));

    // Smooth anchor scroll (in case browser doesn't support it)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>

</body>
</html>
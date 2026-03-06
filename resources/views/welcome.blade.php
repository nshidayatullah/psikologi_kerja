<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PPA SafeMind App - Solusi digital pengukuran psikologi kerja real-time untuk seluruh insan PPA di Site Borneo Indobara.">
    <title>PPA SafeMind App — Psikologi Kerja | PT. Putra Perkasa Abadi Site BIB</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --gold: #F5A623;
            --orange: #E8761A;
            --orange-deep: #C45E0A;
            --navy: #0D1B3E;
            --navy-mid: #152B5A;
            --navy-light: #1E3F7C;
            --blue: #2563EB;
            --white: #FFFFFF;
            --gray-light: #F8FAFC;
            --gray: #64748B;
            --text-dark: #0F172A;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
        }

        /* ──────────────── NAVBAR ──────────────── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(13, 27, 62, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(245, 166, 35, 0.2);
            transition: all 0.3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .nav-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gold), var(--orange));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.1rem;
            color: var(--navy);
        }

        .nav-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--white);
            line-height: 1.2;
        }

        .nav-title span {
            color: var(--gold);
            display: block;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.1em;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--gold);
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--gold), var(--orange));
            color: var(--navy) !important;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 700 !important;
        }

        /* ──────────────── HERO ──────────────── */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('/images/hero-bg.png');
            background-size: cover;
            background-position: center;
            transform: scale(1.05);
            animation: subtle-zoom 20s ease-in-out infinite alternate;
        }

        @keyframes subtle-zoom {
            from {
                transform: scale(1.05);
            }

            to {
                transform: scale(1.12);
            }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(13, 27, 62, 0.88) 0%,
                    rgba(13, 27, 62, 0.75) 50%,
                    rgba(200, 90, 10, 0.35) 100%);
        }

        .hero-particles {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(1px 1px at 20% 30%, rgba(245, 166, 35, 0.6) 0%, transparent 100%),
                radial-gradient(1px 1px at 75% 20%, rgba(245, 166, 35, 0.4) 0%, transparent 100%),
                radial-gradient(1px 1px at 50% 70%, rgba(245, 166, 35, 0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 85% 60%, rgba(255, 255, 255, 0.3) 0%, transparent 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 8rem 2rem 4rem;
            max-width: 900px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(245, 166, 35, 0.15);
            border: 1px solid rgba(245, 166, 35, 0.4);
            border-radius: 100px;
            padding: 0.4rem 1rem;
            margin-bottom: 1.75rem;
            color: var(--gold);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            animation: fade-up 0.6s ease both;
        }

        .hero-badge::before {
            content: '●';
            font-size: 0.5rem;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 1.5rem;
            animation: fade-up 0.7s 0.1s ease both;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--gold), #FF9F40);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.8;
            max-width: 680px;
            margin: 0 auto 2.5rem;
            font-weight: 400;
            animation: fade-up 0.7s 0.2s ease both;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fade-up 0.7s 0.3s ease both;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold), var(--orange));
            color: var(--navy);
            padding: 0.9rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 30px rgba(245, 166, 35, 0.4);
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(245, 166, 35, 0.55);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.12);
            color: var(--white);
            padding: 0.9rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-3px);
        }

        .hero-stats {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            gap: 3rem;
            padding: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            animation: fade-up 0.7s 0.4s ease both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gold), #FF9F40);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.78rem;
            margin-top: 0.25rem;
        }

        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ──────────────── REGULASI BANNER ──────────────── */
        .reg-banner {
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            padding: 1rem 2rem;
            text-align: center;
            border-bottom: 3px solid var(--gold);
        }

        .reg-banner p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .reg-tag {
            background: rgba(245, 166, 35, 0.2);
            border: 1px solid rgba(245, 166, 35, 0.4);
            color: var(--gold);
            padding: 0.2rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ──────────────── SECTION BASE ──────────────── */
        section {
            padding: 6rem 2rem;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--orange);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .section-label::before {
            content: '';
            width: 24px;
            height: 2px;
            background: var(--orange);
            display: block;
        }

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.2;
            margin-bottom: 1.25rem;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--gray);
            line-height: 1.8;
            max-width: 640px;
        }

        /* ──────────────── VALUE PROPS ──────────────── */
        .value-section {
            background: var(--gray-light);
        }

        .value-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .value-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid #E8EDF5;
            position: relative;
            overflow: hidden;
            transition: all 0.35s;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--orange));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .value-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
        }

        .value-card:hover::before {
            opacity: 1;
        }

        .value-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, rgba(245, 166, 35, 0.15), rgba(232, 118, 26, 0.1));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1.25rem;
        }

        .value-card h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.6rem;
        }

        .value-card p {
            font-size: 0.9rem;
            color: var(--gray);
            line-height: 1.7;
        }

        /* ──────────────── FEATURES ──────────────── */
        .features-section {
            background: var(--white);
        }

        .features-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .features-header .section-label {
            justify-content: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            border-radius: 20px;
            padding: 2rem;
            background: linear-gradient(145deg, var(--white), #F0F4FF);
            border: 1px solid #DBEAFE;
            position: relative;
            overflow: hidden;
            transition: all 0.35s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(37, 99, 235, 0.1);
        }

        .feature-number {
            position: absolute;
            top: 1.25rem;
            right: 1.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            color: rgba(37, 99, 235, 0.06);
            line-height: 1;
            pointer-events: none;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--navy), var(--navy-light));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 20px rgba(13, 27, 62, 0.2);
        }

        .feature-card h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.5rem;
        }

        .feature-card p {
            font-size: 0.875rem;
            color: var(--gray);
            line-height: 1.7;
        }

        .feature-tag {
            display: inline-block;
            margin-top: 1rem;
            background: rgba(37, 99, 235, 0.08);
            color: var(--blue);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
        }

        /* ──────────────── WORKER SECTION ──────────────── */
        .worker-section {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 50%, #1a3a6b 100%);
            position: relative;
            overflow: hidden;
        }

        .worker-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(245, 166, 35, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 60%);
        }

        .worker-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .worker-text .section-title {
            color: var(--white);
        }

        .worker-text .section-desc {
            color: rgba(255, 255, 255, 0.7);
            max-width: none;
        }

        .worker-text .section-label {
            color: var(--gold);
        }

        .worker-text .section-label::before {
            background: var(--gold);
        }

        .worker-quote {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 800;
            color: var(--white);
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .worker-quote .quote-mark {
            color: var(--gold);
            font-size: 2em;
            line-height: 0;
            vertical-align: -0.3em;
        }

        .worker-cards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .worker-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            backdrop-filter: blur(8px);
            transition: all 0.3s;
        }

        .worker-card:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateX(6px);
        }

        .worker-card-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            background: linear-gradient(135deg, var(--gold), var(--orange));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .worker-card-text {}

        .worker-card-text strong {
            display: block;
            color: var(--white);
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }

        .worker-card-text span {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        /* ──────────────── FOOTER ──────────────── */
        footer {
            background: #070E20;
            padding: 3rem 2rem 1.5rem;
        }

        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-logo-box {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--gold), var(--orange));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.1rem;
            color: var(--navy);
        }

        .footer-brand-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: var(--white);
            font-size: 1rem;
            line-height: 1.2;
        }

        .footer-brand-name small {
            display: block;
            color: var(--gold);
            font-size: 0.6rem;
            font-weight: 500;
            letter-spacing: 0.1em;
        }

        .footer-desc {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .footer-slogan {
            display: inline-block;
            background: rgba(245, 166, 35, 0.1);
            border: 1px solid rgba(245, 166, 35, 0.3);
            color: var(--gold);
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            font-style: italic;
        }

        .footer-col h4 {
            color: var(--white);
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col li {
            margin-bottom: 0.6rem;
        }

        .footer-col a {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: var(--gold);
        }

        .footer-bottom {
            padding-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .footer-bottom p {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.78rem;
        }

        .footer-bottom .dept {
            color: rgba(245, 166, 35, 0.6);
        }

        /* ──────────────── RESPONSIVE ──────────────── */
        @media (max-width: 768px) {
            nav {
                padding: 0.75rem 1.25rem;
            }

            .nav-links {
                display: none;
            }

            .hero-stats {
                gap: 1.5rem;
            }

            .worker-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-top {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>
        <a href="#" class="nav-brand">
            <div class="nav-logo">P</div>
            <div class="nav-title">
                PPA SafeMind
                <span>SITE BORNEO INDOBARA</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="#nilai">Nilai</a></li>
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#pekerja">Untuk Anda</a></li>
            <li><a href="{{ route('filament.admin.resources.survey-sessions.index') }}" class="nav-cta">Dashboard →</a></li>
        </ul>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
        <div style="width:100%;display:flex;flex-direction:column;align-items:center;">
            <div class="hero-content">
                <div class="hero-badge">
                    🛡️ Zero Accident Mission — Site BIB
                </div>
                <h1 class="hero-title">
                    Menjaga Fokus,<br>
                    <span class="highlight">Menjamin Keselamatan:</span><br>
                    PPA SafeMind App
                </h1>
                <p class="hero-sub">
                    Solusi digital pengukuran psikologi kerja <em>real-time</em> untuk seluruh insan PPA di Site BIB.
                    Pastikan kesiapan mental sebelum operasional demi target <strong>Zero Accident</strong>.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('filament.admin.resources.survey-sessions.index') }}" class="btn-primary">
                        ⚡ Mulai Assessment Sekarang
                    </a>
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn-secondary">
                        📊 Lihat Dashboard Kesiapan Mental
                    </a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">QR Code</div>
                    <div class="stat-label">Distribusi Survei Digital</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">3 TTD</div>
                    <div class="stat-label">PIC 1 · PIC 2 · Dokter</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Real-Time</div>
                    <div class="stat-label">Dashboard & Laporan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- REGULASI BANNER -->
    <div class="reg-banner">
        <p>
            <span class="reg-tag">REGULASI</span>
            Mengacu pada <strong>Keputusan Menteri ESDM No. 1827 K/2018</strong> tentang Faktor Manusia dalam Keselamatan Pertambangan & <strong>Kepmenaker No. 28 Tahun 2021</strong> tentang Standar Pengukuran Psikologi Kerja.
        </p>
    </div>

    <!-- VALUE PROPOSITION SECTION -->
    <section id="nilai" class="value-section">
        <div class="container">
            <div class="section-label">Mengapa Ini Penting?</div>
            <h2 class="section-title">Mengapa Mental Fitness Sama Pentingnya<br>dengan Kelayakan Alat?</h2>
            <p class="section-desc">Di Site BIB yang dinamis dan penuh risiko, konsentrasi adalah perlindungan utama. Web App ini hadir untuk menjawab tantangan tersebut secara ilmiah dan terukur.</p>
            <div class="value-grid">
                <div class="value-card">
                    <div class="value-icon">⚡</div>
                    <h3>Validasi Real-Time</h3>
                    <p>Menilai kesiapan psikomotorik dan stabilitas emosi sebelum shift dimulai, sehingga operator yang tidak siap tidak masuk ke area operasional berisiko tinggi.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🔍</div>
                    <h3>Mitigasi Fatigue</h3>
                    <p>Mendeteksi gejala kelelahan mental yang tidak terlihat oleh mata. Prediksi dini mencegah kecelakaan sebelum terjadi, bukan setelah.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">📈</div>
                    <h3>Data-Driven Safety</h3>
                    <p>Membantu pengawas dan HSE mengambil keputusan berbasis data untuk penempatan operator di area berisiko tinggi. Eliminasi keputusan subjektif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="fitur" class="features-section">
        <div class="container">
            <div class="features-header">
                <div class="section-label">Fitur Unggulan</div>
                <h2 class="section-title">Teknologi Dirancang<br>untuk Lingkungan Tambang</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-number">01</div>
                    <div class="feature-icon">📅</div>
                    <h3>Manajemen Sesi Survei</h3>
                    <p>Admin membuat sesi survei bulanan dengan mudah. Setiap sesi otomatis menghasilkan <strong>QR Code & link unik</strong> yang siap dibagikan ke peserta di lapangan.</p>
                    <span class="feature-tag">QR CODE + LINK UNIK</span>
                </div>
                <div class="feature-card">
                    <div class="feature-number">02</div>
                    <div class="feature-icon">�</div>
                    <h3>Form Survei Digital Publik</h3>
                    <p>Karyawan mengisi biodata & kuesioner psikologi via web tanpa perlu login atau install aplikasi. Skor & klasifikasi <strong>RINGAN / SEDANG / BERAT</strong> dihitung otomatis.</p>
                    <span class="feature-tag">TANPA LOGIN</span>
                </div>
                <div class="feature-card">
                    <div class="feature-number">03</div>
                    <div class="feature-icon">✍️</div>
                    <h3>Tanda Tangan Digital</h3>
                    <p>Link tanda tangan khusus untuk <strong>PIC 1, PIC 2, dan Dokter Pemeriksa</strong>. Setiap pihak menandatangani laporan dari perangkat masing-masing secara aman.</p>
                    <span class="feature-tag">3 PENANDA TANGAN</span>
                </div>
                <div class="feature-card">
                    <div class="feature-number">04</div>
                    <div class="feature-icon">�</div>
                    <h3>Dashboard & Laporan Otomatis</h3>
                    <p>Dashboard admin real-time menampilkan statistik hasil survei, grafik 6 dimensi stresor psikologi, dan laporan siap cetak <strong>lengkap dengan tanda tangan digital</strong>.</p>
                    <span class="feature-tag">AUDIT-READY</span>
                </div>
            </div>
        </div>
    </section>

    <!-- WORKER SECTION -->
    <section id="pekerja" class="worker-section">
        <div class="container">
            <div class="worker-inner">
                <div class="worker-text">
                    <div class="section-label">Untuk Anda, Insan PPA</div>
                    <p class="worker-quote">
                        <span class="quote-mark">"</span>Keluarga Menanti di Rumah. Pastikan Pikiran Anda Ada di Sini.<span class="quote-mark">"</span>
                    </p>
                    <p class="section-desc" style="margin-bottom:2rem;">
                        Bekerja di PPA Site BIB membutuhkan ketangguhan fisik dan mental. Gunakan aplikasi ini sebagai cermin kesiapan Anda hari ini. Jangan paksakan jika fokus menurun—<strong style="color:var(--gold)">keselamatan Anda adalah prioritas perusahaan.</strong>
                    </p>
                    <a href="/admin" class="btn-primary" style="display:inline-flex;">
                        Mulai Hari Ini →
                    </a>
                </div>
                <div class="worker-cards">
                    <div class="worker-card">
                        <div class="worker-card-icon">🏠</div>
                        <div class="worker-card-text">
                            <strong>Keselamatan = Kepulangan</strong>
                            <span>Setiap pekerja berhak pulang utuh ke rumah</span>
                        </div>
                    </div>
                    <div class="worker-card">
                        <div class="worker-card-icon">🧩</div>
                        <div class="worker-card-text">
                            <strong>Kenali Batasmu</strong>
                            <span>Assessment bukan hukuman, tapi perlindungan diri</span>
                        </div>
                    </div>
                    <div class="worker-card">
                        <div class="worker-card-icon">🤝</div>
                        <div class="worker-card-text">
                            <strong>Didukung Tim HSE</strong>
                            <span>Konsultasi tindak lanjut bersama profesional</span>
                        </div>
                    </div>
                    <div class="worker-card">
                        <div class="worker-card-icon">⭐</div>
                        <div class="worker-card-text">
                            <strong>Kontribusi Nyata</strong>
                            <span>Data Anda membangun budaya K3 yang lebih kuat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <div class="footer-brand-logo">
                        <div class="footer-logo-box">P</div>
                        <div class="footer-brand-name">
                            PPA SafeMind App
                            <small>KLINIK PT. PUTRA PERKASA ABADI • SITE BIB</small>
                        </div>
                    </div>
                    <p class="footer-desc">
                        Platform pengukuran psikologi kerja digital yang dirancang untuk mendukung keselamatan operasional dan produktivitas insan PPA di Site Borneo Indobara.
                    </p>
                    <span class="footer-slogan">
                        "Smart Mind, Safe Operation, Productive PPA"
                    </span>
                </div>
                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#nilai">Nilai & Manfaat</a></li>
                        <li><a href="#fitur">Fitur Aplikasi</a></li>
                        <li><a href="#pekerja">Untuk Pekerja</a></li>
                        <li><a href="/admin">Dashboard Admin</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Sumber Regulasi</h4>
                    <ul>
                        <li><a href="#">Kepmen ESDM No. 1827 K/2018</a></li>
                        <li><a href="#">Kepmenaker No. 28/2021</a></li>
                        <li><a href="#">Standar SMKP</a></li>
                        <li><a href="#">Kebijakan Privasi Data</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 PT. Putra Perkasa Abadi — <span class="dept">Safety, Health & Environment Department Site BIB</span>. Hak Cipta Dilindungi.</p>
                <p style="color:rgba(255,255,255,0.2); font-size:0.7rem;">Powered by Paramedic Ns.Hidayatullah</p>
            </div>
        </div>
    </footer>

</body>

</html>
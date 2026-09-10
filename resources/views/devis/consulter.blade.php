<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Devis {{ $devis->numero }} - SwiftHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        /* =========================================================
           SWIFTHUB PREMIUM THEME
        ========================================================= */

        :root {
            --accent: #D62828;
            --accent-dark: #B01F1F;
            --accent-light: #FCE8E8;
            --accent-glow: rgba(214, 40, 40, 0.14);
            --accent-glow-lg: rgba(214, 40, 40, 0.28);

            --ink: #0A0A0A;
            --text: #171717;
            --text-soft: #3F3F3D;
            --muted: #8B8B86;
            --muted-soft: #A8A8A3;

            --background: #F7F7F5;
            --surface: #FFFFFF;
            --surface-soft: #FDFDFC;

            --border: #E9E9E5;
            --border-strong: #E0E0DC;

            --green: #16794C;
            --green-soft: #E7F6EE;
            --green-border: #C7EBD4;
            --green-glow: rgba(22, 121, 76, 0.15);

            --shadow-sm: 0 1px 2px rgba(10,10,10,0.04);
            --shadow-md: 0 6px 24px -6px rgba(10,10,10,0.08);
            --shadow-lg: 0 12px 32px rgba(15,15,15,0.08), 0 4px 8px rgba(15,15,15,0.04);
            --shadow-xl: 0 24px 60px rgba(15,15,15,0.14), 0 8px 16px rgba(15,15,15,0.06);
            --shadow-accent: 0 8px 24px -8px rgba(214, 40, 40, 0.35);
        }

        /* =========================================================
           RESET
        ========================================================= */

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            padding: 0;

            background:
                radial-gradient(1200px 600px at 100% 0%, rgba(214,40,40,0.05) 0%, transparent 60%),
                radial-gradient(1000px 500px at 0% 100%, rgba(214,40,40,0.03) 0%, transparent 60%),
                var(--background);

            color: var(--text);

            font-family: 'Plus Jakarta Sans', sans-serif;

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;

            font-feature-settings: "ss01", "cv11";

            min-height: 100vh;
        }

        a { text-decoration: none; }

        .mono { font-family: 'JetBrains Mono', monospace; }

        ::selection { background: var(--accent); color: #fff; }

        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDDDD8; border-radius: 10px; border: 3px solid var(--background); }
        ::-webkit-scrollbar-thumb:hover { background: #C7C7C1; }

        /* =========================================================
           PAGE
        ========================================================= */

        .page {
            width: 100%;
            max-width: 940px;

            margin: 0 auto;

            padding: 45px 24px 70px;
        }

        /* =========================================================
           TOP BAR (BRAND)
        ========================================================= */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            position: relative;

            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 60%, #A81F1F 100%);
            color: white;

            border-radius: 14px;

            font-size: 15px;
            font-weight: 800;

            letter-spacing: -0.02em;

            box-shadow:
                0 8px 20px -6px rgba(214,40,40,0.5),
                inset 0 1px 0 rgba(255,255,255,0.25);

            overflow: hidden;
        }

        .brand-logo::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 800;

            letter-spacing: -0.035em;
            line-height: 1;
        }

        .brand-description {
            margin-top: 4px;

            color: var(--muted);

            font-size: 11.5px;
            font-weight: 500;
        }

        .top-document-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 12px;

            color: var(--accent);

            background: var(--accent-light);

            border: 1px solid #F5D5D5;
            border-radius: 999px;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 0.10em;
            text-transform: uppercase;

            box-shadow: 0 2px 8px -2px var(--accent-glow);
        }

        .top-document-label::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 2px rgba(214,40,40,0.2);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 2px rgba(214,40,40,0.2); }
            50% { box-shadow: 0 0 0 4px rgba(214,40,40,0.08); }
        }

        /* =========================================================
           STATUS BANNER
        ========================================================= */

        .status-banner {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            padding: 16px 22px;

            margin-bottom: 22px;

            border-radius: 16px;

            font-size: 13.5px;
            font-weight: 700;

            letter-spacing: -0.005em;

            overflow: hidden;

            animation: bannerIn .4s cubic-bezier(.34,1.4,.64,1);
        }

        @keyframes bannerIn {
            from { opacity: 0; transform: translateY(-8px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .status-banner::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
        }

        .status-banner-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 13px;
            font-weight: 800;
        }

        .status-accepte {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            border: 1px solid var(--green-border);
            color: var(--green);
            box-shadow: 0 6px 18px -8px var(--green-glow);
        }
        .status-accepte::before {
            background: linear-gradient(180deg, #34D399, var(--green) 60%, #065F46);
        }
        .status-accepte .status-banner-icon {
            background: linear-gradient(135deg, #34D399, var(--green));
            color: #fff;
            box-shadow: 0 4px 10px -3px rgba(22,121,76,0.5);
        }

        .status-refuse {
            background: linear-gradient(135deg, #FEF2F2 0%, #FDE2E2 100%);
            border: 1px solid #FECACA;
            color: var(--accent);
            box-shadow: 0 6px 18px -8px var(--accent-glow-lg);
        }
        .status-refuse::before {
            background: linear-gradient(180deg, #F26B6B, var(--accent) 60%, #B91C1C);
        }
        .status-refuse .status-banner-icon {
            background: linear-gradient(135deg, #F26B6B, var(--accent));
            color: #fff;
            box-shadow: 0 4px 10px -3px rgba(214,40,40,0.5);
        }

        /* =========================================================
           DOCUMENT
        ========================================================= */

        .document {
            position: relative;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 20px 50px -12px rgba(0, 0, 0, 0.08),
                0 4px 12px -4px rgba(0, 0, 0, 0.04);

            animation: documentIn .5s cubic-bezier(.16,1,.3,1);
        }

        @keyframes documentIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .document-top {
            height: 6px;

            background: linear-gradient(90deg, #F26B6B 0%, var(--accent) 45%, var(--accent-dark) 100%);

            position: relative;
        }

        .document-top::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.25), transparent);
        }

        /* =========================================================
           DOCUMENT HEADER
        ========================================================= */

        .document-header {
            position: relative;

            padding: 40px 46px 36px;

            border-bottom: 1px solid var(--border);

            background:
                radial-gradient(500px 200px at 100% 0%, rgba(214,40,40,0.04) 0%, transparent 60%),
                linear-gradient(180deg, #FEFEFE 0%, var(--surface) 100%);
        }

        .header-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 30px;
        }

        .header-left { flex: 1; min-width: 0; }

        .document-type {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 11px;

            margin-bottom: 14px;

            background: linear-gradient(135deg, #FEF6F6 0%, var(--accent-light) 100%);
            color: var(--accent);

            border: 1px solid #F5D5D5;
            border-radius: 8px;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 0.12em;

            box-shadow: 0 2px 6px -2px var(--accent-glow);
        }

        .document-type::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }

        .document-number {
            margin: 0;

            font-family: 'JetBrains Mono', monospace;

            color: var(--ink);

            font-size: 32px;
            font-weight: 700;

            letter-spacing: -0.045em;
            line-height: 1.1;
        }

        .document-description {
            margin-top: 10px;

            color: var(--muted);

            font-size: 13px;
            font-weight: 500;
        }

        .date-box {
            min-width: 155px;

            padding-left: 26px;

            border-left: 2px solid var(--accent);
        }

        .label {
            display: block;

            margin-bottom: 8px;

            color: var(--muted);

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .date-value {
            font-size: 15px;
            font-weight: 700;

            letter-spacing: -0.01em;
        }

        /* =========================================================
           INFORMATION CLIENT / ENTREPRISE
        ========================================================= */

        .information {
            padding: 32px 46px;

            border-bottom: 1px solid var(--border);
        }

        .information-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        .information-card {
            position: relative;

            padding: 22px 22px 20px;

            background: var(--surface-soft);

            border: 1px solid var(--border);

            border-radius: 16px;

            transition: all .25s ease;

            overflow: hidden;
        }

        .information-card:hover {
            border-color: var(--border-strong);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .information-card.client {
            border-top: 3px solid var(--accent);
            background:
                radial-gradient(300px 100px at 0% 0%, rgba(214,40,40,0.05) 0%, transparent 70%),
                var(--surface-soft);
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 14px;

            color: var(--muted);

            font-size: 9.5px;
            font-weight: 800;

            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .card-title-dot {
            width: 6px;
            height: 6px;

            background: var(--accent);

            border-radius: 50%;

            box-shadow: 0 0 0 3px rgba(214,40,40,0.12);
        }

        .information-card:not(.client) .card-title-dot {
            background: var(--muted-soft);
            box-shadow: 0 0 0 3px rgba(168,168,163,0.15);
        }

        .information-name {
            color: var(--text);

            font-size: 16px;
            font-weight: 700;

            letter-spacing: -0.015em;
        }

        .information-detail {
            margin-top: 8px;

            color: var(--muted);

            font-size: 12.5px;

            line-height: 1.75;
        }

        /* =========================================================
           LINES
        ========================================================= */

        .lines {
            padding: 36px 46px 10px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 20px;
        }

        .section-title {
            margin: 0;

            color: var(--ink);

            font-size: 14px;
            font-weight: 800;

            letter-spacing: -0.015em;
        }

        .section-count {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            padding: 4px 10px;

            color: var(--muted);

            background: var(--surface-soft);

            border: 1px solid var(--border);
            border-radius: 999px;

            font-size: 10.5px;
            font-weight: 700;

            letter-spacing: -0.005em;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: separate;
            border-spacing: 0;

            min-width: 620px;
        }

        thead {
            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);
        }

        th {
            padding: 13px 14px;

            color: white;

            font-size: 9.5px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 0.09em;

            text-align: left;
        }

        th:first-child {
            border-radius: 10px 0 0 10px;
            padding-left: 18px;
        }

        th:last-child {
            border-radius: 0 10px 10px 0;
            padding-right: 18px;
        }

        th:not(:first-child),
        td:not(:first-child) {
            text-align: right;
        }

        td:first-child { padding-left: 18px; }
        td:last-child { padding-right: 18px; }

        tbody tr {
            border-bottom: 1px solid var(--border);

            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, #FFF9F9 0%, #FFFBFB 100%);
        }

        td {
            padding: 18px 14px;

            font-size: 12.5px;

            vertical-align: middle;
        }

        .product-name {
            font-weight: 700;
            font-size: 13px;

            color: var(--text);

            letter-spacing: -0.01em;
        }

        .quantity {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 32px;
            padding: 3px 8px;

            color: var(--text-soft);

            background: var(--surface-soft);

            border: 1px solid var(--border);
            border-radius: 7px;

            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 700;
        }

        .price {
            font-family: 'JetBrains Mono', monospace;

            color: var(--text-soft);

            font-size: 11.5px;
            font-weight: 500;
        }

        .line-total {
            font-family: 'JetBrains Mono', monospace;

            color: var(--ink);

            font-size: 12px;
            font-weight: 700;
        }

        /* =========================================================
           SUMMARY / TOTAL
        ========================================================= */

        .summary-section {
            padding: 30px 46px 40px;
        }

        .summary {
            width: 380px;
            max-width: 100%;

            margin-left: auto;
        }

        .summary-line {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 8px 0;

            font-size: 12.5px;
        }

        .summary-label {
            color: var(--muted);
            font-weight: 500;
        }

        .summary-value {
            font-family: 'JetBrains Mono', monospace;

            font-size: 11.5px;
            font-weight: 700;

            color: var(--text-soft);
        }

        .total-box {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 14px;

            padding: 22px 24px;

            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);

            border-radius: 16px;

            color: white;

            overflow: hidden;

            box-shadow:
                0 12px 28px -10px rgba(214,40,40,0.55),
                inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .total-box::before {
            content: "";
            position: absolute;

            width: 130px;
            height: 130px;

            right: -40px;
            top: -55px;

            border: 1.5px solid rgba(255, 255, 255, 0.18);

            border-radius: 50%;
        }

        .total-box::after {
            content: "";

            position: absolute;

            width: 90px;
            height: 90px;

            right: -25px;
            bottom: -50px;

            background: rgba(255, 255, 255, 0.06);

            border-radius: 50%;
        }

        .total-label {
            position: relative;
            z-index: 2;

            font-size: 12.5px;
            font-weight: 700;

            letter-spacing: 0.02em;
            text-transform: uppercase;

            opacity: 0.95;
        }

        .total-value {
            font-family: 'JetBrains Mono', monospace;

            font-size: 24px;
            font-weight: 700;

            letter-spacing: -0.04em;

            position: relative;
            z-index: 2;
        }

        /* =========================================================
           NOTES
        ========================================================= */

        .notes {
            position: relative;

            margin-top: 26px;

            padding: 20px 22px;

            background: var(--surface-soft);

            border: 1px solid var(--border);

            border-left: 3px solid var(--accent);

            border-radius: 12px;

            box-shadow: var(--shadow-sm);
        }

        .notes-title {
            display: flex;
            align-items: center;
            gap: 6px;

            margin-bottom: 9px;

            color: var(--accent);

            font-size: 9.5px;
            font-weight: 800;

            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .notes-title::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 3px rgba(214,40,40,0.12);
        }

        .notes-text {
            color: var(--text-soft);

            font-size: 12.5px;

            line-height: 1.75;

            white-space: pre-line;
        }

        .validity {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;

            margin-top: 20px;

            color: var(--muted);

            font-size: 11px;
            font-weight: 500;
        }

        .validity::before {
            content: '';
            flex: 1;
            height: 1px;
            max-width: 60px;
            background: linear-gradient(to right, transparent, var(--border));
        }

        .validity strong {
            color: var(--accent);

            font-weight: 800;

            font-family: 'JetBrains Mono', monospace;
            font-size: 11.5px;

            padding: 3px 8px;

            background: var(--accent-light);

            border-radius: 6px;

            border: 1px solid #F5D5D5;
        }

        /* =========================================================
           ACTION BUTTONS
        ========================================================= */

        .actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;

            gap: 12px;

            margin-top: 24px;
        }

        .button {
            position: relative;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            height: 46px;

            padding: 0 24px;

            border-radius: 12px;

            font-size: 13px;
            font-weight: 700;

            transition: all 0.22s cubic-bezier(.34,1.4,.64,1);

            cursor: pointer;

            letter-spacing: -0.005em;
        }

        .button svg {
            width: 15px;
            height: 15px;
            transition: transform .25s ease;
        }

        /* Refuser */

        .button-refuse {
            min-width: 115px;

            background: var(--surface);

            color: var(--text-soft);

            border: 1px solid var(--border-strong);

            box-shadow: var(--shadow-sm);
        }

        .button-refuse:hover {
            background: var(--surface-soft);

            border-color: #C7C7C1;

            color: var(--text);

            transform: translateY(-2px);

            box-shadow: var(--shadow-md);
        }

        .button-refuse:hover svg { transform: rotate(-90deg); }

        /* Accepter */

        .button-accepte {
            min-width: 175px;

            background: linear-gradient(180deg, #E13333 0%, var(--accent) 50%, var(--accent-dark) 100%);

            color: white;

            border: none;

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.18),
                0 6px 18px -6px rgba(214,40,40,0.5),
                0 2px 4px -1px rgba(214,40,40,0.3);
        }

        .button-accepte:hover {
            transform: translateY(-2px);

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.18),
                0 12px 28px -8px rgba(214,40,40,0.6),
                0 3px 6px -2px rgba(214,40,40,0.35);

            filter: brightness(1.04);
        }

        .button-accepte:hover svg { transform: scale(1.15); }

        .button-accepte:active { transform: translateY(0); }

        /* =========================================================
           FINAL STATUS
        ========================================================= */

        .final-status {
            margin-top: 24px;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            margin-top: 30px;

            color: var(--muted);

            font-size: 11px;
            font-weight: 500;
        }

        .footer strong {
            color: var(--accent);
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .footer-shield {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 18px;
            height: 18px;

            background: var(--accent-light);

            border-radius: 50%;

            color: var(--accent);
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            .page { padding: 24px 14px 50px; }

            .topbar { margin-bottom: 20px; }

            .top-document-label { display: none; }

            .document { border-radius: 18px; }

            .document-header { padding: 28px 22px; }

            .header-content {
                flex-direction: column;
                gap: 22px;
            }

            .document-number { font-size: 25px; }

            .date-box {
                width: 100%;

                padding-left: 0;
                padding-top: 18px;

                border-left: none;
                border-top: 2px solid var(--accent);
            }

            .information { padding: 24px 22px; }

            .information-grid { grid-template-columns: 1fr; }

            .lines { padding: 28px 22px 5px; }

            .summary-section { padding: 26px 22px 32px; }

            .summary { width: 100%; }

            .actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .button {
                width: 100%;
                justify-content: center;
            }
        }

        /* =========================================================
           PRINT
        ========================================================= */

        @media print {

            body { background: white; }

            .page {
                max-width: none;
                padding: 0;
            }

            .document {
                border: none;
                box-shadow: none;
                border-radius: 0;
                animation: none;
            }

            .actions,
            .status-banner,
            .footer,
            .top-document-label {
                display: none;
            }

            .information-card,
            .total-box,
            .notes {
                box-shadow: none !important;
            }

            .information-card:hover { transform: none; }
        }
    </style>
</head>


<body>

<div class="page">

    <!-- =========================================================
         SWIFTHUB HEADER
    ========================================================== -->

    <div class="topbar">

        <div class="brand">

            <div class="brand-logo">
                SH
            </div>

            <div>
                <div class="brand-name">
                    SwiftHub
                </div>

                <div class="brand-description">
                    Gestion commerciale
                </div>
            </div>

        </div>

        <div class="top-document-label">
            Document commercial
        </div>

    </div>


    <!-- =========================================================
         STATUS MESSAGE
    ========================================================== -->

    @if(isset($reponse) && $reponse === 'accepte')

        <div class="status-banner status-accepte">
            <div class="status-banner-icon">✓</div>
            <span>Merci ! Ce devis a bien été marqué comme accepté.</span>
        </div>

    @elseif(isset($reponse) && $reponse === 'refuse')

        <div class="status-banner status-refuse">
            <div class="status-banner-icon">✕</div>
            <span>Ce devis a été marqué comme refusé.</span>
        </div>

    @endif


    <!-- =========================================================
         DOCUMENT
    ========================================================== -->

    <div class="document">

        <div class="document-top"></div>


        <!-- =====================================================
             DOCUMENT HEADER
        ====================================================== -->

        <div class="document-header">

            <div class="header-content">

                <div class="header-left">

                    <div class="document-type">
                        DEVIS
                    </div>

                    <h1 class="document-number">
                        {{ $devis->numero }}
                    </h1>

                    <div class="document-description">
                        Proposition commerciale
                    </div>

                </div>


                <div class="date-box">

                    <span class="label">
                        Date du devis
                    </span>

                    <div class="date-value">
                        {{ $devis->date_devis->format('d/m/Y') }}
                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             COMPANY / CLIENT
        ====================================================== -->

        <div class="information">

            <div class="information-grid">

                <!-- Émetteur -->

                <div class="information-card">

                    <div class="card-title">
                        <span class="card-title-dot"></span>
                        Émetteur
                    </div>

                    <div class="information-name">
                        SwiftHub
                    </div>

                    <div class="information-detail">
                        Gestion commerciale
                    </div>

                </div>


                <!-- Client -->

                <div class="information-card client">

                    <div class="card-title">
                        <span class="card-title-dot"></span>
                        Adressé à
                    </div>

                    <div class="information-name">
                        {{ $devis->client->name }}
                    </div>

                    <div class="information-detail">

                        {{ $devis->client->email }}

                        @if($devis->client->phone)
                            <br>{{ $devis->client->phone }}
                        @endif

                        @if($devis->client->city)
                            <br>{{ $devis->client->city }}
                        @endif

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             PRODUCTS
        ====================================================== -->

        <div class="lines">

            <div class="section-header">

                <h2 class="section-title">
                    Détail du devis
                </h2>

                <span class="section-count">
                    {{ $devis->lignes->count() }} ligne(s)
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>Produit / Service</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($devis->lignes as $ligne)

                            <tr>

                                <td>
                                    <div class="product-name">
                                        {{ $ligne->product_name }}
                                    </div>
                                </td>

                                <td>
                                    <span class="quantity">
                                        {{ $ligne->quantite }}
                                    </span>
                                </td>

                                <td>
                                    <span class="price">
                                        {{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} DH
                                    </span>
                                </td>

                                <td>
                                    <span class="line-total">
                                        {{ number_format($ligne->total_ligne, 2, ',', ' ') }} DH
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        <!-- =====================================================
             SUMMARY
        ====================================================== -->

        <div class="summary-section">

            <div class="summary">

                <div class="summary-line">

                    <span class="summary-label">
                        Nombre de lignes
                    </span>

                    <span class="summary-value">
                        {{ $devis->lignes->count() }}
                    </span>

                </div>


                <div class="total-box">

                    <span class="total-label">
                        Total TTC
                    </span>

                    <span class="total-value">
                        {{ number_format($devis->total_ttc, 2, ',', ' ') }} DH
                    </span>

                </div>

            </div>


            <!-- =================================================
                 NOTES
            ================================================== -->

            @if($devis->notes)

                <div class="notes">

                    <div class="notes-title">
                        Notes
                    </div>

                    <div class="notes-text">
                        {{ $devis->notes }}
                    </div>

                </div>

            @endif


            <!-- =================================================
                 VALIDITY
            ================================================== -->

            @if($devis->date_validite)

                <div class="validity">

                    <span>Ce devis est valable jusqu'au</span>

                    <strong>
                        {{ $devis->date_validite->format('d/m/Y') }}
                    </strong>

                </div>

            @endif

        </div>

    </div>


    <!-- =========================================================
         ACTIONS
    ========================================================== -->

    @if(!isset($reponse) && in_array($devis->statut, ['brouillon', 'envoye']))

        <div class="actions">

            <a
                href="{{ $refuserUrl }}"
                class="button button-refuse"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                Refuser
            </a>


            <a
                href="{{ $accepterUrl }}"
                class="button button-accepte"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Accepter le devis
            </a>

        </div>

    @elseif($devis->statut === 'accepte')

        <div class="final-status">

            <div class="status-banner status-accepte">
                <div class="status-banner-icon">✓</div>
                <span>Ce devis a été accepté.</span>
            </div>

        </div>

    @elseif($devis->statut === 'refuse')

        <div class="final-status">

            <div class="status-banner status-refuse">
                <div class="status-banner-icon">✕</div>
                <span>Ce devis a été refusé.</span>
            </div>

        </div>

    @endif


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <div class="footer">

        <span class="footer-shield">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="width: 11px; height: 11px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016Z" />
            </svg>
        </span>

        Document généré avec <strong>SwiftHub</strong>

    </div>

</div>

</body>
</html>
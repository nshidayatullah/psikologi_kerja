<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pengelolaan Psikologi Kerja</title>
    @if(isset($is_pdf) && $is_pdf)
    <?php echo '<style>' . file_get_contents(glob(public_path('build/assets/app-*.css'))[0] ?? public_path('build/assets/app-BLJR0gVD.css')) . '</style>'; ?>
    <?php echo '<script>' . file_get_contents(public_path('js/chart.min.js')) . '</script>'; ?>
    <?php echo '<script>' . file_get_contents(public_path('js/chartjs-plugin-datalabels.min.js')) . '</script>'; ?>
    @else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
    @endif
    @include('partials.umami')
    <style>
        * {
            box-sizing: border-box;
        }

        /* TOC Dotted Leaders */
        .toc-list {
            list-style: none;
            padding: 0;
        }

        .toc-list li {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
        }

        .toc-list li a {
            text-decoration: none;
            color: inherit;
            white-space: nowrap;
        }

        .toc-list li::after {
            content: "";
            flex-grow: 1;
            border-bottom: 2px dotted #999;
            margin: 0 8px;
            order: 1;
        }

        .toc-list li span {
            font-weight: normal;
            order: 2;
        }

        /* Rich Text Styling */
        .rich-text ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .rich-text ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .rich-text li {
            margin-bottom: 0.25rem;
        }

        @media print {
            @page {
                size: A4;
            }

            body {
                background: white;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-before: always;
            }

            .a4-page {
                box-shadow: none !important;
                margin: 0 !important;
                width: 210mm !important;
                height: 297mm !important;
                padding-right: 10mm !important;
                padding-bottom: 15mm !important;
                border: none !important;
                position: relative;
            }

            .cover-page {
                width: 210mm !important;
                height: 297mm !important;
                margin: 0 !important;
                padding: 0 !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: flex-start !important;
                z-index: 1000;
            }

            tr {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            blockquote,
            pre,
            figure {
                page-break-inside: avoid;
            }

            @page landscape {
                size: A4 landscape;
            }

            .landscape-section {
                page: landscape;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white;
            }

            .chart-page {
                height: 185mm !important;
                /* 210mm - (20mm top + 5mm bottom margins) */
                overflow: hidden !important;
            }
        }

        .a4-page {
            max-width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: white;
            padding: 20mm 20mm;
            position: relative;
        }

        .a4-page.cover-page {
            padding: 0 !important;
            margin: 0 auto !important;
            border: none !important;
            box-shadow: none !important;
        }

        .landscape-section {
            max-width: 297mm;
            min-height: 210mm;
            margin: 20px auto;
            background: white;
            padding: 20mm 20mm;
            position: relative;
        }

        .chart-page {
            min-height: 210mm;
            overflow: hidden;
        }

        .cover-page {
            background-color: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            padding: 0 !important;
            overflow: hidden;
            background-size: 100% 100%;
            /* Stretch to fill exactly */
            background-position: center;
            background-repeat: no-repeat;
            width: 210mm;
            height: 297mm;
        }

        .cover-title-group {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .cover-footer-group {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: left;
            padding: 4px;
            max-height: 140px;
            line-height: 1.1;
            display: inline-block;
        }

        .flex-center {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
        }

        @media screen {

            .a4-page,
            .landscape-section {
                margin-bottom: 2rem !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            }

            .overflow-x-prevent-print {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <!-- Navbar / Print Button -->
    <div class="no-print bg-white shadow-sm p-4 text-center mb-8 sticky top-0 z-50">
        <p class="text-gray-500 text-sm mb-2">Gunakan tombol di bawah untuk mengunduh laporan sebagai PDF presisi tinggi (A4) menggunakan sistem Browsershot.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('report.download', $session->uuid) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Unduh PDF (High Quality)
            </a>
            <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-md shadow inline-flex items-center transition border border-gray-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Browser
            </button>
        </div>
    </div>

    @if(!isset($target_section) || $target_section == 'cover')
    <!-- Cover Page -->
    <div class="a4-page cover-page">
        @include('partials.report-cover')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'approval')
    <div class="a4-page relative">
        @include('partials.report-approval')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'introduction')
    <div class="a4-page relative">
        @include('partials.report-introduction')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'methodology')
    <div class="a4-page relative">
        @include('partials.report-methodology')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'table')
    <div class="landscape-section relative" id="hasil">
        @include('partials.report-results-table')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'charts')
    <div class="a4-page relative flex-center">
        @include('partials.report-results-charts')
    </div>
    @endif

    @if(!isset($target_section) || $target_section == 'conclusion')
    <div class="a4-page relative">
        @include('partials.report-conclusion')
    </div>
    @endif

</body>

</html>
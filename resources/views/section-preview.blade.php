<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview: {{ str_replace('report-', '', $section) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
    <style>
        /* Shared Styles from public-report */
        .toc-list {
            list-style: none;
            padding: 0;
        }

        .toc-list li {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
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

        .rich-text ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
        }

        .rich-text ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
        }

        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            background: white;
            padding: 20mm 20mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .landscape-section {
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            background: white;
            padding: 20mm 20mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Generic Partial Wrapper Fixes if needed */
        .cover-page {
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            padding: 0 !important;
        }


        body {
            background: #f3f4f6;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        .preview-header {
            background: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            background: #e5e7eb;
            color: #374151;
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
    </style>
</head>

<body>
    @php
    $isLandscape = str_contains($section, 'table') || str_contains($section, 'charts');
    $isCover = $section === 'report-cover';
    $wrapperClass = $isLandscape ? 'landscape-section' : 'a4-page';
    if ($isCover) $wrapperClass .= ' cover-page';
    @endphp

    <div class="preview-header">
        <span class="font-bold text-blue-600">Partial: {{ $section }}.blade.php</span>
        <span class="badge">{{ $isLandscape ? 'Landscape' : 'Portrait' }}</span>
        <a href="/" class="text-sm text-gray-500 hover:text-blue-600">← Back Home</a>
    </div>

    <div class="{{ $wrapperClass }} relative">
        @include('partials.' . $section)

        @if(!$isCover)
        <div class="absolute bottom-[1cm] right-[1cm] font-bold text-sm">#</div>
        @endif
    </div>
</body>

</html>
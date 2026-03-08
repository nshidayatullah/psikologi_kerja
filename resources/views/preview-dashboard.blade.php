<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Preview Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8fafc;
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        .sidebar {
            width: 300px;
            background: white;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background: #f1f5f9;
        }

        .preview-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .nav-item:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .nav-item.active {
            background: #eff6ff;
            color: #2563eb;
            border-left-color: #2563eb;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="p-6 border-bottom border-gray-100">
            <h1 class="text-xl font-bold text-gray-800">Report Builder</h1>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Partial Previewer</p>
        </div>
        <nav class="grow overflow-y-auto py-4">
            @foreach($partials as $partial)
            <a href="{{ route('partial.preview', $partial) }}"
                target="previewFrame"
                class="nav-item cursor-pointer"
                onclick="setActive(this)">
                <span class="mr-3 text-lg opacity-60">📑</span>
                <span>
                    @if($partial === 'report-introduction')
                    Daftar Isi & Pendahuluan
                    @else
                    {{ str_replace(['report-', '-'], ['', ' '], $partial) }}
                    @endif
                </span>
            </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-gray-100">
            <a href="/" class="text-sm text-gray-500 hover:text-blue-600 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to App
            </a>
        </div>
    </div>

    <div class="main-content">
        <header class="bg-white border-b border-gray-200 h-16 flex items-center px-6 justify-between">
            <div id="currentSectionTitle" class="font-semibold text-gray-700">Select a section to preview</div>
            <div class="flex gap-2">
                <button onclick="zoom(0.8)" class="p-2 hover:bg-gray-100 rounded text-gray-500" title="Zoom Out">➖</button>
                <button onclick="zoom(1.0)" class="p-2 hover:bg-gray-100 rounded text-gray-500" title="Reset Zoom">🔄</button>
                <button onclick="zoom(1.2)" class="p-2 hover:bg-gray-100 rounded text-gray-500" title="Zoom In">➕</button>
            </div>
        </header>
        <div class="grow p-4 overflow-hidden relative">
            <iframe name="previewFrame" id="previewFrame" class="preview-iframe rounded-lg shadow-inner bg-gray-200"></iframe>
        </div>
    </div>

    <script>
        function setActive(el) {
            document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('currentSectionTitle').innerText = 'Previewing: ' + el.innerText.trim();
        }

        function zoom(lvl) {
            const iframe = document.getElementById('previewFrame');
            // We apply zoom to the body of the iframe content if possible
            if (iframe.contentWindow && iframe.contentWindow.document.body) {
                iframe.contentWindow.document.body.style.zoom = lvl;
            }
        }

        // Load first partial by default
        window.onload = () => {
            const firstChild = document.querySelector('.nav-item');
            if (firstChild) firstChild.click();
        };
    </script>
</body>

</html>
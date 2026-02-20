<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipbook - {{ $report->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.min.css">
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            background: #1D4161; 
            font-family: 'Inter', sans-serif;
        }

        /* Header lebih tipis */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            text-align: center;
            padding: 12px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            z-index: 50;
        }

        /* Container Flipbook - DIBATASI BIAR NGGAK FULL */
        #flipbook-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            
           
            height: 100%; 
            
            padding-top: 80px;  
            padding-bottom: 60px; 
        }

        #flipbook {
            /* Membatasi agar tidak menempel ke pinggir layar */
            max-width: 90vw; 
            max-height: 90vh;
        }

        /* Taskbar lebih kecil & slim */
        .taskbar-wrapper {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
        }

        .taskbar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 15px;
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .divider {
            width: 1px;
            height: 18px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 4px;
        }

        /* Button Lebih Kecil */
        .control-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            transition: 0.2s ease;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
        }

        .control-btn svg {
            width: 18px; /* Ukuran icon dikecilkan */
            height: 18px;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: scale(1.1);
        }

        .page {
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        #loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

<div class="header">{{ $report->name }}</div>
<div id="loading">Sabar ya, lagi render...</div>

<div id="flipbook-container">
    <div id="flipbook"></div>
</div>

<div class="taskbar-wrapper">
    <div class="taskbar">
        <div onclick="prevPage()" class="control-btn" title="Back">
            <i data-feather="chevron-left"></i>
        </div>

        <div class="divider"></div>

        <div onclick="nextPage()" class="control-btn" title="Next">
            <i data-feather="chevron-right"></i>
        </div>

        <div class="divider"></div>

        <div onclick="toggleFullscreen()" class="control-btn" title="Fullscreen">
            <i data-feather="maximize-2"></i>
        </div>
    </div>
</div>

<audio id="flipSound">
    <source src="{{ asset('sounds/flip.mp3') }}" type="audio/mpeg">
</audio>

<script>
    feather.replace();

    const url = "{{ asset('storage/' . $report->file_path) }}";
    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js';

    let pageFlip;

    async function initFlipbook() {
        try {
            const pdf = await pdfjsLib.getDocument(url).promise;
            const pages = [];
            const loadingEl = document.getElementById('loading');

            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i);
                // Scale 1.5 biar nggak terlalu berat tapi tetep tajem
                const viewport = page.getViewport({ scale: 1.5 });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                await page.render({ canvasContext: context, viewport: viewport }).promise;

                const pageDiv = document.createElement("div");
                pageDiv.classList.add("page");
                pageDiv.appendChild(canvas);
                pages.push(pageDiv);
            }

            loadingEl.style.display = 'none';

            pageFlip = new St.PageFlip(
                document.getElementById("flipbook"),
                {
                    width: 380, 
                    height: 5200,
                    width: 380,
                    height: 520,
                    size: "stretch",
                    autoSize: true,
                    minWidth: 280,
                    maxWidth: 900,
                    minHeight: 350,
                    maxHeight: 700,
                    showCover: true,
                    mobileScrollSupport: false
                }
            );

            pageFlip.loadFromHTML(pages);
            pageFlip.on('flip', () => { playFlipSound(); });

        } catch (error) {
            console.error(error);
        }
    }

    function nextPage() { if (pageFlip) pageFlip.flipNext(); }
    function prevPage() { if (pageFlip) pageFlip.flipPrev(); }
    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }
    function playFlipSound() {
        const sound = document.getElementById("flipSound");
        if (!sound) return;

        sound.currentTime = 2; 
        sound.play().catch(() => {});
    }

    window.addEventListener('resize', () => { if (pageFlip) pageFlip.update(); });
    initFlipbook();
</script>

</body>
</html>
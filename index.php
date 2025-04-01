<!DOCTYPE html>
<html lang="ro" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Perechi pentru Excursie | Stan Eric</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="Generator Perechi pentru Excursie">
    <meta name="description" content="Aplicație web pentru generarea aleatoare a perechilor de elevi pentru excursii. Creat de Stan Eric Andrei.">
    <meta name="keywords" content="generator perechi, excursie școlară, aplicație educațională, tool profesor, Stan Eric Andrei">
    <meta name="author" content="Stan Eric Andrei">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Generator Perechi pentru Excursie | Creat de Stan Eric Andrei">
    <meta property="og:description" content="Aplicație simplă și eficientă pentru generarea perechilor de elevi pentru excursii școlare. Dezvoltat de Stan Eric Andrei.">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Generator Perechi pentru Excursie | Creat de Stan Eric Andrei">
    <meta property="twitter:description" content="Tool util pentru profesori - generează perechi aleatorii de elevi pentru activități și excursii">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --transition-speed: 0.3s;
        }
        
        @keyframes cardReveal {
            0% {
                transform: translateX(100%) rotateY(90deg);
                opacity: 0;
                filter: blur(5px);
            }
            70% {
                transform: translateX(-20px) rotateY(-10deg);
                opacity: 0.8;
                filter: blur(2px);
            }
            100% {
                transform: translateX(0) rotateY(0);
                opacity: 1;
                filter: blur(0);
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color var(--transition-speed), color var(--transition-speed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            max-width: 800px;
            margin-top: 2rem;
            flex: 1;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: background-color var(--transition-speed), box-shadow var(--transition-speed);
        }
        [data-bs-theme="dark"] .card {
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
        }
        .btn {
            transition: all var(--transition-speed);
        }
        .btn-primary {
            padding: 10px 20px;
            border-radius: 8px;
        }
        .student-list {
            margin-top: 20px;
        }
        .pair-result {
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            transition: background-color var(--transition-speed);
        }
        [data-bs-theme="dark"] .pair-result {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .theme-switch {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 10px;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color var(--transition-speed);
        }
        .theme-switch:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }
        footer {
            text-align: center;
            padding: 20px;
            margin-top: auto;
            font-size: 0.9rem;
            transition: background-color var(--transition-speed);
        }

        .pair-entry {
            opacity: 0;
            transform-origin: left center;
            animation: cardReveal 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        /* Add this new style */
        .pair-entry {
            font-size: 1.25rem;
            font-weight: 500;
            padding: 10px;
            margin: 15px 0;
            border-radius: 8px;
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }
        .pair-number {
            color: var(--bs-primary);
            font-weight: 700;
            font-size: 1.4rem;
        }

        .reveal-button {
            transition: transform 0.3s ease;
        }
        .reveal-button:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <button class="btn theme-switch" id="themeSwitch" aria-label="Schimbă tema">
        <i class="bi bi-sun-fill"></i>
    </button>
    <div class="container">
        <div class="card p-4">
            <h1 class="text-center mb-4">Generator Perechi pentru Excursie</h1>
            
            <form method="post" action="">
                <div class="mb-3">
                    <label for="studentCount" class="form-label">Număr de elevi:</label>
                    <input type="number" class="form-control" id="studentCount" name="studentCount" min="2" required>
                </div>
                <div id="studentNames" class="mb-3">
                    <!-- Câmpurile pentru nume vor fi adăugate dinamic -->
                </div>
                <button type="submit" class="btn btn-primary reveal-button" name="generate">Generează Perechi</button>
            </form>

            <?php
            if (isset($_POST['generate']) && isset($_POST['names'])) {
                $names = $_POST['names'];
                shuffle($names);
                
                echo '<div class="pair-result mt-4">';
                echo '<h3 class="mb-3">Perechi Generate:</h3>';
                echo '<div id="pairsContainer">';
                
                for ($i = 0; $i < count($names) - 1; $i += 2) {
                    $pair1 = $names[$i];
                    $pair2 = isset($names[$i + 1]) ? $names[$i + 1] : 'Singur';
                    echo "<p class='pair-entry' style='display: none;'><span class='pair-number'>Perechea De Scaun " . (($i/2) + 1) . ":</span> $pair1 cu $pair2</p>";
                }
                
                echo '</div>';
                echo '<button id="revealNext" class="btn btn-warning reveal-button mt-3" style="display: none;">Arata</button>';
                echo '<a href="generate_pdf.php?' . http_build_query(['names' => $names]) . '" class="btn btn-success mt-3" style="display: none;" id="downloadBtn" onclick="this.href += \'&clientTime=\' + encodeURIComponent(new Date().toLocaleString(\'ro-RO\'))">Descarcă PDF</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
    document.getElementById('studentCount').addEventListener('change', function() {
        const count = parseInt(this.value);
        const container = document.getElementById('studentNames');
        container.innerHTML = '';
        
        for (let i = 0; i < count; i++) {
            const div = document.createElement('div');
            div.className = 'mb-2';
            div.innerHTML = `
                <label class="form-label">Numele elevului ${i + 1}:</label>
                <input type="text" class="form-control" name="names[]" required>
            `;
            container.appendChild(div);
        }
    });

    // Funcționalitate nouă pentru revelare progresivă
    document.addEventListener('DOMContentLoaded', () => {
        const pairs = document.querySelectorAll('.pair-entry');
        const revealButton = document.getElementById('revealNext');
        const downloadBtn = document.getElementById('downloadBtn');
        let currentPair = 0;

        if (pairs.length > 0) {
            revealButton.style.display = 'inline-block';
            downloadBtn.style.display = 'none';

            revealButton.addEventListener('click', () => {
                if (currentPair < pairs.length) {
                    pairs[currentPair].style.display = 'block';
                    pairs[currentPair].style.animation = 'cardReveal 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                    currentPair++;
                    
                    if (currentPair === pairs.length) {
                        revealButton.style.display = 'none';
                        downloadBtn.style.display = 'inline-block';
                    }
                }
            });
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="mt-4">
        <p>© Stan Eric Andrei 2025. Toate drepturile rezervate.</p>
    </footer>

    <script>
    // Funcționalitate pentru comutarea temei
    const themeSwitch = document.getElementById('themeSwitch');
    const icon = themeSwitch.querySelector('i');
    const html = document.documentElement;

    // Verifică tema salvată
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-bs-theme', savedTheme);
    icon.className = savedTheme === 'dark' ? 'bi bi-moon-fill' : 'bi bi-sun-fill';

    themeSwitch.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        html.setAttribute('data-bs-theme', newTheme);
        icon.className = newTheme === 'dark' ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
        localStorage.setItem('theme', newTheme);
    });
    </script>
</body>
</html>
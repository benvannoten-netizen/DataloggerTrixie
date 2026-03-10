<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperatuur & Vochtigheid Logger</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f0f23;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1800px;
            margin: 0 auto;
            background: #1a1a2e;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .intro {
            padding: 30px;
            background: #16213e;
            border-bottom: 2px solid #0f3460;
        }

        .intro p {
            line-height: 1.6;
            color: #e4e4e4;
            font-size: 1.1em;
        }

        nav {
            display: flex;
            justify-content: center;
            background: #1a1a2e;
            border-bottom: 2px solid #0f3460;
            padding: 10px;
        }

        nav button {
            padding: 15px 40px;
            margin: 0 10px;
            border: none;
            background: #16213e;
            color: #e4e4e4;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        nav button:hover {
            background: #0f3460;
            transform: translateY(-2px);
        }

        nav button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .chart-container {
            padding: 40px;
            background: #1a1a2e;
        }

        .chart-wrapper {
            position: relative;
            text-align: center;
            margin-bottom: 30px;
            background: white;
            border-radius: 10px;
            padding: 20px;
        }

        .chart-wrapper img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .image-hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🌡️ Temperatuur & Vochtigheid Logger</h1>
            <p>Real-time monitoring van uw klimaat</p>
        </header>

        <div class="intro">
            <p>Welkom bij uw persoonlijke klimaatmonitor. Deze logger houdt continu de temperatuur en luchtvochtigheid bij in uw ruimte. Met de grafieken hieronder kunt u eenvoudig trends over de dag, week of maand bekijken en zo optimale omstandigheden waarborgen.</p>
        </div>

        <nav>
            <button class="active" onclick="showPeriod('dag')">Dag</button>
            <button onclick="showPeriod('week')">Week</button>
            <button onclick="showPeriod('maand')">Maand</button>
            <button onclick="showPeriod('alltime')">All Time</button>
        </nav>

        <div class="chart-container">
            <div class="chart-wrapper">
                <img id="dagImage" src="Raspi21DagTempVocht.png" alt="Dag Temperatuur & Vochtigheid">
                <img id="weekImage" src="Raspi21WeekTempVocht.png" alt="Week Temperatuur & Vochtigheid" class="image-hidden">
                <img id="maandImage" src="Raspi21MaandTempVocht.png" alt="Maand Temperatuur & Vochtigheid" class="image-hidden">
                <img id="alltimeImage" src="Raspi21AllTimeTempVocht.png" alt="All Time Temperatuur & Vochtigheid" class="image-hidden">
            </div>
        </div>
    </div>

    <script>
        function showPeriod(period) {
            // Verwijder active class van alle knoppen
            document.querySelectorAll('nav button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Voeg active class toe aan geklikte knop
            event.target.classList.add('active');

            // Verberg alle afbeeldingen
            document.getElementById('dagImage').classList.add('image-hidden');
            document.getElementById('weekImage').classList.add('image-hidden');
            document.getElementById('maandImage').classList.add('image-hidden');
            document.getElementById('alltimeImage').classList.add('image-hidden');

            // Toon de juiste afbeelding
            if (period === 'dag') {
                document.getElementById('dagImage').classList.remove('image-hidden');
            } else if (period === 'week') {
                document.getElementById('weekImage').classList.remove('image-hidden');
            } else if (period === 'maand') {
                document.getElementById('maandImage').classList.remove('image-hidden');
            } else if (period === 'alltime') {
                document.getElementById('alltimeImage').classList.remove('image-hidden');
            }
        }
    </script>
</body>
</html>

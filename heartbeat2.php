
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Heartbeat Monitoring System</title>

    <style>
        body {
            background: #101827;
            color: white;
            font-family: Arial;
            text-align: center;
            padding: 30px;
        }

        .card {
            background: #1e293b;
            padding: 35px;
            border-radius: 15px;
            max-width: 450px;
            margin: auto;
        }

        .heart {
            font-size: 75px;
            color: red;
            animation: beat 1s infinite;
        }

        @keyframes beat {
            50% { transform: scale(1.2); }
        }

        #bpm {
            font-size: 65px;
            color: #22c55e;
        }
    </style>
</head>

<body>

<h1>Heartbeat Monitoring System</h1>

<div class="card">

    <div class="heart">♥</div>

    <h2>Patient Heart Rate</h2>

    <div id="bpm">--</div>

    <h3>Beats Per Minute</h3>

    <p id="status">Waiting for sensor...</p>

    <p id="time"></p>

</div>

<script>

async function updateDashboard() {

    try {

        const response =
            await fetch('latest_reading.php');

        const data = await response.json();

        const bpm = Number(data.bpm) || 0;

        document.getElementById('bpm').innerText =
            bpm || '--';

        document.getElementById('time').innerText =
            data.created_at || 'No reading yet';

        document.getElementById('status').innerText =
            bpm > 0 && bpm <= 40
            ? 'WARNING: LOW HEART RATE'
            : 'Monitoring heartbeat';

    } catch (error) {

        document.getElementById('status').innerText =
            'Connection error';

    }
}

updateDashboard();

setInterval(updateDashboard, 2000);

</script>

</body>
</html>

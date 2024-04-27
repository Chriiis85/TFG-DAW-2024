<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Formula One - Motoring Community</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="JS/data.js"></script>
    <link rel="stylesheet" href="CSS/data.css">


</head>

<body>
    <?php
    include "header.php"
        ?>
    <section>
        <h1 class="title-header-container">DATA & ANALYSIS</h1>
    </section>
    <section class="data-container">
        <article class="data">
            <div class="data-select">
                <div class="select">
                    <select id="select1">
                    </select>
                </div>
                <div class="select">
                <select id="select2">
                        <option value="Constructors">Constructors Standings</option>
                        <option value="Drivers">Drivers Standings</option>
                    </select>
                </div>
            </div>
            <div class="data-content">
                <h1 id="title">2024 Driver Standings</h1>
                <div class="data-table">
                    <table id="tabla" class="content-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Driver Name</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
    <?php
    include "footer.php"
        ?>
</body>

</html>
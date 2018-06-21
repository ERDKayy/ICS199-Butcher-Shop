<?php
// Server saves session data for AT LEAST 1 hour
ini_set('session.gc_mxlifetime', 3600);
// client remembers session id for exactly 1 hour
session_set_cookie_params(3600, '/', null, null, true);
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8" />
        <title>Berryman Brothers Butcheries</title>

        <style>

            .text {
                position: relative;
                width: 600px;
                margin: 0 auto;
                color: #4CAF50;
                background-color: beige;
                text-align: center;
                z-index: 1;
            }

            .stores {
                position: relative;
                width: 600px;
                margin: 0 auto;
                color: #4CAF50;
                background-color: beige;
                margin-bottom: 25px;
                text-align: center;
                z-index: 1;
            }

            .locations {
                position: relative;
                width: 600px;
                margin: 0 auto;
                border-collapse: collapse;
                border: 1px solid;
                empty-cells: hide;
            }
            .locations, td {
                border: 1px solid;
                padding: 10px;
            }

            .locations, tr, td, h3 {
                vertical-align: middle;
            }
        </style>
    </head>

    <body>
    <?php require_once 'header.php' ?>
        <div id="topOfPage"></div>

        <div class="description">
            <h1>Contact Us</h1>
        </div>
        <div class="text">
            <p> Trying to get ahold of our team? Why not come straight to the farm
            and talk to one of our friendly staff!</p>

            <h3>Email Us!</h3>
            <a href="mailto:Justin@berrymanfarms.ca">Justin@berrymanfarms.ca</a>

            <h3>Phone Us!</h3>
            <p>778-351-3633</p>
        </div>

        <div class="stores">
            <h3>Find Our Products at These Locations</h3>

            <table class="locations">
                <tr>
                    <td colspan="2"><h3>Retail Locations</h3></td>
                </tr>
                <tr>
                    <td>Peppers Foods - 3829 Cadboro bay Rd. Victoria, B.C.</td>
                    <td>Mitchell Farms Market - 2451 Island View rd. Victoria, B.C.</td>
                </tr>
                <tr>
                    <td>Lifestyles Market - 2950 Douglas St. Victoria, B.C.</td>
                    <td>Slater's Meats - 2577 Cadboro Bay Rd. Victoria, B.C.</td>
                </tr>
                <tr>
                    <td>Dan's Market - 2030 Bear Hill Rd. Victoria, B.C.</td>
                    <td>Mother Nature's Market - 240 Cook St. Victoria, B.C.</td>
                </tr>
                <tr>
                    <td>Aubergine Specialty Foods - 1308 Gladstone Ave. Victoria, B.C.</td>
                    <td>Ageless Living Market - 851 Johnson St. Victoria B.C.</td>
                </tr>
                <tr>
                    <td>The Local General Store - 1440 Haultain St. Victoria, B.C.</td>
                    <td>The Root Cellar - 1286 McKenzie Ave. Victoria, B.C.</td>
                </tr>

                <tr>
                    <td colspan="2"><h3>Restaurants</h3></td>
                </tr>
                <tr>
                    <td>10 Acres Bistro/Commons/Kitchen - 620 Humbolt St. Victoria, B.C.</td>
                    <td>Victoria Golf Club - 1110 Beach Dr. Victoria, B.C.</td>
                </tr>
                <tr>
                    <td>Spinnakers Gastro Brewpub & Guesthouse - 308 Catherine St. Victoria, B.C.</td>
                    <td>Vista 18 Westcoast Grill & Wine Bar - 740 Burdett Ave. Victoria, B.C.</td>
                </tr>
                <tr>
                    <td>Shine Cafe - 1320 Blanshard St. Victoria B.C.</td>
                    <td>Shine Cafe - 1548 Fort St. Victoria B.C.</td>
                </tr>
                <tr>
                    <td colspan="2">Harvest Road - Farm to Table Grill - 2451 Island View rd. Victoria, B.C.</td>
                </tr>
            </table>
        </div>

    <?php require_once 'footer.php' ?>
    </body>
</html>
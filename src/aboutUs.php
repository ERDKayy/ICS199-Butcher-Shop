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
                margin-bottom: 50px;
                z-index: 1;

            }
        </style>
    </head>

    <body>
        <?php require_once('header.php'); ?>
        <div id="topOfPage"></div>




        <div class="description">
            <h1>About Us</h1>
        </div>
        <div class="text">
            <p> Berryman Brothers Butcheries is a local environmentally sustainable Victoria based butcher shop.
                The company specializes in quality custom meat cutting and wrapping. The Berryman brothers are highly 
                specialized in custom sausage making, curing, and smoked products. </p>

            <p> The Butcher shop constructed in 2015, is a state of art island health approved custom cutting and sausage making facility.
                The facility was initially started for the Berryman Farms Pasture Raised pork products. </p>

            <p> The Berryman’s began raising livestock to ensure their family was fed meat ethically raised and free of any antibiotics and hormones.
                However during the process owner Justin Berryman, who has managed and started a few retail locations for some of the local markets in Victoria,
                identified local farmers were in need of a local custom cutting butcher shop. “Our community wants to support a 100 mile diet, if farmers can’t raise
                and sell local meat then how can our neighbor’s access quality meat? The Berryman Brothers, Justin and Gregory, left their jobs to expand the Berryman Farms
                name and create Berryman Brothers Butcheries, to pursue assisting the local farming community as well as bringing local healthy meat choice to their
                family, friends and community.</P>


            <p>The brother’s mission is to produce a quality custom cutting and sausage making service, to all local farmers.</p>

            <p> Community consumers can order directly from the brothers as they offer many custom order options. We will bring the freshest pasture raised products
                rightfully available for consumers all over Vancouver Island.
                From our farm… to your family.
            </p>
        </div>

        <?php require_once 'footer.php' ?>
    </body>
</html>
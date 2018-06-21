<header>
    <div class="title">
        <img src="images/BBB_Logo.png"/>
        <p>Berryman Brothers Butcheries</p>
    </div>

    <?php 
        require_once 'model/db_functions.php';
        require_once 'model/db_connect.php';
        $products2 = getUserCart(session_id());
        if(empty($products2)){
            $divID = 'hide';
        } else {
            $divID = 'productCount';
        }
    ?>
    <div id="navigation">
        <div class="shopping_cart">
            <a href="shopping_cart.php"><img src="http://deepblue.camosun.bc.ca/~cst634/images/shopping_cart.jpg" alt="Shopping Cart"></a>
            <div id="<?= $divID;?>">
                <?php 
                    $totalItems = 0;
                     foreach($products2 as $product){
                        $totalItems += $product['prod_qty'];
                     }
                     if ($totalItems >= 100){
                        print_r("<p id='count100'>$totalItems</p>");
                     } else if($totalItems >= 10){
                        print_r("<p id='count10'>$totalItems</p>");
                     } else if($totalItems > 0){
                        print_r("<p id='count1'>$totalItems</p>");
                     }
                ?>
            </div>
        </div>

        <div class="dropdown">
          <button class="dropbtn">Shop by All</button>
          <div class="dropdown-content">
            <a href="index.php?meats=allProducts">All Products</a>
            <a href="index.php?meats=freshCuts">Fresh Cuts</a>
            <a href="index.php?meats=sausages">Sausages</a>
            <a href="contactUs.php">Contact Us</a>
          </div>
        </div>

        <div class="search">
            <form name="form" action="index.php" method="get">
                <input type="text" pattern="[A-Za-z0-9\s]+" name="search" id="search" placeholder="Search Item" oninvalid="setCustomValidity('Please search for only letters and numbers')">
                <input type="submit" name="submitBut" id="submitBut" value="Search">
            </form>
        </div>
    </div>
</header>
<?php
    include 'base.php';
?>
<?php
// --- Capture search inputs ---
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$price = isset($_GET['price']) ? trim($_GET['price']) : '';
$activity = isset($_GET['activities']) ? trim($_GET['activities']) : '';

$results = [];

if ($location !== '' || $price !== '' || $activity !== '') {
    // --- Build SQL dynamically ---
    $sql = "SELECT * FROM destinations WHERE 1=1 AND status='approved'";
    $params = [];
    $types = "";

    if ($location !== '') {
        $sql .= " AND Location LIKE CONCAT('%', ?, '%')";
        $params[] = $location;
        $types .= "s";
    }
    if ($price !== '' && is_numeric($price)) {
        $sql .= " AND Price <= ?";
        $params[] = $price;
        $types .= "d";
    }
    if ($activity !== '') {
        $sql .= " AND Activities LIKE CONCAT('%', ?, '%')";
        $params[] = $activity;
        $types .= "s";
    }

    $stmt = mysqli_prepare($conn, $sql);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $results[] = $row;
    }

    mysqli_stmt_close($stmt);

    // fallback if no results but search terms provided
    if (empty($results)) {
        $results[] = [
            "location" => $location !== '' ? ucfirst($location) : "Custom Location",
            "price" => $price !== '' ? $price : "N/A",
            "rating" => "N/A",
            "image" => "media/default.jpg",
            "activities" => $activity
        ];
    }
}
?>

        <article class="hero-data hero-data-form">
            <main>
                <h1><span class="enhance">Tours and Destinations</span></h1>
                <h2>Search For Places and Destinations; Book tours.</h2>
                <?php
                // --- Capture search inputs ---
                $location = isset($_GET['location']) ? trim($_GET['location']) : '';
                $price = isset($_GET['price']) ? trim($_GET['price']) : '';
                $activity = isset($_GET['activities']) ? trim($_GET['activities']) : '';

                $results = [];

                if ($location !== '' || $price !== '' || $activity !== '') {
                    // --- Build SQL dynamically ---
                    $sql = "SELECT * FROM destinations WHERE 1=1 AND status='approved'";
                    $params = [];
                    $types = "";

                    if ($location !== '') {
                        $sql .= " AND Location LIKE CONCAT('%', ?, '%')";
                        $params[] = $location;
                        $types .= "s";
                    }
                    if ($price !== '' && is_numeric($price)) {
                        $sql .= " AND Price <= ?";
                        $params[] = $price;
                        $types .= "d";
                    }
                    if ($activity !== '') {
                        $sql .= " AND Activities LIKE CONCAT('%', ?, '%')";
                        $params[] = $activity;
                        $types .= "s";
                    }

                    $stmt = mysqli_prepare($conn, $sql);

                    if (!empty($params)) {
                        mysqli_stmt_bind_param($stmt, $types, ...$params);
                    }

                    mysqli_stmt_execute($stmt);
                    $query_result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($query_result)) {
                        $results[] = $row;
                    }

                    mysqli_stmt_close($stmt);

                    // fallback if no results but search terms provided
                    if (empty($results)) {
                        $results[] = [
                            "location" => $location !== '' ? ucfirst($location) : "Custom Location",
                            "price" => $price !== '' ? $price : "N/A",
                            "rating" => "N/A",
                            "image" => "media/default.jpg",
                            "activities" => $activity
                        ];
                    }
                }
                ?>
                <form class="background-color-type" method="GET"  action="">
                    <div>
                        <input type="text" placeholder="location">
                    </div>
                    <div>
                        <input type="text" placeholder="Price Range">
                    </div>
                    <div>
                        <input type="text" placeholder="Activities">
                    </div>
                    <div>
                        <button type="submit">
                            <i class="fa fa-search"></i>
                            Search Destinations
                        </button>
                    </div>
                </form>
                <div>
                    <img src="">
                </div>
            </main>
            <aside>

            </aside>

        </article>
    </section>
            <!-- Results Section -->
            <section class="destinations-offer" id="dest-id">
                <h4>Discounted Destinations | Searched Destinations</h4>
                <?php if ($location || $price || $activity): ?>
                    <p>Showing results for: 
                    <?php echo htmlspecialchars($location ?: ''); ?>
                    <?php echo $price ? " | Max Price: $" . htmlspecialchars($price) : ''; ?>
                    <?php echo $activity ? " | Activity: " . htmlspecialchars($activity) : ''; ?>
                    </p>
                <?php endif; ?>

                <div class="destinations-offer-cards">
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <div class="destinations-offer-card">
                                
                                <img src="<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="Destination">
                                <div class="destination-offer-details">
                                    <h7><i class="fa fa-location-dot"></i> <?php echo htmlspecialchars($row['Location']); ?></h7>
                                    <h3>USD <?php echo htmlspecialchars($row['Price']); ?></h3>
                                </div>
                                <div class="destination-offer-more">
                                    <h8><i class="fa fa-star"></i><?php echo htmlspecialchars($row['RatingAVG']); ?></h8>
                                    <a href="destinationinfo.php?id=<?php echo urlencode($row['DestinationID'] ?? 0); ?>" class="linkbutton">
                                        Explore Now
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No destinations found. Try another search. Checkout Other Destinations Below |</p>
                    <?php endif; ?>
                </div>
            </section>
    <!--------------------------Destinations Searched Section------------------------------------------------------------>

    <?php
            // destinations.php
            //include 'db_connect.php'; // contains $conn = new mysqli(...);

            $location = isset($_GET['location']) ? trim($_GET['location']) : '';
            $activity = isset($_GET['activities']) ? trim($_GET['activities']) : '';

            //echo "<h2>Search Results for: " . htmlspecialchars($location) . " " . htmlspecialchars($activity) . "</h2>";

            // Prepare base query
            $sql = "SELECT * FROM destinations WHERE 1=1 AND status='approved'";
            
            $stmt = $conn->prepare($sql);
        
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<section class="destinations-offer"><h4>Destinations on offer</h4><div class="destinations-offer-cards">';
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="destinations-offer-card">
                        <img src="media/<?php echo $row['ImageURL']; ?>" alt="<?php echo $row['ImageURL']; ?>">
                        <div class="destination-offer-details">
                            <h7><i class="fa fa-location-dot"></i> <?php echo htmlspecialchars($row['Name']); ?></h7>
                            <h3>USD <?php echo htmlspecialchars($row['Price']); ?></h3>
                        </div>
                        <div class="destination-offer-more">
                            <h8><i class="fa fa-star"></i><?php echo htmlspecialchars($row['RatingAVG']); ?></h8>
                            <a href="destinationinfo.php?id=<?php echo $row['DestinationID']; ?>" class="linkbutton">
                                Explore Now
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                echo '</div></section>';
            } else {
                //echo "<p>No exact matches found for your search. Here are some similar destinations:</p>";
/*
                // Show similar results (just ignore filters and show some)
                $sqlSimilar = "SELECT * FROM destinations ORDER BY RAND() LIMIT 4";
                $resSimilar = $conn->query($sqlSimilar);

                echo '<section class="destinations-offer"><h4>Similar Destinations</h4><div class="destinations-offer-cards">';
                while ($row = $resSimilar->fetch_assoc()) {
                    ?>
                    <div class="destinations-offer-card">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>">
                        <div class="destination-offer-details">
                            <h7><i class="fa fa-location-dot"></i> <?php echo htmlspecialchars($row['name']); ?></h7>
                            <h3>USD <?php echo htmlspecialchars($row['price']); ?></h3>
                        </div>
                        <div class="destination-offer-more">
                            <h8><i class="fa fa-star"></i><?php echo htmlspecialchars($row['rating']); ?></h8>
                            <a href="destinationinfo.php?id=<?php echo $row['id']; ?>" class="linkbutton">
                                Explore Now
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                echo '</div></section>';*/
            }

            $stmt->close();
            $conn->close();
?>
    


    <!--------------------------Destinations on Offer Section------------------------------------------------------------>
    <!--section class="destinations-offer" id="dest-id">
        <h4>Destinations on offer</h4>
        <div class="destinations-offer-cards" >
            <div class="destinations-offer-card">
                <img src="media/pexels-pierre-blache-651604-3073666.jpg">
                <div class="destination-offer-details">
                    <h7><i class="fa fa-location-dot"></i> NewYork</h7>
                    <h3>USD 500</h3>
                </div>
                <div class="destination-offer-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="destinationinfo.php" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="destinations-offer-card">
                <img src="media/pexels-pixabay-210243.jpg">
                <div class="destination-offer-details">
                    <h7><i class="fa fa-location-dot"></i> Tanzania</h7>
                    <h3>USD 900</h3>
                </div>
                <div class="destination-offer-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="destinations-offer-card">
                <img src="media/pexels-efrain-alonso-1702385-3584283.jpg">
                <div class="destination-offer-details">
                    <h7><i class="fa fa-location-dot"></i> Japan</h7>
                    <h3>USD 1500</h3>
                </div>
                <div class="destination-offer-more">
                    <h8><i class="fa fa-star"></i>4.6</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="destinations-offer-card">
                <img src="media/pexels-icon0-209740.jpg">
                <div class="destination-offer-details">
                    <h7><i class="fa fa-location-dot"></i> China</h7>
                    <h3>USD 500</h3>
                </div>
                <div class="destination-offer-more">
                    <h8><i class="fa fa-star"></i>4.8</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </section-->



     <!--------------------------Explore Destinations Section------------------------------------------------------------>
     <section class="explore-destinations">
        <h3>Explore</h3>
        <div class="explore-destinations-cards">
            <div class="explore-destinations-card">
                <img src="media/pexels-robshumski-6129457.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Hike Trails, Ghana</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="explore-destinations-card">
                <img src="media/pexels-quang-nguyen-vinh-222549-4078053.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Lake RedSea, Philipines</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="explore-destinations-card">
                <img src="media/pexels-olly-3776980.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Camp Luke, China</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="explore-destinations-card">
                <img src="media/pexels-robshumski-6129457.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Hike Trails, Ghana</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="explore-destinations-card">
                <img src="media/pexels-quang-nguyen-vinh-222549-4078053.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Lake RedSea, Philipines</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="explore-destinations-card">
                <img src="media/pexels-olly-3776980.jpg">
                <div class="explore-destination-details">
                    <h7><i class="fa fa-search"></i>Camp Luke, China</h7>
                    <h6>USD 900</h6>
                </div>
                <div class="explore-destination-more">
                    <h8><i class="fa fa-star"></i>4.3</h8>
                    <a href="" class="linkbutton">
                        Explore Now
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>


        </div>
    </section>

    <!--------------------------Subscribe Section------------------------------------------------------------>
    <section class="newsletter-subscription">

        <div>
            <h7>Subscribe to newsletter.<br><br>
                    Stay informed of unlocked and hidden gems of destinations. Look out to escaping with us for various destinations</h7>
        </div>
        <div class="subscribe-form">
            <form>
                <div>
                    <input type="email" placeholder="usertraveller@gmail.com">
                </div>
                <div>
                    <button>Subscribe</button>
                </div>
            </form>

        </div>
    </section>



    <!--Footer-->
    <?php
        require 'footer.php';
   ?>
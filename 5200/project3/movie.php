<!-- 
    Ryan Johnson
    CPSC5200

    Rancid Tomatoes is a fake movie review site. The assignment is to create a page that parses txt 
    source files to populate the page and images.
 -->
<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="css/movie.css" type="text/css" rel="stylesheet" />
        <link rel="icon" type="image/gif" href="images/rotten.gif">

        <?php
            #Get movie name from query 
            $movie = $_GET["film"]; 
            
            #Get info txt file to parse movie info
            $info = file($movie."/info.txt");

            #Get overview txt file to parse overview information
            $overview = file($movie."/overview.txt");

            #Get reviews and set column review counts for left and right column
            $reviews = glob($movie."/review*.txt");
            $reviews_count = count($reviews);
            $left_col_count = ceil($reviews_count/2);

            #Separate reviews into columns
            for ($i = 0; $i < $reviews_count; $i++) {
                if ($i >= $left_col_count) {
                    $right_col_reviews[] = file($reviews[$i]);
                } else {
                    $left_col_reviews[] = file($reviews[$i]);
                }
            }
        ?>
	</head>

	<body>
		<div id="top-banner">
			<img src="images/banner.png" alt="Rancid Tomatoes" />
		</div>

		<h1><?= $info[0] . " (" . trim($info[1]) . ")" ?></h1>

        <div id="main">
            <div id="general-overview">
                <div>
                    <img src="<?= $movie ?>/overview.png" alt="general overview" />
                </div>

                <dl>
                    <?php
                        #Looping through overview information
                        for ($j = 0; $j < count($overview); $j++) {
                            $info_item = explode(":", $overview[$j]);
                    ?>
                            <dt><?= strtoupper($info_item[0]) ?></dt>
                            <dd><?= $info_item[1] ?></dd>
                    <?php
                        }  
                    ?> 
                </dl>
            </div>
            <div id="main-header">
                <img class="big-tomato" 
                    src="images/<?= (intval($info[2]) > 60 ? "freshbig.png" : "rottenbig.png") ?>" 
                    alt="Fresh Tomato" />
                <span id="percent"><?= $info[2] ?>%</span>
            </div>
            <div id="reviews">
                <div class="reviews-right-column">
                    <?php
                        #Looping through right column reviews
                        for ($k = 0; $k < count($right_col_reviews); $k++) {
                    ?>
                            <p class="quote-box">
                                <img src="images/<?= (trim($right_col_reviews[$k][1]) 
                                    == "FRESH" ? "fresh.gif" : "rotten.gif") ?>" 
                                    alt="<?= ($right_col_reviews[$k][1] 
                                    == "FRESH" ? "Fresh" : "Rotten") ?>" />
                                <q><?= trim($right_col_reviews[$k][0]) ?></q>
                            </p>
                            <p class="reviewer">
                                <img src="images/critic.gif" alt="Critic" />
                                <?= $right_col_reviews[$k][2] ?> <br />
                                <em><?= $right_col_reviews[$k][3] ?></em>
                            </p>
                    <?php
                        }        
                    ?>   
                </div>
                <div class="reviews-left-column">
                    <?php
                        #Looping through left column reviews
                        for ($l = 0; $l < count($left_col_reviews); $l++) {
                    ?>
                            <p class="quote-box">
                                <img src="images/<?= (trim($left_col_reviews[$l][1]) 
                                    == "FRESH" ? "fresh.gif" : "rotten.gif") ?>" 
                                    alt="<?= ($left_col_reviews[$l][1] 
                                    == "FRESH" ? "Fresh" : "Rotten") ?>" />
                                <q><?= trim($left_col_reviews[$l][0]) ?></q>
                            </p>
                            <p class="reviewer">
                                <img src="images/critic.gif" alt="Critic" />
                                <?= $left_col_reviews[$l][2] ?> <br />
                                <em><?= $left_col_reviews[$l][3] ?></em>
                            </p>
                    <?php
                        }        
                    ?> 
                </div>    
            </div>
            <div id="review-count">
                <p>(1-<?= $reviews_count ?>) of <?= $reviews_count ?></p>
            </div>
        </div>
	</body>
</html>


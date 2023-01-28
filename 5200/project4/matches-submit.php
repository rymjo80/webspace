<?php 
include "top.html"; 

$full_list = file("singles.txt");
foreach ($full_list as $p) {
    $person = explode(",", $p);
    if($person[0] == trim($_GET['name'])) {
        $user = $person;
    } else {
        $potential_matches[] = $person;
    }
}

# Verifies user exists before searching for potential matches.
if(isset($user)) {
    $gender_matches = getOppositeGender($potential_matches, $user[1]);
    $age_matches = getAgeMatches($gender_matches, $user[2], $user[5], $user[6]);
    $personality_matches = getPersonalityMatches($age_matches, $user[3]);
    $matches = getOSMatches($personality_matches, $user[4]);
}

# Verifies that the potential matches are of the opposite sex as the user.
function getOppositeGender($list, $gender) {
    
    foreach ($list as $person)
    if ($person[1] != $gender) {
        $array[] = $person;
    }
    return (isset($array) ? $array : "");
}

# Verifies that the potential match is within the user's age range 
# and that the user's age is within the potential match's age range.
function getAgeMatches($list, $userAge, $minAge, $maxAge) {
    foreach ($list as $person) {
        if ($person[2] >= $minAge && $person[2] <= $maxAge) {
            if ($userAge >= $person[5] && $userAge <= $person[6]) {
                $array[] = $person; 
            }
        }
    }
    return (isset($array) ? $array : "");

}

# Verifies that the personalities match with at least two common letters in same place.
function getPersonalityMatches($list, $personality) {
    foreach ($list as $person) {
        $count = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($person[3][$i] == $personality[$i]) {
                $count++;
            }
        }
        if ($count > 1) {
            $array[] = $person;
        }
    }
    return (isset($array) ? $array : "");

}

# Verifies that the preferred operating systems match.
function getOSMatches($list, $os) {
    foreach ($list as $person) {
        if ($person[4] == $os) {
            $array[] = $person;
        }
    }
    return (isset($array) ? $array : "");
}


?>

<!-- Web Programming, Project 4 (NerdLuv)
     matches-submit.php -->
<div>
    <h1>Matches for <?= (isset($user) ? $user[0] : " - Error: No User Found") ?></h1>
 
    <div class="match"> 
        <?php
            if (!empty($matches)) {
                foreach ($matches as $match) {
        ?>         
            <p>
                <img src="images/user.jpg" alt="user image"  />
                <?= $match[0] ?>
            </p>
            <ul>
                <li><strong>gender:</strong><?= $match[1] ?></li>
                <li><strong>age:</strong><?= $match[2] ?></li>
                <li><strong>type:</strong><?= $match[3] ?></li>
                <li><strong>OS:</strong><?= $match[4] ?></li>
            </ul>
        <?php
                }
            } else {
        ?>
                <p> No matches found :( </p>
        <?php
            }   
        ?>
    </div>
</div>
<?php include "bottom.html"; ?>
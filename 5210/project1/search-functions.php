<?php

function getActorByName($firstname, $lastname, $conn)
{
    $results = $conn->query("SELECT * FROM actors WHERE first_name LIKE '$firstname%' AND last_name = '$lastname'");

    $actor['id'] = 0;
    $actor['film_count'] = 0;
    $change = false;
    foreach ($results as $result) {
        if ($result['film_count'] >= $actor['film_count']) {
            if ($result['film_count'] != $actor['film_count']) {
                $change = true;
            } else {
                if ($result['id'] < $actor['id']) {
                    $change = true;
                }
            }
        }
        if ($change == true) {
            $actor['id'] = $result['id'];
            $actor['film_count'] = $result['film_count'];
        }
        $change = false;
    }

    return $actor;
}

function getAllMoviesByActorId($actor_id, $conn)
{
    return $conn->query("SELECT * FROM actors a JOIN roles r ON a.id = r.actor_id 
JOIN movies m ON r.movie_id = m.id WHERE a.id = '$actor_id' ORDER BY m.year DESC, m.name ASC");
}

function getAllMoviesWithAnotherActorById($actor_id, $secondActorFirstName, $secondActorLastName, $conn)
{
    $second_actor = getActorByName($secondActorFirstName, $secondActorLastName, $conn);

    $query = "SELECT * FROM 
    (SELECT m.id, m.name, m.year FROM actors a 
    JOIN roles r ON a.id = r.actor_id 
    JOIN movies m ON r.movie_id = m.id
    WHERE a.id = ' " . $actor_id . "') a1
    INNER JOIN
    (SELECT m.id, m.name, m.year FROM actors a
    JOIN roles r ON a.id = r.actor_id
    JOIN movies m ON r.movie_id = m.id
    WHERE a.id = '" . $second_actor['id'] . "') a2
    ON (a1.id = a2.id)
    ORDER BY a1.year DESC,
    a1.name ASC";

    return $conn->query($query);
}

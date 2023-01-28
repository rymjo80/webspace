<?php
require_once("connection.php");
require_once("search-functions.php");
if (
    isset($_GET['firstname']) && isset($_GET['lastname'])
    && $_GET['firstname'] != "" && $_GET['lastname'] != ""
) {

    $firstname = trim($_GET['firstname']);
    $lastname = trim($_GET['lastname']);
} else {
    header("location: index.php");
}

$actor = getActorByName($firstname, $lastname, $conn);
$movies = getAllMoviesWithAnotherActorById($actor['id'], "Kevin", "Bacon", $conn);

include("top.html");
?>

<?php
if ($actor['id'] == 0) {
?>
    <div class="not-found">Actor <?= $firstname . " " . $lastname ?> not found.</div>
<?php
} else if ($movies->rowCount() > 0) {
?>
    <h1>Results for <?= $firstname . " " . $lastname  ?></h1>
    <h2>Films with <?= $firstname . " " . $lastname  ?> and Kevin Bacon </h2>
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Year</th>
        </tr>

        <?php
        $row = 1;
        foreach ($movies as $movie) {

        ?>

            <tr class="<?= ($row % 2 == 0 ? "even" : "odd") ?>">
                <td><?= $row; ?></td>
                <td><?= $movie['name']; ?></td>
                <td><?= $movie['year']; ?></td>
            </tr>
        <?php
            $row++;
        }
        ?>
    </table>
<?php
} else {
?>
    <div class="not-found"><?= $firstname . " " . $lastname ?> wasn't in any films with Kevin Bacon.</div>
<?php
}
?>

<?php
include("bottom.html");
?>
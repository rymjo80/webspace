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
$movies = getAllMoviesByActorId($actor['id'], $conn);

include("top.html");

if ($actor['id'] > 0 && $movies->rowCount() > 0) {
?>
    <h1>Results for <?= $firstname . " " . $lastname  ?></h1>
    <h2>All Films</h2>
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
    <div class="not-found">Actor <?= $firstname . " " . $lastname ?> not found.</div>
<?php
}
?>

<?php
include("bottom.html");
?>
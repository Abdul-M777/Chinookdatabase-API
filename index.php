<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

define("ENTITY", 2);
define("ID", 3);
define("ENTITY_TRACK", "track");
define("ENTITY_ARTIST", "artist");
define("ENTITY_ALBUM", "album");
define("ENTITY_CUSTOMER", "customer");

$url = strtok($_SERVER["REQUEST_URI"], "?");
if (substr($url, strlen($url) - 1) == "/") {
    $url = substr($url, 0, strlen($url) - 1);
}
$urlPieces = explode("/", urldecode($url));


$entity = $urlPieces[ENTITY];


switch ($entity) {

    case ENTITY_ARTIST:

        require_once("src/artist.php");
        $artist = new Artist();
        $req = $_SERVER["REQUEST_METHOD"];
        switch ($req) {
            case "GET":
                if (isset($_GET["name"])) {
                    echo json_encode($artist->getArtistName($_GET["name"]));
                } else if (isset($_GET["id"])) {
                    echo json_encode($artist->getArtistId($_GET["id"]));
                } else {
                    echo json_encode($artist->getArtist());
                }
                break;


            case "POST":
                if (isset($_POST["name"]) && !isset($_POST["artistId"])) {
                    echo json_encode($artist->createArtist($_POST["name"]));
                } else if (isset($_POST["name"]) && isset($_POST["artistId"])) {
                    echo json_encode($artist->updateArtist($_POST["artistId"], $_POST["name"]));
                }
                break;

            case "DELETE":
                echo json_encode($artist->deleteArtist($_GET["id"]));
                break;
        }
        break;

    case ENTITY_ALBUM:

        require_once("src/album.php");
        $album = new Album();
        $req = $_SERVER["REQUEST_METHOD"];
        switch ($req) {
            case "GET":
                if (isset($_GET["name"])) {
                    echo json_encode($album->getAlbumName($_GET["name"]));
                } else if (isset($_GET["id"])) {
                    echo json_encode($album->getAlbumId($_GET["id"]));
                } else {
                    echo json_encode($album->getAlbums());
                }
                break;

            case "POST":
                if (isset($_POST["title"]) && isset($_POST["artistId"]) && !isset($_POST["albumId"])) {
                    echo json_encode($album->createAlbum($_POST["title"], $_POST["artistId"]));
                } else if (isset($_POST["albumId"])) {
                    echo json_encode($album->updateAlbum($_POST["title"], $_POST["artistId"], $_POST["albumId"]));
                }
                break;

            case "DELETE":
                echo json_encode($album->deleteAlbum($_GET["id"]));
                break;
        }
        break;

    case ENTITY_TRACK:
        require_once("src/track.php");
        $track = new Track();
        $req = $_SERVER["REQUEST_METHOD"];
        switch ($req) {
            case "GET":
                if (isset($_GET["name"])) {
                    echo json_encode(($track->getTrackName($_GET["name"])));
                } else if (isset($_GET["id"])) {
                    echo json_encode(($track->getTrackId($_GET["id"])));
                } else {
                    echo json_encode($track->getTrack());
                }
                break;

            case "POST":
                if (
                    isset($_POST["name"]) && isset($_POST["albumId"]) && isset($_POST["mediaType"])
                    && isset($_POST["genreId"]) && isset($_POST["composer"]) && isset($_POST["milliseconds"])
                    && isset($_POST["bytes"]) && isset($_POST["unitPrice"]) && !isset($_POST["id"])
                ) {
                    echo json_encode($track->createTrack(
                        $_POST["name"],
                        $_POST["albumId"],
                        $_POST["mediaType"],
                        $_POST["genreId"],
                        $_POST["composer"],
                        $_POST["milliseconds"],
                        $_POST["bytes"],
                        $_POST["unitPrice"]
                    ));
                } else if (
                    isset($_POST["name"]) && isset($_POST["albumId"]) && isset($_POST["mediaType"])
                    && isset($_POST["genreId"]) && isset($_POST["composer"]) && isset($_POST["milliseconds"])
                    && isset($_POST["bytes"]) && isset($_POST["unitPrice"]) && isset($_POST["id"])
                ) {
                    echo json_encode($track->updateTrack(
                        $_POST["name"],
                        $_POST["composer"],
                        $_POST["unitPrice"],
                        $_POST["mediaType"],
                        $_POST["genreId"],
                        $_POST["milliseconds"],
                        $_POST["bytes"],
                        $_POST["albumId"],
                        $_POST["id"]
                    ));
                }
                break;

            case "DELETE":
                echo json_encode($track->deleteTrack($_GET["id"]));
                break;
        }
        break;

    case ENTITY_CUSTOMER:

        require_once("src/customer.php");
        $customer = new Customer();
        $req = $_SERVER["REQUEST_METHOD"];
        switch ($req) {
            case "GET":
                if (isset($_GET["id"])) {
                    echo json_encode($customer->getCustomerEmail($_GET["id"]));
                } else {
                    echo json_encode($customer->getCustomer());
                }
                break;

            case "POST":
                if (
                    isset($_POST["firstName"]) && isset($_POST["lastName"])
                    && isset($_POST["password"]) && isset($_POST["password-repeat"])
                    && isset($_POST["company"])
                    && isset($_POST["address"]) && isset($_POST["city"])
                    && isset($_POST["state"]) && isset($_POST["country"])
                    && isset($_POST["postalCode"]) && isset($_POST["phone"])
                    && isset($_POST["fax"]) && isset($_POST["email"]) && !isset($_POST["id"])
                ) {
                    echo json_encode($customer->createCustomer(
                        $_POST["firstName"],
                        $_POST["lastName"],
                        $_POST["company"],
                        $_POST["address"],
                        $_POST["city"],
                        $_POST["state"],
                        $_POST["country"],
                        $_POST["postalCode"],
                        $_POST["phone"],
                        $_POST["fax"],
                        $_POST["email"],
                        $_POST["password"],
                        $_POST["password-repeat"]
                    ));
                } else if (
                    isset($_POST["firstName"]) && isset($_POST["lastName"])
                    && isset($_POST["password"]) && isset($_POST["password-repeat"])
                    && isset($_POST["company"])
                    && isset($_POST["address"]) && isset($_POST["city"])
                    && isset($_POST["state"]) && isset($_POST["country"])
                    && isset($_POST["postalCode"]) && isset($_POST["phone"])
                    && isset($_POST["fax"]) && isset($_POST["email"]) && isset($_POST["id"])
                ) {
                    echo json_encode($customer->updateCustomer(
                        $_POST["firstName"],
                        $_POST["lastName"],
                        $_POST["company"],
                        $_POST["address"],
                        $_POST["city"],
                        $_POST["state"],
                        $_POST["country"],
                        $_POST["postalCode"],
                        $_POST["phone"],
                        $_POST["fax"],
                        $_POST["email"],
                        $_POST["password"],
                        $_POST["password-repeat"],
                        $_POST["id"]
                    ));
                }
                break;

            case "DELETE":
                echo json_encode($customer->deleteCustomer($_GET["id"]));
                break;
        }
}

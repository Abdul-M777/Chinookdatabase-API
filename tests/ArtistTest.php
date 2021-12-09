<?php

// require_once './src/db.php';
// require './vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once("src/artist.php");



class ArtistTest extends TestCase
{


    public function testCreateArtist()
    {
        $artist = new Artist();
        $result = $artist->createArtist("ZZZ");

        $this->assertEquals(array('status' => 'Artist created'), $result);
    }

    public function testUpdateArtist()
    {
        $artist = new Artist();
        $result = $artist->updateArtist(321, 'AAA');

        $this->assertEquals(array('status' => 'Artist Updated'), $result);
    }

    public function testgetArtistId()
    {
        $artist = new Artist();
        $result = $artist->getArtistId(321);

        $this->assertEquals(array('ArtistId' => '321', 'Name' => 'AAA'), $result);
    }

    public function testgetArtistName()
    {

        $artist = new Artist();
        $result = $artist->getArtistName('AAA', 1);

        $this->assertEquals(array(array('ArtistId' => '321', 'Name' => 'AAA')), $result);
    }

    public function testdeleteArtist()
    {

        $artist = new Artist();
        $result = $artist->deleteArtist(320);

        $this->assertEquals(array('status' => 'artist deleted'), $result);
    }
}

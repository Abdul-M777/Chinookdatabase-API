<?php

// require_once './src/db.php';
// require './vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once("src/track.php");



class TrackTest extends TestCase
{
    public function testCreateTrack()
    {
        $track = new Track();
        $result = $track->createTrack('AAA', 1, 1, 1, 'Abdul', 5, 30000, 5);

        $this->assertEquals(array('status' => 'Track created'), $result);
    }

    public function testUpdateTrack()
    {
        $track = new Track();
        $result = $track->updateTrack('ZZZ', 'BBB', 20, 2, 2, 5, 20000, 3517);

        $this->assertEquals(array('status' => 'Track Updated'), $result);
    }

    public function testDeleteTrack()
    {
        $track = new Track();
        $result = $track->deleteTrack(3522);

        $this->assertEquals(array('status' => 'Track deleted'), $result);
    }

    public function testGetTrackName()
    {
        $track = new Track();
        $result = $track->getTrackName('ZZZ', 1);

        $this->assertEquals(array(array(
            'trackName' => 'ZZZ', 'albumTitle' => 'For Those About To Rock We Salute You',
            'genre' => 'Jazz', 'mediatype' => 'Protected AAC audio file',
            'unitPrice' => '20.00', 'trackId' => '3517', 'composer' => 'BBB', 'milliseconds' => '300000', 'bytes' => '20000'
        )), $result);
    }

    public function testGetTrackId()
    {
        $track = new Track();
        $result = $track->getTrackId(3517);

        $this->assertEquals(array(
            'TrackId' => '3517', 'Name' => 'ZZZ',
            'AlbumId' => '1', 'MediaTypeId' => '2',
            'GenreId' => '2', 'Composer' => 'BBB', 'Milliseconds' => '300000', 'Bytes' => '20000', 'UnitPrice' => '20.00'
        ), $result);
    }
}

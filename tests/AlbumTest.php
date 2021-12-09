<?php

// require_once './src/db.php';
// require './vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once("src/album.php");



class AlbumTest extends TestCase
{
    public function testCreateAlbum()
    {
        $album = new Album();
        $result = $album->createAlbum('AAA', 321);

        $this->assertEquals(array('status' => 'Album created'), $result);
    }

    public function testUpdateAlbum()
    {
        $album = new Album();
        $result = $album->updateAlbum('BBB', 363);

        $this->assertEquals(array('status' => 'Album updated'), $result);
    }

    public function testDeleteAlbum()
    {
        $album = new Album();
        $result = $album->deleteAlbum(363);

        $this->assertEquals(array('status' => 'Album deleted'), $result);
    }

    public function testGetAlbumName()
    {
        $album = new Album();
        $result = $album->getAlbumName('Hello', 1);

        $this->assertEquals(array(array('name' => 'Hello 2', 'title' => 'Hello my friend', 'albumId' => '357', 'artistId' => '303')), $result);
    }

    public function testGetAlbumId()
    {
        $album = new Album();
        $result = $album->getAlbumId(357);

        $this->assertEquals(array('AlbumId' => '357', 'Title' => 'Hello my friend',  'ArtistId' => '303'), $result);
    }
}

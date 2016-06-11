<?php

namespace AppBundle\Tests\Controller;

use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlbumControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        $client = static::createClient();
        $serializer = SerializerBuilder::create()->build();

        $client->request('GET', '/albums');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /albums");

        $albums = $serializer->deserialize($client->getResponse()->getContent(), 'array', 'json');
        $this->assertEquals(5, sizeof($albums), "Unexpected number of albums");

        $firstAlbumId = $albums[0]['id'];
        $client->request('GET', '/album/' . $firstAlbumId);
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /album/" . $firstAlbumId);

        $images = $serializer->deserialize($client->getResponse()->getContent(), 'array', 'json');
        $this->assertLessThan(11, sizeof($images['items']), "Images wasn't paginated");
    }


}

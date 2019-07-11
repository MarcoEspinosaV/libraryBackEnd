<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use JMS\Serializer\SerializerBuilder;

class AuthorControllerTest extends WebTestCase
{
    const RUTA_API1 = 'api/v1/author';

    public function testCreateAuthor()
    {
        $data = array(
            'CONTENT_TYPE' => 'application/json'
        );
        $client = static::createClient();
        $author = new Author();
        $author->setName("example");
        $author->setLastName("last");
        $serializer = SerializerBuilder::create()->build();
        $content = $serializer->serialize($author, "json");
        $client->request('POST', self::RUTA_API1, array(), array(), $data, $content);
        $response = $client->getResponse();
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}

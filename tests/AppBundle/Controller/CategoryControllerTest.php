<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use JMS\Serializer\SerializerBuilder;

class CategoryControllerTest extends WebTestCase
{
    const RUTA_API1 = 'api/v1/category';

    public function testCreateCategory()
    {
        $data = array(
            'CONTENT_TYPE' => 'application/json'
        );
        $client = static::createClient();
        $category = new Category();
        $category->setName("example");
        $serializer = SerializerBuilder::create()->build();
        $content = $serializer->serialize($category, "json");
        $client->request('POST', self::RUTA_API1, array(), array(), $data, $content);
        $response = $client->getResponse();
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
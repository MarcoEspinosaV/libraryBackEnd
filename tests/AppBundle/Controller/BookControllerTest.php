<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use JMS\Serializer\SerializerBuilder;

class BookControllerTest extends WebTestCase
{
    const RUTA_API1 = 'api/v1/book';

    public function testCreateBook()
    {
        $data = array(
            'CONTENT_TYPE' => 'application/json'
        );
        $client = static::createClient();
        $book=new Book();
        $book->setName("example");
        $book->setYear(1560);
        $author=new Author();
        $author->setId(1);
        $book->addAuthor($author);
        $category=new Category();
        $category->setId(1);
        $book->addCategory($category);
        $serializer = SerializerBuilder::create()->build();
        $content = $serializer->serialize($book, "json");
        $client->request('POST', self::RUTA_API1, array(), array(), $data, $content);
        $response = $client->getResponse();
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

}

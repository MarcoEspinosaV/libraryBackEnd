<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Dto\BookDto;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;

/**
 * @Rest\Route("api/v1/book")
 */
class BookController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("")
     * @SWG\Tag(name="book")
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              @Model(type=BookDto::class)
     *          )
     *
     *      )
     * @SWG\Response(
     *     response=201,
     *     description="Return one create ",
     * )
     */
    public function createBook(Request $request)
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $bookDto = $serializer->deserialize($request->getContent(), 'AppBundle\Dto\BookDto', 'json');
            $book = new Book();
            $book->setName($bookDto->getName());
            $book->setYear($bookDto->getYear());
            foreach ($bookDto->getCategories() as $categoryDto) {
                $category = $this->getDoctrine()->getRepository('AppBundle:Category')->find($categoryDto->getId());
                if ($category !== null) {
                    $book->addCategory($category);
                }
            }
            foreach ($bookDto->getAuthors() as $authorDto) {
                $author = $this->getDoctrine()->getRepository('AppBundle:Author')->find($authorDto->getId());
                if ($author !== null) {
                    $book->addAuthor($author);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            return new View("category created", Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new View($e, Response::HTTP_BAD_REQUEST);
        }
    }
}

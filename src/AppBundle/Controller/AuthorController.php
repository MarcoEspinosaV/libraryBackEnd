<?php

namespace AppBundle\Controller;

use AppBundle\Dto\AuthorDto;
use AppBundle\Entity\Author;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;

/**
 * @Rest\Route("api/v1/author")
 */
class AuthorController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("")
     * @SWG\Tag(name="author")
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              @Model(type=AuthorDto::class)
     *          )
     *
     *      )
     * @SWG\Response(
     *     response=201,
     *     description="Return one create ",
     * )
     */
    public function createAuthor(Request $request)
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $authorDto = $serializer->deserialize($request->getContent(), 'AppBundle\Dto\AuthorDto', 'json');
            $author= new Author();
            $author->setName($authorDto->getName());
            $author->setLastName($authorDto->getLastName());
            foreach ($authorDto->getBooks() as $bookDto) {
                $book = $this->getDoctrine()->getRepository('AppBundle:Book')->find($bookDto->getId());
                if ($book !== null) {
                    $author->addBook($book);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
            return new View("author created", Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new View($e, Response::HTTP_BAD_REQUEST);
        }
    }
}

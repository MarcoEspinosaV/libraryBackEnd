<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Dto\CategoryDto;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;
/**
 * @Rest\Route("api/v1/category")
 */
class CategoryController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("")
     * @SWG\Tag(name="category")
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              @Model(type=CategoryDto::class)
     *          )
     *
     *      )
     * @SWG\Response(
     *     response=201,
     *     description="Return one create ",
     * )
     */
    public function createCategory(Request $request)
    {
        $serializer = SerializerBuilder::create()->build();
        try {
            $categoryDto = $serializer->deserialize($request->getContent(), 'AppBundle\Dto\CategoryDto', 'json');
            $category = new Category();
            $category->setName($categoryDto->getName());
            foreach ($categoryDto->getBooks() as $bookDto) {
                $book = $this->getDoctrine()->getRepository('AppBundle:Book')->find($bookDto->getId());
                if ($book !== null) {
                    $category->addBook($book);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return new View("category created", Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new View($e, Response::HTTP_BAD_REQUEST);
        }
    }
}

<?php


namespace AppBundle\Dto;

use AppBundle\Entity\Category;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class CategoryDto
{
    /**
     * @Type("int")
     */
    private $id;

    /**
     * @Type("string")
     */
    private $name;

    /**
     * @Type("ArrayCollection<AppBundle\Dto\BookDto>")
     */
    private $books;

    /**
     * CategoryDto constructor.
     */
    public function __construct(Category $category)
    {
        $this->setId($category->getId());
        $this->setName($category->getName());
        $this->setBooks($category->getBooks());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param mixed $books
     */
    public function setBooks($books)
    {
        $this->books = $books;
    }


}
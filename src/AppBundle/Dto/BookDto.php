<?php


namespace AppBundle\Dto;

use AppBundle\Entity\Book;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class BookDto
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
     * @Type("int")
     */
    private $year;
    /**
     * @Type("ArrayCollection<AppBundle\Dto\AuthorDto>")
     */
    private $authors;
    /**
     * @Type("ArrayCollection<AppBundle\Dto\CategoryDto>")
     */
    private $categories;

    /**
     * BookDto constructor.
     */
    public function __construct(Book $book)
    {
        $this->setId($book->getId());
        $this->setName($book->getName());
        $this->setYear($book->getYear());
        $this->getAuthors($book->getAuthors());
        $this->setCategories($book->getCategories());
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
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }


    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }


}
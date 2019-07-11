<?php


namespace AppBundle\Dto;

use AppBundle\Entity\Author;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class AuthorDto
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
     * @Type("string")
     */
    private $lastName;

    /**
     * @Type("ArrayCollection<AppBundle\Dto\BookDto>")
     */
    private $books;

    /**
     * AuthorDto constructor.
     */
    public function __construct(Author $author)
    {
        $this->setId($author->getId());
        $this->setName($author->getName());
        $this->setLastName($author->getLastName());
        $this->setBooks($author->getBooks());

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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
<?php

namespace AppBundle\Entity;

/**
 * Author
 */
class Author
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var Book
     */
    private $books;

    /**
     * Author constructor.
     */

    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return Book
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param Book $books
     */
    public function setBooks($books)
    {
        $this->books = $books;
    }

    public function addBook(Book $book)
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
        }
        return $this;
    }

    public function removeBook(Book $book)
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
        }
        return $this;
    }

}

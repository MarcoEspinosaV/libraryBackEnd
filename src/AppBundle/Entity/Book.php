<?php

namespace AppBundle\Entity;

/**
 * Book
 */
class Book
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
     * @var int
     */
    private $year;

    /**
     * @var Author
     */
    private $authors;

    /**
     * @var Category
     */
    private $categories;

    /**
     * Book constructor.
     */

    public function __construct() {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Book
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
     * Set year.
     *
     * @param int $year
     *
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return Author
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param Author $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return Category
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function addAuthor(Author $author){
        if(!$this->authors->contains($author)){
            $this->authors->add($author);
        }
        return $this;
    }
    public function removeAuthor(Author $author){
        if($this->authors->contains($author)){
            $this->authors->removeElement($author);
        }
        return $this;
    }
    public function addCategory(Category $category){
        if(!$this->categories->contains($category)){
            $this->categories->add($category);
        }
        return $this;
    }
    public function removeCategory(Category $category){
        if($this->categories->contains($category)){
            $this->categories->removeElement($category);
        }
        return $this;
    }
}

<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Application\Entity\Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\BookRepository")
 *
 */
class Book {

	/**
	 * @var integer $id
	 *
	 * @ORM\Column(type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="SEQUENCE")
	 * @ORM\SequenceGenerator(sequenceName="book_id_seq", allocationSize=1, initialValue=1)
	 */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string $summary
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var \DateTime $publicationdate
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $publicationdate;
    
    /**
     * @var boolean $isonsale
     *
     * @ORM\Column(name="isonsale", type="boolean", nullable=false)
     */
    private $isonsale = true;
    
    /**
     * @var Application\Entity\Author
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Author", inversedBy="books")
     */
    private $author;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\Tag", inversedBy="books")
     * @ORM\JoinTable(name="tag_book")
     */
    private $tags;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
       
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Book
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set publicationdate
     *
     * @param \DateTime $publicationdate
     * @return Book
     */
    public function setPublicationdate($publicationdate)
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    /**
     * Get publicationdate
     *
     * @return \DateTime 
     */
    public function getPublicationdate()
    {
        return $this->publicationdate;
    }

    /**
     * Set isonsale
     *
     * @param boolean $isonsale
     * @return Book
     */
    public function setIsonsale($isonsale)
    {
        $this->isonsale = $isonsale;

        return $this;
    }

    /**
     * Get isonsale
     *
     * @return boolean 
     */
    public function getIsonsale()
    {
        return $this->isonsale;
    }

    /**
     * Set author
     *
     * @param \Application\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\Application\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Application\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add tags
     *
     * @param \Application\Entity\Tag $tags
     * @return Book
     */
    public function addTag(\Application\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Application\Entity\Tag $tags
     */
    public function removeTag(\Application\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}

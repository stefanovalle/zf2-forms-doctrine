<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="author_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;
       

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
     * Set name
     *
     * @param string $name
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}

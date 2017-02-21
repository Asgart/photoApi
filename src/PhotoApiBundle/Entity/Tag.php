<?php

namespace PhotoApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_389B7835E237E06", columns={"name"})})
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="adder", type="string", length=50, nullable=false)
     */
    private $adder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime", nullable=false)
     */
    private $added;

    /**
     * @var string
     *
     * @ORM\Column(name="modifier", type="string", length=50, nullable=false)
     */
    private $modifier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ghost", type="boolean", nullable=false)
     */
    private $ghost;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tag
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

    /**
     * Set adder
     *
     * @param string $adder
     *
     * @return Tag
     */
    public function setAdder($adder)
    {
        $this->adder = $adder;

        return $this;
    }

    /**
     * Get adder
     *
     * @return string
     */
    public function getAdder()
    {
        return $this->adder;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return Tag
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set modifier
     *
     * @param string $modifier
     *
     * @return Tag
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;

        return $this;
    }

    /**
     * Get modifier
     *
     * @return string
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Tag
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set ghost
     *
     * @param boolean $ghost
     *
     * @return Tag
     */
    public function setGhost($ghost)
    {
        $this->ghost = $ghost;

        return $this;
    }

    /**
     * Get ghost
     *
     * @return boolean
     */
    public function getGhost()
    {
        return $this->ghost;
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
}

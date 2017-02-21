<?php

namespace PhotoApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8C9F3610E86CEBE1", columns={"md5"})})
 * @ORM\Entity
 */
class File
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
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=50, nullable=false)
     */
    private $mime;

    /**
     * @var string
     *
     * @ORM\Column(name="ext", type="string", length=5, nullable=false)
     */
    private $ext;

    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="string", length=32, nullable=false)
     */
    private $md5;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    private $size;

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
     * @return File
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
     * Set path
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set mime
     *
     * @param string $mime
     *
     * @return File
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set ext
     *
     * @param string $ext
     *
     * @return File
     */
    public function setExt($ext)
    {
        $this->ext = $ext;

        return $this;
    }

    /**
     * Get ext
     *
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * Set md5
     *
     * @param string $md5
     *
     * @return File
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get md5
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set adder
     *
     * @param string $adder
     *
     * @return File
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
     * @return File
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
     * @return File
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
     * @return File
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
     * @return File
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

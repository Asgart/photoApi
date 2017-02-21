<?php

namespace PhotoApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileTag
 *
 * @ORM\Table(name="file_tag", indexes={@ORM\Index(name="file_tag_file_id_fk", columns={"file_id"}), @ORM\Index(name="file_tag_tag_id_fk", columns={"tag_id"})})
 * @ORM\Entity
 */
class FileTag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \PhotoApiBundle\Entity\File
     *
     * @ORM\ManyToOne(targetEntity="PhotoApiBundle\Entity\File")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * })
     */
    private $file;

    /**
     * @var \PhotoApiBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="PhotoApiBundle\Entity\Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * })
     */
    private $tag;



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
     * Set file
     *
     * @param \PhotoApiBundle\Entity\File $file
     *
     * @return FileTag
     */
    public function setFile(\PhotoApiBundle\Entity\File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \PhotoApiBundle\Entity\File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set tag
     *
     * @param \PhotoApiBundle\Entity\Tag $tag
     *
     * @return FileTag
     */
    public function setTag(\PhotoApiBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \PhotoApiBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}

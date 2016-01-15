<?php

namespace Afandi\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * General
 *
 * @ORM\Table(name="general")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="Afandi\BlogBundle\Repository\GeneralRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class General
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="general_name", type="string", length=255)
     */
    private $generalName;

    /**
     * @var string
     *
     * @ORM\Column(name="general_value_string", type="string", length=255, nullable=true)
     */
    private $generalValueString;

    /**
     * @var int
     *
     * @ORM\Column(name="general_value_integer", type="integer", nullable=true)
     */
    private $generalValueInteger;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="general_value_date", type="date", nullable=true)
     */
    private $generalValueDate;

    /**
     * @var string
     *
     * @ORM\Column(name="general_value_text", type="text", nullable=true)
     */
    private $generalValueText;

    /**
     * 
     * @Vich\UploadableField(mapping="image", fileNameProperty="generalValueImage")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="general_value_image", type="string", length=255, nullable=true)
     */
    private $generalValueImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set generalName
     *
     * @param string $generalName
     *
     * @return General
     */
    public function setGeneralName($generalName)
    {
        $this->generalName = $generalName;

        return $this;
    }

    /**
     * Get generalName
     *
     * @return string
     */
    public function getGeneralName()
    {
        return $this->generalName;
    }

    /**
     * Set generalValueString
     *
     * @param string $generalValueString
     *
     * @return General
     */
    public function setGeneralValueString($generalValueString)
    {
        $this->generalValueString = $generalValueString;

        return $this;
    }

    /**
     * Get generalValueString
     *
     * @return string
     */
    public function getGeneralValueString()
    {
        return $this->generalValueString;
    }

    /**
     * Set generalValueInteger
     *
     * @param integer $generalValueInteger
     *
     * @return General
     */
    public function setGeneralValueInteger($generalValueInteger)
    {
        $this->generalValueInteger = $generalValueInteger;

        return $this;
    }

    /**
     * Get generalValueInteger
     *
     * @return int
     */
    public function getGeneralValueInteger()
    {
        return $this->generalValueInteger;
    }

    /**
     * Set generalValueDate
     *
     * @param \DateTime $generalValueDate
     *
     * @return General
     */
    public function setGeneralValueDate($generalValueDate)
    {
        $this->generalValueDate = $generalValueDate;

        return $this;
    }

    /**
     * Get generalValueDate
     *
     * @return \DateTime
     */
    public function getGeneralValueDate()
    {
        return $this->generalValueDate;
    }

    /**
     * Set generalValueText
     *
     * @param string $generalValueText
     *
     * @return General
     */
    public function setGeneralValueText($generalValueText)
    {
        $this->generalValueText = $generalValueText;

        return $this;
    }

    /**
     * Get generalValueText
     *
     * @return string
     */
    public function getGeneralValueText()
    {
        return $this->generalValueText;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set generalValueImage
     *
     * @param string $generalValueImage
     *
     * @return Blog
     */
    public function setGeneralValueImage($generalValueImage)
    {
        $this->generalValueImage = $generalValueImage;

        return $this;
    }

    /**
     * Get generalValueImage
     *
     * @return string
     */
    public function getGeneralValueImage()
    {
        return $this->generalValueImage;
    }

    /**
     * Set createdAt
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}


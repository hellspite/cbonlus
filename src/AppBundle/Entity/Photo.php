<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 * @Vich\Uploadable
 *
 */
class Photo
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="image")
     *
     * @var File
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Sets file.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Photo
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if($file){
                
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get file.
     *
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PhotoAlbum", inversedBy="photos")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private $album;

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
     * Set image
     *
     * @param string $image
     *
     * @return Photo
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set album
     *
     * @param \AppBundle\Entity\PhotoAlbum $album
     *
     * @return Photo
     */
    public function setAlbum(\AppBundle\Entity\PhotoAlbum $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AppBundle\Entity\PhotoAlbum
     */
    public function getAlbum()
    {
        return $this->album;
    }

    public function setUpdatedAt($date){

        $this->updatedAt = $date;

    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }

}

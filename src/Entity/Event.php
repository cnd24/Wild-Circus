<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use \DateTime;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @Vich\Uploadable
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du spectacle est obligatoire")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom doit être au plus {{ limit }} caractères de long")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="La description du spectacle est obligatoire")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La durée du spectacle est obligatoire")
     * @Assert\Type(
     *     type="integer",
     *     message="La durée {{ value }} doit être en chiffre."
     * )
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La photo du spectacle est obligatoire")
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="event_file", fileNameProperty="picture")
     * @var File|null
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Representation", mappedBy="event")
     */
    private $representations;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceChildren;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceAdult;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="events")
     */
    private $artists;

    public function __construct()
    {
        $this->representations = new ArrayCollection();
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Representation[]
     */
    public function getRepresentations(): Collection
    {
        return $this->representations;
    }

    public function addRepresentation(Representation $representation): self
    {
        if (!$this->representations->contains($representation)) {
            $this->representations[] = $representation;
            $representation->setEvent($this);
        }

        return $this;
    }

    public function removeRepresentation(Representation $representation): self
    {
        if ($this->representations->contains($representation)) {
            $this->representations->removeElement($representation);
            // set the owning side to null (unless already changed)
            if ($representation->getEvent() === $this) {
                $representation->setEvent(null);
            }
        }

        return $this;
    }

    public function getPriceChildren(): ?int
    {
        return $this->priceChildren;
    }

    public function setPriceChildren(?int $priceChildren): self
    {
        $this->priceChildren = $priceChildren;

        return $this;
    }

    public function getPriceAdult(): ?int
    {
        return $this->priceAdult;
    }

    public function setPriceAdult(?int $priceAdult): self
    {
        $this->priceAdult = $priceAdult;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addEvent($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->contains($artist)) {
            $this->artists->removeElement($artist);
            $artist->removeEvent($this);
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|null $image
     */
    public function setPictureFile(?File $image = null): void
    {
        $this->pictureFile = $image;

        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }




}

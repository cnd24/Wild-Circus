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
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="event_file", fileNameProperty="picture")
     * @Assert\File(
     *     maxSize="1000k",
     *     maxSizeMessage="Le fichier excède 1000Ko.",
     *     mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/svg+xml", "image/gif"},
     * mimeTypesMessage= "formats autorisés: png, jpeg, jpg, svg, gif"
     * )
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
     * @ORM\Column(type="integer")
     */
    private $basisPrice;

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

    public function getBasisPrice(): ?int
    {
        return $this->basisPrice;
    }

    public function setBasisPrice(int $basisPrice): self
    {
        $this->basisPrice = $basisPrice;

        return $this;
    }

    const CATEGORIES_PEOPLE = ['adult', 'child', 'group'];

    public function getPriceByAge(string $type, int $basisPrice)
    {
        $this->basisPrice = $basisPrice;

        if(!in_array($type, self::CATEGORIES_PEOPLE)){
            throw new \ErrorException('Catégorie de personne non valide');
        }
        if ($type == self::CATEGORIES_PEOPLE[1]){
            return intval($this->basisPrice * 0.5);
        } elseif ($type == self::CATEGORIES_PEOPLE[2]){
            return intval($this->basisPrice * 0.7);
        }
        return $this->basisPrice;
    }
}

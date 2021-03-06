<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Advert", mappedBy="city")
     */
    private $adverts;

    public function __construct()
    {
        $this->adverts = new ArrayCollection();
    }

	/**
	 * @return int
	 */
    public function getId()
    {
        return $this->id;
    }

	/**
	 * @return null|string
	 */
    public function getName(): ?string
    {
        return $this->name;
    }

	/**
	 * @param string $name
	 *
	 * @return City
	 */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

	/**
	 * @return null|string
	 */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

	/**
	 * @param string $slug
	 *
	 * @return City
	 */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

	/**
	 * Get count of all adverts for this city
	 * @todo add filter for type
	 *
	 * @return int
	 */
	public function getAdvertsCount(): int
	{
		return count($this->adverts);
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
            $advert->setCity($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->contains($advert)) {
            $this->adverts->removeElement($advert);
            // set the owning side to null (unless already changed)
            if ($advert->getCity() === $this) {
                $advert->setCity(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="App\CoreBundle\Repository\PageRepository")
 * 
 * @UniqueEntity(fields="name")
 */
class Page
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
	 * 
	 * @Assert\NotBlank
	 * @Assert\Length(min=1, max=255)
	 * @Assert\Regex(pattern="~^[a-zA-Z0-9_\-]+$~", message="Allowed symbols: letters, digits, underscore, dash")
     */
    private $name;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="title", type="string", length=1024, nullable=true)
	 * 
	 * @Assert\Length(max=1024)
	 */
	private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4096, nullable=true)
	 * 
	 * @Assert\Length(max=4096)
     */
    private $description;
	
	/**
	 * @var ArrayCollection | PageElementPlacement[]
	 * 
	 * @ORM\OneToMany(targetEntity="PageElementPlacement", mappedBy="page", cascade={"all"}, indexBy="id")
	 * @ORM\OrderBy({"priority" = "ASC"})
	 */
	private $placements;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->placements = new ArrayCollection();
	}
	
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
     * Set name
     *
     * @param string $name
     *
     * @return Page
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
     * Set title
     *
     * @param string $name
     *
     * @return Page
     */
    public function setTitle($name)
    {
        $this->title = $name;

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
     * Set description
     *
     * @param string $description
     *
     * @return Page
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
	
	/**
	 * Add placement
	 * 
	 * @param  PageElementPlacement $placement
	 * @return PageElement
	 */
	public function addPlacement(PageElementPlacement $placement)
	{
		$this->placements->add($placement);
		
		if ($placement->getPage() === null) {
			$placement->setPage($this);
		}
		
		return $this;
	}
	
	/**
	 * Has placement
	 * 
	 * @param  PageElementPlacement $placement
	 * @return bool
	 */
	public function hasPlacement(PageElementPlacement $placement)
	{
		return $this->placements->contains($placement);
	}
	
	/**
	 * Get placements
	 * 
	 * @return PageElementPlacement[]
	 */
	public function getPlacements()
	{
		return $this->placements;
	}
	
	/**
	 * Remove placement
	 * 
	 * @param  PageElementPlacement $placement
	 * @return PageElement
	 */
	public function removePlacement(PageElementPlacement $placement)
	{
		$this->placements->removeElement($placement);
		
		return $this;
	}
	
	/**
	 * Get the elements of the page
	 * 
	 * @return PageElement[]
	 */
	public function getElements()
	{
		$elements = [];
		
		foreach ($this->getPlacements() as $placement) {
			$elements[] = $placement->getElement();
		}
		
		return $elements;
	}
	
	/**
	 * Add the element to the page
	 * Placement will be created automatically
	 * 
	 * @param  PageElement $element
	 * @return Page
	 */
	public function addElement(PageElement $element)
	{
		$placement = new PageElementPlacement();
		$placement->setElement($element);
		
		$this->addPlacement($placement);
		
		return $this;
	}
	
	/**
	 * Is the page contains the element ?
	 * 
	 * @param  PageElement $element
	 * @return bool
	 */
	public function hasElement(PageElement $element)
	{
		return $this->getPlacements()->contains($element);
	}
}


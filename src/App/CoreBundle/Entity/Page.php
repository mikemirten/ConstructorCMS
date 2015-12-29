<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity()
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
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4096, nullable=true)
     */
    private $description;
	
	/**
	 * @var ArrayCollection | PageElementPlacement[]
	 * 
	 * @ORM\OneToMany(targetEntity="PageElementPlacement", mappedBy="page", cascade={"all"})
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


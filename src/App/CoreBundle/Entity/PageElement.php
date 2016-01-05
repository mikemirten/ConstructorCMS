<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PageElement
 *
 * @ORM\Table(name="page_element")
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string", length=255)
 */
abstract class PageElement
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
	 * @ORM\Column(name="title", type="string", length=255)
	 */
	private $title;
	
	/**
	 * @var ArrayCollection | PageElementPlacement[]
	 * 
	 * @ORM\OneToMany(targetEntity="PageElementPlacement", mappedBy="element")
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
     * Set title
     *
     * @param  string $title
     * @return PageElement
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
	 * Add placement
	 * 
	 * @param  PageElementPlacement $placement
	 * @return PageElement
	 */
	public function addPlacement(PageElementPlacement $placement)
	{
		$this->placements->add($placement);
		
		if ($placement->getElement() === null) {
			$placement->setElement($this);
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
	 * Get the pages where the element is used
	 * 
	 * @return Page[]
	 */
	public function getPages()
	{
		$pages = [];
		
		foreach ($this->getPlacements() as $placement) {
			$pages[] = $placement->getPage();
		}
		
		return $pages;
	}
	
	/**
	 * Get name of the element
	 */
	abstract public function getName();
}


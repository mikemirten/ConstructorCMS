<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PageElement
 *
 * @ORM\Table(name="page_element")
 * @ORM\Entity()
 */
class PageElement
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
	 * Element extension
	 *
	 * @var mixed
	 */
    private $extension;
	
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
     * @param  string $name
     * @return PageElement
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
	 * Set extension
	 * 
	 * @param mixed $extension
	 */
	public function setExtension($extension)
	{
		$this->extension = $extension;
	}
	
	/**
	 * Get extension
	 * 
	 * @return mixed
	 */
	public function getExtension()
	{
		return $this->extension;
	}
}


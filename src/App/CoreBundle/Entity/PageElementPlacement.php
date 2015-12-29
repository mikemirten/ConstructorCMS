<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageElementPlacement
 *
 * @ORM\Table(name="page_element_placement")
 * @ORM\Entity()
 */
class PageElementPlacement
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
	 * @var Page
	 * 
	 * @ORM\ManyToOne(targetEntity="Page", inversedBy="placements")
	 */
	private $page;
	
	/**
	 * @var PageElement
	 * 
	 * @ORM\ManyToOne(targetEntity="PageElement", inversedBy="placements", fetch="EAGER", cascade={"all"})
	 */
	private $element;
	
	/**
	 * @var bool
	 * 
	 * @ORM\Column(name="enabled", type="boolean")
	 */
	private $enabled = true;
	
	/**
	 * @var int
	 * 
	 * @ORM\Column(name="priority", type="integer")
	 */
	private $priority = 0;

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
	 * Set page
	 * 
	 * @param  Page $page
	 * @return PageElementPlacement
	 */
	public function setPage(Page $page)
	{
		$this->page = $page;
		
		return $this;
	}
	
	/**
	 * Get page
	 * 
	 * @return Page
	 */
	public function getPage()
	{
		return $this->page;
	}
	
	/**
	 * Set page element
	 * 
	 * @param  PageElement $element
	 * @return PageElementPlacement
	 */
	public function setElement(PageElement $element)
	{
		$this->element = $element;
		
		return $this;
	}
	
	/**
	 * Get page element
	 * 
	 * @return PageElement
	 */
	public function getElement()
	{
		return $this->element;
	}
	
	/**
	 * Enable the element on the page
	 * 
	 * @return PageElementPlacement
	 */
	public function enable()
	{
		$this->enabled = true;
		
		return $this;
	}
	
	/**
	 * Disable the element on the page
	 * 
	 * @return PageElementPlacement
	 */
	public function disable()
	{
		$this->enabled = false;
		
		return $this;
	}
	
	/**
	 * Is the element enabled on the page ?
	 * 
	 * @return bool
	 */
	public function isEnabled()
	{
		return $this->enabled;
	}
	
	/**
	 * Set the element priority on the page
	 * 
	 * @param  int $priority
	 * @return PageElementPlacement
	 */
	public function setPriority($priority)
	{
		$this->priority = $priority;
		
		return $this;
	}
	
	/**
	 * Get the element priority on the page
	 * 
	 * @return int
	 */
	public function getPriority()
	{
		return $this;
	}
}


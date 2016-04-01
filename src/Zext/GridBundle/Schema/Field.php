<?php

namespace Zext\GridBundle\Schema;

class Field
{
	/**
	 * Name
	 *
	 * @var string
	 */
	private $name;
	
	/**
	 * Title
	 *
	 * @var string
	 */
	private $title;
	
	/**
	 * width
	 * 
	 * @var int
	 */
	private $width;
	
	/**
	 * Property name
	 *
	 * @var string
	 */
	private $property;
	
	/**
	 * Orderable by the field
	 *
	 * @var bool 
	 */
	private $orderable = false;
	
	/**
	 * Searchable by the field
	 *
	 * @var bool
	 */
	private $searchable = false;
	
	/**
	 * Involved in global search
	 *
	 * @var bool
	 */
	private $globalSearchable = false;

	/**
	 * Constructor
	 * 
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
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
	 * @param type $title
	 */
	public function setTitle($title)
	{
		return $this->title = $title;
	}
	
	/**
	 * Get title
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		if ($this->title === null) {
			return ucfirst($this->name);
		}
		
		return $this->title;
	}
	
	/**
	 * Set width
	 * 
	 * @param int $width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	/**
	 * Get width
	 * 
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * Set property name
	 * 
	 * @param string $property
	 */
	public function setProperty($property)
	{
		$this->property = $property;
	}
	
	/**
	 * Get property
	 * 
	 * @return string
	 */
	public function getProperty()
	{
		return $this->property;
	}
	
	/**
	 * Set orderable
	 * 
	 * @param bool $orderable
	 */
	public function setOrderable($orderable = true)
	{
		$this->orderable = $orderable;
	}
	
	/**
	 * Is orderable ?
	 * 
	 * @return bool
	 */
	public function isOrderable()
	{
		return $this->orderable;
	}
	
	/**
	 * Set searchable
	 * 
	 * @param bool $searchable
	 */
	public function setSearchable($searchable = true)
	{
		$this->searchable = $searchable;
	}
	
	/**
	 * Is serchable ?
	 * 
	 * @return bool
	 */
	public function isSearchable()
	{
		return $this->searchable;
	}
	
	/**
	 * Set globally searchable
	 * 
	 * @param bool $searchable
	 */
	public function setGloballySearchable($searchable = true)
	{
		$this->globalSearchable = $searchable;
	}
	
	/**
	 * Is globally serchable ?
	 * 
	 * @return bool
	 */
	public function isGloballySearchable()
	{
		return $this->globalSearchable;
	}
}

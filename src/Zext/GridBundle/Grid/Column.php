<?php

namespace Zext\GridBundle\Grid;

class Column
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
}

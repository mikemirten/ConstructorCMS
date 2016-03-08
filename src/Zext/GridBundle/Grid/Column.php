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
}

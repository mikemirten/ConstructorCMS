<?php

namespace Zext\GridBundle\Grid;

class Column
{
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
	 * @param string $title
	 */
	public function __construct($title = null)
	{
		$this->title = $title;
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

<?php

namespace Zext\GridBundle\Grid;

class Column
{
	const ORDER_ASC  = 'asc';
	const ORDER_DESC = 'desc';
	
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
	 * Orderable by the column
	 *
	 * @var bool 
	 */
	private $orderable = false;
	
	/**
	 * Order ("asc" | "desc")
	 *
	 * @var string
	 */
	private $order;
	
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
	 * Set order
	 * 
	 * @param string $order
	 */
	public function setOrder($order)
	{
		if ($order === self::ORDER_ASC || $order === self::ORDER_DESC) {
			$this->order = $order;
			return;
		}
		
		throw new \LogicException(sprintf('Invalid sorting type: "%s", allowed types: "asc", "desc"', $order));
	}
	
	/**
	 * Get order
	 * 
	 * @return string ("asc" | "desc") | null
	 */
	public function getOrder()
	{
		return $this->order;
	}
}

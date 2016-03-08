<?php

namespace Zext\GridBundle\Grid;

/**
 * Cell of table's row
 */
class Cell
{
	/**
	 * Content
	 *
	 * @var mixed
	 */
	private $content;
	
	/**
	 * Constructor
	 * 
	 * @param mixed $content
	 */
	public function __construct($content = null)
	{
		if ($content !== null) {
			$this->setContent($content);
		}
	}
	
	/**
	 * Set content
	 * 
	 * @param mixed $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	/**
	 * Get content
	 * 
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}
}

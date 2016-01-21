<?php

namespace App\UiBundle\Navigation;

class Button extends Navigation
{
	/**
	 * Icon name
	 *
	 * @var string 
	 */
	private $icon;
	
	/**
	 * Route name
	 *
	 * @var string 
	 */
	private $route;
	
	/**
	 * Set icon name
	 * 
	 * @param string $icon
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}
	
	/**
	 * Get icon name
	 * 
	 * @return string
	 */
	public function getIcon()
	{
		return $this->icon;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getType()
	{
		return 'button';
	}
	
	/**
	 * Set route name
	 * 
	 * @param string $route
	 */
	public function setRoute($route)
	{
		$this->route = $route;
	}
	
	/**
	 * Get route name
	 * 
	 * @return string
	 */
	public function getRoute()
	{
		return $this->route;
	}
}

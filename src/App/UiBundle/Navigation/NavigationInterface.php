<?php

namespace App\UiBundle\Navigation;

/**
 * Inteface of navigation
 */
interface NavigationInterface extends \IteratorAggregate
{
	/**
	 * Get navigation ID
	 * 
	 * @return string
	 */
	public function getId();
	
	/**
	 * Get navigation title
	 * 
	 * @return string | null
	 */
	public function getTitle();
	
	/**
	 * Activate / deactivate navigation
	 * 
	 * @param bool $status
	 */
	public function setActive($status);
	
	/**
	 * Is the navigation active ?
	 * 
	 * @return bool
	 */
	public function isActive();
	
	/**
	 * Is the navigation enabled ?
	 * 
	 * @return bool
	 */
	public function isEnabled();
	
	/**
	 * Add element to navigation
	 * 
	 * @param  NavigationInterface $element
	 * @return Navigation
	 */
	public function addElement(NavigationInterface $element);
	
	/**
	 * Get navigation elements
	 * 
	 * @return NavigationInterface[]
	 */
	public function getElements();
	
	/**
	 * Get type of navigation
	 * 
	 * @return string
	 */
	public function getType();
}

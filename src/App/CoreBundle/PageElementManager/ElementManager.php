<?php

namespace App\CoreBundle\PageElementManager;

use App\CoreBundle\Entity\PageElement;
use App\CoreBundle\PageElement\PageElementInterface;

/**
 * Elements manager
 */
class ElementManager
{
	/**
	 * Registered elements
	 *
	 * @var PageElementInterface[] 
	 */
	private $elements = [];
	
	/**
	 * Register element
	 * 
	 * @param  PageElementInterface $element
	 * @throws \LogicException
	 */
	public function registerElement(PageElementInterface $element)
	{
		$name = $element->getName();
		
		if (isset($this->elements[$name])) {
			throw new \LogicException(sprintf('Element "%s" already registered', $name));
		}
		
		$this->elements[$name] = $element;
	}
	
	/**
	 * Get element by page element
	 * 
	 * @param  string $name
	 * @throws \LogicException
	 */
	public function getElement($name)
	{
		if (! isset($this->elements[$name])) {
			throw new \LogicException(sprintf('Unknown element "%s"', $name));
		}
		
		return $this->elements[$name];
	}
	
	/**
	 * Get registered elements
	 * 
	 * @return PageElementInterface
	 */
	public function getElements()
	{
		return $this->elements;
	}
}


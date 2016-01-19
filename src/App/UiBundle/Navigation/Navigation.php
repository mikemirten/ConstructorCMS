<?php

namespace App\UiBundle\Navigation;

/**
 * Navigation
 */
class Navigation implements NavigationInterface
{
	/**
	 * ID of navigation
	 *
	 * @var string
	 */
	private $id;
	
	/**
	 * Title
	 *
	 * @var string
	 */
	private $title;
	
	/**
	 * Elements of navigation
	 *
	 * @var NavigationElementInterface[]
	 */
	private $elements = [];
	
	/**
	 * Is the element active ?
	 *
	 * @var bool
	 */
	private $active = false;
	
	/**
	 * Constructor
	 * 
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		
		return $this;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setActive($status)
	{
		$this->active = (bool) $status;
		
		foreach ($this->getElements() as $element) {
			$element->setActive($this->active);
		}
		
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isActive()
	{
		if ($this->active) {
			return true;
		}
		
		foreach ($this->getElements() as $element) {
			if ($element->isActive()) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function isEnabled()
	{
		return true;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getType()
	{
		return 'navigation';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function addElement(NavigationInterface $element)
	{
		$id = $element->getId();
		
		if (isset($this->elements[$id])) {
			throw new \LogicException(sprintf('Navigation with ID: "%s" already exists', $id));
		}
		
		$this->elements[$id] = $element;
		
		return $this;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getElements()
	{
		return $this->elements;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->getElements());
	}
	
	/**
	 * Cast to string
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->getTitle();
	}
}

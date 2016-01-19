<?php

namespace App\UiBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use App\UiBundle\Navigation\NavigationInterface;

/**
 * "On navigation prepare" event
 */
class NavigationPrepareEvent extends Event
{
	/**
	 * Navigation
	 *
	 * @var NavigationInterface 
	 */
	private $navigation;
	
	/**
	 * Constructor
	 * 
	 * @param NavigationInterface $navigation
	 */
	public function __construct(NavigationInterface $navigation)
	{
		$this->navigation = $navigation;
	}
	
	/**
	 * Get navigation
	 * 
	 * @return NavigationInterface
	 */
	public function getNavigation()
	{
		return $this->navigation;
	}
}

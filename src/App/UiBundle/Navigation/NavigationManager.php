<?php

namespace App\UiBundle\Navigation;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use App\UiBundle\Exception\NavigationNotFound;
use App\UiBundle\Event\NavigationPrepareEvent;

/**
 * Manager of navigations
 */
class NavigationManager
{
	const EVENT_PREPARE = 'ui.navigation.%s';
	
	/**
	 * Navigations
	 *
	 * @var NavigationInterface[]
	 */
	private $navigations = [];
	
	/**
	 * Navigations prepared
	 *
	 * @var NavigationInterface[]
	 */
	private $navigationsPrepared = [];
	
	/**
	 * Event dispatcher
	 *
	 * @var EventDispatcherInterface 
	 */
	protected $eventDispatcher;
	
	/**
	 * Constructor
	 * 
	 * @param EventDispatcherInterface $dispatcher
	 */
	public function __construct(EventDispatcherInterface $dispatcher)
	{
		$this->eventDispatcher = $dispatcher;
	}
	
	/**
	 * Register navigation in manager
	 * 
	 * @param  NavigationInterface $navigation
	 * @throws \LogicException
	 * @return NavigationManager
	 */
	public function registerNavigation(NavigationInterface $navigation)
	{
		$id = $navigation->getId();
		
		if (isset($this->navigations[$id])) {
			throw new \LogicException(sprintf('Navigation with ID: "%s" already registered', $id));
		}
		
		$this->navigations[$id] = $navigation;
		
		return $this;
	}
	
	/**
	 * Get navigation by ID
	 * 
	 * @param  string $id
	 * @return Navigation
	 * @throws NavigationNotFound
	 */
	public function getNavigation($id)
	{
		if (isset($this->navigationsPrepared[$id])) {
			return $this->navigationsPrepared[$id];
		}
		
		if (! isset($this->navigations[$id])) {
			throw new NavigationNotFound(sprintf('Navigation with ID: "%s" not found', $id));
		}
		
		$navigation = $this->navigations[$id];
		
		$name  = sprintf(self::EVENT_PREPARE, $navigation->getId());
		$event = new NavigationPrepareEvent($navigation);
		
		$this->eventDispatcher->dispatch($name, $event);
		
		$this->navigationsPrepared[$id] = $navigation;
		
		return $this->navigations[$id];
	}
}

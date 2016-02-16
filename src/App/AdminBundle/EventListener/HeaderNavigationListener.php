<?php

namespace App\AdminBundle\EventListener;

use App\UiBundle\Event\NavigationPrepareEvent;
use App\UiBundle\Navigation\Button;

class HeaderNavigationListener
{
	public function onHeadNavigation(NavigationPrepareEvent $event)
	{
		$btn = new Button('off');
		$btn->setIcon('off');
		
		$event->getNavigation()->addElement($btn);
	}
	
	public function onSideNavigation(NavigationPrepareEvent $event)
	{
		$content = new Button('content');
		$content->setTitle('Content');
		$content->setIcon('hdd');
		
		$pages = new Button('pages');
		$pages->setTitle('Pages');
		$pages->setIcon('file');
		$pages->setRoute('app.admin.page.list');
		
		$content->addElement($pages);
		
		$elements = new Button('elements');
		$elements->setTitle('Elements');
		$elements->setIcon('list-alt');
		
		$content->addElement($elements);
		
		$event->getNavigation()->addElement($content);
	}
}

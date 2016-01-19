<?php

namespace App\UiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NavigationCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$managerDefinition    = $container->findDefinition('ui.navigation_manager');
		$navigationElementIds = $container->findTaggedServiceIds('ui.navigation');
		
		foreach ($navigationElementIds as $id => $tags) {
			$managerDefinition->addMethodCall(
				'registerNavigation',
				[ new Reference($id) ]
			);
		}
	}
}


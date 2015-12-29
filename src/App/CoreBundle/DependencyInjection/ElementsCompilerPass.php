<?php

namespace App\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ElementsCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$managerDefinition = $container->findDefinition('core.element_manager');
		$pageElementIds    = $container->findTaggedServiceIds('core.page_element');
		
		foreach ($pageElementIds as $id => $tags) {
			$managerDefinition->addMethodCall(
				'registerElement',
				[ new Reference($id) ]
			);
		}
	}
}


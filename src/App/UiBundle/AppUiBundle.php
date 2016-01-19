<?php

namespace App\UiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use App\UiBundle\DependencyInjection\Compiler\NavigationCompilerPass;

class AppUiBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		$container->addCompilerPass(new NavigationCompilerPass());
	}
}

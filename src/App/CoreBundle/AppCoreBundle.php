<?php

namespace App\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use App\CoreBundle\DependencyInjection\ElementsCompilerPass;

class AppCoreBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		$container->addCompilerPass(new ElementsCompilerPass());
	}
}

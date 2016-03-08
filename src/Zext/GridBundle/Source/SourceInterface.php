<?php

namespace Zext\GridBundle\Source;

use Zext\GridBundle\SchemaProvider\SchemaProviderInterface;

interface SourceInterface extends SchemaProviderInterface
{	
	/**
	 * Get rows with data
	 * 
	 * @return \Zext\GridBundle\Grid\Row[]
	 */
	public function getData();
}

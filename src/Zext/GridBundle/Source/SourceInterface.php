<?php

namespace Zext\GridBundle\Source;

use Zext\GridBundle\SchemaProvider\SchemaProviderInterface;
use Zext\GridBundle\Request\RequestInterface;

interface SourceInterface extends SchemaProviderInterface
{	
	/**
	 * Get rows with data
	 * 
	 * @param  RequestInterface $request
	 * @return \Zext\GridBundle\Grid\Row[]
	 */
	public function getData(RequestInterface $request);
}

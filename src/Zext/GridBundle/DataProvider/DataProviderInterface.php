<?php

namespace Zext\GridBundle\DataProvider;

use Zext\GridBundle\SchemaProvider\SchemaProviderInterface;
use Zext\GridBundle\Request\RequestInterface;

interface DataProviderInterface extends SchemaProviderInterface
{	
	/**
	 * Get rows with data
	 * 
	 * @param  RequestInterface $request
	 * @return \Zext\GridBundle\Grid\Row[]
	 */
	public function getData(RequestInterface $request);
}

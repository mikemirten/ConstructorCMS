<?php

namespace Zext\GridBundle\SchemaProvider;

interface SchemaProviderInterface
{
	/**
	 * Get columns
	 * 
	 * @return \Zext\GridBundle\Grid\Column[]
	 */
	public function getSchema();
}

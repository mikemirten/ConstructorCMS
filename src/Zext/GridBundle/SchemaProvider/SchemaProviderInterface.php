<?php

namespace Zext\GridBundle\SchemaProvider;

interface SchemaProviderInterface
{
	/**
	 * Get columns
	 * 
	 * @return \Zext\GridBundle\Schema\Schema
	 */
	public function getSchema();
}

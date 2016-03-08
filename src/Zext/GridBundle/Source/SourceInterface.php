<?php

namespace Zext\GridBundle\Source;

interface SourceInterface
{
	/**
	 * Get columns
	 * 
	 * @return \Zext\GridBundle\Grid\Column[]
	 */
	public function getSchema();
	
	/**
	 * Get rows with data
	 * 
	 * @return \Zext\GridBundle\Grid\Row[]
	 */
	public function getData();
}

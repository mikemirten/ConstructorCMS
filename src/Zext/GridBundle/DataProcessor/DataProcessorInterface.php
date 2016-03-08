<?php

namespace Zext\GridBundle\DataProcessor;

interface DataProcessorInterface
{
	/**
	 * Process source into a Row instance
	 * 
	 * @param  mixed $source
	 * @return \Zext\GridBundle\Grid\Row
	 */
	public function process($source);
}

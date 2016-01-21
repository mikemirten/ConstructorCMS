<?php

namespace App\UiBundle\Navigation;

class Group extends Navigation
{
	/**
	 * {@inheritdoc}
	 */
	public function getType()
	{
		return 'group';
	}
}

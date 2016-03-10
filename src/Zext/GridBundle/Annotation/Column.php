<?php

namespace Zext\GridBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class Column
{
	/**
	 * Title
	 *
	 * @var string
	 */
	public $title;
	
	/**
	 * Width
	 *
	 * @var int
	 */
	public $width;
	
	/**
	 * Property name
	 *
	 * @var string
	 */
	public $property;
	
	/**
	 * Orderable
	 *
	 * @var boolean
	 */
	public $orderable = false;
	
	/**
	 * Searchable
	 *
	 * @var boolean
	 */
	public $searchable = false;
}

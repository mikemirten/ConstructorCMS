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
	 * Orderable by the column
	 *
	 * @var boolean
	 */
	public $orderable = false;
}

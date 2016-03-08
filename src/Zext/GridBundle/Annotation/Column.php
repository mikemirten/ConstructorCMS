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
}

<?php

namespace App\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * Wysiwyg type
 */
class WysiwygType extends AbstractType
{	
	/**
     * {@inheritdoc}
     */
	public function getParent()
	{
		return 'textarea';
	}
	
	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'wysiwyg';
	}
}

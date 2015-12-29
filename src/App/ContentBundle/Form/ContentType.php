<?php

namespace App\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentType extends AbstractType
{
	/**
     * {@inheritdoc}
     */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'App\ContentBundle\Entity\ContentElement',
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('content', 'wysiwyg', [
			'label' => 'Content'
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'content_element';
	}
}
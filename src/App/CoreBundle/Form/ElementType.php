<?php

namespace App\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElementType extends AbstractType
{
	/**
     * {@inheritdoc}
     */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'App\CoreBundle\Entity\PageElement',
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('title', 'text', [
			'label' => 'Title'
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'core_element';
	}
}

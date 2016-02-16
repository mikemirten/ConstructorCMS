<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
	/**
     * {@inheritdoc}
     */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'App\CoreBundle\Entity\Page',
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder->add('name', 'text', [
			'label' => 'Name'
		]);
		
		$builder->add('description', 'textarea', [
			'label' => 'Description'
		]);
	}
	
	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'core_page';
	}
}

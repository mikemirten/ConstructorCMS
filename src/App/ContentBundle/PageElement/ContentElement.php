<?php

namespace App\ContentBundle\PageElement;

use Doctrine\Bundle\DoctrineBundle\Registry;

use App\CoreBundle\PageElement\PageElementInterface;
use App\CoreBundle\Entity\PageElement;

class ContentElement implements PageElementInterface
{
	/**
	 * Doctrine registry
	 *
	 * @var Registry 
	 */
	protected $doctrine;
	
	/**
	 * Constructor
	 * 
	 * @param Registry $doctrine
	 */
	public function __construct(Registry $doctrine)
	{
		$this->doctrine = $doctrine;
	}
	
	/**
     * {@inheritdoc}
     */
	public function getDescription()
	{
		return 'Simple content element';
	}

	/**
     * {@inheritdoc}
     */
	public function getName()
	{
		return 'core.content';
	}
	
	/**
     * {@inheritdoc}
     */
	public function getIcon()
	{
		return 'file';
	}
	
	/**
     * {@inheritdoc}
     */
	public function getCreateFormName()
	{
		return 'content_element';
	}

	/**
     * {@inheritdoc}
     */
	public function getTemplateName(PageElement $element)
	{
		return 'AppContentBundle:PageElement:content.html.twig';
	}
	
	/**
     * {@inheritdoc}
     */
	public function getTemplateData(PageElement $element)
	{
		$content = $this->doctrine
			->getRepository('AppContentBundle:ContentElement')
			->find($element->getId());
		
		return [
			'element' => $element,
			'content' => $content
		];
	}
}


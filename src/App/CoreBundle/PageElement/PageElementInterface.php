<?php

namespace App\CoreBundle\PageElement;

use App\CoreBundle\Entity\PageElement;

/**
 * Page element interface
 */
interface PageElementInterface
{
	/**
	 * Get name of element
	 * 
	 * @return string
	 */
	public function getName();
	
	/**
	 * Get icon of element
	 * 
	 * @return string | null
	 */
	public function getIcon();
	
	/**
	 * Get description of element
	 * 
	 * @return string
	 */
	public function getDescription();
	
	/**
	 * Get full template name for the element
	 * 
	 * @return string
	 */
	public function getTemplateName(PageElement $element);
	
	/**
	 * Get data for the template rendering
	 * 
	 * @return array
	 */
	public function getTemplateData(PageElement $element);
	
	/**
	 * Get "Add" action form name
	 * 
	 * @return string | null
	 */
	public function getCreateFormName();
}


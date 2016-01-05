<?php

namespace App\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\CoreBundle\Entity\Page;
use App\CoreBundle\Entity\PageElement;

class PageController extends Controller
{
	/**
	 * Render page
	 * 
	 * @param  int $pageId
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function pageAction($pageId)
	{
		$page = $this->getDoctrine()
			->getRepository('AppCoreBundle:Page')
			->getPageWithElements((int) $pageId);
		
		if ($page === null) {
			throw $this->createNotFoundException();
		}
		
		return $this->render('AppCoreBundle:Page:page.html.twig', [
			'page' => $page
		]);
	}
	
	/**
	 * Render element of page
	 * 
	 * @param  PageElement $element
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function elementAction(PageElement $element)
	{
		$elementType = $this->get('core.element_manager')
			->getElement($element->getName());
		
		try {
			return $this->render(
				$elementType->getTemplateName($element),
				$elementType->getTemplateData($element)
			);
		} catch (\Twig_Error_Runtime $e) {
			return $this->render('AppCoreBundle:Element:error.html.twig');
		}
	}
}


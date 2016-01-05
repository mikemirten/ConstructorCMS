<?php

namespace App\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\CoreBundle\Entity\Page;
use App\CoreBundle\Entity\PageElementPlacement;

use App\CoreBundle\PageElement\PageElementInterface;

class ElementController extends Controller
{
	/**
	 * Create element
	 * 
	 * @param  Request $request
	 * @param  Page    $page
	 * @param  string  $elementName
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function createAction(Request $request, Page $page, $elementName)
	{
		$form = $this->createElementForm($page, $elementName);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$manager = $this->getDoctrine()->getManager();
			
			$pageElement = $form->getData();
			$page->addElement($pageElement);
			
			$manager->persist($page);
			$manager->flush();
			
			if ($request->isXmlHttpRequest()) {
				return $this->forward('AppCoreBundle:Page:element', [
					'element' => $pageElement
				]);
			}
			
			return $this->redirectToRoute('app_core_page', ['page' => $page->getId()]);
		}
		
		$scriptName = ($request->isXmlHttpRequest())
			? 'AppCoreBundle:Element:create_ajax.html.twig'
			: 'AppCoreBundle:Element:create.html.twig';
		
		return $this->render($scriptName, [
			'createForm' => $form->createView()
		]);
	}
	
	/**
	 * Create form for element
	 * 
	 * @param  Page   $page
	 * @param  string $name
	 * @return \Symfony\Component\Form\Form
	 */
	protected function createElementForm(Page $page, $name)
	{
		$descriptor = $this->get('core.element_manager')->getElement($name);
		
		$action = $this->generateUrl('core_element_create', [
			'page'        => $page->getId(),
			'elementName' => $descriptor->getName()
		]);
		
		return $this->createForm($descriptor->getCreateFormName(), null, [
			'action' => $action
		]);
	}
	
	/**
	 * Sort elements page
	 * 
	 * @param  Request $request
	 * @param  Page    $page
	 * @return JsonResponse
	 * @throws \RuntimeException
	 */
	public function sortAction(Request $request, Page $page)
	{
		$listRaw = $request->get('list');
		$list    = json_decode($listRaw, true);
		
		if ($list === null) {
			throw new \RuntimeException('List decoding error');
		}
		
		$placements = $page->getPlacements();
		$manager    = $this->getDoctrine()->getManager();
		
		foreach ($list as $priority => $id) {
			$placements[$id]->setPriority($priority);
			$manager->persist($placements[$id]);
		}
		
		$manager->flush();
		
		return new JsonResponse([
			'success' => true
		]);
	}
	
	/**
	 * Remove element
	 * 
	 * @param  PageElementPlacement $placement
	 * @return JsonResponse
	 */
	public function removeAction(PageElementPlacement $placement)
	{
		$manager = $this->getDoctrine()->getManager();
		
		$manager->remove($placement);
		$manager->flush();
		
		return new JsonResponse([
			'success' => true
		]);
	}
	
	/**
	 * Get list of the elements allowed to create
	 * 
	 * @return JsonResponse
	 */
	public function listAction(Page $page)
	{
		$elements = $this->get('core.element_manager')->getElements();
		
		return new JsonResponse([
			'data' => array_map(
				function(PageElementInterface $element) use($page) {
					$url = $this->generateUrl('core_element_create', [
						'page'        => $page->getId(),
						'elementName' => $element->getName()
					]);
				
					return (object) [
						'name'        => $element->getName(),
						'icon'        => $element->getIcon(),
						'description' => $element->getDescription(),
						'url'         => $url
					];
				},
			$elements)
		]);
	}
}
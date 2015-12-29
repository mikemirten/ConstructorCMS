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
		$elementType = $this->get('core.element_manager')->getElement($elementName);
		
		$form = $this->createElementForm($page, $elementType);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$manager = $this->getDoctrine()->getManager();
			
			$pageElement = $form->getData();
			$pageElement->setName($elementName);
			
			$page->addElement($pageElement);
			
			$manager->persist($page);
			$manager->flush();
			
			$element = $pageElement->getExtension();
			$element->setId($pageElement->getId());
			
			$manager->persist($element);
			$manager->flush();
			
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
	 * Create form
	 * 
	 * @param  Page                 $page
	 * @param  PageElementInterface $element
	 * @return \Symfony\Component\Form\Form
	 */
	public function createElementForm(Page $page, PageElementInterface $element)
	{
		$form = $this->createForm('core_element', null, [
			'action' => $this->generateUrl('app_core_create_element', [
				'page'        => $page->getId(),
				'elementName' => $element->getName()
			])
		]);
		
		$elementType = $element->getCreateFormName();
		
		if ($elementType !== null) {
			$form->add('extension', $elementType, ['label' => false]);
		}
		
		return $form;
	}
	
	/**
	 * Get list of the elements allowed to create
	 * 
	 * @return JsonResponse
	 */
	public function listAction()
	{
		$elements = $this->get('core.element_manager')->getElements();
		
		return new JsonResponse([
			'data' => array_map(
				function(PageElementInterface $element) {
					return (object) [
						'name'        => $element->getName(),
						'icon'        => $element->getIcon(),
						'description' => $element->getDescription()
					];
				},
			$elements)
		]);
	}
}
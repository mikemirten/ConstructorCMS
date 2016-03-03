<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\CoreBundle\Entity\Page;

class PageController extends Controller
{
	/**
	 * List of pages
	 * 
	 * @return Response
	 */
    public function listAction()
    {
		$pages = $this->getDoctrine()
			->getRepository('AppCoreBundle:Page')
			->findAll();
		
        return $this->render('AppAdminBundle:Page:list.html.twig', [
			'pages' => $pages
		]);
    }
	
	/**
	 * Show page
	 * 
	 * @param  Page $page
	 * @return Response
	 */
	public function showAction(Page $page)
	{
		return $this->render('AppAdminBundle:Page:show.html.twig', [
			'page' => $page
		]);
	}
	
	public function pageAction(Page $page)
	{
		return $this->render('AppAdminBundle:Page:page.html.twig', [
			'page' => $page
		]);
	}
	
	/**
	 * Add page
	 * 
	 * @param  Request $request
	 * @return JsonResponse
	 */
	public function addAction(Request $request)
	{
		$form = $this->createForm('core_page', null, [
			'action' => $this->generateUrl('app.admin.page.add')
		]);
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$page    = $form->getData();
			$manager = $this->getDoctrine()->getManager();
			
			$manager->persist($page);
			$manager->flush();
			
			if ($request->isXmlHttpRequest()) {
				return new JsonResponse(['success' => true]);
			}
			
			return $this->redirectToRoute('app.admin.pages');
		}
		
		return $this->render('AppAdminBundle:Page:add.html.twig', [
			'form' => $form->createView()
		]);
	}
	
	/**
	 * Edit page
	 * 
	 * @param  Page    $page
	 * @param  Request $request
	 * @return JsonResponse
	 */
	public function editAction(Page $page, Request $request)
	{
		$form = $this->createForm('core_page', $page, [
			'action' => $this->generateUrl('app.admin.page.edit', ['page' => $page->getId()])
		]);
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$page    = $form->getData();
			$manager = $this->getDoctrine()->getManager();
			
			$manager->persist($page);
			$manager->flush();
			
			if ($request->isXmlHttpRequest()) {
				return new JsonResponse(['success' => true]);
			}
			
			return $this->redirectToRoute('app.admin.pages');
		}
		
		return $this->render('AppAdminBundle:Page:edit.html.twig', [
			'form' => $form->createView()
		]);
	}
}
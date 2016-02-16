<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\CoreBundle\Entity\Page;

class PageController extends Controller
{
    public function listAction()
    {
		$pages = $this->getDoctrine()
			->getRepository('AppCoreBundle:Page')
			->findAll();
		
        return $this->render('AppAdminBundle:Page:list.html.twig', [
			'pages' => $pages
		]);
    }
	
	public function pageAction(Page $page)
	{
		return $this->render('AppAdminBundle:Page:page.html.twig', [
			'page' => $page
		]);
	}
	
	public function addAction()
	{
		$form = $this->createForm('core_page', null, [
			'action' => $this->generateUrl('app.admin.pages.add')
		]);
		
		return $this->render('AppAdminBundle:Page:add.html.twig', [
			'form' => $form->createView()
		]);
	}
}
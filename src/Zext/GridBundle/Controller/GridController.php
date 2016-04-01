<?php

namespace Zext\GridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GridController extends Controller
{
	public function gridAction(Request $request)
	{
		$repo = $this->getDoctrine()->getRepository('AppCoreBundle:Page');
		
		$reader = $this->get('annotation_reader');
		$access = $this->get('property_accessor');
		
		$prvd = new \Zext\GridBundle\SchemaProvider\EntityAnnotationSchemaProvider($repo, $reader);
		$proc = new \Zext\GridBundle\DataProcessor\PropertyAccessDataProcessor($access, $prvd);
		$src  = new \Zext\GridBundle\DataProvider\SelectableDataProvider($repo, $prvd, $proc);
		$req  = new \Zext\GridBundle\Request\HttpRequest($request);
		
		$grid = new \Zext\GridBundle\Grid\Grid($src, $req);
		$grid->setTitle('Page');
		
		return $this->render('ZextGridBundle:Grid:page.html.twig', [
			'isAjax' => $request->isXmlHttpRequest(),
			'grid'   => $grid
		]);
	}
}

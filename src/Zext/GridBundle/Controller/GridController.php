<?php

namespace Zext\GridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GridController extends Controller
{
	public function gridAction()
	{
		$repo = $this->getDoctrine()->getRepository('AppCoreBundle:Page');
		
		$reader = $this->get('annotation_reader');
		$access = $this->get('property_accessor');
		
		$prvd = new \Zext\GridBundle\SchemaProvider\EntityAnnotationSchemaProvider($repo, $reader);
		$proc = new \Zext\GridBundle\DataProcessor\EntityDataProcessor($access, $prvd);
		$src  = new \Zext\GridBundle\Source\RepositorySource($repo, $prvd, $proc);
		
		$grid = new \Zext\GridBundle\Grid\Grid($src);
		
		return $this->render('ZextGridBundle:Grid:grid.html.twig', [
			'grid' => $grid
		]);
	}
}

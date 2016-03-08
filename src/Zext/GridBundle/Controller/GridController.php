<?php

namespace Zext\GridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GridController extends Controller
{
	public function gridAction()
	{
		$src = new \Zext\GridBundle\Source\ArraySource([
			[1, 2, 3, 4],
			[1, 2, 3, 4],
			[1, 2, 3, 4],
			[1, 2, 3, 4]
		]);
		
		$grid = new \Zext\GridBundle\Grid\Grid($src);
		
		return $this->render('ZextGridBundle:Grid:grid.html.twig', [
			'grid' => $grid
		]);
	}
}

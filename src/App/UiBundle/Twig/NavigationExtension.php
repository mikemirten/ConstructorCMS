<?php

namespace App\UiBundle\Twig;

use App\UiBundle\Navigation\NavigationManager;

/**
 * Twig's navigation extension
 */
class NavigationExtension extends \Twig_Extension
{
	/**
	 * Navigation manager
	 *
	 * @var NavigationManager 
	 */
	protected $navigationManager;
	
	/**
	 * Constructor
	 * 
	 * @param NavigationManager $manager
	 */
	public function __construct(NavigationManager $manager)
	{
		$this->navigationManager = $manager;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFunctions()
	{
		return [
			new \Twig_SimpleFunction('navigation', [$this, 'navigation'], [
				'needs_environment' => true,
				'is_safe'           => ['html']
			])
		];
	}
	
	/**
	 * Render navigation
	 * 
	 * @param  \Twig_Environment $environment
	 * @param  string $id
	 * @return string
	 */
	public function navigation(\Twig_Environment $environment, $id, $script = null)
	{
		$navigation = $this->navigationManager->getNavigation($id);
		
		return $environment->render($script, [
			'navigation' => $navigation
		]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		'constructor_ui_navigation';
	}
}
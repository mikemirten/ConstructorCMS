<?php

namespace App\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
	/**
	 * Get page by ID with elements by one request
	 * 
	 * @param  int $pageId
	 * @return \App\CoreBundle\Entity\Page | null
	 */
	public function getPageWithElements($pageId)
	{
		return $this->createQueryBuilder('page')
			->leftJoin('page.placements', 'place')
			->addSelect('place')
			->leftJoin('place.element', 'element')
			->addSelect('element')
			->where('page = :id')
			->setParameter('id', $pageId)
			->getQuery()
			->getOneOrNullResult();
	}
}

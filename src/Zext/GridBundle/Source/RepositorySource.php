<?php

namespace Zext\GridBundle\Source;

use Doctrine\Common\Persistence\ObjectRepository;

use Zext\GridBundle\SchemaProvider\SchemaProviderInterface;
use Zext\GridBundle\DataProcessor\DataProcessorInterface;

class RepositorySource implements SourceInterface
{
	/**
	 * Doctrine repository
	 *
	 * @var RepositoryInterface
	 */
	private $repository;
	
	/**
	 * Schema provider
	 *
	 * @var SchemaProviderInterface 
	 */
	private $schemaProvider;
	
	/**
	 * Data processor
	 *
	 * @var DataProcessorInterface
	 */
	private $dataProcessor;
	
	/**
	 * Constructor
	 * 
	 * @param RepositoryInterface $repository
	 */
	public function __construct(ObjectRepository $repository, SchemaProviderInterface $schemaProvider, DataProcessorInterface $dataProcessor)
	{
		$this->repository     = $repository;
		$this->schemaProvider = $schemaProvider;
		$this->dataProcessor  = $dataProcessor;
	}
	
	/**
     * {@inheritdoc}
     */
	public function getData()
	{
		$result = $this->repository->findAll();
		$data   = [];
		
		foreach ($result as $item) {
			$data[] = $this->dataProcessor->process($item);
		}
		
		return $data;
	}

	/**
     * {@inheritdoc}
     */
	public function getSchema()
	{
		return $this->schemaProvider->getSchema();
	}
}

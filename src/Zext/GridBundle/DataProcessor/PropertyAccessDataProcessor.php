<?php

namespace Zext\GridBundle\DataProcessor;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use Zext\GridBundle\SchemaProvider\SchemaProviderInterface;

use Zext\GridBundle\Grid\Row;
use Zext\GridBundle\Grid\Cell;

class PropertyAccessDataProcessor implements DataProcessorInterface
{
	/**
	 * Property accessor
	 *
	 * @var PropertyAccessorInterface
	 */
	private $accessor;
	
	/**
	 * Schema provider
	 *
	 * @var SchemaProviderInterface 
	 */
	private $schemaProvider;
	
	/**
	 * Properties list
	 *
	 * @var array
	 */
	private $propertiesList;
	
	/**
	 * Constructor
	 * 
	 * @param PropertyAccessorInterface $accessor
	 * @param SchemaProviderInterface   $schemaProvider
	 */
	public function __construct(PropertyAccessorInterface $accessor, SchemaProviderInterface $schemaProvider)
	{
		$this->accessor       = $accessor;
		$this->schemaProvider = $schemaProvider;
	}
	
	/**
     * {@inheritdoc}
     */
	public function process($source)
	{
		$this->initializeProperties();
		
		$row = new Row();
		
		foreach ($this->propertiesList as $property) {
			$value = $this->accessor->getValue($source, $property);
			
			$row->appendCell(new Cell($value));
		}
		
		return $row;
	}
	
	/**
	 * Initialize properties
	 */
	protected function initializeProperties()
	{
		if ($this->propertiesList !== null) {
			return;
		}
		
		$this->propertiesList = new \SplDoublyLinkedList();
			
		foreach ($this->schemaProvider->getSchema() as $column) {
			$property = $column->getProperty() ?: $column->getName();
			
			$this->propertiesList->push($property);
		}
	}
}

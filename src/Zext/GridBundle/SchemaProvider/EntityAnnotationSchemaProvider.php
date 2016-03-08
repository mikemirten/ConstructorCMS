<?php

namespace Zext\GridBundle\SchemaProvider;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Annotations\Reader;

use Zext\GridBundle\Annotation\Grid    as GridAnnotation;
use Zext\GridBundle\Annotation\Column  as ColumnAnnotation;
use Zext\GridBundle\Annotation\Exclude as ExcludeAnnotation;

use Zext\GridBundle\Grid\Column;

class EntityAnnotationSchemaProvider implements SchemaProviderInterface
{
	/**
	 * Doctrine repository
	 *
	 * @var ObjectRepository
	 */
	private $repository;
	
	/**
	 * Amnnotation reader
	 *
	 * @var Reader
	 */
	private $reader;
	
	/**
	 * Reflection
	 *
	 * @var \ReflectionClass
	 */
	private $reflection;
	
	/**
	 * Columns
	 *
	 * @var Column[]
	 */
	private $columns;
	
	/**
	 * Constructor
	 * 
	 * @param RepositoryInterface $repository
	 */
	public function __construct(ObjectRepository $repository, Reader $reader)
	{
		$this->repository = $repository;
		$this->reader     = $reader;
	}
	
	/**
     * {@inheritdoc}
     */
	public function getSchema()
	{
		if ($this->columns === null) {
			$this->columns = $this->getColumns();
		}
		
		return $this->columns;
	}
	
	/**
	 * Get columns
	 * 
	 * @return Column[]
	 */
	protected function getColumns()
	{
		$gridAnnotation = $this->getGridAnnotation();

		if ($gridAnnotation === null || $gridAnnotation->strategy === GridAnnotation::STRATEGY_EXCLUDE) {
			return $this->getColumnsByExcludeStrategy();
		}

		return $this->getColumnsByIncludeStrategy();
	}
	
	/**
	 * Get column by properties with "Column" annotation
	 * "Exclude" annotation will be ignored
	 * 
	 * @return Column[]
	 */
	protected function getColumnsByIncludeStrategy()
	{
		$properties  = $this->getClassReflection()->getProperties();
		$annotations = $this->getColumnAnnotations();
		
		$columns = [];
		
		foreach ($properties as $property) {
			$name = $property->getName();
			
			if (! isset($annotations[$name])) {
				continue;
			}
			
			$columns[] = $this->createColumnUsingAnnotation($name, $annotations[$name]);
		}
		
		return $columns;
	}
	
	/**
	 * Get column by properties without "Exclude" annotation
	 * 
	 * @return Column[]
	 */
	protected function getColumnsByExcludeStrategy()
	{
		$properties = $this->getClassReflection()->getProperties();
		
		$excludedAnnotations = $this->getExcludeAnnotations();
		$columnsAnnotations  = $this->getColumnAnnotations();
		
		$columns = [];
		
		foreach ($properties as $property) {
			$name = $property->getName();
			
			if (isset($excludedAnnotations[$name])) {
				continue;
			}
			
			if (isset($columnsAnnotations[$name])) {
				$columns[] = $this->createColumnUsingAnnotation($name, $columnsAnnotations[$name]);
				continue;
			}
			
			$columns[] = new Column($name);
		}
		
		return $columns;
	}
	
	/**
	 * Create column using annotation
	 * 
	 * @param  ColumnAnnotation $annotation
	 * @return Column
	 */
	protected function createColumnUsingAnnotation($name, ColumnAnnotation $annotation)
	{
		$column = new Column($name);
		
		$column->setTitle($annotation->title);
		$column->setWidth($annotation->width);
		
		return $column;
	}
	
	/**
	 * Get GRID annotation
	 * 
	 * @return GridAnnotation | null
	 */
	protected function getGridAnnotation()
	{
		$reflection = $this->getClassReflection();
		
		return $this->reader->getClassAnnotation($reflection, GridAnnotation::class);
	}
	
	/**
	 * Get columns annotations
	 * 
	 * @return ExcludeAnnotation[]
	 */
	protected function getColumnAnnotations()
	{
		return $this->readPropertyAnnotations(ColumnAnnotation::class);
	}
	
	/**
	 * Get exclude annotations
	 * 
	 * @return ExcludeAnnotation[]
	 */
	protected function getExcludeAnnotations()
	{
		return $this->readPropertyAnnotations(ExcludeAnnotation::class);
	}
	
	/**
	 * Get columns annotations
	 * 
	 * @param  string $annotationName
	 * @return array
	 */
	protected function readPropertyAnnotations($annotationName)
	{
		$reflection  = $this->getClassReflection();
		$annotations = [];
		
		foreach ($reflection->getProperties() as $property) {
			$annotation = $this->reader->getPropertyAnnotation($property, $annotationName);
			
			if ($annotation !== null) {
				$annotations[$property->getName()] = $annotation;
			}
		}
		
		return $annotations;
	}
	
	/**
	 * Get reflection of entity class
	 * 
	 * @return \ReflectionClass
	 */
	protected function getClassReflection()
	{
		if ($this->reflection === null) {
			$class = $this->repository->getClassName();
			
			$this->reflection = new \ReflectionClass($class);
		}
		
		return $this->reflection;
	}
}

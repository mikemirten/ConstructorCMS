<?php

namespace Zext\GridBundle\Grid;

use Zext\GridBundle\DataProvider\DataProviderInterface;
use Zext\GridBundle\Request\RequestInterface;
use Zext\GridBundle\Validator\RequestValidator;
use Zext\GridBundle\Schema\Schema;

class Grid
{
	/**
	 * DataProvider
	 *
	 * @var DataProviderInterface
	 */
	protected $source;
	
	/**
	 * Request
	 *
	 * @var RequestInterface 
	 */
	protected $request;
	
	/**
	 * Rows
	 *
	 * @var Row[]
	 */
	private $rows;
	
	/**
	 * Schema
	 *
	 * @var Schema 
	 */
	private $schema;
	
	/**
	 * Columns
	 *
	 * @var Column
	 */
	private $columns;
	
	/**
	 * Title
	 *
	 * @var string
	 */
	private $title;
	
	/**
	 * Constructor
	 * 
	 * @param DataProviderInterface $source
	 */
	public function __construct(DataProviderInterface $source, RequestInterface $request)
	{
		$this->source  = $source;
		$this->request = $request;
	}
	
	/**
	 * Set title
	 * 
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Get title
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Is GRID globally searchable ?
	 * 
	 * @return bool
	 */
	public function isGloballySearchable()
	{
		return $this->getSchema()->hasGloballySearchable();
	}
	
	/**
	 * Get global search string if defined
	 * 
	 * @return string | null
	 */
	public function getGlobalSearch()
	{
		return $this->request->getGlobalSearch();
	}
	
	/**
	 * Get rows
	 * 
	 * @return Rows[]
	 */
	public function getRows()
	{
		if ($this->rows === null) {
			$requestValidator = new RequestValidator($this->getSchema());
			$errors = $requestValidator->validate($this->request);
			
			if (! empty($errors)) {
				throw new \LogicException(implode(', ', $errors));
			}
			
			$this->rows = $this->source->getData($this->request);
		}
		
		return $this->rows;
	}
	
	/**
	 * Get columns
	 * 
	 * @return Column[]
	 */
	public function getColumns()
	{
		if ($this->columns === null) {
			$this->columns = [];
			
			foreach ($this->getSchema()->getFields() as $field) {
				$this->columns[] = new Column($field, $this->request);
			}
		}
		
		return $this->columns;
	}
	
	/**
	 * Get schema
	 * 
	 * @return Schema
	 */
	public function getSchema()
	{
		if ($this->schema === null) {
			$this->schema = $this->source->getSchema();
		}
		
		return $this->schema;
	}
}

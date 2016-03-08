<?php

namespace Zext\GridBundle\Grid;

use Zext\GridBundle\Source\SourceInterface;

class Grid
{
	/**
	 * Source
	 *
	 * @var SourceInterface
	 */
	private $source;
	
	/**
	 * Head table
	 *
	 * @var Table
	 */
	private $head;
	
	/**
	 * Body table
	 *
	 * @var Table
	 */
	private $body;
	
	/**
	 * Foot table
	 *
	 * @var Table
	 */
	private $foot;
	
	/**
	 * Columns
	 *
	 * @var Column[]
	 */
	private $columns;
	
	/**
	 * Is grid initialized ?
	 *
	 * @var bool
	 */
	private $initialized = false;
	
	/**
	 * Constructor
	 * 
	 * @param SourceInterface $source
	 */
	public function __construct(SourceInterface $source = null)
	{
		$this->source = $source;
		
		$this->head = new Table();
		$this->body = new Table();
		$this->foot = new Table();
		
		$this->columns = new \SplDoublyLinkedList();
	}
	
	/**
	 * Has head table ?
	 * 
	 * @return bool
	 */
	public function hasHead()
	{
		$this->initialize();
		
		return ! $this->head->isEmpty();
	}
	
	/**
	 * Get head table
	 * 
	 * @return Table
	 */
	public function getHead()
	{
		$this->initialize();
		
		return $this->head;
	}
	
	/**
	 * Has body table ?
	 * 
	 * @return bool
	 */
	public function hasBody()
	{
		$this->initialize();
		
		return ! $this->body->isEmpty();
	}
	
	/**
	 * Get body table
	 * 
	 * @return Table
	 */
	public function getBody()
	{
		$this->initialize();
		
		return $this->body;
	}
	
	/**
	 * Has foot table ?
	 * 
	 * @return bool
	 */
	public function hasFoot()
	{
		$this->initialize();
		
		return ! $this->foot->isEmpty();
	}
	
	/**
	 * Get foot table
	 * 
	 * @return Table
	 */
	public function getFoot()
	{
		$this->initialize();
		
		return $this->foot;
	}
	
	/**
	 * Get columns
	 * 
	 * @return Column[]
	 */
	public function getColumns()
	{
		$this->initialize();
		
		return $this->columns;
	}
	
	/**
	 * Initialize grid
	 */
	protected function initialize()
	{
		if ($this->initialized === true) {
			return;
		}
		
		foreach ($this->source->getSchema() as $column) {
			$this->columns->push($column);
		}
		
		foreach ($this->source->getData() as $row) {
			$this->body->appendRow($row);
		}
		
		$this->initialized = true;
	}
}

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
	 * Is head initialized ?
	 *
	 * @var bool
	 */
	private $initializedHead = false;
	
	/**
	 * Is body initialized ?
	 *
	 * @var bool
	 */
	private $initializedBody = false;
	
	/**
	 * Is foot initialized ?
	 *
	 * @var bool
	 */
	private $initializedFoot = false;
	
	/**
	 * Is columns initialized ?
	 *
	 * @var bool
	 */
	private $initializedColumns = false;
	
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
		$this->initializeHead();
		
		return ! $this->head->isEmpty();
	}
	
	/**
	 * Get head table
	 * 
	 * @return Table
	 */
	public function getHead()
	{
		$this->initializeHead();
		
		return $this->head;
	}
	
	/**
	 * Has body table ?
	 * 
	 * @return bool
	 */
	public function hasBody()
	{
		$this->initializeBody();
		
		return ! $this->body->isEmpty();
	}
	
	/**
	 * Get body table
	 * 
	 * @return Table
	 */
	public function getBody()
	{
		$this->initializeBody();
		
		return $this->body;
	}
	
	/**
	 * Has foot table ?
	 * 
	 * @return bool
	 */
	public function hasFoot()
	{
		$this->initializeFoot();
		
		return ! $this->foot->isEmpty();
	}
	
	/**
	 * Get foot table
	 * 
	 * @return Table
	 */
	public function getFoot()
	{
		$this->initializeFoot();
		
		return $this->foot;
	}
	
	/**
	 * Get columns
	 * 
	 * @return Column[]
	 */
	public function getColumns()
	{
		$this->initializeColumns();
		
		return $this->columns;
	}
	
	/**
	 * Initialize head
	 */
	protected function initializeHead()
	{
		if ($this->initializedHead === true) {
			return;
		}
		
		$row = new Row();
		
		foreach ($this->source->getSchema() as $column) {
			$cell = new Cell($column->getTitle());
			
			$row->appendCell($cell);
		}
		
		$this->head->appendRow($row);
		
		$this->initializedHead = true;
	}
	
	/**
	 * Initialize body
	 */
	protected function initializeBody()
	{
		if ($this->initializedBody === true) {
			return;
		}
		
		foreach ($this->source->getData() as $row) {
			$this->body->appendRow($row);
		}
		
		$this->initializedBody = true;
	}
	
	/**
	 * Initialize foot
	 */
	protected function initializeFoot()
	{
		if ($this->initializedFoot === true) {
			return;
		}
		
		$this->initializedFoot = true;
	}
	
	/**
	 * Initialize columns
	 */
	protected function initializeColumns()
	{
		if ($this->initializedColumns === true) {
			return;
		}
		
		foreach ($this->source->getSchema() as $column) {
			$this->columns->push($column);
		}
		
		$this->initializedColumns = true;
	}
}

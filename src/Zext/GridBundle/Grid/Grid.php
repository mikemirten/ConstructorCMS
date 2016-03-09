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
	 * Rows
	 *
	 * @var Row[]
	 */
	private $rows;
	
	/**
	 * Columns
	 *
	 * @var Column[]
	 */
	private $columns;
	
	/**
	 * Constructor
	 * 
	 * @param SourceInterface $source
	 */
	public function __construct(SourceInterface $source = null)
	{
		$this->source = $source;
	}
	
	/**
	 * Get rows
	 * 
	 * @return Rows[]
	 */
	public function getRows()
	{
		if ($this->rows === null) {
			$this->rows = $this->source->getData();
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
			$this->columns = $this->source->getSchema();
		}
		
		return $this->columns;
	}
	
	/**
	 * Set order by
	 * 
	 * @param  string $orderSrc
	 * @throws \LogicException
	 */
	public function orderBy($orderSrc)
	{	
		foreach (explode(',', $orderSrc) as $orderDef) {
			list ($column, $order) = explode(':', $orderDef);
			
			$column = trim($column);
			$order  = trim(strtolower($order));
			
			$columns = $this->getColumns();
			
			if (! isset($columns[$column])) {
				throw new \LogicException(sprintf('Column "%s" not found', $column));
			}
			
			if (! $columns[$column]->isOrderable()) {
				throw new \LogicException(sprintf('Column "%s" is not sortable', $column));
			}
			
			$columns[$column]->setOrder($order);
		}
	}
}

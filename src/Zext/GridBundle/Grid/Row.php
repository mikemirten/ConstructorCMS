<?php

namespace Zext\GridBundle\Grid;

/**
 * Row of table
 */
class Row implements \IteratorAggregate
{
	/**
	 * Cells of row
	 *
	 * @var \SplDoublyLinkedList 
	 */
	private $cells;
	
	/**
	 * Constructor
	 * 
	 * @param array | \Traversable $cells
	 */
	public function __construct($cells = null)
	{
		$this->cells = new \SplDoublyLinkedList();
		
		if ($cells !== null) {
			foreach ($cells as $cell) {
				$this->appendCell($cell);
			}
		}
	}
	
	/**
	 * Append cell
	 * 
	 * @param Cell $cell
	 */
	public function appendCell(Cell $cell)
	{
		$this->cells->push($cell);
	}
	
	/**
	 * Prepend cell
	 * 
	 * @param Cell $cell
	 */
	public function prependCell(Cell $cell)
	{
		$this->cells->unshift($cell);
	}
	
	/**
     * {@inheritdoc}
     */
	public function getIterator()
	{
		return $this->cells;
	}
}

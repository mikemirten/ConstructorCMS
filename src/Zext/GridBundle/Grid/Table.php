<?php

namespace Zext\GridBundle\Grid;

/**
 * Grid's table
 * Represents each part of HTML table: head, body, foot
 */
class Table implements \IteratorAggregate
{
	/**
	 * Rows
	 *
	 * @var \SplDoublyLinkedList
	 */
	private $rows;
	
	/**
	 * Constructor
	 */
	public function __construct($rows = null)
	{
		$this->rows = new \SplDoublyLinkedList();
		
		if ($rows !== null) {
			foreach ($rows as $row) {
				$this->appendRow($row);
			}
		}
	}
	
	/**
	 * Append row
	 * 
	 * @param Row $row
	 */
	public function appendRow(Row $row)
	{
		$this->rows->push($row);
	}
	
	/**
	 * Prepend row
	 * 
	 * @param Row $row
	 */
	public function prependRow(Row $row)
	{
		$this->rows->unshift($row);
	}
	
	/**
	 * The table is empty ?
	 * 
	 * @return bool
	 */
	public function isEmpty()
	{
		return $this->rows->isEmpty();
	}
	
	/**
     * {@inheritdoc}
     */
	public function getIterator()
	{
		return $this->rows;
	}
}

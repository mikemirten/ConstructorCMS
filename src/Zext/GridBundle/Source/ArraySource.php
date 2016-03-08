<?php

namespace Zext\GridBundle\Source;

use Zext\GridBundle\Grid\Row;
use Zext\GridBundle\Grid\Cell;
use Zext\GridBundle\Grid\Column;

class ArraySource implements SourceInterface
{
	/**
	 * Source
	 *
	 * @var array
	 */
	private $source;
	
	/**
	 * Constructor
	 * 
	 * @param array $source
	 */
	public function __construct(array $source)
	{
		$this->source = $source;
	}

	/**
     * {@inheritdoc}
     */
	public function getData()
	{
		return array_map(
			function($rowData) {
				return new Row(array_map(
					function($cellData) {
						return new Cell($cellData);
					}, $rowData));
			}, $this->source);
	}

	/**
     * {@inheritdoc}
     */
	public function getSchema()
	{
		$colsNumber = 0;
		
		foreach ($this->source as $row) {
			$count = count($row);
			
			if ($count > $colsNumber) {
				$colsNumber = $count;
			}
		}
		
		$columns = [];
		$colSize = (int) round(100 / $colsNumber);
		
		for ($i = 0; $i < $colsNumber; ++ $i) {
			$column = new Column();
			$column->setWidth($colSize);
			
			$columns[] = $column;
		}
		
		return $columns;
	}

}

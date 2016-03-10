<?php

namespace Zext\GridBundle\Grid;

use Zext\GridBundle\Schema\Field;
use Zext\GridBundle\Request\RequestInterface;

class Column
{
	/**
	 * Field
	 *
	 * @var Field 
	 */
	protected $field;
	
	/**
	 * Request
	 *
	 * @var RequestInterface 
	 */
	protected $request;
	
	/**
	 * Constructor
	 * 
	 * @param Field            $field
	 * @param RequestInterface $request
	 */
	public function __construct(Field $field, RequestInterface $request)
	{
		$this->field   = $field;
		$this->request = $request;
	}
	
	/**
	 * Get name
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->field->getName();
	}
	
	/**
	 * Get title
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return $this->field->getTitle();
	}
	
	/**
	 * Get width
	 * 
	 * @return int
	 */
	public function getWidth()
	{
		return $this->field->getWidth();
	}
	
	/**
	 * Is orderable ?
	 * 
	 * @return bool
	 */
	public function isOrderable()
	{
		return $this->field->isOrderable();
	}
	
	/**
	 * Is serchable ?
	 * 
	 * @return bool
	 */
	public function isSearchable()
	{
		return $this->field->isSearchable();
	}
	
	/**
	 * Get order
	 * 
	 * @return string | null
	 */
	public function getOrder()
	{
		return $this->request->getOrderFor($this->getName());
	}
	
	/**
	 * Get search
	 * 
	 * @return string | null
	 */
	public function getSearch()
	{
		return $this->request->getSearchFor($this->getName());
	}
}

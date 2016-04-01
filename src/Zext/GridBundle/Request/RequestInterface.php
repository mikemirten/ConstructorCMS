<?php

namespace Zext\GridBundle\Request;

interface RequestInterface
{
	const DEFAULT_LIMIT  = 1000;
	const DEFAULT_OFFSET = 0;
	
	const ORDER_ASC  = 'asc';
	const ORDER_DESC = 'desc';
	
	/**
	 * Get limit
	 * 
	 * @return int
	 */
	public function getLimit();
	
	/**
	 * Get offset
	 * 
	 * @return int
	 */
	public function getOffset();
	
	/**
	 * Get order
	 * 
	 * [
	 *     property1 => direction1,
	 *     property2 => direction2
	 * ]
	 * 
	 * @return array
	 */
	public function getOrder();
	
	/**
	 * Get order direction for property
	 * 
	 * @param  string $name
	 * @return string | null
	 */
	public function getOrderFor($name);
	
	/**
	 * Get search
	 * 
	 * [
	 *     property1 => search1,
	 *     property2 => search2
	 * ]
	 * 
	 * @return array
	 */
	public function getSearch();
	
	/**
	 * Get search string for property
	 * 
	 * @param string $name
	 * @param string | null
	 */
	public function getSearchFor($name);
	
	/**
	 * Get global search
	 * 
	 * @return string
	 */
	public function getGlobalSearch();
}

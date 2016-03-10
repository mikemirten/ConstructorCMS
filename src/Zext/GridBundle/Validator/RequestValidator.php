<?php

namespace Zext\GridBundle\Validator;

use Zext\GridBundle\Schema\Schema;
use Zext\GridBundle\Request\RequestInterface;

class RequestValidator
{
	/**
	 * Schema provider
	 *
	 * @var Schema
	 */
	public $schema;
	
	/**
	 * Constructor
	 * 
	 * @param Schema $schema
	 */
	public function __construct(Schema $schema)
	{
		$this->schema = $schema;
	}
	
	/**
	 * Validate request
	 * 
	 * @param RequestInterface $request
	 */
	public function validate(RequestInterface $request)
	{
		$errors = [];
		
		$this->validateOrder($request, $errors);
		$this->validateSearch($request, $errors);
		
		return $errors;
	}
	
	/**
	 * Validate order
	 * 
	 * @param RequestInterface $request
	 * @param array            $errors
	 */
	protected function validateOrder(RequestInterface $request, array &$errors)
	{
		foreach ($request->getOrder() as $field => $value) {
			if (! $this->schema->hasField($field)) {
				$errors[] = sprintf('Order cannot be applied to non-existent field "%s"', $field);
				continue;
			}
			
			if (! $this->schema->getField($field)->isOrderable()) {
				$errors[] = sprintf('Field "%s" is not orderable', $field);
			}
			
			if ($value !== RequestInterface::ORDER_ASC && $value !== RequestInterface::ORDER_DESC) {
				$errors[] = sprintf('Invalid order direction "%s" specified for the field "%s"', $value, $field);
			}
		}
	}
	
	/**
	 * Validate search
	 * 
	 * @param RequestInterface $request
	 * @param array            $errors
	 */
	protected function validateSearch(RequestInterface $request, array &$errors)
	{
		foreach ($request->getSearch() as $field => $value) {
			if (! $this->schema->hasField($field)) {
				$errors[] = sprintf('Search cannot be applied to non-existent field "%s"', $field);
				continue;
			}
			
			if (! $this->schema->getField($field)->isSearchable()) {
				$errors[] = sprintf('Field "%s" is not searchable', $field);
			}
			
			if (empty($value)) {
				$errors[] = sprintf('Search string of field "%s" is empty', $value, $field);
			}
		}
	}
}

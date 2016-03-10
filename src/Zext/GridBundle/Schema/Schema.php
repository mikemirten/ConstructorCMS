<?php

namespace Zext\GridBundle\Schema;

class Schema
{
	/**
	 * Fields
	 *
	 * @var Field[]
	 */
	private $fields;
	
	/**
	 * Add field
	 * 
	 * @param  Field $field
	 * @throws \LogicException
	 */
	public function addField(Field $field)
	{
		$name = $field->getName();
		
		if (isset($this->fields[$name])) {
			throw new \LogicException(sprintf('Field "%s" already exists', $name));
		}
		
		$this->fields[$name] = $field;
	}
	
	/**
	 * Has field
	 * 
	 * @return bool
	 */
	public function hasField($name)
	{
		return isset($this->fields[$name]);
	}
	
	/**
	 * Get field
	 * 
	 * @return Field
	 * @throws \LogicException
	 */
	public function getField($name)
	{
		if (! isset($this->fields[$name])) {
			throw new \LogicException(sprintf('Field "%s" does not exists', $name));
		}
		
		return $this->fields[$name];
	}
	
	/**
	 * Get fields
	 * 
	 * @return Field[]
	 */
	public function getFields() {
		return $this->fields;
	}
	
	/**
	 * Has at least one orderable field
	 * 
	 * @return bool
	 */
	public function hasOrderable()
	{
		foreach ($this->fields as $field) {
			if ($field->isOrderable()) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Has at least one searchable field
	 * 
	 * @return bool
	 */
	public function hasSearchable()
	{
		foreach ($this->fields as $field) {
			if ($field->isSearchable()) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Is the schema empty ?
	 * 
	 * @return bool
	 */
	public function isEmpty()
	{
		return ! empty($this->fields);
	}
}

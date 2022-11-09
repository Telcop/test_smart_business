<?php

namespace AutoCatalog\Models;

class ParserXml
{
	private $fields = array(
		'id',
		'mark',
		'model',
		'generation',
		'year',
		'run',
		'color',
		'body-type',
		'engine-type',
		'transmission',
		'gear-type',
		'generation_id'
	);

	private $type_field_null = array(
		'year',
		'run',
		'generation_id'
	);

	// ! Дефолтный путь к xml файлу
	// local
	private $filexml = __DIR__ . "/../../document/data.xml";

	/**
	 * @param String $filexml	Путь к xml файлу
	 */
	public function __construct($filexml = null)
	{
		if (isset($filexml)) $this->filexml = $filexml;
	}

	/**
	 * @return Array
	 */
	public function getXml()
	{
		$xml = new \SimpleXMLElement($this->filexml, null, true);
		$items = array();
		foreach ($xml->offers->offer as $offer) {
			unset($item);
			foreach ($this->fields as $field) {
				if (in_array($field, $this->type_field_null))
					$item[$field] = ($offer->$field == "") ? null : (int)$offer->$field;
				else
					$item[$field] = ($field == 'id') ? (int)$offer->$field : (string)$offer->$field;
			}
			$items[] = $item;
		}
		return $items;
	}
}

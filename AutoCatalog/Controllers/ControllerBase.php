<?php

namespace AutoCatalog\Controllers;

require __DIR__ . '/../Models/ParserXml.php';
require __DIR__ . '/../Models/UpdateBase.php';

use AutoCatalog\Models\ParserXml;
use AutoCatalog\Models\UpdateBase;

class ControllerBase
{
	/**
	 * @param	String	$filexml	Путь к xml файлу
	 */
	public function __construct($filexml = null)
	{
		$offers = new ParserXml($filexml);
		$this->items = $offers->getXml();
		unset($offer);
	}

	/**
	 * 
	 */
	public function processing()
	{
		$base = new UpdateBase;
		foreach ($this->items as $item) {
			if ($base->selectId($item['id']))
				$base->update($item);
			else
				$base->insert($item);
		}
		$base->delete();
		unset($base);
	}
}

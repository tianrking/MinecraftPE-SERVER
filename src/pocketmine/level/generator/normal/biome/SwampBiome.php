<?php

/*
 *
 *  _                       _           _ __  __ _             
 * (_)                     (_)         | |  \/  (_)            
 *  _ _ __ ___   __ _  __ _ _  ___ __ _| | \  / |_ _ __   ___  
 * | | '_ ` _ \ / _` |/ _` | |/ __/ _` | | |\/| | | '_ \ / _ \ 
 * | | | | | | | (_| | (_| | | (_| (_| | | |  | | | | | |  __/ 
 * |_|_| |_| |_|\__,_|\__, |_|\___\__,_|_|_|  |_|_|_| |_|\___| 
 *                     __/ |                                   
 *                    |___/                                                                     
 * 
 * This program is a third party build by ImagicalMine.
 * 
 * PocketMine is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author ImagicalMine Team
 * @link http://forums.imagicalcorp.ml/
 * 
 *
*/

namespace pocketmine\level\generator\normal\biome;

use pocketmine\level\generator\populator\Flower;

use pocketmine\block\Block;
use pocketmine\block\Flower as FlowerBlock;

class SwampBiome extends GrassyBiome{

	public function __construct(){
		parent::__construct();
		
		$flower = new Flower();
		$flower->setBaseAmount(8);
		$flower->addType([Block::RED_FLOWER, FlowerBlock::TYPE_BLUE_ORCHID]);
		
		$this->addPopulator($flower);

		$this->setElevation(62, 63);

		$this->temperature = 0.8;
		$this->rainfall = 0.9;
	}

	public function getName(){
		return "Swamp";
	}

	public function getColor(){
		return 0x6a7039;
	}
}
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

namespace pocketmine\item;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\nbt\tag\Compound;
use pocketmine\nbt\tag\Enum;
use pocketmine\nbt\tag\Double;
use pocketmine\nbt\tag\Float;
use pocketmine\entity\Boat as BoatEntity;

class Boat extends Item{
	public function __construct($meta = 0, $count = 1){
		parent::__construct(self::BOAT, $meta, $count, "Oak Boat");
		if($this->meta === 1){
			$this->name = "Spruce Boat";
		}elseif($this->meta === 2){
			$this->name = "Birch Boat";
		}elseif($this->meta === 3){
			$this->name = "Jungle Boat";
		}elseif($this->meta === 4){
			$this->name = "Acacia Boat";
		}elseif($this->meta === 5){
			$this->name = "Dark Oak Boat";
		}
	}
	
	public function getMaxStackSize(){
		return 1;
	}
	
	public function canBeActivated(){
		return true;
	}

	public function onActivate(Level $level, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz){
		$boatPos = $block->getSide($face);

		$boat = new BoatEntity($player->getLevel()->getChunk($boatPos->getX() >> 4, $boatPos->getZ() >> 4), new Compound("", [
			"Pos" => new Enum("Pos", [
				new Double("", $boatPos->getX()),
				new Double("", $boatPos->getY()),
				new Double("", $boatPos->getZ())
			]),
			"Motion" => new Enum("Motion", [
				new Double("", 0),
				new Double("", 0),
				new Double("", 0)
			]),
			"Rotation" => new Enum("Rotation", [
				new Float("", 0),
				new Float("", 0)
			]),
		]));
		$boat->spawnToAll();

		if($player->isSurvival()) {
			$item = $player->getInventory()->getItemInHand();
			$count = $item->getCount();
			if(--$count <= 0){
				$player->getInventory()->setItemInHand(Item::get(Item::AIR));
				return;
			}

			$item->setCount($count);
			$player->getInventory()->setItemInHand($item);
		}
		
		return true;
	}
}

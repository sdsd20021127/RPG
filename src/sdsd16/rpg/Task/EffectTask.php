<?php

namespace sdsd16\rpg\Task;

use pocketmine\scheduler\Task;
use sdsd16\rpg\Main;
use pocketmine\Server;
use pocketmine\data\bedrock\EffectIdMap;
use pocketmine\entity\effect\EffectInstance;

class EffectTask extends Task {

    public function __construct(Main $plugin) {
		$this->plugin = $plugin;
	}

	/*
	$e = (new EffectInstance(Effect::getEffect(5)));
	$e->setAmplifier(2);
	$e->setDuration(20 * 600);
	*/
	
	public function EffectTask(){
	foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
	if(!$this->plugin->rpg->get(strtolower($player->getName())) ){
	$speed = "0";
    $haste = "0";
	}else{

    $speed = $this->plugin->data[strtolower($player->getName())]['speed'];
    $haste = $this->plugin->data[strtolower($player->getName())]['haste'];

	if($this->plugin->data[strtolower($player->getName())]['haste_button'] == true){
	if($haste >= 50 && $haste <= 150){ // 50 ~ 150
    $effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 60, 0);
	$player->getEffects()->add($effect);
	}else
	if($haste > 150 && $haste <= 200){ // 151  ~ 200
    $effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 120, 0);
	$player->getEffects()->add($effect);
	}else
	if($haste > 200 && $haste <= 300){ // 201 ~ 300 
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 180, 0);
	$player->getEffects()->add($effect);
	}else
	if($haste > 300 && $haste <= 400){ // 301 ~ 400 
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 240, 0);
	$player->getEffects()->add($effect);
	}else
	if($haste > 400 && $haste <= 499){ // 401 ~ 499
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 300, 1);
	$player->getEffects()->add($effect);
	}else 
	if($haste == 500){
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(3), 20 * 600, 1);
	$player->getEffects()->add($effect);
}else{
    //其餘都沒有唷~
    }	
}

	if($this->plugin->data[strtolower($player->getName())]['speed_button'] == true){
	if($speed >= 50 && $speed <= 150){ // 50 ~ 150
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 60, 0);
	$player->getEffects()->add($effect);
	}else
	if($speed > 150 && $speed <= 200){ // 151  ~ 200
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 120, 0);
	$player->getEffects()->add($effect);
	}else
	if($speed > 200 && $speed <= 300){ // 201 ~ 300 
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 180, 0);
	$player->getEffects()->add($effect);
	}else
	if($speed > 300 && $speed <= 400){ // 301 ~ 400 
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 240, 0);
	$player->getEffects()->add($effect);
	}else
	if($speed > 400 && $speed <= 499){ // 401 ~ 499
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 300, 1);
	$player->getEffects()->add($effect);
	}else 
	if($speed == 500){
	$effect = new EffectInstance(EffectIdMap::getInstance()->fromId(1), 20 * 600, 1);
	$player->getEffects()->add($effect);
}else{
    //其餘都沒有唷~
    }	
}
    }
}

   }


	public function onRun(): void {	
    $this->EffectTask();	
}

}



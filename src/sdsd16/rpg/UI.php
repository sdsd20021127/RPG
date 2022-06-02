<?php

namespace sdsd16\rpg;

use jojoe77777\FormAPI\{CustomForm, SimpleForm};
use sdsd16\rpg\Main;
use pocketmine\player\Player;
use pocketmine\Server;

class UI{

    private $plugin;

    public function __construct(Main $plugin){
        $this->pl = $plugin;
		$this->m = Server::getInstance()->getPluginManager()->getPlugin("MoneySysteam");
    }

    public function getData(Player $p){
    foreach($this->pl->data->getAll() as $p){
    return $p;
    }    
}


    public function Set(Player $player){
    $form = new SimpleForm(function (Player $player, $data) {
    if ($data == null) {
    }        
    switch ($data) {
    /* 分配屬性點(血量/攻擊/敏捷/防禦/上進) */
    case "cancel"://關閉
    break;

    case "myinfo":
    $this->MyInfo($player);
    break;

    case "health"://血量
 	$form = new CustomForm(function (Player $player, $data){
    if($data != null && is_numeric($data[0])){
    if($this->pl->data[strtolower($player->getName())]['health'] + $data[0] > 500){ 
    $player->sendMessage("§l§c!! 已達配點上限 !!");
    return true;    
}
    if(floor($data[0]) <= 0){
    $player->sendMessage("§l§c!! 數值必須為正整數 !!");
    return true;    
}  
    if($this->pl->data[strtolower($player->getName())]['point'] >= $data[0]){
    $this->pl->data[strtolower($player->getName())]['health'] = $this->pl->data[strtolower($player->getName())]['health'] + $data[0];
    $this->pl->data[strtolower($player->getName())]['point'] = $this->pl->data[strtolower($player->getName())]['point'] - $data[0];
    $player->sendMessage("§l§e[屬性分配] > 成功分配§f{$data[0]}§e點屬性點到§c血量§e身上..");
}else{
    $player->sendMessage("§l§c> 屬性點不足..");
}
    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性 > 血量");
    $form->addInput("§f本次可分配的屬性點為: ".$this->pl->data[strtolower($player->getName())]['point']."");
	$form->sendToPlayer($player);
    break;

    case "damage":///攻擊
 	$form = new CustomForm(function (Player $player, $data){
    if($data != null && is_numeric($data[0])){
    if($this->pl->data[strtolower($player->getName())]['damage'] + $data[0] > 500){ 
    $player->sendMessage("§l§c!! 已達配點上限 !!");
    return true;    
}
    if(floor($data[0]) <= 0){
    $player->sendMessage("§l§c!! 數值必須為正整數 !!");
    return true;    
}  
    if($this->pl->data[strtolower($player->getName())]['point'] >= $data[0]){
    $this->pl->data[strtolower($player->getName())]['damage'] = $this->pl->data[strtolower($player->getName())]['damage'] + $data[0];
    $this->pl->data[strtolower($player->getName())]['point'] = $this->pl->data[strtolower($player->getName())]['point'] - $data[0];
    $player->sendMessage("§l§e[屬性分配] > 成功分配§f{$data[0]}§e點屬性點到§c攻擊§e身上..");
}else{
    $player->sendMessage("§l§c> 屬性點不足..");
}
    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性 > 攻擊");
    $form->addInput("§f本次可分配的屬性點為: ".$this->pl->data[strtolower($player->getName())]['point']."");
	$form->sendToPlayer($player);
    break;
    
    case "speed"://敏捷
 	$form = new CustomForm(function (Player $player, $data){
    if($data != null && is_numeric($data[0])){
    if($this->pl->data[strtolower($player->getName())]['speed'] + $data[0] > 500){ 
    $player->sendMessage("§l§c!! 已達配點上限 !!");
    return true;    
}
    if(floor($data[0]) <= 0){
    $player->sendMessage("§l§c!! 數值必須為正整數 !!");
    return true;    
}  
    if($this->pl->data[strtolower($player->getName())]['point'] >= $data[0]){
    $this->pl->data[strtolower($player->getName())]['speed'] = $this->pl->data[strtolower($player->getName())]['speed'] + $data[0];
    $this->pl->data[strtolower($player->getName())]['point'] = $this->pl->data[strtolower($player->getName())]['point'] - $data[0];
    $player->sendMessage("§l§e[屬性分配] > 成功分配§f{$data[0]}§e點屬性點到§c敏捷§e身上..");
}else{
    $player->sendMessage("§l§c> 屬性點不足..");
}
    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性 > 敏捷");
    $form->addInput("§f本次可分配的屬性點為: ".$this->pl->data[strtolower($player->getName())]['point']."");
	$form->sendToPlayer($player);
    break;
        
    case "defense"://防禦
 	$form = new CustomForm(function (Player $player, $data){
    if($data != null && is_numeric($data[0])){
    if($this->pl->data[strtolower($player->getName())]['defense'] + $data[0] > 500){ 
    $player->sendMessage("§l§c!! 已達配點上限 !!");
    return true;    
}
    if(floor($data[0]) <= 0){
    $player->sendMessage("§l§c!! 數值必須為正整數 !!");
    return true;    
}  
    if($this->pl->data[strtolower($player->getName())]['point'] >= $data[0]){
    $this->pl->data[strtolower($player->getName())]['defense'] = $this->pl->data[strtolower($player->getName())]['defense'] + $data[0];
    $this->pl->data[strtolower($player->getName())]['point'] = $this->pl->data[strtolower($player->getName())]['point'] - $data[0];
    $player->sendMessage("§l§e[屬性分配] > 成功分配§f{$data[0]}§e點屬性點到§c防禦§e身上..");
}else{
    $player->sendMessage("§l§c> 屬性點不足..");
}
    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性 > 防禦");
    $form->addInput("§f本次可分配的屬性點為: ".$this->pl->data[strtolower($player->getName())]['point']."");
	$form->sendToPlayer($player);
    break;
        
    case "haste"://上進
 	$form = new CustomForm(function (Player $player, $data){
    if($data != null && is_numeric($data[0])){
    if($this->pl->data[strtolower($player->getName())]['haste'] + $data[0] > 500){ 
    $player->sendMessage("§l§c!! 已達配點上限 !!");
    return true;    
}
    if(floor($data[0]) <= 0){
    $player->sendMessage("§l§c!! 數值必須為正整數 !!");
    return true;    
}  
    if($this->pl->data[strtolower($player->getName())]['point'] >= $data[0]){
    $this->pl->data[strtolower($player->getName())]['haste'] = $this->pl->data[strtolower($player->getName())]['haste'] + $data[0];
    $this->pl->data[strtolower($player->getName())]['point'] = $this->pl->data[strtolower($player->getName())]['point'] - $data[0];
    $player->sendMessage("§l§e[屬性分配] > 成功分配§f{$data[0]}§e點屬性點到§c上進§e身上..");
}else{
    $player->sendMessage("§l§c> 屬性點不足..");
}
    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性 > 上進");
    $form->addInput("§f本次可分配的屬性點為: ".$this->pl->data[strtolower($player->getName())]['point']."");
	$form->sendToPlayer($player);
    break;
    
    case "setting":
    $form = new SimpleForm(function (Player $player, $data) {
    if ($data == null) { 
    }

    switch($data){

    case "haste":
    if($this->pl->data[strtolower($player->getName())]['haste_button'] == true){
    $this->pl->data[strtolower($player->getName())]['haste_button'] = false;
    $player->sendMessage("§l§e> 已關閉上進效果\n§a> 現在起不會獲得Buff加成");
    }else{
    $this->pl->data[strtolower($player->getName())]['haste_button'] = true;
    $player->sendMessage("§l§e> 已開啟上進效果\n§a> 現在起會獲得Buff加成");
    }
    break;
    
    case "speed":
    if($this->pl->data[strtolower($player->getName())]['speed_button'] == true){
    $this->pl->data[strtolower($player->getName())]['speed_button'] = false;
    $player->sendMessage("§l§e> 已關閉敏捷效果\n§a> 現在起不會獲得Buff加成");
    }else{
    $this->pl->data[strtolower($player->getName())]['speed_button'] = true;
    $player->sendMessage("§l§e> 已開啟敏捷效果\n§a> 現在起會獲得Buff加成");
    }
    break;

    }
});
    $form->setTitle("§l§9屬性系統 > 系統開關");
    $form->setContent("§l§f請直接點選以下按鈕");
    $form->addButton("§l§c開關敏捷效果",0,'textures/ui/icon_setting',"speed");
    $form->addButton("§l§c開關上進效果",0,'textures/ui/icon_setting',"haste");
    $form->sendToPlayer($player);
    break;

    case "reset":
    $form = new SimpleForm(function (Player $player, $data) {
    if ($data == null) { 
    }

    switch($data){

    case "health":
    if( $this->pl->data[strtolower($player->getName())]["health"] === 0){
    $player->sendMessage("§l§c你從來沒分配過屬性點在這屬性上唷...");
    return true;
}
    if($this->m->getDMoney(strtolower($player->getName())) >= 500){
    $this->pl->data[strtolower($player->getName())]["point"] = $this->pl->data[strtolower($player->getName())]["point"] + $this->pl->data[strtolower($player->getName())]["health"];
    $this->pl->data[strtolower($player->getName())]["health"] = 0; 
    $this->m->addDMoney(strtolower($player->getName()) , -500);
    $player->sendMessage("§l§6重置屬性血量成功");
    }else{  
    $player->sendMessage("§l§c> 古幣需要$500才可重置");
    }
    break;
    
    case "damage":
    if( $this->pl->data[strtolower($player->getName())]["damage"] === 0){
    $player->sendMessage("§l§c你從來沒分配過屬性點在這屬性上唷...");
    return true;
}
    if($this->m->getDMoney(strtolower($player->getName())) >= 500){
    $this->pl->data[strtolower($player->getName())]["point"] = $this->pl->data[strtolower($player->getName())]["point"] + $this->pl->data[strtolower($player->getName())]["damage"];
    $this->pl->data[strtolower($player->getName())]["damage"] = 0; 
    $this->m->addDMoney(strtolower($player->getName()) , -500);
    $player->sendMessage("§l§6重置屬性攻擊成功");
    }else{  
    $player->sendMessage("§l§c> 古幣需要$500才可重置");
    }
    break;

    case "defense":
    if( $this->pl->data[strtolower($player->getName())]["defense"] === 0){
    $player->sendMessage("§l§c你從來沒分配過屬性點在這屬性上唷...");
    return true;
}
    if($this->m->getDMoney(strtolower($player->getName())) >= 500){
    $this->pl->data[strtolower($player->getName())]["point"] = $this->pl->data[strtolower($player->getName())]["point"] + $this->pl->data[strtolower($player->getName())]["defense"];
    $this->pl->data[strtolower($player->getName())]["defense"] = 0; 
    $this->m->addDMoney(strtolower($player->getName()) , -500);
    $player->sendMessage("§l§6重置屬性防禦成功");
    }else{  
    $player->sendMessage("§l§c> 古幣需要$500才可重置");
    }
    break;

    case "speed":
    if( $this->pl->data[strtolower($player->getName())]["speed"] === 0){
    $player->sendMessage("§l§c你從來沒分配過屬性點在這屬性上唷...");
    return true;
}
    if($this->m->getDMoney(strtolower($player->getName())) >= 500){
    $this->pl->data[strtolower($player->getName())]["point"] = $this->pl->data[strtolower($player->getName())]["point"] + $this->pl->data[strtolower($player->getName())]["speed"];
    $this->pl->data[strtolower($player->getName())]["speed"] = 0; 
    $this->m->addDMoney(strtolower($player->getName()) , -500);
    $player->sendMessage("§l§6重置屬性敏捷成功");
    }else{  
    $player->sendMessage("§l§c> 古幣需要$500才可重置");
}
    break;

    case "haste":
    if( $this->pl->data[strtolower($player->getName())]["haste"] === 0){
    $player->sendMessage("§l§c你從來沒分配過屬性點在這屬性上唷...");
    return true;
}
    if($this->m->getDMoney(strtolower($player->getName())) >= 500){
    $this->pl->data[strtolower($player->getName())]["point"] = $this->pl->data[strtolower($player->getName())]["point"] + $this->pl->data[strtolower($player->getName())]["haste"];
    $this->pl->data[strtolower($player->getName())]["haste"] = 0; 
    $this->m->addDMoney(strtolower($player->getName()) , -500);
    $player->sendMessage("§l§6重置上進血量成功");
    }else{  
    $player->sendMessage("§l§c> 古幣需要$500才可重置");
}
    break;

    }
});
    $form->setTitle("§l§9屬性系統 > 重置屬性");
    $form->setContent("§l§f重置屬性將會耗費§c古幣$"."500"."");
    $form->addButton("§l§c重置血量",0,'textures/ui/icon_setting',"health");
    $form->addButton("§l§c重置攻擊",0,'textures/ui/icon_setting',"damage");
    $form->addButton("§l§3重置防禦",0,'textures/ui/icon_setting',"defense");
    $form->addButton("§l§b重置敏捷",0,'textures/ui/icon_setting',"speed");
    $form->addButton("§l§g重置上進",0,'textures/ui/icon_setting',"haste");
    $form->sendToPlayer($player);
    break;

    }
});
    $form->setTitle("§l§9屬性系統 > 分配屬性");
    $form->setContent("§l§f§c- 玩家可以選擇是否啟用§b敏捷§c丶§g上進§cBuff效果\n§f- 所有屬性的上限點數都為500點(Lv.Max)\n§a- 血量: 提升血量上限\n§f- 攻擊: 攻擊時可以給對方額外傷害\n§a- 防禦: 遭受攻擊的時候可以減少一定格數傷害\n§f- 敏捷: 增加移動時速度\n§a- 上進: 增加挖掘時速度");
    $form->addButton("§l§e個人信息",0,'textures/ui/icon_best3',"myinfo");
    $form->addButton("§l§4進階選項",0,'textures/ui/icon_setting',"reset");
    $form->addButton("§l§4系統開關",0,'textures/ui/icon_setting',"setting");
    $form->addButton("§l§5血量",0,'textures/ui/heart_flash',"health");
    $form->addButton("§l§c攻擊",0,'textures/ui/anvil_icon',"damage");
    $form->addButton("§l§3防禦",0,'textures/ui/armor_full',"defense");
    $form->addButton("§l§b敏捷",0,'textures/ui/water_breathing_effect',"speed");
    $form->addButton("§l§g上進",0,'textures/ui/icon_summer',"haste");
    $form->addButton("§l§f關閉",0,'textures/ui/cancel',"cancel");
	$form->sendToPlayer($player);
}

    public function MyInfo(Player $player){ 
    $form = new SimpleForm(function (Player $player, $data) {
    if ($data == null) { 
    }
    switch ($data) {
   
    case 0:
    break;  
    }
}); 
    $form->setTitle("§l§9屬性系統 > 個人狀態");
    $n = strtolower($player->getName());
    $form->setContent("§l§c* 玩家{$player->getName()}屬性狀態如下:"."\n§d* 攻擊: §f".$this->pl->data[$n]['damage']."\n§d* 防禦: §f".$this->pl->data[$n]['defense']."\n§d* 血量: §f".$this->pl->data[$n]['health']."\n§d* 敏捷: §f".$this->pl->data[$n]['speed']."\n§d* 上進: §f".$this->pl->data[$n]['haste']."\n§d* 屬性點: §f".$this->pl->data[$n]['point']."");
    $form->addButton("§l關閉");  
    $form->sendToPlayer($player);
    //}
}

    public function getName($p){
    return strtolower($p->getName());
}


}
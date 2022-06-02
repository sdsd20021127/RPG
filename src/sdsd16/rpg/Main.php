<?php

namespace sdsd16\rpg;

use pocketmine\command\{Command, CommandSender};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\event\player\{PlayerRespawnEvent, PlayerLoginEvent, PlayerJoinEvent};
use pocketmine\player\Player;
use pocketmine\item\Item;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};
use jojoe77777\FormAPI\{CustomForm, SimpleForm, FormAPI, ModalForm, Form};
use sdsd16\rpg\UI;
use sdsd16\rpg\Task\EffectTask;

use MobNpc\entity\MobBase;

class Main extends PluginBase implements Listener{

    public function onEnable() : void{
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("RPG_v1.0.0 Enabled");
    //$this->data = new Config($this->getDataFolder()."playerdata.yml",Config::YAML,array())->getAll();
    $this->data = (new Config($this->getDataFolder() . "playerdata.yml", Config::YAML, []))->getAll();
    //->getAll();
    $this->rpg = new Config($this->getDataFolder()."record.yml",Config::YAML,array());
    $this->ui = new UI($this);
    //Task
	$this->getScheduler()->scheduleRepeatingTask(new EffectTask($this), 20 * 600);//伺服器每10分運行一次
}

    public function create(Player $player){
    $name = strtolower($player->getName());
    $this->data[$name] = [
    "speed_button" => true,
    "haste_button" => true,
    "speed" => 0, //敏捷
    "damage" => 0, //攻擊
    "defense" => 0, //防禦  
    "health" => 0, //血量
	"haste" => 0, //上進
    "point" => 0 //屬性點
    ];
    return true;
}

    public function join(PlayerJoinEvent $event){   
    $name = strtolower($event->getPlayer()->getName());
    if(!$this->rpg->get($name)){
    $this->rpg->set($name , true);
    $this->rpg->save();
    }
}

    public function setHealth(Player $player){
    if(isset($this->data[strtolower($player->getName())]['health']) == false) {
    $this->create($player);
    }else{
    $health = $this->data[strtolower($player->getName())]['health'];
    if($health >= 50 && $health <= 100){ // 50 ~ 100
    $set = "40";
    }else if($health > 100 && $health <= 200) {//101 ~ 200
    $set = "50";
    }else if($health > 200 && $health <= 300) {//201 ~ 300
    $set = "60";
    }else if($health > 300 && $health <= 400) {//301 ~ 400
    $set = "65";
    }else if($health > 400 && $health <= 499) {//401 ~ 499
    $set = "70";
    }else if($health == 500) {//500
    $set = "80";
    }else{
    $set = "25";
}    
    $player->setHealth($set);
    $player->setMaxHealth($set);
}
    } 

    public function ReSpawn(PlayerReSpawnEvent $event){
    $this->setHealth($event->getPlayer());
}

    public function Login(PlayerLoginEvent $event){
    $this->setHealth($event->getPlayer());
}   

    public function PlayerDamage(EntityDamageByEntityEvent $event){
    $damagePlayer = $event->getDamager();
    $entity = $event->getEntity();

    if($entity instanceof Player && $damagePlayer instanceof MobBase){
    $base = $event->getBaseDamage();
    if(isset($this->data[strtolower($damagePlayer->getName())]['defense']) == false) {
    //$this->create($entity);
    }else{    
    $defense = $this->data[strtolower($entity->getName())]['defense'];
    if($defense >= 50 && $defense <= 200){ // 50 ~ 200   
    $damage -= intval((int)$base * 0.95); 
    $event->setBaseDamage($damage);
    }else
    if($defense > 200 && $defense <= 400){ // 201 ~ 400   
    $damage -= intval((int)$base * 0.85); 
    $event->setBaseDamage($damage);
    }else
    if($defense > 400 && $defense <= 499){ // 401 ~ 499   
    $damage -= intval((int)$base * 0.75); 
    $event->setBaseDamage($damage);
    }else
    if($defense == 500){ // 500   
    $damage -= intval((int)$base * 0.7); 
    $event->setBaseDamage($damage);
    }
    return true;
}
    }

    if($damagePlayer instanceof Player && $entity instanceof MobBase){
    if(mt_rand(1,400) < 10){
    if(isset($this->data[strtolower($damagePlayer->getName())]['damage']) == false) {
    //this->create($damagePlayer);
    }else{
    $damage = $this->data[strtolower($damagePlayer->getName())]['damage'];    
    if($damage >= 50 && $damage <= 100){ // 50 ~ 100   
    $entity->setHealth($entity->getHealth() - 3);
    $damagePlayer->sendTip("§l§c!! 額外增加3滴傷害 !!");
    }else
    if($damage > 100 && $damage <= 200){ // 101 ~ 200   
    $entity->setHealth($entity->getHealth() - 5);
    $damagePlayer->sendTip("§l§c!! 額外增加5滴傷害 !!");
    }else
    if($damage > 200 && $damage <= 300){ // 201 ~ 300
    $entity->setHealth($entity->getHealth() - 10);
    $damagePlayer->sendTip("§l§c!! 額外增加10滴傷害 !!");
    }else
    if($damage > 300 && $damage <= 400){ // 301 ~ 400
    $entity->setHealth($entity->getHealth() - 13);
    $damagePlayer->sendTip("§l§c!! 額外增加13滴傷害 !!");
    }else
    if($damage > 400 && $damage <= 499){ // 401 ~ 499   
    $entity->setHealth($entity->getHealth() - 15);
    $damagePlayer->sendTip("§l§c!! 額外增加15滴傷害 !!");
    }else
    if($damage == 500){
    $entity->setHealth($entity->getHealth() - 20);
    $damagePlayer->sendTip("§l§c!! 額外增加20滴傷害 !!");
}
    return true;
}  
  }
     }   
}

    public function save() {
    $c = new Config($this->getDataFolder() . "playerdata.yml", Config::YAML, []);
    $c->setAll($this->data);
    $c->save();
}

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool    {
        switch ($cmd->getName()) {
        case "rpg":
        if(empty($args[0])){
        $sender->sendMessage("§f/rpg");
        break;   
    } 
        switch($args[0]){
  
        case "set":
		$this->ui->Set($sender);
	    break;
		  
        case "see":
	    if(!$sender->hasPermission(\pocketmine\permission\DefaultPermissions::ROOT_OPERATOR)) return true;
        if(!isset($args[1])){
        $sender->sendMessage("§l§c> /rpg see <ID>");
        }
        if(isset($args[1])){
        $p = Server::getInstance()->getPlayerByPrefix($args[1]);
        if($p instanceof Player){
        $sender->sendMessage("§l§e>>>[玩家{$p->getName()}屬性信息]<<<\n§f- 血量: ".$this->data[strtolower($p->getName())]['health']."\n§f- 攻擊: ".$this->data[strtolower($p->getName())]['damage']."\n- 防禦: ".$this->data[strtolower($p->getName())]['defense']."\n- 敏捷: ".$this->data[strtolower($p->getName())]['speed']."\n- 上進: ".$this->data[strtolower($p->getName())]['haste']."\n- 屬性點: ".$this->data[strtolower($p->getName())]['point']."");
        }else{
        $sender->sendMessage("§l§c找不到該玩家");        
        }
    }
        break;

        case "add":
	    if(!$sender->hasPermission(\pocketmine\permission\DefaultPermissions::ROOT_OPERATOR)) return true;
        if(!isset($args[1]) OR !isset($args[2])){
        $sender->sendMessage("§l§c> /rpg add <ID> <Number> - 扣除屬性點");
        return true;
        }
        $this->data[strtolower($args[1])]['point'] = $this->data[strtolower($args[1])]['point'] + $args[2];
        $sender->sendMessage("§l§e本次增加共{$args[2]}點");        
        break;

        case "remove":
	    if(!$sender->hasPermission(\pocketmine\permission\DefaultPermissions::ROOT_OPERATOR)) return true;
        if(!isset($args[1]) OR !isset($args[2])){
        $sender->sendMessage("§l§c> /rpg remove <ID> <Number> - 扣除屬性點");
        return true;
        }
        if( $this->data[strtolower($sender->getName())]['point'] - $args[2] < 0){
        $sender->sendMessage("§l§c本次扣除結果會為負數..");        
        return true;
        }
        $this->data[strtolower($args[1])]['point'] = $this->data[strtolower($args[1])]['point'] - $args[2];
        $sender->sendMessage("§l§e本次扣除共{$args[2]}點");        
        break;

        case "info":
        $this->ui->MyInfo($sender);
        break;
    }

        return true;
    }
    return true;
}
    public function onDisable() :void{
    $this->save();
    }
}

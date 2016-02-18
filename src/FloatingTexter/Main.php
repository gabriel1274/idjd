<?php

namespace FloatingTexter;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::GREEN. "Plugin Enabled");

		if(!is_dir($this->getDataFolder())){
			@mkdir($this->getDataFolder());
		}
		
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->saveDefaultConfig();
		}

		$this->cfg = $this->getConfig();
	}
	
	public function onDisable(){
		$this->saveDefaultConfig();
		$this->getLogger()->info(TextFormat::RED. "Plugin Disabled");
	}
 
	public function onPlayerJoin(PlayerJoinEvent $event){
		foreach($this->cfg->get("floats") as $floats){
			$level = $event->getPlayer()->getLevel();
			$vect = new Vector3($floats["x"], $floats["y"], $floats["z"]);
			$finaltext = "";
			foreach($floats["text"] as $text){
				$finaltext .= $text . "\n";
			}
			
			if($level->getName() == $floats["level"]){
				$level->addParticle(new FloatingTextParticle($vect->add(0.5, 0.0, -0.5), "", $finaltext));
			}
		}
	}
}

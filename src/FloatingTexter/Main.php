<?php

namespace FloatingTexter;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener{
	
public $cfg;
/*	
public function translateColors($symbol, $color){
	$color = str_replace($symbol."0", TextFormat::BLACK, $color);
	$color = str_replace($symbol."1", TextFormat::DARK_BLUE, $color);
	$color = str_replace($symbol."2", TextFormat::DARK_GREEN, $color);
	$color = str_replace($symbol."3", TextFormat::DARK_AQUA, $color);
	$color = str_replace($symbol."4", TextFormat::DARK_RED, $color);
	$color = str_replace($symbol."5", TextFormat::DARK_PURPLE, $color);
	$color = str_replace($symbol."6", TextFormat::GOLD, $color);
	$color = str_replace($symbol."7", TextFormat::GRAY, $color);
	$color = str_replace($symbol."8", TextFormat::DARK_GRAY, $color);
	$color = str_replace($symbol."9", TextFormat::BLUE, $color);
	$color = str_replace($symbol."a", TextFormat::GREEN, $color);
	$color = str_replace($symbol."b", TextFormat::AQUA, $color);
	$color = str_replace($symbol."c", TextFormat::RED, $color);
	$color = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $color);
	$color = str_replace($symbol."e", TextFormat::YELLOW, $color);
	$color = str_replace($symbol."f", TextFormat::WHITE, $color);
	$color = str_replace($symbol."k", TextFormat::OBFUSCATED, $color);
	$color = str_replace($symbol."l", TextFormat::BOLD, $color);
	$color = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $color);
	$color = str_replace($symbol."n", TextFormat::UNDERLINE, $color);
	$color = str_replace($symbol."o", TextFormat::ITALIC, $color);
	$color = str_replace($symbol."r", TextFormat::RESET, $color);
	return $color;
}
*/
	public function onLoad(){
		$this->getLogger()->info(TextFormat::GREEN. "Plugin Attivato");
	}
	
	public function saveFiles(){
		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder());
		}
	}
	
	public function onDisable(){
		unset($this->players);
		$this->saveDefaultConfig();
		$this->getLogger()->info(TextFormat::RED. "Plugin Disattivato");
	}
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->cfg = $this->getConfig();
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

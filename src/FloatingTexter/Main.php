<?php
namespace FloatingTexter;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\Server;
use pocketmine\plugin\PluginManager;
use pocketmine\plugin\Plugin;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\level;
use pocketmine\level\Position;
use pocketmine\level\Position\getLevel;
use pocketmine\level\particle\Particle;
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
		$this->getLogger()->info(TextFormat::GREEN. "Plugin Attivato");  //getLogger() mostra il messaggio dopo info nella console di PM
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
			@mkdir($this->getDataFolder()); //crea la cartella dove sara il config.yml
				$this->saveDefaultConfig(); //salva la configurazione di default del config.yml
					$this->cfg = $this->getConfig(); //prende le informazioni dal config.yml
	}
	//to improve code formatting a simple improve the code	  
	public function onPlayerJoin(PlayerJoinEvent $event){
		$point1 = $this->cfg->getAll()["point1"];
		$point2 = $this->cfg->getAll()["point2"]
		$text = $this->cfg->get($point1["text"]);
		$text1 = $this->cfg->get($point1["text1"]);    
		$text2 = $this->cfg->get($point1["text2"]);		
		$text3 = $this->cfg->get($point1["text3"]);
		$text4 = $this->cfg->get($point1["text4"]);   
		$text5 = $this->cfg->get($point2["text5"]);		
		$text6 = $this->cfg->get($point2["text6"]);
		$text7 = $this->cfg->get($point2["text7"]);    
		$text8 = $this->cfg->get($point2["text8"]); 
		$text9 = $this->cfg->get($point2["text9"]); 
                $coords = $this->cfg->getAll()["coords"];
		$sender = $event->getPlayer();
		$level = $sender->getLevel(); //-169,12,486
		$vect2 = new Vector3($coords2["x"], $coords2["y"], $coords2["z"]);
		$vect = new Vector3($coords["x"], $coords["y"], $coords["z"]); //$coords["x"], $coords["y"], $coords["z"]
		$this->cfg->save();   
		//soon level chooser
		$level->addParticle(new FloatingTextParticle($vect->add(0.5, 0.0, -0.5),"", $text . "\n" . $text1 . "\n" . $text2. "\n" . $text3. "\n" . $text4)); 
		$level->addParticle(new FloatingTextParticle($vect2->add(0.5, 0.0, -0.5),"", $text5 . "\n" . $text6 . "\n" . $text7. "\n" . $text8. "\n" . $text9)); 
		}
	}
?>

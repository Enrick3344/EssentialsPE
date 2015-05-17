<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseFiles\BaseCommand;
use EssentialsPE\Loader;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Back extends BaseCommand{
    public function __construct(Loader $plugin){
        parent::__construct($plugin, "back", "Teleport to your previous location", "/back", false, ["return"]);
        $this->setPermission("essentials.back");
    }

    public function execute(CommandSender $sender, $alias, array $args){
        if(!$this->testPermission($sender)){
            return false;
        }
        if(!$sender instanceof Player){
            $sender->sendMessage($this->getConsoleUsage());
            return false;
        }
        if(count($args) !== 0){
            $sender->sendMessage($this->getUsage());
            return false;
        }
        if(!$this->getPlugin()->returnPlayerToLastKnownPosition($sender)){
            $sender->sendMessage(TextFormat::RED . "[Error] No previous position available");
        }else{
            $sender->sendMessage(TextFormat::GREEN . "Teleporting...");
        }
        return true;
    }
} 
<?php

namespace gamemode;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecuter;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class main extends PluginBase implements Listener{
	
public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
    if($command->getName() == "gm"){
      if($sender instanceof Player){
	if(!isset($args[0])){
	  $sender->sendMessage("使い方: /gamemode <ゲームモード> <プレイヤー>");
	  return true;
	}
        if(!isset($args[1])){
          switch($args[0]){
            case "0":
            $sender->setGamemode("0");
            $sender->sendMessage("あなたのゲームモードを サバイバル モード に変更しました");
            $this->message($sender,NULL,1,"サバイバル");
            break;
            case "1":
            $sender->setGamemode("1");
            $sender->sendMessage("あなたのゲームモードを クリエイティブ モード に変更しました");
            $this->message($sender,NULL,1,"クリエイティブ");
            break;
            case "2":
            $sender->setGamemode("2");
            $sender->sendMessage("あなたのゲームモードを アドベンチャー モード に変更しました");
            $this->message($sender,NULL,1,"アドベンチャー");
            break;
            case "3":
            $sender->setGamemode("3");
            $sender->sendMessage("あなたのゲームモードを スペクテイター モード に変更しました");
            $this->message($sender,NULL,1,"スペクテイター");
            break;
          }
        }else{
          $player = $this->getServer()->getPlayer($args[1]);
           if(!$player){
             $sender->sendMessage("{$player->getName()}はオフラインです");
             return true;
          }
          switch($args[0]){
            case "0":
            $player->setGamemode("0");
            $player->sendMessage("あなたのゲームモードを サバイバル モード に変更しました");
            $sender->sendMessage("{$player->getName()} のゲームモードを サバイバル モード に変更しました");
            $this->message($sender,$player,2,"サバイバル");
            break;
            case "1":
            $player->setGamemode("1");
            $player->sendMessage("あなたのゲームモードを クリエイティブ モード に変更しました");
            $sender->sendMessage("{$player->getName()} のゲームモードを クリエイティブ モード に変更しました");
            $this->message($sender,$player,2,"クリエイティブ");
            break;
            case "2":
            $player->setGamemode("2");
            $player->sendMessage("あなたのゲームモードを アドベンチャー モード に変更しました");
            $sender->sendMessage("{$player->getName()} のゲームモードを アドベンチャー モード に変更しました");
            $this->message($sender,$player,2,"アドベンチャー");
            break;
            case "3":
            $player->setGamemode("3");
            $player->sendMessage("あなたのゲームモードを スペクテイター モード に変更しました");
            $sender->sendMessage("{$player->getName()} のゲームモードを スペクテイター モード に変更しました");
            $this->message($sender,$player,2,"スペクテイター");
            break;
          }
        }
      }else{
        $sender->sendMessage("ゲーム内で実行してください");
      }
    }
    return true;
  }
  
  public function message($sender, $user, $mode, $gm){
    foreach($this->getServer()->getOnlinePlayers() as $players){
      if($players->isOp()){
	if($sender != $players){
          if($mode == "1"){
            $players->sendMessage("§7[{$sender->getName()}: あなたのゲームモードを {$gm} モードに変更しました]");  
          }
          if($mode == "2"){
            $players->sendMessage("§7[{$sender->getName()}: {$user->getName()} のゲームモードを {$gm} モードに変更しました]");
          }
	}
      }
    }
  }
  
}

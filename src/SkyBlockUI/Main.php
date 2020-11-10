<?php

namespace SkyBlockUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase 
{

	public function onEnable()
	{

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool 
	{

		switch($cmd->getName())
		{
			case "sbui":
			 if($sender instanceof Player)
			 {
			 	$this->ui($sender);
			 }
		}
	return true;
	}

	public function ui($player)
	{
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null)
			{
				return true;
			}
			switch($data)
			{
				case 0:
					$this->getServer()->dispatchCommand($player, "is create");
				break;

				case 1:
					$this->getServer()->dispatchCommand($player, "is join");
				break;

				case 2:
					$this->getServer()->dispatchCommand($player, "is lock");
				break;

				case 3:
					$this->visit($player);
				break;

				case 4:
					$this->getServer()->dispatchCommand($player, "is leave");
				break;

				case 5:
					$this->getServer()->dispatchCommand($player, "is disband");
				break;

				case 6:
					$this->kick($player);
				break;

				case 7:
					$this->promote($player);
				break;

				case 8:
					$this->getServer()->dispatchCommand($player, "is setspawn");
				break;

				case 9:
					$this->add($player);
				break;
			}
		});
		$form->setTitle("SkyBlockUI");
		$form->setContent("Select the button below!");
		$form->addButton("Create an island");
		$form->addButton("Teleport to your island");
		$form->addButton("Lock/Unlock your island");
		$form->addButton("Visit someone else island");
		$form->addButton("Leave your island");
		$form->addButton("Delete your island");
		$form->addButton("Kick someone from your island member");
		$form->addButton("Promote someone from your island member");
		$form->addButton("Setspawn point in your island");
		$form->addButton("Add someone to your island member");
		$form->sendToPlayer($player);
		return $form;
	}

	public function visit($player)
	{
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is visit " . $data[0]);
		});
		$form->setTitle("SkyBlockUI");
		$form->addInput("Type the player name you want to visit");
		$form->sendToPlayer($player);
		return $form;
	}

	public function kick($player)
	{
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is fire " . $data[0]);
		});
		$form->setTitle("SkyBlockUI");
		$form->addInput("Type the player name you want to kick");
		$form->sendToPlayer($player);
		return $form;
	}

	public function promote($player)
	{
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is promote " . $data[0]);
		});
		$form->setTitle("SkyBlockUI");
		$form->addInput("Type the player name you want to promote");
		$form->sendToPlayer($player);
		return $form;
	}

	public function add($player)
	{
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null)
			{
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is cooperate " . $data[0]);
		});
		$form->setTitle("SkyBlockUI");
		$form->addInput("Type the player name you want to cooperate");
		$form->sendToPlayer($player);
		return $form;
	}

}
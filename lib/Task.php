<?php
namespace Up\Tasks;

use Bitrix\Main;

class Task
{
	public static function getTasks()
	{
		$result = \Up\Tasks\TaskTable::getList(['select' => ['*']]);
		return $result->fetchAll();
	}

	public static function deleteTask($id): void
	{
		\Up\Tasks\TaskTable::delete($id);
	}

	public static function createTask($taskName, $taskDesc, $taskDeadline, $taskPriority)
	{
		return \Up\Tasks\TaskTable::createObject()
			->setTitle($taskName)
			->setDescription($taskDesc ?: '')
			->setDateCreation(new \Bitrix\Main\Type\DateTime())
			->setDateDeadline(\Bitrix\Main\Type\DateTime::tryParse($taskDeadline, 'Y-m-d') ?? (new \Bitrix\Main\Type\DateTime()))
			->setPriority($taskPriority)
			->save();
	}
}
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

	public static function createTask($arg)
	{
		return \Up\Tasks\TaskTable::createObject()
			->setTitle($arg['title'])
			->setDescription($arg['description'] ?: '')
			->setDateCreation(new \Bitrix\Main\Type\DateTime())
			->setDateDeadline(((new \Bitrix\Main\Type\DateTime($arg['deadline'], 'Y-m-d'))) ?: '')
			->setPriority($arg['priority'])
			->save();
	}
}
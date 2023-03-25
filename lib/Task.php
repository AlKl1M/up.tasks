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
}
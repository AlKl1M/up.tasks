<?php
/**
 * @var CMain $APPLICATION
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Tasks");

$taskName = \Bitrix\Main\Context::getCurrent()->getRequest()->getPost('title');
$taskDesc = \Bitrix\Main\Context::getCurrent()->getRequest()->getPost('description');
$taskDeadline = \Bitrix\Main\Context::getCurrent()->getRequest()->getPost('deadline');
$taskPriority = \Bitrix\Main\Context::getCurrent()->getRequest()->getPost('priority');

if (strlen($taskName) > 24) {
	$taskName = substr($taskName, 0, 21) . "...";
}
if (strlen($taskName) > 40) {
	$taskDesc = substr($taskName, 0, 37) . "...";
}

if (check_bitrix_sessid())
{
	$result = \Up\Tasks\Task::createTask($taskName, $taskDesc, $taskDeadline, $taskPriority);
}

header('Location: /');
$APPLICATION->IncludeComponent('up:tasks.list', '', []);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="columns mb-6">
	<div class="column">
		<button class="js-modal-trigger button is-primary is-pulled-right" data-target="modal-js-example">
			Создать новую задачу
		</button>
	</div>
</div>

<div class="columns is-flex-wrap-wrap  ">
	<?php foreach($arResult['TASKS'] as $tasks): ?>
		<div class="task-card column is-4">
			<div class="card">
				<header class="card-header <?= $tasks['PRIORITY']?>">
					<a class="card-header-title">
						<?= $tasks['TITLE']; ?>
					</a>
					<a class="card-header-icon" aria-label="more options"  href="/delete/<?= $tasks['ID']; ?>/" onclick="return confirm('Вы правда хотите удалить задачу?')">
						<input type="hidden" name="ID" value="<?= $tasks['ID']; ?>">
						<span class="icon disabled">
						✖️
					</span>
					</a>
				</header>
				<div class="card-content">
					<div class="content">
						<?= $tasks['DESCRIPTION']; ?>
					</div>
				</div>
				<div class="card-content">
					<div class="content">
						Дата создания: <?= $tasks['DATE_CREATION']->format($arResult['DATE_FORMAT']); ?>
					</div>
					<div class="content">
						Дедлайн: <?= $tasks['DATE_DEADLINE']->format($arResult['DATE_FORMAT']); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<form name="Create Task" action="" method="post">
	<div class="modal" id="modal-js-example" >
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Создать новую задачу</p>
				<button class="delete" type="reset" aria-label="close"></button>
			</header>

			<section class="modal-card-body">
				<div class="field">
					<label class="label">Название (24 сим.)</label>
					<div class="control">
						<input name="title" class="input is-primary mb-4 is-large" type="text" placeholder="Task title" maxlength="24">
					</div>
				</div>
				<div class="field">
					<label class="label">Описание (40 сим.)</label>
					<div class="control">
						<input name="description" class="input is-primary mb-4 " type="text" placeholder="Task description" maxlength="40">
					</div>
				</div>
				<div class="columns" style="margin-bottom:0px">
					<div class="column">
						<label class="label">Дедлайн</label>
					</div>
					<div class="column">
						<label class="label is-pulled-right">Приоритет</label>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<div class="field ">
							<div class="control">
								<input name="deadline" type="date" class="input is-primary mb-4">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="select is-primary is-pulled-right">
							<div class="field">

								<div class="control" >
									<select name="priority">
										<option value="low">Низкий</option>
										<option value="normal">Средний</option>
										<option value="high">Высокий</option>
									</select>
								</div>
							</div>
						</div>
					</div>

				</div>
			</section>
			<footer class="modal-card-foot">
				<button class="button is-success" type="submit">Создать задачу</button>
				<button class="button" type="reset" >Отменить</button>
			</footer>
		</div>
	</div>
</form>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		// Functions to open and close a modal
		function openModal($el)
		{
			$el.classList.add('is-active');
		}
		function closeModal($el)
		{
			$el.classList.remove('is-active');
		}

		function closeAllModals()
		{
			(document.querySelectorAll('.modal') || []).forEach(($modal) => {
				closeModal($modal);
			});
		}

		// Add a click event on buttons to open a specific modal
		(document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
			const modal = $trigger.dataset.target;
			const $target = document.getElementById(modal);

			$trigger.addEventListener('click', () => {
				openModal($target);
			});
		});

		// Add a click event on various child elements to close the parent modal
		(document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
			const $target = $close.closest('.modal');

			$close.addEventListener('click', () => {
				closeModal($target);
			});
		});

		// Add a keyboard event to close all modals
		document.addEventListener('keydown', (event) => {
			const e = event || window.event;

			if (e.keyCode === 27)
			{ // Escape key
				closeAllModals();
			}
		});
	});
</script>
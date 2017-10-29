<?php
declare(strict_types=1);

namespace PDO;

use DateTime;

class TodoItem implements Entity
{
	private $id;
	private $description;
	/** @var DateTime */
	private $createTime;
	/** @var DateTime */
	private $updateTime;
	/** @var bool */
	private $checked;

	public function getId()
	{
		return $this->id;
	}

	public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function getCreateTime(): DateTime
	{
		return $this->createTime;
	}

	public function setCreateTime(DateTime $createTime): self
	{
		$this->createTime = $createTime;
		return $this;
	}

	public function getUpdateTime(): DateTime
	{
		return $this->updateTime;
	}

	public function setUpdateTime(DateTime $updateTime): self
	{
		$this->updateTime = $updateTime;
		return $this;
	}

	public function getChecked(): bool
	{
		return $this->checked;
	}

	public function setChecked(bool $checked): self
	{
		$this->checked = $checked;
		return $this;
	}

	public function getFields(): array
	{
		return [
			':id'          => $this->id,
			':description' => $this->description,
			':create_time' => $this->createTime->format(Entity::DATE_FORMAT),
			':update_time' => $this->updateTime->format(Entity::DATE_FORMAT),
			':checked'     => (string) $this->checked,
		];
	}

	public function getUpdateStatemet(): string
	{
		return 'update todo_item set 
description=:description, create_time=:create_time, update_time=:update_time, checked=:checked
where id=:id';
	}

	public function getCreateStatemet(): string
	{
		return 'insert into todo_item 
(id, description, create_time, update_time, checked) values (
:id, :description, :create_time, :update_time, :checked)';
	}
}

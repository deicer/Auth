<?php


namespace Auth\Controllers;


abstract class Controller
{
	protected function isPost(): bool
	{
		return !empty($_POST);
	}
}
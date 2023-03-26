<?php
namespace Iugstav\Controllers;

class Home
{
  public function Index()
  {
    require_once dirname(__DIR__, 1) . "/views/index.php";
  }

  public function Doubts()
  {
    require_once dirname(__DIR__, 1) . "/views/doubts.php";
  }
}
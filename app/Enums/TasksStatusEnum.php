<?php
  
namespace App\Enums;
 
enum TasksStatusEnum:string 
{
    case Todo = 'todo';
    case Done = 'done';
}
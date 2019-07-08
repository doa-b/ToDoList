<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Task;
use App\Entity\TaskList;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $taskList1 = new TaskList();
        $taskList1->setTitle("Work");
        $taskList1->setDescription("this is a very tedious task");
        $manager->persist($taskList1);

        $taskList2 = new TaskList();
        $taskList2->setTitle("Home");
        $taskList2->setDescription("these are tasks I love to do");
        $manager->persist($taskList2);

        $taskList3 = new TaskList();
        $taskList3->setTitle("Archive");
        $taskList3->setDescription("these are retired tasks");
        $manager->persist($taskList3);

        $task = new Task();
        $task->setDeadline(new \DateTime("2020-12-11"));
        $task->setTitle("Work at Bureau Blauw Geel");
        $task->setDescription("I love my job");
        $task->setDone(false);
        $task->setTaskList($taskList1);
        $manager->persist($task);

            for($i = 1; $i < 5; $i++){
                $date = new \DateTime();
                $date->modify($i." days");
                $task = new Task();
                $task->setDeadline($date);
                $task->setTitle("Task nr ".$i);
                $task->setDescription("I love my job");
                $task->setDone(false);
                $task->setTaskList($taskList1);
                $manager->persist($task);
            }

        for($i = 1; $i < 5; $i++){
            $date = new \DateTime();
            $date->modify($i." days");
            $task = new Task();
            $task->setDeadline($date);
            $task->setTitle("Task nr ".$i);
            $task->setDescription("I love my wife");
            $task->setDone(false);
            $task->setTaskList($taskList2);
            $manager->persist($task);
        }

        for($i = 1; $i < 5; $i++){
            $date = new \DateTime();
            $date->modify(-$i." days");
            $task = new Task();
            $task->setDeadline($date);
            $task->setTitle("Task nr ".$i);
            $task->setDescription("Tasks from the past");
            $task->setDone(true);
            $task->setTaskList($taskList3);
            $manager->persist($task);
        }

        $manager->flush();
    }
}

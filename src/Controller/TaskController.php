<?php
namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/new", name="add_task")
     */
    public function new(Request $request): Response
    {
        // just set up a fresh $task object (remove the example data)
        $task = new Task();
        // $task->setTask('Write a blog post');
        // $task->setDueDate(new \DateTime('tomorrow'));

        // use some PHP logic to decide if this form field is required or not
        $dueDateIsRequired = "Please set a due date";

        $form = $this->createForm(TaskType::class, $task, [
            'require_due_date' => true
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

             // ... perform some action, such as saving the task to the database
             return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('task/new.html.twig', [
            'form' => $form,
        ]);

    }

    /**
     * @Route("/success", name="task_success")
     */
    public function success(): void
    {
        
    }
}

?>
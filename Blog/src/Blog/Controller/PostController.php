<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

use Blog\Entity\Post;
use Blog\Form\PostForm;

class PostController extends AbstractActionController
{
  /**
   * @var EntityManager
   */
  protected $entityManager;

  /**
   * Sets the EntityManager
   *
   * @param EntityManager $em
   * @access protected
   * @return PostController
   */
  protected function setEntityManager(EntityManager $em)
  {
    $this->entityManager = $em;
    return $this;
  }

  /**
   * Returns the EntityManager
   *
   * Fetches the EntityManager from ServiceLocator if it has not been initiated
   * and then returns it
   *
   * @access protected
   * @return EntityManager
   */
  protected function getEntityManager()
  {
    if (null === $this->entityManager) {
      $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
    }
    return $this->entityManager;
  }
  
 public function indexAction()
  {
    $repository = $this->getEntityManager()->getRepository('Blog\Entity\Post');
    $posts      = $repository->findAll();

    return array(
      'posts' => $posts
    );
  }
  
  public function addAction()
  {
    $em = $this->getEntityManager();

    $post = new Post();
    $form = new PostForm();
    $form->bind($post);

    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setData($request->getPost());
      if ($form->isValid()) {
        $em->persist($post);
        $em->flush();

        $this->redirect()->toRoute('post');
      }
    }
    
    return array(
        'form' => $form
    );
  }
  
  public function editAction()
  {
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('post');
    }
    if ($id == 0) {
        $id = $data->post['id'];
        
    }
    $em = $this->getEntityManager();
    $data = $this->getRequest()->getPost();

    $post = $em->find('Blog\Entity\Post', $id);

    $form = new PostForm();
    $form->bind($post);
    
    $request = $this->getRequest();
    if ($request->isPost()) {
      $form->setData($request->getPost());
      
      if ($form->isValid()) {
        $em->persist($post);
        $em->flush();

        $this->redirect()->toRoute('post');
      }
    }

    return array(
      'form' => $form,
      'id' => $id
    );
  }
  
  public function deleteAction()
  {
    $id = (int) $this->params('id', null);
    if (null === $id) {
      return $this->redirect()->toRoute('post');
    }

    $em = $this->getEntityManager();

    $post = $em->find('Blog\Entity\Post', $id);

    $em->remove($post);
    $em->flush();
    
    $this->redirect()->toRoute('post');
  }
}
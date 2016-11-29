<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PhotoAlbum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Photoalbum controller.
 *
 * @Route("admin/foto-album")
 */
class PhotoAlbumController extends Controller
{
    /**
     * Lists all photoAlbum entities.
     *
     * @Route("/", name="admin_photoalbum_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $photoAlbums = $em->getRepository('AppBundle:PhotoAlbum')->findAll();

        return $this->render('photoalbum/index.html.twig', array(
            'photoAlbums' => $photoAlbums,
        ));
    }

    /**
     * Creates a new photoAlbum entity.
     *
     * @Route("/new", name="admin_photoalbum_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $photoAlbum = new Photoalbum();
        $form = $this->createForm('AppBundle\Form\PhotoAlbumType', $photoAlbum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($photoAlbum);
            $em->flush($photoAlbum);

            return $this->redirectToRoute('admin_photoalbum_show', array('id' => $photoAlbum->getId()));
        }

        return $this->render('photoalbum/new.html.twig', array(
            'photoAlbum' => $photoAlbum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a photoAlbum entity.
     *
     * @Route("/{id}", name="admin_photoalbum_show")
     * @Method("GET")
     */
    public function showAction(PhotoAlbum $photoAlbum)
    {
        $deleteForm = $this->createDeleteForm($photoAlbum);

        return $this->render('photoalbum/show.html.twig', array(
            'photoAlbum' => $photoAlbum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing photoAlbum entity.
     *
     * @Route("/{id}/edit", name="admin_photoalbum_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PhotoAlbum $photoAlbum)
    {
        $deleteForm = $this->createDeleteForm($photoAlbum);
        $editForm = $this->createForm('AppBundle\Form\PhotoAlbumType', $photoAlbum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_photoalbum_edit', array('id' => $photoAlbum->getId()));
        }

        return $this->render('photoalbum/edit.html.twig', array(
            'photoAlbum' => $photoAlbum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a photoAlbum entity.
     *
     * @Route("/{id}", name="admin_photoalbum_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PhotoAlbum $photoAlbum)
    {
        $form = $this->createDeleteForm($photoAlbum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photoAlbum);
            $em->flush($photoAlbum);
        }

        return $this->redirectToRoute('admin_photoalbum_index');
    }

    /**
     * Creates a form to delete a photoAlbum entity.
     *
     * @param PhotoAlbum $photoAlbum The photoAlbum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PhotoAlbum $photoAlbum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_photoalbum_delete', array('id' => $photoAlbum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Supplement;
use AppBundle\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrderController.
 *
 * @internal param User $user
 */
class OrderController extends Controller
{

    /**
     * @Route("/order", name="new_order")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $supplement = new Supplement();
        $form = $this->createForm(OrderType::class, $supplement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $ingredients = $data->GetIngredients();
            $price = 0;
            foreach ($ingredients as $ingredient) {
                $price += ($ingredient->getPrice());
            }

            $supplement->setName("VoltaSport X" . $random = random_int(1, 9999));
            $supplement->setPrice($price);

            $order = new Order();
            $order->setOrderId("U" . random_int(1111111, 9999999));
            $order->setUser($user);
            $order->addSupplement($supplement);
            $order->setPrice($price);
            $order->setStatus(0);

            $em->persist($supplement);
            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Užsakymas užregistruotas.');
            return $this->redirectToRoute('user_orders');
        }


        return $this->render('AppBundle:Order:index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

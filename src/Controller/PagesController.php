<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org).
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * @see      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 *
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Riesenia\Cart\Cart;

/**
 * Static content controller.
 *
 * This controller will render views from templates/Pages/
 *
 * @see https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->FormProtection->setConfig('validate', false);
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function index()
    {
        if (!$this->request->getSession()->read('Cart')) {
            $this->request->getSession()->write('Cart', new Cart());
        }

        $cart = $this->request->getSession()->read('Cart');

        $cart = (object) [
            'subtotal' => $cart->getSubtotal(),
            'vat' => $cart->getTaxes(),
            'total' => $cart->getTotal()
        ];
        $this->set(\compact('cart'));

        $query = $this->fetchTable('Categories')->find();
        $categories = $this->paginate($query);

        $this->set(\compact('categories'));

        $query = $this->fetchTable('Products')->find()->select(['id', 'name', 'price', 'vat', 'img']);

        if (!$this->request->getQuery('category')) {
            $products = $this->paginate($query);
        } else {
            $query->join([
                'a' => [
                    'table' => 'product_categories',
                    'type' => 'left',
                    'conditions' => 'Products.id = a.product_id'
                ]
            ])
                ->where(['a.category_id' => $this->request->getQuery('category')]);

            $products = $this->paginate($query);
        }

        $this->set(\compact('products'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function dashboard()
    {
    }

    /**
     * @param string|null $id
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *
     * @return \Cake\Http\Response|null
     */
    public function addtocart($id = null)
    {
        $this->request->allowMethod(['post']);

        $product = $this->fetchTable('Products')->get($id);
        $_SESSION['Cart']->addItem($product, 1);

        $cart = [
            'subtotal' => (string) $_SESSION['Cart']->getSubtotal(),
            'total' => (string) $_SESSION['Cart']->getTotal()
        ];

        return $this->response->withType('application/json')->withStringBody((string) \json_encode($cart));
    }
}

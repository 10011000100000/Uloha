<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * @return \Cake\Http\Response|void|null
     */
    public function index()
    {
        $query = $this->Products->find();
        $products = $this->paginate($query);

        $this->set(\compact('products'));
    }

    /**
     * @param string|null $id
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *
     * @return \Cake\Http\Response|void|null
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, contain: []);
        $this->set(\compact('product'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            if ($this->request->getUploadedFiles()['img-file']->getClientFilename()) {
                $imgName = $this->request->getUploadedFiles()['img-file']->getClientFilename();
                $product->img = \hash('sha256', $imgName . \strval(\time())) . '.' . \pathinfo($imgName, PATHINFO_EXTENSION);
                $product->imgName = $imgName;
                $productImgTmp = $this->request->getUploadedFiles()['img-file']->getStream()->getMetadata('uri');
            } else {
                $this->Flash->error(__('Please upload product image.'));

                return $this->redirect(['action' => 'add']);
            }

            if ($this->Products->save($product)) {
                if (!\move_uploaded_file($productImgTmp, 'img/product_img/' . $product->img)) {
                    $this->Flash->error(__('The product image could not be saved.'));
                }
                $productCategories = [];

                foreach ($this->request->getData() as $input) {
                    if (\is_string($input) && \str_contains($input, 'category-')) {
                        \array_push($productCategories, \explode('-', $input)[1]);
                    }
                }

                foreach ($productCategories as $category) {
                    $productCategory = $this->fetchTable('Product_categories')->newEmptyEntity();
                    $productCategory = $this->fetchTable('Product_categories')->patchEntity($productCategory, ['category_id' => $category, 'product_id' => $product->id]);

                    if (!$this->fetchTable('Product_categories')->save($productCategory)) {
                        $this->Flash->error(__('The product categories could not be saved.'));
                    }
                }
                $this->Flash->success(__('The product has been created.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be created. Please, try again.'));
        }
        $query = $this->fetchTable('Categories')->find()->select(['id', 'name']);
        $categories = $this->paginate($query)->toArray();
        $this->set(\compact('categories'));
        $this->set(\compact('product'));
    }

    /**
     * @param string|null $id
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *
     * @return \Cake\Http\Response|void|null
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id);
        $query = $this->fetchTable('Categories')->find()->select(['id', 'name']);
        $categories = $this->paginate($query)->toArray();
        $query = $this->fetchTable('Product_categories')->find()->select(['category_id'])->where(['product_id' => $id]);
        $productCategoriesObject = $this->paginate($query)->toArray();
        $productCategories = [];

        foreach ($productCategoriesObject as $productCategory) {
            \array_push($productCategories, $productCategory->category_id);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $newProductCategories = [];

            foreach ($this->request->getData() as $input) {
                if (\is_string($input) && \str_contains($input, 'category-')) {
                    \array_push($newProductCategories, \explode('-', $input)[1]);
                }
            }

            if ($this->request->getUploadedFiles()['img-file']->getClientFilename()) {
                $imgUploaded = true;

                if (\is_string($product->img) && \file_exists('img/product_img/' . $product->img)) {
                    \unlink('img/product_img/' . $product->img);
                }
                $imgName = $this->request->getUploadedFiles()['img-file']->getClientFilename();
                $product->img = \hash('sha256', $imgName . \strval(\time())) . '.' . \pathinfo($imgName, PATHINFO_EXTENSION);
                $product->imgName = $imgName;
                $productImgTmp = $this->request->getUploadedFiles()['img-file']->getStream()->getMetadata('uri');
            } else {
                $imgUploaded = false;
            }

            if ($this->Products->save($product)) {
                if ($imgUploaded && !\move_uploaded_file($productImgTmp, 'img/product_img/' . $product->img)) {
                    $this->Flash->error(__('The product image could not be saved. Please, try again.'));
                }

                if ($productCategories !== $newProductCategories) {
                    foreach ($categories as $category) {
                        if (\in_array($category->id, $productCategories) && !\in_array($category->id, $newProductCategories)) {
                            $query = $this->fetchTable('Product_categories')
                                ->deleteQuery()
                                ->where(['category_id' => $category->id, 'product_id' => $id]);

                            if (!$query->execute()) {
                                $this->Flash->error(__('The product categories could not be saved correctly. Please, try again.'));
                            }
                        } elseif (!\in_array($category->id, $productCategories) && \in_array($category->id, $newProductCategories)) {
                            $productCategory = $this->fetchTable('Product_categories')->newEmptyEntity();
                            $productCategory = $this->fetchTable('Product_categories')->patchEntity($productCategory, ['category_id' => $category->id, 'product_id' => $id]);

                            if (!$this->fetchTable('Product_categories')->save($productCategory)) {
                                $this->Flash->error(__('The product categories could not be saved correctly. Please, try again.'));
                            }
                        }
                    }
                }
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(\compact('productCategories'));
        $this->set(\compact('categories'));
        $this->set(\compact('product'));
    }

    /**
     * @param string|null $id
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);

        if ($this->Products->delete($product)) {
            $this->fetchTable('Product_categories')
                ->deleteQuery()
                ->where(['product_id' => $id])
                ->execute();

            if (\file_exists('img/product_img/' . $product->img)) {
                \unlink('img/product_img/' . $product->img);
            }

            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

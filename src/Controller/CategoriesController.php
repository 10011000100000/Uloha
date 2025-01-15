<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{
    /**
     * @return \Cake\Http\Response|void|null
     */
    public function index()
    {
        $query = $this->Categories->find();
        $categories = $this->paginate($query);

        $this->set(\compact('categories'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function add()
    {
        $category = $this->Categories->newEmptyEntity();

        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('Category created successfully.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Category could not be created. Please, try again.'));
        }
        $this->set(\compact('category'));
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
        $category = $this->Categories->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been created.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be created. Please, try again.'));
        }
        $this->set(\compact('category'));
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
        $category = $this->Categories->get($id);

        if ($this->Categories->delete($category)) {
            $this->fetchTable('Product_categories')
                ->deleteQuery()
                ->where(['category_id' => $id])
                ->execute();

            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

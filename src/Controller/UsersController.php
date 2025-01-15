<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'signup']);
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(\compact('users'));
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
        $user = $this->Users->get($id, contain: []);
        $this->set(\compact('user'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('User created successfully.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('User could not be created. Please, try again.'));
        }
        $this->set(\compact('user'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function signup()
    {
        $this->request->allowMethod(['get', 'post']);

        if ($this->Authentication->getIdentifier()) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }

        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Signed up successfully.'));
                $this->Authentication->setIdentity($user);

                return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
            }
            $this->Flash->error(__('Account could not be created. Please, try again.'));
        }
        $this->set(\compact('user'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }

        if ($this->request->is('post') && $result && !$result->isValid()) {
            $this->Flash->error(__('Invalid login or password'));
        }
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['action' => 'login']);
        }
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
        $user = $this->Users->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(\compact('user'));
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
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

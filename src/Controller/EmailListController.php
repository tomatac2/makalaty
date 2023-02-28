<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EmailList Controller
 *
 * @property \App\Model\Table\EmailListTable $EmailList
 * @method \App\Model\Entity\EmailList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailListController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $emailList = $this->paginate($this->EmailList);

        $this->set(compact('emailList'));
    }

    /**
     * View method
     *
     * @param string|null $id Email List id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailList = $this->EmailList->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('emailList'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailList = $this->EmailList->newEmptyEntity();
        if ($this->request->is('post')) {
            $emailList = $this->EmailList->patchEntity($emailList, $this->request->getData());
            if ($this->EmailList->save($emailList)) {
                $this->Flash->success(__('The email list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email list could not be saved. Please, try again.'));
        }
        $this->set(compact('emailList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Email List id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailList = $this->EmailList->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailList = $this->EmailList->patchEntity($emailList, $this->request->getData());
            if ($this->EmailList->save($emailList)) {
                $this->Flash->success(__('The email list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email list could not be saved. Please, try again.'));
        }
        $this->set(compact('emailList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Email List id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailList = $this->EmailList->get($id);
        if ($this->EmailList->delete($emailList)) {
            $this->Flash->success(__('The email list has been deleted.'));
        } else {
            $this->Flash->error(__('The email list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

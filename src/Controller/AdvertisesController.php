<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Advertises Controller
 *
 * @property \App\Model\Table\AdvertisesTable $Advertises
 * @method \App\Model\Entity\Advertise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdvertisesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $advertises = $this->paginate($this->Advertises);

        $this->set(compact('advertises'));
    }

    /**
     * View method
     *
     * @param string|null $id Advertise id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $advertise = $this->Advertises->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('advertise'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $advertise = $this->Advertises->newEmptyEntity();
        if ($this->request->is('post')) {
            $advertise = $this->Advertises->patchEntity($advertise, $this->request->getData());
            if ($this->Advertises->save($advertise)) {
                $this->Flash->success(__('The advertise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The advertise could not be saved. Please, try again.'));
        }
        $this->set(compact('advertise'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Advertise id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $advertise = $this->Advertises->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $advertise = $this->Advertises->patchEntity($advertise, $this->request->getData());
            if ($this->Advertises->save($advertise)) {
                $this->Flash->success(__('The advertise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The advertise could not be saved. Please, try again.'));
        }
        $this->set(compact('advertise'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Advertise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $advertise = $this->Advertises->get($id);
        if ($this->Advertises->delete($advertise)) {
            $this->Flash->success(__('The advertise has been deleted.'));
        } else {
            $this->Flash->error(__('The advertise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

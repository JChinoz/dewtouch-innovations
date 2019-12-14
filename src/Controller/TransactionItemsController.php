<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TransactionItems Controller
 *
 * @property \App\Model\Table\TransactionItemsTable $TransactionItems
 *
 * @method \App\Model\Entity\TransactionItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Transactions', 'Tables']
        ];
        $transactionItems = $this->paginate($this->TransactionItems);

        $this->set(compact('transactionItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Transaction Item id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transactionItem = $this->TransactionItems->get($id, [
            'contain' => ['Transactions', 'Tables']
        ]);

        $this->set('transactionItem', $transactionItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transactionItem = $this->TransactionItems->newEntity();
        if ($this->request->is('post')) {
            $transactionItem = $this->TransactionItems->patchEntity($transactionItem, $this->request->getData());
            if ($this->TransactionItems->save($transactionItem)) {
                $this->Flash->success(__('The transaction item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction item could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionItems->Transactions->find('list', ['limit' => 200]);
        $tables = $this->TransactionItems->Tables->find('list', ['limit' => 200]);
        $this->set(compact('transactionItem', 'transactions', 'tables'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transactionItem = $this->TransactionItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transactionItem = $this->TransactionItems->patchEntity($transactionItem, $this->request->getData());
            if ($this->TransactionItems->save($transactionItem)) {
                $this->Flash->success(__('The transaction item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction item could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionItems->Transactions->find('list', ['limit' => 200]);
        $tables = $this->TransactionItems->Tables->find('list', ['limit' => 200]);
        $this->set(compact('transactionItem', 'transactions', 'tables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transactionItem = $this->TransactionItems->get($id);
        if ($this->TransactionItems->delete($transactionItem)) {
            $this->Flash->success(__('The transaction item has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

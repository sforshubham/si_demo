<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 */
class LocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Cookie', 'Session');
    public $helpers = array('Session');

     public function beforeFilter() {
        $this->setLanguage();
    }

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Location->recursive = 0;
        $this->Paginator->settings = array(
            'fields' => array('id', 'name', 'location', 'phone_number', 'Category.name'),
            'limit' => 5
        );
        $this->set('locations', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
        $this->set('location', $this->Location->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Location->create();
            if ($this->Location->save($this->request->data)) {
                $this->Session->setFlash(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The location could not be saved. Please, try again.'));
            }
        }
        $countries = $this->Location->Country->find('list');
        $categories = $this->Location->Category->find('list');
        $this->set(compact('countries', 'categories'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Location->save($this->request->data)) {
                $this->Session->setFlash(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The location could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
            $this->request->data = $this->Location->find('first', $options);//pr($this->request->data);die;
        }
        $cities = [$this->request->data['Location']['city_id'] => $this->request->data['City']['name']];
        $states = [$this->request->data['Location']['state_id'] => $this->request->data['State']['name']];
        $countries = $this->Location->Country->find('list');
        $categories = $this->Location->Category->find('list');
        $this->set(compact('cities', 'states', 'countries', 'categories'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Invalid location'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Location->delete()) {
            $this->Session->setFlash(__('The location has been deleted.'));
        } else {
            $this->Session->setFlash(__('The location could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

   public function setLanguage($lang = '') {
    //if the cookie was previously set, and Config.language has not been set
    //write the Config.language with the value from the Cookie
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }
        //if the user clicked the language URL
        else if (in_array($lang, Configure::read('Config.allowed_languages'))) {
            //then update the value in Session and the one in Cookie
            $this->Session->write('Config.language', $lang);
            $this->Cookie->write('lang', $lang, false, '20 days');
            $lang = $this->Cookie->read('lang');
            $this->redirect($this->referer());
        }
    }

    public function getState($country_id) {
        $states = $this->Location->State->find('list', array(
            'conditions' => array('country_id' => $country_id)
        ));
        $states[''] = 'Select';
        ksort($states);
        echo json_encode($states);
        exit;
    }

    public function getCity($state_id) {
        $cities = $this->Location->City->find('list', array(
            'conditions' => array('state_id' => $state_id)
        ));
        $cities[''] = 'Select';
        ksort($cities);
        echo json_encode($cities);
        exit;
    }
 }

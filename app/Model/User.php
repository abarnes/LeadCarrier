<?php 
class User extends AppModel {
    var $name = 'User';
    var $belongsTo = array('Company');
    var $validate = array(
        'username' => array(
            'rule' => 'isUnique',
            'message' => 'This username has already been taken.',
            'required'=>true,
            'allowEmpty'=>false
        )
    );
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
}
?>
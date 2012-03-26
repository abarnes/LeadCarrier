<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class User extends AppModel {
    var $name = 'User';
    var $belongsTo = array('Company');
    var $validate = array(
        'username' => array(
            'rule1'=>array(
                'rule' => 'isUnique',
                'message' => 'This username has already been taken.',
            ),
            'rule2'=>array(
                'rule'=>array('notEmpty'),
                'message'=>'Please enter a username.',
                'last'=>true
            )
        ),
        'email'=>array(
            'rule1'=>array(
                'rule'=>'email',
                'message'=>'Please enter a valid email address.'
            ),
            'rule2'=>array(
                'rule' => 'isUnique',
                'message' => 'This email address is already registered.',
            )
        ),
        'password'=>array(
            'rule1'=>array(
                'rule'=>array('minLength',6),
                'message'=>'Passwords must be at least 6 characters.'
            ),
            'rule2'=>array(
                'rule'=>array('checkpasswords'),
                'message'=>'Passwords did not match'
            )
        )
    );
    
    public function checkpasswords($check) {
        if ($this->data['User']['password']==$this->data['User']['password2']) {
            return true;
        } else {
            return false;
        }
    }
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
}
?>
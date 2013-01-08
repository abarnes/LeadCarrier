<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Company extends AppModel {
    var $name = 'Company';
    var $hasMany = array('User');
    var $belongsTo = array('Affiliate');
    var $validate = array(
        'name' => array(
            'rule1'=>array(
                'rule' => 'isUnique',
                'message' => 'This company name has already been taken.',
            ),
            'rule2'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide your company\'s name.'
            ),
            'rule3'=>array(
                'rule'=>array('banned'),
                'message'=>'Please provide your company\'s name.',
                'last'=>true
            ),
            'rule4'=>array(
                'rule'=>array('check_name'),
                'message'=>'This company name has already been taken, or is nearly identical to an existing name.'
            )
        ),
        'subdomain' => array(
            'rule1'=>array(
                'rule' => 'isUnique',
                'message' => 'This subdomain has already been taken.',
            ),
            'rule2'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide a desired subdomain.'
            ),
            'rule3'=>array(
                'rule'=>array('banned'),
                'message'=>'Please provide a desired subdomain.',
                'last'=>true
            )
        ),
        'email' => array(
            'rule'=>'email',
            'message'=>'Please provide a valid email address.'
        ),
        'phone' => array(
            'rule'=>array('phone',null,'us'),
            'message'=>'Please provide a valid phone number with area code.'
        ),
        'zip'=>array(
            'rule'=>array('postal',null,'us'),
            'message'=>'Please provide a valid zip code.'
        ),
        'address1'=>array(
            'rule1'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide your address.'
            ),
            'rule2'=>array(
                'rule'=>array('banned'),
                'message'=>'Please provide your address.',
                'last'=>true
            )
        ),
        'address2'=>array(
            'rule'=>array('banned'),
            'message'=>''
        ),
        'state'=>array(
            'rule1'=>array(
                'rule'=>array('minLength',2),
                'message'=>array('Please provide your state.')
            ),
            'rule2'=>array(
                'rule'=>array('banned'),
                'message'=>array('Please provide your state.'),
                'last'=>true
            )
        ),
        'city'=>array(
            'rule1'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide your city.'
            ),
            'rule2'=>array(
                'rule'=>array('banned'),
                'message'=>'Please provide your city.',
                'last'=>true
            )
        ),
        'contact_name'=>array(
            'rule1'=>array(
                'rule'=>array('minLength',3),
                'message'=>array('Please provide the name of a contact at your company.')
            ),
            'rule2'=>array(
                'rule'=>array('banned'),
                'message'=>array('Please provide the name of a contact at your company.'),
                'last'=>true
            )
        ),
        'terms'=>array(
            'rule'=>array('checked'),
            'required'=>true,
            'message'=>array('You must agree to the Terms and Conditions'),
            'on'=>'create'
        )
    );
    
    function checked($check) {
        if ($check['terms']==false||$check['terms']==0) {
            return false;
        } else {
            return true;
        }
    }
    
    function banned($check) {
        $b = array("Company Name","Contact Name","Subdomain","Address Line 1","City","State");
        foreach ($check as $check) {
            if (in_array($check,$b)) {
                return false;
            } else {
                return true;
            }
        }
    }
    
    function check_name($check) {
        $newcompany = ereg_replace("[^A-Za-z0-9]", "", $check['name']);
        $uname = 'lcarrier_'.substr(str_replace(" ", "", $newcompany),0,7);
        if ($this->find('count',array('conditions'=>array('Company.db_name'=>$uname)))>0) {
            return false;
        } else {
            return true;
        }
    }
}
?>
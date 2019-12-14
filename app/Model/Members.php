<?php

class Members extends AppModel {
    public $hasMany = array(
		'Transaction' => array(
                'className' => 'Transactions',
                'foreignKey' => 'member_id',
                'dependant' => false
        )
    );
}
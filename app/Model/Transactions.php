<?php

class Transactions extends AppModel {
    public $belongsTo = array(
		'Member' => array(
			'className' => 'Members',
			'foreignKey' => 'member_id'
		)
    );
    
    public $hasMany = array(
		'TransactionItem' => array(
			'className' => 'TransactionItems',
            'foreignKey' => 'transaction_id',
            'dependant' => false
        )
    );
}
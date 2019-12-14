<?php

class TransactionItems extends AppModel {
    public $belongsTo = array(
		'Member' => array(
			'className' => 'Transactions',
            'foreignKey' => 'transaction_id',
		)
    );
}
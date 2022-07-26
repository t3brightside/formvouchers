<?php
$EM_CONF[$_EXTKEY] = [
	'title' => 'Formvouchers',
	'description' => 'Send unique vouchers with form e-mail finisher.',
	'category' => 'fe',
	'version' => '1.0.0',
	'state' => 'stable',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0 - 11.5.99',
			'form' => '11.5.0 - 11.5.99'
		],
	],
	'autoload' => [
		 'psr-4' => [
				'Brightside\\Formvouchers\\' => 'Classes'
		 ]
	],
];

<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:tx_formvouchers_domain_model_vouchers',
        'label' => 'voucher',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'searchFields' => 'voucher',
        'iconfile' => 'EXT:formvouchers/Resources/Public/Icons/Extension.svg'
    ],
    'types' => [
        '1' => [
            'showitem' => 'voucher, is_used'
        ]
    ],
    'columns' => [
        'voucher' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:tx_formvouchers_domain_model_vouchers.voucher',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'readOnly' => 0
            ]
        ],
        'is_used' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:tx_formvouchers_domain_model_vouchers.is_used',
            'config' => [
                'type' => 'check',
                'readOnly' => 0
            ]
        ],
    ]
];

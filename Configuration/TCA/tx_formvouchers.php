<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:tx_formvouchers',
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
    'interface' => [
        'showRecordFieldList' => 'voucher, is_used'
    ],
    'types' => [
        '1' => [
            'showitem' => 'voucher, is_used'
        ]
    ],
    'columns' => [
        'voucher' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:formvouchers.voucher',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'readOnly' => 0
            ]
        ],
        'is_used' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:formvouchers/Resources/Private/Language/locallang.xlf:tx_formvouchers.is_used',
            'config' => [
                'type' => 'check',
                'readOnly' => 0
            ]
        ],
    ]
];

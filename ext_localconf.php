<?php
defined('TYPO3') or die();

call_user_func(function () {
     \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
         trim('
             module.tx_form {
                 settings {
                     yamlConfigurations {
                         8977801435 = EXT:formvouchers/Configuration/Form/FormvouchersBackend.yaml
                     }
                 }
             }
         ')
     );
});

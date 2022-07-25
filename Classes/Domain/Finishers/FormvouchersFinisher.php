<?php
namespace Brightside\Formvouchers\Domain\Finishers;

use Brightside\Formvouchers\Domain\Model\Formvouchers;
use TYPO3\CMS\Form\Domain\Model\Renderable\AbstractRenderable;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $row = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tx_formvouchers_domain_model_vouchers')
            ->select(
                ['voucher'], // fields to select
                'tx_formvouchers_domain_model_vouchers', // from
                [ 'is_used' => (int)0 ] // where
            )
            ->setMaxResults(1)
            ->fetchAssociative();
        $voucher = $row['voucher'];
        /** @var AbstractRenderable $newField */
        $newField = $this->finisherContext
            ->getFormRuntime()
            ->getFormDefinition()
            ->getPageByIndex(0)
            ->createElement('code', 'Text');
        $newField->setDefaultValue($voucher);
        $newField->setDataType('string');
        $newField->setLabel('code');

        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'code',
            $voucher
        );

        return null;
    }
}

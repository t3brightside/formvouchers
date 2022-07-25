<?php
namespace Brightside\Formvouchers\Domain\Finishers;

use Brightside\Formvouchers\Domain\Model\Formvouchers;
use TYPO3\CMS\Form\Domain\Model\Renderable\AbstractRenderable;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{

    /**
     * @var array
     */
    protected $options = [
        'voucherPageUid' => 0,
    ];
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $voucherPageUid = $this->parseOption('voucherPageUid');
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_formvouchers_domain_model_vouchers');
        $row = $queryBuilder
            ->select('uid', 'voucher')
            ->from('tx_formvouchers_domain_model_vouchers')
            ->where(
                $queryBuilder->expr()->eq('is_used', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            )
            ->setMaxResults(1)
            ->executeQuery()
            ->fetchAssociative();
        $voucher = $row['voucher'];
        $uid = $row['uid'];

        $queryBuilder->update('tx_formvouchers_domain_model_vouchers')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT)))
            ->set('is_used', 1)
            ->set('pid', $voucherPageUid)
            ->executeQuery();

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

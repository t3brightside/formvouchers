<?php
namespace Brightside\Formvouchers\Domain\Finishers;

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
        'checkSend' => '',
        'checkSendEnabled' => false
    ];
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $checkSend = $this->parseOption('checkSend');
        $checkSendEnabled = $this->parseOption('checkSendEnabled');

        if ($checkSendEnabled and $checkSend == '') {
            return null;
        }

        $voucherPageUid = $this->parseOption('voucherPageUid');
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_formvouchers_domain_model_vouchers');

        $key = 456123;
        // This is Old School
        $semaphore = sem_get($key);
        $waitCount = 0;
        $hasSemaphore=sem_acquire($semaphore, true);
        while (!$hasSemaphore and $waitCount < 10) {
            sleep(1);
            $waitCount++;
            $hasSemaphore=sem_acquire($semaphore, true);
        }
        if ($hasSemaphore) {
            $row = $queryBuilder
                ->select('uid', 'voucher')
                ->from('tx_formvouchers_domain_model_vouchers')
                ->where(
                    $queryBuilder->expr()->eq('is_used', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->setMaxResults(1)
                ->execute()
                ->fetchAssociative();

            if (!$row) {
                sem_release($semaphore);
                return null;
            }
            $uid = $row['uid'];
            $voucher = $row['voucher'];

            $queryBuilder
                ->update('tx_formvouchers_domain_model_vouchers')
                ->set('is_used', 1)
                ->set('pid', $voucherPageUid)
                ->set('tstamp', (int)$GLOBALS['EXEC_TIME'])
                ->where(
                    $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int)$uid, \PDO::PARAM_INT))
                    )
                ->execute();

            sem_release($semaphore);

            /** @var AbstractRenderable $newField */
            $newField = $this->finisherContext
                ->getFormRuntime()
                ->getFormDefinition()
                ->getPageByIndex(0)
                ->createElement('code', 'Text');
            $newField->setDefaultValue($voucher);
            $newField->setDataType('string');
            $newField->setLabel('Voucher');

            $this->finisherContext->getFinisherVariableProvider()->add(
                $this->shortFinisherIdentifier,
                'code',
                $voucher
            );
        }
        return null;
    }
}

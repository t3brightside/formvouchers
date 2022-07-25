<?php
namespace Brightside\Formvouchers\Domain\Finishers;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Form\Domain\Model\Renderable\AbstractRenderable;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        parent::__construct($finisherIdentifier);
        $this->logger = $logger;
    }

    /**
     * @var array
     */
    protected $options = [
        'voucherPageUid' => 0,
        'checkSend' => ''
    ];
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $checkSend = $this->parseOption('checkSend');
        if ($checkSend == '' ){
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
                ->executeQuery()
                ->fetchAssociative();

            $uid = $row['uid'];
            $voucher = $row['voucher'];

            $queryBuilder
                ->update('tx_formvouchers_domain_model_vouchers')
                ->set('is_used', 1)
                ->set('pid', $voucherPageUid)
                ->where(
                    $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int)$uid, \PDO::PARAM_INT))
                    )
                ->executeStatement();

            sem_release($semaphore);

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
        }
        return null;
    }
}

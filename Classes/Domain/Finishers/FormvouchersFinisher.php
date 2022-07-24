<?php
namespace Brightside\Formvouchers\Domain\Finishers;

use Brightside\Formvouchers\Domain\Model\Formvouchers;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Form\Domain\Finishers\Exception\FinisherException;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\EmailFinisher
{

    public function __construct()
    {
        parent::__construct($finisherIdentifier);
    }
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $voucher = "Experiment";
        if ($this->parseOption('addField')) {
            try {
                /** @var AbstractRenderable $newField */
                $newField = $this->finisherContext
                    ->getFormRuntime()
                    ->getFormDefinition()
                    ->getPageByIndex(0)
                    ->createElement('code', 'Text');
                $newField->setDefaultValue($voucher);
                $newField->setDataType('string');
                $newField->setLabel('code');
            } catch (\TYPO3\CMS\Form\Exception $exception) {
            }
        }

        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'code',
            $voucher
        );

        return null;
    }
}

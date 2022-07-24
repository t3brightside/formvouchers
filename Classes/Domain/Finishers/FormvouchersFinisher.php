<?php
namespace Brightside\Formvouchers\Domain\Finishers;

use Brightside\Formvouchers\Domain\Model\Formvouchers;
use TYPO3\CMS\Form\Domain\Model\Renderable\AbstractRenderable;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{
    /**
     * @return string|null
     */
    public function executeInternal()
    {
        $voucher = "Experiment";

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

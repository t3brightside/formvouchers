<?php
namespace Brightside\Formvouchers\Finisher;

use Brightside\Formvouchers\Domain\Model\FormvouchersVoucher;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Form\Domain\Finishers\Exception\FinisherException;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;

class FormvouchersFinisher extends \TYPO3\CMS\Form\Domain\Finishers\EmailFinisher
{


}

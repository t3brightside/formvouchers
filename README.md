# Formvouchers
[![License](https://poser.pugx.org/t3brightside/formvouchers/license)](LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/t3brightside/formvouchers.svg?style=flat)](https://packagist.org/packages/t3brightside/formvouchers)
[![Downloads](https://poser.pugx.org/t3brightside/formvouchers/downloads)](https://packagist.org/packages/t3brightside/formvouchers)
[![Brightside](https://img.shields.io/badge/by-t3brightside.com-orange.svg?style=flat)](https://t3brightside.com)

**TYPO3 CMS extension to send predefined voucher codes with form email finisher.**

## Features
- Send unique vouchers from predefined voucher records
- Set voucher 'used' after sending
- Optional check for a form field if voucher is requested

## System requirements
- TYPO3
- form

## Installation
 - `composer req t3brightside/formvouchers` or from TYPO3 extension repository **[formvouchers](https://extensions.typo3.org/extension/formvouchers/)**
 - Include static template

## Usage
 - Set up voucher records
 - Configure the finisher in your form pointing to the voucher records page
 - Check Configuration/TypoScript/setup.typoscript for how to hide voucher request field in form if run out of codes
 - In custom email template you can use:
```xml
<formvh:renderFormValue renderable="{form.formDefinition.elements.code}" as="formValue">{formValue.processedValue}</formvh:renderFormValue>
```

## Sources
-  [GitHub](https://github.com/t3brightside/formvouchers)
-  [Packagist](https://packagist.org/packages/t3brightside/formvouchers)
-  [TER](https://extensions.typo3.org/extension/formvouchers/)

## Development & maintenance
[Brightside OÜ – TYPO3 development and hosting specialised web agency](https://t3brightside.com/)

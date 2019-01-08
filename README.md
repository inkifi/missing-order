A special handling of the Mediaclip missing orders for [inkifi.com](https://inkifi.com).

## How to install
```
bin/magento maintenance:enable
composer require inkifi/missing-order:*
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy -f en_US en_GB --area adminhtml --theme Magento/backend && bin/magento setup:static-content:deploy -f en_US en_GB --area frontend --theme Infortis/ultimo
bin/magento maintenance:disable
```

## How to upgrade
```
bin/magento maintenance:enable
composer update inkifi/missing-order
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy -f en_US en_GB --area adminhtml --theme Magento/backend && bin/magento setup:static-content:deploy -f en_US en_GB --area frontend --theme Infortis/ultimo
bin/magento maintenance:disable
```

If you have problems with these commands, please check the [detailed instruction](https://mage2.pro/t/263).
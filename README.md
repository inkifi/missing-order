A special handling of the Mediaclip missing orders for [inkifi.com](https://inkifi.com).  
- [upwork.com/ab/f/contracts/21351745](https://www.upwork.com/ab/f/contracts/21351745)
- [upwork.com/messages/rooms/room_f518ada88c89e3d7de30e4fd8922bbdf/story_579929cf1ed21577d3dbe99db0a476e0](https://www.upwork.com/messages/rooms/room_f518ada88c89e3d7de30e4fd8922bbdf/story_579929cf1ed21577d3dbe99db0a476e0)

## How to install
```
bin/magento maintenance:enable
composer require inkifi/missing-order:*
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy -f en_US en_GB --area adminhtml --theme Magento/backend && bin/magento setup:static-content:deploy -f en_US en_GB --area frontend --theme Infortis/ultimo
bin/magento maintenance:disable
bin/magento cache:enable
```

## How to upgrade
```
bin/magento maintenance:enable
rm -rf composer.lock
composer update inkifi/missing-order
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
rm -rf pub/static/* && bin/magento setup:static-content:deploy -f en_US en_GB --area adminhtml --theme Magento/backend && bin/magento setup:static-content:deploy -f en_US en_GB --area frontend --theme Infortis/ultimo
bin/magento maintenance:disable
bin/magento cache:enable
```

If you have problems with these commands, please check the [detailed instruction](https://mage2.pro/t/263).
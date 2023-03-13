<?
namespace ST\PayRestrictFunctions;

//use Bitrix\Sale\PaySystem\Restrictions;
use Bitrix\Sale\Services\Base;
use Bitrix\Sale\Internals\Entity;
use Bitrix\Sale\Payment;

class PayWithBonusesRestrict extends Base\Restriction
{
    public static function getClassTitle()
    {
        return 'при оплате бонусами';
    }

    public static function getClassDescription()
    {
        return 'оплата не будет выводиться, если пользователь использует бонусы';
    }

    public static function check($bonuses, array $restrictionParams, $deliveryId = 0)
    {
        if (!empty($bonuses) && intval($bonuses) > 0)
        {
            return false;
        }

        return true;
    }

    protected static function extractParams(Entity $entity)
    {
        if ($entity instanceof Payment) {
            /** @var PaymentCollection $collection */
            $collection = $entity->getCollection();
            /** @var Order $order */
            $order = $collection->getOrder();

            $propertyCollection = $order->getPropertyCollection();

            $propertyValue = $propertyCollection->getItemByOrderPropertyCode('BONUSES');

            return  empty($propertyValue) ? null : $propertyValue->getField('VALUE');
        }

        return null;
    }

    public static function getParamsStructure($entityId = 0)
    {
        return array(
            "APPLY" => array(
                'TYPE' => 'Y/N',
                'DEFAULT' => 'Y',
                'LABEL' => 'Применить'
            )
        );
    }
}

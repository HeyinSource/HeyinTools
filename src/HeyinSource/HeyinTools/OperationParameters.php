<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 11:13
 */

namespace HeyinSource\HeyinTools;

use app\librarys\DbCacheUtility;
use app\models\Manager;
use app\models\System;

use HeyinSource\HeyinTools\Tools;

/**
 * @description 运行参数专用类
 * Class OperationParameters
 * @package app\models
 */
class OperationParameters
{
    /**
     * @description 1、客户账额到期单位
     * @return mixed
     * @deprecated
     */
    public static function getCustomerAccountDay()
    {
        $dic_value = self::baseSql('CustomerAccountDay');
        return $dic_value;
    }

    /**
     * @description 2、对账时，是否能查看某客户在其他门店的订单
     * @return mixed
     */
    public static function getIsAllowCustomerOtherLeagueOrder()
    {
        $dic_value = self::baseSql('isAllowCustomerOtherLeagueOrder');
        return $dic_value;
    }

    /**
     * @description 3、是否显示其他门店的客户地址
     * @return mixed
     */
    public static function getIsDisplayOtherShopCustomerAddress()
    {
        $dic_value = self::baseSql('IsDisplayOtherShopCustomerAddress');
        return $dic_value;
    }

    /**
     * @description 4、客户汇总中，是否能查看某客户在其它门店的消费信息
     * @return mixed
     */
    public static function getIsDisplayOtherShopCustomerConsumptionDetails()
    {
        $dic_value = self::baseSql('IsDisplayOtherShopCustomerConsumptionDetails');
        return $dic_value;
    }

    /**
     * @description 5、是否允许使用其他门店的客户开单
     * @return mixed
     */
    public static function getIsOtherLeagueCustomerCreateOrder()
    {
        $dic_value = self::baseSql('IsOtherLeagueCustomerCreateOrder');
        return $dic_value;
    }

    /**
     * @description 5、是否允许使用其他门店的客户开单 机构id
     * @param $league_id
     * @return string
     */
    public static function getIsOtherLeagueCustomerCreateOrderByLeagueId($league_id)
    {
        $dic_value = self::baseSqlByLeagueId('IsOtherLeagueCustomerCreateOrder',$league_id);
        return $dic_value;
    }


    /**
     * @description 6、设置默认客户
     * @return mixed
     */
    public static function getDefaultCustomerID()
    {
        $dic_value = self::baseSql('DefaultCustomerID');
        return $dic_value;
    }

    /**
     * @description 7、是否显示其它门店的客户联系方式
     * @return mixed
     */
    public static function getIsDisplayOtherShopCustomerContacts()
    {
        $dic_value = self::baseSql('IsDisplayOtherShopCustomerContacts');
        return $dic_value;
    }


    /**
     * @description 7、是否显示其它门店的客户联系方式
     * @return mixed
     */
    public static function getIsDisplayOtherShopCustomerContactsByLeagueId($league_id)
    {
        $dic_value = self::baseSqlByLeagueId('IsDisplayOtherShopCustomerContacts',$league_id);
        return $dic_value;
    }


    /**
     * @description 8、客户汇总是否能查看其他门店的客户
     * @return mixed
     */
    public static function getIsUseOtherCustomer()
    {
        $dic_value = self::baseSql('IsUseOtherCustomer');
        return $dic_value;
    }

    /**
     * @description 9、是否允许会员卡跨店充值
     * @return mixed
     */
    public static function getIsAllowVIPCardCrossCharge()
    {
        $dic_value = self::baseSql('IsAllowVIPCardCrossCharge');
        return $dic_value;
    }

    /**
     * @description 10、会员卡充值小票打印张数
     * @return mixed
     */
    public static function getVIPPrintNumber()
    {
        $dic_value = self::baseSql('VIPPrintNumber');
        return $dic_value;
    }

    /**
     * @description 11、连锁门店、合资门店是否共享会员卡活动
     * @return mixed
     */
    public static function getIsPublicVIPCardRule()
    {
        $dic_value = self::baseSql('IsPublicVIPCardRule');
        return $dic_value;
    }

    /**
     * @description 12、是否展示非本门店的会员卡
     * @return mixed
     */
    public static function getIsShowOtherShopVIPCard()
    {
        $dic_value = self::baseSql('IsShowOtherShopVIPCard');
        return $dic_value;
    }

    /**
     * @description 13、会员卡充值打印小票是否显示赠送金额
     * @return mixed
     */
    public static function getIsShowWateredAmountByVIPPrint()
    {
        $dic_value = self::baseSql('IsShowWateredAmountByVIPPrint');
        return $dic_value;
    }

    /**
     * @description 14、是否允许会员卡在其他类型门店（连锁类型、合资类型）充值
     * @return mixed
     */
    public static function getIsAllowLeagueTypeVIPCardRecharge()
    {
        $dic_value = self::baseSql('IsAllowLeagueTypeVIPCardRecharge');
        return $dic_value;
    }

    /**
     * @description 15、是否打印自定义会员卡充值凭证
     * @return mixed
     */
    public static function getIsVIPPrintCustomInvoice()
    {
        $dic_value = self::baseSql('IsVIPPrintCustomInvoice');
        return $dic_value;
    }

    /**
     * @description 16、是否允许打印会员卡充值小票
     * @return mixed
     */
    public static function getIsPrintVIPCardCharge()
    {
        $dic_value = self::baseSql('IsPrintVIPCardCharge');
        return $dic_value;
    }

    /**
     * @description 17、会员卡余额不足时是否提示
     * @return mixed
     */
    public static function getIsPromptVIPCarBalance()
    {
        $dic_value = self::baseSql('IsPromptVIPCarBalance');
        return $dic_value;
    }

    /**
     * @description 18、报废单责任人承担比例
     * @return mixed
     */
    public static function getOrderScrapBearPercent()
    {
        $dic_value = self::baseSql('OrderScrapBearPercent');
        return $dic_value;
    }

    /**
     * @description 19、是否可用非本门店会员卡
     * @return mixed
     * @deprecated
     */
    public static function getIsAllowOtherShopVIPCard()
    {
        $dic_value = self::baseSql('IsAllowOtherShopVIPCard');
        return $dic_value;
    }

    /**
     * @description 20、会员卡积分有效月数
     * @return mixed
     */
    public static function getVIPCardIntegralExpiryMonth()
    {
        $dic_value = self::baseSql('VIPCardIntegralExpiryMonth');
        return $dic_value;
    }

    /**
     * @description 21、是否启用会员卡消费集积分
     * @return mixed
     * @deprecated
     */
    public static function getIsEnableVIPCardConsumeIntegral()
    {
        $dic_value = self::baseSql('IsEnableVIPCardConsumeIntegral');
        return $dic_value;
    }

    /**
     * @description 22、会员卡消费金额与积分兑换比例
     * @return mixed
     * @deprecated
     */
    public static function getVIPCardConsumeIntegralRatio()
    {
        $dic_value = self::baseSql('VIPCardConsumeIntegralRatio');
        return $dic_value;
    }

    /**
     * @description 23、绩效确认时间
     * @return mixed
     * @deprecated
     */
    public static function getPerformanceConfirmTime()
    {
        $dic_value = self::baseSql('PerformanceConfirmTime');
        return $dic_value;
    }

    /**
     * @description 24、订单/销账多收金额操作
     * @return mixed
     */
    public static function getIsIntoCustomerCardAmount()
    {
        $dic_value = self::baseSql('IsIntoCustomerCardAmount');
        return $dic_value;
    }

    /**
     * @description 25、绩效生效时间
     * @return mixed
     */
    public static function getPerformanceEffectTime()
    {
        $dic_value = self::baseSql('PerformanceEffectTime');
        return $dic_value;
    }

    /**
     * @description 26、订单文件目录存储结构
     * @return mixed
     */
    public static function getOrderFileFolder()
    {
        $dic_value = self::baseSql('OrderFileFolder');
        return $dic_value;
    }

    /**
     * @description 27、订单锁定多收金额操作方案
     * @return mixed
     * @deprecated
     */
    public static function getOrderAuditIntoCustomerCardAmountType()
    {
        $dic_value = self::baseSql('OrderAuditIntoCustomerCardAmountType');
        return $dic_value;
    }

    /**
     * @description 28、订单结算时是否发送短信
     * @return mixed
     */
    public static function getIsSendSmsByVIPOrderSettlement()
    {
        $dic_value = self::baseSql('IsSendSmsByVIPOrderSettlement');
        return $dic_value;
    }

    /**
     * @description 29、是否自动延长交付时间
     * @return mixed
     */
    public static function getIsAutoDeliveryTime()
    {
        $dic_value = self::baseSql('IsAutoDeliveryTime');
        return $dic_value;
    }

    /**
     * @description 30、是否允许修改订单金额
     * @return mixed
     * @deprecated
     */
    public static function getIsChangeOrderAmount()
    {
        $dic_value = self::baseSql('IsChangeOrderAmount');
        return $dic_value;
    }

    /**
     * @description 31、交付时间增加(小时)
     * @return mixed
     */
    public static function getDeliveryTime()
    {
        $dic_value = self::baseSql('DeliveryTime');
        return $dic_value;
    }

    /**
     * @description 32、是否启用记账订单送审流程
     * @return mixed
     * @deprecated
     */
    public static function getIsKeepAccountingAudit()
    {
        $dic_value = self::baseSql('IsKeepAccountingAudit');
        return $dic_value;
    }

    /**
     * @description 33、订单“项目”项是否必须输入
     * @return mixed
     */
    public static function getIsProjectFinished()
    {
        $dic_value = self::baseSql('IsProjectFinished');
        return $dic_value;
    }

    /**
     * @description 34、是否限制员工绩效超过100%
     * @return mixed
     */
    public static function getIsLimitPerformanceOvertop()
    {
        $dic_value = self::baseSql('IsLimitPerformanceOvertop');
        return $dic_value;
    }

    /**
     * @description 35、是否允许红冲作废进入生产状态的订单
     * @return mixed
     * @deprecated
     */
    public static function getIsCanWriteBackObsoleteProducedOrder()
    {
        $dic_value = self::baseSql('IsCanWriteBackObsoleteProducedOrder');
        return $dic_value;
    }

    /**
     * @description 36、是否允许多次生成对账单
     * @return mixed
     */
    public static function getIsAllowMoreOrderSettlement()
    {
        $dic_value = self::baseSql('IsAllowMoreOrderSettlement');
        return $dic_value;
    }

    /**
     * @description 37、开单时是否允许自动新建客户
     * @return mixed
     */
    public static function getIsNewCustomerByOrder()
    {
        $dic_value = self::baseSql('IsNewCustomerByOrder');
        return $dic_value;
    }

    /**
     * @description 38、是否限制员工折扣额度
     * @return mixed
     */
    public static function getIsLimitEmployeeDiscount()
    {
        $dic_value = self::baseSql('IsLimitEmployeeDiscount');
        return $dic_value;
    }

    /**
     * @description 39、是否允许修改开单的销售代表
     * @return mixed
     */
    public static function getIsUpdateOrderSaleBy()
    {
        $dic_value = self::baseSql('IsUpdateOrderSaleBy');
        return $dic_value;
    }

    /**
     * @description 40、订单文件路径，是否自动默认填写上个订单路径
     * @return mixed
     */
    public static function getIsAutoOrderFilePath()
    {
        $dic_value = self::baseSql('IsAutoOrderFilePath');
        return $dic_value;
    }

    /**
     * @description 41、收货地址是否默认为客户地址
     * @return mixed
     */
    public static function getIsCustomerAddress()
    {
        $dic_value = self::baseSql('IsCustomerAddress');
        return $dic_value;
    }

    /**
     * @description 42、开单时是否需要验证手机号码格式
     * @return mixed
     */
    public static function getIsCheckOrderPhone()
    {
        $dic_value = self::baseSql('IsCheckOrderPhone');
        return $dic_value;
    }

    /**
     * @description 43、是否完工后才允许收款
     * @return mixed
     */
    public static function getIsLimitOrderFinishedReceipt()
    {
        $dic_value = self::baseSql('IsLimitOrderFinishedReceipt');
        return $dic_value;
    }

    /**
     * @description 44、保存订单，经营项目单价为0的是否提示
     * @return mixed
     */
    public static function getIsPromptBusinessPartAmountZero()
    {
        $dic_value = self::baseSql('IsPromptBusinessPartAmountZero');
        return $dic_value;
    }

    /**
     * @description 45、保存订单，经营项目数量为0的是否提示
     * @return mixed
     */
    public static function getIsPromptBusinessPartQtyZero()
    {
        $dic_value = self::baseSql('IsPromptBusinessPartQtyZero');
        return $dic_value;
    }

    /**
     * @description 46、最大抹零金额
     * @return mixed
     */
    public static function getMaxIgnoreAmount()
    {
        $dic_value = self::baseSql('MaxIgnoreAmount');
        return Tools::numberFormatForMostTowPoint($dic_value);
    }

    /**
     * @description 47、修改订单时是否允许修改客户及会员卡
     * @return mixed
     */
    public static function getIsChangeCustomerByOrder()
    {
        $dic_value = self::baseSql('IsChangeCustomerByOrder');
        return $dic_value;
    }

    /**
     * @description 48、订单金额为0时是否允许锁定
     * @return mixed
     */
    public static function getIsOrderAmountZero()
    {
        $dic_value = self::baseSql('IsOrderAmountZero');
        return $dic_value;
    }

    /**
     * @description 49、是否允许修改已经生效的绩效
     * @return mixed
     */
    public static function getIsUpdatePerformanceEffect()
    {
        $dic_value = self::baseSql('IsUpdatePerformanceEffect');
        return $dic_value;
    }

    /**
     * @description 50、是否允许打印订单收款小票
     * @return mixed
     */
    public static function getIsPrintOrderSettlement()
    {
        $dic_value = self::baseSql('IsPrintOrderSettlement');
        return $dic_value;
    }

    /**
     * @description 51、订单完工后是否允许修改订单生产状态
     * @return mixed
     */
    public static function getIsEditProduceStatusByOrderFinished()
    {
        $dic_value = self::baseSql('IsEditProduceStatusByOrderFinished');
        return $dic_value;
    }

    /**
     * @description 52、订单完工时是否发送短信
     * @return mixed
     */
    public static function getIsSendSmsByVIPOrderCompleted()
    {
        $dic_value = self::baseSql('IsSendSmsByVIPOrderCompleted');
        return $dic_value;
    }

    /**
     * @description 53、订单中经营项目金额为0时是否允许收款
     * @return mixed
     */
    public static function getIsBusinessPartAmountZero()
    {
        $dic_value = self::baseSql('IsBusinessPartAmountZero');
        return $dic_value;
    }

    /**
     * @description 54、订单收款后，是否打印报价单
     * @return mixed
     */
    public static function getIsPrintOrderReportAfterSettlement()
    {
        $dic_value = self::baseSql('IsPrintOrderReportAfterSettlement');
        return $dic_value;
    }

    /**
     * @description 55、订单“要求”项是否必须输入
     * @return mixed
     */
    public static function getIsRequiredOrderRequire()
    {
        $dic_value = self::baseSql('IsRequiredOrderRequire');
        return $dic_value;
    }

    /**
     * @description 56、扎帐周期（天）
     * @return mixed
     */
    public static function getPitchAccountDay()
    {
        $dic_value = self::baseSql('PitchAccountDay');
        return $dic_value;
    }

    /**
     * @description 57、是否允许修改销售单价为0的经营项目单价
     * @return mixed
     */
    public static function getIsChangeBusinessPartPriceByZero()
    {
        $dic_value = self::baseSql('IsChangeBusinessPartPriceByZero');
        return $dic_value;
    }

    /**
     * @description 58、是否启用自动生成订单文件目录
     * @return mixed
     */
    public static function getIsEnableAutoOrderFileFolder()
    {
        $dic_value = self::baseSql('IsEnableAutoOrderFileFolder');
        return $dic_value;
    }

    /**
     * @description 59、客户销账是否允许有折扣
     * @return mixed
     */
    public static function getIsAccountingCustomerAllowDiscount()
    {
        $dic_value = self::baseSql('IsAccountingCustomerAllowDiscount');
        return $dic_value;
    }

    /**
     * @description 60、订单临近交付时间多少分钟内提醒,默认30分钟
     * @return mixed
     */
    public static function getOrderDeliveryTimeForMessage()
    {
        $dic_value = self::baseSql('OrderDeliveryTimeForMessage');
        if ($dic_value == '') {
            $dic_value = 30;
        }
        return $dic_value;
    }

    /**
     * @description 61、是否共享DIY自定义模板
     * @return mixed
     */
    public static function getIsShareDIYTemp()
    {
        $dic_value = self::baseSql('IsShareDIYTemp');
        return $dic_value;
    }

    /**
     * @description 62、是否开启微信推送
     * @return mixed
     */
    public static function getIsWeChatPush()
    {
        $dic_value = self::baseSql('IsWeChatPush');
        return $dic_value;
    }

    /**
     * @description 保存订单，经营项目销售单价低于限价时，是否允许保存订单(是：允许；否：不允许。系统默认不允许)
     * @return mixed
     */
    public static function getIsAllowSaveOrderByFloorPrice()
    {
        $dic_value = self::baseSql('IsAllowSaveOrderByFloorPrice');
        return $dic_value;
    }

    /**
     * 订单开票时，是否允许给他门店的订单开票
     * @return mixed
     */
    public static function getIsAllowOrderReceiptOtherLeagueOrder()
    {
        $dic_value = self::baseSql('isAllowOrderReceiptOtherLeagueOrder');
        return $dic_value;
    }

    /**
     * 订单锁定解锁，自动扣减库存
     * @return mixed
     */
    public static function getOrderAuditAutoChangeStock()
    {
        $dic_value = self::baseSql('OrderAuditAutoChangeStock');
        return $dic_value;
    }

    /**
     * 客户应收，是否可以查看其它门店客户
     * @return mixed
     */
    public static function getIsCustomerReceivableDisplayOtherShopCustomerInfo()
    {
        $dic_value = self::baseSql('IsCustomerReceivableDisplayOtherShopCustomerInfo');
        return $dic_value;
    }

    /**
     * 客户应收，是否只统计在本店消费的应收款
     * @return mixed
     */
    public static function getIsCustomerReceivableSummaryOtherShopReceivables()
    {
        $dic_value = self::baseSql('IsCustomerReceivableSummaryOtherShopReceivables');
        return $dic_value;
    }

    /**
     * 合同临近到期提示
     * @return mixed
     */
    public static function getContractExpire()
    {
        $dic_value = self::baseSql('ContractExpire');
        return $dic_value;
    }

    /**
     * 会员卡充值金额是否需要手动激活
     * @return mixed
     */
    public static function getVipCardRechargeActivateByManu()
    {
        $dic_value = self::baseSql('VipCardRechargeActivateByManu');
        return $dic_value;
    }

    /**
     * 客户储值会员卡有余额时，是否可以销卡
     * @return mixed
     */
    public static function getIsVipCardWasteWithinBalance()
    {
        $dic_value = self::baseSql('IsVipCardWasteWithinBalance');
        return $dic_value;
    }

    /**
     * 记账客户合同到期日到期后，该客户新开订单是否允许记账
     * @return mixed
     */
    public static function getIsKeepOrderContractExpires()
    {
        $dic_value = self::baseSql('IsKeepOrderContractExpires');
        return $dic_value;
    }

    /**
     * 记账客户合同到期日到期后，该客户新开订单是否允许记账
     * @return mixed
     */
    public static function getIsKeepOrderContractExpiresByLeagueId($league_id)
    {
        $dic_value = self::baseSqlByLeagueId('IsKeepOrderContractExpires',$league_id);
        return $dic_value;
    }

    /**
     * @deprecated
     * 是否必填订单经营项目设备和物料
     * @return mixed
     */
    public static function getIsRequireOrderMaterialEquipment()
    {
        $dic_value = self::baseSql('IsRequireOrderMaterialEquipment');
        return $dic_value;
    }

    /**
     * 是否必填订单经营项目物料
     * @return mixed
     */
    public static function getIsRequireOrderMaterial()
    {
        $dic_value = self::baseSql('IsRequireOrderMaterial');
        return $dic_value;
    }

    /**
     * 是否必填订单经营项目设备
     * @return mixed
     */
    public static function getIsRequireOrderEquipment()
    {
        $dic_value = self::baseSql('IsRequireOrderEquipment');
        return $dic_value;
    }

    /**
     * 订单开单时，是否允许直接选择内协客户开单
     * @return mixed
     */
    public static function getIsAllowInternalSourcingCustomerBilling()
    {
        $dic_value = self::baseSql('IsAllowInternalSourcingCustomerBilling');
        return $dic_value;
    }
//    ---------------------------------------------------------------------仓库-----------------------------------------------------------------------------------------------------

    /**
     * @description 62、调拨单是否需要审核
     * @return mixed
     */
    public static function getIsStockAllocateNeedAudit()
    {
        $dic_value = self::baseSql('IsStockAllocateNeedAudit');
        return $dic_value;
    }

    /**
     * @description 63、调拨单是否需要集团审核
     * @return mixed
     */
    public static function getIsStockAllocateNeedLeagueAudit()
    {
        $dic_value = self::baseSql('IsStockAllocateNeedLeagueAudit');
        return $dic_value;
    }

    //----------------------------------------------------积分------------------------------------------------------------------------------------------

    /**
     * 积分过期规则
     * @return mixed
     */
    public static function getIntegralExpiryRule()
    {
        $dic_value = self::baseSql('IntegralExpiryRule');
        return $dic_value;
    }

    /**
     * 会员卡积分礼品兑换比
     * @return mixed
     */
    public static function getVIPCardIntegralGiftRatio()
    {
        $dic_value = self::baseSql('VIPCardIntegralGiftRatio');
        return $dic_value;
    }

    /**
     * 现结客户积分礼品兑换比
     * @return mixed
     */
    public static function getReceiptsIntegralGiftRatio()
    {
        $dic_value = self::baseSql('ReceiptsIntegralGiftRatio');
        return $dic_value;
    }

    /**
     * 现结客户消费积分产生比例
     * @return mixed
     */
    public static function getReceiptsIntegralRatio()
    {
        $dic_value = self::baseSql('ReceiptsIntegralRatio');
        return $dic_value;
    }

    /**
     * 是否启用现结客户消费积分
     * @return mixed
     */
    public static function getIsEnableReceiptsIntegral()
    {
        $dic_value = self::baseSql('IsEnableReceiptsIntegral');
        return $dic_value;
    }

    /**
     * 记账客户积分礼品兑换比
     * @return mixed
     */
    public static function getKeepAccountingIntegralGiftRatio()
    {
        $dic_value = self::baseSql('KeepAccountingIntegralGiftRatio');
        return $dic_value;
    }

    /**
     * 记账客户消费积分产生比例
     * @return mixed
     */
    public static function getKeepAccountingIntegralRatio()
    {
        $dic_value = self::baseSql('KeepAccountingIntegralRatio');
        return $dic_value;
    }

    /**
     * 是否启用记账客户消费积分
     * @return mixed
     */
    public static function getIsEnableKeepAccountingIntegral()
    {
        $dic_value = self::baseSql('IsEnableKeepAccountingIntegral');
        return $dic_value;
    }

    /**
     * 记账订单消费积分产生规则
     * @return mixed
     */
    public static function getKeepAccountingIntegralRule()
    {
        $dic_value = self::baseSql('KeepAccountingIntegralRule');
        return $dic_value;
    }

    /**
     * 会员卡年费续费有效期
     * @return mixed
     */
    public static function getVIPAnnualCard()
    {
        $dic_value = self::baseSql('VIPAnnualCard');
        return $dic_value;
    }

    /**
     * 会员卡默认密码
     * @return mixed
     */
    public static function getCustomVIPCardPassword()
    {
        $dic_value = self::baseSql('CustomVIPCardPassword');
        return $dic_value;
    }

    /**
     * 客户对应分组价设置是否限制一个分组
     * @return mixed
     */
    public static function getIsCustomerGroupPriceSettingLimitOneGroup()
    {
        $dic_value = self::baseSql('IsCustomerGroupPriceSettingLimitOneGroup');
        return $dic_value;
    }

    /**
     * 客户回款周期锁定
     * @return mixed
     */
    public static function getCustomerPaybackCycleLock()
    {
        $dic_value = self::baseSql('CustomerPaybackCycleLock');
        return $dic_value;
    }

    /**
     * 客户回款周期
     * @return mixed
     */
    public static function getCustomerPaymentCollectionCycle()
    {
        $dic_value = self::baseSql('CustomerPaymentCollectionCycle');
        return $dic_value;
    }

    /**
     * 记账客户合同更改时，是否更新该客户的【记账合同到期日】
     * @return mixed
     */
    public static function getIsUpdateKeepingAccountExpireDate()
    {
        $dic_value = self::baseSql('IsUpdateKeepingAccountExpireDate');
        return $dic_value;
    }

    /**
     * 会员卡新卡消费是否限制消费
     * @return mixed
     */
    public static function getNewVipCardIsKeepOrderSettlement()
    {
        $dic_value = self::baseSql('NewVipCardIsKeepOrderSettlement');
        return $dic_value;
    }

    /**
     * 会员卡新卡消费最大百分比（1-100）
     * @return mixed
     */
    public static function getNewVipCardKeepOrderSettlementPercentage()
    {
        $dic_value = self::baseSql('NewVipCardKeepOrderSettlementPercentage');
        return $dic_value;
    }
    //----------------------------------------------------外协单------------------------------------------------------------------------------------------

    /**
     * 订单结算后，是否允许发送外协单(是：允许；否：不允许。系统默认不允许。当允许发外协单时，外协单完工不能回发经营项目)
     * @return mixed
     */
    public static function getIsAllowAddOutSourcingBySettlement()
    {
        $dic_value = self::baseSql('IsAllowAddOutSourcingBySettlement');
        return $dic_value;
    }

    /**
     * 订单生产流程为完工、物流、结单时，是否允许发送外协单
     * @return mixed
     */
    public static function getIsAllowAddOutSourcingByOrderFinish()
    {
        $dic_value = self::baseSql('IsAllowAddOutSourcingByOrderFinish');
        return $dic_value;
    }

    /**
     * 外协单未完工时，是否允许订单结算（包括挂账）
     * @return mixed
     */
    public static function getIsAllowSettlementByOutSourcingNonFinish()
    {
        $dic_value = self::baseSql('IsAllowSettlementByOutSourcingNonFinish');
        return $dic_value;
    }

    /**
     * 外协单完工后是否回发建议销售价
     * @return mixed
     */
    public static function getIsSendBackReferenceSalesPriceWhenFinish()
    {
        $dic_value = self::baseSql('IsSendBackReferenceSalesPriceWhenFinish');
        return $dic_value;
    }

    /**
     * 【外协供应商】【记账周期】为【记账】时，【外协单】是否允许【直接付款】
     * @return mixed
     */
    public static function getIsAllowOutSourcingSettlementBySupplierSettlementType()
    {
        $dic_value = self::baseSql('IsAllowOutSourcingSettlementBySupplierSettlementType');
        return $dic_value;
    }

    /**
     * 是否允许修改或移除外协经营项目
     * @return mixed
     */
    public static function getIsAllowRemoveOrderOutSourcingBusinessPart()
    {
        $dic_value = self::baseSql('IsAllowRemoveOrderOutSourcingBusinessPart');
        return $dic_value;
    }

    /**
     * 配置【报价单打印】中【要求】显示字数
     * @return mixed
     */
    public static function getSaleOrderPrintSubstrRequireSize()
    {
        $dic_value = self::baseSql('SaleOrderPrintSubstrRequireSize');
        return $dic_value;
    }
//--------------------------------------------------------------郭大侠的参数---------------------------------------------

    /**
     * 安全等级
     * @return mixed
     */
    public static function getSafetyLeavel()
    {
        $dic_value = self::baseSql('SafetyLeavel');
        return $dic_value;
    }

    /**
     * 验证间隔天数
     * @return mixed
     */
    public static function getValidationIntervalDay()
    {
        $dic_value = self::baseSql('ValidationIntervalDay');
        return $dic_value;
    }

    /**
     * 绩效生效前是否提示绩效未录完
     * @return mixed
     */
    public static function getIsPerformanceTips()
    {
        $dic_value = self::baseSql('IsPerformanceTips');
        return $dic_value;
    }
//--------------------------------------------------------------系统参数---------------------------------------------

    /**
     * 单号规则
     * @return mixed
     */
    public static function getSystemCodeRule()
    {
        $dic_value = self::baseSql('SystemCodeRule');
        return $dic_value;
    }

    /**
     * 客户单号规则
     * @return mixed
     */
    public static function getSystemCustomerCodeRule()
    {
        $dic_value = self::baseSql('SystemCustomerCodeRule');
        return $dic_value;
    }

    /**
     * 是否将绩效自动分配给当前操作员
     * @return mixed
     */
    public static function getIsAutoPerformanceOperator()
    {
        $dic_value = self::baseSql('IsAutoPerformanceOperator');
        return $dic_value;
    }

    /**
     * 订单结算时，会员卡订单是否允许优惠抹零
     * @return mixed
     */
    public static function getIsAllowVIPOrderSettlementDiscount()
    {
        $dic_value = self::baseSql('IsAllowVIPOrderSettlementDiscount');
        return $dic_value;
    }

    /**
     * 订单结算时，会员卡订单是否允许部分结算
     * @return mixed
     */
    public static function getIsAllowVIPOrderPartSettlement()
    {
        $dic_value = self::baseSql('IsAllowVIPOrderPartSettlement');
        return $dic_value;
    }

    /**
     * 是否开启客户单号规则
     * @return mixed
     */
    public static function getIsSystemCustomerCodeRule()
    {
        $dic_value = self::baseSql('IsSystemCustomerCodeRule');
        return $dic_value;
    }

    /**
     *  客户预收时，是否打印预收充值凭证
     * @return mixed
     */
    public static function getIsPrintCustomerCardRechargeInvoice()
    {
        $dic_value = self::baseSql('IsPrintCustomerCardRechargeInvoice');
        return $dic_value;
    }

    /**
     * 客户预存余额，是否允许客户跨门店扣费
     * @return mixed
     */
    public static function getIsOtherLeagueCustomerCardPay()
    {
        $dic_value = self::baseSql('IsOtherLeagueCustomerCardPay');
        return $dic_value;
    }

    /**
     * 记账订单挂账时，是否允许优惠抹零
     * @return mixed
     */
    public static function getIsAllowDiscountErasureForBookkeepingOrder()
    {
        $dic_value = self::baseSql('IsAllowDiscountErasureForBookkeepingOrder');
        return $dic_value;
    }

    /**
     * 是否开启单号破折号规则
     * @return mixed
     */
    public static function getIsSystemCodeDash()
    {
        $dic_value = self::baseSql('IsSystemCodeDash');
        return $dic_value;
    }

    /**
     * 是否允许内协录入绩效配置
     * @return mixed
     */
    public static function getIsInternalSourcingSetPerformance()
    {
        $dic_value = self::baseSql('IsInternalSourcingSetPerformance');
        return $dic_value;
    }

    /**
     * 是否允许外协录入绩效配置
     * @return mixed
     */
    public static function getIsOutSourcingSetPerformance()
    {
        $dic_value = self::baseSql('IsOutSourcingSetPerformance');
        return $dic_value;
    }



//-----------------------------------------------------------------------------------------------------------------------------------------------

    /**
     * 报销单申请时，【备注】输入项是否必须填写
     * @return mixed
     */
    public static function getIsMustInputForReimbursementDescription()
    {
        $dic_value = self::baseSql('IsMustInputForReimbursementDescription');
        return $dic_value;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------

    /**
     * 订单是否【锁定】后才允许打印报价单。
     * @return mixed
     */
    public static function getIsPrintSaleAfterOrderLocking()
    {
        $dic_value = self::baseSql('IsPrintSaleAfterOrderLocking');
        return $dic_value;
    }

    /**
     * 红冲订单是否必须复制订单
     * @return mixed
     */
    public static function getIsWriteOffOrderIsCopy()
    {
        $dic_value = self::baseSql('IsWriteOffOrderIsCopy');
        return $dic_value;
    }

    /**
     * 加长倍率步长
     * @return mixed
     */
    public static function getExtendedMagnificationBaseStep()
    {
        $dic_value = self::baseSql('ExtendedMagnificationBaseStep');
        return $dic_value;
    }

    /**
     * 加长倍率步长
     * @param $league_id string 门店id
     * @return string
     */
    public static function getExtendedMagnificationBaseStepLeagueId($league_id)
    {
        $dic_value = self::baseSqlByLeagueId('ExtendedMagnificationBaseStep',$league_id);
        return $dic_value;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------

    /**
     * 外协单，交货日期是否必须输入
     * @return mixed
     */
    public static function getIsMustInputOutSourcingArrivalTime()
    {
        $dic_value = self::baseSql('IsMustInputOutSourcingArrivalTime');
        if ($dic_value == '') {
            $dic_value = 1;
        }
        return $dic_value;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------


    /**
     * 外协付款默认付款方式
     * @return mixed
     */
    public static function getDefaultOutSourcingPaymentMode()
    {
        return self::baseSql('DefaultOutSourcingPaymentMode');
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------


    /**
     * 银行账户是否必须选择 [业务收款、业务付款时，银行账户必选配置项。]
     * @return mixed
     */
    public static function getIsMustSelectByBankAccount()
    {
        return self::baseSql('IsMustSelectByBankAccount');
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------


    /**
     * 运行参数基础的查询语句
     * @param $dic_id
     * @return mixed
     */
    private static function baseSql($dic_id)
    {
        $manager_league_id = Manager::getCurrentDataCreateByLeagueId();
        $sql = 'SELECT id,dic_value,dic_defaule_value FROM t_system_dictionary WHERE dic_id=:dic_id AND dic_type = 1 AND create_by_league_id=\'0\'';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':dic_id', $dic_id);
        $parameter = DbCacheUtility::queryOne($cmd);
        if (empty($parameter)) {
            $dic_value = '';
        } else {
            $dic_value_by_league = System::getSystemParametersByLeague($manager_league_id, $parameter['id']);
            if (empty($dic_value_by_league)) {
                if ($parameter['dic_value'] != '') {
                    $dic_value = $parameter['dic_value'];
                } else {
                    $dic_value = $parameter['dic_defaule_value'];
                }
            } else {
                $dic_value = $dic_value_by_league['dic_value'];
            }
        }
        return $dic_value;
    }


    private static function baseSqlByLeagueId($dic_id,$league_id)
    {
        $sql = 'SELECT id,dic_value,dic_defaule_value FROM t_system_dictionary WHERE dic_id=:dic_id AND dic_type = 1 AND create_by_league_id=\'0\'';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':dic_id', $dic_id);
        $parameter = DbCacheUtility::queryOne($cmd);
        if (empty($parameter)) {
            $dic_value = '';
        } else {
            $dic_value_by_league = System::getSystemParametersByLeagueId($league_id, $parameter['id']);
            if (empty($dic_value_by_league)) {
                if ($parameter['dic_value'] != '') {
                    $dic_value = $parameter['dic_value'];
                } else {
                    $dic_value = $parameter['dic_defaule_value'];
                }
            } else {
                $dic_value = $dic_value_by_league['dic_value'];
            }
        }
        return $dic_value;
    }

    /**
     * get params id
     * @param $dic_id
     * @return string
     * @throws \app\exceptions\ManagerInvalidException
     */
    private static function getParamsId($dic_id)
    {
        $manager_league_id = Manager::getCurrentDataCreateByLeagueId();
        $sql = 'SELECT id,dic_value,dic_defaule_value FROM t_system_dictionary WHERE dic_id=:dic_id AND dic_type = 1 AND create_by_league_id=\'0\'';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':dic_id', $dic_id);
        $parameter = DbCacheUtility::queryOne($cmd);
        if (empty($parameter)) {
            $params_id = '999';
        } else {
            $dic_value_by_league = System::getSystemParametersByLeague($manager_league_id, $parameter['id']);
            if (empty($dic_value_by_league)) {
                if ($parameter['id'] != '') {
                    $params_id = $parameter['id'];
                } else {
                    $params_id = '999';
                }
            } else {
                $params_id = $dic_value_by_league['system_dictionary_id'];
            }
        }
        return $params_id;
    }

    /**
     * set operation params
     * @param $dic_value
     * @param $dic_id
     * @return int|string
     * @throws \app\exceptions\ManagerInvalidException
     */
    private static function setOperationParams($dic_value, $dic_id)
    {
        $params_id = self::getParamsId($dic_id);
        $current_manager_id = Manager::getCurrentDataCreateByLeagueId();
        $time = Tools::getDbNowTime();
        try {
            $update_by = Manager::getCurrentManagerId();
            $update_by_name = Manager::getCurrentManagerName();
            $modify_by_league_id = Manager::getCurrentDataModifyByLeagueId();
            if ($current_manager_id != '0') {
                $parameter_of_league = System::getSystemParametersByLeague($current_manager_id, $params_id);
                if (!empty($parameter_of_league) && $current_manager_id == $parameter_of_league['league_id']) {
                    System::updateSystemDictionaryLeagueValueRelation([
                        'dic_value' => $dic_value,
                        'update_by' => $update_by,
                        'update_by_name' => $update_by_name,
                        'id' => $params_id,
                    ], $current_manager_id);
                } else {
                    System::insertSystemDictionaryLeagueValueRelation([
                        'dic_value' => $dic_value,
                        'update_by' => $update_by,
                        'update_by_name' => $update_by_name,
                        'id' => $params_id,
                    ], $current_manager_id);
                }
            } else {
                $sql = 'UPDATE t_system_dictionary SET
                    dic_value=:DicValue,
                    update_by=:UpdateBy,
                    update_time=:UpdateTime,
                    modify_by_league_id=:ModifyByLeagueID
                    WHERE
                    (
                    `id` = :ID
                    )';
                $cmd = \Yii::$app->db->createCommand($sql);
                $cmd->bindValue(':DicValue', $dic_value);
                $cmd->bindValue(':UpdateBy', $update_by);
                $cmd->bindValue(':UpdateTime', $time);
                $cmd->bindValue(':ModifyByLeagueID', $modify_by_league_id);
                $cmd->bindValue(':ID', $params_id);
                DbCacheUtility::execute($cmd);
            }
            $status = 0;
        } catch (Exception $ex) {
            $status = $ex->getMessage();
        }
        return $status;
    }

    /******************************************************设置********************************************************************/

    /**
     * set safety level
     * @param $dic_value
     * @throws \app\exceptions\ManagerInvalidException
     */
    public static function setSafetyLeavel($dic_value)
    {
        self::setOperationParams($dic_value, 'SafetyLeavel');
    }

    /**
     *根据运行参数identify查找参数对象
     * @param $dic_id
     * @return mixed
     */
    public static function getSystemDictionaryInfoBy($dic_id)
    {
        $sql = 'SELECT id,dic_id,dic_value,dic_defaule_value FROM t_system_dictionary WHERE dic_id=:dic_id AND dic_type = 1 AND create_by_league_id=\'0\'';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':dic_id', $dic_id);
      return DbCacheUtility::queryOne($cmd);
    }
}
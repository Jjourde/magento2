<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 06/12/16
 * Time: 16:59
 */
namespace Training\Helloworld\Plugin;

class Customer
{
    public function beforeSetFirstname(\Magento\Customer\Model\Data\Customer $object, $firstname)
    {
        $firstname = mb_convert_case($firstname, MB_CASE_TITLE);
        return array($firstname);
    }
}
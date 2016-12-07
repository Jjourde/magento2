<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\RestClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->connect();


//$client->get('rest/V1/products/24-UB02');
//$client->get('rest/V1/categories/3');
$client->get('rest/V1/products',
    array(
        'searchCriteria' => array(
            'filterGroups' => array(
                array(
                    'filters' => array(
                        array(
                            'field' => 'name',
                            'value' => '%bruno%',
                            'condition_type' => 'like'
                        )
                    )
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'description',
                            'value' => '%comfortable%',
                            'condition_type' => 'like'
                        )
                    )
                )
            ),
            'sortOrders' => array(
                array(
                    'field' => 'name',
                    'direction' => \Magento\Framework\Api\SortOrder::SORT_DESC
                )
            ),
            'pageSize' => 6,
            'currentPage' => 1
        )
    )
);
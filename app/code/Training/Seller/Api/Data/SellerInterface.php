<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 16:33
 */
namespace Training\Seller\Api\Data;

/**
 * @api
 */
interface SellerInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const SELLER_ID = 'seller_id';
    const IDENTIFIER = 'identifier';
    const NAME = 'name';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    /**
     * Get seller id
     *
     * @return null|int
     */
    public function getSellerId();

    /**
     * Set seller id
     *
     * @param $sellerId int
     * @return $this
     */
    public function setSellerId($sellerId);

    /**
     * Get seller identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Set seller identifier
     *
     * @param $identifier string
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * Get seller name
     *
     * @return string
     */
    public function getName();

    /**
     * Set seller name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get seller created at
     *
     * @return null|string
     */
    public function getCreatedAt();

    /**
     * Set seller created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get seller updated at
     *
     * @return null|string
     */
    public function getUpdatedAt();

    /**
     * Set seller updated at
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 14:31
 */

namespace Forestsoft\Billomat\Resource;


use Forestsoft\Billomat\Article\IArticle;
use Forestsoft\Billomat\IResource;

interface IItem extends IResource
{
    /**
     * @param string $unit
     * @return IItem
     */
    public function setUnit($unit);

    /**
     * @return string
     */
    public function getUnit();

    /**
     * @param float $unitPrice
     * @return IItem
     */
    public function setUnitPrice($unitPrice);

    /**
     * @return float
     */
    public function getUnitPrice();

    /**
     * @param int $quantity
     * @return IItem
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @param string $title
     * @return IItem
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param $description
     * @return string
     */
    public function setDescription($description);

    /**
     * @param IArticle $article
     * @return mixed
     */
    public function setArticle(IArticle $article);

    /**
     * @return IArticle
     */
    public function getArticle();


}
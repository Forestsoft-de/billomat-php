<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 16-Nov-17
 * Time: 23:09
 */

namespace Forestsoft\Billomat;


use Forestsoft\Billomat\Customer\ICustomer;
use PHPUnit\Runner\Exception;
use Zend\Http\Client;

abstract class Resource implements IResource
{

    private $_billomatId;
    private $_apikey;
    private $_page = 1;
    private $_perPage = 50;
    private $_language = "de_DE";
    private $_order;

    /**
     * @var \Forestsoft\Billomat\Client\IClient
     */
    private $_client;

    /**
     * @var
     */
    private $_clientFactory;

    /**
     * @param string $key
     * @return $this|IResource
     */
    public function setApiKey($key)
    {
        $this->_apikey = $key;
        return $this;
    }


    /**
     * @param string $id
     * @return $this|IResource
     */
    public function setBillomatId($id)
    {
        $this->_billomatId = $id;
        return $this;
    }

    /**
     * @param int $page
     * @return $this|IResource
     */
    public function setPage($page)
    {
        $this->_page = $page;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this|IResource
     */
    public function setPerPage($perPage)
    {
        $this->_perPage = $perPage;
        return $this;
    }

    /**
     * @param string $order
     * @return $this|mixed
     */
    public function setOrder($order)
    {
        $this->_order = $order;
        return $this;
    }

    /**
     * @param string $language
     * @return $this|IResource
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
        return $this;
    }

    public function getClientFactory(): \Forestsoft\Billomat\Factory\IClient
    {
        if ($this->_clientFactory == null) {
            $this->setClientFactory(\Forestsoft\Billomat\Factory\Client::getInstance());
        }
        return $this->_clientFactory;
    }

    public function setClientFactory(\Forestsoft\Billomat\Factory\IClient $factory)
    {
        $this->_clientFactory = $factory;
        return $this;
    }

    protected function getOptions($addOptions = [])
    {
        $options =  [
            "billomat" => [
                "billomatId" => $this->_billomatId,
                "apiKey" => $this->_apikey,
//                "language" => $this->_language,
//                "page" => $this->_page,
//                "per_page" => $this->_perPage,
//                "order" => $this->_order,
            ]
        ];

        if (!empty($addOptions["billomat"])) {
            $options["billomat"] = array_merge($options["billomat"], $addOptions["billomat"]);
        }

        return $options;
    }
}
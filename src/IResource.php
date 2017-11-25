<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 15-Nov-17
 * Time: 23:56
 */

namespace Forestsoft\Billomat;


use Zend\Http\Client;

interface IResource
{
    const SETTINGS_TYPE_SETTING = "SETTINGS";
    const SETTINGS_TYPE_ABSOLUTE = "ABSOLUTE";
    const SETTINGS_TYPE_RELATIVE = "RELATIVE";
    
    /**
     * Billomat API Key 
     * @param string $key
     * 
     * @return IResource
     */
    public function setApiKey($key);

    /**
     * @param string $id
     * 
     * @return IResource
     */
    public function setBillomatId($id);

    /**
     * @param int $page
     * 
     * @return IResource
     */
    public function setPage($page);

    /**
     * @param int $perPage
     * 
     * @return IResource
     */
    public function setPerPage($perPage);

    /**
     * @param string $order
     *
     * @return mixed
     */
    public function setOrder($order);

    /**
     * 
     * @param string $language
     * 
     * @return IResource
     */
    public function setLanguage($language);

    /**
     * Create Resource
     *
     * @return bool
     */
    public function create();

    /**
     * Update Resource
     * 
     * @return bool
     */
    public function update();

    /**
     * Delete Resource
     * 
     * @return bool
     */
    public function delete();
    

    /**
     * @param \Forestsoft\Billomat\Factory\IClient $client
     * @return mixed
     */
    public function setClientFactory(\Forestsoft\Billomat\Factory\IClient $client);

}
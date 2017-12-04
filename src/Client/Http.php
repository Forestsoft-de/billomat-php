<?php
/**
 * ForestSoft Billomat PHP
 * @link https://github.com/Forestsoft-de/billomat-php
 * @copyright Copyright (c) 2017. ForestSoft Sebastian Förster
 * @license Apache 2.0 https://github.com/Forestsoft-de/billomat-php/blob/master/LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 12:56
 */

namespace Forestsoft\Billomat\Client;


use Zend\Http\Header\ContentType;
use Zend\Http\Request;
use Zend\Stdlib\Parameters;

class Http extends \Zend\Http\Client implements IClient
{


    public function request($data = [])
    {
        if (count($data) > 0) {
            $this->getRequest()->setContent(json_encode($data));
            $this->getRequest()->getHeaders()->addHeader(new ContentType("application/json"));
        }

        $response = $this->send();
        
        if ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 201) {
            $error = json_decode($response->getBody(), true);
            $errMsg  = $response->getReasonPhrase();

            if (!empty($error['errors']['error'])) {
                $errMsg .= " " . $error['errors']['error'];
            }
            
            throw new \Exception(sprintf("Service return HTTP-Status: %s with Message %s", $response->getStatusCode(), $errMsg));
        } else {
            return json_decode($response->getBody(), true);
        }
    }

    /**
     * @return mixed|\Zend\Stdlib\ParametersInterface
     */
    public function getQuery()
    {
        return $this->getRequest()->getQuery();
    }
}
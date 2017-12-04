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


include_once dirname(dirname(__FILE__) ) . "/TestHelper.php";
include_once dirname(__FILE__) . "/Datasets/InvoiceDataset.php";
include_once dirname(__FILE__) . "/Datasets/CustomerDataset.php";
include_once dirname(__FILE__) . "/Datasets/ContactDataset.php";
include_once dirname(__FILE__) . "/Datasets/OfferDataset.php";
include_once dirname(__FILE__) . "/Datasets/FreetextDataset.php";
include_once dirname(__FILE__) . "/Datasets/TemplateDataset.php";
include_once dirname(__FILE__) . "/Datasets/RecurringDataset.php";
include_once dirname(__FILE__) . "/Datasets/ConfirmationDataset.php";
include_once dirname(__FILE__) . "/BaseTest.php";
include_once dirname(__FILE__) . "/AbstractResourceTest.php";
include_once dirname(__FILE__) . "/AbstractFactoryTest.php";
include_once dirname(__FILE__) . "/AbstractFactoryResourceTest.php";
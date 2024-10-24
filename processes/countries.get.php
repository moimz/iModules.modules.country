<?php
/**
 * 이 파일은 아이모듈 국가모듈의 일부입니다. (https://www.imodules.io)
 *
 * 전체 국가목록을 가져온다.
 *
 * @file /modules/country/processes/countries.get.php
 * @author Arzz <arzz@arzz.com>
 * @license MIT License
 * @modified 2024. 10. 24.
 *
 * @var \modules\country\Country $me
 */
if (defined('__IM_PROCESS__') == false) {
    exit();
}

$records = [];
$countries = $me->load();
foreach ($countries as $code => $country) {
    $records[] = $me->getCountry($code)->getJson();
}

$results->success = true;
$results->records = $records;

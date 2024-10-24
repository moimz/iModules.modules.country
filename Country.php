<?php
/**
 * 이 파일은 아이모듈 국가모듈의 일부입니다. (https://www.imodules.io)
 *
 * 국가모듈 클래스를 정의한다.
 *
 * @file /modules/country/Country.php
 * @author Arzz <arzz@arzz.com>
 * @license MIT License
 * @modified 2024. 10. 24.
 */
namespace modules\country;
class Country extends \Module
{
    /**
     * @var \modules\country\dtos\Country[] $_countries;
     */
    private static object $_countries;

    /**
     * 국가데이터 JSON 파일을 불러온다.
     */
    public static function load(): object
    {
        if (isset(self::$_countries) == false) {
            self::$_countries = json_decode(\File::read(self::getPath() . '/countries.json'));
        }

        return self::$_countries;
    }

    /**
     * 국가객체를 가져온다.
     *
     * @param string $code 국가코드
     * @return \modules\country\dtos\Country $country
     */
    public function getCountry(string $code): ?\modules\country\dtos\Country
    {
        self::load();

        if (isset(self::$_countries->{$code}) == false) {
            return null;
        }

        if (!self::$_countries->{$code} instanceof \modules\country\dtos\Country) {
            self::$_countries->{$code} = new \modules\country\dtos\Country($code, self::$_countries->{$code});
        }

        return self::$_countries->{$code} ?? null;
    }
}

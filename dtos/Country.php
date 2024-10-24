<?php
/**
 * 이 파일은 아이모듈 국가모듈의 일부입니다. (https://www.imodules.io)
 *
 * 국가 구조체를 정의한다.
 *
 * @file /modules/country/dtos/Country.php
 * @author Arzz <arzz@arzz.com>
 * @license MIT License
 * @modified 2024. 10. 24.
 */
namespace modules\country\dtos;
class Country
{
    /**
     * @var string $_code 국가코드
     */
    private string $_code;

    /**
     * @var ?string $_calling_code 국제전화 국가번호
     */
    private ?string $_calling_code;

    /**
     * @var ?string $_flag 국기 이미지 경로
     */
    private ?string $_flag;

    /**
     * 국가 구조체를 정의한다.
     *
     * @param object $country
     */
    public function __construct(string $code, object $country)
    {
        $this->_code = $code;
        $this->_calling_code = $country->calling_code ?? null;
    }

    /**
     * 국가명을 가져온다.
     *
     * @param ?string $code 언어코드 (NULL 인 경우 현재사이트 언어코드)
     * @return string $name
     */
    public function getName(?string $code = null): string
    {
        $mCountry = \Modules::get('country');
        $codes = $code !== null ? [$code] : null;
        return \Language::getText('countries.' . $this->_code, null, [$mCountry->getBase()], $codes);
    }

    /**
     * 국제전화 국가번호를 가져온다.
     *
     * @return ?string $_calling_code
     */
    public function getCallingCode(): ?string
    {
        return $this->_calling_code;
    }

    /**
     * 국기 이미지를 가져온다.
     *
     * @return ?string $_flag
     */
    public function getFlag(): ?string
    {
        if (isset($this->_flag) == false) {
            $mCountry = \Modules::get('country');
            $this->_flag =
                is_file($mCountry->getPath() . '/images/' . $this->_code . '.svg') == true
                    ? $mCountry->getDir() . '/images/' . $this->_code . '.svg'
                    : null;
        }

        return $this->_flag;
    }

    /**
     * 데이터를 JSON으로 가져온다.
     *
     * @return object $json
     */
    public function getJson(): object
    {
        $country = new \stdClass();
        $country->code = $this->_code;
        $country->name = $this->getName();
        $country->calling_code = $this->getCallingCode();
        $country->flag = $this->getFlag();

        return $country;
    }
}

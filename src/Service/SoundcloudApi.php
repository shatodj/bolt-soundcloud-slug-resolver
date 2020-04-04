<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Service;

use Exception;
use Njasm\Soundcloud\Request\RequestInterface;
use Njasm\Soundcloud\SoundcloudFacade;
use Njasm\Soundcloud\UrlBuilder\UrlBuilderInterface;

/**
 * Soundcloud API extending Njasm's wrapper so I can modify the Base URL
 */
class SoundcloudApi extends SoundcloudFacade
{

    /** @var string */
    private $baseUrl = "https://api.soundcloud.com";

    /**
     * Set Soundcloud API URL
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    
    /**
     * @inheritdoc
     */
    public function request(array $params = [])
    {
        $destructedUrl = $this->destructBaseUrl();

        $urlBuilder = $this->make(UrlBuilderInterface::class, [$this->resource, $destructedUrl['subdomain'], $destructedUrl['domain'], $destructedUrl['scheme']]);
        $this->request = $this->make(RequestInterface::class, [$this->resource, $urlBuilder, $this->container]);
        $this->request->setOptions($params);
        $this->setResponseFormat($this->request);
        
        $this->response = $this->request->exec();
        
        return $this->response;
    }

    private function destructBaseUrl() {
        $r  = "^(?:(?P<scheme>\w+://))?";
        $r .= "(?:(?P<login>\w+):(?P<pass>\w+)@)?";
        $r .= "(?P<host>(?:(?P<subdomain>[\w\-\_\.]+)\.)?" . "(?P<domain>\w+\.(?P<extension>\w+)))";
        $r .= "(?::(?P<port>\d+))?";
        $r .= "(?P<path>[\w/]*/(?P<file>\w+(?:\.\w+)?)?)?";
        $r .= "(?:\?(?P<arg>[\w=&]+))?";
        $r .= "(?:#(?P<anchor>\w+))?";
        $r = "!$r!";
       
        preg_match ($r, $this->baseUrl, $out);

        if (empty($out)) {
            throw new Exception("Invalid Soundcloud Base URL. '{$this->baseUrl}' ");
        }
       
        return $out;
    }
}

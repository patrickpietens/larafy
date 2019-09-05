<?php

namespace Rennokki\Larafy;

use Rennokki\Larafy\Traits\AlbumsTrait;
use Rennokki\Larafy\Traits\ArtistsTrait;
use Rennokki\Larafy\Traits\AuthTrait;
use Rennokki\Larafy\Traits\BrowseTrait;
use Rennokki\Larafy\Traits\PlaylistsTrait;
use Rennokki\Larafy\Traits\RequestTrait;
use Rennokki\Larafy\Traits\TracksTrait;
use Rennokki\Larafy\Traits\UserTrait;


class Larafy
{
    use AlbumsTrait, BrowseTrait, TracksTrait,
        ArtistsTrait, RequestTrait, PlaylistsTrait,
        UserTrait, AuthTrait;

    private $clientId;
    private $clientSecret;

    private $market;
    private $locale;

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        $this->market = config('larafy.market');
        $this->locale = config('larafy.locale');
    }


    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
    }


    public function setSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }


    public function setMarket(string $market)
    {
        $this->market = $market;
    }


    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }
}

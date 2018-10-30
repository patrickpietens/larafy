<?php

namespace Rennokki\Larafy;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use Rennokki\Larafy\LarafyGenerator;

class LarafyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        function validate($info, $type) {
            if (!$info) {
                return false;
            }

            $validTypes = ['album', 'artist', 'track'];
            if (in_array($type, $validTypes) && $info->type !== $type) {
                return false;
            }

            return true;
        }

        // Spotify URI validation
        Validator::extend('spotifyUri', function($attribute, $value, $parameters, $validator) {
            $parsedURI = LarafyGenerator::parseSpotifyURI($value);
            return validate($parsedURI, $parameters[0]);
        });

        // Spotify URL validation
        Validator::extend('spotifyUrl', function($attribute, $value, $parameters, $validator) {
            $parsedURL = LarafyGenerator::parseSpotifyURL($value);
            return validate($parsedURI, $parameters[0]);
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
     * ---------------------------------------------------------------
     * Base Url
     * ---------------------------------------------------------------
     *
     * The MegaSubPlug base url upon which others is based, if not set it's going to use the sandbox version
     */
    'base_url' => env('MEGASUB_PLUG_BASE_URL', 'https://megasubplug.com/API/'),

    /*
     * ---------------------------------------------------------------
     * ApiToken
     * ---------------------------------------------------------------
     *
         * Your MegaSubPlug ApiToken
     */
    'api_token' => env('MEGASUB_PLUG_API_TOKEN'),

    /*
     * ---------------------------------------------------------------
     * password
     * ---------------------------------------------------------------
     *
     * Your MegaSubPlug password
     */
    'password' => env('MEGASUB_PLUG_PASSWORD'),
];

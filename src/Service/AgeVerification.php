<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;


class AgeVerification
{


    public function verifyAge(Request $request, Response $response) : bool
    {
        $cookies = $request->cookies;

        if ($cookies->has('over18'))
        {
            return true;
        } else if ($request->get('age') == "over18") {
            $response->headers->setCookie(Cookie::create('over18', 'true'));
            return true;
        } else {
            return false;
        }
    }
}
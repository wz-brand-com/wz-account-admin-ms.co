<?php

namespace App\Services;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Facades\Log;

class CustomPasswordBrokerManager extends PasswordBrokerManager{

	/**
     * Resolve the given broker.
     * NOTE: This function is overriden from PasswordBrokerManager
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
    	Log::info('--- Inside CustomPasswordBrokerManager->resolve() ---');
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
        }

        // The password broker uses a token repository to validate tokens and send user
        // password e-mails, as well as validating that password reset process as an
        // aggregate service of sorts providing a convenient interface for resets.

        // Creating a CustomPasswordBroker's object instead of the default one
        return new CustomPasswordBroker(
            $this->createTokenRepository($config),
            $this->app['auth']->createUserProvider($config['provider'] ?? null)
        );
    }
    
}
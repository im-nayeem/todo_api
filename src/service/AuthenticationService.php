<?php
namespace ToDo\Service;

use AppConfig;
use Throwable;
use ToDo\Utils\Utils;
use ToDo\Context\AuthContext;
use ToDo\Helper\Auth\AuthenticationHelper;

class AuthenticationService {
    private static ?AuthenticationService $instance = null;
    private AuthContext $auth;

    private function __construct()
    {
        $this->auth = AuthContext::getInstance();
    }

    public static function getInstance(): AuthenticationService
    {
        if (self::$instance === null) {
            self::$instance = new AuthenticationService();
        }
        return self::$instance;
    }

    public function isVerifiedEmail(string $email): bool
    {
        try {
            $user = $this->auth->getUserByEmail($email)->emailVerified;
            return (bool) $user;
        } catch (Throwable $ex) {
            Utils::log_error($ex->getMessage());
            return false;
        }
    }

    public function hasValidAccessToken(): bool
    {
        try {
            $accessToken = AuthenticationHelper::getAccessTokenFromHeader();
            $verifiedToken = $this->auth->verifyIdToken($accessToken, true);
            $iss = $verifiedToken->claims()->get('iss');

            if ($iss !== AppConfig::TOKEN_ISSUER) {
                return false;
            }

            $this->setUserSession($verifiedToken);
            return true;
        } catch (Throwable $ex) {
            Utils::log_error($ex->getMessage());
            return false;
        }
    }

    public function refreshAccessToken(): ?string
    {
        try {
            $refreshToken = $this->getRefreshToken();
            if ($refreshToken === null) {
                return null;
            }
            $signInResult = $this->auth->signInWithRefreshToken($refreshToken);
            return $signInResult->accessToken();
        } catch (Throwable $ex) {
            Utils::log_error($ex->getMessage());
            return null;
        }
    }

    private function setUserSession($verifiedToken): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            $user = $this->auth->getUser($verifiedToken->claims()->get('sub'));
            $_SESSION['user'] = [
                "name" => $user->displayName,
                "email" => $user->email,
                "uid" => $verifiedToken->claims()->get('sub')
            ];
        }
    }
}

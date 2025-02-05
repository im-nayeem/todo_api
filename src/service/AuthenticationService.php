<?php
namespace ToDo\Service;

use AppConfig;
use Throwable;
use ToDo\Utils\Utils;
use ToDo\Context\AuthContext;
use ToDo\Helper\Auth\AuthenticationHelper;

class AuthenticationService {
    private static ?AuthenticationService $instance = null;
    private $authContext;

    private function __construct()
    {
        $this->authContext = AuthContext::getInstance();
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
            $user = $this->authContext->getUserByEmail($email)->emailVerified;
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
            $verifiedToken = $this->authContext->verifyIdToken($accessToken, true);
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

    public function signInWithEmailAndPassword(string $email, string $password): ?object
    {
        try {
            $signInResult = $this->authContext->signInWithEmailAndPassword($email, $password);
            $accessToken = $signInResult->accessToken();
            if ($accessToken === null) {
                $accessToken = $signInResult->idToken();
            }
            $refreshToken = $signInResult->refreshToken();
            return (object) [
                "access_token" => $accessToken,
                "refresh_token" => $refreshToken
            ];
        } catch (Throwable $ex) {
            Utils::log_error($ex->getMessage());
            return ["error" => "Invalid password"];
        }
    }

    public function refreshAccessToken(): ?string
    {
        try {
            $refreshToken = AuthenticationHelper::getRefreshToken();
            if ($refreshToken === null) {
                return null;
            }
            $signInResult = $this->authContext->signInWithRefreshToken($refreshToken);
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
            $user = $this->authContext->getUser($verifiedToken->claims()->get('sub'));
            $_SESSION['user'] = [
                "name" => $user->displayName,
                "email" => $user->email,
                "uid" => $verifiedToken->claims()->get('sub')
            ];
        }
    }
}

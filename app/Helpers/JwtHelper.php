<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;

class JwtHelper
{
    public function getToken($request) {
        $token = $request->bearerToken();        
        return $token;
    }

    public function getTokenDecode($token) {
        return JWT::decode(
            $token,
            config('jwt.secret'),
            [config('jwt.algo')]
        );
    }
    
    protected function getTokenEncode(array $data): string {
        $payload = $this->getPayload($data);
        return JWT::encode(
            $payload,
            config('jwt.secret'),
            config('jwt.algo')
        );
    }
    
    public function getPayload(array $data): array {
        $iat = time();
        $nbf = $iat + 10;
        $expire = ($nbf + 60) * 1000;
        
        return [
            'exp' => $expire,
            'nbf' => $nbf,
            'iat' => $iat,
            'jti' => base64_encode(random_bytes(32)),
            'data' => $data,
        ];
    }
    
    public function generateToken(array $tokenData): string {
        $token = $this->getTokenEncode($tokenData);
        return $token;
    }
}
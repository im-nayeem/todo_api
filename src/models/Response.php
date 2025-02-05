<?php
namespace ToDo\Models;

use ToDo\ResponseStatus;

class Response
{
    private ?string $status = null;
    private ?int $responseCode = null;
    private ?bool $isHtmlContent = false;
    private mixed $data;
    private ?string $filePath = null;
    
    public function __construct(
        ?string $status = null, 
        ?int $responseCode = null, 
        ?bool $isHtmlContent = false, 
        mixed $data = null
    )
    {
        $this->status = $status;
        $this->responseCode = $responseCode;
        $this->isHtmlContent = $isHtmlContent;
        $this->data = $data;
    }

    // getters
    public function getStatus(): string
    {
        return $this->status ? $this->status : ResponseStatus::OK;
    }
    public function getResponseCode(): int
    {
        return $this->responseCode ? $this->responseCode : ResponseStatus::HTTP_OK;
    }
    public function getData()
    {
        return $this->data;
    }
    public function isHtmlContent(): bool
    {
        return $this->isHtmlContent;
    }
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    // setter
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }
}
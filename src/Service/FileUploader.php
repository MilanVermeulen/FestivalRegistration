<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class FileUploader
{
    private string $actsPath;

    public function __construct(string $actsPath)
    {
        $this->actsPath = $actsPath;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '.' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            // Handle file upload error
            throw new FileException('Error uploading file: ' . $e->getMessage());
        }

        return $newFilename;
    }

    public function getTargetDirectory(): string
    {
        return $this->actsPath;
    }
}


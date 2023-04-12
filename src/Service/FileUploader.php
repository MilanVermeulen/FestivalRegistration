<?php

namespace App\Service;

use App\Entity\Acts;
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
        // Generate a unique name for the file before saving it
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '.' . uniqid() . '.' . $file->guessExtension();
        // Move the file to the directory where images are stored
        try {
            $file->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            // Handle file upload error
            throw new FileException('Error uploading file: ' . $e->getMessage());
        }
        // Save the new file name to the database
        $actsEntity = new Acts();
        $actsEntity->setImageFileName($newFilename);

        return $newFilename;
    }

    public function getTargetDirectory(): string
    {
        return $this->actsPath;
    }

}


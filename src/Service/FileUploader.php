<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function upload( UploadedFile $file, string $targetDirectory, string $fileName): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $fileName = strtolower($fileName);
        $fileName = str_replace([' ', '.', ';', ':'], '_', $fileName);

        $safeFilename = $this->slugger->slug($fileName);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($targetDirectory, $fileName);
        } catch (FileException $e) {
           echo $e->getMessage();
           return false;
        }

        return $fileName;
    }

}
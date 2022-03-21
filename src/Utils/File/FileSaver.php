<?php

namespace App\Utils\File;

use App\Utils\Filesystem\FilesystemWorker;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileSaver
{
    private SluggerInterface $slugger;
    private string $uploadsTempDir;
    private FilesystemWorker $filesystemWorker;

    public function __construct(SluggerInterface $slugger, FilesystemWorker $filesystemWorker, string $uploadsTempDir)
    {
        $this->slugger = $slugger;
        $this->uploadsTempDir = $uploadsTempDir;
        $this->filesystemWorker = $filesystemWorker;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string|null
     */
    public function saveUploadFileIntoTemp(UploadedFile $uploadedFile): ?string
    {
//        dd($uploadedFile);
        $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $saveFileName = $this->slugger->slug($originalFileName);

        $filename = sprintf('%s-%s.%s', $saveFileName, uniqid(), $uploadedFile->guessExtension());

        $this->filesystemWorker->createFolderIfItNotExist($this->uploadsTempDir);
//        dd($filename, $this->uploadsTempDir);

        try {
            $uploadedFile->move($this->uploadsTempDir, $filename);
        } catch (FileException $e) {
            return null;
        }

        return $filename;
    }
}
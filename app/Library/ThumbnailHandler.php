<?php

namespace App\Library;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ThumbnailHandler
{
    /**
     * @param $recipeId
     * @param Request $request
     * @return string
     */
    public function extractDocumentPostData($recipeId, Request $request)
    {
        return $this->fetchDocumentPath($recipeId, $request->file('thumbnail'));
    }

    /**
     * @param $recipeId
     * @param UploadedFile $document
     *
     * @return string
     */
    private function fetchDocumentPath($recipeId, UploadedFile $document)
    {
        return $this->fetchDocumentDestination($recipeId) . "/" . $this->fetchDocumentName($document);
    }

    /**
     * @param $recipeId
     *
     * @return mixed
     */
    private function fetchDocumentDestination($recipeId)
    {
        $folder = env('UPLOAD_FOLDER', 'images/thumbnails');
        return "$folder/$recipeId";
    }

    /**
     * @param UploadedFile $document
     *
     * @return string
     */
    private function fetchDocumentName(UploadedFile $document)
    {
        return $document->getClientOriginalName();
    }
}

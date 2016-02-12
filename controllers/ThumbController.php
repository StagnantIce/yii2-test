<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use yii\helpers\FileHelper;


class ThumbController extends Controller {

    public $extensions = [
        'jpg' => 'jpeg',
        'jpeg' => 'jpeg',
        'png' => 'png',
        'gif' => 'gif',
        'bmp' => 'bmp',
    ];

    public function createThumb($src, $width, $height = null, $mode = ManipulatorInterface::THUMBNAIL_INSET)
    {
        $dst = Yii::getAlias('@app/web/thumb');

        if (!file_exists($dst)) {
            FileHelper::createDirectory($dst);
        }

        if (!file_exists($src)) {
            throw new \Exception(404, Yii::t('yii', 'File thumb not found.'));
        }

        $info = pathinfo($src);
        $ext = strtolower($info['extension']);

        if (!isset($this->extensions[$ext])) {
            throw new \Exception(404, Yii::t('yii', 'Extension thumb not found.'));
        }

        if (!$height) {
            $img = Image::getImagine()->open($src);

            $size = $img->getSize();
            $ratio = $size->getWidth()/$size->getHeight();

            $height = round($width/$ratio);
        }
        
        $dst = rtrim($dst, '/') . '/' . $info['filename'] . '_' . $width . '_' . $height . '.'. $ext;

        if (!file_exists($dst)) {

            $thumb = Image::thumbnail($src, $width, $height, $mode);
            if (!$thumb || !$thumb->save($dst)) {
                throw new \Exception(404, Yii::t('yii', 'Error thumb create.'));
            }
        }

        header('Content-type: image/' . $this->extensions[$ext]);
        header('Content-Length: ' . filesize($dst));
        readfile($dst);
        exit();
    }

    public function actionShow($src, $width = 100, $height = null) {

        if (empty($src)) {
            throw new HttpException(404, Yii::t('yii', 'File not found.'));
        }

        $this->createThumb($src, $width, $height);
    }
}
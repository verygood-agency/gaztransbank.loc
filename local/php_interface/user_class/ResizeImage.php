<?php
namespace VG;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use CFile;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class Image {

  /**
   * Подобие стандартного уменьшателя картинок CFile::ResizeImageGet.
   * Помимо jpg создает еще webp копию.
   *
   * @param int|string      $file ID в таблице файлов или путь к файлу
   * @param array           $arSize
   * @param int             $resizeType
   * @param bool            $bInitSizes
   * @param array|bool      $arFilters
   * @param bool            $bImmediate
   * @param int|string|bool $quality
   * @return mixed
   * @see \CFile::ResizeImageGet
   *
   */
  public static function resizeImageWebp(
    $file,
    array $arSize,
    $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
    $bInitSizes = false,
    $arFilters = false,
    $bImmediate = false,
    $quality = false
  ) {
    if (is_numeric($file) || is_array($file)) {
      $result = CFile::ResizeImageGet($file, $arSize, $resizeType, $bInitSizes, $arFilters, $bImmediate, $quality);
    } else {
      $uploadDirName = Option::get("main", "upload_dir", "upload");
      $fileName = basename($file);
      $subdir = "iblock/" . substr($fileName, 0, 3);
      $cacheDir = "{$arSize["width"]}_{$arSize["height"]}_$resizeType" . (is_array($arFilters) ? md5(serialize($arFilters)) : "");
      $cacheImageFile = Application::getDocumentRoot() . "/$uploadDirName/resize_cache/$subdir/$cacheDir/$fileName";

      // Перезаписываем не каждый раз, а только если исходный jpg изменился
      if (!file_exists($cacheImageFile) || filemtime($cacheImageFile) < filemtime($file)) {
        CFile::ResizeImageFile(
          $file,
          $cacheImageFile,
          $arSize,
          $resizeType,
          [],
          $quality,
          $arFilters
        );
      }

      $result = [
        "src" => str_replace(Application::getDocumentRoot(), "", $cacheImageFile),
      ];
    }

    if ($result === false) {
      return $result;
    }

    if ($quality === false) {
      $quality = 95;
    }

    $previewMainPath = Application::getDocumentRoot() . $result["src"];
    $result["src_webp"] = self::replaceExtension($result["src"], "webp");

    self::copyPictureToWebp($previewMainPath, $quality);

    return $result;
  }

  /**
   * Меняет расширение у файла на новое
   *
   * @param string $path
   * @param string $newExtension
   * @return string
   */
  public static function replaceExtension(string $path, string $newExtension): string {
    $info = pathinfo($path);

    return "{$info["dirname"]}/{$info["filename"]}.$newExtension";
  }

  /**
   * Создается копия исходной картинки в формате webp в том же самом каталоге
   *
   * @param string     $originalPath
   * @param int|string $quality
   * @return string Возвращает полный путь к файлу webp
   */
  public static function copyPictureToWebp(string $originalPath, $quality = 95): string {
    $webpPath = self::replaceExtension($originalPath, "webp");

    // Перезаписываем webp не каждый раз, а только если исходный jpg изменился
    if (file_exists($webpPath) && filemtime($webpPath) >= filemtime($originalPath)) {
      return $webpPath;
    }

    switch (exif_imagetype($originalPath)) {
      case IMAGETYPE_PNG:
        $previewMain = imagecreatefrompng($originalPath);
        break;

      case IMAGETYPE_JPEG:
      default:
        $previewMain = imagecreatefromjpeg($originalPath);
    }

    imagewebp($previewMain, $webpPath, $quality);

    return $webpPath;
  }
}
?>
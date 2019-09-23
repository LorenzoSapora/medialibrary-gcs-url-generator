<?php
namespace Terminalsio\GcsUrlGenerator;

use DateTimeInterface;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Config\Repository as Config;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\UrlGenerator\BaseUrlGenerator;

class GcsUrlGenerator extends BaseUrlGenerator
{
	/**
	* Get the url for the profile of a media item.
	*
	* @return string
	*/
	public function getUrl(): string
	{
		$disk = Storage::disk($this->media->disk);
		return $disk->url($this->getPathRelativeToRoot());
	}


    /**
     * Get the temporary url for a media item.
     *
     * @param \DateTimeInterface $expiration
     * @param array $options
     *
     * @return string
     */
    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return $this
            ->filesystemManager
            ->disk($this->media->disk)
            ->temporaryUrl($this->getPath(), $expiration, $options);
    }

    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->getPathRelativeToRoot();
    }

    /**
     * Get the url to the directory containing responsive images.
     *
     * @return string
     */
    public function getResponsiveImagesDirectoryUrl(): string
    {
        $url = $this->pathGenerator->getPathForResponsiveImages($this->media);
        if ($root = config('filesystems.disks.'.$this->media->disk.'.root')) {
            $url = $root.'/'.$url;
        }
        return config('medialibrary.gcs.domain').'/'.$url;
    }

}

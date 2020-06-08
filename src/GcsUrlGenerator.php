<?php
namespace Terminalsio\GcsUrlGenerator;

use DateTimeInterface;
use Illuminate\Support\Str;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Facades\Storage;

use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class GcsUrlGenerator extends BaseUrlGenerator
{
	/**
	* Get the url for the profile of a media item.
	*
	* @return string
	*/
	public function getUrl(): string
	{
        $url = $this->getDisk()->url($this->getPathRelativeToRoot());

        $url = $this->versionUrl($url);

        return $url;
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
        return $this->getDisk()->temporaryUrl($this->getPathRelativeToRoot(), $expiration, $options);
    }

    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getPath(): string
    {
        $adapter = $this->getDisk()->getAdapter();

        $cachedAdapter = '\League\Flysystem\Cached\CachedAdapter';

        if ($adapter instanceof $cachedAdapter) {
            $adapter = $adapter->getAdapter();
        }

        $pathPrefix = $adapter->getPathPrefix();

        return $pathPrefix.$this->getPathRelativeToRoot();
    }

    public function getBaseMediaDirectoryUrl()
    {
        return $this->getDisk()->url('/');
    }

    /**
     * Get the url to the directory containing responsive images.
     *
     * @return string
     */
    public function getResponsiveImagesDirectoryUrl(): string
    {
        $base = Str::finish($this->getBaseMediaDirectoryUrl(), '/');

        $path = $this->pathGenerator->getPathForResponsiveImages($this->media);

        return Str::finish(url($base.$path), '/');
    }

}

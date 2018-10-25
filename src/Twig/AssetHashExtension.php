<?php

namespace Adamski\Symfony\UtilsBundle\Twig;

use Symfony\Component\Asset\Packages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetHashExtension extends AbstractExtension {

    /**
     * @var Packages
     */
    protected $packages;

    /**
     * @var string
     */
    protected $kernelPublicPath;

    /**
     * AssetHashExtension constructor.
     *
     * @param Packages $packages
     * @param string   $kernelProjectPath
     */
    public function __construct(Packages $packages, string $kernelProjectPath) {
        $this->packages = $packages;
        $this->kernelPublicPath = $kernelProjectPath . DIRECTORY_SEPARATOR . "public";
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return [
            new TwigFunction("asset_hash", [$this, "assetHash"])
        ];
    }

    /**
     * Generate asset URL with file MD5 hash.
     *
     * @param string $value
     * @param string $format
     * @return string
     */
    public function assetHash(string $value, string $format = "%s?%s") {

        if (!$this->isURL($value)) {
            if ($filePath = $this->getRealPath($value)) {
                return sprintf($format, $this->packages->getUrl($value), md5_file($filePath));
            }
        }

        return $value;
    }

    /**
     * Check if provided value is looking as URL.
     *
     * @param string $value
     * @return bool
     */
    private function isURL(string $value) {
        return (bool)preg_match("/^(http(s)?|ftp)/", $value);
    }

    /**
     * Get real path to provided file.
     *
     * @param string $value
     * @return bool|string
     */
    private function getRealPath(string $value) {
        return realpath(
            $this->kernelPublicPath . DIRECTORY_SEPARATOR . $value
        );
    }
}

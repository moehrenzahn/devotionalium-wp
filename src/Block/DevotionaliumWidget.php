<?php

namespace Devotionalium\Block;

use Devotionalium\ConfigAccessor;

class DevotionaliumWidget extends Devotionalium
{
    /**
     * @var string
     */
    private $beforeWidget;

    /**
     * @var string
     */
    private $afterWidget;

    /**
     * @var string
     */
    private $beforeTitle;

    /**
     * @var string
     */
    private $afterTitle;

    /**
     * DevotionaliumWidget constructor.
     *
     * @param ConfigAccessor $config
     * @param string $templatePath
     * @param \Devotionalium\Devotionalium\Devotionalium $devotionalium
     * @param $beforeWidget
     * @param $afterWidget
     * @param $beforeTitle
     * @param $afterTitle
     */
    public function __construct(
        ConfigAccessor $config,
        $templatePath,
        \Devotionalium\Devotionalium\Devotionalium
        $devotionalium,
        $beforeWidget,
        $afterWidget,
        $beforeTitle,
        $afterTitle
    ) {
        $this->beforeWidget = $beforeWidget;
        $this->afterWidget = $afterWidget;
        $this->beforeTitle = $beforeTitle;
        $this->afterTitle = $afterTitle;

        parent::__construct($config, $templatePath, $devotionalium);
    }


    /**
     * @return string
     */
    public function getBeforeWidget(): string
    {
        return $this->beforeWidget;
    }

    /**
     * @return string
     */
    public function getAfterWidget(): string
    {
        return $this->afterWidget;
    }

    /**
     * @return string
     */
    public function getBeforeTitle(): string
    {
        return $this->beforeTitle;
    }

    /**
     * @return string
     */
    public function getAfterTitle(): string
    {
        return $this->afterTitle;
    }
}

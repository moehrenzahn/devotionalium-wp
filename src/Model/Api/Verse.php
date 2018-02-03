<?php

namespace Devotionalium\Model\Api;

class Verse
{
    /**
     * @var int (0|1)
     */
    private $biblePart;

    /**
     * @var string
     */
    private $book;

    /**
     * @var int
     */
    private $bookNumber;

    /**
     * @var int
     */
    private $chapter;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $textOriginal;

    /**
     * @var int[]
     */
    private $verses;

    /**
     * @var string
     */
    private $versionName;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $readingUrl;

    /**
     * Verse constructor.
     *
     * @param $biblePart
     * @param $book
     * @param $bookNumber
     * @param $chapter
     * @param $text
     * @param $textOriginal
     * @param array $verses
     * @param $versionName
     * @param $reference
     * @param $readingUrl
     */
    public function __construct(
        $biblePart,
        $book,
        $bookNumber,
        $chapter,
        $text,
        $textOriginal,
        array $verses,
        $versionName,
        $reference,
        $readingUrl
    ) {
        $this->biblePart = $biblePart;
        $this->book = $book;
        $this->bookNumber = $bookNumber;
        $this->chapter = $chapter;
        $this->text = $text;
        $this->textOriginal = $textOriginal;
        $this->verses = $verses;
        $this->versionName = $versionName;
        $this->reference = $reference;
        $this->readingUrl = $readingUrl;
    }

    /**
     * @return int
     */
    public function getBiblePart()
    {
        return $this->biblePart;
    }

    /**
     * @return string
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @return int
     */
    public function getBookNumber()
    {
        return $this->bookNumber;
    }

    /**
     * @return int
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTextOriginal()
    {
        return $this->textOriginal;
    }

    /**
     * @return int[]
     */
    public function getVerses()
    {
        return $this->verses;
    }

    /**
     * @return string
     */
    public function getVersionName()
    {
        return $this->versionName;
    }

    /**
     * @return string
     */
    public function getReferenceString()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getReadingUrl()
    {
        return $this->readingUrl;
    }
}

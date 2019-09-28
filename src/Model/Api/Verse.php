<?php

namespace Devotionalium\Model\Api;

class Verse
{
    /**
     * @var int (0|1|2)
     */
    private $collection;

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
     * @param int $collection
     * @param string $book
     * @param int $bookNumber
     * @param int $chapter
     * @param string $text
     * @param string $textOriginal
     * @param string[] $verses
     * @param string $versionName
     * @param string $reference
     * @param string $readingUrl
     */
    public function __construct(
        $collection,
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
        $this->collection = $collection;
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
    public function getCollection()
    {
        return $this->collection;
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

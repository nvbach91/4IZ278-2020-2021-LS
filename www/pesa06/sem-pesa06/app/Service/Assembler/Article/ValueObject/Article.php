<?php
declare(strict_types=1);

namespace App\Service\Assembler\Article\ValueObject;


use DateTime;

class Article
{
    private int $id;
    private string $title;
    private string $author;
    private string $content;
    private DateTime $created;
    private ?int $teamId = null;
    private ?string $teamName = null;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'content' => $this->content,
            'created' => $this->created->format('d. m. Y'),
            'teamId' => $this->teamId,
            'teamName' => $this->teamName,
        ];
    }

    /**
     * @return int|null
     */
    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    /**
     * @param int|null $teamId
     */
    public function setTeamId(?int $teamId): void
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string|null
     */
    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    /**
     * @param string|null $teamName
     */
    public function setTeamName(?string $teamName): void
    {
        $this->teamName = $teamName;
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }


}
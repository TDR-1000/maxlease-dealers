<?php

class MAXComment
{
    /**
     * @var MAXDatabase
     */
    private $db = null;

    /**
     * @var MAXUser
     */
    private $users;

    /**
     * @var \MAXValidator
     */
    private $validator;

    /**
     * Class constructor
     *
     * @param MAXDatabase $db
     * @param MAXUser $users
     */
    public function __construct(MAXDatabase $db, MAXUser $users, MAXValidator $validator)
    {
        $this->db = $db;
        $this->users = $users;
        $this->validator = $validator;
    }

    /**
     * Inserts comment into database.
     *
     * @param int $userId The ID of user who is posting the comment.
     * @param string $comment Comment text.
     */
    public function insertComment(int $userId, string $comment): void
    {
        if ($this->validator->isEmpty($comment)) {
            MAXResponse::validationError(['comment' => trans('field_required')]);
        }

        $userInfo = $this->users->getInfo($userId);
        $datetime = date("Y-m-d H:i:s");

        $this->db->insert("as_comments", [
            "posted_by" => $userId,
            "posted_by_name" => $userInfo['username'],
            "comment" => strip_tags($comment),
            "post_time" => $datetime
        ]);

        respond([
            "user" => $userInfo['username'],
            "comment" => stripslashes(strip_tags($comment)),
            "postTime" => $datetime
        ]);
    }

    /**
     * Return all comments left by a user.
     *
     * @param int $userId The ID of the user.
     * @return array Array of all user's comments.
     */
    public function getUserComments(int $userId): array
    {
        return $this->db->select(
            "SELECT * FROM `as_comments` WHERE `posted_by` = :id",
            ["id" => $userId]
        );
    }

    /**
     * Return last $limit (default 7) comments from database.
     *
     * @param int $limit Required number of comments.
     * @return array Array of comments.
     */
    public function getComments(int $limit = 7): array
    {
        return $this->db->select("SELECT * FROM `as_comments` ORDER BY `post_time` DESC LIMIT $limit");
    }
}

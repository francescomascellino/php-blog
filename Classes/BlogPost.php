<?php
class BlogPost
{
    public $title;
    public $content;
    public $image;
    public $user_id;
    public $category_id;

    public function __construct($title, $content, $user_id, $category_id, $image = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->image = $image;        
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {

        return $this->content;
    }
    public function getImage()
    {

        return $this->image;
    }

    public function getUserId()
    {

        return $this->user_id;
    }

    public function getCategoryId()
    {

        return $this->category_id;
    }

    public function save($conn)
    {
        $stmt = mysqli_prepare($conn, "INSERT INTO posts (title, content, image, user_id, category_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssii", $this->title, $this->content, $this->image, $this->user_id, $this->category_id);

            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }

            mysqli_stmt_close($stmt);
        } else {
            return false;
        }
    }
}

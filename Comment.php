class Comment {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->connect();
    }

    public function insertComment($userId, $commentId, $content) {
        $stmt = $this->db->prepare("INSERT INTO `comments` (`user_id`, `comment_id`, `content`) VALUES (:user_id, :comment_id, :content)");
        $stmt->execute(['user_id' => $userId, 'comment_id' => $commentId, 'content' => $content]);
        return $this->db->lastInsertId();
    }

    public function getCommentsByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM `comments` WHERE `user_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getCommentsByUserId($commentId) {
        $stmt = $this->db->prepare("SELECT * FROM `comments` WHERE `comment_id` = :comment_id");
        $stmt->execute(['comment_id' => $commentId]);
        return $stmt->fetchAll();
    }

    public function updateComment($commentId, $content) {
        $stmt = $this->db->prepare("UPDATE `comments` SET `content` = :content WHERE `id` = :id");
        $stmt->execute(['content' => $content, 'id' => $commentId]);
    }

    public function removeComment($commentId) {
        $stmt = $this->db->prepare("DELETE FROM `comments` WHERE `id` = :id");
        $stmt->execute(['id' => $commentId]);
    }
	
	public function addReactionToComment($userId, $commentId) {
        $stmt = $this->db->prepare("INSERT INTO `reaction` (`user_id`, `id`) VALUES (:user_id, :id)");
        $stmt->execute(['user_id' => $userId, 'id' => $commentId]);
    }
}
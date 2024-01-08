class Post {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->connect();
    }

    public function getLatestPosts($limit = 20) {
        $stmt = $this->db->prepare("SELECT * FROM `post` ORDER BY `datetime_posted` DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findPostsWithKeyword($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM `post` WHERE `content` LIKE :keyword");
        $keyword = "%$keyword%";
        $stmt->execute(['keyword' => $keyword]);
        return $stmt->fetchAll();
    }

    public function getPostsByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM `post` WHERE `member_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function createPost($memberId, $content) {
        $stmt = $this->db->prepare("INSERT INTO `post` (`member_id`, `content`, `datetime_posted`) VALUES (:member_id, :content, NOW())");
        $stmt->execute(['member_id' => $memberId, 'content' => $content]);
        return $this->db->lastInsertId();
    }

    public function removePost($postId) {
        $stmt = $this->db->prepare("DELETE FROM `post` WHERE `post_id` = :post_id");
        $stmt->execute(['post_id' => $postId]);
    }

    public function getCommentCountByPost($postId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS `comment_count` FROM `comments` WHERE `post_id` = :post_id GROUP BY `post_id`");
        $stmt->execute(['post_id' => $postId]);
        return $stmt->fetchColumn();
    }

    public function getPostsCommentsLikes() {
        $stmt = $this->db->query("SELECT p.`post_id`, p.`content`, COUNT(DISTINCT c.`id`) AS `comments_count`, COUNT(DISTINCT l.`user_id`) AS `likes_count` FROM `post` p LEFT JOIN `comments` c ON p.`post_id` = c.`comment_id` LEFT JOIN `likes` l ON p.`post_id` = l.`post_id` GROUP BY p.`post_id`");
        return $stmt->fetchAll();
    }

    public function updatePost($postId, $content) {
        $stmt = $this->db->prepare("UPDATE `post` SET `content` = :content WHERE `post_id` = :post_id");
        $stmt->execute(['content' => $content, 'post_id' => $postId]);
    }
}
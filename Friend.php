class Friend {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->connect();
    }

    public function getFriends($userId) {
        $stmt = $this->db->prepare("SELECT * FROM `friends` WHERE `my_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getFriendRequests($userId) {
        $stmt = $this->db->prepare("SELECT * FROM `friend_requests` WHERE `receiver` = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function countFriends($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS `num_friends` FROM `friends` WHERE `my_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }

    public function removeFriend($userId, $friendUserId) {
        $stmt = $this->db->prepare("DELETE FROM `friends` WHERE (`my_id` = :user_id AND `friends_id` = :friend_user_id) OR (`my_id` = :friend_user_id AND `friends_id` = :user_id)");
        $stmt->execute(['user_id' => $userId, 'friend_user_id' => $friendUserId]);
    }

    public function addFriend($userId, $friendUserId) {
        $stmt = $this->db->prepare("INSERT INTO `friends` (`my_id`, `friends_id`) VALUES (:user_id, :friend_user_id), (:friend_user_id, :user_id)");
        $stmt->execute(['user_id' => $userId, 'friend_user_id' => $friendUserId]);
    }

    public function sendFriendRequest($senderId, $receiverId) {
        $stmt = $this->db->prepare("INSERT INTO `friend_requests` (`sender`, `receiver`) VALUES (:sender_id, :receiver_id)");
        $stmt->execute(['sender_id' => $senderId, 'receiver_id' => $receiverId]);
		removeFriendRequest($senderId, $receiverId);
    }

    public function removeFriendRequest($senderId, $receiverId) {
        $stmt = $this->db->prepare("DELETE FROM `friend_requests` WHERE `sender` = :sender_id AND `receiver` = :receiver_id");
        $stmt->execute(['sender_id' => $senderId, 'receiver_id' => $receiverId]);
    }

    public function findMutualFriends($userId1, $userId2) {
        $stmt = $this->db->prepare("SELECT f1.`friends_id` FROM `friends` f1 JOIN `friends` f2 ON f1.`friends_id` = f2.`my_id` WHERE f1.`my_id` = :user_id1 AND f2.`friends_id` = :user_id2");
        $stmt->execute(['user_id1' => $userId1, 'user_id2' => $userId2]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
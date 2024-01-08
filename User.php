class User {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->connect();
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT m.* FROM `members` m JOIN `users` u ON m.`member_id` = u.`user_id` WHERE u.`username` = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function listAdministrators() {
        $stmt = $this->db->query("SELECT * FROM `users` WHERE `admin` = 1");
        return $stmt->fetchAll();
    }

    public function changePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE `users` SET `password` = :password WHERE `user_id` = :user_id");
        $stmt->execute(['password' => $hashedPassword, 'user_id' => $userId]);
    }

    public function setUserOffline($userId) {
        $stmt = $this->db->prepare("UPDATE `members` SET `status` = 'Offline' WHERE `member_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function setUserOnline($userId) {
        $stmt = $this->db->prepare("UPDATE `members` SET `status` = 'Online' WHERE `member_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function makeUserAdmin($userId) {
        $stmt = $this->db->prepare("UPDATE `users` SET `admin` = 1 WHERE `user_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function removeUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM `users` WHERE `user_id` = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function createUser($user_id, $password, $isAdmin = 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM `users` WHERE `user_id` = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $count = $stmt->fetchColumn();
		if($count == 0) {
			$stmt = $this->db->prepare("INSERT INTO `users` (`user_id`, `password`, `admin`) VALUES (:user_id, :password, :admin)");
			$stmt->execute(['user_id' => $user_id, 'password' => $hashedPassword, 'admin' => $isAdmin]);
			return $this->db->lastInsertId();
		}
        return null;
    }
	
	public function createMember($ign, $email, $contactNo, $age, $gender, $image, $birthdate, $status) {
		if(age >= 16) {
			
			$stmt = $this->db->prepare("INSERT INTO `members` (`ign`, `email`, `contact_no`, `age`, `gender`, `image`, `birthdate`, `status`) VALUES (:ign, :email, :contact_no, :age, :gender, :image, :birthdate, :status)");
			$stmt->execute(['ign' => $ign, 'email' => $email, 'contact_no' => $contactNo, 'age' => $age, 'gender' => $gender, 'image' => $image, 'birthdate' => $birthdate, 'status' => $status]);
			return $this->db->lastInsertId();
		}
		return null;
    }

    public function getAllMembers() {
        $stmt = $this->db->query("SELECT * FROM `members`");
        return $stmt->fetchAll();
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM `users`");
        return $stmt->fetchAll();
    }

    public function isUsernamePasswordCombinationValid($user_id, $password) {
        $stmt = $this->db->prepare("SELECT `password` FROM `users` WHERE `user_id` = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $hashedPassword = $stmt->fetchColumn();

        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            return 1; // user_id and password combination exists
        } else {
            return 0; // user_id and password combination does not exist
        }
    }
	
}
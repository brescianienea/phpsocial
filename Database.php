class Database {
    private $host = '127.0.0.1';
    private $db   = 'socialdb';
    private $user = '';
    private $pass = '';
    private $charset = 'utf8mb4';

	public function set_user($user) {
		$this->user = $user;
	}

	public function set_pass($pass) {
		$this->pass = $pass;
	}

    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $this->user, $this->pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
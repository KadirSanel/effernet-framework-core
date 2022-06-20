<?php

namespace Effernet\Core\Auth;

use Effernet\Core\Application\Session;
use Effernet\Core\Data\Core;

class Authenticate
{
    private Session $session;
    private Core $db;
    private array $container;

    public function __construct(array $container)
    {
        $this->container = $container;
        $this->session = new Session();
        $this->db = new Core("postgres");
    }

    public function auth()
    {
        $data = $this->rewriteArray();
        $query = $this->db->runQuery("SELECT * FROM admin_users WHERE email='" . $data[0]["post_data"] . "'");
        $query->execute([]);
        $count = $query->rowCount();

        if ($count > 0){
            $auth = $query->fetch(\PDO::FETCH_ASSOC);
            if ($this->passwordControl($data[1]["post_data"], $auth["password"])){
                if ($this->userLoad($auth)){
                    header("location: /");
                }
            }else{
                header("location: /login");
            }
        }else{
            header("location: /login");
        }
    }

    private function passwordControl($post_pass, $password): bool
    {
        return password_verify($post_pass, $password);
    }

    private function rewriteArray(): array
    {
        $temp = [];
        $data = [];
        foreach ($this->container as $key=>$item) {
            $temp = [
                "post_key" => $key,
                "db_col" => $item,
                "post_data" => $_POST[$key] ?? null
            ];
            array_push($data, $temp);
        }
        return $data;
    }

    private function userLoad($data): bool
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $data['id'];
        return true;
    }

}
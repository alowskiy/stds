<?php

namespace Controllers\Support;
use Repositories\UserRepository;
use Vendor\DBConnection;
use PDO;
class PaginatorService
{
    public function getPag()
    {
        $srt = 10; // records per page
        $page = 0;

        if (!isset($_GET["page"]) or $_GET["page"] === 1) {
            $page = 0;
            $offset = 0;
        } else {
            $page = $_GET["page"];
            $offset = $page * $srt - 10;
        }

        $userRepo = new UserRepository();
        $users = $userRepo->all($page, $srt);
        $stack = [];
        $meta = [
            "total" => $users[0],
            "currentPage" => $page,
            "totalPages" => ceil($users[0] / $srt),
        ];

        foreach ($users[1] as $stds) {
            $stack[] = [
                "user" => [
                    "id" => $stds["id"],
                    "email" => $stds["email"],
                    "name" => $stds["name"],
                    "group_number" => $stds["groupNum"],
                ],
            ];
        }

        return ["users" => $stack, "meta" => $meta];
    }
}

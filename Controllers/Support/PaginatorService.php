<?php

namespace Controllers\Support;
use Repositories\UserRepository;
use Vendor\DBConnection;
use PDO;
class PaginatorService
{
    public function getPag()
    {
        $srt = 4; // records per page
        $page = 0;

        if (!isset($_GET["page"]) or $_GET["page"] == 1) {
            $page = 1;
            $offset = 0;
        } else {
            $page = (int) $_GET["page"];
            $offset = $srt * $page - $srt;
        }
        if ($offset < 0) {
            $page = 1;
            $offset = 0;
        }
        $userRepo = new UserRepository();
        $users = $userRepo->all($offset, $srt);

        $total = ceil($users[0] / $srt);

        if ($page > $total) {
            $page = $total - 1;
        }

        $stack = [];
        $meta = [
            "total" => $users[0],
            "currentPage" => $page,
            "totalPages" => $total,
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

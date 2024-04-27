<?php
class InviteController
{
    private function generate_code() {
        $code = '';
        for ($i = 0; $i < 4; $i++) {
            $segment = '';
            for ($j = 0; $j < 5; $j++) {
                // generate a random number between 0 and 35
                $rand = mt_rand(0, 35);
                // map this number to [A-Z0-9]
                $char = $rand < 26 ? chr(ord('A') + $rand) : strval($rand - 26);
                $segment .= $char;
            }
            $code .= $segment;
            if ($i < 3) {
                $code .= '-';
            }
        }
        $db = Database::getDatabase();
        $stmt = $db->query('INSERT INTO invite_codes (code) VALUES (?)', ['s' => [$code]]);

        return $code;
    }

    public function how_to_generate($router) {
        header('Content-Type: application/json');
        return json_encode([
            0 => 200,
            "success" => 1,
            "data" => [
                "data" => "Va beqre gb trarengr gur vaivgr pbqr, znxr n CBFG erdhrfg gb /ncv/i1/vaivgr/trarengr",
                "enctype" => "ROT13"
            ],
            "hint" => "Data is encrypted ... We should probbably check the encryption type in order to decrypt it..."
        ]);
    }

    public function generate($router) {
        header('Content-Type: application/json');
        return json_encode([
            0 => 200,
            "success" => 1,
            "data" => [
                "code" => base64_encode($this->generate_code()),
                "format" => "encoded"
            ]
        ]);
    }

    public function verify($router) {
        if (!isset($_POST['code'])) {
            header('Content-Type: application/json');
            return json_encode([
                0 => 400,
                "success" => 0,
                "error" => [
                    "message" => "Missing parameter: code"
                ]
            ]);
        }

        $code = $_POST['code'];
        $db = Database::getDatabase();
        $stmt = $db->query('SELECT * FROM invite_codes WHERE code = ?', ['s' => [$code]]);
        $result = $stmt->fetch_assoc();

        if ($result) {
            header('Content-Type: application/json');
            return json_encode([
                0 => 200,
                "success" => 1,
                "data" => [
                    "message" => "Invite code is valid!"
                ]
            ]);
        } else {
            header('Content-Type: application/json');
            return json_encode([
                0 => 400,
                "success" => 0,
                "error" => [
                    "message" => "Invite code is invalid!"
                ]
            ]);
        }
    }

}

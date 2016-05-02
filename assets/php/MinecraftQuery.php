<?php
/*
 * MinecraftQuery
 * Class written by: xPaw
 * Modified by: Gamecrafter
 * Website: http://xpaw.me
 * GitHub: https://github.com/xPaw/PHP-Minecraft-Query/blob/master/src/MinecraftQuery.php
 */
class MinecraftQuery{
    const STATISTIC = 0x00; //0
    const HANDSHAKE = 0x09; //9
    /** @var array|bool */
    private $info;
    /** @var array|bool */
    private $players;
    /** @var mixed */
    private $socket;
    /**
     * @param string $ip
     * @param int $port
     * @param int $timeout
     * @throws \InvalidArgumentException
     * @throws MinecraftQueryException
     */
    public function connect($ip, $port = 19132, $timeout = 3){
	if(!is_int($timeout) or $timeout < 0){
            throw new \InvalidArgumentException("Timeout must be an integer.");
	}
	$this->socket = @fsockopen("udp://".$ip, (int) $port, $errno, $errstr, $timeout);
	if($errno or !$this->socket){
            throw new MinecraftQueryException("Could not create socket: ".$errstr);
        }
	stream_set_timeout($this->socket, $timeout);
	stream_set_blocking($this->socket, true);
	try{
            $this->getStatus($this->getChallenge());
	}
	catch(MinecraftQueryException $exception){
            fclose($this->socket);
            throw new MinecraftQueryException($exception->getMessage());
	}
	fclose($this->socket);
    }
    /**
     * @return array|bool
     */
    public function getInfo(){
	return isset($this->info) ? $this->info : false;
    }
    /**
     * @return array|bool
     */
    public function getPlayers(){
	return isset($this->players) ? $this->players : false;
    }
    /**
     * @return string
     * @throws MinecraftQueryException
     */
    private function getChallenge(){
	$data = $this->writeData(self::HANDSHAKE);
	if($data === false){
            throw new MinecraftQueryException("Failed to receive challenge.");
	}
        return pack("N", $data);
    }
    /**
     * @param string $challenge
     * @throws MinecraftQueryException
     */
    private function getStatus($challenge){
	$data = $this->writeData(self::STATISTIC, $challenge.pack("c*", 0x00, 0x00, 0x00, 0x00));
	if(!$data){
            throw new MinecraftQueryException("Failed to receive status.");
	}
        $last = "";
        $info = [];
	$data = substr($data, 11);
	$data = explode("\x00\x00\x01player_\x00\x00", $data);
        if(count($data) !== 2){
            throw new MinecraftQueryException("Failed to parse server's response.");
	}
	$players = substr($data[1], 0, -2);
	$data = explode("\x00", $data[0]);
        $keys = [
            "hostname" => "hostname",
            "gametype" => "gametype",
            "game_id" => "game_id",
            "version" => "version",
            "server_engine" => "server_engine",
            "plugins" => "plugins",
            "map" => "map",
            "numplayers" => "numplayers",
            "maxplayers" => "maxplayers",
            "hostip" => "hostip",
            "hostport" => "hostport"
        ];
	foreach($data as $key => $value){
            if(~$key & 1){
		if(!array_key_exists($value, $keys)){
                    $last = false;
                    continue;
                }
		$last = $keys[$value];
		$info[$last] = "";
            }
            elseif($last != false){
		$info[$last] = mb_convert_encoding($value, "UTF-8");
            }
	}
	$info["numplayers"] = (int) $info["numplayers"];
	$info["maxplayers"] = (int) $info["maxplayers"];
	$info["hostport"] = (int) $info["hostport"];
	if($info["plugins"]){
            $data = explode(": ", $info["plugins"], 2);
            $info["rawplugins"] = $info["plugins"];
            $info["server_engine"] = $data[0];
            if(count($data) == 2){
		$info["plugins"] = explode("; ", $data[1]);
            }
        }
	else{
            $info["server_engine"] = "Vanilla";
	}
	$this->info = $info;
	if(empty($players)){
            $this->players = null;
	}
	else{
            $this->players = explode("\x00", $players);
	}
    }
    /**
     * @param string $command
     * @param string $append
     * @return mixed
     * @throws MinecraftQueryException
     */
    private function writeData($command, $append = ""){
	$command = pack("c*", 0xFE, 0xFD, $command, 0x01, 0x02, 0x03, 0x04).$append;
	$length = strlen($command);
	if($length !== fwrite($this->socket, $command, $length)){
            throw new MinecraftQueryException("Failed to write on socket.");
	}
	$data = fread($this->socket, 4096);
	if($data === false){
            throw new MinecraftQueryException("Failed to read from socket.");
	}
	if(strlen($data) < 5 or $data[0] != $command[2]){
            return false;
	}
	return substr($data, 5);
    }
}
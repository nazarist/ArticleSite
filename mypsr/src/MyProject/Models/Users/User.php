<?php


namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiverecordEntity;


class User extends ActiverecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConformet;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createAt;




    protected static function getTableName(): string{
        return 'users';
    }


	public function getNickname(): string {
		return $this->nickname;
	}
	

	public function setNickname($nickname) {
		$this->nickname = $nickname;
	}
	

	public function getEmail(): string {
		return $this->email;
	}
	

	public function setEmail($email) {
		$this->email = $email;
	}
	

	public function getIsConformet(): bool {
		return $this->isConformet;
	}
	

	public function setIsConformet($isConformet) {
		$this->isConformet = $isConformet;
	}


	public function getRole(): string{
		return $this->role;
	}
	

	public function setRole($role){
		$this->role = $role;
		return $this;
	}


	public function getPasswordHash(): string {
		return $this->passwordHash;
	}
	

	public function setPasswordHash($passwordHash) {
		$this->passwordHash = $passwordHash;
	}


	public function getAuthToken(): string {
		return $this->authToken;
	}
	

	public function setAuthToken($authToken){
		$this->authToken = $authToken;
	}
	

	public function getCreateAt():string {
		return $this->createAt;
	}
	

	public function setCreateAt($createAt) {
		$this->createAt = $createAt;
	}

	protected static function setUserCookie(User $user): void{
		setcookie('authToken', $user->getAuthToken(), 0, '/');
		setcookie('nickname', $user->getNickname(), 0, '/');
		setcookie('role', $user->getRole(), 0, '/');
	}


	public static function reviewSingUp($post): User{
		$nickname = static::cleaningString($post['nickname']);
		$email = $post['email'];
		$password = $post['password'];
		$role = $post['role'];


		//nickname review
		if(!static::checkLenght($nickname, 3, 40)){
			throw new InvalidArgumentException('*Nickname must be from 4 to 40 sumbols');
		}elseif(static::findByOneColumn('nickname', $nickname)){
			throw new InvalidArgumentException('*this nickname already exists');
		}elseif(!preg_match('~^[\w\.]+$~', $nickname)){
			throw new InvalidArgumentException('*nickname entered incorrectly');
		}

		//emaiil review
		if(empty($email)){
			throw new InvalidArgumentException('*enter your email adres');
		}elseif(static::findByOneColumn('email', $email)){
			throw new InvalidArgumentException('*this email already exists');
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			throw new InvalidArgumentException('*email entered incorrectly');
		}

		//password review 
		if(empty($password)){
			throw new InvalidArgumentException('*enter password');
		}elseif(mb_strlen($password) < 8){
			throw new InvalidArgumentException('*password must have from 8 sumbols');
		}
		
		
		$user = new User();
		$user->nickname = $nickname;
		$user->email = $email;
		$user->role = $role;
		$user->passwordHash = password_hash($password, PASSWORD_DEFAULT);
		$user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
		$user->save();

		static::setUserCookie($user);
		return $user;
	}


	public static function login($post): void{
		$email = $post['email'];
		$password = $post['password'];

		//review email
		if(empty($email)){
			throw new InvalidArgumentException('*enter your email adres');
		}
		//review password
		if(empty($password)){
			throw new InvalidArgumentException('*enter your password');
		}

		$user = User::findByOneColumn('email', $email);
		
		if($user === null){
			throw new InvalidArgumentException('*user with this email does not exists');
		}elseif(!password_verify($password, $user->getPasswordHash())){
			throw new InvalidArgumentException('*incorrect password');
		}

		static::setUserCookie($user);
	}
}
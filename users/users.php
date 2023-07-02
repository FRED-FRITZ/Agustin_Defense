<?php
include '../Database/db.php';
include '../interface.php';
class Users Extends Database implements Table
{
    public function createTable()
    {
        $this->dbconn();

        $table="CREATE TABLE IF NOT EXISTS users(
        id int primary key auto_increment, 
        first_name varchar(255) not null,
        last_name varchar(255) not null,
        password varchar(255)not null,
        nickname varchar(255)not null,
        birth_date int not null)";

        $this->conn->query($table);
    }

    public function create($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return json_encode([
                'code' => 422,
                'message' => 'POST method is only allowed!'               
            ]);
        }
        if(!isset($params['first_name']) || empty($params['first_name']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'firstname is required',
			]);
        }
        if(!isset($params['last_name']) || empty($params['last_name']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'lastname is required',
			]);
        }
        if(!isset($params['password']) || empty($params['password']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'password is required',
			]);
        }
        if(!isset($params['nickname']) || empty($params['nickname']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'nickname is required',
			]);
        }
        if(!isset($params['birth_date']) || empty($params['birth_date']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'birthdate is required',
			]);
        }
            $first_name = $params[ 'first_name'];
		    $last_name = $params[ 'last_name'];
            $password = $params[ 'password'];
            $nickname = $params[ 'nickname'];
            $birth_date = $params[ 'birth_date'];
            $sql = "INSERT INTO users(first_name,last_name,password,nickname,birth_date) VALUES ('$first_name','$last_name','$password','$nickname','$birth_date')";
		    $isadded=$this->conn->query($sql);
		    if ($isadded)
        {
            return json_encode([
                'code' => 200,
                'message' => 'users sucessfully added'
            ]);
        } else 
            {
                return json_encode([
                    'code' => 500,
                    'message' => $this->getError()
                ]);
            }
        }

    public function read()
    {
        $user=$this->conn->query("SELECT * FROM users");
		$userlist=[];
		return json_encode($user->fetch_all(MYSQLI_ASSOC));
    }

    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return json_encode([
                'code' => 422,
                'message' => 'POST method is only allowed!'               
            ]);
        }
        if(!isset($params['id']) || empty($params['id']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'id is required',
			]);
		}
        if(!isset($params['first_name']) || empty($params['first_name']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'firstname is required',
			]);
        }
        if(!isset($params['last_name']) || empty($params['last_name']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'lastname is required',
			]);
        }
        if(!isset($params['password']) || empty($params['password']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'password is required',
			]);
        }
        if(!isset($params['nickname']) || empty($params['nickname']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'nickname is required',
			]);
        }
        if(!isset($params['birth_date']) || empty($params['birth_date']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'birthdate is required',
			]);
        }

        $id = $params['id'];
        $first_name = $params[ 'first_name'];
        $last_name = $params[ 'last_name'];
        $password = $params[ 'password'];
        $nickname = $params[ 'nickname'];
        $birth_date = $params[ 'birth_date'];
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', password = '$password', nickname = '$nickname',  birth_date = '$birth_date' where id ='$id'";
        $isupdated=$this->conn->query($sql);
        if ($isupdated)
    {
        return json_encode([
            'code' => 200,
            'message' => 'users sucessfully updated'
        ]);
    } else 
        {
            return json_encode([
                'code' => 500,
                'message' => $this->getError()
            ]);
        }
        
       
    }

    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET')
        {
            return json_encode([
                'code' => 422,
                'message' => 'GET method is only allowed!'               
            ]);
        }
        if(!isset($params['id']) || empty($params['id']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'id is required',
			]);
		}
		$id = $params ['id'];
		$sql ="DELETE FROM users where id ='$id'";
		$isdeleted=$this->conn->query($sql);
		if ($isdeleted){

		return json_encode([
			'code' => 200,
			'message' => 'users sucessfully deleted'
		]);
		} else {
			return json_encode([
				'code' => 500,
				'message' => $this->getError()
			]);
	    }
    }

    public function search($params) 
    {

        if ($_SERVER['REQUEST_METHOD'] != 'GET')
        {
			return json_encode([
				'code' => 422,
				'message' => 'GET method is only allowed!'
			]);
		}
    
        $firstname= $params['first_name'] ?? '';
        $sql = "SELECT * FROM users where first_name like '%$firstname%'";
        $users = $this->conn->query($sql);
        if (empty($this->getError()))
        {
            return json_encode($users->fetch_all(MYSQLI_ASSOC));
        } else 
            {
                return json_encode([
                'code' => 500,
                'message' => $this->getError()
            ]);
        }
		
    }
    
    public function authentication()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
        echo json_encode([
            'code' => 401,
            'message' => 'Authentication is required!'
        ]);
        } else {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            $sql = $this->conn->query("SELECT * FROM users");
        // Here, you can perform validation or check against a database of users
            
        // Example: Check if the username and password are correct
        if ($username === 'defense' && $password === 'agustin123') {
            echo json_encode([
                'code' => 200,
                'message' => 'authentication successful!'
                ]);
            // Continue with the protected content or redirect to another page
            return json_encode($sql->fetch_all(MYSQLI_ASSOC));
        } else {
            echo json_encode([
                'code' => 401,
                'message' => 'Invalid Authentication!'
                ]);
            }
        }
    }
}

?>
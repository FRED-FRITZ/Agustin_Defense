<?php
include '../Database/db.php';
include '../interface.php';

class Artists Extends Database implements Table
{
    public function createTable()
    {
        $this->dbconn();

        $table="CREATE TABLE IF NOT EXISTS artist(
        id int primary key auto_increment, 
        first_name varchar(255) not null,
        last_name varchar(255) not null,
        nationality varchar(255)not null,
        age int not null)";

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
        if(!isset($params['nationality']) || empty($params['nationality']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'nationality is required',
			]);
        }
        if(!isset($params['age']) || empty($params['age']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'age is required',
			]);
        }
            $first_name = $params[ 'first_name'];
		    $last_name = $params[ 'last_name'];
            $nationality = $params[ 'nationality'];
            $age = $params[ 'age'];
            $sql = "INSERT INTO artist(first_name,last_name,nationality,age) VALUES ('$first_name','$last_name','$nationality','$age')";
		    $isadded=$this->conn->query($sql);
		    if ($isadded)
        {
            return json_encode([
                'code' => 200,
                'message' => 'Artist sucessfully added'
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
        $artist=$this->conn->query("SELECT * FROM artist");
		$artistlist=[];
		return json_encode($artist->fetch_all(MYSQLI_ASSOC));
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
        if(!isset($params['nationality']) || empty($params['nationality']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'nationality is required',
			]);
        }
        if(!isset($params['age']) || empty($params['age']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'age is required',
			]);
        }

        $id = $params['id'];
        $first_name = $params[ 'first_name'];
        $last_name = $params[ 'last_name'];
        $nationality = $params[ 'nationality'];
        $age = $params[ 'age'];
        $sql = "UPDATE artist SET first_name = '$first_name', last_name = '$last_name', nationality = '$nationality', age = '$age' where id ='$id'";
        $isupdated=$this->conn->query($sql);
        if ($isupdated)
    {
        return json_encode([
            'code' => 200,
            'message' => 'Artist sucessfully updated'
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
		$sql ="DELETE FROM artist where id ='$id'";
		$isdeleted=$this->conn->query($sql);
		if ($isdeleted){

		return json_encode([
			'code' => 200,
			'message' => 'ARTISTS sucessfully deleted'
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
    
        $firstname= $params['last_name'] ?? '';
        $sql = "SELECT * FROM artist where last_name like '%$firstname%'";
        $artist = $this->conn->query($sql);
        if (empty($this->getError()))
        {
            return json_encode($artist->fetch_all(MYSQLI_ASSOC));
        } else 
            {
                return json_encode([
                'code' => 500,
                'message' => $this->getError()
                ]);
            }
		
    }


}
$call = new Artists();
$call->createTable();
?>
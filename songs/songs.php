<?php
include '../Database/db.php';
include '../interface.php';

class songs Extends Database implements Table
{
    public function createTable()
    {
        $this->dbconn();

        $table="CREATE TABLE IF NOT EXISTS SONGS (id int primary key auto_increment,
        id int primary key auto_increment, 
        first_name varchar(255) not null,
        last_name varchar(255) not null,
        song varchar(255)not null,
        released int not null)";

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
        if(!isset($params['song']) || empty($params['song']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'song is required',
			]);
        }
        if(!isset($params['released']) || empty($params['released']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'released is required',
			]);
        }
            $first_name = $params[ 'first_name'];
		    $last_name = $params[ 'last_name'];
            $song = $params[ 'song'];
            $released = $params[ 'released'];
            $sql = "INSERT INTO SONGS(first_name,last_name,song,released) VALUES ('$first_name','$last_name','$song','$released')";
		    $isadded=$this->conn->query($sql);
		    if ($isadded)
        {
            return json_encode([
                'code' => 200,
                'message' => 'Song sucessfully added'
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
        $song=$this->conn->query("SELECT * FROM SONGS");
		$songlist=[];
		return json_encode($song->fetch_all(MYSQLI_ASSOC));
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
        if(!isset($params['song']) || empty($params['song']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'song is required',
			]);
        }
        if(!isset($params['released']) || empty($params['released']))
        {
            return json_encode([

				'code' =>422,
				'message' => 'released is required',
			]);
        }

        $id = $params['id'];
        $first_name = $params[ 'first_name'];
        $last_name = $params[ 'last_name'];
        $song = $params[ 'song'];
        $released = $params[ 'released'];
        $sql = "UPDATE SONGS SET first_name = '$first_name', last_name = '$last_name', song = '$song', released = '$released' where id ='$id'";
        $isupdated=$this->conn->query($sql);
        if ($isupdated)
    {
        return json_encode([
            'code' => 200,
            'message' => 'Song sucessfully updated'
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
		$sql ="DELETE FROM SONGS where id ='$id'";
		$isdeleted=$this->conn->query($sql);
		if ($isdeleted){

		return json_encode([
			'code' => 200,
			'message' => 'SONGS sucessfully deleted'
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
        $sql = "SELECT * FROM SONGS where first_name like '%$firstname%'";
        $songs = $this->conn->query($sql);
        if (empty($this->getError()))
        {
            return json_encode($songs->fetch_all(MYSQLI_ASSOC));
        } else 
            {
                return json_encode([
                'code' => 500,
                'message' => $this->getError()
                ]);
            }
		
    }


}
?>
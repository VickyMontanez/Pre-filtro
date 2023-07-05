<?php
namespace App;

class cities extends connect
{
    private $queryPost = 'INSERT INTO cities(id, name_city, id_region) VALUES (:identification, :name_city, :regionId)';
    private $queryGet = 'SELECT id AS "identification", SELECT name_city AS "name_city", SELECT id_region AS "regionId" FROM cities';
    private $queryUpdate = 'UPDATE cities SET name_city = :name_city, id_region = :regionId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM cities WHERE id = :identification';
    private $msg;
    use getInstance;

    //* Constructor */
    function __construct(private $id = 1, private $name_city= 1, private $regionId = 1)
    {
        parent::__construct();
    }

    //* POST Function */
    public function citiesPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("name_city", $this->name_city);
            $res->bindValue("staffId", $this->id_staff);
         
            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* GET Function */
    public function citiesGet()
    {
        try {
            $res = $this->conx->prepare($this->queryGet);
            $res->execute();

            $this->msg = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //* UPDATE Function */
    function citiesUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("positionId", $this->id_position);
            $res->bindValue("journeyId", $this->id_journey);
            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* DELETE Function */
    function citiesDelete()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identification", $this->id);
            $res->execute();

            $this->msg = ["Code" => 200, "Message" => "Deleted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }



}
?>
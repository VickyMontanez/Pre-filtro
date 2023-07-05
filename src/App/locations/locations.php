<?php
namespace App;

class maint_area extends connect
{
    private $queryPost = 'INSERT INTO maint_area(id, id_area, id_staff, id_position, id_journey) VALUES (:identification, :areaId, :staffId, :positionId, journeyId)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_area AS "areaId", SELECT id_staff AS "staffId", SELECT id_position AS "positionId", SELECT id_journey AS "journerysId FROM maint_area';
    private $queryUpdate = 'UPDATE maint_area SET id_area = :areaId, id_staff = :staffId, id_position = :positionId, id_journey = :journeyId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM maint_area WHERE id = :identification';
    private $msg;
    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $id_area = 1, private $id_staff = 1, private $id_position, private $id_journey = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function maintAreaPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("positionId", $this->id_position);
            $res->bindValue("journeyId", $this->id_journey);

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function maintAreaGet()
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

    //? UPDATE Function */
    function maintAreaUpdate()
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
    //? DELETE Function */
    function maintAreaDelete()
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
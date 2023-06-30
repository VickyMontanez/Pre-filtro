<?php
namespace App;

class campers extends connect
{
    private $queryPost = 'INSERT INTO campers(id, id_team_schedule, id_route, id_trainer, id_psycologist, id_teacher, id_level, id_journey, id_staff) VALUES (:identification, :id_team_schedule, :id_route, :id_trainer, :id_psycologist, :id_teacher, :id_level, :id_journey, :id_staff)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "id_staff", SELECT id_team_schedule AS "id_team_schedule", SELECT id_route AS "id_route", SELECT id_trainer AS "id_trainer", SELECT id_psycologist AS "id_psycologist", SELECT id_teacher AS "id_teacher", SELECT id_level AS "id_level", SELECT id_journey AS "id_journey" FROM campers';
    private $queryUpdate = 'UPDATE campers SET id_staff = :id_staff, id_team_schedule = :id_team_schedule, id_route = :id_route, id_trainer = :id_trainer, id_psycologist = :id_psycologist, id_teacher = :id_teacher, id_level = :id_level, id_journey = :id_journey WHERE id = :identification';
    private $queryDelete = 'DELETE FROM campers WHERE id = :identification';
    private $msg;
    use getInstance;

    //* Constructor */
    function __construct(private $id = 1, private $id_team_schedule= 1, private $id_route= 1, public $id_trainer = 1, public $id_psycologist = 1, private $id_teacher = 1, private $id_level = 1, private $id_journey = 1, private $id_staff = 1)
    {
        parent::__construct();
    }

    //* POST Function */
    public function campersPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("id_staff", $this->id_staff);
            $res->bindValue("id_team_schedule", $this->id_team_schedule);
            $res->bindValue("id_route", $this->id_route);
            $res->bindValue("id_trainer", $this->id_trainer);
            $res->bindValue("id_psycologist", $this->id_psycologist);
            $res->bindValue("id_teacher", $this->id_teacher);
            $res->bindValue("id_level", $this->id_level);
            $res->bindValue("id_journey", $this->id_journey);

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* GET Function */
    public function campersGet()
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
    function campersUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

           
            $res->bindValue("identification", $this->id);
            $res->bindValue("id_staff", $this->id_staff);
            $res->bindValue("id_team_schedule", $this->id_team_schedule);
            $res->bindValue("id_route", $this->id_route);
            $res->bindValue("id_trainer", $this->id_trainer);
            $res->bindValue("id_psycologist", $this->id_psycologist);
            $res->bindValue("id_teacher", $this->id_teacher);
            $res->bindValue("id_level", $this->id_level);
            $res->bindValue("id_journey", $this->id_journey);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* DELETE Function */
    function campersDelete()
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
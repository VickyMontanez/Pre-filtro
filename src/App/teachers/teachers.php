<?php
namespace App;

class teachers extends connect
{
    private $queryPost = 'INSERT INTO teachers(id, id_staff, id_route, id_academic_area, id_position, id_team_educator) VALUES (:identification, :id_staff, :id_route, :id_academic_area, :id_position, :id_team_educator)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "id_staff", SELECT id_route AS "id_route", SELECT id_academic_area AS "id_academic_area", SELECT id_position AS "id_position", SELECT id_team_educator AS "id_team_educator" FROM teachers
        INNER JOIN staff ON teachers.id_staff = staff.id,
        INNER JOIN routes ON teachers.id_route = routes.id,
        INNER JOIN academic_area ON teachers.id_academic_area = academic_area.id,
        INNER JOIN position ON teachers.id_position = position.id,
        INNER JOIN team_educators ON teachers.id_team_educator = team_educators.id';
    private $queryUpdate = 'UPDATE teachers SET id_staff = :id_staff, id_route AS :id_route, id_academic_area AS :id_academic_area, id_position AS :id_position, id_team_educator AS :id_team_educator WHERE id = :identification';
    private $queryDelete = 'DELETE FROM teachers WHERE id = :identification';
    private $msg;

    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $id_staff = 1, private $id_route = 1, private $id_academic_area = 1, private $id_position = 1, private $id_team_educator = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function teachersPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("id_staff", $this->id_staff);
            $res->bindValue("id_route", $this->id_route);
            $res->bindValue("id_academic_area", $this->id_academic_area);
            $res->bindValue("id_position", $this->id_position);
            $res->bindValue("id_team_educator", $this->id_team_educator);

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function teachersGet()
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
    function teachersUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);


            $res->bindValue("identification", $this->id);
            $res->bindValue("id_staff", $this->id_staff);
            $res->bindValue("id_route", $this->id_route);
            $res->bindValue("id_academic_area", $this->id_academic_area);
            $res->bindValue("id_position", $this->id_position);
            $res->bindValue("id_team_educator", $this->id_team_educator);
            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function teachersDelete()
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
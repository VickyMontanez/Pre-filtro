<?php
namespace App;

class staff extends connect
{
    private $queryPost = 'INSERT INTO staff(id, doc, first_name, second_name, first_surname, second_surname, eps, id_area, id_city) VALUES(:identificacion, :doc, :firstName, :secondname, :firstSurname, :secondSurname, :eps, :areaId, :cityId)';
    private $queryGet = 'SELECT id AS "identification", SELECT doc AS "doc", SELECT first_name AS "firstName",  SELECT second_name AS "secondName",  SELECT first_surname AS "firstSurname",  SELECT second_surname AS "secondSurname",  SELECT eps AS "eps", SELECT id_area AS "areaId", SELECT id_city AS "cityId" FROM staff
        INNER JOIN areas ON staff.id_area = areas.id,
        INNER JOIN cities ON staff.id_city = cities.id,
    ';
    private $queryUpdate = 'UPDATE staff SET doc = :doc, first_name = :firstName, second_name = :secondName, first_surname = :firstSurname, second_surname = :secondSurname, eps = :eps, id_area = :areaId, id_city = :cityId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM staff WHERE id = :identification';
    private $msg;

    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $doc = 1, private $first_name = 1, private $second_name = 1, private $first_surname = 1, private $second_surname = 1, private $eps = 1, private $id_area = 1, private $id_city = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function staffPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("doc", $this->doc);
            $res->bindValue("firstName", $this->first_name);
            $res->bindValue("secondName", $this->second_name);
            $res->bindValue("firstSurname", $this->first_surname);
            $res->bindValue("secondSurname", $this->second_surname);
            $res->bindValue("eps", $this->eps);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("cityId", $this->id_city);
            
            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function staffGet()
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
    function staffUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("doc", $this->doc);
            $res->bindValue("firstName", $this->first_name);
            $res->bindValue("secondName", $this->second_name);
            $res->bindValue("firstSurname", $this->first_surname);
            $res->bindValue("secondSurname", $this->second_surname);
            $res->bindValue("eps", $this->eps);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("cityId", $this->id_city);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function staffDelete()
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
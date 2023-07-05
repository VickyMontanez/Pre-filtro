<?php
namespace App\position;
use App\db\connect;
use App\Singleton;
class position extends connect
{
    private $queryPost = 'INSERT INTO position(id, name_position, arl) VALUES (:identification, :name_position, :arl)';
    private $queryGet = 'SELECT id AS "identification", SELECT name_position AS "name_position", SELECT arl AS "arl" FROM position';
    private $queryUpdate = 'UPDATE position SET name_position = :name_position, arl = :arl WHERE id = :identification';
    private $queryDelete = 'DELETE FROM position WHERE id = :identification';
    private $msg;

    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $name_position= 1, private $arl = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function positionPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("position", $this->name_position);
            $res->bindValue("arl", $this->arl);


            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function positionGet()
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
    function positionUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("position", $this->name_position);
            $res->bindValue("arl", $this->arl);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function positionDelete()
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
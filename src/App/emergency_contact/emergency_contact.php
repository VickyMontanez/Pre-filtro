<?php
namespace App;

class emergency_contact extends connect
{
    private $queryPost = 'INSERT INTO emergency_contact(id, id_staff, cel_number, relationship, full_name, email) VALUES (:identification, :staffId, :cel, :relationship, :name, :email)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "staffId", SELECT cel_number AS "cel", SELECT relationship AS "relationship", SELECT full_name AS "name", SELECT email AS "email" FROM emergency_contact';
    private $queryUpdate = 'UPDATE emergency_contact SET id_staff = :staffId, relationship = :relationship, full_name = :name, email = :email WHERE id = :identification';
    private $queryDelete = 'DELETE FROM emergency_contact WHERE id = :identification';
    private $msg;

    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $id_staff= 1, private $cel_number= 1, public $relationship = 1, public $full_name = 1, private $email = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function emergencyContactPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relationship", $this->relationship);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("email", $this->email);
         

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function emergencyContactGet()
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
    function emergencyContactUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relationship", $this->relationship);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("email", $this->email);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function emergencyContactDelete()
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
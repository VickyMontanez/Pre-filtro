<?php
namespace App;

class contact_info extends connect
{
    private $queryPost = 'INSERT INTO contact_info(id, id_staff, whatsapp, instagram, linkedin, email, address, cel_number) VALUES (:identification, :staffId, :whatsapp, :instagram, :linkedin, :email, :address, :cel)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "staffId", SELECT whatsapp AS "whatsapp", SELECT instagram AS :instagram, SELECT linkedin AS "linkedin", SELECT email AS "email", SELECT address AS "address", SELECT cel_number AS "cel" FROM contact_info';
    private $queryUpdate = 'UPDATE contact_info SET id_staff = :staffId, whatsapp = :whatsapp, instagram = :instagram, linkedin = :linkedin, email = :email, address = :address, cel_number = :cel WHERE id = :identification';
    private $queryDelete = 'DELETE FROM contact_info WHERE id = :identification';
    private $msg;
    use getInstance;

    //* Constructor */
    function __construct(private $id = 1, private $id_staff= 1, private $whatsapp= 1, public $instagram = 1, public $linkedin = 1, private $email = 1, private $address = 1, private $cel_number = 1)
    {
        parent::__construct();
    }

    //* POST Function */
    public function contactInfoPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("whatsapp", $this->whatsapp);
            $res->bindValue("instagram", $this->instagram);
            $res->bindValue("linkedin", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("address", $this->address);
            $res->bindValue("cel", $this->cel_number);

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* GET Function */
    public function contactInfoGet()
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
    function contactInfoUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("whatsapp", $this->whatsapp);
            $res->bindValue("instagram", $this->instagram);
            $res->bindValue("linkedin", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("address", $this->address);
            $res->bindValue("cel", $this->cel_number);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* DELETE Function */
    function contactInfoDelete()
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
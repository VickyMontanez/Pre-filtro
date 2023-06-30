<?php
namespace App;

//? Conector
class academic_area extends connect{

    //?Querys o Consultas
    private $queryPost = 'INSERT INTO academic_area(id, id_area, id_staff, id_position, id_journeys) VALUES (:identification, :areaId, :staffId, :positionId, :journeysId)';
    private $queryGetAll = 'SELECT * FROM tb_client';
    private $queryDelete = 'DELETE FROM tb_client WHERE client_id = :clientId';
    private $queryUpdate = 'UPDATE tb_client SET client_fullname = :fullName, client_email = :email, client_address = :address, client_phone = :phone WHERE identificacion = :clientId';
    private $msg;
    use getInstance;
    //? Constructor
    function __construct(private $id, private $id_area, private $id_staff, private $id_position, private $id_journeys){
        parent::__construct();
    }

    //? Funciones
    //* FUNCIÓN POST
    public function academicAreaPost(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identification", $this->id);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("positionId", $this->id_position);
            $res->bindValue("journeysId", $this->id_journeys);
            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\Throwable $th) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //* FUNCION GET
    public function academicAreaGet(){
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

    //* FUNCIO UPDATE
    function academicAreaUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

            $res->bindValue("identification", $this->id);
            $res->bindValue("areaId", $this->id_area);
            $res->bindValue("staffId", $this->id_staff);
            $res->bindValue("positionId", $this->id_position);
            $res->bindValue("journeysId", $this->id_journeys);
            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //* FUNCION DELETE
    function academicAreaDelete()
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
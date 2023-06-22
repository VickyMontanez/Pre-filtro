<?php
/* Con "trait" se utiliza para reutilizar código, en este caso la instancia "getInstance" en múltiples clases */

trait getInstance{
    /* Se declara la variable estática "$instance" */
    public static $instance;
    /* Se declara la función estática "getInstance" */
    public static function getInstance(){

        /* Se obtienen los argumentos de la función y se guardan en la variable "$arg"  */
        $arg = func_get_args();

        /* Se extrae el último elemnto del array "$arg" y se guarda en la misma variable*/
        $arg = array_pop($arg);

        /* Si la propiedad "$instance" es (!) diferente de la clase actual (self) O si "$arg" NO(!) está vacío (empty), entonces (?) SI SE CUMPLE se crea una nueva instancia "self::$instance = new static" con las mismas características de arriba "$instance": ( Se pasan los argumentos cómo array , ... -----> se separan para pasarse al constructor) O SI NO SE CUMPLE retorna la intancia ya existente "self::$instance"*/
        return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
    }
    
    function __set($name, $value){
        $this->$name = $value;
    }

}

function autoload($class){
    /* Array de archivos */
    $directories = [
        /* Se pasa la ruta del servitor y se concatena (.) la carpeta (/) y el nombre del archivo */
        dirname(__DIR__) . '/scripts/bill/',
        dirname(__DIR__) . '/scripts/client/',
        dirname(__DIR__) . '/scripts/products/',
        dirname(__DIR__) . '/scripts/seller/',
        dirname(__DIR__) . '/scripts/db/'
    ];
    /* variable que reemplaza las barras invertidas (\) por barras normales (/) en elnombre de la clase ($class) y se le concatena (.) ".php" */
    $classFile = str_replace('\\', '/', $class) . '.php';

    /* Se itera cada elemento del array "$directories" */
    foreach ($directories as $directory) {

        /* Y a la variable "$file" por cada directorio se le asigna la ruta completa del archivo  */
        $file = $directory.$classFile;

        /* Verifica si la clase existe en la ruta ya especificada */
        if (file_exists($file)) {
            /* Si existe carguelo y retornelo */
            require $file;
            return;
        }
    }
}

/* Permite registrar múltiples funciones que PHP colocará en una cola y llamará secuencialmente cuando se declare una "nueva Clase". */
spl_autoload_register('autoload');

client::getInstance(json_decode(file_get_contents("php://input"), true))->postClient();
product::getInstance(json_decode(file_get_contents("php://input"), true))->postProduct();
seller::getInstance(json_decode(file_get_contents("php://input"), true))->postSeller();
bill::getInstance(json_decode(file_get_contents("php://input"), true))->postBill();
?>

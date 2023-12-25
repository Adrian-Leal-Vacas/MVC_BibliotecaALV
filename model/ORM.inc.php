<?php
    include_once "Libro.inc.php";
    class ORM {
        //Atributos de conexión a base de datos
        private static $host = "localhost";
		private static $user = "mvcBiblioteca";
		private static $password = "1234";
		private static $database = "mvcBiblioteca";
        // Metodos
        // Persist
        public function persist(&$object) {
            try {
                // Variable para obtener el siguente id
                $id = 0;
                try {
                    $dbConection = new PDO("mysql:host=".self::$host.";dbname=".self::$database."",self::$user,self::$password);
                } catch(Exception $e) {
                    echo "Connection failed" . $e->getMessage();  
                }
                try {
                    $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $dbConection->beginTransaction();
                    // Sentencia SQL para obtener el id
                    // Querry
                    $querryId = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".self::$database."' AND TABLE_NAME = '".get_class($object)."';";
                    // Sentencia para el id
                    $sentencia = $dbConection->prepare($querryId);
                    if ($sentencia->execute()) {
                        while ($fila = $sentencia->fetch()) {
                            $id = $fila;
                        }
                    }
                    $dbConection->commit();
                } catch (Exception $e) {
                    $dbConection->rollBack();
                    echo "Fallo: " . $e->getMessage();
                }
                //Asignamos el id de base de datos al objeto
			    $object->setId($id["AUTO_INCREMENT"]);
                try {
                    $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $dbConection->beginTransaction();
				    //Insertamos el objeto en la base de datos
                    // Primero tenemos qeu saber de que clase viene para la querry
                    
                        // Querry
                        $querryInsert = "INSERT INTO ".get_class($object)." VALUES (?,?,?,?)";
                        // Sentencia
                        $sentencia = $dbConection->prepare($querryInsert);
                        // Recoger datos
                        $id = $object->getId();
                        $titulo = $object->getTitulo();
                        $autor = $object->getAutor();
                        $descripcion = $object->getDescripcion();
                        // Parametros
                        $sentencia->bindParam(1, $id);
                        $sentencia->bindParam(2, $titulo);
                        $sentencia->bindParam(3, $autor);
                        $sentencia->bindParam(4, $descripcion);
                        $sentencia->execute();
                        $dbConection->commit();
                } catch(Exception $e) {
                    $dbConection->rollBack();
                    echo "Fallo: " . $e->getMessage();
                }
            } catch(Exception $e) {
    
            } finally {
                $dbConection = null;
            }
        }
        // flush
        public function flush(&$object) {
            try {
                $dbConection = new PDO("mysql:host=".self::$host.";dbname=".self::$database."",self::$user,self::$password);
            } catch(Exception $e) {
                echo "Connection failed" . $e->getMessage();  
            }
            try {
                $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbConection->beginTransaction();
                // Actualizaremos todos los atributos del objeto
                
                    // Querry
                    $querryInsert = "UPDATE ".get_class($object)." SET titulo = ?, autor = ?, descripcion = ? WHERE id = ?";
                    // Sentencia
                    $sentencia = $dbConection->prepare($querryInsert);
                    // Recoger datos
                    $id = $object->getId();
                    $titulo = $object->getTitulo();
                    $autor = $object->getAutor();
                    $descripcion = $object->getDescripcion();
                    // Parametros
                    $sentencia->bindParam(1, $titulo);
                    $sentencia->bindParam(2, $autor);
                    $sentencia->bindParam(3, $descripcion);
                    $sentencia->bindParam(4, $id);
                $sentencia->execute();
				$dbConection->commit();
            } catch(Exception $e) {
                $dbConection->rollBack();
				echo "Fallo: " . $e->getMessage();
            } finally {
                $dbConection = null;
            }
        }
        // findAll
        public function findAll($table) {
            try {
                $dbConection = new PDO("mysql:host=".self::$host.";dbname=".self::$database."",self::$user,self::$password);
            } catch(Exception $e) {
                echo "Connection failed" . $e->getMessage();
            }
            try {
                $arrResult = array();
                $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbConection->beginTransaction();
				$sentencia = $dbConection->prepare("SELECT * FROM ".$table);
				if ($sentencia->execute(array())) {
					while ($fila = $sentencia->fetch()) {
						$arrResult[] = $fila;
					}
				}
				$dbConection->commit();
                
                    $arrObjects = array();
                    $cont = 0;
			        foreach($arrResult as $key => $val) {
					    $arrObjects[$val[$cont]] = new Libro("");
					    $arrObjects[$val[$cont]]->setId($val[0]);
					    $arrObjects[$val[$cont]]->setTitulo($val[1]);
                        $arrObjects[$val[$cont]]->setAutor($val[2]);
                        $arrObjects[$val[$cont]]->setDescripcion($val[3]);
                        $cont++;
			        }
                    $cont = 0;
			        return $arrObjects;
            } catch (Exception $e) {
                $dbConection->rollBack();
				echo "Fallo: " . $e->getMessage();
                return [];
            } finally {
                $dbConection = null;
            }
        }
        // find
        public function find($table,$id) {
            try {
                $dbConection = new PDO("mysql:host=".self::$host.";dbname=".self::$database."",self::$user,self::$password);
            } catch(Exception $e) {
                echo "Connection failed" . $e->getMessage();
            }
            try {
                $arrResult = array();
                $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$dbConection->beginTransaction();
				$sentencia = $dbConection->prepare("SELECT * FROM ".$table." WHERE id = ?");
				if ($sentencia->execute(array($id))) {
					while ($fila = $sentencia->fetch()) {
						$arrResult = $fila;
					}
				}
				$dbConection->commit();
                if($arrResult!=null){
                        $object = new $table();
                        $object->setId($arrResult[0]);
					    $object->setTitulo($arrResult[1]);
                        $object->setAutor($arrResult[2]);
                        $object->setDescripcion($arrResult[3]);
                        return $object;
                } else {
                    $object = null;
                    return $object;
                } 	
            } catch(Exception $e) {
                $dbConection->rollBack();
				echo "Fallo: " . $e->getMessage();
                return null;
            } finally {
                $dbConection = null;
            }
        }
        // delete
        public function delete($table,$id) {
            try {
                $dbConection = new PDO("mysql:host=".self::$host.";dbname=".self::$database."",self::$user,self::$password);
            } catch(Exception $e) {
                echo "Connection failed" . $e->getMessage();
            }
            try {
                $arrResult = array();
                $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$dbConection->beginTransaction();
				$sentencia = $dbConection->prepare("DELETE FROM ".$table." WHERE id = $id");
				$sentencia->execute();
				$dbConection->commit();
            } catch(Exception $e) {
                $dbConection->rollBack();
				echo "Fallo: " . $e->getMessage();
                return null;
            } finally {
                $dbConection = null;
            }
        }
    }
?>